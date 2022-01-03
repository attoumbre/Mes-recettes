<?php

namespace Core\Auth;

use Core\Database\Database;

class DBAuth
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getUserId()
    {
        if ($this->logged()) {
            return $_SESSION['auth'];
        }
        return false;
    }

    /**
     * @param $username
     * @param $password
     * @return boolean
     */
    public function login($email, $password)
    {
        $user = $this->db->prepare('SELECT * FROM utilisateurs WHERE email = ?', [$email], null, true);
        if ($user) {
            if ($user->mdp === sha1($password)) {
                $_SESSION['auth'] = $user->id_utilisateur;
                $_SESSION['statut'] = $user->statut;
                return true;
            }
        } else {
            return false;
        }
    }

    public function logged()
    {
        return isset($_SESSION['auth']);
    }
}
