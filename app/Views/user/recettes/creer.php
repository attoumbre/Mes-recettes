<?php require_once(realpath(dirname(__FILE__)) . '/../../templates/partials/recettes_partials/variables_modifier_recette.php') ?>

<!-- ======= Presentation Section ======= -->
<section id="hero_2">
    <div class="hero-container" data-aos="fade-up">
        <h1 class="user-select-none"><?= $titre_principal ?></h1>
    </div>
</section><!-- End Presentation Section -->

<main id="main">
    <div class="w-100 d-flex flex-wrap justify-content-center align-items-center p-3 bg-light_grey">
        <div class="w920px bg-white rounded-3 overflow-hidden p-5">
            <form class="w-100 d-flex flex-wrap justify-content-between" method="POST" enctype='multipart/form-data'>
                <span class="w-100 d-block h1 text-dark text-center pb-5 font-family_montserrat-bold user-select-none">
                    <?= $titre_principal ?>
                </span>

                <!-- Informations générales de la recette  -->
                <div class="w-100 d-flex flex-wrap justify-content-between bg-linear-gradient rounded-3 mb-4">
                    <div class="accordion w-100 bg-blue-335499 bg-gradient rounded-3">
                        <h4 class="text-white font-family_montserrat-semibold text-uppercase pt-3 px-2 user-select-none">Informations générales de la nouvelle recette</h4>
                    </div>

                    <div class="panel w-100 d-flex flex-wrap justify-content-between rounded-3 px-3">
                        <!-- Titre de la recette -->
                        <div class="w-100 position-relative border rounded-3 mb-4 mt-4 bg-light p-responsive">
                            <?= $form->input(
                                'titre',
                                'Titre de la recette :',
                                [
                                    'type' => 'text',
                                    'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                    'placeholder' => 'Titre...',
                                    'required' =>  true,
                                    'surround' => false,
                                    'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                    'valeur' => $m_titre_recette
                                ]
                            ); ?>
                        </div>

                        <!-- Type de bière -->
                        <div class="w-100 position-relative border rounded-3 mb-4 bg-light p-responsive">
                            <?= $form->select(
                                'type_biere',
                                'Type de bière :',
                                [
                                    "biere_blanche" => "Bière blanche",
                                    "biere_blonde" => "Bière blonde",
                                    "biere_brune" => "Bière brune",
                                    "biere_rousse" => "Bière ambrée ou rousse"
                                ],
                                [
                                    'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                    'class' => 'form-select mt-2',
                                    'required' => true,
                                    'surround' => false,
                                    'valeur' => $m_type_biere
                                ]
                            ); ?>
                        </div>

                        <!-- Quantité de bière produite -->
                        <div class="w-50-50-30px position-relative border rounded-3 mb-4 bg-light p-responsive">
                            <?= $form->input(
                                'quantite_biere',
                                'Quantité de bière produite (en Litre) :',
                                [
                                    'type' => 'number',
                                    'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                    'placeholder' => 'Quantité...',
                                    'required' => true,
                                    'surround' => false,
                                    'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                    'min' => 0,
                                    'onchange' => 'changerValeurIBU(); majIBUs(); changerValeurEBC(); majEBC(); changerValeurGU(); majOG();',
                                    'id' => 'quantite_biere',
                                    'valeur' => $m_quantite_biere
                                ]
                            ); ?>
                        </div>

                        <!-- Temps d'ébullition nécessaire -->
                        <div class="w-50-50-30px position-relative border rounded-3 mb-4 bg-light p-responsive">
                            <?= $form->input(
                                'temps_ebullition',
                                'Temps d\'ébullition nécessaire (en minute) :',
                                [
                                    'type' => 'number',
                                    'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                    'placeholder' => 'Temps d\'ébullition...',
                                    'required' => true,
                                    'surround' => false,
                                    'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                    'min' => 0,
                                    'valeur' => $m_temps_ebullition_biere
                                ]
                            ); ?>
                        </div>

                        <!-- Description de la recette -->
                        <div class="w-100 position-relative border rounded-3 mb-4 bg-light p-responsive">
                            <?= $form->input(
                                'description',
                                'Description de la Recette :',
                                [
                                    'type' => 'textarea',
                                    'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-11px border-0 outline_none h40px min-h-px-120 pt-2 pb-3',
                                    'placeholder' => 'Description...',
                                    'required' =>  false,
                                    'surround' => false,
                                    'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                    'valeur_textarea' => $m_description_recette
                                ]
                            ); ?>
                        </div>

                        <!-- Photo de la recette -->
                        <div class="w-50-50-30px position-relative border rounded-3 mb-4 bg-light p-responsive">
                            <div id="input_file">
                                <?= $form->input(
                                    'image_recette',
                                    'Photo de la Recette (facultative) :',
                                    [
                                        'type' => 'file',
                                        'class' => 'form-control mt-2',
                                        'required' =>  false,
                                        'surround' => false,
                                        'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                        'onchange' => 'ajouterFichier(files);' . $m_onchange_supprimer_img,
                                        'accept_file' => 'image/png, image/jpeg'
                                    ]
                                ); ?>
                                <br>
                                <button type="button" class="btn btn-danger" id="btn_supp_image" onclick="supprimerImage();<?= ($modif) ? 'supprimerAncienneImage();' : '' ?>" style="<?= $m_image_recette_affichage ?>">Supprimer l'image</button>
                            </div>
                        </div>
                        <?php if ($modif) : ?>
                            <input id="etat_ancienne_image" type="hidden" name="etat_ancienne_image" value="presente">
                            <input id="ancienne_image" type="hidden" name="ancienne_image" value="<?= $recette->image ?>">
                        <?php endif; ?>
                        <!-- Affichage de la photo de la recette -->
                        <div class="w-50-50-30px">
                            <label for="upload">
                                <span id="preview">
                                    <img id="image" class="img-fluid mb-4" src="<?= $m_image_recette_src ?>">
                                </span>
                            </label>
                        </div>

                    </div>
                </div>

                <!-- Céréales et Ingrédients -->
                <div class="w-100 d-flex flex-wrap justify-content-between bg-linear-gradient rounded-3 mb-4">
                    <div class="accordion w-100 bg-blue-335499 bg-gradient rounded-3">
                        <h4 class="text-white font-family_montserrat-semibold text-uppercase pt-3 px-2 user-select-none">Céréales et Ingrédients</h4>
                    </div>
                    <div class="panel">
                        <div class="w-100 d-flex flex-wrap justify-content-between rounded-3 px-3 pb-3">
                            <p class="text-white font-family_montserrat-semibold mt-4">
                                Sélectionnez la céréale ou l'ingrédient de votre recette, entrez sa quantité, sélectionnez son unité de mesure, puis, appuyez sur "Ajouter".<br>
                                Faites de même pour toutes les céréales et tous les ingrédients de votre recette.
                            </p>
                            <div class="alert alert-warning" role="alert">
                                Si vous n'appuyez pas sur le bouton "Ajouter", la céréale ou l'ingrédient ne sera pas pris en compte.
                            </div>
                            <p class="text-white font-family_montserrat-semibold">
                                Vous pouvez retirer une céréale ou un ingrédient ajouté en appuyant sur "Retirer".
                            </p>
                        </div>

                        <div class="w-100 d-flex flex-wrap justify-content-between rounded-3 px-3 pb-3">
                            <!-- Céréale ou Ingrédient -->
                            <div class="w-100 position-relative border rounded-3 mb-4 bg-light p-responsive">
                                <?= $form->select(
                                    'f_nom_ingredient',
                                    'Céréale ou Ingrédient :',
                                    $ingredients,
                                    [
                                        'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                        'class' => 'form-select mt-2',
                                        'id' => 'nom_ingredient',
                                        'required' => false,
                                        'surround' => false,
                                        'onchange' => 'changerValeurEBC();changerValeurGU();',
                                        'data' => ["sebc" => $ingredients_sebc, "ppg" => $ingredients_ppg]
                                    ]
                                ); ?>
                                <br>
                                <!-- Quantité de l'ingrédient -->
                                <div class="position-relative border border-secondary rounded-3 mb-4 bg-light p-responsive">
                                    <?= $form->input(
                                        'f_quantite_ingredient',
                                        'Quantité :',
                                        [
                                            'type' => 'number',
                                            'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                            'id' => 'quantite_ingredient',
                                            'placeholder' => 'Quantité...',
                                            'required' => false,
                                            'surround' => false,
                                            'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                            'min' => 0,
                                            'onchange' => 'changerValeurEBC();changerValeurGU();'
                                        ]
                                    ); ?>
                                </div>

                                <!-- Unité de mesure de l'ingrédient -->
                                <div class="position-relative border border-secondary rounded-3 mb-4 bg-light p-responsive">
                                    <?= $form->select(
                                        'f_unite_ingredient',
                                        'Unité de mesure :',
                                        [
                                            "" => "",
                                            "optgroup_poids" => "Poids",
                                            "kg" => "Kilogramme",
                                            "g" => "Gramme",
                                            "cg" => "Centigramme",
                                            "mg" => "Milligramme",
                                            "optgroup_liquide" => "Liquide",
                                            "l" => "Litre",
                                            "dl" => "Décilitre",
                                            "cl" => "Centilitre",
                                            "ml" => "Millilitre"
                                        ],
                                        [
                                            'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                            'class' => 'form-select mt-2',
                                            'id' => 'unite_ingredient',
                                            'required' => false,
                                            'surround' => false,
                                            'onchange' => 'changerValeurEBC(); changerValeurGU();'
                                        ]
                                    ); ?>
                                </div>

                                <!-- Information sur le GU de l'ingrédient -->
                                <div id="card_gu" class="d-none">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="row align-items-center gx-0">
                                                <div class="col">
                                                    <h6>GU <small>(densité)</small> de l'ingrédient :</h6>
                                                    <span class="h4" id="valeur_gu">1.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Information sur l'EBC de l'ingrédient -->
                                <div id="card_ebc" class="d-none">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="row align-items-center gx-0">
                                                <div class="col">
                                                    <h6>EBC (SRM) <small>(European Brewery Convention = turbidité)</small> de l'ingrédient :</h6>
                                                    <span class="h4" id="valeur_ebc">0.0</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Message d'erreur d'ajout d'un ingrédient -->
                                <div class=" alert alert-danger" id="erreur_ajout_ingredient" style="display:none">
                                    Erreur d'ajout : Un des champs est incorrect.
                                </div>

                                <!-- Bouton d'ajout d'un ingrédient -->
                                <div class="text-center">
                                    <button type="button" class="btn btn-success btn-lg" onClick='ajouterIngredient();return false;'>Ajouter</button>
                                </div>

                                <!-- Tableau des ingrédients -->
                                <div class="px-3 pt-3 overflow-auto">
                                    <table class="table border-secondary table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="font-size-10px" scope="col">Nom de la céréale ou de l'ingrédient</th>
                                                <th class="font-size-10px" scope="col">Quantité</th>
                                                <th class="font-size-10px" scope="col">Unité de mesure</th>
                                                <th class="font-size-10px" scope="col">EBC</th>
                                                <th class="font-size-10px" scope="col">GU</th>
                                                <th class="font-size-10px" scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody id='tbody_ingredient'></tbody>
                                    </table>
                                </div>

                                <div class="d-flex flex-row-reverse">
                                    <!-- Affichage de l'OG -->
                                    <div class="me-3 bg-white p-2 border rounded-3">
                                        <b>OG (Original Gravity = Densité Initiale) :</b>
                                        <span id="valeur_og">0.00</span>
                                    </div>

                                    <!-- Affichage de l'EBC total -->
                                    <div class="me-2 bg-white p-2 border rounded-3">
                                        <b>EBC total (en fonction du volume) :</b>
                                        <span id="ebc_total">0.00</span>
                                    </div>
                                </div>

                                <!-- Inputs ingrédients -->
                                <div id="input_hidden_ingredient"></div>

                                <!-- Information sur la couleur de la bière -->
                                <div id="couleur_biere" class="mt-2">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="row align-items-center gx-0">
                                                <div class="col">
                                                    <h6>Couleur de la bière :</h6>
                                                    <div id="couleur_biere_affichage" class="border border-secondary height-40" style="background-color: #FFFFFF"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert alert-warning mx-3" role="alert">
                                            <b>Attention</b> : En fonction des ingrédients ajoutés, la couleur de la bière peut varier.
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Houblons -->
                <div class="w-100 d-flex flex-wrap justify-content-between bg-linear-gradient rounded-3 mb-4">
                    <div class="accordion w-100 bg-blue-335499 bg-gradient rounded-3">
                        <h4 class="text-white font-family_montserrat-semibold text-uppercase pt-3 px-2 user-select-none">Houblons</h4>
                    </div>
                    <div class="panel">
                        <div class="w-100 d-flex flex-wrap justify-content-between rounded-3 px-3 pb-3">
                            <p class="text-white font-family_montserrat-semibold mt-4">
                                Sélectionnez le type de houblon de votre recette, entrez sa quantité, son taux d'acide-alpha et son temps d'ébullition, puis, appuyez sur "Ajouter".<br>
                                Faites de même pour tous les types de houblon de votre recette.
                            </p>
                            <div class="alert alert-warning" role="alert">
                                Si vous n'appuyez pas sur le bouton "Ajouter", le type de houblon ne sera pas pris en compte.
                            </div>
                            <p class="text-white font-family_montserrat-semibold">
                                Vous pouvez retirer un type de houblon ajouté en appuyant sur "Retirer".
                            </p>
                        </div>

                        <div class="w-100 d-flex flex-wrap justify-content-between rounded-3 px-3 pb-3">
                            <!-- Type de houblon -->
                            <div class="w-100 position-relative border rounded-3 mb-4 bg-light p-responsive">
                                <div class="position-relative border border-secondary rounded-3 mb-4 bg-light p-responsive">

                                    <?= $form->select(
                                        'f_nom_houblon',
                                        'Type de Houblon :',
                                        $houblons,
                                        [
                                            'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                            'class' => 'form-select mt-2',
                                            'id' => 'nom_houblon',
                                            'required' => false,
                                            'surround' => false
                                        ]
                                    ); ?>
                                </div>

                                <!-- Quantité de l'houblon -->
                                <div class="position-relative border border-secondary rounded-3 mb-4 bg-light p-responsive">
                                    <?= $form->input(
                                        'f_quantite_houblon',
                                        'Quantité (en gramme) :',
                                        [
                                            'type' => 'number',
                                            'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                            'id' => 'quantite_houblon',
                                            'placeholder' => 'Quantité...',
                                            'required' => false,
                                            'surround' => false,
                                            'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                            'min' => 0,
                                            'onchange' => 'changerValeurIBU()'
                                        ]
                                    ); ?>
                                </div>

                                <!-- Taux d'acide-alpha du houblon -->
                                <div class="position-relative border border-secondary rounded-3 mb-4 bg-light p-responsive">
                                    <?= $form->input(
                                        'f_taux_aa_houblon',
                                        'Taux d\'acide-alpha (en %) :',
                                        [
                                            'type' => 'number',
                                            'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                            'id' => 'taux_aa_houblon',
                                            'placeholder' => 'Taux d\'acide-alpha...',
                                            'required' => false,
                                            'surround' => false,
                                            'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                            'min' => 0,
                                            'max' => 100,
                                            'onchange' => 'changerValeurIBU()'
                                        ]
                                    ); ?>
                                </div>

                                <!-- Temps d'ébullition du houblon -->
                                <div class="position-relative border border-secondary rounded-3 mb-4 bg-light p-responsive">
                                    <?= $form->input(
                                        'f_temps_ebullition_houblon',
                                        'Temps d\'ébullition (en minute) :',
                                        [
                                            'type' => 'number',
                                            'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                            'id' => 'temps_ebullition_houblon',
                                            'placeholder' => 'Temps d\'ébullition...',
                                            'required' => false,
                                            'surround' => false,
                                            'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                            'min' => 0,
                                            'onchange' => 'changerValeurIBU()'
                                        ]
                                    ); ?>
                                </div>

                                <!-- Information sur l'IBU du houblon -->
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div class="row align-items-center gx-0">
                                            <div class="col">
                                                <h6>IBU <small>(International Bitterness Unit = Amertume)</small> :</h6>
                                                <span class="h4" id="valeur_ibu">0.0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Message d'erreur d'ajout d'un type de houblon -->
                                <div class="alert alert-danger" id="erreur_ajout_houblon" style="display:none">
                                    Erreur d'ajout : Un des champs est incorrect.
                                </div>

                                <!-- Bouton d'ajout d'un type de houblon -->
                                <div class="text-center">
                                    <button type="button" class="btn btn-success btn-lg" onClick='ajouterHoublon();return false;'>Ajouter</button>
                                </div>

                                <!-- Tableau des types de Houblon -->
                                <div class="px-3 pt-3 overflow-auto">
                                    <table class="table border-secondary table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="font-size-10px" scope="col">Type de houblon</th>
                                                <th class="font-size-10px" scope="col">Quantité (en g)</th>
                                                <th class="font-size-10px" scope="col">Taux d'acide-alpha (en %)</th>
                                                <th class="font-size-10px" scope="col">Temps d'ébullition (en min)</th>
                                                <th class="font-size-10px" scope="col">IBU</th>
                                                <th class="font-size-10px" scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody id='tbody_houblon'></tbody>
                                    </table>
                                </div>
                                <div class="d-flex flex-row-reverse">
                                    <!-- Affichage de l'IBU total -->
                                    <div class="me-3 bg-white p-2 border rounded-3">
                                        <b>IBU total :</b>
                                        <span id="ibu_total">0.00</span>
                                    </div>
                                    <div id="input_hidden_houblon"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Infusions -->
                <div class="w-100 d-flex flex-wrap justify-content-between bg-linear-gradient rounded-3 mb-4">
                    <div class="accordion w-100 bg-blue-335499 bg-gradient rounded-3">
                        <h4 class="text-white font-family_montserrat-semibold text-uppercase pt-3 px-2 user-select-none">Infusions</h4>
                    </div>
                    <div class="panel">
                        <div class="w-100 d-flex flex-wrap justify-content-between rounded-3 px-3 pb-3">
                            <p class="text-white font-family_montserrat-semibold mt-4">
                                Entrez le nom d'une infusion de votre recette, entrez sa température nécessaire, ainsi que sa durée, puis, appuyez sur "Ajouter".
                                Faites de même pour toutes les infusions de votre recette.
                            </p>
                            <div class="alert alert-warning" role="alert">
                                Si vous n'appuyez pas sur le bouton "Ajouter", l'infusion ne sera pas prise en compte.
                            </div>
                            <p class="text-white font-family_montserrat-semibold">
                                Vous pouvez retirer une infusion ajoutée en appuyant sur "Retirer".
                            </p>
                        </div>

                        <div class="w-100 d-flex flex-wrap justify-content-between rounded-3 px-3 pb-3">
                            <!-- Nom de l'Infusion -->
                            <div class="w-100 position-relative border rounded-3 mb-4 bg-light p-responsive">
                                <div class="position-relative border border-secondary rounded-3 mb-4 bg-light p-responsive">

                                    <?= $form->input(
                                        'f_nom_infusion',
                                        'Nom de l\'Infusion :',
                                        [
                                            'type' => 'text',
                                            'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                            'id' => 'nom_infusion',
                                            'placeholder' => 'Nom...',
                                            'required' =>  false,
                                            'surround' => false,
                                            'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                        ]
                                    ); ?>
                                </div>

                                <!-- Température de l'Infusion -->
                                <div class="position-relative border border-secondary rounded-3 mb-4 bg-light p-responsive">
                                    <?= $form->input(
                                        'f_temperature_infusion',
                                        'Température de l\'infusion (en °C) :',
                                        [
                                            'type' => 'number',
                                            'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                            'id' => 'temperature_infusion',
                                            'placeholder' => 'Température...',
                                            'required' => false,
                                            'surround' => false,
                                            'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                            'min' => 0
                                        ]
                                    ); ?>
                                </div>

                                <!-- Temps de l'Infusion -->
                                <div class="position-relative border border-secondary rounded-3 mb-4 bg-light p-responsive">
                                    <?= $form->input(
                                        'f_temps_infusion',
                                        'Temps de l\'infusion (en minute) :',
                                        [
                                            'type' => 'number',
                                            'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                            'id' => 'temps_infusion',
                                            'placeholder' => 'Temps...',
                                            'required' => false,
                                            'surround' => false,
                                            'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                            'min' => 0
                                        ]
                                    ); ?>
                                </div>

                                <!-- Message d'erreur d'ajout d'une infusion -->
                                <div class="alert alert-danger" id="erreur_ajout_infusion" style="display:none">
                                    Erreur d'ajout : Un des champs est incorrect.
                                </div>

                                <!-- Bouton d'ajout d'une infusion -->
                                <div class="text-center">
                                    <button type="button" class="btn btn-success btn-lg" onClick='ajouterInfusion();return false;'>Ajouter</button>
                                </div>

                                <!-- Tableau des Infusions -->
                                <div class="p-3 overflow-auto">
                                    <table class="table border-secondary table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="font-size-10px" scope="col">Nom de l'infusion</th>
                                                <th class="font-size-10px" scope="col">Température (en °C)</th>
                                                <th class="font-size-10px" scope="col">Temps (en min)</th>
                                                <th class="font-size-10px" scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody id='tbody_infusion'></tbody>
                                    </table>
                                </div>
                                <div id="input_hidden_infusion"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Levure  -->
                <div class="w-100 d-flex flex-wrap justify-content-between bg-linear-gradient rounded-3 mb-4">
                    <div class="accordion w-100 bg-blue-335499 bg-gradient rounded-3">
                        <h4 class="text-white font-family_montserrat-semibold text-uppercase pt-3 px-2 user-select-none">Levure</h4>
                    </div>

                    <div class="panel w-100 d-flex flex-wrap justify-content-between rounded-3 px-3">
                        <!-- Type de levure -->
                        <div class="w-100 position-relative border rounded-3 mb-4 mt-4 bg-light p-responsive">
                            <?= $form->input(
                                'type_levure',
                                'Type de levure :',
                                [
                                    'type' => 'text',
                                    'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                    'placeholder' => 'Type...',
                                    'required' =>  true,
                                    'surround' => false,
                                    'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                    'valeur' => $m_nom_levure
                                ]
                            ); ?>
                        </div>

                        <!-- Atténuation moyenne -->
                        <div class="w-50-50-30px position-relative border rounded-3 mb-4 bg-light p-responsive">
                            <?= $form->input(
                                'avg_attenuation_levure',
                                'Atténuation moyenne de la levure (en %) :',
                                [
                                    'type' => 'number',
                                    'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                    'placeholder' => 'Atténuation moyenne...',
                                    'required' => true,
                                    'surround' => false,
                                    'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                    'min' => 0,
                                    'id' => 'avg_attenuation_levure',
                                    'onchange' => 'changerValeurFG()',
                                    'valeur' => $m_avg_attenuation_levure
                                ]
                            ); ?>
                        </div>

                        <!-- Température optimale -->
                        <div class="w-50-50-30px position-relative border rounded-3 mb-4 bg-light p-responsive">
                            <?= $form->input(
                                'temperature_optimale_levure',
                                'Température optimale de la levure (en °C) :',
                                [
                                    'type' => 'number',
                                    'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                    'placeholder' => 'Température optimale...',
                                    'required' => true,
                                    'surround' => false,
                                    'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                    'min' => 0,
                                    'valeur' => $m_avg_temperature_levure
                                ]
                            ); ?>
                        </div>
                    </div>
                </div>

                <!-- Informations Hydrométriques -->
                <div class="w-100 d-flex flex-wrap justify-content-between bg-linear-gradient rounded-3 mb-4">
                    <div class="accordion w-100 bg-blue-335499 bg-gradient rounded-3">
                        <h4 class="text-white font-family_montserrat-semibold text-uppercase pt-3 px-2 user-select-none">Informations Hydrométriques</h4>
                    </div>

                    <div class="panel w-100 d-flex flex-wrap justify-content-between rounded-3 px-3">

                        <!-- Valeur de la densité lors de la pré-ébullition -->
                        <div class="w-50-50-30px position-relative border rounded-3 mb-4 mt-4 bg-light p-responsive">
                            <?= $form->input(
                                'gravite_pe',
                                'Valeur de la densité lors de la pré-ébullition :',
                                [
                                    'type' => 'number',
                                    'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                    'placeholder' => 'Valeur...',
                                    'required' => true,
                                    'surround' => false,
                                    'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                    'id' => 'gravite_pe',
                                    'min' => 0,
                                    'step' => 0.01,
                                    'onchange' => 'changerValeurABV()',
                                    'valeur' => $m_densite_pe
                                ]
                            ); ?>
                        </div>

                        <!-- Valeur de la densité lors de l'après-ébullition -->
                        <div class="w-50-50-30px position-relative border rounded-3 mb-4 mt-4 bg-light p-responsive">
                            <?= $form->input(
                                'gravite_ae',
                                'Valeur de la densité lors de l\'après-ébullition :',
                                [
                                    'type' => 'number',
                                    'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                    'placeholder' => 'Valeur...',
                                    'required' => true,
                                    'surround' => false,
                                    'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                    'min' => 0,
                                    'step' => 0.01,
                                    'valeur' => $m_densite_ae
                                ]
                            ); ?>
                        </div>

                        <!-- Valeur de la densité lors du soutirage -->
                        <div class="w-50-50-30px position-relative border rounded-3 mb-4 bg-light p-responsive">
                            <?= $form->input(
                                'gravite_s',
                                'Valeur de la densité lors du soutirage :',
                                [
                                    'type' => 'number',
                                    'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                    'placeholder' => 'Valeur...',
                                    'required' => true,
                                    'surround' => false,
                                    'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                    'min' => 0,
                                    'step' => 0.01,
                                    'valeur' => $m_densite_soutirage
                                ]
                            ); ?>
                        </div>

                        <!-- Valeur de la densité finale -->
                        <div class="w-50-50-30px position-relative border rounded-3 mb-4 bg-light p-responsive">
                            <?= $form->input(
                                'gravite_f',
                                'Valeur de la densité finale :',
                                [
                                    'type' => 'number',
                                    'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                    'placeholder' => 'Valeur...',
                                    'required' => true,
                                    'surround' => false,
                                    'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                    'id' => 'gravite_f',
                                    'min' => 0,
                                    'step' => 0.01,
                                    'onchange' => 'changerValeurABV()',
                                    'valeur' => $m_densite_finale
                                ]
                            ); ?>
                        </div>

                        <!-- Titre "Densités attendues" -->
                        <div class="w-100 border mb-1 bg-bababa">
                            <div class="text-center h4 font-family_montserrat-semibold text-uppercase top-6px">Densités attendues</div>
                        </div>

                        <!-- Information sur l'OG -->
                        <div class="w-50-50-5px position-relative border rounded-3 bg-blue-d9edff p-responsive mb-1">
                            <div class="p-1">
                                <div class="row align-items-center gx-0">
                                    <div class="col">
                                        <h5 class="text-secondary">OG <small>(Original Gravity = Densité Initiale)</small> attentue :</h5>
                                        <span class="h5" id="valeur_og_info_hydro">0.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Information sur le FG -->
                        <div class="w-50-50-5px position-relative border rounded-3 bg-blue-d9edff p-responsive mb-1">
                            <div class="p1">
                                <div class="row align-items-center gx-0">
                                    <div class="col">
                                        <h5 class="text-secondary">FG <small>(Final Gravity = Densité Finale)</small> attendue :</h5>
                                        <span class="h5" id="valeur_fg_info_hydro">0.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Titre "Taux d'alcool de la recette" -->
                        <div class="w-100 border mb-1 bg-bababa mt-3">
                            <div class="text-center h4 font-family_montserrat-semibold text-uppercase top-6px">Taux d'alcool de la recette</div>
                        </div>
                        <!-- Information sur l'ABV -->
                        <div class="w-50-50-5px position-relative border rounded-3 bg-blue-d9edff p-responsive mb-1">
                            <div class="p-1">
                                <div class="row align-items-center gx-0">
                                    <div class="col">
                                        <h5 class="text-secondary">ABV <small>(Alcool By Volume = Taux d'alcool)</small> attendu :</h5>
                                        <span class="h5" id="valeur_abv_info_hydro_attendue">0.00</span class="h5"><span> %</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-50-50-5px position-relative border rounded-3 bg-blue-d9edff p-responsive mb-1">
                            <div class="p-1">
                                <div class="row align-items-center gx-0">
                                    <div class="col">
                                        <h5 class="text-secondary">ABV <small>(Alcool By Volume = Taux d'alcool)</small> réel :</h5>
                                        <span class="h5" id="valeur_abv_info_hydro_reel"><?= ($modif) ? $m_abv_reel : "0.00" ?></span class="h5"><span> %</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bouton d'enregistrement -->
                <div class=" w-100 d-flex flex-wrap justify-content-center pt-3">
                    <input type="submit" class="w-100 d-flex justify-content-center h50px bg-_dark_grey rounded-pill pe-auto font-family_montserrat-semibold font-size-16px text-white border-0 btn_hover_green transition_fade" value="<?= $valeur_submit ?>" />
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "0px";
            }
        });
    }
</script>

<script src="js/gestion_image.js"></script>

<script src="js/gestion_ingredient_recette.js"></script>
<script src="js/gestion_houblon_recette.js"></script>
<script src="js/gestion_infusion_recette.js"></script>
<script src="js/gestion_ibu_recette.js"></script>
<script src="js/gestion_ebc_recette.js"></script>
<script src="js/gestion_og_recette.js"></script>
<script src="js/gestion_fg_recette.js"></script>
<script src="js/gestion_abv_recette.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('nom_ingredient').value = "";
        document.getElementById('nom_houblon').value = "";
    });
</script>

<?php
if ($modif) {
    require_once(realpath(dirname(__FILE__)) . '/../../templates/partials/recettes_partials/tableaux_modifier_recette.php');
}
?>