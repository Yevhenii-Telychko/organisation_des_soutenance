<?php
spl_autoload_register(function ($className) {
    $prefixes = [
        'Controller' => '../controller/',
        'Model' => '../model/',
    ];

    foreach ($prefixes as $prefix => $dir) {
        if (str_starts_with($className, $prefix)) {
            require_once $dir . $className . '.php';

            return;
        }
    }
});