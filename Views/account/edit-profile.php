<main class="container-lg">
    <!-- Boite principale -->
    <section class="row w-lg box">
        <form class="col-2 align-self-center" action="" method="post">
            <img id="profil-picture" src="<?= $_SESSION['avatar'] ?>" alt="Image de profil du compte.">
        </form>
        <form class="col-10" action="" method="post">
            <!-- Titre -->
            <h1 class="box-title">Votre profil</h1>
            <hr>
            <article class="row">
                <div>
                    <!-- Email -->
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" id="email" placeholder="exemple@exemple.com" maxlength="50" value="<?= $_SESSION['email'] ?>" required>
                </div>
                <!-- On vérifie s'il n'est pas connecté avec un compte Google ou Facebook pour prendre toute la largeur de <article> -->
                <section class="<?= is_null($_SESSION['id_google']) && is_null($_SESSION['id_facebook']) ? 'col-6' : 'col-12' ?>">
                    <div>
                        <!-- Prénom -->
                        <label for="first_name">Prénom</label>
                        <input class="form-control" type="text" name="first_name" id="first_name" placeholder="Jean" maxlength="30" value="<?= $_SESSION['first_name'] ?>" required>
                    </div>
                    <div>
                        <!-- Nom -->
                        <label for="last_name">Nom</label>
                        <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Dupont" maxlength="30" value="<?= $_SESSION['last_name'] ?>" required>
                    </div>
                </section>
                <!-- On vérifie s'il n'est pas connecté avec un compte Google ou Facebook -->
                <?php if (is_null($_SESSION['id_google']) && is_null($_SESSION['id_facebook'])): ?>
                    <section class="col-6">
                        <div>
                            <!-- Nouveau mot de passe -->
                            <label for="password">Nouveau mot de passe</label>
                            <input class="form-control" type="password" name="password" id="password" placeholder="***********" maxlength="99">
                        </div>
                        <div>
                            <!-- Vérification du nouveau mot de passe -->
                            <label for="password_verify">Vérification du nouveau mot de passe</label>
                            <input class="form-control" type="password" name="password_verify" id="password_verify" placeholder="***********" maxlength="99">
                        </div>
                    </section>
                <?php endif; ?>
            </article>
            <hr>
            <button type="submit" name="update">Modifier</button>
            <a class="button" href="<?= ROOT ?>account">
                <button id="" type="button">Retour</button>
            </a>
        </form>
    </section>
</main>