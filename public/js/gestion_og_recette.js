function changerValeurGU() {
    // Récupération de l'ingrédient
    var nom_ingredient = document.getElementById('nom_ingredient');
    var select_nom_ingredient = nom_ingredient.options[nom_ingredient.selectedIndex];

    // Récupération de la quantité de l'ingrédient
    var quantite_ingredient = document.getElementById('quantite_ingredient').value;
    if (quantite_ingredient == "") {
        quantite_ingredient = 0;
    }

    // Récupération de la valeur du PPG de l'ingrédient
    var ppg = "";
    if (select_nom_ingredient) {
        var ppg = select_nom_ingredient.dataset.ppg;
    }

    // Récupération de l'unité de mesure de l'ingrédient
    var unite_ingredient = document.getElementById('unite_ingredient').value;

    // Gestion GU
    if (select_nom_ingredient && unite_ingredient != "") {
        // Affichage du GU
        document.getElementById('card_gu').className = "d-block";

        // Conversion en Kg / L
        var q_ingredient = conversionUnite(unite_ingredient, quantite_ingredient);

        // Calcul du GU
        var gu = q_ingredient * ppg;
        gu_str = gu.toString();
        nb_decimal = gu_str.search(/[.,]\d+$/);
        if (gu_str.substring(nb_decimal + 1).length > 5) {
            gu = gu.toFixed(6);
        } else if (gu_str.substring(nb_decimal + 1).length < 3) {
            gu = gu.toFixed(2);
        }

        // Affichage du GU
        document.getElementById('valeur_gu').innerHTML = gu;
    } else {
        masquer_gu();
    }
}

function masquer_gu() {
    document.getElementById('valeur_gu').innerHTML = "";
    document.getElementById('card_gu').className = "d-none";
}

function majOG() {
    calculOG();
}

function calculOG(quantite_biere = null) {
    if (quantite_biere == null) {
        // Récupération du volume de bière
        quantite_biere = document.getElementById('quantite_biere').value;
    }

    // Initialisation de l'IBU total
    var og = 0;

    if (quantite_biere == "" || quantite_biere == 0) {
        og = 0.00;
        og = og.toFixed(2);
    } else {
        // Récupération du tableau des ingrédients
        var tbody = document.getElementById('tbody_ingredient');

        // Récupération de chaque ligne du tableau de houblons
        var trs = tbody.getElementsByTagName('tr');

        // Pour chaque ligne...
        for (var i = 0; i < trs.length; i++) {
            // Récupération des données de la ligne
            var tds = trs[i].getElementsByTagName('td');
            if (tds[3].textContent != "") {
                var valeur_gu = parseFloat(tds[3].textContent);
                og += valeur_gu;
            }
        }
        og = (og / (quantite_biere * 100)) + 1;
        var og_str = og.toString();
        nb_decimal = og_str.search(/[.,]\d+$/);
        if (og_str.substring(nb_decimal + 1).length > 5) {
            og = og.toFixed(6);
        } else if (og_str.substring(nb_decimal + 1).length < 3) {
            og = og.toFixed(2);
        }

    }
    document.getElementById("valeur_og").innerHTML = og;
    document.getElementById("valeur_og_info_hydro").innerHTML = og;

    // Mise à jour du FG
    changerValeurFG();

    // Mise à jour de l'ABV attendu
    changerValeurABV_attendue();
}
