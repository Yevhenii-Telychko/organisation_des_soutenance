<?php

class Controller
{
    public static function mainView()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        include 'config.php';
        $view = $root . '/app/view/main_view.php';
        require($view);
    }

}