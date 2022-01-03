<!DOCTYPE html>
<html lang="fr">

<?php
// Header
require 'partials/connexion_inscription/header.php';
?>

<body>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('img/connexion_inscription/connexion_inscription_background_img.jpg')">

            <?= $content; ?>

        </div>
    </div>

    <?php
    // Fichiers JavaScript
    require 'partials/connexion_inscription/js_files.php';
    ?>
</body>

</html>