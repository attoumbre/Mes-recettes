<!DOCTYPE html>
<html lang="fr">

<!-- ======= Head ======= -->

<head>
    <title>Share & Drink - Erreur</title>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="img/logos_icons/icon_S_D.png" />

    <!--Fonts SCSS File -->
    <link rel="stylesheet" type="text/css" href="css/erreur/style_erreur.scss" />

</head>

<body>
    <div class="box">
        <div class="box__ghost">
            <div class="symbol"></div>
            <div class="symbol"></div>
            <div class="symbol"></div>
            <div class="symbol"></div>
            <div class="symbol"></div>
            <div class="symbol"></div>

            <div class="box__ghost-container">
                <div class="box__ghost-eyes" id="box_ghost-eyes">
                    <div class="box__eye-left"></div>
                    <div class="box__eye-right"></div>
                </div>
                <div class="box__ghost-bottom">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <div class="box__ghost-shadow"></div>
        </div>

        <div class="box__description">
            <div class="box__description-container">
                <div class="box__description-title">Oups !</div>
                <div class="box__description-text">Il semble que nous n'avons pas pu trouver la page que vous recherchiez</div>
            </div>

            <a href="?p=home.index" class="box__button">Revenir à l'Accueil</a>
        </div>
    </div>
</body>
<script>
    var pageX = window.innerWidth;
    var pageY = window.innerHeight;
    var mouseY = 0;
    var mouseX = 0;

    window.onmousemove = function(event) {
        //verticalAxis
        mouseY = event.pageY;
        yAxis = (pageY / 2 - mouseY) / pageY * 300;
        //horizontalAxis
        mouseX = event.pageX / -pageX;
        xAxis = -mouseX * 100 - 100;
        var e = document.getElementById("box_ghost-eyes");
        e.style.transform = 'translate(' + xAxis + '% , -' + yAxis + '% )';
        //console.log('X: ' + xAxis);
    };
</script>

</html>