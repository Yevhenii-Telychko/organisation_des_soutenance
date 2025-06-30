<?php

require_once '../model/ModelExaminateur.php';
class ControllerExaminateur
{
    public static function listeProjetsExaminateur()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $examinateur_id = $_SESSION['user_id'];
        $listeProjets = ModelExaminateur::getProjets($examinateur_id);

        include 'config.php';
        $view = $root . '/app/view/examinateur/listeProjets.php';
        require($view);
    }

    public static function listeCreneauxExaminateur()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $examinateur_id = $_SESSION['user_id'];
        $listeCreneaux = ModelExaminateur::getCreneaux($examinateur_id);

        include 'config.php';
        $view = $root . '/app/view/examinateur/listeCreneaux.php';
        require($view);
    }

    public static function selectProjetFormExaminateur()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $exam_id = $_SESSION['user_id'];
        $listeProjets = ModelExaminateur::getProjets($exam_id);

        include 'config.php';
        $view = $root . '/app/view/examinateur/selectProjetForm.php';
        require($view);
    }

    public static function listeCreneauxPourProjetExaminateur()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $exam_id = $_SESSION['user_id'];
        $projet_id = isset($_POST['projet_id']) ? $_POST['projet_id'] : null;

        if (!$projet_id) {
            $error = "Aucun projet sélectionné.";
            include 'config.php';
            $view = $root . '/app/view/fragment/error.php';
            require($view);
            return;
        }

        $listeCreneaux = ModelExaminateur::getCreneauxPourProjet($exam_id, $projet_id);

        include 'config.php';
        $view = $root . '/app/view/examinateur/listeCreneauxPourProjet.php';
        require($view);
    }

    public static function addCreneauFormExaminateur()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $exam_id = $_SESSION['user_id'];
        $listeProjets = ModelExaminateur::getProjets($exam_id);

        include 'config.php';
        $view = $root . '/app/view/examinateur/addCreneauForm.php';
        require($view);
    }

    public static function addCreneauExaminateur()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $exam_id = $_SESSION['user_id'];
        $projet_id = isset($_POST['projet_id']) ? $_POST['projet_id'] : null;
        $date = isset($_POST['date']) ? $_POST['date'] : null;
        $time = isset($_POST['time']) ? $_POST['time'] : null;

        $creneau_datetime = $date . " " . $time;

        ModelExaminateur::addCreneau($exam_id, $projet_id, $creneau_datetime);

        $listeCreneaux = ModelExaminateur::getCreneauxPourProjet($exam_id, $projet_id);

        include 'config.php';
        $view = $root . '/app/view/examinateur/listeCreneauxPourProjet.php';
        require($view);
    }
}