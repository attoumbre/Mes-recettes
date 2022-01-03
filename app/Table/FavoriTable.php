<?php

namespace App\Table;

use Core\Table\Table;

class FavoriTable extends Table
{
    public function recettefavoris($id,  $premier = null, $parPage = null)
    {
        if ($premier == null && $parPage == null) {
            $limit = "";
        } else {
            $limit = "LIMIT " . $premier . ", " . $parPage;
        }
        return $this->query("
            SELECT favoris.id_favori, favoris.id_recette,recettes.*
            FROM recettes recettes, favoris favoris, utilisateurs utilisateur
                WHERE utilisateur.id_utilisateur = favoris.id_utilisateur
                AND recettes.id_recette = favoris.id_recette
                AND utilisateur.id_utilisateur = ? 
                ORDER BY favoris.id_favori ASC " . $limit . "", [$id]);
    }

    public function recettefavorisCount($id)
    {
        return $this->query("
                SELECT count(*) as total
                FROM recettes i, favoris f, utilisateurs u
                WHERE u.id_utilisateur = f.id_utilisateur
                AND i.id_recette = f.id_recette
                AND u.id_utilisateur = ? ", [$id]);
    }

    public function findFavori($id_recette, $id_utilisateur)
    {
        return $this->query("
                SELECT *
                FROM favoris f
                WHERE f.id_recette = " . $id_recette . " 
                AND f.id_utilisateur = " . $id_utilisateur);
    }

    public function findRId($id_utilisateur)
    {
        return $this->query("
                SELECT f.id_recette
                FROM recettes i, favoris f, utilisateurs u
                WHERE u.id_utilisateur = f.id_utilisateur
                AND i.id_recette = f.id_recette
                AND u.id_utilisateur  = ? ", [$id_utilisateur]);
    }

    public function findF($id){
        return $this->query("
        SELECT f.id_favori
        FROM favoris f, recettes recettes
        WHERE recettes.id_recette = f.id_recette
        AND recettes.id_recette = ? ", [$id]);
    }
}
