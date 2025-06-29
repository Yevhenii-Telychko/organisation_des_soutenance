<?php
require '../controller/Controller.php';
require '../controller/ControllerConnexion.php';
require '../controller/ControllerEtudiant.php';
require '../controller/ControllerResponsable.php';
require '../controller/ControllerExaminateur.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$query_string = $_SERVER['QUERY_STRING'];

parse_str($query_string, $param);

$action = htmlspecialchars($param["action"]);

$action = $param["action"];

unset($param["action"]);

$args = $param;

switch ($action) {
    case "loginForm":
    case "login":
    case "registerForm":
    case "register":
    case "deconnexion":
        ControllerConnexion::$action();
        break;

    case "listeRDV":
    case "prendreRDVForm":
    case "prendreRDVSubmit":
        ControllerEtudiant::$action();
        break;

    case "listeProjets":
    case "projetForm":
    case "projetSubmit":
    case "listeExaminateurs":
    case "examinateurForm":
    case "examinateurSubmit":
    case "selectProjetForm":
    case "listeExaminateursPourProjet":
    case "listeRDVProjetForm":
    case "listeRDVPourProjet":
        ControllerResponsable::$action();
        break;

    case "listeExaminateurProjets":
    case "mesCreneaux":
        ControllerExaminateur::$action($args);
        break;
    default:
        $action = "mainView";
        Controller::$action();
}
?>


