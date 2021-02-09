<!-- Contenu de la page -->
<main class="flex-container-identification decoration-top">
    <!-- Inscription -->
    <section>
        <!-- Titre et redirection vers connexion -->
        <h1>Inscription</h1>
        <p>Vous avez un compte ?<br><a href="<?= ROOT ?>connexion">Se connecter</a></p>
        <hr id="separateur">
        <!-- Formulaire -->
        <form id="signUp_form" class="flex-container-identification-vertical" action="" method="post">
            <!-- Nom -->
            <label for="last_name">Nom</label>
            <input type="text" name="last_name" id="last_name" placeholder="Dupont" required>
            <!-- Prénom -->
            <label for="first_name">Prénom</label>
            <input type="text" name="first_name" id="first_name" placeholder="Jean" required>
            <!-- Email -->
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="exemple@exemple.com" required>
            <!-- Mot de passe -->
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" placeholder="*************" required>
            <!-- Vérification du mot de passe -->
            <label for="password_verify">Vérification du mot de passe</label>
            <input type="password" name="password_verify" id="password_verify" placeholder="*************" required>
            <!-- Bouton de validation -->
            <section>
                <button id="signUp" type="submit">Inscription</button>
            </section>
        </form>
    </section>
</main>