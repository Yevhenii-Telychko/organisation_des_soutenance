<?php

require_once 'Model.php';

class ModelPersonne
{

    public static function checkLogin($login, $password)
    {
        $database = Model::getInstance();
        $stmt = $database->prepare("SELECT * FROM personne WHERE login = :login AND password = :password");
        $stmt->execute(['login' => $login, 'password' => $password]);
        return $stmt->fetch();
    }

    public static function register($name, $surname, $login, $password, $roles)
    {
        $database = Model::getInstance();
        $role_etudiant = $roles['etudiant'];
        $role_examinateur = $roles['examinateur'];
        $role_responsable = $roles['responsable'];

        $statement = $database->query("SELECT MAX(id) FROM personne");
        $tuple = $statement->fetch();
        $id = $tuple['0'];
        $id++;

        $stmt = $database->prepare("INSERT INTO personne (id, nom, prenom, login, password, role_etudiant, role_examinateur, role_responsable) 
    VALUES (:id, :nom, :prenom, :login, :password, :role_etudiant, :role_examinateur, :role_responsable)");

        return $stmt->execute([
            ':id' => $id,
            ':nom' => $name,
            ':prenom' => $surname,
            ':login' => $login,
            ':password' => $password,
            ':role_etudiant' => $role_etudiant,
            ':role_examinateur' => $role_examinateur,
            ':role_responsable' => $role_responsable
        ]);
    }
}
