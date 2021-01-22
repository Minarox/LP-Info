<!-- Contenu de la page -->
<main class="flex-container-identification decoration-top">
    <!-- Connexion -->
    <section>
        <!-- Titre et redirection vers inscription -->
        <h1>Connexion</h1>
        <p>Vous n'avez pas de compte ?<br><a href="<?= ROOT ?>inscription">Créer un compte</a></p>
        <hr id="separateur">
        <!-- Formulaire -->
        <form class="flex-container-identification-vertical" id="login_form" action="" method="post">
            <!-- Email -->
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="exemple@exemple.com" required>
            <!-- Mot de passe -->
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" placeholder="*************" required>
            <a id="oublie-mdp" href="#" onclick="show()">Mot de passe oublié ?</a>
            <p id="error_messsages"></p>
            <!-- Se connecter -->
            <section>
                <button type="submit" id="login" name="login">Se connecter</button>
            </section>
        </form>
        <article id="overlay">
            <section class="flex-container-identification decoration-top">
                <!-- Titre -->
                <h1>Récupération du compte</h1>
                <hr id="separateur">
                <!-- Formulaire -->
                <form class="flex-container-identification-vertical" action="#" method="post">
                    <!-- Email -->
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="exemple@exemple.com" required>
                    <!-- Valider -->
                    <section>
                        <button type="submit">Valider</button>
                        <button type="button" onclick="hide()">Fermer</button>
                    </section>
                </form>
            </section>
        </article>
    </section>
</main>