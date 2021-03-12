<main class="container-fluid">
    <!-- Connexion -->
    <section class="box w-sm">
        <!-- Titre et redirection vers inscription -->
        <h1 class="box-title text-center">Connexion</h1>
        <p class="box-subtitle">Vous n'avez pas de compte ?
            <br>
            <a href="<?= ROOT ?>register">Créer un compte</a>
        </p>
        <!-- Formulaire -->
        <form id="login_form" action="" method="post">
            <hr>
            <!-- Google et Facebook -->
            <article class="row">
                <section class="d-none d-sm-block col g-signin2" data-height="40" data-width="153" data-onsuccess="onSignIn" data-theme="dark"></section>
                <section class="d-block d-sm-none col d-flex justify-content-center mb-2 g-signin2" data-height="40" data-width="283" data-onsuccess="onSignIn" data-theme="dark"></section>
                <section class="col d-flex justify-content-center fb-login-button" data-size="large" data-button-type="login_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false"></section>
            </article>
            <hr>
            <!-- Email -->
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="exemple@exemple.com" maxlength="50" autofocus required>
            <!-- Mot de passe -->
            <label for="password">Mot de passe</label>
            <input class="form-control" type="password" name="password" id="password" placeholder="••••••••••••••" maxlength="99" required>
            <a id="oublie-mdp" href="#" onclick="show()">Mot de passe oublié ?</a>
            <hr>
            <!-- Se connecter -->
            <button type="submit" id="login" name="login">Se connecter</button>
        </form>
        <article id="overlay">
            <section class="box w-md">
                <!-- Titre -->
                <h1 class="box-title text-center">Récupération du compte</h1>
                <!-- Formulaire -->
                <form action="" method="post">
                    <hr>
                    <!-- Email -->
                    <label for="recovery-email">Email</label>
                    <input class="form-control" type="email" name="recovery-email" id="recovery-email" placeholder="exemple@exemple.com" maxlength="50" required>
                    <hr>
                    <!-- Valider -->
                    <button type="submit">Valider</button>
                    <button type="button" onclick="hide()">Fermer</button>
                </form>
            </section>
        </article>
    </section>
</main>
