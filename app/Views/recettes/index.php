<?php require_once(realpath(dirname(__FILE__)) . '/../templates/partials/recettes_partials/vignette_recette.php') ?>
<section id="hero_2">
    <div class="hero-container" data-aos="fade-up">
        <h1 class="user-select-none">Toutes Les Recettes </h1>
    </div>
</section>

<main id="main">

    <!--
    <section id="services" class="services section-bg pb-80">
        <h1 class="section-title" data-aos="fade-in" data-aos-delay="100">Rechercher des recettes de bière</h1>
        <div class="home_search">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="home_search_container">
                            <div class="home_search_content">

                                <?php //include('research.php') 
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
-->


    <section id="services" class="services section-bg">
        <div class="container">
            <div class="section-title" data-aos="fade-in" data-aos-delay="100">
                <?php
                if ($nbRecettes == 0) :
                    echo "<h2>Aucune recette de bière n'est disponible</h2>";
                else :

                    echo "<h2>Les recettes de bière disponibles</h2>";
                    echo "<h4>Retrouvez toutes les recettes de bière que vous pouvez consulter</h4>";
                endif;
                ?>
            </div>

            <?php if ($nbRecettes == 0) : ?>
                <div class="text-center mb-5">
                    <a href="?p=home.index">
                        <button type="button" class="btn btn-success btn-lg">Retour à la page d'accueil</button>
                    </a>
                </div>
            <?php else : ?>
                <div class="mb-3 pb-3 pt-3 recent px-5 border-radius-20">
                    <div class="row recent_row">
                        <?php
                        foreach ($allRecettes as $recettes => $recette) {
                            echo vignette_recette($recette, 'recette', 3, $id_favoris);
                        }
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        </div>

        <?php
        if ($nbRecettes > $parPage) : (!isset($_GET['page'])) ? $currentPage = 1 : $currentPage = $_GET['page'];
        ?>
            <nav class=" p-5">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                        <a class="page-link" href="?p=recettes.index&page=<?= $currentPage - 1 ?>" aria-label="Précédent">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($page = 1; $page <= $nbPages; $page++) : ?>
                        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                            <a href="?p=recettes.index&page=<?= $page ?>" class="page-link"><?= $page ?></a>
                        </li>
                    <?php endfor ?>
                    <li class="page-item <?= ($currentPage == $nbPages) ? "disabled" : "" ?>">
                        <a class="page-link" href="?p=recettes.index&page=<?= $currentPage + 1 ?>" aria-label="Suivant">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </section>

</main>

<!-- Gestion des favoris -->
<script src="js/gestion_favoris_recette.js"></script>