<!doctype html>
<html lang="fr">
    <head>
        <!-- Meta pour l'encodage et l'affichage mobile -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">-->
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Titre de la page -->
        <title><?= $title ?> | Hothothot</title>

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
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false">
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
                                <?php if (isset($_SESSION['token']) && !empty($_SESSION['token'])): ?>
                                    <a class="nav-link" id="dropdown" href="" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?= $_SESSION['first_name'] . '&nbsp;' . $_SESSION['last_name'] ?>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdown">
                                        <li><a class="dropdown-item" href="<?= ROOT ?>account">Profil</a></li>
                                        <li><a class="dropdown-item" href="<?= ROOT ?>logout">Logout</a></li>
                                    </ul>
                                <?php else: ?>
                                    <a class="nav-link" id="dropdown" href="" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdown">
                                        <li><a class="dropdown-item" href="<?= ROOT ?>login">Login</a></li>
                                        <li><a class="dropdown-item" href="<?= ROOT ?>register">Register</a></li>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        </ul>
                        <section class="nav-item dropdown d-none d-sm-block">
                            <?php if (isset($_SESSION['token']) && !empty($_SESSION['token'])): ?>
                                <a class="nav-link" id="dropdown" href="" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $_SESSION['first_name'] . '&nbsp;' . $_SESSION['last_name'] ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdown">
                                    <li><a class="dropdown-item" href="<?= ROOT ?>account">Profil</a></li>
                                    <li><a class="dropdown-item" href="<?= ROOT ?>logout">Logout</a></li>
                                </ul>
                            <?php else: ?>
                                <a class="nav-link" id="dropdown" href="" data-bs-toggle="dropdown" aria-expanded="false">
                                    Account
                                    <img src="<?= SCRIPTS . 'images/profil-picture.png' ?>" alt="Profil picture.">
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdown">
                                    <li><a class="dropdown-item" href="<?= ROOT ?>login">Login</a></li>
                                    <li><a class="dropdown-item" href="<?= ROOT ?>register">Register</a></li>
                                </ul>
                            <?php endif; ?>
                        </section>
                    </div>
                </section>
            </nav>
        </header>

        <!-- Contenu principal -->
        <?= $content = $content ?? null ?>

        <!-- Bas de page -->
        <footer class="footer mt-auto py-3">
            <section class="container">
                <p class="m-0">&copy; <script>document.write(new Date().getFullYear())</script> HotHotHot.fr</p>
            </section>
        </footer>

        <!-- Scripts pour les diagrammes et alertes -->
        <script src="<?= SCRIPTS . 'js/account/utilities.js' ?>"></script>
        <script src="<?= SCRIPTS . 'js/bootstrap/bootstrap.min.js' ?>"></script>
        <?php if ($_SERVER['REQUEST_URI'] === '/'): ?>
            <script src="<?= SCRIPTS . 'js/jquery/jquery-3.5.1.min.js' ?>"></script>
            <script src="<?= SCRIPTS . 'js/chart/Chart.bundle.min.js' ?>"></script>
            <script src="<?= SCRIPTS . 'js/home/Diagrammes.js' ?>"></script>
            <script src="<?= SCRIPTS . 'js/home/Alertes.js' ?>"></script>
        <?php endif; ?>
        <?php if ($_SERVER['REQUEST_URI'] === '/login'): ?>
            <script src="<?= SCRIPTS . 'js/account/login.js' ?>"></script>
        <?php endif; ?>
        <?php if ($_SERVER['REQUEST_URI'] === '/register'): ?>
            <script src="<?= SCRIPTS . 'js/account/signUp.js' ?>"></script>
        <?php endif; ?>
    </body>
</html>
