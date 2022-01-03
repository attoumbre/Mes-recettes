<?php

namespace App\Controller\User;

use Core\HTML\Forms;
use App\Table\Favori;
use Core\Controller\Controller;


class FavoriController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Favori');
    }

    /**
     * Recettes favorites de l'utilisateur
     */
    public function favoris()
    {
        if (isset($_SESSION['statut']) && !empty($_SESSION['statut'])) {

            // Nombre de recettes en favoris de l'utilisateur connecté
            $countFavoris = $this->Favori->recettefavorisCount($_SESSION['auth']);
            $nbFavoris = $countFavoris[0]->total;

            // Page courante
            (!isset($_GET['page'])) ? $page_courante = 1 : $page_courante = $_GET['page'];

            // Nombre de recettes par page
            $parPage = 4;

            // Nombre de pages de recettes total
            $nbPages = ceil($nbFavoris / $parPage);

            // Calcul de la première recette de la page
            $premier = ($page_courante * $parPage) - $parPage;

            // On récupère les données
            $favoris = $this->Favori->recettefavoris($_SESSION['auth'], $premier, $parPage);

            //titre de la page
            $titre_page = 'Mes favoris';
            $this->render('user.favori.favoris', compact('titre_page', 'favoris', 'nbFavoris', 'nbPages', 'parPage'));
        }
    }

    /**
     * ajouter une recette à ses favoris
     */
    public function creer()
    {
        if (isset($_SESSION['statut']) && !empty($_SESSION['statut'])) {
            if (isset($_POST) && !empty($_POST)) {
                $date = date(" Y/m/d H:i:s");

                $favori = $this->Favori->create([
                    'date' => $date,
                    'id_utilisateur' => $_SESSION['auth'],
                    'id_recette' => $_POST['id_recette']
                ]);
            }
            return $this->favoris();
        }
    }


    /**
     * supprimer une recette des favoris
     */
    public function supprimer()
    {
        if (isset($_SESSION['statut']) && !empty($_SESSION['statut'])) {
            $id_utilisateur = $_SESSION['auth'];
            $id_recette = $_POST['id_recette'];
            $favori = $this->Favori->findFavori($id_recette, $id_utilisateur);
            $id_favori = $favori[0]->id_favori;
            $this->Favori->delete($id_favori, "id_favori");
            return $this->favoris();
        }
    }
}
