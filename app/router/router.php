<?php
require '../controller/Controller.php';
require '../controller/ControllerConnexion.php';

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


    default:
        $action = "mainView";
        Controller::$action();
}
?>


