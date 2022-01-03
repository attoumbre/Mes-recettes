<!-- PHP File -->
<?php require_once(realpath(dirname(__FILE__)) . '/../../templates/partials/utilisateurs_partials/modal_utilisateur.php') ?>

<section id="hero_2">
    <div class="hero-container" data-aos="fade-up">
        <h1 class="user-select-none">Mon profil</h1>
    </div>
</section>

<main id="main">
    <div class="pt-1 pb-100px bg-light">
        <div class="container">
            <div class="row mt-60px">
                <div class="col-lg-6 width_recette">
                    <div class="pb-0 bg-blue-dceaf8">

                        <div class="pt-4 pb-2 bg-blue-dceaf8 text-center">
                            <i class="fa fa-user-circle font-size-150px mb-3" aria-hidden="true"></i>
                        </div>


                        <!-- Informations personnelles de l'utilisateur -->
                        <div class="w-100 d-flex flex-wrap justify-content-between bg-linear-gradient rounded-3 mb-3">
                            <div class="w-100 bg-blue-335499 bg-gradient rounded-3 text-center">
                                <h4 class="text-white font-family_montserrat-semibold text-uppercase pt-3 px-2 user-select-none">Vos Informations Personnelles</h4>
                            </div>
                            <div class="w-100 d-flex flex-wrap justify-content-between rounded-3 px-3">

                                <!-- Informations personnelles (Email, Identifiant, Statut) -->
                                <div class="w-100 position-relative border rounded-3 mt-4 bg-light p-responsive">
                                    <div class="d-flex flex-column">
                                        <div class="p-2 border-bottom_b0cfed">
                                            <div class="d-inline-block pe-3">
                                                <i class="fa fa-envelope font-size-30px"></i>
                                            </div>
                                            <span class="vertical-align-super"><b>Adresse-Email : </b><?= $profils->email ?></span>
                                        </div>
                                        <div class="p-2 border-bottom_b0cfed">
                                            <div class="d-inline-block pe-3">
                                                <i class="fa fa-id-card font-size-30px"></i>
                                            </div>
                                            <span class="vertical-align-super">
                                                <b>Identifiant : </b>
                                                <span id="champ_valeur_pseudo">
                                                    <?= $profils->pseudo ?>
                                                </span>
                                            </span><br>
                                            <button class="btn btn-primary mt-2 px-4" data-bs-toggle="modal" data-bs-target="#modal_modif_pseudo">Modifier</button>
                                        </div>
                                        <div class="p-2">
                                            <div class="d-inline-block pe-3 ps-1">
                                                <i class="fa fa-tag font-size-30px"></i>
                                            </div>
                                            <span class="vertical-align-super"><b>Statut : </b>
                                                <?php
                                                if ($profils->statut == "user") {
                                                    echo "Utilisateur";
                                                } elseif ($profils->statut == "admin") {
                                                    echo "Administrateur";
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informations personnelles : Mot de passe -->
                                <div class="w-100 position-relative border rounded-3 mb-4 mt-4 bg-light p-responsive">
                                    <div class="d-flex flex-column">
                                        <div class="p-2">
                                            <div class="d-inline-block pe-4 ps-1">
                                                <i class="fa fa-lock font-size-30px"></i>
                                            </div>
                                            <span class="vertical-align-super"><b>Mot de passe : </b>*****</span><br>
                                            <button class="btn btn-primary mt-2 px-4" data-bs-toggle="modal" data-bs-target="#modal_modif_mdp">Modifier</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Paramètres -->
                        <div class="w-100 d-flex flex-wrap justify-content-between bg-linear-gradient rounded-3 mb-3">
                            <div class="w-100 bg-blue-335499 bg-gradient rounded-3 text-center">
                                <h4 class="text-white font-family_montserrat-semibold text-uppercase pt-3 px-2 user-select-none">Paramètres</h4>
                            </div>
                            <div class="w-100 d-flex flex-wrap justify-content-between rounded-3 px-3">
                                <div class="w-100 position-relative border rounded-3 mb-4 mt-4 bg-light p-responsive">
                                    A venir...
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<?= modal_modif_pseudo($form, $profils->pseudo); ?>
<?= modal_modif_mdp($form); ?>

<script src="js/modal_modifier_pseudo_user.js"></script>
<script src="js/modal_modifier_mdp_user.js"></script>