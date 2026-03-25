<?php

namespace App\Controller;

use App\Service\CategoryService;
use App\Service\TaskService;
use App\Controller\AbstractController;

class TaskController extends AbstractController
{
    private CategoryService $categoryService;
    private TaskService $taskService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
        $this->taskService = new TaskService();
    }

    public function createTask(): mixed 
    {
        //test si non connecté redirection vers accueil
        if (!isset($_SESSION["connected"])) header('Location:/');

        //Récupération des categories
        $data["categories"] = $this->categoryService->getAllCategories();

        //Test si le formulaire est submit
        if (isset($_POST["submit"])) {
            //Ajout de la tache
            $data["msg"] =  $this->taskService->insertTask($_POST);
        }

        return $this->render("add_task","Ajouter tache", $data);
    }
    
    public function showAllTaskByAccount(): mixed 
    {
        //test si non connecté redirection vers accueil
        if (!isset($_SESSION["connected"])) header('Location:/');
        
        //Récupération de la liste des taches
        $tasks["tasks"] = $this->taskService->getAllTaskByAccount($_SESSION["id"]);

        return $this->render("show_all_task_by_account","liste des taches", $tasks);
    }
}
