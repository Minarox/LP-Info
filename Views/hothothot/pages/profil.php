<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Meta pour l'encodage et l'affichage mobile -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Titre de la page -->
        <title>Profil | Hothothot</title>
        <!-- CSS -->
        <link rel="icon" href="../images/favicon.ico">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <!-- Haut de page -->
        <header>
            <!-- Menu -->
            <nav>
                <ul>
                    <!-- Logo -->
                    <li><a href="../index.php"><img src="../images/logo.png" alt="Logo Hothothot."></a></li>
                    <li><hr></li>
                    <!-- Navigation -->
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="../pages/parametrage.php">Paramétrage</a></li>
                    <!-- Compte utilisateur -->
                    <li class="right"><a href="../pages/profil.php"><img src="../images/profil-picture.png" alt="Image de profil du compte."></a></li>
                    <li class="right" id="nom-menu"><a href="../pages/profil.php">Prénom NOM</a></li>
                </ul>
            </nav>
        </header>
        <!-- Contenu de la page -->
        <main class="flex-container-boite decoration-top">
            <!-- Boite principale -->
            <section class="boite">
                <!-- Titre -->
                <h1>Votre profil</h1>
                <hr>
                <!-- Formulaire -->
                <form action="#" method="post">
                    <!-- Zones de saisie -->
                    <section class="flex-container-boite-horizontal">
                        <section class="flex-container-boite-vertical" id="flex-container-boite-vertical-left">
                            <!-- Nom -->
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" id="nom" placeholder="Dupont" required>
                            <!-- Email -->
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="exemple@exemple.com" required>
                        </section>
                        <section class="flex-container-boite-vertical">
                            <!-- Prénom -->
                            <label for="prenom">Prénom</label>
                            <input type="text" name="prenom" id="prenom" placeholder="Jean" required>
                            <!-- Nouveau mot de passe -->
                            <label for="password">Nouveau mot de passe</label>
                            <input type="password" name="password" id="password" placeholder="***********" required>
                        </section>
                    </section>
                    <!-- Boutons de navigation -->
                    <section class="flex-container-boite-horizontal">
                        <button type="submit">Modifier</button>
                        <a href="../index.php">Retour</a>
                    </section>
                </form>
            </section>
        </main>
        <!-- Bas de page -->
        <footer>
            <p>&copy; HotHotHot 2020</p>
        </footer>
    </body>
</html>
