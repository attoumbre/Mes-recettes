<?php

namespace App\Controller;

use \App;
use Core\Auth\DBAuth;
use Core\HTML\BootstrapForm;

class UtilisateursController extends AppController
{
    protected $template = 'connexion_inscription';

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Utilisateur');
    }

    // Rédiriger si une session est déjà ouverte
    private function redirection()
    {
        if (isset($_SESSION['auth'])) {
            header('Location: index.php?p=home.index');
        }
    }

    // Page de connexion
    public function connexion()
    {
        $this->redirection();

        $infos_input = ["email" => ""];
        $errors = false;
        if (!empty($_POST)) {
            $auth = new DBAuth(App::getInstance()->getDb());
            if ($auth->login($_POST['email'], $_POST['mdp'])) {
                header('Location: index.php?p=home.index');
            } else {
                $errors = true;
                $infos_input["email"] = $_POST['email'];
            }
        }
        $form = new BootstrapForm($_POST);
        //titre de la page
        $titre_page = 'Connexion';
        $this->render('utilisateurs.connexion', compact('titre_page', 'form', 'infos_input', 'errors'));
    }

    // Page d'inscription
    public function inscription()
    {
        $this->redirection();

        $infos_input = ["email" => "", "pseudo" => "", "date_naissance" => ""];
        $error_inscription = '';
        if (!empty($_POST)) {

            do {
                // Vérification de l'âge de l'individu
                $date_aujourdhui = date("Y-m-d");
                $age = date_diff(date_create($_POST['date_naissance']), date_create($date_aujourdhui))->format('%y');
                if ($age < 18) {
                    $error_inscription = 'age';
                    break;
                }

                // Vérification d'unicité de l'adresse Email
                $users = $this->Utilisateur->all();
                foreach ($users as $user) {
                    if ($user->email == $_POST['email']) {
                        $error_inscription = 'email';
                        break;
                    }
                }
                if ($error_inscription != '') {
                    break;
                }

                // Vérification d'unicité de l'identifiant
                foreach ($users as $user) {
                    if ($user->pseudo == $_POST['pseudo']) {
                        $error_inscription = 'pseudo';
                        break;
                    }
                }
                if ($error_inscription != '') {
                    break;
                }

                // Vérification du mot de passe
                if ($_POST['mdp'] != $_POST['confirm_mdp']) {
                    $error_inscription = 'mdp';
                    break;
                }

                // Ajout de l'utilisateur
                $result = $this->Utilisateur->create([
                    'email' => $_POST['email'],
                    'pseudo' => $_POST['pseudo'],
                    'date_naissance' => $_POST['date_naissance'],
                    'mdp' => sha1($_POST['mdp']),
                    'statut' => 'user'
                ]);

                // Redirection vers la page de connexion
                if ($result) {
                    header('Location: index.php?p=utilisateurs.connexion&confirm=inscription');
                }
            } while (0);

            $infos_input["email"] = $_POST['email'];
            $infos_input["pseudo"] = $_POST['pseudo'];
            $infos_input["date_naissance"] = $_POST['date_naissance'];
        }
        $form = new BootstrapForm($_POST);
        //titre de la page
        $titre_page = 'Inscription';
        $this->render('utilisateurs.inscription', compact('titre_page', 'form', 'infos_input', 'error_inscription'));
    }

    public function deconnexion()
    {
        if (!empty($_POST)) {
            session_destroy();
            header('Location: index.php?p=utilisateurs.connexion');
            exit;
        }
    }
}
