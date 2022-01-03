<?php

function modal_confirm($type)
{
    if ($type == "favoris") {
        $contenu_texte = "Souhaitez-vous vraiment retirer cette recette de vos favoris ?";
        $btn_confirm = "Retirer";
    } else if ($type == "persos") {
        $contenu_texte = "Souhaitez-vous vraiment supprimer cette recette de bière ?";
        $btn_confirm = "Supprimer";
    }
    ob_start();
?>
    <div class="modal fade" id="modal_confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="staticBackdropLabel">Confirmation</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= $contenu_texte; ?>
                </div>
                <div class="modal-footer">
                    <button id="btn_confirm" type="button" class="btn btn-danger" onclick="" data-bs-dismiss="modal"><?= $btn_confirm; ?></button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}
?>