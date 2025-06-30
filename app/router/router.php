<?php
require '../controller/Controller.php';
require '../controller/ControllerConnexion.php';
require '../controller/ControllerEtudiant.php';
require '../controller/ControllerResponsable.php';
require '../controller/ControllerExaminateur.php';

if (session_status() === PHP_SESSION_NONE) session_start();

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

    case "listeRDVEtudiant":
    case "prendreRDVFormEtudiant":
    case "prendreRDVEtudiant":
        ControllerEtudiant::$action();
        break;

    case "listeProjetsResponsable":
    case "addProjetFormResponsable":
    case "addProjetResponsable":
    case "listeExaminateursResponsable":
    case "addExaminateurFormResponsable":
    case "addExaminateurResponsable":
    case "selectProjetFormResponsable":
    case "listeExaminateursProjetResponsable":
    case "listeRDVProjetFormResponsable":
    case "listeRDVProjetResponsable":
        ControllerResponsable::$action();
        break;

    case "listeProjetsExaminateur":
    case "listeCreneauxExaminateur":
    case "selectProjetFormExaminateur":
    case "listeCreneauxPourProjetExaminateur":
    case "addCreneauFormExaminateur":
    case "addCreneauExaminateur":
    case "addManyCreneauxFormExaminateur":
    case "addManyCreneauxExaminateur":
        ControllerExaminateur::$action($args);
        break;
    default:
        $action = "mainView";
        Controller::$action();
}
?>


