<?php
require '../controller/Controller.php';

$query_string = $_SERVER['QUERY_STRING'];

parse_str($query_string, $param);

$action = htmlspecialchars($param["action"]);

$action = $param["action"];

unset($param["action"]);

$args = $param;

switch ($action) {
    default:
        $action = "mainView";
        Controller::$action();
}
?>


