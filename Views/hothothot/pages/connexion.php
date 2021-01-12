<!-- Contenu de la page -->
<main class="flex-container-identification decoration-top">
    <!-- Connexion -->
    <section>
        <!-- Titre et redirection vers inscription -->
        <h1>Connexion</h1>
        <p>Vous n'avez pas de compte ?<br><a href="<?= ROOT ?>inscription">Créer un compte</a></p>
        <hr id="separateur">
        <!-- Formulaire -->
        <form class="flex-container-identification-vertical" action="#" method="post">
            <!-- Email -->
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="exemple@exemple.com" required>
            <!-- Mot de passe -->
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" placeholder="*************" required>
            <a id="oublie-mdp" href="#">Mot de passe oublié ?</a>
            <!-- Se connecter -->
            <section>
                <button type="submit">Se connecter</button>
            </section>
        </form>
    </section>
</main>
