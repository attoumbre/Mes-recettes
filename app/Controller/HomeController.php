<?php

namespace App\Controller;

use Core\Controller\Controller;

class HomeController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Recette');
        $this->loadModel('Utilisateur');
    }

    /**
     * Page d'accueil
     */
    public function index()
    {
        //compter les recette
        $countRecette = $this->Recette->countData();
        $nbRecette = $countRecette[0]->count;
        //compter les utilisateurs
        $countUser = $this->Utilisateur->countData();
        $nbUser = $countUser[0]->count;
        //obtenir l'id de la dernière insertion
        $recettes = $this->Recette->lastCarousel();
        
        $utilisateurs = $this->Utilisateur->all();
        $this->loadModel('Favori');
        $id_favoris = [];
        if (isset($_SESSION['statut']) && !empty($_SESSION['statut'])) {
            $id_favoris = $this->Favori->findRId($_SESSION['auth']);
            $tab_id_fav = array();
        }
        //titre de la page
        $titre_page = 'Accueil';
        $this->render('home.index', compact('titre_page', 'recettes', 'nbRecette', 'nbUser', 'id_favoris'));
    }
}
