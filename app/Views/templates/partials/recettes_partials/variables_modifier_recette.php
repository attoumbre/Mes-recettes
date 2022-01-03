<?php

// Titre principal
$modif = false;
$titre_principal = "";
if ($titre_page == "Créer une recette") {
    $titre_principal = "Nouvelle Recette";
} elseif ($titre_page == "Modifier une recette") {
    $titre_principal = "Modification d'une Recette";
    $modif = true;
}

// INFORMATIONS GENERALES
// Titre de la recette
$m_titre_recette = ($modif) ? $recette->nom : "";

// Type de bière
$m_type_biere = ($modif) ? $recette->type_biere : "";

// Quantité de bière
$m_quantite_biere = ($modif) ? $recette->quantite : "";

// Temps d'ébullition de la bière
$m_temps_ebullition_biere = ($modif) ? $recette->temps_ebullition : "";

// Description de la recette
$m_description_recette = ($modif) ? $recette->description : "";

// Image de la recette
$m_image_recette_affichage = ($modif) ? "display:initial" : "display:none";
$m_image_recette_src = ($modif) ? "../public/img/img_recettes/" . $recette->image : "";
$m_onchange_supprimer_img = ($modif) ? 'supprimerAncienneImage();' : "";

// LEVURE
// Nom de la levure
$m_nom_levure = ($modif) ? $levure->nom : "";

// Attenuation moyenne de la levure
$m_avg_attenuation_levure = ($modif) ? $levure->attenuation_moyenne : "";

// Température optimale de la levure
$m_avg_temperature_levure = ($modif) ? $levure->temperature_optimale : "";

// INFORMATIONS HYDROMETRIQUES 
// Densité de pré-ébullition
$m_densite_pe = ($modif) ? $recette->gravite_pre_ebullition : "";

// Densité d'après-ébullition
$m_densite_ae = ($modif) ? $recette->gravite_apres_ebullition : "";

// Densité lors du soutirage
$m_densite_soutirage = ($modif) ? $recette->gravite_soutirage : "";

// Densité finale
$m_densite_finale = ($modif) ? $recette->gravite_finale : "";

// ABV réel
if ($modif) {
    $m_abv_reel = ($recette->gravite_pre_ebullition - $recette->gravite_finale) * 131.25;
    $m_abv_reel = number_format($m_abv_reel, 2);
}

// Submit
$valeur_submit = ($modif) ? "Modifier la recette" : "Enregistrer et publier la recette";
