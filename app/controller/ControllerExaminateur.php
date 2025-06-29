<?php

require_once '../model/ModelExaminateur.php';
class ControllerExaminateur
{
    public static function listeExaminateurProjets()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $exam_id = $_SESSION['user_id'];
        $listeProjets = ModelExaminateur::getProjetsPourExaminateur($exam_id);
        include 'config.php';
        $view = $root . '/app/view/examinateur/listeProjets.php';
        require($view);
    }

    public static function mesRDV()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $id_examinateur = $_SESSION['user_id'];

        $listeRDV = ModelExaminateur::getMesRDV($id_examinateur);

        include 'config.php';
        $view = $root . '/app/view/examinateur/listeMesRDV.php';
        require($view);
    }

}