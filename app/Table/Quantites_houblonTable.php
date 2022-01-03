<?php

namespace App\Table;

use Core\Table\Table;

class Quantites_houblonTable extends Table
{

    protected $table = 'quantites_houblons';

    public function findH($id,  $selected = false)
    {
        if (!$selected) {
            return $this->query("
            SELECT id_quantite_houblon,q.quantite, acide_alpha,q.temps_ebullition
            FROM quantites_houblons q, recettes recettes,  houblons h
            WHERE h.id_houblon = q.id_houblon
            AND recettes.id_recette = q.id_recette
            AND recettes.id_recette = ? ", [$id]);
        }
        return $this->query("
            SELECT id_quantite_houblon,q.quantite, acide_alpha,q.temps_ebullition, h.*
            FROM quantites_houblons q, recettes recettes,  houblons h
            WHERE h.id_houblon = q.id_houblon
            AND recettes.id_recette = q.id_recette
            AND recettes.id_recette = ? ", [$id]);
    }
}
