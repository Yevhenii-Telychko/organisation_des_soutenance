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
}
