<?php

namespace App\Controller;

use \App;
use Core\Auth\DBAuth;
use Core\HTML\BootstrapForm;

class ErreurController extends AppController
{
    protected $template = 'erreur';

    public function __construct()
    {
        parent::__construct();
    }

    // Page d'erreur
    public function index()
    {
        $this->render('templates.erreur');
    }
}
