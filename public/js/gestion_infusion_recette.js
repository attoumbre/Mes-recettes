function ajouterInfusion(modif = 0, infusion_nom = null, infusion_temperature = null, infusion_temps = null) {
    if (modif == 0) {
        // Récupération des données du nom de l'infusion
        var select_infusion_nom = document.getElementById('nom_infusion');
        var infusion_nom = select_infusion_nom.value;

        // Récupération des données de la température de l'infusion
        var select_infusion_temperature = document.getElementById('temperature_infusion');
        var infusion_temperature = select_infusion_temperature.value;

        // Récupération des données du temps de l'infusion
        var select_infusion_temps = document.getElementById('temps_infusion');
        var infusion_temps = select_infusion_temps.value;
    }

    // Vérification de l'existance des données
    if (infusion_nom != "" && infusion_temperature != "" && infusion_temps != "" && infusion_temperature >= 0 && infusion_temps >= 0) {

        // Création d'un ID unique
        var uniqId = Date.now() + Math.floor(Math.random() * 1000);

        // Initialisation de la nouvelle ligne de Table
        tabBody = document.getElementById('tbody_infusion');
        row = document.createElement("tr");
        row.setAttribute("id", uniqId);
        cell1 = document.createElement("th");
        cell2 = document.createElement("td");
        cell3 = document.createElement("td");
        cell4 = document.createElement("td");

        // Création du bouton "Retirer"
        var btn_retirer = document.createElement("td");
        btn_retirer.insertAdjacentHTML("beforeend", '<div class="text-center"><button type="button" class="btn btn-danger" onClick="retirerInfusion(' + uniqId + ');return false;">Retirer</button></div>');

        // Création de l'input du nom de l'infusion
        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "infusion_nom[]");
        input.setAttribute("value", infusion_nom);
        input.setAttribute("id", uniqId);
        document.getElementById("input_hidden_infusion").appendChild(input);

        // Création de l'input de la température de l'infusion
        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "infusion_temperature[]");
        input.setAttribute("value", infusion_temperature);
        input.setAttribute("id", uniqId);
        document.getElementById("input_hidden_infusion").appendChild(input);

        // Création de l'input du temps de l'infusion
        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "infusion_temps[]");
        input.setAttribute("value", infusion_temps);
        input.setAttribute("id", uniqId);
        document.getElementById("input_hidden_infusion").appendChild(input);

        // Remplissage de la table des infusions
        textnode1 = document.createTextNode(infusion_nom);
        textnode2 = document.createTextNode(infusion_temperature);
        textnode3 = document.createTextNode(infusion_temps);
        textnode4 = document.createTextNode("");
        cell1.appendChild(textnode1);
        cell2.appendChild(textnode2);
        cell3.appendChild(textnode3);
        cell4.appendChild(textnode4);
        row.appendChild(cell1);
        row.appendChild(cell2);
        row.appendChild(cell3);
        row.appendChild(btn_retirer);
        tabBody.appendChild(row);

        // Réinitialisation des inputs
        if (modif == 0) {
            select_infusion_nom.value = "";
            select_infusion_temperature.value = "";
            select_infusion_temps.value = "";
        }

        // Camouflage du message d'erreur
        document.getElementById("erreur_ajout_infusion").style.display = 'none';

    } else {
        // Affichage du message d'erreur
        document.getElementById("erreur_ajout_infusion").style.display = 'block';
    }

}

function retirerInfusion(id) {
    // Supprimer les inputs de l'infusion et de la ligne de Table 
    for (let i = 0; i < 4; i++) {
        var node = document.getElementById(id);
        node.parentNode.removeChild(node);
    }
}