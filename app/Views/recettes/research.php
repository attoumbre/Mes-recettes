<form class="search_form d-flex flex-row align-items-start justfy-content-start" method="POST" action="controller/rechercheBienRequest.php">
    <input type='hidden' name='categorie' value='<?php ?>'>
    <div class="search_form_content d-flex flex-row align-items-start justfy-content-start flex-wrap">
        <div class='big'>
            <label class="ville_recherche">Nom de recette :</label>
            <input type='text' name='recette' id='ville' class='' />
        </div>
        <div class='big'>
            <select name='piece' id='piece' class='search_form_select'>
                <option value='0' selected>Types de bière</option>
                <option value='0'>Bières blanches</option>
                <option value='1'>Bières blondes</option>
                <option value='2'>Bières brunes</option>
                <option value='3'>Bières ambrées/rousse</option>

            </select>
        </div>
        <div class='medium'>
            <select name='surface' id='surface' class='search_form_select'>
                <option value='0' selected>Trier par :</option>
                <option value='50'>Recettes les plus récentes</option>
                <option value='100'>Recettes les plus anciennes</option>
                <option value='200'>Recettes les plus aimées</option>
                <option value='201'>Ordre alphabétique</option>
                <option value='0'> - Ordre alphabétique</option>
            </select>
        </div>
    </div>
    <input type='submit' id='' class='search_form_button ml-auto' value='Valider'>
</form>