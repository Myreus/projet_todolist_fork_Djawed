<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Account;
use App\Entity\Task;
use App\Database\Mysql;

class TaskRepository
{
    private \PDO $connect;

    public function __construct()
    {
        $this->connect = Mysql::connectBdd();
    }

    //Ajouter une tache
    public function addTask(Task $task): Task 
    {
        try {
            //1 Ecrire la requête
            $sql = "INSERT INTO task(title, `description`, 
            created_at, updated_at, finish_on, `status`, `repeat`, account_id ) 
            VALUE(?,?,?,?,?,?,?,?)";
            //2 Préparer la requête
            $req = $this->connect->prepare($sql);
            //3 Assigner les paramètres
            $req->bindValue(1,$task->getTitle(), \PDO::PARAM_STR);
            $req->bindValue(2,$task->getDescription(), \PDO::PARAM_STR);
            $req->bindValue(3,$task->getCreatedAt()->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
            $req->bindValue(4,$task->getUpdatedAt()->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
            $req->bindValue(5,$task->getFinishOn()->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
            $req->bindValue(6,$task->getStatus(), \PDO::PARAM_BOOL);
            $req->bindValue(7,$task->getRepeat(), \PDO::PARAM_STR);
            $req->bindValue(8,$task->getAuthor()->getId(), \PDO::PARAM_INT);
            //4 Exécuter la requête
            $req->execute();
            //5 Récupérer ID de la Task
            $id = $this->connect->lastInsertId();
            //6 Setter Id à la Task
            $task->setId($id);
            //appeler la méthode addCategoriesToTask
            $this->addCategoriesToTask($task);
        } catch(\PDOException $e) {}
        return $task;
    }

    //ajouter des categories à une tache
    public function addCategoriesToTask(Task $task): Task 
    {
        try {
            //boucle sur la collection de Category
            foreach ($task->getCategories() as $category) {
                //1 Ecrire la requête
                $sqlAsso = "INSERT INTO task_category(task_id, category_id) VALUE(?,?)";
                //2 Préparer la requête
                $reqAsso = $this->connect->prepare($sqlAsso);
                //3 Assigner les paramètres
                $reqAsso->bindValue(1, $task->getId(), \PDO::PARAM_INT);
                $reqAsso->bindValue(2, $category->getId(), \PDO::PARAM_INT);
                //4 Exécuter la requête
                $reqAsso->execute();
            }
            
        } catch(\PDOException $e) {}
        return $task;
    }

    //ajouter des categories à une tache
    public function addCategoriesToTaskV2(Task $task): Task 
    {
        try {
   
            //1 Ecrire la requête
            $sqlAsso = "INSERT INTO task_category(task_id, category_id) VALUES";
            //boucle sur la collection de Category
            foreach ($task->getCategories() as $category) {
                //2 compléter la requête
                $sqlAsso .= "(?,?),";
            }
            //3supprimer le dernier , de la requête
            $sqlAsso = substr($sqlAsso, 0, -1);
            //4 Préparer la requête
            $reqAsso = $this->connect->prepare($sqlAsso);
            $cpt = 1;
            //5 boucle pour assigner les paramètres
            foreach ($task->getCategories() as $category) {
                $reqAsso->bindValue($cpt,$task->getId(), \PDO::PARAM_INT );
                $cpt++;
                $reqAsso->bindValue($cpt,$category->getId(), \PDO::PARAM_INT);
                $cpt++;
            }
            //6 exécuter la requête
            $reqAsso->execute();
        } catch(\PDOException $e) {}
        return $task;
    }


    //ajouter des categories à une tache
    public function addCategoriesToTaskV3(Task $task): Task 
    {
        try {
            $bindArray = [];
            //1 Ecrire la requête
            $sqlAsso = "INSERT INTO task_category(task_id, category_id) VALUES";
            //boucle sur la collection de Category
            foreach ($task->getCategories() as $category) {
                //2 compléter la requête
                $sqlAsso .= "(?,?),";
                $bindArray[] = $task->getId();
                $bindArray[] = $category->getId();
            }
            //3supprimer le dernier , de la requête
            $sqlAsso = substr($sqlAsso, 0, -1);
            //4 Préparer la requête
            $reqAsso = $this->connect->prepare($sqlAsso);
            //5 Exécuter la requête
            $reqAsso->execute($bindArray);
        } catch(\PDOException $e) {}
        return $task;
    }
}

