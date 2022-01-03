function modal_del_recette_change_onclick($id_recette, $page) {
    if ($page == "perso") {
        $fonction_suppression = "supprimer_recette_perso(" + $id_recette + ");";
    } else if ($page == "une recette") {
        $fonction_suppression = "supprimer_recette_une_recette(" + $id_recette + ");";
    }
    document.getElementById('btn_confirm').setAttribute('onclick', $fonction_suppression);

}

function supprimer_recette_perso($id_recette) {
    $.post(
        '?p=user.recettes.delete', {
        id_recette: $id_recette,
    },
        function (data) {
            var nb_recettes = document.getElementById('nb_recettes').innerHTML;
            nb_recettes -= 1;
            if (nb_recettes > 1) {
                document.getElementById("nb_recettes").innerHTML = nb_recettes;
            } else if (nb_recettes == 1) {
                document.getElementById("titre_nb_recettes").innerHTML = "Vous avez publié <span id='nb_recettes'>1</span> recette de bière";
            } else if (nb_recettes < 1) {
                document.getElementById("titre_nb_recettes").innerHTML = "Vous n'avez aucune recette de bière publiée";
                document.getElementById("sous_titre_nb_recettes").setAttribute('style', 'display:none');
                var html_change = document.getElementById("all_recettes");
                html_change.className = "text-center mb-5";
                html_change.innerHTML = '<div class="text-center mb-5"><a href="?p=user.recettes.creer"><button type="button" class="btn btn-success btn-lg">Créer une recette</button></a></div>';
            }
            if (nb_recettes >= 1) {
                document.getElementById('vignette_' + $id_recette).setAttribute('style', 'display:none');
            }
        },
        'text'
    );
}

function supprimer_recette_une_recette($id_recette) {
    $.post(
        '?p=user.recettes.delete', {
        id_recette: $id_recette,
    },
        function (data) {
            document.location.href = "?p=user.recettes.perso";
        },
        'text'
    );
}
