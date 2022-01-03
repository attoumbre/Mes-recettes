function changerValeurEBC() {
    // Récupération de la valeur du SEBC de l'ingrédient
    var nom_ingredient = document.getElementById('nom_ingredient');
    var select_nom_ingredient = nom_ingredient.options[nom_ingredient.selectedIndex];
    var sebc = "";
    if (select_nom_ingredient) {
        var sebc = select_nom_ingredient.dataset.sebc;
    }

    // Récupération de la quantité de l'ingrédient
    var quantite_ingredient = document.getElementById('quantite_ingredient').value;
    if (quantite_ingredient == "") {
        quantite_ingredient = 0;
    }

    // Récupération de l'unité de mesure de l'ingrédient
    var unite_ingredient = document.getElementById('unite_ingredient').value;

    // Gestion EBC
    if (sebc != "" && unite_ingredient != "") {
        // Affichage de l'EBC
        document.getElementById('card_ebc').className = "d-block";

        // Conversion en Kg / L
        var q_ingredient = conversionUnite(unite_ingredient, quantite_ingredient);

        // Calcul EBC
        var ebc = q_ingredient * sebc;
        ebc = ebc.toFixed(2);

        // Affichage EBC
        document.getElementById("valeur_ebc").innerHTML = ebc;
    } else {
        // Masquage de l'EBC
        masquer_ebc();
    }
}

function conversionUnite(unite_ingredient, quantite_ingredient) {
    var q_ingredient = 0;
    switch (unite_ingredient) {
        case "kg":
            q_ingredient = quantite_ingredient;
            break;
        case "g":
            q_ingredient = quantite_ingredient / 100;
            break;
        case "cg":
            q_ingredient = quantite_ingredient / 100000;
            break;
        case "mg":
            q_ingredient = quantite_ingredient / 1000000;
            break;
        case "l":
            q_ingredient = quantite_ingredient;
            break;
        case "dl":
            q_ingredient = quantite_ingredient / 10;
            break;
        case "cl":
            q_ingredient = quantite_ingredient / 100;
            break;
        case "ml":
            q_ingredient = quantite_ingredient / 1000;
            break;
        default:
            q_ingredient = quantite_ingredient;
    }
    return q_ingredient;
}

function masquer_ebc() {
    document.getElementById('valeur_ebc').innerHTML = "";
    document.getElementById('card_ebc').className = "d-none";
}

function majEBC() {
    calculEBCTotal();
}

function calculEBCTotal(quantite_biere = null) {
    if (quantite_biere == null) {
        // Récupération du volume de bière
        quantite_biere = document.getElementById('quantite_biere').value;
    }

    // Initialisation de l'IBU total
    var ebcTotal = 0;

    if (quantite_biere == "" || quantite_biere == 0) {
        ebcTotal = 0.00;
    } else {

        // Récupération du tableau des ingrédients
        var tbody = document.getElementById('tbody_ingredient');

        // Récupération de chaque ligne du tableau de houblons
        var trs = tbody.getElementsByTagName('tr');

        // Pour chaque ligne...
        for (var i = 0; i < trs.length; i++) {
            // Récupération des données de la ligne
            var tds = trs[i].getElementsByTagName('td');
            if (tds[2].textContent != "") {
                var valeur_ebc = parseFloat(tds[2].textContent);
                ebcTotal += valeur_ebc;
            }
        }
        ebcTotal = ebcTotal * 7.5 / quantite_biere;
        ebcTotal = ebcTotal.toFixed(2);
    }
    document.getElementById("ebc_total").innerHTML = ebcTotal;

    // Changer couleur de la bière
    changerCouleurBiere();
}

