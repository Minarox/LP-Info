<!doctype html>
<html lang="fr">
<head>
    <!-- Meta pour l'encodage et l'affichage mobile -->
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Titre de la page -->
    <title>Accueil | Hothothot</title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= SCRIPTS . 'images' . DIRECTORY_SEPARATOR . 'flavicon.ico' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'style.css' ?>">
</head>
<body>
<!-- Haut de page -->
<header>
    <!-- Menu -->
    <nav>
        <ul>
            <!-- Logo -->
            <li><a href="/"><img src="<?= SCRIPTS . 'images' . DIRECTORY_SEPARATOR . 'logo.png' ?>" alt="Logo Hothothot."></a></li>
            <li><hr></li>
            <!-- Navigation -->
            <li><a href="/">Accueil</a></li>
            <li><a href="/parametrage">Paramétrage</a></li>
            <!-- Compte utilisateur -->
            <li class="right"><a href="/profil"><img src="<?= SCRIPTS . 'images' . DIRECTORY_SEPARATOR . 'profil-picture.png' ?>" alt="Image de profil du compte."></a></li>
            <li class="right" id="nom-menu"><a href="/profil">Prénom NOM</a></li>
        </ul>
    </nav>
</header>

<?= $content = $content ?? null ?>

<!-- Bas de page -->
<footer>
    <p>&copy; HotHotHot 2020</p>
</footer>
<!-- Scripts pour les diagrammes et alertes -->
<script src="<?= SCRIPTS . 'js' . DIRECTORY_SEPARATOR . 'jquery-3.5.1.min.js' ?>"></script>
<script src="<?= SCRIPTS . 'js' . DIRECTORY_SEPARATOR . 'Chart.bundle.min.js' ?>"></script>
<script src="<?= SCRIPTS . 'js' . DIRECTORY_SEPARATOR . 'Diagrammes.js' ?>"></script>
<script src="<?= SCRIPTS . 'js' . DIRECTORY_SEPARATOR . 'Alertes.js' ?>"></script>
</body>
</html>