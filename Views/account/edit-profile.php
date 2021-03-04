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
                    <input class="form-control" type="email" name="email" id="email" placeholder="exemple@exemple.com" maxlength="50" required>
                </div>
                <section class="col-6">
                    <div>
                        <!-- Prénom -->
                        <label for="prenom">Prénom</label>
                        <input class="form-control" type="text" name="prenom" id="prenom" placeholder="Jean" maxlength="26" required>
                    </div>
                    <div>
                        <!-- Nom -->
                        <label for="nom">Nom</label>
                        <input class="form-control" type="text" name="nom" id="nom" placeholder="Dupont" maxlength="12" required>
                    </div>

                </section>
                <section class="col-6">
                    <div>
                        <!-- Nouveau mot de passe -->
                        <label for="password">Nouveau mot de passe</label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="***********" maxlength="99" required>
                    </div>
                    <div>
                        <!-- Vérification du nouveau mot de passe -->
                        <label for="password-verify">Vérification du nouveau mot de passe</label>
                        <input class="form-control" type="password" name="password-verify" id="password-verify" placeholder="***********" maxlength="99" required>
                    </div>
                </section>
            </article>

            <hr>
            <button type="submit">Modifier</button>
            <a class="button" href="<?= ROOT ?>account">
                <button id="" type="button">Retour</button>
            </a>
        </form>
    </section>
</main>