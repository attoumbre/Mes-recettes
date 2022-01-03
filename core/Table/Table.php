<?php

namespace Core\Table;

use Core\Database\MysqlDatabase;

class Table
{
    protected $table;
    protected $db;

    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
        if (is_null($this->table)) {
            $parts = explode('\\', get_class($this));
            $class_name = end($parts);
            $this->table = strtolower(str_replace('Table', '', $class_name)) . 's';
        }
    }

    public function all()
    {
        return $this->query('SELECT * FROM ' . $this->table);
    }

    public function allInOrder($order, $orderBy)
    {
        return $this->query('SELECT * FROM ' . $this->table . ' ORDER BY ' . $orderBy . ' ' . $order);
    }

    public function find($id_value, $id_name = 'id')
    {
        return $this->query("SELECT * FROM {$this->table} WHERE " . $id_name . " = ?", [$id_value], true);
    }

    /**
     * pour compter les elements d'une table
     */
    public function countData()
    {
        return $this->query("SELECT count(*) as count FROM {$this->table}
        ");
    }


    public function findBy(array $criteres)
    {
        $champs = [];
        $valeur = [];
        foreach ($criteres as $champ => $valeur) {
            $champs[] = " $champ = ?";
            $valeurs[] = $valeur;
        }
        $liste_champs = implode('AND', $champs);
        return $this->query(
            "SELECT * FROM '.$this->table.' WHERE " . $liste_champs,
            $valeurs
        )->fetchAll();
    }

    public function update($id_recette, $id, $fields)
    {
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $k => $v) {
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }
        $attributes[] = $id;
        $sql_part = (implode(', ', $sql_parts));
        return $this->query("UPDATE {$this->table} SET $sql_part WHERE " . $id_recette . " = ?", $attributes, true);
    }

    public function delete($id, $id_name)
    {
        return $this->query("DELETE FROM {$this->table} WHERE " . $id_name . " = ?", [$id], true);
    }

    public function create($fields)
    {
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $k => $v) {
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }
        $sql_part = (implode(', ', $sql_parts));
        return $this->query("INSERT INTO {$this->table} SET $sql_part", $attributes, true);
    }

    public function extract($key, $value, $options)
    {
        // OrderBy
        $orderBy = '';
        if (isset($options['orderBy'])) {
            // Order
            $order = isset($options['order']) ? $options['order'] : 'ASC';
            $records = $this->allInOrder($order, $options['orderBy']);
        } else {
            $records = $this->all();
        }
        $return = [];
        foreach ($records as $v) {
            $return[$v->$key] = $v->$value;
        }
        return $return;
    }

    public function query($statement, $attributes = null, $one = false)
    {
        if ($attributes) {

            return $this->db->prepare(
                $statement,
                $attributes,
                str_replace('Table', 'Entity', get_class($this)),
                $one
            );
        } else {
            return $this->db->query(
                $statement,
                str_replace('Table', 'Entity', get_class($this)),
                $one
            );
        }
    }

    public function lastInsertID()
    {
        return $this->db->lastInsertId();
    }
}
