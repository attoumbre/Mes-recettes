function ajouterIngredient(modif = 0, quantite_biere = null, nom_ingredient = null, ingredient = null, ingredient_quantite = null, nom_ingredient_unite = null, ingredient_unite = null, ebc_ingredient = null, gu_ingredient = null) {
    if (modif == 0) {
        // Récupération des données de l'ingrédient
        var select_ingredient = document.getElementById('nom_ingredient');
        if (select_ingredient.options[select_ingredient.selectedIndex] != undefined) {
            var nom_ingredient = select_ingredient.options[select_ingredient.selectedIndex].value;
            var ingredient = select_ingredient.options[select_ingredient.selectedIndex].text;
        } else {
            var ingredient = "";
        }

        // Récupération des données de la quantité de l'ingrédient
        var select_ingredient_quantite = document.getElementById('quantite_ingredient');
        var ingredient_quantite = select_ingredient_quantite.value;

        // Récupération des données de l'unité de l'ingrédient
        var select_ingredient_unite = document.getElementById('unite_ingredient');
        var nom_ingredient_unite = select_ingredient_unite.options[select_ingredient_unite.selectedIndex].value;
        var ingredient_unite = select_ingredient_unite.options[select_ingredient_unite.selectedIndex].text;

        // Récupération de l'EBC
        var ebc_ingredient = document.getElementById('valeur_ebc').innerHTML;

        // Récupération du GU
        var gu_ingredient = document.getElementById('valeur_gu').innerHTML;
    }

    // Vérification de l'existance des données et de leur contenu
    if (ingredient != "" && ingredient_quantite != "" && ingredient_quantite >= 0) {

        // Création d'un ID unique
        var uniqId = Date.now() + Math.floor(Math.random() * 1000);

        // Initialisation de la nouvelle ligne de Table
        tabBody = document.getElementById('tbody_ingredient');
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
        btn_retirer.insertAdjacentHTML("beforeend", '<div class="text-center"><button type="button" class="btn btn-danger" onClick="retirerIngredient(' + uniqId + ');return false;">Retirer</button></div>');

        // Création de l'input Ingrédient
        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "ingredients[]");
        input.setAttribute("value", nom_ingredient);
        input.setAttribute("id", uniqId);
        document.getElementById("input_hidden_ingredient").appendChild(input);

        // Création de l'input de la quantité de l'ingrédient
        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "ingredients_quantite[]");
        input.setAttribute("value", ingredient_quantite);
        input.setAttribute("id", uniqId);
        document.getElementById("input_hidden_ingredient").appendChild(input);

        // Création de l'input de l'unité de l'ingrédient
        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "ingredients_unite[]");
        input.setAttribute("value", nom_ingredient_unite);
        input.setAttribute("id", uniqId);
        document.getElementById("input_hidden_ingredient").appendChild(input);

        // Remplissage de la table des ingrédients
        textnode1 = document.createTextNode(ingredient);
        textnode2 = document.createTextNode(ingredient_quantite);
        textnode3 = document.createTextNode(ingredient_unite);
        textnode4 = document.createTextNode(ebc_ingredient);
        textnode5 = document.createTextNode(gu_ingredient);
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
            select_ingredient.value = "";
            select_ingredient_quantite.value = "";
            select_ingredient_unite.value = "";
        }

        // Masquage du message d'erreur
        document.getElementById("erreur_ajout_ingredient").style.display = 'none';

        // Masquage de l'EBC
        masquer_ebc();

        // Masquage du GU
        masquer_gu();

        // Mise à jour de l'IBU total et de l'OG
        if (modif == 1) {
            calculEBCTotal(quantite_biere);
            calculOG(quantite_biere);
        } else {
            calculEBCTotal();
            calculOG();
        }

    } else {
        // Affichage du message d'erreur
        document.getElementById("erreur_ajout_ingredient").style.display = 'block';
    }

}

function retirerIngredient(id) {
    // Supprimer les inputs de l'ingrédient et de la ligne de Table 
    for (let i = 0; i < 4; i++) {
        var node = document.getElementById(id);
        node.parentNode.removeChild(node);
    }

    // Mise à jour de l'IBU total et de l'OG
    calculEBCTotal();
    calculOG();
}