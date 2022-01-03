<?php require_once(realpath(dirname(__FILE__)) . '/../templates/partials/recettes_partials/vignette_recette.php') ?>

<!-- ======= Presentation Section ======= -->
<section id="hero">
    <div class="hero-container" data-aos="fade-up">
        <h1>Bienvenue sur "Share & Drink"</h1>
        <h2>Créez, aimez, partagez les recettes de bière du monde entier</h2>
        <a href="#about" class="btn-get-started scrollto"><i class="bx bx-chevrons-down"></i></a>
    </div>
</section><!-- End Presentation Section -->

<main id="main">
    <!-- ======= A propos de nous Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="row no-gutters">
                <div class="content col-xl-5 d-flex align-items-stretch" data-aos="fade-up">
                    <div class="content">
                        <h3>"Share & Drink" : <br>Le site des recettes de bière !</h3>
                        <p>
                            "Share & Drink" est le meilleur moyen de partager ses idées de recette de bière !
                            <br>Simple, rapide et efficace, rejoignez-nous maintenant !
                        </p>
                    </div>
                </div>
                <div class="col-xl-7 d-flex align-items-stretch">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                                <i class="bi bi-search"></i>
                                <h4>Découvrez</h4>
                                <p>Découvrez des recettes de bière du monde entier !</p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                                <i class="bi bi-pencil-square"></i>
                                <h4>Créez</h4>
                                <p>Créez facilement et rapidement vos recettes de bière !</p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                                <i class="bi bi-share"></i>
                                <h4>Partagez</h4>
                                <p>Partagez vos recettes de bière à tout le monde !</p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                                <i class="fa fa-beer"></i>
                                <h4>Dégustez</h4>
                                <p>Dégustez et savourez en reproduisant les recettes de bière chez vous !</p>
                            </div>
                        </div>
                    </div><!-- End .content-->
                </div>
            </div>

        </div>
    </section><!-- End a propos de nous Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container">

            <div class="section-title" data-aos="fade-in" data-aos-delay="100">
                <h2>Les dernières recettes de bière publiées</h2>
                <p>Retrouvez ici les recettes de bière les plus récentes, proposées par la communauté.</p>
            </div>

            <?php if (count($recettes) > 0) : ?>
                <div class="recent bg-transparent pb-0">
                    <div class="row recent_row">
                        <div class="col">
                            <div class="recent_slider_container">
                                <div class="owl-carousel owl-theme recent_slider owl-loaded owl-drag">
                                    <?php foreach ($recettes as $recettes1 => $recette) : ?>
                                        <div class="owl-item">
                                            <?= vignette_recette($recette, 'home', 'carousel', $id_favoris); ?>
                                        </div>
                                    <?php
                                    endforeach;
                                    ?>
                                </div>

                                <div class="recent_slider_nav_container d-flex flex-row align-items-start justify-content-start">
                                    <div class="recent_slider_nav recent_slider_prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
                                    <div class="recent_slider_nav recent_slider_next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
                                </div>
                            </div>
                            <div class="button recent_button"><a class="color_white_hover" href="?p=recettes.index">Voir toutes les recettes</a></div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="alert alert-warning text-center" role="alert">
                    Il n'y a aucune recettes de bière publiées.
                </div>
            <?php endif; ?>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts  section-bg">
        <div class="container">

            <div class="d-flex justify-content-center row no-gutters">

                <div class="col col-md-6 d-md-flex align-items-md-stretch">
                    <div class="count-box">
                        <div style="padding-left: inherit;padding-right: inherit;">
                            <i class="pt-4 fa fa-beer"></i>
                            <?php ($nbRecette > 1) ? $nbRecetteNom = "Recettes de bière publiées" : $nbRecetteNom = "Recette de bière publiée"; ?>
                            <span data-purecounter-start="0" data-purecounter-end="<?= $nbRecette ?>" data-purecounter-duration="2" class="purecounter"></span>
                            <p><strong><?= $nbRecetteNom ?></strong></p>
                        </div>
                    </div>
                </div>

                <div class="col col-md-6 d-md-flex align-items-md-stretch">
                    <div class="count-box">
                        <div style="padding-left: inherit;padding-right: inherit;">
                            <i class="bi bi-emoji-smile"></i>
                            <?php ($nbUser > 1) ? $nbUserNom = "Utilisateurs qui nous ont rejoint" : $nbUserNom = "Utilisateur qui nous ont rejoint"; ?>
                            <span data-purecounter-start="0" data-purecounter-end="<?= $nbUser ?>" data-purecounter-duration="2" class="purecounter"></span>
                            <p><strong><?= $nbUserNom ?></strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Counts Section -->
</main>

<!-- Gestion des favoris -->
<script src="js/gestion_favoris_recette.js"></script>