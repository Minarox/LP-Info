<!doctype html>
<html lang="fr">
<head>
    <!-- Meta pour l'encodage et l'affichage mobile -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--    <meta name="viewport" content="width=device-width, user-scalable=no,
    initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">-->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php if ($_SERVER['REQUEST_URI'] === ROOT . 'register' || $_SERVER['REQUEST_URI'] === ROOT . 'login'): ?>
        <meta name="google-signin-client_id" content="85563966196-f61n6rna4a9dm6f2o3unk9cqa4agu1s1.apps.googleusercontent.com">
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v9.0&appId=803591893562929&autoLogAppEvents=1" nonce="FqbH8LPh"></script>
    <?php endif; ?>

    <!-- Titre de la page -->
    <title><?= $title ??= null ?> | Hothothot</title>

    <!-- CSS -->
    <link rel="icon" href="<?= SCRIPTS . 'images/favicon.ico' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css/bootstrap/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css/style.css' ?>">
</head>
<body>
<!-- Haut de page -->
<header>
    <nav class="navbar navbar-expand-sm navbar-dark">
        <section class="container-xl">
            <a class="navbar-brand" href="<?= ROOT ?>">
                <img src="<?= SCRIPTS . 'images/logo.png' ?>" alt="Logo Hothothot.">
            </a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <hr class="mt-3 d-block d-sm-none">
                        <a class="nav-link" href="<?= ROOT ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>settings">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>help">Help</a>
                    </li>
                    <li class="nav-item dropdown d-block d-sm-none">
                        <hr class="mt-3">
                        <?php if (isAuthenticated()): ?>
                            <a class="nav-link" id="dropdown" href="" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                <?= $_SESSION['first_name'] . '&nbsp;' . $_SESSION['last_name'] ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown">
                                <li>
                                    <a class="dropdown-item" href="<?= ROOT ?>account">Profil</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= ROOT ?>logout">Logout</a>
                                </li>
                            </ul>
                        <?php else: ?>
                            <a class="nav-link" id="dropdown" href="" data-bs-toggle="dropdown"
                               aria-expanded="false">Account</a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown">
                                <li>
                                    <a class="dropdown-item" href="<?= ROOT ?>login">Login</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= ROOT ?>register">Register</a>
                                </li>
                            </ul>
                        <?php endif; ?>
                    </li>
                </ul>
                <section class="nav-item dropdown d-none d-sm-block">
                    <?php if (isAuthenticated()): ?>
                        <a class="nav-link" id="dropdown" href="" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            <?= $_SESSION['first_name'] . '&nbsp;' . $_SESSION['last_name'] ?>
                            <img src="<?= $_SESSION['avatar'] ?>" alt="Profil picture.">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown">
                            <li>
                                <a class="dropdown-item" href="<?= ROOT ?>account">Profil</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= ROOT ?>logout">Logout</a>
                            </li>
                        </ul>
                    <?php else: ?>
                        <a class="nav-link" id="dropdown" href="" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Account
                            <img src="<?= SCRIPTS . 'images/profil-picture.png' ?>" alt="Profil picture.">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown">
                            <li>
                                <a class="dropdown-item" href="<?= ROOT ?>login">Login</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= ROOT ?>register">Register</a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </section>
            </div>
        </section>
    </nav>
</header>
<section class="container">
    <?php include_once __DIR__ . '/message/message.php' ?>
</section>

<!-- Contenu principal -->
<?= $content ??= null ?>

<!-- Bas de page -->
<footer>
    <section class="container">
        <p>
            &copy; <?= date("Y"); ?>
            <a href="<?= ROOT ?>">Hothothot.fr</a>
        <p>
    </section>
</footer>

<!-- Scripts pour les diagrammes et alertes -->
<script> const root = '<?= ROOT ?>' </script>
<?= addJavaScript('js/account/utilities.js') ?>
<?= addJavaScript('js/bootstrap/bootstrap.min.js') ?>
<?= addJavaScript('js/jquery/jquery-3.5.1.min.js','') ?>
<?= addJavaScript('js/chart/Chart.bundle.min.js','') ?>
<?= addJavaScript('js/home/Diagrammes.js','') ?>
<?= addJavaScript('js/home/Alertes.js','') ?>
<?= addJavaScript('js/account/register','register') ?>
<?= addJavaScript('js/account/login','login') ?>
<!-- Google -->
<?= addJavaScript('https://apis.google.com/js/platform.js', 'register') ?>
<?= addJavaScript('https://apis.google.com/js/platform.js', 'login') ?>
<!-- Facebook -->
<script>
    (function(d, s, id) {
        let js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=803591893562929";
        fjs.parentNode.insertBefore(js, fjs);
    } (document, 'script', 'facebook-jssdk'));
</script>

</body>
</html>
