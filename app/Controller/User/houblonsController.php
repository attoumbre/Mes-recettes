<?php 
namespace App\Controller\User;


use Core\Table\Table;

class HoublonsController extends AppController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Houblon');
    }
}