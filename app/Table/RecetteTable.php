<?php

namespace App\Table;

use Core\Table\Table;

class RecetteTable extends Table
{

    protected $table = 'recettes';

    /**
     * Récupère les derniers articles
     * @return array
     */
    public function lastCarousel()
    {
        return $this->query("
            SELECT *
            FROM recettes
            LEFT JOIN utilisateurs ON recettes.id_utilisateur = utilisateurs.id_utilisateur
            ORDER BY date_modification DESC LIMIT 6");
    }


    /**
     * les elements du perso à preciser
     * @return array
     */
    public function perso($id, $premier = null, $parPage = null)
    {
        if ($premier == null && $parPage == null) {
            $limit = "";
        } else {
            $limit = "LIMIT " . $premier . ", " . $parPage;
        }
        return $this->query("
            SELECT *
            FROM recettes
            LEFT JOIN utilisateurs ON recettes.id_utilisateur = utilisateurs.id_utilisateur
            WHERE recettes.id_utilisateur = ?
            ORDER BY date_modification DESC " . $limit . "", [$id]);
    }


    public function recettePersoCount($id)
    {
        return $this->query("
                SELECT count(*) as perso
                FROM recettes i, utilisateurs u
                WHERE i.id_utilisateur = u.id_utilisateur
                AND u.id_utilisateur = ? ", [$id]);
    }

    /**
     * Toutes les recettes de bière avec Limit
     * @return array
     */
    public function allRecettes($premier = null, $parPage = null)
    {
        if ($premier == null && $parPage == null) {
            $limit = "";
        } else {
            $limit = "LIMIT " . $premier . ", " . $parPage;
        }
        return $this->query("
            SELECT *
            FROM recettes
            ORDER BY date_creation DESC " . $limit . "");
    }

    public function getImage($id){
        return $this->query("
        SELECT image
        FROM recettes
        WHERE id_recette = ? ", [$id]);
    }
}
