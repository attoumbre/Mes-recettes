function changerValeurIBU() {
    var quantite_biere = document.getElementById('quantite_biere').value;
    var taux_aa_houblon = document.getElementById('taux_aa_houblon').value;
    var quantite_houblon = document.getElementById('quantite_houblon').value;
    var temps_ebullition_houblon = document.getElementById('temps_ebullition_houblon').value;
    if (taux_aa_houblon == "") {
        taux_aa_houblon = 0
    }
    if (quantite_houblon == "") {
        quantite_houblon = 0
    }
    if (temps_ebullition_houblon == "") {
        temps_ebullition_houblon = 0
    }
    if (quantite_biere == "" || quantite_biere == 0) {
        document.getElementById("valeur_ibu").innerHTML = 0.00;
    } else {
        var ibu = quantite_houblon * taux_aa_houblon * temps_ebullition_houblon * 0.03 / quantite_biere;
        ibu = ibu.toFixed(2);
        document.getElementById("valeur_ibu").innerHTML = ibu;
    }

}

function majIBUs() {
    // Récupération de la quantité de bière
    var quantite_biere = document.getElementById('quantite_biere').value;

    // Récupération du tableau de houblons
    var tbody = document.getElementById('tbody_houblon');

    // Récupération de chaque ligne du tableau de houblons
    var trs = tbody.getElementsByTagName('tr');

    // Pour chaque ligne...
    for (var i = 0; i < trs.length; i++) {
        // Récupération des données de la ligne
        var tds = trs[i].getElementsByTagName('td');
        var donnees_houblon = [];
        for (var j = 0; j < 3; j++) {
            var valeur = tds[j].textContent;
            donnees_houblon.push(valeur);
        }

        // Calcul du nouveau IBU
        var ibu = donnees_houblon[0] * donnees_houblon[1] * donnees_houblon[2] * 0.03 / quantite_biere;
        ibu = ibu.toFixed(2);

        // Changement de la valeur de l'IBU dans la ligne du tableau
        if (quantite_biere == "" || quantite_biere == 0) {
            tds[3].innerHTML = 0.00;
        } else {
            tds[3].innerHTML = ibu;
        }
    }
    calculIBUTotal();
}

function calculIBUTotal() {
    // Récupération du tableau de houblons
    var tbody = document.getElementById('tbody_houblon');

    // Récupération de chaque ligne du tableau de houblons
    var trs = tbody.getElementsByTagName('tr');

    // Initialisation de l'IBU total
    var ibuTotal = 0;

    // Pour chaque ligne...
    for (var i = 0; i < trs.length; i++) {
        // Récupération des données de la ligne
        var tds = trs[i].getElementsByTagName('td');
        var valeur_ibu = parseFloat(tds[3].textContent);
        ibuTotal += valeur_ibu;
    }
    ibuTotal = ibuTotal.toFixed(2);
    document.getElementById("ibu_total").innerHTML = ibuTotal;
}