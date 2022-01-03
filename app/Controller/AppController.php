<?php

namespace App\Controller;

use Core\Controller\Controller;
use \App;

class AppController extends Controller
{
    protected $template = 'default';

    public function __construct()
    {
        $this->viewPath = ROOT . '/app/Views/';
    }

    protected function loadModel($model_name)
    {
        $this->$model_name = App::getInstance()->getTable($model_name);
    }

    protected function forbidden()
    {
        header('Location: index.php?p=erreur.index');
        die;
    }

    protected function notFound()
    {
        header('HTTP/1.0 404 Not Found');
        die('Page introuvable');
    }
}
