<!-- PHP File -->
<?php require_once(realpath(dirname(__FILE__)) . '/../templates/partials/recettes_partials/affichage_une_recette.php') ?>
<?php require_once(realpath(dirname(__FILE__)) . '/../templates/partials/recettes_partials/modal_recette.php') ?>

<section id="hero_2">
    <div class="hero-container" data-aos="fade-up">
        <h1 class="user-select-none"><?= $recette->nom ?></h1>
    </div>
</section>

<main id="main">
    <div class="pt-1 pb-100px bg-light">
        <div class="container">
            <div class="row mt-60px">
                <div class="col-lg-6 width_recette">
                    <div class="pb-0 bg-blue-dceaf8">
                        <div class="w-100">

                            <div class="w-100">
                                <img class="w-100 img-presentation rounded-3" src="../public/img/img_recettes/<?= $image ?>" style="background-color:<?= $couleur_dominante_img ?>" />
                                <?php if ($_SESSION) : ?>
                                    <a class="favori">
                                        <img src="../public/img/logos_icons/<?= $coeur_fav; ?>" alt="" id="favori_<?= $recette->id_recette; ?>" class="img_favori favori_img_<?= $recette->id_recette; ?>" onclick="ajout_suppression_favori(<?= $recette->id_recette; ?>);">
                                    </a>
                                <?php endif; ?>
                                <div class="bg-pink-ff2d6d position-absolute top-20 left-20 text-center height-30">
                                    <div class="d-block ps-3 pe-3 text-white line-height-33"><?= $type_biere ?></div>
                                </div>
                            </div>

                        </div>
                        <div class="pt-4 pb-2 bg-blue-dceaf8 text-center">
                            <div class="font-size-24px text-dark font-weight-600"><?= $recette->nom ?></div><br>
                        </div>


                        <!-- Informations générales de la recette -->
                        <div class="w-100 d-flex flex-wrap justify-content-between bg-linear-gradient rounded-3 mb-3">
                            <div class="w-100 bg-blue-335499 bg-gradient rounded-3 text-center">
                                <h4 class="text-white font-family_montserrat-semibold text-uppercase pt-3 px-2 user-select-none">Informations générales de la recette</h4>
                            </div>
                            <div class="w-100 d-flex flex-wrap justify-content-between rounded-3 px-3">
                                <div class="w-100 position-relative border rounded-3 mb-4 mt-4 bg-light p-responsive">
                                    <div class="d-flex flex-column">
                                        <div class="p-2 border-bottom_b0cfed">
                                            <div class="d-inline-block pe-3">
                                                <i class="fa fa-user font-size-30px"></i>
                                            </div>
                                            <span class="vertical-align-super"><b>Créateur de la Recette : </b></span>
                                            <span class="vertical-align-super"><?= $user->pseudo ?></span>
                                        </div>
                                        <div class="p-2 border-bottom_b0cfed">
                                            <div class="d-inline-block pe-3">
                                                <i class="fa fa-calendar font-size-30px"></i>
                                            </div>
                                            <span class="vertical-align-super"><b>Création :</b> Le <?= $date_creation ?></span>
                                        </div>
                                        <div class="p-2 border-bottom_b0cfed">
                                            <div class="d-inline-block pe-3">
                                                <i class="fa fa-edit font-size-30px"></i>
                                            </div>
                                            <span class="vertical-align-super"><b>Dernière modification : </b><?= $date_modification ?></span>
                                        </div>
                                        <div class="p-2 border-bottom_b0cfed">
                                            <div class="d-inline-block pe-3">
                                                <div class="d-inline-block">
                                                    <img src="../public/img/logos_icons/biere.png" alt="" class="recette_icones">
                                                </div>
                                            </div>
                                            <span class="vertical-align-super"><b>Type de bière : </b><?= $type_biere ?></span>
                                        </div>
                                        <div class="p-2 border-bottom_b0cfed">
                                            <div class="d-inline-block pe-3">
                                                <div class="d-inline-block">
                                                    <img src="../public/img/logos_icons/volume_recette.png" alt="" class="recette_icones">
                                                </div>
                                            </div>
                                            <span class="vertical-align-super"><b>Quantité de bière : </b><?= $quantite_biere ?></span>
                                        </div>
                                        <div class="p-2">
                                            <div class="d-inline-block pe-3">
                                                <div class="d-inline-block">
                                                    <img src="../public/img/logos_icons/temps_ebullition_recette.png" alt="" class="recette_icones">
                                                </div>
                                            </div>
                                            <span class="vertical-align-super"><b>Temps d'ébullition : </b><?= $temps_ebullition_biere ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="w-100 d-flex flex-wrap justify-content-between bg-linear-gradient rounded-3 mb-3">
                            <div class="w-100 bg-blue-335499 bg-gradient rounded-3 text-center">
                                <h4 class="text-white font-family_montserrat-semibold text-uppercase pt-3 px-2 user-select-none">Description</h4>
                            </div>
                            <div class="w-100 d-flex flex-wrap justify-content-between rounded-3 px-3">
                                <div class="w-100 position-relative border rounded-3 mb-4 mt-4 bg-light p-responsive">
                                    <?= $recette->description ?>
                                </div>
                            </div>
                        </div>

                        <!-- Céréales / Ingrédients et Houblons -->
                        <div class="d-flex flex-row bd-highlight mb-3 flex-wrap-responsive">
                            <!-- Céréales et Ingrédients -->
                            <div class="w-100 flex-wrap justify-content-between bg-linear-gradient rounded-3 div_recette_responsive">
                                <div class="w-100 bg-blue-335499 bg-gradient rounded-3 text-center heigth-fit-content">
                                    <h4 class="text-white font-family_montserrat-semibold text-uppercase pt-3 px-2 pb-2 user-select-none">Céréales et Ingrédients</h4>
                                </div>
                                <div class="w-100 d-flex flex-wrap justify-content-between rounded-3 px-3">
                                    <div class="w-100 position-relative border rounded-3 mb-4 mt-3 bg-light p-responsive-etroit">
                                        <div class="d-flex flex-column">
                                            <?php if (count($ingredient) == 0) : ?>
                                                <div class="alert alert-warning font-size-11px mb-0" role="alert">
                                                    Aucune céréale et aucun ingrédient spécifié.
                                                </div>
                                            <?php endif; ?>

                                            <?php for ($i = 0; $i < count($ingredient); $i++) : ?>
                                                <?php $class_ingredient = (count($ingredient) - 1 == $i) ? '' : 'border-bottom_b0cfed'; ?>
                                                <div class="p-2 <?= $class_ingredient ?>">
                                                    <div class="d-inline-block pe-2">
                                                        <div class="d-inline-block">
                                                            <img src="../public/img/logos_icons/ingredient_recette.png" alt="" class="recette_icones">
                                                        </div>
                                                    </div>
                                                    <span class="vertical-align-super"><?= $ingredient[$i]->quantite . " " . $ingredient[$i]->unite_mesure . " de <b>" . $ingredient[$i]->nom . "</b>" ?></span>
                                                </div>
                                            <?php endfor; ?>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="width-5_per_cent"></div>

                            <!-- Houblons -->
                            <div class="w-100 flex-wrap justify-content-between bg-linear-gradient rounded-3 div_recette_responsive">
                                <div class="w-100 bg-blue-335499 bg-gradient rounded-3 text-center heigth-fit-content">
                                    <h4 class="text-white font-family_montserrat-semibold text-uppercase pt-3 px-2 pb-2 user-select-none">Houblons</h4>
                                </div>
                                <div class="w-100 d-flex flex-wrap justify-content-between rounded-3 px-3">
                                    <div class="w-100 position-relative border rounded-3 mb-4 mt-3 bg-light p-responsive-etroit">
                                        <div class="d-flex flex-column">
                                            <?php if (count($houblon) == 0) : ?>
                                                <div class="alert alert-warning font-size-11px mb-0" role="alert">
                                                    Aucun houblon spécifié.
                                                </div>
                                            <?php endif; ?>

                                            <?php for ($i = 0; $i < count($houblon); $i++) : ?>
                                                <?php
                                                $class_houblon = (count($houblon) - 1 == $i) ? '' : 'border-bottom_b0cfed';
                                                $quantite_houblon = ($houblon[$i]->quantite < 2) ? $houblon[$i]->quantite . " gramme" : $houblon[$i]->quantite . " grammes";
                                                $temps_ebullition_houblon = ($houblon[$i]->temps_ebullition < 2) ? $houblon[$i]->temps_ebullition . " minute" : $houblon[$i]->temps_ebullition . " minutes";
                                                ?>
                                                <div class="pt-2 px-2 <?= $class_houblon ?>">
                                                    <table class="table border border-light">
                                                        <tbody class="align-middle">
                                                            <tr>
                                                                <td rowspan="3" class="width-0">
                                                                    <div class="d-inline-block pe-2">
                                                                        <div class="d-inline-block">
                                                                            <img src="../public/img/logos_icons/houblon_recette.png" alt="" class="recette_icones">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="p-0 font-size-11px"><?= $quantite_houblon . " de <b>" . $houblon[$i]->nom . "</b>" ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-0 font-size-11px">Acide-alpha : <?= $houblon[$i]->acide_alpha ?> %</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-0 font-size-11px">Temps d'ébullition : <?= $temps_ebullition_houblon ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php endfor; ?>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informations hydrométriques et Infusions -->
                        <div class="d-flex flex-row bd-highlight mb-3 flex-wrap-responsive">

                            <!-- Infusions -->
                            <div class="w-100 flex-wrap justify-content-between bg-linear-gradient rounded-3 div_recette_responsive">
                                <div class="w-100 bg-blue-335499 bg-gradient rounded-3 text-center heigth-fit-content">
                                    <h4 class="text-white font-family_montserrat-semibold text-uppercase pt-3 px-2 pb-2 user-select-none">Infusions</h4>
                                </div>
                                <div class="w-100 d-flex flex-wrap justify-content-between rounded-3 px-3">
                                    <div class="w-100 position-relative border rounded-3 mb-4 mt-3 bg-light p-responsive-etroit">
                                        <div class="d-flex flex-column">
                                            <?php if (count($infusion) == 0) : ?>
                                                <div class="alert alert-warning font-size-11px mb-0" role="alert">
                                                    Aucune infusion spécifiée.
                                                </div>
                                            <?php endif; ?>

                                            <?php for ($i = 0; $i < count($infusion); $i++) : ?>
                                                <?php
                                                $class_infusion = (count($infusion) - 1 == $i) ? '' : 'border-bottom_b0cfed';
                                                $temps_infusion = ($infusion[$i]->temps < 2) ? $infusion[$i]->temps . " minute" : $infusion[$i]->temps . " minutes";
                                                ?>
                                                <div class="pt-2 px-2 <?= $class_infusion ?>">
                                                    <table class="table border border-light">
                                                        <tbody>
                                                            <tr>
                                                                <th colspan=2 class="align-middle"><?= $infusion[$i]->nom ?></th>
                                                            </tr>
                                                            <tr class="border-bottom border-3">
                                                                <td class="align-middle py-1">Température de l'infusion :</td>
                                                                <td class="align-middle py-1"><?= $infusion[$i]->temperature ?> °C</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-middle py-1">Temps de l'infusion :</td>
                                                                <td class="align-middle py-1"><?= $temps_infusion ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php endfor; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="width-5_per_cent"></div>
                            <!-- Informations hydrométriques -->
                            <div class="w-100 flex-wrap justify-content-between bg-linear-gradient rounded-3 div_recette_responsive">
                                <div class="w-100 bg-blue-335499 bg-gradient rounded-3 text-center heigth-fit-content">
                                    <h4 class="text-white font-family_montserrat-semibold text-uppercase pt-3 px-2 pb-2 user-select-none">Informations hydrométriques</h4>
                                </div>
                                <div class="w-100 d-flex flex-wrap justify-content-between rounded-3 px-3">
                                    <div class="w-100 position-relative border rounded-3 mb-4 mt-3 bg-light p-responsive-etroit">
                                        <div class="d-flex flex-column">
                                            <div class="p-2">
                                                <table class="table border border-light">
                                                    <tbody>
                                                        <tr class="border-bottom_b0cfed">
                                                            <td class="align-middle">Densité de pré-ébullition :</td>
                                                            <td class="align-middle"><?= $densite_pe ?></td>
                                                        </tr>
                                                        <tr class="border-bottom_b0cfed">
                                                            <td class="align-middle">Densité d'après-ébullition :</td>
                                                            <td class="align-middle"><?= $densite_ae ?></td>
                                                        </tr>
                                                        <tr class="border-bottom_b0cfed">
                                                            <td class="align-middle">Densité lors du soutirage :</td>
                                                            <td class="align-middle"><?= $densite_soutirage ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="align-middle">Densité finale :</td>
                                                            <td class="align-middle"><?= $densite_finale ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <!-- Levure -->
                        <div class="w-100 d-flex flex-wrap justify-content-between bg-linear-gradient rounded-3 mb-3">
                            <div class="w-100 bg-blue-335499 bg-gradient rounded-3 text-center">
                                <h4 class="text-white font-family_montserrat-semibold text-uppercase pt-3 px-2 user-select-none">Levure</h4>
                            </div>
                            <div class="w-100 d-flex flex-wrap justify-content-between rounded-3 px-3">
                                <div class="w-100 position-relative border rounded-3 mb-4 mt-4 bg-light p-responsive">
                                    <div class="d-flex flex-column">
                                        <div class="p-2 border-bottom_b0cfed">
                                            <span class="vertical-align-super"><b>Nom de la Levure : </b></span>
                                            <span class="vertical-align-super"><?= $levure->nom ?></span>
                                        </div>
                                        <div class="p-2 border-bottom_b0cfed">
                                            <span class="vertical-align-super"><b>Atténuation moyenne de la Levure : </b></span>
                                            <span class="vertical-align-super"><?= $levure->attenuation_moyenne ?> %</span>
                                        </div>
                                        <div class="p-2 border-bottom_b0cfed">
                                            <span class="vertical-align-super"><b>Température optimale de la Levure : </b></span>
                                            <span class="vertical-align-super"><?= $levure->temperature_optimale ?> °C</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Statistiques Intéressantes -->
                        <div class="w-100 d-flex flex-wrap justify-content-between bg-linear-gradient rounded-top">
                            <div class="w-100 bg-blue-335499 bg-gradient rounded-3 text-center">
                                <h4 class="text-white font-family_montserrat-semibold text-uppercase pt-3 px-2 user-select-none">Statistiques Intéressantes</h4>
                            </div>
                            <div class="w-100 d-flex flex-wrap justify-content-between rounded-3 px-3">
                                <div class="w-50-50-30px position-relative border rounded-3 mb-4 mt-4 bg-light p-responsive">
                                    <div class="d-flex flex-column">
                                        <div class="">
                                            <table class="table border border-light">
                                                <tbody>
                                                    <tr class="border-bottom_b0cfed">
                                                        <td class="align-middle">Amertume (IBU) de la bière :</td>
                                                        <td class="align-middle"><?= $ibu_total ?></td>
                                                    </tr>
                                                    <tr class="border-bottom_b0cfed">
                                                        <td class="align-middle">Turbidité de la bière (EBC) :</td>
                                                        <td class="align-middle"><?= $ebc_total ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle">Couleur de bière attendue :</td>
                                                        <td class="align-middle font-size-10px"><?= $couleur_biere_hex ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="p-0">
                                                            <div class="pt-4 border border-2" style="background-color:<?= $couleur_biere_hex ?>"></div>
                                                            <div class="alert alert-warning mt-2 font-size-11px" role="alert">
                                                                <b>Attention</b> : En fonction des ingrédients ajoutés, la couleur de la bière peut varier.
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-50-50-30px position-relative border rounded-3 mb-4 mt-4 bg-light p-responsive">
                                    <div class="d-flex flex-column">
                                        <div class="">
                                            <table class="table border border-light">
                                                <tbody>
                                                    <tr class="border-bottom_b0cfed">
                                                        <td class="align-middle">Densité initiale attendue (OG) :</td>
                                                        <td class="align-middle"><?= $og ?></td>
                                                    </tr>
                                                    <tr class="border-bottom_b0cfed">
                                                        <td class="align-middle">Densité finale attendue (FG) :</td>
                                                        <td class="align-middle"><?= $fg ?></td>
                                                    </tr>
                                                    <tr class="border-bottom_b0cfed">
                                                        <td class="align-middle">Taux d'alcool attendu (ABV) :</td>
                                                        <td class="align-middle"><?= $abv_attendu . " %" ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle">Taux d'alcool réel (ABV) :</td>
                                                        <td class="align-middle"><?= $abv_reel . " %" ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons "Modification" et "Suppression" -->
                        <?php if (!(empty($_SESSION)) && $_SESSION['auth'] == $recette->id_utilisateur) : ?>

                            <div class="text-white d-flex justify-content-around align-items-center flex-wrap w-100 height-50 bg-_dark_grey">
                                <div class="h-100 w-100">
                                    <a href="?p=user.recettes.modifier&id_recette=<?= $recette->id_recette ?>">
                                        <button class="h-100 w-50 h6 border-0 font-weight-600 bg-green-74bb4f text-white">Modifier la recette</button>
                                    </a>
                                </div>
                                <div class="h-100 w-100 position-absolute start-50">
                                    <a class="suppA">
                                        <button class="h-100 w-50 h6 border-0 btn-danger font-weight-600" id="btn_supp_recette" data-bs-toggle="modal" data-bs-target="#modal_confirm" onclick="modal_del_recette_change_onclick(<?= $recette->id_recette; ?>, 'une recette')">Supprimer la recette</button>
                                    </a>
                                </div>
                            </div>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Gestion des favoris -->
<script src="js/gestion_favoris_recette.js"></script>

<!-- Modal -->
<?= modal_confirm("persos"); ?>

<!-- Gestion de la suppression d'une recette (Modal) -->
<script src="js/modal_gestion_suppression_recette.js"></script>