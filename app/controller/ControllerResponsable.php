<?php
require_once '../model/ModelResponsable.php';

class ControllerResponsable
{

    public static function listeProjets()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $success_msg = isset($_SESSION["success_msg"]) ? $_SESSION["success_msg"] : null;
        unset($_SESSION["success_msg"]);
        $listeProjets = ModelResponsable::listeProjets();

        include 'config.php';
        $view = $root . '/app/view/responsable/listeProjets.php';
        require($view);
    }

    public static function projetForm()
    {
        include 'config.php';
        $view = $root . '/app/view/responsable/projetForm.php';
        require($view);
    }

    public static function projetSubmit()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $newProjet = ModelResponsable::addProjet($_POST['label'], $_SESSION['user_id'], $_POST['groupe']);

        if ($newProjet) {
            $_SESSION["success_msg"] = "Projet ajouté avec succès.";
            header('Location: router.php?action=listeProjets');
            exit();
        } else {
            $error = "Impossible d'ajouter ce projet.";
            include 'config.php';
            $view = $root . '/app/view/fragment/error.php';
            require($view);
        }
    }

    public static function listeExaminateurs()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $success_msg = isset($_SESSION["success_msg"]) ? $_SESSION["success_msg"] : null;
        unset($_SESSION["success_msg"]);
        $listeExaminateurs = ModelResponsable::listeExaminateurs();
        include 'config.php';
        $view = $root . '/app/view/responsable/listeExaminateurs.php';
        require($view);
    }

    public static function examinateurForm()
    {
        include 'config.php';
        $view = $root . '/app/view/responsable/examinateurForm.php';
        require($view);
    }

    public static function examinateurSubmit()
    {
        $newExaminateur = ModelResponsable::addExaminateur(strtoupper($_POST['nom']), $_POST['prenom']);
        if ($newExaminateur) {
            $_SESSION["success_msg"] = "Examinateur ajouté avec succès.";
            header('Location: router.php?action=listeExaminateurs');
            exit();
        } else {
            $error = "Impossible d'ajouter ce projet.";
            include 'config.php';
            $view = $root . '/app/view/fragment/error.php';
            require($view);
        }
    }

    public static function selectProjetForm()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $projets = ModelResponsable::getProjetsDuResponsable($_SESSION['user_id']);

        include 'config.php';
        $view = $root . '/app/view/responsable/selectProjetForm.php';
        require($view);
    }

    public static function listeExaminateursPourProjet()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $id_projet = isset($_POST['projet_id']) ? $_POST['projet_id'] : null;

        if (!$id_projet) {
            $error = "Aucun projet sélectionné.";
            include 'config.php';
            $view = $root . '/app/view/fragment/error.php';
            require($view);
            return;
        }

        $listeExaminateurs = ModelResponsable::getExaminateursPourProjet($id_projet);

        include 'config.php';
        $view = $root . '/app/view/responsable/listeExaminateurs.php';
        require($view);
    }

    public static function listeRDVProjetForm()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $projets = ModelResponsable::getProjetsDuResponsable($_SESSION['user_id']);

        include 'config.php';
        $view = $root . '/app/view/responsable/rdvProjetForm.php';
        require($view);
    }

    public static function listeRDVPourProjet()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $id_projet = isset($_POST['projet_id']) ? $_POST['projet_id'] : null;

        if (!$id_projet) {
            $error = "Aucun projet sélectionné.";
            include 'config.php';
            $view = $root . '/app/view/fragment/error.php';
            require($view);
            return;
        }

        $rdvs = ModelResponsable::getRDVPourProjet($id_projet);

        include 'config.php';
        $view = $root . '/app/view/responsable/listeRDVProjet.php';
        require($view);
    }
}