<!DOCTYPE html>
<html lang="fr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
// Header
require 'partials/default/header.php';

// Navigation
require 'partials/default/navigation.php';
?>

<body>
    <?= $content; ?>
</body>

<?php
// Footer
require 'partials/default/footer.php';
?>

<?php
// Fichiers JavaScript
require 'partials/default/js_files.php';
?>

</html>