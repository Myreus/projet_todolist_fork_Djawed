<?php

namespace App\Repository;

use App\Database\Mysql;
use App\Entity\Account;

class AccountRepository
{
    //connexion à la BDD
    private \PDO $connect;

    public function __construct()
    {
        $this->connect = Mysql::connectBdd();
    }

    public function addAccount(Account $account): Account
    {
        try {
            //1 Ecrire la requête SQL
            $sql = "INSERT INTO `account`(firstname, lastname, email, `password`,`image`) VALUE(?,?,?,?,?)";
            //2 Préparation de la requête
            $req = $this->connect->prepare($sql);
            //3 Assignation des paramètres
            $req->bindValue(1, $account->getFirstname(),\PDO::PARAM_STR);
            $req->bindValue(2, $account->getLastname(),\PDO::PARAM_STR);
            $req->bindValue(3, $account->getEmail(),\PDO::PARAM_STR);
            $req->bindValue(4, $account->getPassword(),\PDO::PARAM_STR);
            $req->bindValue(5, $account->getImage(),\PDO::PARAM_STR);
            //4 Exécuter la requête
            $req->execute();
            //5 retourner (id account)
            $id = $this->connect->lastInsertId();
            //6 Setter id (account)
            $account->setId($id);
        } catch(\PDOException $e) {}
        return $account;
    }

    public function isAccountExistsByEmail(string $email): bool 
    {
        try {
            //1 Ecrire la requête SQL
            $sql = "SELECT account.email FROM account WHERE account.email = ?";
            //2 Préparation de la requête
            $req = $this->connect->prepare($sql);
            //3 Assignation des paramètres
            $req->bindParam(1, $email,\PDO::PARAM_STR);
            //4 Exécuter la requête (rangé dans la variable $req)
            $req->execute();
            //5 Ranger le résultat dans un tableau associatif
            $account = $req->fetch(\PDO::FETCH_ASSOC);
            //6 Logique
            if (empty($account)){
                return false;
            } else {
                return true;
            }
            
        } catch(\PDOException $e) {
            return false;
        }
    }

    public function findAccountByEmail(string $email): ?Account 
    {
        try {
            //1 Ecrire la requête SQL
            $sql = "SELECT a.id, a.firstname, a.lastname, a.email, a.password, a.image, a.right_id FROM account AS a WHERE account.email = ?";
            //2 Préparation de la requête
            $req = $this->connect->prepare($sql);
            //3 Assignation des paramètres
            $req->bindParam(1, $email,\PDO::PARAM_STR);
            //4 Exécuter la requête (rangé dans la variable $req)
            $req->execute();
            //5 Ranger le résultat dans un tableau associatif
            $account = $req->fetch(\PDO::FETCH_ASSOC);
            //6 Retourne le résultat
            return $account;
            
        } catch(\PDOException $e) {
            return null;
        }
    }
}

