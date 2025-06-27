<?php

class Controller
{
    public static function mainView()
    {
        include 'config.php';
        $view = $root . '/app/view/main_view.php';
        require($view);
    }

}