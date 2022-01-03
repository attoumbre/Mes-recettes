function changerValeurABV_attendue() {
    // Récupération de la valeur d'OG attendue
    var valeur_og = document.getElementById("valeur_og_info_hydro").innerHTML;
    if (valeur_og == "") {
        valeur_og = 0.00;
    }

    // Récupération de la valeur de FG attendue
    var valeur_fg = document.getElementById("valeur_fg_info_hydro").innerHTML;
    if (valeur_fg == "") {
        valeur_fg = 0.00;
    }

    // Calcul de l'ABV attendue
    var valeur_abv = (valeur_og - valeur_fg) * 131.25;
    if (valeur_abv < 0) {
        valeur_abv = 0.00;
    } else if (valeur_abv > 100) {
        valeur_abv = 100.00;
    }
    valeur_abv = valeur_abv.toFixed(2);

    // Affichage de l'ABV attendue
    document.getElementById("valeur_abv_info_hydro_attendue").innerHTML = valeur_abv;
}

function changerValeurABV() {
    // Récupération de la valeur d'OG
    var valeur_og = document.getElementById("gravite_pe").value;
    if (valeur_og == "") {
        valeur_og = 0.00;
    }

    // Récupération de la valeur de FG
    var valeur_fg = document.getElementById("gravite_f").value;
    if (valeur_fg == "") {
        valeur_fg = 0.00;
    }

    // Calcul de l'ABV
    var valeur_abv = (valeur_og - valeur_fg) * 131.25;
    if (valeur_abv < 0) {
        valeur_abv = 0.00;
    } else if (valeur_abv > 100) {
        valeur_abv = 100.00;
    }
    valeur_abv = valeur_abv.toFixed(2);

    // Affichage de l'ABV
    document.getElementById("valeur_abv_info_hydro_reel").innerHTML = valeur_abv;
}