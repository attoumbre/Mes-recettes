<?php

function modal_modif_pseudo($form, $pseudo)
{
    ob_start();
?>
    <div class="modal fade" id="modal_modif_pseudo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="staticBackdropLabel">Modifier l'identifiant</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="w-100 position-relative border rounded-3 mb-1 mt-1 bg-light p-responsive">
                            <?= $form->input(
                                'pseudo',
                                'Identifiant :',
                                [
                                    'type' => 'text',
                                    'id' => 'nouveau_pseudo',
                                    'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                    'placeholder' => 'Identifiant...',
                                    'min_length' => 5,
                                    'max_length' => 24,
                                    'required' =>  true,
                                    'surround' => false,
                                    'label_class' => 'font-family_montserrat-semibold font-size-10px text-dark text-uppercase user-select-none',
                                    'valeur' => $pseudo
                                ]
                            ); ?>
                        </div>
                        <!-- Message d'erreur de modification de l'identifiant -->
                        <div class="alert alert-danger" id="erreur_modif_pseudo" style="display:none"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="btn_modif_pseudo_modal" type="button" class="btn btn-success bg-green-74bb4f" onclick="modifier_pseudo();">Modifier</button>
                    <button id="btn_annuler_modif_pseudo_modal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}

function modal_modif_mdp($form)
{
    ob_start();
?>
    <div class="modal fade" id="modal_modif_mdp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="staticBackdropLabel">Modifier le mot de passe</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <!-- Ancien mot de passe -->
                        <div class="w-100 position-relative border rounded-3 mb-3 mt-1 bg-light p-responsive">
                            <?= $form->input(
                                'ancien_mdp',
                                'Ancien mot de passe :',
                                [
                                    'type' => 'password',
                                    'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                    'placeholder' => 'Ancien mot de passe...',
                                    'required' =>  true,
                                    'id' => "ancien_mdp",
                                    'surround' => false
                                ]
                            ); ?>
                        </div>

                        <!-- Nouveau mot de passe -->
                        <div class="w-100 position-relative border rounded-3 mb-3 mt-1 bg-light p-responsive">
                            <?= $form->input(
                                'nouveau_mdp',
                                'Nouveau mot de passe :',
                                [
                                    'type' => 'password',
                                    'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                    'placeholder' => 'Nouveau mot de passe...',
                                    'required' =>  true,
                                    'id' => "nouveau_mdp",
                                    'surround' => false
                                ]
                            ); ?>
                        </div>

                        <!-- Confirmer nouveau mot de passe -->
                        <div class="w-100 position-relative border rounded-3 mb-1 mt-1 bg-light p-responsive">
                            <?= $form->input(
                                'nouveau_mdp_confirm',
                                'Confirmer le nouveau mot de passe :',
                                [
                                    'type' => 'password',
                                    'class' => 'w-100 d-block bg-transparent font-family_montserrat-semibold font-size-18px border-0 outline_none h40px',
                                    'placeholder' => 'Confirmer le nouveau mot de passe...',
                                    'required' =>  true,
                                    'id' => "nouveau_mdp_confirm",
                                    'surround' => false
                                ]
                            ); ?>
                        </div>
                        <!-- Message d'erreur de modification du mot de passe -->
                        <div class="alert alert-danger" id="erreur_modif_mdp" style="display:none"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="btn_modif_mdp_modal" type="button" class="btn btn-success bg-green-74bb4f" onclick="modifier_mdp()">Modifier</button>
                    <button id="btn_annuler_modif_mdp_modal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}
?>