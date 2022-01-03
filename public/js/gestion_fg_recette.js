function changerValeurFG() {
    // Récupération de la valeur d'OG
    var valeur_og = document.getElementById("valeur_og_info_hydro").innerHTML;
    if (valeur_og == "") {
        valeur_og = 0.00;
    }

    // Récupération de l'atténuation moyenne de la levure
    var valeur_avg_levure = document.getElementById("avg_attenuation_levure").value;
    if (valeur_avg_levure == "") {
        valeur_avg_levure = 0;
    }

    // Calcul du FG
    var valeur_fg = valeur_og - ((valeur_og - 1) * valeur_avg_levure / 100);
    var fg_str = valeur_fg.toString();
    nb_decimal = fg_str.search(/[.,]\d+$/);
    if (fg_str.substring(nb_decimal + 1).length > 5) {
        valeur_fg = valeur_fg.toFixed(6);
    } else if (fg_str.substring(nb_decimal + 1).length < 3) {
        valeur_fg = valeur_fg.toFixed(2);
    }

    // Affichage du FG
    document.getElementById("valeur_fg_info_hydro").innerHTML = valeur_fg;

    // Mise à jour de l'ABV attendu
    changerValeurABV_attendue();
}