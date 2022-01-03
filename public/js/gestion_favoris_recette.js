function ajout_suppression_favori($id_recette) {
    $src_img = document.getElementById("favori_" + $id_recette).getAttribute('src');
    var $mode = "";
    if ($src_img == "../public/img/logos_icons/coeur_vide.png") {
        $mode = "creer";
    } else if ($src_img == "../public/img/logos_icons/coeur_plein.png") {
        $mode = "supprimer";
    }
    if ($mode != "") {
        $.post(
            '?p=user.favori.' + $mode, {
            id_recette: $id_recette,
        },

            function (data) {
                var src = '';
                if ($mode == 'creer') {
                    $src = '../public/img/logos_icons/coeur_plein.png';
                } else if ($mode == 'supprimer') {
                    $src = '../public/img/logos_icons/coeur_vide.png';
                }
                document.getElementById("favori_" + $id_recette).src = $src;

                var allClass = document.getElementsByClassName('favori_img_' + $id_recette);
                for (var i = 0; i < allClass.length; i++) {
                    allClass[i].src = $src;
                }


            },
            'text'
        );
    };
}