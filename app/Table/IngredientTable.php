<?php

namespace App\Table;

use Core\Table\Table;

class IngredientTable extends Table
{
    protected $table = 'ingredients';
    public function findId($critere)
    {
        return $this->query("SELECT id_ingredient  FROM {$this->table} WHERE nom = ?", [$critere], true);
    }
}
