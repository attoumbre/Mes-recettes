<div class="card card-4">
    <div class="card-body">
        <h2 class="title">
            <b>Inscription</b>
        </h2>
        <form method="post">
            <div class="row row-space">
                <div class="col-2">
                    <div class="input-group wrap-input100">
                        <?= $form->input('email', 'Adresse Email :', [
                            'type' => 'email',
                            'class' => 'input--style-4 input100',
                            'required' =>  true,
                            'surround' => false,
                            'label_class' => 'label',
                            'valeur' => $infos_input["email"]
                        ]); ?>
                        <span class="focus-input100_2"></span>
                    </div>
                </div>
                <div class="col-2">
                    <div class="input-group wrap-input100">
                        <?= $form->input('pseudo', 'Identifiant :', [
                            'type' => 'text',
                            'class' => 'input--style-4 input100',
                            'min_length' => 5,
                            'max_length' => 24,
                            'required' =>  true,
                            'surround' => false,
                            'label_class' => 'label',
                            'valeur' => $infos_input["pseudo"]
                        ]); ?>
                        <span class="focus-input100_2"></span>
                    </div>
                </div>
            </div>

            <div class="row row-space">
                <div class="col-2">
                    <div class="input-group wrap-input100">
                        <?= $form->input('date_naissance', 'Date de naissance :', [
                            'type' => 'date',
                            'class' =>
                            'input--style-4 input100',
                            'required' =>  true,
                            'surround' => false,
                            'label_class' => 'label',
                            'valeur' => $infos_input["date_naissance"]
                        ]); ?>
                        <span class="focus-input100_2"></span>
                    </div>
                </div>
                <div class="col-2">
                    <div class="input-group wrap-input100">
                        <?= $form->input('mdp', 'Mot de passe :', ['type' => 'password', 'class' => 'input--style-4 input100', 'min_length' => 5, 'max_length' => 24, 'required' =>  true, 'surround' => false, 'label_class' => 'label']); ?>
                        <span class="focus-input100_2"></span>
                    </div>
                </div>
            </div>

            <div class="row row-space_center">
                <div class="col-2">
                    <div class="input-group wrap-input100">
                        <?= $form->input('confirm_mdp', 'Confirmation mot de passe :', ['type' => 'password', 'class' => 'input--style-4 input100', 'min_length' => 5, 'max_length' => 24, 'required' =>  true, 'surround' => false, 'label_class' => 'label']); ?>
                        <span class="focus-input100_2"></span>
                    </div>
                </div>
            </div>

            <?php if ($error_inscription) : ?>
                <div class="alert alert-danger">
                    <?php
                    switch ($error_inscription) {
                        case 'age':
                            echo 'Il faut avoir 18 ans pour vous incrire.';
                            break;
                        case 'email':
                            echo 'Adresse Email déjà utilisée.';
                            break;
                        case 'pseudo':
                            echo 'Identifiant déjà utilisé.';
                            break;
                        case 'mdp':
                            echo 'Les mots de passe sont différents.';
                            break;
                    }
                    ?>
                </div>
            <?php endif; ?>

            <div class="text-center">
                <div class="input-group">
                    <div class="p-t-15">
                        <button class="btn btn--radius-2 btn--green">S'INSCRIRE</button>
                    </div>
                    <div class="p-t-15">
                        <a href="?p=utilisateurs.connexion">
                            <button class="btn btn--radius-2 btn--red" type="button">Retour</button>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>