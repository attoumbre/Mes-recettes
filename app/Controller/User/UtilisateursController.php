<?php

namespace App\Controller\User;

use Core\HTML\BootstrapForm;
use Core\Auth\DBAuth;
use \App;

class UtilisateursController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Utilisateur');
    }

    /**
     * Page de Profil de l'utilisateur
     */
    public function show()
    {
        if (isset($_SESSION['statut']) && !empty($_SESSION['statut'])) {
            // On recupere les donnees
            $profils = $this->Utilisateur->findUsers($_SESSION['auth']);

            // Formulaire
            $form = new BootstrapForm($_POST);

            //titre de la page
            $titre_page = 'Mon profil';

            $this->render('user.utilisateurs.show', compact('titre_page', 'form', 'profils'));
        }
    }

    /**
     *  Modification du pseudo
     */
    public function modifier_pseudo()
    {
        if (isset($_SESSION['statut']) && !empty($_SESSION['statut'])) {
            $erreur_pseudo = "";
            $result = false;
            if (!empty($_POST) && isset($_POST['pseudo'])) {

                $pseudo = $_POST['pseudo'];
                if (strlen($pseudo) >= 5 && strlen($pseudo) <= 24) {

                    // Récupération de tous les utilisateurs
                    $users = $this->Utilisateur->all();

                    // Vérification d'unicité de l'identifiant
                    foreach ($users as $user) {
                        if ($user->pseudo == $pseudo) {
                            $erreur_pseudo = "erreur_unicite";
                        }
                    }
                    if ($erreur_pseudo == "") {
                        // Modifer pseudo
                        $result = $this->Utilisateur->update('id_utilisateur', $_SESSION['auth'], [
                            'pseudo' => $pseudo
                        ]);
                    }
                } else {
                    $erreur_pseudo = "erreur_longueur";
                }
                echo $erreur_pseudo;
            }
        }
    }

   /**
    *  Modification du mot de passe
    */
    public function modifier_mdp()
    {
        if (isset($_SESSION['statut']) && !empty($_SESSION['statut'])) {
            $erreur_mdp = "";
            $result = false;
            if (!empty($_POST) && isset($_POST['ancien_mdp']) && isset($_POST['nouveau_mdp']) && isset($_POST['confirm_nouveau_mdp'])) {
                $ancien_mdp = $_POST['ancien_mdp'];
                $nouveau_mdp = $_POST['nouveau_mdp'];
                $confirm_nouveau_mdp = $_POST['confirm_nouveau_mdp'];

                // Récupération de l'utilisateur connecté
                $utilisateur = $this->Utilisateur->findUsers($_SESSION['auth']);

                if (sha1($ancien_mdp) == $utilisateur->mdp) {
                    // Vérification de la longueur du mdp
                    if (strlen($nouveau_mdp) >= 5 && strlen($nouveau_mdp) <= 24) {
                        // Vérification de la confirmation du mdp
                        if ($nouveau_mdp == $confirm_nouveau_mdp) {
                            // Modifier mdp
                            $result = $this->Utilisateur->update('id_utilisateur', $_SESSION['auth'], [
                                'mdp' => sha1($nouveau_mdp)
                            ]);
                        } else {
                            $erreur_mdp = "erreur_confirmation_mdp";
                        }
                    } else {
                        $erreur_mdp = "erreur_longueur";
                    }
                } else {
                    $erreur_mdp = "erreur_ancien_mdp";
                }
                echo $erreur_mdp;
            }
        }
    }
}
