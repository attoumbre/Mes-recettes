<?php

namespace App\Table;

use Core\Table\Table;

class InfusionTable extends Table
{
    protected $table= "infusions";

    public function findI($id)
    {
        return $this->query("
            SELECT id_infusion, i.nom, temperature, i.temps
            FROM infusions i, recettes recettes
            WHERE recettes.id_recette = i.id_recette
            AND recettes.id_recette = ? ", [$id]);
    }

   
}
