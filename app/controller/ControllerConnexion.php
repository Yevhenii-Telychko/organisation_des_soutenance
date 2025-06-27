<?php

require_once '../model/ModelPersonne.php';

class ControllerConnexion
{

    public static function loginForm()
    {
        include 'config.php';
        $vue = $root . '/app/view/personne/login.php';
        require($vue);
    }

    public static function login()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $user = ModelPersonne::checkLogin($login, $password);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['nom'];
            $_SESSION['surname'] = $user['prenom'];
            $_SESSION['roles'] = [
                'etudiant' => $user['role_etudiant'],
                'responsable' => $user['role_responsable'],
                'examinateur' => $user['role_examinateur']
            ];
            include 'config.php';
            $vue = $root . '/app/view/main_view.php';
            require($vue);
        }
    }

    public static function deconnexion()
    {
        session_destroy();
        include 'config.php';
        $vue = $root . '/app/view/main_view.php';
        require($vue);
    }
}
