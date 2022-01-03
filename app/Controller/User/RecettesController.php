<?php

namespace App\Controller\User;

use App\Controller\HomeController;

use Core\HTML\Forms;
use Core\HTML\BootstrapForm;


class RecettesController extends AppController
{
    protected $id_recette;
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Houblon');
        $this->loadModel('Recette');
        $this->loadModel('Ingredient');
        $this->loadModel('Quantites_ingredient');
        $this->loadModel('Quantites_houblon');
        $this->loadModel('Levure');
        $this->loadModel('Infusion');
    }

    /**
     * suppression des infos liées à la recette 
     */
    public function delete()
    {
        if (isset($_SESSION['statut']) && !empty($_SESSION['statut'])) {
            if (!empty($_POST)) {
                //suppression des ingredients associés
                $ingredient = $this->Quantites_ingredient->findQ($_POST['id_recette']);
                if (!empty($ingredient)) {
                    for ($i = 0; $i < sizeof($ingredient); $i++) {
                        $this->Quantites_ingredient->delete($ingredient[$i]->id_quantite_ingredient, 'id_quantite_ingredient');
                    }
                }
                //suppression des houblons associés
                $houblon = $this->Quantites_houblon->findH($_POST['id_recette']);
                if (!empty($houblon)) {
                    for ($i = 0; $i < sizeof($houblon); $i++) {
                        $this->Quantites_houblon->delete($houblon[$i]->id_quantite_houblon, 'id_quantite_houblon');
                    }
                }
                //suppression de la levure associés
                $levure = $this->Levure->findL($_POST['id_recette']);
                if (!empty($levure)) {
                    $this->Levure->delete($levure[0]->id_levure, "id_levure");
                }
                //suppression des infusions associés
                $infusion = $this->Infusion->findI($_POST['id_recette']);
                if (!empty($infusion)) {
                    for ($i = 0; $i < sizeof($infusion); $i++) {
                        $this->Infusion->delete($infusion[$i]->id_infusion, "id_infusion");
                    }
                }

                //suppression dans les favoris
                $this->loadModel('Favori');
                $favori = $this->Favori->findF($_POST['id_recette']);
                if (!empty($favori)) {
                    for ($i = 0; $i < sizeof($favori); $i++) {
                        $this->Favori->delete($favori[$i]->id_favori, "id_favori");
                    }
                }

                //recuperer image
                $image = $this->Recette->getImage($_POST['id_recette']);
                //supprimer l'image si ce n'est pas l'image par defaut
                if ($image[0]->image != 'img_recettes_default.jpg') {
                    //supprimer image
                    unlink("../public/img/img_recettes/" . $image[0]->image);
                }

                //suppression de la recette
                $this->Recette->delete($_POST['id_recette'], 'id_recette');
            }
            return $this->perso();
        }
    }

    /**
     * Recettes créées par l'utilisateur
     */
    public function perso()
    {
        if (isset($_SESSION['statut']) && !empty($_SESSION['statut'])) {

            $countPerso = $this->Recette->recettePersoCount($_SESSION['auth']);
            $nbPerso = $countPerso[0]->perso;

            // Page courante
            (!isset($_GET['page'])) ? $page_courante = 1 : $page_courante = $_GET['page'];

            // Nombre de recettes par page
            $parPage = 4;

            // Nombre de pages de recettes total
            $nbPages = ceil($nbPerso / $parPage);

            // Calcul de la première recette de la page
            $premier = ($page_courante * $parPage) - $parPage;

            // On récupère les données
            $recettes = $this->Recette->perso($_SESSION['auth'], $premier, $parPage);
            //$id_recette= $recettes->id_recette;
            $this->loadModel('Favori');

            //titre de la page
            $titre_page = 'Mes recettes';
            $this->render('user.recettes.perso', compact('titre_page', 'recettes', 'nbPerso', 'nbPages', 'parPage'));
        }
    }

    /**
     * Création d'une recette par l'utilisateur
     */
    public function creer()
    {

        //verification des infos nécessaire pour creation de recette
        if (BootstrapForm::validate($_POST, [
            'titre', 'type_biere', 'quantite_biere', 'temps_ebullition'
        ])) {


            $tab_ingredient = [];
            $tab_houblon = [];
            $tab_infusion = [];


            //gestion de l'image
            if (!empty($_FILES) && isset($_FILES['image_recette']) && ($_FILES['image_recette']['type'] == 'image/png' || $_FILES['image_recette']['type'] == 'image/jpeg')) {
                $type_image = substr($_FILES['image_recette']['type'], 6, strlen($_FILES['image_recette']['type']));
                $nom_image = $_SESSION['auth'] . '-' . date("Ymdhis") . '.' . $type_image;
                $tempo_photo = $_FILES['image_recette']['tmp_name'];
                move_uploaded_file($tempo_photo, "./img/img_recettes/$nom_image");
            } else {
                $nom_image = "img_recettes_default.jpg";
            }

            //recuperation des valeurs du POST
            $titre = strip_tags($_POST['titre']);
            $description = strip_tags($_POST['description']);
            $datecrea =  date("Y/m/d H:i:s");
            $datemodif =  date("Y/m/d H:i:s");
            $type_biere = strip_tags($_POST['type_biere']);
            $quantite_biere = strip_tags($_POST['quantite_biere']);
            $gravite_s = strip_tags($_POST['gravite_s']);
            $gravite_pe = strip_tags($_POST['gravite_pe']);
            $gravite_ae = strip_tags($_POST['gravite_ae']);
            $gravite_f = strip_tags($_POST['gravite_f']);
            $temps_ebulition = strip_tags($_POST['temps_ebullition']);

            $type_levure = strip_tags($_POST['type_levure']);
            $avg_attenuation_levure = strip_tags($_POST['avg_attenuation_levure']);
            $temperature_optimale_levure = strip_tags($_POST['temperature_optimale_levure']);


            //verification des info du tableau des ingredients
            if (BootstrapForm::validate($_POST, ['ingredients', 'ingredients_quantite', 'ingredients_unite'])) {

                for ($i = 0; $i < sizeof($_POST['ingredients']); $i++) {
                    $tab_ingredient[] = [
                        'quantite' => $_POST['ingredients_quantite'][$i],
                        'unite_mesure' => $_POST['ingredients_unite'][$i],
                        'nom' => $_POST['ingredients'][$i]
                    ];
                }
            }
            //verification du tableau houblon
            if (BootstrapForm::validate($_POST, ['houblons', 'houblons_quantite', 'houblons_taux_aa', 'houblons_temps_ebullition'])) {
                for ($i = 0; $i < sizeof($_POST['houblons']); $i++) {
                    $tab_houblon[] = [
                        'quantite' => $_POST['houblons_quantite'][$i],
                        'acide_alpha' => $_POST['houblons_taux_aa'][$i],
                        'temps_ebullition' => $_POST['houblons_temps_ebullition'][$i],
                        'nom' => $_POST['houblons'][$i]
                    ];
                }
            }

            //verification du tableau infusion
            if (BootstrapForm::validate($_POST, ['infusion_nom', 'infusion_temperature', 'infusion_temps'])) {
                for ($i = 0; $i < sizeof($_POST['infusion_nom']); $i++) {
                    $tab_infusion[] = [
                        'nom' => $_POST['infusion_nom'][$i],
                        'temperature' => $_POST['infusion_temperature'][$i],
                        'temps' => $_POST['infusion_temps'][$i]

                    ];
                }
            }



            //creer recette 
            $result = $this->Recette->create([
                'nom' =>  $titre,
                'description' =>  $description,
                'image' =>  $nom_image,
                'date_creation' =>  $datecrea,
                'date_modification' =>   $datemodif,
                'quantite' =>  $quantite_biere,
                'temps_ebullition' =>  $temps_ebulition,
                'type_biere' =>  $type_biere,
                'gravite_pre_ebullition' =>  $gravite_pe,
                'gravite_apres_ebullition' => $gravite_ae,
                'gravite_soutirage' =>  $gravite_s,
                'gravite_finale' =>  $gravite_f,
                'id_utilisateur' =>  $_SESSION['auth']

            ]);
            //recuperer l'id de la recette créée 
            $id_recette = $this->Recette->lastInsertID();

            $levure = $this->Levure->create([
                'nom' =>  $type_levure,
                'attenuation_moyenne' =>  $avg_attenuation_levure,
                'temperature_optimale' =>  $temperature_optimale_levure,
                'id_recette' =>  $id_recette
            ]);
            //creation de qtte ingredient
            $this->insertionIngredient($tab_ingredient, $id_recette);
            //creation de qtte ingredient
            $this->insertionHoublon($tab_houblon, $id_recette);
            //creation de infusion
            $this->insertionInfusion($tab_infusion, $id_recette);

            header('Location: ?p=user.recettes.perso');
            exit;
        }

        $ingredients = $this->Ingredient->extract('id_ingredient', 'nom', ['orderBy' => 'nom', 'order' => 'ASC']);
        $ingredients_sebc = $this->Ingredient->extract('id_ingredient', 'sebc', ['orderBy' => 'nom', 'order' => 'ASC']);
        $ingredients_ppg = $this->Ingredient->extract('id_ingredient', 'ppg', ['orderBy' => 'nom', 'order' => 'ASC']);
        $houblons = $this->Houblon->extract('id_houblon', 'nom', ['orderBy' => 'nom', 'order' => 'ASC']);
        $form = new BootstrapForm($_POST);
        //titre de la page
        $titre_page = 'Créer une recette';

        $this->render('user.recettes.creer', compact('titre_page', 'form', 'ingredients', 'ingredients_sebc', 'ingredients_ppg', 'houblons'));
    }

    /**
     *  Modification d'une recette par l'utilisateur
     */
    public function modifier()
    {

        if (!empty($_POST)) {


            $tab_ingredient = [];
            $tab_houblon = [];
            $tab_infusion = [];
            $id_recette = $_GET['id_recette'];

            // GESTION IMAGE
            // Si une nouvelle image a été envoyée, l'enregistrer
            if (!empty($_FILES) && isset($_FILES['image_recette']) && ($_FILES['image_recette']['type'] == 'image/png' || $_FILES['image_recette']['type'] == 'image/jpeg')) {
                $type_image = substr($_FILES['image_recette']['type'], 6, strlen($_FILES['image_recette']['type']));
                $nom_image = $_SESSION['auth'] . '-' . date("Ymdhis") . '.' . $type_image;
                $tempo_photo = $_FILES['image_recette']['tmp_name'];
                move_uploaded_file($tempo_photo, "./img/img_recettes/$nom_image");
            }
            // Sinon si l'image n'a pas été modifiée, garder le même nom de l'image
            elseif ($_POST['etat_ancienne_image'] == "presente") {
                $nom_image = $_POST['ancienne_image'];
            }
            // Sinon, mettre le nom de l'image par défaut
            else {
                $nom_image = "img_recettes_default.jpg";
            }

            // Si l'ancienne image a été modifiée, elle est supprimée
            if ($_POST['etat_ancienne_image'] == "absente" && $_POST['ancienne_image'] != "img_recettes_default.jpg") {
                // Supprimer l'image
                unlink("../public/img/img_recettes/" . $_POST['ancienne_image']);
            }

            //recuperation des valeurs du POST
            $titre = strip_tags($_POST['titre']);
            $description = strip_tags($_POST['description']);
            $datemodif =  date("Y/m/d H:i:s");
            $type_biere = strip_tags($_POST['type_biere']);
            $quantite_biere = strip_tags($_POST['quantite_biere']);
            $gravite_s = strip_tags($_POST['gravite_s']);
            $gravite_pe = strip_tags($_POST['gravite_pe']);
            $gravite_ae = strip_tags($_POST['gravite_ae']);
            $gravite_f = strip_tags($_POST['gravite_f']);
            $temps_ebulition = strip_tags($_POST['temps_ebullition']);

            $type_levure = strip_tags($_POST['type_levure']);
            $avg_attenuation_levure = strip_tags($_POST['avg_attenuation_levure']);
            $temperature_optimale_levure = strip_tags($_POST['temperature_optimale_levure']);

            if (BootstrapForm::validate($_POST, ['ingredients', 'ingredients_quantite', 'ingredients_unite'])) {

                for ($i = 0; $i < sizeof($_POST['ingredients']); $i++) {
                    $tab_ingredient[] = [
                        'quantite' => $_POST['ingredients_quantite'][$i],
                        'unite_mesure' => $_POST['ingredients_unite'][$i],
                        'nom' => $_POST['ingredients'][$i]
                    ];
                }
            }

            //verification du tableau houblon
            if (BootstrapForm::validate($_POST, ['houblons', 'houblons_quantite', 'houblons_taux_aa', 'houblons_temps_ebullition'])) {
                for ($i = 0; $i < sizeof($_POST['houblons']); $i++) {
                    $tab_houblon[] = [
                        'quantite' => $_POST['houblons_quantite'][$i],
                        'acide_alpha' => $_POST['houblons_taux_aa'][$i],
                        'temps_ebullition' => $_POST['houblons_temps_ebullition'][$i],
                        'nom' => $_POST['houblons'][$i]
                    ];
                }
            }

            //verification du tableau infusion
            if (BootstrapForm::validate($_POST, ['infusion_nom', 'infusion_temperature', 'infusion_temps'])) {
                for ($i = 0; $i < sizeof($_POST['infusion_nom']); $i++) {
                    $tab_infusion[] = [
                        'nom' => $_POST['infusion_nom'][$i],
                        'temperature' => $_POST['infusion_temperature'][$i],
                        'temps' => $_POST['infusion_temps'][$i]

                    ];
                }
            }
            //var_dump($tab_houblon);

            $result = $this->Recette->update('id_recette', $id_recette, [
                'nom' => $titre,
                'description' => $description,
                'image' => $nom_image,
                'date_modification' => $datemodif,
                'quantite' => $quantite_biere,
                'temps_ebullition' => $temps_ebulition,
                'type_biere' => $type_biere,
                'gravite_pre_ebullition' => $gravite_pe,
                'gravite_apres_ebullition' => $gravite_ae,
                'gravite_soutirage' => $gravite_s,
                'gravite_finale' => $gravite_f,
                'id_utilisateur' => $_SESSION['auth']
            ]);

            $levure = $this->Levure->update('id_recette', $id_recette, [
                'nom' =>  $type_levure,
                'attenuation_moyenne' =>  $avg_attenuation_levure,
                'temperature_optimale' =>  $temperature_optimale_levure,
                'id_recette' =>  $id_recette
            ]);

            //modif de qtte ingredient
            $this->modifIngredient($tab_ingredient, $id_recette);
            //modif de qtte ingredient
            $this->modifHoublon($tab_houblon, $id_recette);
            //modif de infusion
            $this->modifInfusion($tab_infusion, $id_recette);

            header('Location: ?p=recettes.show&id_recette=' . $id_recette);
            exit;
        }
        $recette = $this->Recette->find($_GET['id_recette'], 'id_recette');
        //empeche les autres utilisateurs de modifier les recettes des autres a partir de l'url

        if ($recette->id_utilisateur == $_SESSION['auth']) {
            $ingredients = $this->Ingredient->extract('id_ingredient', 'nom', ['orderBy' => 'nom', 'order' => 'ASC']);
            $ingredients_sebc = $this->Ingredient->extract('id_ingredient', 'sebc', ['orderBy' => 'nom', 'order' => 'ASC']);
            $ingredients_ppg = $this->Ingredient->extract('id_ingredient', 'ppg', ['orderBy' => 'nom', 'order' => 'ASC']);
            $houblons = $this->Houblon->extract('id_houblon', 'nom', ['orderBy' => 'nom', 'order' => 'ASC']);
            $quantite_ingredient = $this->Quantites_ingredient->findQ($_GET['id_recette'], true);
            $quantite_houblon = $this->Quantites_houblon->findH($_GET['id_recette'], true);
            $infusion = $this->Infusion->findI($_GET['id_recette']);
            $levure = $this->Levure->findL($_GET['id_recette'])[0];
            $tab = [];

            $tab[] = [
                'id_recette' => $recette->id_recette,
                'titre' => $recette->nom,
                'type_biere' => $recette->type_biere,
                'quantite_biere' => $recette->quantite,
                'temps_ebullition' => $recette->temps_ebullition,
                'description' => $recette->description,
                'image_recette' => $recette->image,
                'gravite_pe' => $recette->gravite_pre_ebullition,
                'gravite_ae' => $recette->gravite_apres_ebullition,
                'gravite_s' => $recette->gravite_soutirage,
                'gravite_f' => $recette->gravite_finale

            ];

            $form = new BootstrapForm($tab);
            //titre de la page
            $titre_page = 'Modifier une recette';

            $this->render('user.recettes.creer', compact('titre_page', 'recette', 'form', 'ingredients_sebc', 'ingredients_ppg', 'ingredients', 'houblons', 'quantite_ingredient', 'quantite_houblon', 'infusion', 'levure'));
        } else {
            $this->forbidden();
        }
    }


    /**
     * modification de l'ingredient de la recette
     * @param $id_recette, l'id de la recette à modifier
     * @param $tab, les info envoyés par le $_POST
     */
    public function modifIngredient($tab, $id_recette)
    {

        $ingredient = $this->Quantites_ingredient->findQ($id_recette);

        if ($ingredient) {
            if (sizeof($ingredient) == sizeof($tab)) {
                for ($i = 0; $i < sizeof($ingredient); $i++) {

                    $this->Quantites_ingredient->update('id_quantite_ingredient', $ingredient[$i]->id_quantite_ingredient, [
                        'quantite' => $tab[$i]['quantite'],
                        'unite_mesure' =>  $tab[$i]['unite_mesure'],
                        'id_recette' =>  $id_recette,
                        'id_ingredient' => $tab[$i]['nom']

                    ]);
                }
            } elseif (sizeof($ingredient) > sizeof($tab)) {
                for ($i = 0; $i < sizeof($ingredient); $i++) {

                    if ($i < sizeof($tab)) {
                        $this->Quantites_ingredient->update('id_quantite_ingredient', $ingredient[$i]->id_quantite_ingredient, [
                            'quantite' => $tab[$i]['quantite'],
                            'unite_mesure' =>  $tab[$i]['unite_mesure'],
                            'id_recette' =>  $id_recette,
                            'id_ingredient' => $tab[$i]['nom']

                        ]);
                    } else {
                        $this->Quantites_ingredient->delete($ingredient[$i]->id_quantite_ingredient, 'id_quantite_ingredient');
                    }
                }
            } else {
                for ($i = 0; $i < sizeof($tab); $i++) {

                    if ($i < sizeof($ingredient)) {
                        $this->Quantites_ingredient->update('id_quantite_ingredient', $ingredient[$i]->id_quantite_ingredient, [
                            'quantite' => $tab[$i]['quantite'],
                            'unite_mesure' =>  $tab[$i]['unite_mesure'],
                            'id_recette' =>  $id_recette,
                            'id_ingredient' => $tab[$i]['nom']
                        ]);
                    } else {
                        $this->Quantites_ingredient->create([
                            'quantite' => $tab[$i]['quantite'],
                            'unite_mesure' =>  $tab[$i]['unite_mesure'],
                            'id_recette' =>  $id_recette,
                            'id_ingredient' => $tab[$i]['nom']
                        ]);
                    }
                }
            }
        } else {
            $this->insertionIngredient($tab, $id_recette);
        }
    }


    /**
     * Modification de l'houblon
     * @param $id_recette, l'id de la recette à modifier
     * @param $tab, les info envoyés par le $_POST
     */
    public function modifHoublon($tab, $id_recette)
    {

        $houblon = $this->Quantites_houblon->findH($id_recette);

        if ($houblon) {
            if (sizeof($houblon) == sizeof($tab)) {
                for ($i = 0; $i < sizeof($houblon); $i++) {

                    $this->Quantites_houblon->update('id_quantite_houblon', $houblon[$i]->id_quantite_houblon, [
                        'quantite' => $tab[$i]['quantite'],
                        'acide_alpha' =>  $tab[$i]['acide_alpha'],
                        'temps_ebullition' => $tab[$i]['temps_ebullition'],
                        'id_houblon' => $tab[$i]['nom'],
                        'id_recette' => $id_recette
                    ]);
                }
            } elseif (sizeof($houblon) > sizeof($tab)) {
                for ($i = 0; $i < sizeof($houblon); $i++) {

                    if ($i < sizeof($tab)) {

                        $this->Quantites_houblon->update('id_quantite_houblon', $houblon[$i]->id_quantite_houblon, [
                            'quantite' => $tab[$i]['quantite'],
                            'acide_alpha' =>  $tab[$i]['acide_alpha'],
                            'temps_ebullition' => $tab[$i]['temps_ebullition'],
                            'id_houblon' => $tab[$i]['nom'],
                            'id_recette' => $id_recette
                        ]);
                    } else {
                        $this->Quantites_houblon->delete($houblon[$i]->id_quantite_houblon, 'id_quantite_houblon');
                    }
                }
            } else {
                for ($i = 0; $i < sizeof($tab); $i++) {

                    if ($i < sizeof($houblon)) {
                        $this->Quantites_houblon->update('id_quantite_houblon', $houblon[$i]->id_quantite_houblon, [
                            'quantite' => $tab[$i]['quantite'],
                            'acide_alpha' =>  $tab[$i]['acide_alpha'],
                            'temps_ebullition' => $tab[$i]['temps_ebullition'],
                            'id_houblon' => $tab[$i]['nom'],
                            'id_recette' => $id_recette

                        ]);
                    } else {
                        $this->Quantites_houblon->create([
                            'quantite' => $tab[$i]['quantite'],
                            'acide_alpha' =>  $tab[$i]['acide_alpha'],
                            'temps_ebullition' => $tab[$i]['temps_ebullition'],
                            'id_houblon' => $tab[$i]['nom'],
                            'id_recette' => $id_recette
                        ]);
                    }
                }
            }
        } else {
            $this->insertionHoublon($tab, $id_recette);
        }
    }

    /**
     * Modification de l'infusion
     * @param $id_recette, l'id de la recette à modifier
     * @param $tab, les info envoyés par le $_POST
     */
    public function modifInfusion($tab, $id_recette)
    {

        $infusion = $this->Infusion->findI($id_recette);

        if ($infusion) {
            if (sizeof($infusion) == sizeof($tab)) {
                for ($i = 0; $i < sizeof($infusion); $i++) {
                    $this->Infusion->update('id_infusion', $infusion[$i]->id_infusion, [
                        'nom' => $tab[$i]['nom'],
                        'temperature' =>  $tab[$i]['temperature'],
                        'temps' =>  $tab[$i]['temps'],
                        'id_recette' =>  $id_recette
                    ]);
                }
            } elseif (sizeof($infusion) > sizeof($tab)) {
                for ($i = 0; $i < sizeof($infusion); $i++) {

                    if ($i < sizeof($tab)) {

                        $this->Infusion->update('id_infusion', $infusion[$i]->id_infusion, [
                            'nom' => $tab[$i]['nom'],
                            'temperature' =>  $tab[$i]['temperature'],
                            'temps' =>  $tab[$i]['temps'],
                            'id_recette' =>  $id_recette
                        ]);
                    } else {
                        $this->Infusion->delete($infusion[$i]->id_infusion, 'id_infusion');
                    }
                }
            } else {
                for ($i = 0; $i < sizeof($tab); $i++) {

                    if ($i < sizeof($infusion)) {
                        $this->Infusion->update('id_infusion', $infusion[$i]->id_infusion, [
                            'nom' => $tab[$i]['nom'],
                            'temperature' =>  $tab[$i]['temperature'],
                            'temps' =>  $tab[$i]['temps'],
                            'id_recette' =>  $id_recette
                        ]);
                    } else {
                        $this->Infusion->create([
                            'nom' => $tab[$i]['nom'],
                            'temperature' =>  $tab[$i]['temperature'],
                            'temps' =>  $tab[$i]['temps'],
                            'id_recette' =>  $id_recette

                        ]);
                    }
                }
            }
        } else {
            $this->insertionInfusion($tab, $id_recette);
        }
    }

    /**
     * creation des ingredients
     * @param $id_recette, l'id de la recette crée
     * @param $tab, les info envoyés par le $_POST
     */
    public function insertionIngredient($tab, $id_recette)
    {
        foreach ($tab as $champ) {
            $this->Quantites_ingredient->create([
                'quantite' =>  $champ['quantite'],
                'unite_mesure' =>  $champ['unite_mesure'],
                'id_recette' =>  $id_recette,
                'id_ingredient' =>  $champ['nom']
            ]);
        }
    }

    /**
     * creation des houblons
     * @param $id_recette, l'id de la recette crée
     * @param $tab, les info envoyés par le $_POST
     */
    public function insertionHoublon($tab, $id_recette)
    {
        foreach ($tab as $champ) {
            $this->Quantites_houblon->create([
                'quantite' =>  $champ['quantite'],
                'acide_alpha' =>  $champ['acide_alpha'],
                'temps_ebullition' => $champ['temps_ebullition'],
                'id_houblon' =>  $champ['nom'],
                'id_recette' =>  $id_recette

            ]);
        }
    }

    /**
     * creation des infusions
     * @param $id_recette, l'id de la recette crée
     * @param $tab, les info envoyés par le $_POST
     */
    public function insertionInfusion($tab, $id_recette)
    {
        foreach ($tab as $champ) {
            $this->Infusion->create([
                'nom' =>  $champ['nom'],
                'temperature' =>  $champ['temperature'],
                'temps' =>  $champ['temps'],
                'id_recette' =>  $id_recette
            ]);
        }
    }
}
