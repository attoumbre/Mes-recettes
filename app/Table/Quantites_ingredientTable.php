<?php

namespace App\Table;

use Core\Table\Table;

class Quantites_ingredientTable extends Table
{

    protected $table ='quantites_ingredients';
    public function findQ($id, $selected=false)
    {
        if(!$selected){
            return $this->query("
            SELECT id_quantite_ingredient, unite_mesure, q.quantite
            FROM quantites_ingredients q, recettes recettes,  ingredients i
            WHERE i.id_ingredient = q.id_ingredient
            AND recettes.id_recette = q.id_recette
            AND recettes.id_recette = ? ", [$id]);
        }
        return $this->query("
        SELECT q.id_quantite_ingredient, q.unite_mesure, q.quantite, i.*
        FROM quantites_ingredients q, recettes recettes,  ingredients i
        WHERE i.id_ingredient = q.id_ingredient
        AND recettes.id_recette = q.id_recette
        AND recettes.id_recette = ? ", [$id]);
        
    }

   
}
