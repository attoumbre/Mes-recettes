<?php

// Ajouter les ingrédients dans le tableau
foreach ($quantite_ingredient as &$ing) :
?>
    <script>
        // Récupération du nom de la mesure
        var unite_mesure = "<?= $ing->unite_mesure ?>";
        var ingredient_unite = "";
        switch (unite_mesure) {
            case "kg":
                ingredient_unite = "Kilogramme";
                break;
            case "g":
                ingredient_unite = "Gramme";
                break;
            case "cg":
                ingredient_unite = "Centigramme";
                break;
            case "mg":
                ingredient_unite = "Milligramme";
                break;
            case "l":
                ingredient_unite = "Litre";
                break;
            case "dl":
                ingredient_unite = "Décilitre";
                break;
            case "cl":
                ingredient_unite = "Centilitre";
                break;
            case "ml":
                ingredient_unite = "Millilitre";
                break;
            default:
                ingredient_unite = "";
        }
        // Conversion de la quantité de l'ingrédient en Kg / L
        var q_ingredient = conversionUnite("<?= $ing->unite_mesure ?>", <?= $ing->quantite ?>);
        // Calcul EBC de l'ingrédient
        var ebc_ingredient = q_ingredient * <?= $ing->sebc ?>;
        ebc_ingredient = ebc_ingredient.toFixed(2);
        // Calcul GU de l'ingrédient
        var gu_ingredient = q_ingredient * <?= $ing->ppg ?>;
        gu_str = gu_ingredient.toString();
        nb_decimal = gu_str.search(/[.,]\d+$/);
        if (gu_str.substring(nb_decimal + 1).length > 5) {
            gu_ingredient = gu_ingredient.toFixed(6);
        } else if (gu_str.substring(nb_decimal + 1).length < 3) {
            gu_ingredient = gu_ingredient.toFixed(2);
        }
        // Ajout de l'ingrédient
        ajouterIngredient(<?= $modif ?>, <?= $recette->quantite ?>, <?= $ing->id_ingredient ?>, "<?= $ing->nom ?>", <?= $ing->quantite ?>, "<?= $ing->unite_mesure ?>", ingredient_unite, ebc_ingredient, gu_ingredient);
    </script>
<?php
endforeach;

// Ajouter les types de houblon dans le tableau
foreach ($quantite_houblon as &$h) :
?>
    <script>
        // Ajout du houblon
        ajouterHoublon(<?= $modif ?>, <?= $recette->quantite ?>, <?= $h->id_houblon ?>, "<?= $h->nom ?>", <?= $h->quantite ?>, <?= $h->acide_alpha ?>, <?= $h->temps_ebullition ?>);
    </script>
<?php
endforeach;

// Ajouter les infusions dans le tableau
foreach ($infusion as &$inf) :
?>
    <script>
        // Ajout de l'infusion
        ajouterInfusion(<?= $modif ?>, "<?= $inf->nom ?>", <?= $inf->temperature ?>, <?= $inf->temps ?>);
    </script>
<?php
endforeach;

?>