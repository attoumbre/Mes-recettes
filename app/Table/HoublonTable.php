<?php

namespace App\Table;

use Core\Table\Table;

class HoublonTable extends Table
{
    protected $table = 'houblons';
    public function findId($critere)
    {
        return $this->query("SELECT id_houblon FROM {$this->table} WHERE nom = ?", [$critere], true);
    }
}
