<?php

if (!defined('DEBUG')) {
    define('DEBUG', FALSE);
}

$dsn = 'mysql:dbname=telychky;host=localhost;charset=utf8';
$username = 'telychky';
$password = 'CJlxeRlM';

if (!defined('LOCAL')) {
    define('LOCAL', TRUE);
}

if (LOCAL ) {
    $dsn = 'mysql:dbname=soutenance;host=localhost;charset=utf8';
    $username = 'root';
    $password = 'root';
}

$root = dirname(dirname(__DIR__)) . "/";


if (DEBUG) {
    echo ("<ul>");
    echo (" <li>dsn = $dsn</li>");
    echo (" <li>username = $username</li>");
    echo (" <li>password = $password</li>");
    echo ("<li>---</li>");
    echo (" <li>root = $root</li>");

    echo ("</ul>");
}
?>



