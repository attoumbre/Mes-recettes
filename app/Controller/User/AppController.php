<?php

namespace App\Controller\User;

use \App;
use \Core\Auth\DBAuth;

class AppController extends \App\Controller\AppController
{
    public function __construct()
    {
        parent::__construct();
        $app = App::getInstance();
        $auth = new DBAuth($app->getDb());

        if (!$auth->logged() || ($_SESSION['statut'] != 'user' && $_SESSION['statut'] != 'admin')) {
            $this->forbidden();
        }
    }
}
