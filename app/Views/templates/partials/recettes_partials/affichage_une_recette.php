<?php
// Type de bière de la recette
$type_biere = "";
switch ($recette->type_biere) {
    case "biere_blanche":
        $type_biere = "Bière blanche";
        break;
    case "biere_blonde":
        $type_biere = "Bière blonde";
        break;
    case "biere_brune":
        $type_biere = "Bière brune";
        break;
    case "biere_rousse":
        $type_biere = "Bière ambrée ou rousse";
        break;
}

// Image de la recette
$image = ($recette->image) ? $recette->image : "img_recettes_default.jpg";

// Couleur dominante de l'image
$couleur_dominante_img = dominant_color("../public/img/img_recettes/" . $image);

// Quantité de la recette
$quantite_biere = ($recette->quantite < 2) ? $recette->quantite . " Litre" : $recette->quantite . " Litres";

// Temps d'ébullition de la recette
$temps_ebullition_biere = ($recette->temps_ebullition < 2) ? $recette->temps_ebullition . " Minute" : $recette->temps_ebullition . " Minutes";

// Date de création de la recette
$date_creation = new DateTime($recette->date_creation);
$date_creation = $date_creation->format('d/m/Y à H:i:s');

// Date de création de la recette
$date_modification = new DateTime($recette->date_modification);
$date_modification = $date_modification->format('d/m/Y à H:i:s');

// Gestion des recettes favorites
if ($_SESSION) :
    $tab_id_favoris = [];
    foreach ($id_favoris as &$id) :
        array_push($tab_id_favoris, $id->id_recette);
    endforeach;
    $coeur_fav = "coeur_vide.png";
    if (in_array($recette->id_recette, $tab_id_favoris)) {
        $coeur_fav = "coeur_plein.png";
    }
endif;

// Gestion de la densité de pré-ébullition
$densite_pe = affichageDensite($recette->gravite_pre_ebullition);

// Gestion de la densité d'après-ébullition
$densite_ae = affichageDensite($recette->gravite_apres_ebullition);

// Gestion de la densité lors du soutirage
$densite_soutirage = affichageDensite($recette->gravite_soutirage);

// Gestion de la densité finale
$densite_finale = affichageDensite($recette->gravite_finale);

// Calcul IBU
$ibu_total = 0;
$ibu_total = number_format($ibu_total, 2);
foreach ($houblon as &$h) {
    $ibu_houblon = $h->quantite * $h->acide_alpha * $h->temps_ebullition * 0.03 / $recette->quantite;
    $ibu_houblon = number_format($ibu_houblon, 2);
    $ibu_total += $ibu_houblon;
    $ibu_total = number_format($ibu_total, 2);
}

// Calcul EBC et OG
$ebc_total = 0;
$og = 0;
foreach ($ingredient as &$ing) {
    switch ($ing->unite_mesure) {
        case "kg":
            $quantite_ingredient = $ing->quantite;
            break;
        case "g":
            $quantite_ingredient = $ing->quantite / 100;
            break;
        case "cg":
            $quantite_ingredient = $ing->quantite / 100000;
            break;
        case "mg":
            $quantite_ingredient = $ing->quantite / 1000000;
            break;
        case "l":
            $quantite_ingredient = $ing->quantite;
            break;
        case "dl":
            $quantite_ingredient = $ing->quantite / 10;
            break;
        case "cl":
            $quantite_ingredient = $ing->quantite / 100;
            break;
        case "ml":
            $quantite_ingredient = $ing->quantite / 1000;
            break;
        default:
            $quantite_ingredient = $ing->quantite;
    }
    // Calcul EBC
    $ebc_ingredient = $quantite_ingredient * $ing->sebc;
    $ebc_ingredient = number_format($ebc_ingredient, 2);
    $ebc_total += $ebc_ingredient;
    $ebc_total = number_format($ebc_total, 2);

    // Calcul OG
    $gu_ingredient = $quantite_ingredient * $ing->ppg;
    $og += $gu_ingredient;
}
// Calcul EBC 2
$ebc_total = $ebc_total * 7.5 / $recette->quantite;
$ebc_total = number_format($ebc_total, 2);
// Calcul OG 2
$og = ($og / ($recette->quantite * 100)) + 1;
$og = affichageDensite($og);

// Récupération de la couleur de la bière
$couleur_biere_hex = couleur_biere($ebc_total);

// Calcul FG
$fg = $og - (($og - 1) * $levure->attenuation_moyenne / 100);
$fg = affichageDensite($fg);

// Calcul ABV attendu
$abv_attendu = ($og - $fg) * 131.25;
$abv_attendu = number_format($abv_attendu, 2);

// Calcul ABV réel
$abv_reel = ($densite_pe - $densite_finale) * 131.25;
$abv_reel = number_format($abv_reel, 2);


function affichageDensite($densite_recette)
{
    $densite = $densite_recette;
    if (strpos($densite, '.') !== false) {
        $decimal = explode('.', $densite);
        $nb_decimal = strlen(array_pop($decimal));
        $densite = ($nb_decimal > 2) ? number_format($densite, $nb_decimal) : number_format($densite, 2);
        $densite = ($nb_decimal > 6) ? number_format($densite, 6) : $densite;
    } else {
        $densite = number_format($densite, 2);
    }
    return $densite;
}

