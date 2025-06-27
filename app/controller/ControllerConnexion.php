<?php

require_once '../model/ModelPersonne.php';

class ControllerConnexion
{

    public static function loginForm()
    {
        include 'config.php';
        $view = $root . '/app/view/personne/login.php';
        require($view);
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
            require 'config.php';
            $view = $root . '/app/view/main_view.php';
            require($view);
        } else {
            $error = "Login ou mot de passe incorrect.";;
            require 'config.php';
            $view = $root . '/app/view/personne/error.php';
            require($view);
        }

    }

    public static function registerForm()
    {
        include 'config.php';
        $view = $root . '/app/view/personne/register.php';
        require($view);
    }

    public static function register()
    {

        $selectedRoles = $_POST['roles'];

        $roles = [
            'etudiant' => in_array('etudiant', $selectedRoles) ? 1 : 0,
            'responsable' => in_array('responsable', $selectedRoles) ? 1 : 0,
            'examinateur' => in_array('examinateur', $selectedRoles) ? 1 : 0,
        ];

        $newUser = ModelPersonne::register($_POST['nom'], $_POST['prenom'], $_POST['login'], $_POST['password'], $roles);
        if ($newUser) {
            header('Location: router.php?action=loginForm');
        } else {
            $error = "Erreur lors de l'inscription.";
            include 'config.php';
            $view = $root . '/app/view/personne/error.php';
            require($view);
        }

    }

    public static function deconnexion()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();
        include 'config.php';
        $view = $root . '/app/view/main_view.php';
        require($view);
    }
}
