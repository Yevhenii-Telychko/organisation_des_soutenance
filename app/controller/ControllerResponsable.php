<?php
require_once '../model/ModelResponsable.php';

class ControllerResponsable
{
    public static function listeProjetsResponsable()
    {
        $success_msg = isset($_SESSION["success_msg"]) ? $_SESSION["success_msg"] : null;
        unset($_SESSION["success_msg"]);
        $listeProjets = ModelResponsable::getProjets();

        include 'config.php';
        $view = $root . '/app/view/responsable/listeProjets.php';
        require($view);
    }

    public static function addProjetFormResponsable()
    {
        include 'config.php';
        $view = $root . '/app/view/responsable/addProjetForm.php';
        require($view);
    }

    public static function addProjetResponsable()
    {
        $newProjet = ModelResponsable::addProjet($_POST['label'], $_POST['groupe']);

        if ($newProjet) {
            $_SESSION["success_msg"] = "Projet ajouté avec succès.";
            header('Location: router.php?controller=responsable&action=listeProjetsResponsable');
            exit();
        } else {
            $error = "Impossible d'ajouter ce projet.";

            include 'config.php';
            $view = $root . '/app/view/fragment/error.php';
            require($view);
        }
    }

    public static function listeExaminateursResponsable()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $success_msg = isset($_SESSION["success_msg"]) ? $_SESSION["success_msg"] : null;
        unset($_SESSION["success_msg"]);
        $listeExaminateurs = ModelResponsable::listeExaminateurs();

        include 'config.php';
        $view = $root . '/app/view/responsable/listeExaminateurs.php';
        require($view);
    }

    public static function addExaminateurFormResponsable()
    {
        include 'config.php';
        $view = $root . '/app/view/responsable/addExaminateurForm.php';
        require($view);
    }

    public static function addExaminateurResponsable()
    {
        $newExaminateur = ModelResponsable::addExaminateur(strtoupper($_POST['nom']), $_POST['prenom']);
        if ($newExaminateur) {
            $_SESSION["success_msg"] = "Examinateur ajouté avec succès.";
            header('Location: router.php?controller=responsable&action=listeExaminateursResponsable');
            exit();
        } else {
            $error = "Impossible d'ajouter cet examinateur.";

            include 'config.php';
            $view = $root . '/app/view/fragment/error.php';
            require($view);
        }
    }

    public static function selectProjetFormResponsable()
    {
        $projets = ModelResponsable::getProjetsResponsable();

        include 'config.php';
        $view = $root . '/app/view/responsable/selectProjetForm.php';
        require($view);
    }

    public static function listeExaminateursProjetResponsable()
    {
        $id_projet = isset($_POST['projet_id']) ? $_POST['projet_id'] : null;

        if (!$id_projet) {
            $error = "Aucun projet sélectionné.";

            include 'config.php';
            $view = $root . '/app/view/fragment/error.php';
            require($view);

            return;
        }

        $listeExaminateurs = ModelResponsable::getExaminateursProjet($id_projet);

        include 'config.php';
        $view = $root . '/app/view/responsable/listeExaminateurs.php';
        require($view);
    }

    public static function listeRDVProjetFormResponsable()
    {
        $projets = ModelResponsable::getProjetsResponsable();

        include 'config.php';
        $view = $root . '/app/view/responsable/listeRDVProjetForm.php';
        require($view);
    }

    public static function listeRDVProjetResponsable()
    {
        $projet_id = isset($_POST['projet_id']) ? $_POST['projet_id'] : null;

        if (!$projet_id) {
            $error = "Aucun projet sélectionné.";

            include 'config.php';
            $view = $root . '/app/view/fragment/error.php';
            require($view);

            return;
        }

        $rdvs = ModelResponsable::getRDVProjet($projet_id);

        include 'config.php';
        $view = $root . '/app/view/responsable/listeRDVProjet.php';
        require($view);
    }

    public static function dashboard() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $responsable_id = $_SESSION['user_id'];

        $nb_projets = ModelResponsable::getNombreProjets($responsable_id);
        $repartition = ModelResponsable::getRepartitionParGroupe($responsable_id);
        $taux = ModelResponsable::getTauxOccupationCreneaux($responsable_id);
        $etudiants_sans_projet = ModelResponsable::getEtudiantsSansProjet();

        include 'config.php';
        $view = $root . '/app/view/responsable/dashboard.php';
        require($view);
    }
}