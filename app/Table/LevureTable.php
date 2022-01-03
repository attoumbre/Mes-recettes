<?php

namespace App\Table;

use Core\Table\Table;

class LevureTable extends Table
{
    protected $table = "levures";

    public function findL($id)
    {
        return $this->query("
            SELECT id_levure, l.nom, attenuation_moyenne,temperature_optimale
            FROM levures l, recettes recettes
            WHERE recettes.id_recette = l.id_recette
            AND recettes.id_recette = ? ", [$id]);
    }

 
}
