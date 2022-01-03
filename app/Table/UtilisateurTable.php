<?php

namespace App\Table;

use Core\Table\Table;

class UtilisateurTable extends Table
{
    protected $table = 'utilisateurs';

    public function findUsers($id_value, $id_name = 'id_utilisateur')
    {
        return $this->query("SELECT * FROM {$this->table} WHERE " . $id_name . " = ?", [$id_value], true);
    }


    public function findU($id){
        return $this->query("
        SELECT id_utilisateur, email, pseudo
        FROM utilisateurs
        WHERE id_utilisateur = ? ", [$id]);
    }

 
}
