function modal_del_fav_change_onclick($id_recette) {
    document.getElementById('btn_confirm').setAttribute('onclick', 'btn_suppression_favori(' + $id_recette + ');');
}

function btn_suppression_favori($id_recette) {
    $.post(
        '?p=user.favori.supprimer', {
        id_recette: $id_recette,
    },
        function (data) {
            var nb_recettes = document.getElementById('nb_recettes').innerHTML;
            nb_recettes -= 1;
            if (nb_recettes > 1) {
                document.getElementById("nb_recettes").innerHTML = nb_recettes;
            } else if (nb_recettes == 1) {
                document.getElementById("titre_nb_recettes").innerHTML = "Vous avez <span id='nb_recettes'>1</span> recette de bière en Favori";
            } else if (nb_recettes < 1) {
                document.getElementById("titre_nb_recettes").innerHTML = "Vous n'avez aucune recette de bière en Favori";
                document.getElementById("sous_titre_nb_recettes").setAttribute('style', 'display:none');
                var html_change = document.getElementById("all_recettes");
                html_change.className = "text-center mb-5";
                html_change.innerHTML = '<div class="text-center mb-5"><a href="?p=recettes.index"><button type="button" class="btn btn-success btn-lg">Voir toutes les recettes</button></a></div>';
            }
            if (nb_recettes >= 1) {
                document.getElementById('vignette_' + $id_recette).setAttribute('style', 'display:none');
            }
        },
        'text'
    );
}