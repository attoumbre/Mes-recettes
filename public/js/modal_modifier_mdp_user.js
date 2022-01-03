function modifier_mdp() {
    var $ancien_mdp = document.getElementById("ancien_mdp").value;
    var $nouveau_mdp = document.getElementById("nouveau_mdp").value;
    var $confirm_nouveau_mdp = document.getElementById("nouveau_mdp_confirm").value;
    var a = $.post(
        '?p=user.utilisateurs.modifier_mdp', {
        ancien_mdp: $ancien_mdp,
        nouveau_mdp: $nouveau_mdp,
        confirm_nouveau_mdp: $confirm_nouveau_mdp
    },
        function (data) {
            if (data == "erreur_ancien_mdp") {
                var bloc_erreur = document.getElementById('erreur_modif_mdp');
                bloc_erreur.innerHTML = "Votre ancien mot de passe est incorrect.";
                bloc_erreur.style.display = "";
            } else if (data == "erreur_longueur") {
                var bloc_erreur = document.getElementById('erreur_modif_mdp');
                bloc_erreur.innerHTML = "Votre mot de passe doit contenir entre 5 et 24 caractères.";
                bloc_erreur.style.display = "";
            } else if (data == "erreur_confirmation_mdp") {
                var bloc_erreur = document.getElementById('erreur_modif_mdp');
                bloc_erreur.innerHTML = "Les mots de passe sont différents.";
                bloc_erreur.style.display = "";
            } else {
                document.getElementById('erreur_modif_mdp').style.display = "none";
                document.getElementById('btn_annuler_modif_mdp_modal').click();
                document.getElementById('ancien_mdp').value = "";
                document.getElementById('nouveau_mdp').value = "";
                document.getElementById('nouveau_mdp_confirm').value = "";
            }
        },
        'text'
    );
}