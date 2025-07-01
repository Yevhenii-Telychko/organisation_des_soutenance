<?php
require_once '../model/ModelInnovation.php';

class ControllerInnovation
{
    public static function originalFunctionInnovation() {
        $nb_projets = ModelInnovation::getNombreProjets();
        $repartition = ModelInnovation::getRepartitionParGroupe();
        $taux = ModelInnovation::getTauxOccupationCreneaux();
        $etudiants_sans_projet = ModelInnovation::getEtudiantsSansProjet();

        include 'config.php';
        $view = $root . '/app/view/innovation/dashboard.php';
        require($view);
    }

    public static function mvcFunctionInnovation() {
        include 'config.php';
        $view = $root . '/app/view/innovation/mvc.php';
        require($view);
    }
}