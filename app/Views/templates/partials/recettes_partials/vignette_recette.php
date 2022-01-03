<?php

function vignette_recette($recette, $nom_page = '', $mode = 3, $id_favoris = [])
{
    switch ($mode) {
        case 2:
            $class_col = "col-lg-6";
            break;
        case "carousel":
            $class_col = "recent_item pb-3";
            break;
        default:
            $class_col = "col-xl-4 col-lg-6";
            break;
    }

    // class_col spéciale
    $class_col = ($nom_page == "favoris" || $nom_page == "persos") ? $class_col . '" id="vignette_' . $recette->id_recette . '"' : $class_col;

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
    $quantite = ($recette->quantite < 2) ? $recette->quantite . " litre" : $recette->quantite . " litres";

    // Temps d'ébullition de la recette
    $temps_ebullition = ($recette->temps_ebullition < 2) ? $recette->temps_ebullition . " minute" : $recette->temps_ebullition . " minutes";

    // Date de création de la recette
    $date_creation = new DateTime($recette->date_creation);
    $date_creation = $date_creation->format('d/m/Y');

    // Gestion des recettes favorites
    if ($_SESSION && $nom_page != "favoris" && $nom_page != "persos") :
        $tab_id_favoris = [];
        foreach ($id_favoris as &$id) :
            array_push($tab_id_favoris, $id->id_recette);
        endforeach;
        $coeur_fav = "coeur_vide.png";
        if (in_array($recette->id_recette, $tab_id_favoris)) {
            $coeur_fav = "coeur_plein.png";
        }
    endif;

    ob_start();
?>
    <div class="<?= $class_col ?>">
        <div class="w-100 mb-3">
            <div class="w-100 photo_blur">
                <a href="?p=recettes.show&id_recette=<?= $recette->id_recette ?>">
                    <img class="w-100 img-vignette rounded-3" style="background-color:<?= $couleur_dominante_img ?>" src="../public/img/img_recettes/<?= $image ?>" />
                </a>
                <?php if ($_SESSION && $nom_page != "favoris" && $nom_page != "persos") : ?>
                    <a class="favori">
                        <img src="../public/img/logos_icons/<?= $coeur_fav; ?>" alt="" id="favori_<?= $recette->id_recette; ?>" class="img_favori favori_img_<?= $recette->id_recette; ?>" onclick="ajout_suppression_favori(<?= $recette->id_recette; ?>);">
                    </a>
                <?php endif; ?>
                <div class="bg-pink-ff2d6d position-absolute top-20 left-20 text-center height-30">
                    <a class="d-block ps-3 pe-3 text-white line-height-33" href="?p=recettes.show&id_recette=<?= $recette->id_recette ?>"><?= $type_biere ?></a>
                </div>
            </div>
            <div class="pt-2 pb-2 bg-grey-eff2f6 text-center height_vignette overflow-auto">
                <a class="h3 font-weight-600 text-dark color_blue_3f6fce_hover" href="?p=recettes.show&id_recette=<?= $recette->id_recette ?>"><?= $recette->nom ?></a>
                <div class="mt-2 mb-2 h5 font-weight-600 color-blue-3f6fce">Description :</div>
                <?php
                $description = substr($recette->description, 0, 255);
                if (strlen($recette->description) > 255) :
                    $description .= '...';
                endif;
                ?>
                <div class="text-start me-4 ms-4 lh-sm"><?= $description ?></div>
            </div>
            <div class="text-white d-flex justify-content-around align-items-center flex-wrap w-100 height-50 bg-_dark_grey">
                <div>
                    <div class="width-23 d-inline-block height-14">
                        <img src="../public/img/logos_icons/volume.ico" alt="" class="vignette_icones pb-1">
                    </div>
                    <span><?= $quantite ?></span>
                </div>
                <div>
                    <div class="width-23 d-inline-block height-14">
                        <img src="../public/img/logos_icons/temps_ebullition.ico" alt="" class="vignette_icones pb-1">
                    </div>
                    <span><?= $temps_ebullition ?></span>
                </div>
                <div>
                    <div class="width-23 d-inline-block height-14">
                        <img src="../public/img/logos_icons/date_creation.ico" alt="" class="vignette_icones pb-1">
                    </div>
                    <span><?= $date_creation ?></span>
                </div>
            </div>

            <?php
            if ($nom_page == 'favoris') :
            ?>
                <div class="text-white d-flex justify-content-around align-items-center flex-wrap w-100 height-50 bg-_dark_grey">
                    <div class="h-100 w-100">
                        <a class="suppF">
                            <button class="h-100 w-100 h6 border-0 btn-danger font-weight-600" id="" data-bs-toggle="modal" data-bs-target="#modal_confirm" onclick="modal_del_fav_change_onclick(<?= $recette->id_recette; ?>)">Retirer de mes favoris</button>
                        </a>
                    </div>
                </div>
            <?php
            endif;
            if ($nom_page == 'persos') :
            ?>
                <div class="text-white d-flex justify-content-around align-items-center flex-wrap w-100 height-50 bg-_dark_grey">
                    <div class="h-100 w-100">
                        <a href="?p=user.recettes.modifier&id_recette=<?= $recette->id_recette ?>">
                            <button class="h-100 w-50 h6 border-0 font-weight-600 bg-green-74bb4f text-white">Modifier la recette</button>
                        </a>
                    </div>
                    <div class="h-100 w-100 position-absolute start-50">
                        <a class="suppA">
                            <button class="h-100 w-50 h6 border-0 btn-danger font-weight-600" id="btn_supp_recette" data-bs-toggle="modal" data-bs-target="#modal_confirm" onclick="modal_del_recette_change_onclick(<?= $recette->id_recette; ?>, 'perso')">Supprimer la recette</button>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php
    return ob_get_clean();
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
