<?php
require_once 'autoload.php';

if (session_status() === PHP_SESSION_NONE) session_start();

$controllerParam = $_GET['controller'] ?? null;
$actionParam = $_GET['action'] ?? null;

if (!$controllerParam || !$actionParam) {
    $controllerClass = 'Controller';
    $action = 'mainView';
} else {
    $controllerClass = 'Controller' . ucfirst($controllerParam);
    $action = htmlspecialchars($actionParam);
}

$args = $_GET;
unset($args['controller'], $args['action']);

if (class_exists($controllerClass)) {
    if (method_exists($controllerClass, $action)) {
        $reflection = new ReflectionMethod($controllerClass, $action);
        if ($reflection->getNumberOfParameters() > 0) {
            $controllerClass::$action($args);
        } else {
            $controllerClass::$action();
        }
    } else {
        echo "<p>Méthode <b>$action</b> inexistante dans $controllerClass.</p>";
    }
} else {
    echo "<p>Controller <b>$controllerClass</b> introuvable.</p>";
}