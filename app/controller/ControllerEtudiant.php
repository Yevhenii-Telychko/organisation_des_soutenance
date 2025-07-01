<?php
require_once '../model/ModelEtudiant.php';

class ControllerEtudiant
{
    public static function listeRDVEtudiant()
    {
        $listeRDV = ModelEtudiant::getRDV();

        include 'config.php';
        $view = $root . '/app/view/etudiant/listeRDV.php';
        require($view);
    }

    public static function prendreRDVFormEtudiant()
    {
        $projets = ModelEtudiant::getProjets();
        $creneaux = ModelEtudiant::getCreneauxDisponibles($projets);

        include 'config.php';
        $view = $root . 'app/view/etudiant/setRDVForm.php';
        require($view);
    }

    public static function prendreRDVEtudiant()
    {
        $id_creneau = isset($_POST['creneau_id']) ? $_POST['creneau_id'] : null;

        if ($id_creneau && ModelEtudiant::setRDV($id_creneau)) {
            header('Location: router.php?controller=etudiant&action=listeRDVEtudiant');
            exit();
        } else {
            $error = "Impossible de réserver ce créneau.";

            include 'config.php';
            $view = $root . '/app/view/fragment/error.php';
            require($view);
        }
    }
}