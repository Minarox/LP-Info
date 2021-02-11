<main class="container-fluid mt-4">
    <!-- Inscription -->
    <section class="box small-w">
        <!-- Titre et redirection vers connexion -->
        <h1 class="box-title text-center">Inscription</h1>
        <p class="box-subtitle">Vous avez un compte ?
            <br>
            <a href="<?= ROOT ?>login">Se connecter</a>
        </p>
        <!-- Formulaire -->
        <form id="signUp_form" action="" method="post">
            <hr>
            <!-- Nom -->
            <label for="last_name">Nom</label>
            <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Dupont" autofocus required>
            <!-- Prénom -->
            <label for="first_name">Prénom</label>
            <input class="form-control" type="text" name="first_name" id="first_name" placeholder="Jean" required>
            <!-- Email -->
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="exemple@exemple.com" required>
            <!-- Mot de passe -->
            <label for="password">Mot de passe</label>
            <input class="form-control" type="password" name="password" id="password" placeholder="*************" required>
            <!-- Vérification du mot de passe -->
            <label for="password_verify">Vérification du mot de passe</label>
            <input class="form-control" type="password" name="password_verify" id="password_verify" placeholder="*************" required>
            <section id="error_messages"></section>
            <hr>
            <!-- Bouton de validation -->
            <button id="signUp" type="submit">Inscription</button>
        </form>
    </section>
</main>