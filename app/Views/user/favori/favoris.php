<?php require_once(realpath(dirname(__FILE__)) . '/../../templates/partials/recettes_partials/vignette_recette.php') ?>
<?php require_once(realpath(dirname(__FILE__)) . '/../../templates/partials/recettes_partials/modal_recette.php') ?>
<section id="hero_2">
    <div class="hero-container" data-aos="fade-up">
        <h1 class="user-select-none">Mes Recettes Favorites </h1>
    </div>
</section>

<!-- ======= Presentation Section ======= -->
<main id="main">

    <section id="services" class="services section-bg">
        <div class="container">
            <div class="section-title" data-aos="fade-in" data-aos-delay="100">
                <?php
                if ($nbFavoris == 0) :
                    echo "<h2 id='titre_nb_recettes'>Vous n'avez aucune recette de bière en Favori</h2>";
                else :
                    if ($nbFavoris == 1) :
                        echo "<h2 id='titre_nb_recettes'>Vous avez <span id='nb_recettes'>1</span> recette de bière en Favori</h2>";
                    else :
                        echo "<h2 id='titre_nb_recettes'>Vous avez <span id='nb_recettes'>" . $nbFavoris . "</span> recettes de bière en Favori</h2>";
                    endif;
                    echo "<h4 id='sous_titre_nb_recettes'>Vous pouvez les supprimer de votre liste</h4>";
                endif;
                ?>
            </div>

            <?php if ($nbFavoris == 0) : ?>
                <div class="text-center mb-5">
                    <a href="?p=recettes.index">
                        <button type="button" class="btn btn-success btn-lg">Voir toutes les recettes</button>
                    </a>
                </div>
            <?php else : ?>
                <div id="all_recettes" class="mb-3 pb-3 pt-3 recent px-5 border-radius-20">
                    <div class="row recent_row">
                        <?php
                        foreach ($favoris as $recettes => $recette) {
                            echo vignette_recette($recette, 'favoris', 2);
                        }
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php
        if ($nbFavoris > $parPage) : (!isset($_GET['page'])) ? $currentPage = 1 : $currentPage = $_GET['page'];
        ?>
            <nav class=" p-5">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                        <a class="page-link" href="?p=user.favori.favoris&page=<?= $currentPage - 1 ?>" aria-label="Précédent">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($page = 1; $page <= $nbPages; $page++) : ?>
                        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                            <a href="?p=user.favori.favoris&page=<?= $page ?>" class="page-link"><?= $page ?></a>
                        </li>
                    <?php endfor ?>
                    <li class="page-item <?= ($currentPage == $nbPages) ? "disabled" : "" ?>">
                        <a class="page-link" href="?p=user.favori.favoris&page=<?= $currentPage + 1 ?>" aria-label="Suivant">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </section>
</main>
<!-- Modal -->
<?= modal_confirm("favoris"); ?>

<!-- Gestion des favoris (Modal) -->
<script src="js/modal_gestion_favoris_recette.js"></script>