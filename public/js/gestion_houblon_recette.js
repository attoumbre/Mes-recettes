function ajouterHoublon(modif = 0, quantite_biere = null, nom_houblon = null, houblon = null, houblon_quantite = null, houblon_aa = null, houblon_ebullition = null) {
    if (modif == 0) {
        // Récupération des données du type de Houblon
        var select_houblon = document.getElementById('nom_houblon');
        if (select_houblon.options[select_houblon.selectedIndex] != undefined) {
            var nom_houblon = select_houblon.options[select_houblon.selectedIndex].value;
            var houblon = select_houblon.options[select_houblon.selectedIndex].text;
        } else {
            var nom_houblon = "";
        }

        // Récupération des données de la quantité de Houblon
        var select_houblon_quantite = document.getElementById('quantite_houblon');
        var houblon_quantite = select_houblon_quantite.value;

        // Récupération des données du taux d'acide-alpha du Houblon
        var select_houblon_aa = document.getElementById('taux_aa_houblon');
        var houblon_aa = select_houblon_aa.value;

        // Récupération des données du temps d'ébullition du Houblon
        var select_houblon_ebullition = document.getElementById('temps_ebullition_houblon');
        var houblon_ebullition = select_houblon_ebullition.value;

        // Récupération de la quantité de bière
        var quantite_biere = document.getElementById('quantite_biere').value;
    }

    // Vérification de l'existance des données
    if (nom_houblon != "" && houblon_quantite != "" && houblon_aa != "" && houblon_ebullition != "" && houblon_quantite >= 0 && houblon_aa >= 0 && houblon_ebullition >= 0) {

        // Calcul de l'IBU
        if (quantite_biere == "") {
            var ibu = 0.0;
        } else {
            var ibu = houblon_quantite * houblon_aa * houblon_ebullition * 0.03 / quantite_biere;
            ibu = ibu.toFixed(2);
        }

        // Création d'un ID unique
        var uniqId = Date.now() + Math.floor(Math.random() * 1000);

        // Initialisation de la nouvelle ligne de Table
        tabBody = document.getElementById('tbody_houblon');
        row = document.createElement("tr");
        row.setAttribute("id", uniqId);
        cell1 = document.createElement("th");
        cell2 = document.createElement("td");
        cell3 = document.createElement("td");
        cell4 = document.createElement("td");
        cell5 = document.createElement("td");
        cell6 = document.createElement("td");

        // Création du bouton "Retirer"
        var btn_retirer = document.createElement("td");
        btn_retirer.insertAdjacentHTML("beforeend", '<div class="text-center"><button type="button" class="btn btn-danger" onClick="retirerHoublon(' + uniqId + ');return false;">Retirer</button></div>');

        // Création de l'input Houblon
        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "houblons[]");
        input.setAttribute("value", nom_houblon);
        input.setAttribute("id", uniqId);
        document.getElementById("input_hidden_houblon").appendChild(input);

        // Création de l'input de la quantité du Houblon
        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "houblons_quantite[]");
        input.setAttribute("value", houblon_quantite);
        input.setAttribute("id", uniqId);
        document.getElementById("input_hidden_houblon").appendChild(input);

        // Création de l'input du taux d'acide-alpha du Houblon
        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "houblons_taux_aa[]");
        input.setAttribute("value", houblon_aa);
        input.setAttribute("id", uniqId);
        document.getElementById("input_hidden_houblon").appendChild(input);

        // Création de l'input du temps d'ébullition du Houblon
        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "houblons_temps_ebullition[]");
        input.setAttribute("value", houblon_ebullition);
        input.setAttribute("id", uniqId);
        document.getElementById("input_hidden_houblon").appendChild(input);

        // Remplissage de la table des types de houblon
        textnode1 = document.createTextNode(houblon);
        textnode2 = document.createTextNode(houblon_quantite);
        textnode3 = document.createTextNode(houblon_aa);
        textnode4 = document.createTextNode(houblon_ebullition);
        textnode5 = document.createTextNode(ibu);
        textnode6 = document.createTextNode("");
        cell1.appendChild(textnode1);
        cell2.appendChild(textnode2);
        cell3.appendChild(textnode3);
        cell4.appendChild(textnode4);
        cell5.appendChild(textnode5);
        cell6.appendChild(textnode6);
        row.appendChild(cell1);
        row.appendChild(cell2);
        row.appendChild(cell3);
        row.appendChild(cell4);
        row.appendChild(cell5);
        row.appendChild(btn_retirer);
        tabBody.appendChild(row);

        // Réinitialisation des inputs
        if (modif == 0) {
            select_houblon.value = "";
            select_houblon_quantite.value = "";
            select_houblon_aa.value = "";
            select_houblon_ebullition.value = "";
            document.getElementById("valeur_ibu").innerHTML = 0.0;
        }

        // Camouflage du message d'erreur
        document.getElementById("erreur_ajout_houblon").style.display = 'none';

        // Mise à jour de l'IBU total
        calculIBUTotal();

    } else {
        // Affichage du message d'erreur
        document.getElementById("erreur_ajout_houblon").style.display = 'block';
    }

}

function retirerHoublon(id) {
    // Supprimer les inputs du Houblon et de la ligne de Table 
    for (let i = 0; i < 5; i++) {
        var node = document.getElementById(id);
        node.parentNode.removeChild(node);
    }

    // Mise à jour de l'IBU total
    calculIBUTotal();
}