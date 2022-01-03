<?php
//Enregistrement de $_GET['p'] pour mémoriser la page
if (empty($_GET['p'])) {
  $page = 'home.index';
} else {
  $page = $_GET['p'];
}
?>

<!-- ======= Header & Navigation ======= -->
<header id="header" class="fixed-top header-transparent">
  <div class="container d-flex align-items-center justify-content-between">

    <div class="logo">
      <h1 class="text-light">
        <a href="?p=home.index">
          <span>
            <img style="max-height: 80px; border-radius:0px;" src="img/logos_icons/logo_S_D.png">
          </span>
        </a>
      </h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
    </div>

    <!-- Début navigation -->
    <nav id="navbar" class="navbar">
      <ul>
        <li>
          <a class="nav-link scrollto <?php if ($page == 'home.index') : ?> active <?php endif ?>" href="index.php?p=home.index">Accueil</a>
        </li>
        <li>
          <a class="nav-link scrollto <?php if ($page == 'recettes.index') : ?> active <?php endif ?>" href="index.php?p=recettes.index">Toutes les recettes</a>
        </li>
        <li>
          <?php if (empty($_SESSION)) : ?> <a class="nav-link scrollto" href="index.php?p=utilisateurs.connexion">Se connecter</a><?php endif; ?>
        </li>
        <?php if ((isset($_SESSION['auth'])) && ($_SESSION['statut'] == 'user' || $_SESSION['statut'] == 'admin')) : ?>
          <!--navigation Utilisateur + Admin -->
          <li class="dropdown">
            <a href="" <?php if ($page == 'user.utilisateurs.show' || $page == 'user.recettes.perso' || $page == 'user.favori.favoris' || $page == 'user.recettes.creer') : ?> class="active nav-link" <?php endif ?>>
              <span>Espace Utilisateur</span>
              <i class="bi bi-chevron-right"></i>
            </a>
            <ul>
              <li><a href="index.php?p=user.utilisateurs.show" class="nav-link">Mon Profil</a></li>
              <li><a href="index.php?p=user.recettes.perso" class="nav-link">Mes Recettes</a></li>
              <li><a href="index.php?p=user.favori.favoris" class="nav-link">Mes Favoris</a></li>
              <li><a href="index.php?p=user.recettes.creer" class="nav-link">Créer une Recette</a></li>
            </ul>
          </li>
          <?php if ($_SESSION['statut'] == 'admin') : ?>
            <!--navigation Admin-->
            <li class="dropdown">
              <a href="#" <?php if ($page == 'admin.administrateurs.activite' || $page == 'admin.administrateur.gererU' || $page == 'admin.administrateur.gererI' || $page == 'admin.administrateur.gererR') : ?> class="active" <?php endif ?>>
                <span>Espace Administrateur</span>
                <i class="bi bi-chevron-right"></i>
              </a>
              <ul>
                <li><a href="index.php?admin.administrateurs.activite">Journal d'activité</a></li>
                <li><a href="index.php?admin.administrateur.gererU">Gérer Utilisateurs</a></li>
                <li><a href="index.php?admin.administrateur.gererR">Gérer Recettes</a></li>
                <li><a href="index.php?admin.administrateur.gererI">Gérer Ingrédients</a></li>
              </ul>
            </li>
          <?php endif; ?>
          <form action="?p=utilisateurs.deconnexion" method="post">
            <input type="hidden" name="deconnexion" value="">
            <li><button type="submit" class="btn btn-danger ms-4">Se déconnecter</button></li>
          </form>


        <?php endif; ?>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->
  </div>
</header>
<!-- End Header -->