function dominant_color($url)
{
    $image_type = mime_content_type($url);
    if ($image_type == "image/png") {
        $i = imagecreatefrompng($url);
    } else if ($image_type == "image/jpeg") {
        $i = imagecreatefromjpeg($url);
    }
    $rTotal  = 0;
    $bTotal  = 0;
    $gTotal  = 0;
    $total = 0;
    for ($x = 0; $x < imagesx($i); $x += 100) {
        for ($y = 0; $y < imagesy($i); $y++) {
            $rgb = imagecolorat($i, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $rTotal += $r;
            $gTotal += $g;
            $bTotal += $b;
            $total++;
        }
    }

    $r = round($rTotal / $total);
    $g = round($gTotal / $total);
    $b = round($bTotal / $total);

    $color = sprintf("#%02x%02x%02x", $r, $g, $b);
    return $color;
}

function couleur_biere($ebcTotal)
{
    $couleur_biere = "";
    switch (true) {
        case ($ebcTotal == 0):
            $couleur_biere = "#FFFFFF";
            break;
        case ($ebcTotal < 0.9):
            $couleur_biere = "#FFF4D4";
            break;
        case ($ebcTotal < 2.9):
            $couleur_biere = "#FFE699";
            break;
        case ($ebcTotal < 4.9):
            $couleur_biere = "#FFD878";
            break;
        case ($ebcTotal < 6.8):
            $couleur_biere = "#FFCA5A";
            break;
        case ($ebcTotal < 8.8):
            $couleur_biere = "#FFBF42";
            break;
        case ($ebcTotal < 10.8):
            $couleur_biere = "#FBB123";
            break;
        case ($ebcTotal < 12.7):
            $couleur_biere = "#F8A600";
            break;
        case ($ebcTotal < 14.7):
            $couleur_biere = "#F39C00";
            break;
        case ($ebcTotal < 16.7):
            $couleur_biere = "#EA8F00";
            break;
        case ($ebcTotal < 18.7):
            $couleur_biere = "#E58500";
            break;
        case ($ebcTotal < 20.6):
            $couleur_biere = "#DE7C00";
            break;
        case ($ebcTotal < 22.6):
            $couleur_biere = "#D77200";
            break;
        case ($ebcTotal < 24.6):
            $couleur_biere = "#CF6900";
            break;
        case ($ebcTotal < 26.5):
            $couleur_biere = "#CB6200";
            break;
        case ($ebcTotal < 28.5):
            $couleur_biere = "#C35900";
            break;
        case ($ebcTotal < 30.5):
            $couleur_biere = "#BB5100";
            break;
        case ($ebcTotal < 32.4):
            $couleur_biere = "#B54C00";
            break;
        case ($ebcTotal < 34.4):
            $couleur_biere = "#B04500";
            break;
        case ($ebcTotal < 36.4):
            $couleur_biere = "#A63E00";
            break;
        case ($ebcTotal < 38.3):
            $couleur_biere = "#A13700";
            break;
        case ($ebcTotal < 40.3):
            $couleur_biere = "#9B3200";
            break;
        case ($ebcTotal < 42.3):
            $couleur_biere = "#952D00";
            break;
        case ($ebcTotal < 44.2):
            $couleur_biere = "#8E2900";
            break;
        case ($ebcTotal < 46.2):
            $couleur_biere = "#882300";
            break;
        case ($ebcTotal < 48.2):
            $couleur_biere = "#821E00";
            break;
        case ($ebcTotal < 50.1):
            $couleur_biere = "#7B1A00";
            break;
        case ($ebcTotal < 52.1):
            $couleur_biere = "#771900";
            break;
        case ($ebcTotal < 54.1):
            $couleur_biere = "#701400";
            break;
        case ($ebcTotal < 56.1):
            $couleur_biere = "#6A0E00";
            break;
        case ($ebcTotal < 58.0):
            $couleur_biere = "#660D00";
            break;
        case ($ebcTotal < 60.0):
            $couleur_biere = "#660D00";
            break;
        case ($ebcTotal < 62.0):
            $couleur_biere = "#5A0A02";
            break;
        case ($ebcTotal < 63.9):
            $couleur_biere = "#600903";
            break;
        case ($ebcTotal < 65.9):
            $couleur_biere = "#520907";
            break;
        case ($ebcTotal < 67.9):
            $couleur_biere = "#4C0505";
            break;
        case ($ebcTotal < 69.8):
            $couleur_biere = "#470606";
            break;
        case ($ebcTotal < 71.8):
            $couleur_biere = "#420607";
            break;
        case ($ebcTotal < 73.8):
            $couleur_biere = "#3D0708";
            break;
        case ($ebcTotal < 75.7):
            $couleur_biere = "#370607";
            break;
        case ($ebcTotal < 77.7):
            $couleur_biere = "#2D0607";
            break;
        case ($ebcTotal < 79.7):
            $couleur_biere = "#1F0506";
            break;
        case ($ebcTotal >= 79.7):
            $couleur_biere = "#000000";
            break;
        default:
            $couleur_biere = "#FFFFFF";
    }
    return $couleur_biere;
}
