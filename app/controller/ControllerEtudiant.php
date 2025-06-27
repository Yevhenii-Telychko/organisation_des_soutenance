<?php
require_once '../model/ModelEtudiant.php';

class ControllerEtudiant
{

    public static function listeRDV()
    {
        $listeRDV = ModelEtudiant::getListeRDV();
        include 'config.php';
        $view = $root . '/app/view/etudiant/listeRDV.php';
        require($view);
    }

    public static function prendreRDVForm() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $id_etudiant = $_SESSION['user_id'];
        $projets = ModelEtudiant::getProjetsPourEtudiant($id_etudiant);
        $creneaux = ModelEtudiant::getCreneauxDisponibles($projets);
        include 'config.php';
        $view = $root . 'app/view/etudiant/rdvForm.php';
        require($view);
    }

    public static function prendreRDVSubmit() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $id_etudiant = $_SESSION['user_id'];
        $id_creneau = isset($_POST['creneau_id']) ? $_POST['creneau_id'] : null;
        if ($id_creneau && ModelEtudiant::reserverRDV($id_etudiant, $id_creneau)) {
            header('Location: router.php?action=listeRDV');
        } else {
            $error = "Impossible de réserver ce créneau.";
            include 'config.php';
            $view = $root . '/app/view/personne/error.php';
            require($view);
        }
    }
}