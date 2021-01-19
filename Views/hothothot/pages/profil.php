<!-- Contenu de la page -->
<main class="flex-container-boite decoration-top">
    <!-- Boite principale -->
    <section class="flex-container-general stretch boite">
        <section>
            <img class="margin-top" id="profil-picture" src="<?= SCRIPTS . 'images' . DIRECTORY_SEPARATOR . 'profil-picture.png' ?>" alt="Image de profil du compte.">

        </section>
        <section class="margin-top separation max-width">
            <!-- Titre -->
            <h1 class="no-marge">Votre profil</h1>
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
                    <a href="<?= ROOT ?>">Retour</a>
                </section>
            </form>
            <a id="delete" href="#" onclick="show()">Supprimer le compte</a>
        </section>
    </section>
    <article id="overlay">
        <section class="flex-container-identification decoration-top">
            <!-- Titre -->
            <h1>Voulez-vous vraiment supprimer votre compte ?</h1>
            <hr id="separateur">
            <!-- Formulaire -->
            <form class="flex-container-identification-vertical" action="#" method="post">
                <!-- Boutons de choix -->
                <section class="flex-container-boite-horizontal">
                    <button type="submit">Oui</button>
                    <a href="#" onclick="hide()">Retour</a>
                </section>
            </form>
        </section>
    </article>
    <script>
        function show() {
            document.getElementById("overlay").style.display = "block";
        }

        function hide() {
            document.getElementById("overlay").style.display = "none";
        }
    </script>
</main>
