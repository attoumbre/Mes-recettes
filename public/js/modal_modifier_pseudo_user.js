function modifier_pseudo() {
    var $pseudo = document.getElementById("nouveau_pseudo").value;
    var a = $.post(
        '?p=user.utilisateurs.modifier_pseudo', {
        pseudo: $pseudo,
    },
        function (data) {
            if (data == "erreur_longueur") {
                var bloc_erreur = document.getElementById('erreur_modif_pseudo');
                bloc_erreur.innerHTML = "Votre identifiant doit contenir entre 5 et 24 caractères.";
                bloc_erreur.style.display = "";
            } else if (data == "erreur_unicite") {
                var bloc_erreur = document.getElementById('erreur_modif_pseudo');
                bloc_erreur.innerHTML = "Cet identifiant est déjà utilisé.";
                bloc_erreur.style.display = "";
            } else {
                document.getElementById('champ_valeur_pseudo').innerHTML = $pseudo;
                document.getElementById('erreur_modif_pseudo').style.display = "none";
                document.getElementById('btn_annuler_modif_pseudo_modal').click();
            }
        },
        'text'
    );
}