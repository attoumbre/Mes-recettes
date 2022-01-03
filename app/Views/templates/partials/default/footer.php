<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6">
                    <div class="footer-info">
                        <h3>Share & Drink</h3>
                        <p class="pb-3"><em>Pour plus d'information, vous pouvez nous contacter facilement et rapidement.</em>
                        </p>
                        <p>
                            <strong>Téléphone :</strong> 01 23 45 67 89<br>
                            <strong>Email :</strong> info@share-drink.com<br>
                        </p>
                        <div class="social-links mt-3">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Liens utiles</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="?p=home.index">Accueil</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="?p=recettes.index">Toutes les recettes</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                </div>

                <?php if (empty($_SESSION)) : ?>
                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>S'inscrire</h4>
                        <p>Inscrivez-vous pour pouvoir créer et publier vos propres recettes et mettre en favoris vos recettes préférées.</p>
                        <a href="?p=utilisateurs.inscription">
                            <button class="btn btn-primary mt-2">S'inscrire</button>
                        </a>
                    </div>
                <?php else : ?>
                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Déconnexion</h4>
                        <form class="form_footer_btn" action="?p=utilisateurs.deconnexion" method="post">
                            <input type="hidden" name="deconnexion" value="">
                            <button type="submit" class="btn btn-danger">Se déconnecter</button>
                        </form>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
        </div>
        <div class="credits">
        </div>
    </div>
</footer>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<!-- End Footer -->