function changerCouleurBiere() {
    // Récupération de la valeur EBC total et conversion en float
    var ebcTotal = document.getElementById("ebc_total").innerHTML;
    ebcTotal = parseFloat(ebcTotal);

    // Récupération de la couleur de la bière
    var couleur_biere = "";
    switch (true) {
        case (ebcTotal == 0):
            couleur_biere = "#FFFFFF";
            break;
        case (ebcTotal < 0.9):
            couleur_biere = "#FFF4D4";
            break;
        case (ebcTotal < 2.9):
            couleur_biere = "#FFE699";
            break;
        case (ebcTotal < 4.9):
            couleur_biere = "#FFD878";
            break;
        case (ebcTotal < 6.8):
            couleur_biere = "#FFCA5A";
            break;
        case (ebcTotal < 8.8):
            couleur_biere = "#FFBF42";
            break;
        case (ebcTotal < 10.8):
            couleur_biere = "#FBB123";
            break;
        case (ebcTotal < 12.7):
            couleur_biere = "#F8A600";
            break;
        case (ebcTotal < 14.7):
            couleur_biere = "#F39C00";
            break;
        case (ebcTotal < 16.7):
            couleur_biere = "#EA8F00";
            break;
        case (ebcTotal < 18.7):
            couleur_biere = "#E58500";
            break;
        case (ebcTotal < 20.6):
            couleur_biere = "#DE7C00";
            break;
        case (ebcTotal < 22.6):
            couleur_biere = "#D77200";
            break;
        case (ebcTotal < 24.6):
            couleur_biere = "#CF6900";
            break;
        case (ebcTotal < 26.5):
            couleur_biere = "#CB6200";
            break;
        case (ebcTotal < 28.5):
            couleur_biere = "#C35900";
            break;
        case (ebcTotal < 30.5):
            couleur_biere = "#BB5100";
            break;
        case (ebcTotal < 32.4):
            couleur_biere = "#B54C00";
            break;
        case (ebcTotal < 34.4):
            couleur_biere = "#B04500";
            break;
        case (ebcTotal < 36.4):
            couleur_biere = "#A63E00";
            break;
        case (ebcTotal < 38.3):
            couleur_biere = "#A13700";
            break;
        case (ebcTotal < 40.3):
            couleur_biere = "#9B3200";
            break;
        case (ebcTotal < 42.3):
            couleur_biere = "#952D00";
            break;
        case (ebcTotal < 44.2):
            couleur_biere = "#8E2900";
            break;
        case (ebcTotal < 46.2):
            couleur_biere = "#882300";
            break;
        case (ebcTotal < 48.2):
            couleur_biere = "#821E00";
            break;
        case (ebcTotal < 50.1):
            couleur_biere = "#7B1A00";
            break;
        case (ebcTotal < 52.1):
            couleur_biere = "#771900";
            break;
        case (ebcTotal < 54.1):
            couleur_biere = "#701400";
            break;
        case (ebcTotal < 56.1):
            couleur_biere = "#6A0E00";
            break;
        case (ebcTotal < 58.0):
            couleur_biere = "#660D00";
            break;
        case (ebcTotal < 60.0):
            couleur_biere = "#660D00";
            break;
        case (ebcTotal < 62.0):
            couleur_biere = "#5A0A02";
            break;
        case (ebcTotal < 63.9):
            couleur_biere = "#600903";
            break;
        case (ebcTotal < 65.9):
            couleur_biere = "#520907";
            break;
        case (ebcTotal < 67.9):
            couleur_biere = "#4C0505";
            break;
        case (ebcTotal < 69.8):
            couleur_biere = "#470606";
            break;
        case (ebcTotal < 71.8):
            couleur_biere = "#420607";
            break;
        case (ebcTotal < 73.8):
            couleur_biere = "#3D0708";
            break;
        case (ebcTotal < 75.7):
            couleur_biere = "#370607";
            break;
        case (ebcTotal < 77.7):
            couleur_biere = "#2D0607";
            break;
        case (ebcTotal < 79.7):
            couleur_biere = "#1F0506";
            break;
        case (ebcTotal >= 79.7):
            couleur_biere = "#000000";
            break;
        default:
            couleur_biere = "#FFFFFF";
    }
    document.getElementById("couleur_biere_affichage").style.backgroundColor = couleur_biere;
}