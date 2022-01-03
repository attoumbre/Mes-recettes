<?php

// Date locale
date_default_timezone_set('Europe/Paris');

define('ROOT', dirname(__DIR__));
require ROOT . '/app/App.php';
App::load();

if (isset($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = 'home.index';
}

$page = explode('.', $page);
$action = $page[1];
if ($page[0] == 'admin') {
    $controller = '\App\Controller\Admin\\' . ucfirst($page[1]) . 'Controller';
    $action = $page[2];
} else if ($page[0] == 'user') {
    $controller = '\App\Controller\User\\' . ucfirst($page[1]) . 'Controller';
    $action = $page[2];
} else {
    $controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller';
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (method_exists($controller, $action)) {
    $controller = new $controller();
    $controller->$action();
} else {
    // On envoie le code réponse 404
    header('Location: index.php?p=erreur.index');
    die;
}
