<div class="wrap-login100">
    <div class="login100-pic js-tilt" data-tilt>
        <img src="img/connexion_inscription/connexion_img.png" alt="img">
        <a href="?p=home.index">
            <button class="btn login100-form-btn login100-form-btn_info btn_acceder_au_site">Accéder au Site</button>
        </a>
    </div>

    <div class="login100-form validate-form">

        <h1 class="login100-form-title">Connexion</h1>

        <!-- Messages d'erreur et de confirmation -->
        <?php if ($errors) : ?>
            <div class="alert alert-danger">
                Adresse Email / Mot de passe incorrect.
            </div>
        <?php elseif ((isset($_GET['confirm'])) && ($_GET['confirm'] == 'inscription')) : ?>
            <div class="alert alert-success">
                Vous êtes inscrit, vous pouvez maintenant vous connecter.
            </div>
        <?php endif; ?>
        <!------------------------------------------->

        <p></p>
        <p></p>

        <!-- Formulaire de connexion -->
        <form method="post">
            <div class="wrap-input100 validate-input">
                <?= $form->input('email', '', [
                    'type' => 'email',
                    'class' => 'input100',
                    'placeholder' => 'Adresse Email',
                    'required' =>  true,
                    'surround' => false,
                    'valeur' => $infos_input['email']
                ]); ?>
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
            </div>

            <div class="wrap-input100 validate-input">
                <?= $form->input('mdp', '', ['type' => 'password', 'class' => 'input100', 'placeholder' => 'Mot de passe', 'required' =>  true, 'surround' => false]); ?>
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                </span>
            </div>

            <div class="container-login100-form-btn">
                <button class="login100-form-btn">SE CONNECTER</button>
            </div>

            <div class="container-login100-form-btn" id="div_acceder_site_sous_connexion">
                <a href="?p=home.index" class="login100-form-btn" id="btn_acceder_site_sous_connexion">Accéder au Site</a>
            </div>

        </form>
        <!------------------------------------------->

        <!-- Bouton de redirection vers l'inscription -->
        <div class="text-center p-t-136">
            <a class="txt2" href="?p=utilisateurs.inscription">
                S'inscrire
                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a>
        </div>
        <!------------------------------------------->
    </div>
</div>