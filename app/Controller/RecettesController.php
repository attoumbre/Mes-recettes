<?php

namespace App\Controller;

use Core\Controller\Controller;

class RecettesController extends AppController
{
    public function __construct()
    {
        parent::__construct();

        $this->loadModel('Recette');
        $this->loadModel('Quantites_ingredient');
        $this->loadModel('Quantites_houblon');
        $this->loadModel('Levure');
        $this->loadModel('Infusion');
        $this->loadModel('Utilisateur');
    }

    // Page de toutes les recettes
    public function index()
    {

        // Nombre de recettes total
        $countRecettes = $this->Recette->countData();
        $nbRecettes = $countRecettes[0]->count;

        // Page courante
        (!isset($_GET['page'])) ? $page_courante = 1 : $page_courante = $_GET['page'];

        // Nombre de recettes par page
        $parPage = 9;

        // Nombre de pages de recettes total
        $nbPages = ceil($nbRecettes / $parPage);

        // Calcul de la première recette de la page
        $premier = ($page_courante * $parPage) - $parPage;

        // On récupère toutes les recettes
        $allRecettes = $this->Recette->allRecettes($premier, $parPage);

        // Liste des favoris de l'utilisateur connecté
        $this->loadModel('Favori');
        $id_favoris = [];
        if (isset($_SESSION['statut']) && !empty($_SESSION['statut'])) {
            $id_favoris = $this->Favori->findRId($_SESSION['auth']);
        }
        //titre de la page
        $titre_page = 'Toutes les recettes';
        $this->render('recettes.index', compact('titre_page', 'allRecettes', 'nbRecettes', 'nbPages', 'parPage', 'id_favoris'));
    }

    // Page d'une recette
    public function show()
    {
        //cette operation ne necessite pas la connexion d'un utilisateur
        //obtenir la recette
        $recette = $this->Recette->find($_GET['id_recette'], 'id_recette');

        //obtenir l'utilisateur de la recette
        $user = $this->Utilisateur->findU($recette->id_utilisateur)[0];

        //obtenir les quantites ingredient associées à la recette
        $ingredient = $this->Quantites_ingredient->findQ($_GET['id_recette'], true);

        //obtenir les quantites d'houblons associées à la recette
        $houblon = $this->Quantites_houblon->findH($_GET['id_recette'], true);

        //obtenir la levure associée à la recette
        $levure = $this->Levure->findL($_GET['id_recette'])[0];

        //les infusions de la recette
        $infusion = $this->Infusion->findI($_GET['id_recette']);

        // Liste des favoris de l'utilisateur connecté
        $this->loadModel('Favori');
        $id_favoris = [];
        if (isset($_SESSION['statut']) && !empty($_SESSION['statut'])) {
            $id_favoris = $this->Favori->findRId($_SESSION['auth']);
        }

        //titre de la page
        $titre_page = $recette->nom;

        //envoie au front
        $this->render('recettes.show', compact('titre_page', 'recette', 'ingredient', 'houblon', 'levure', 'infusion', 'user', 'id_favoris'));
    }
}
