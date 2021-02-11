<main class="container-fluid mt-4">
    <!-- Boite principale -->
    <section class="box medium-w">
        <!--        <section>-->
        <!--            <img class="margin-top" id="profil-picture" src="--><?//= SCRIPTS . 'images/profil-picture.png' ?><!--" alt="Image de profil du compte.">-->
        <!--            <form enctype="multipart/form-data" action="" method="post">-->
        <!--                <button id="edit" type="submit">Modifier</button>-->
        <!--            </form>-->
        <!--        </section>-->
        <!-- Titre -->
        <h1 class="box-title text-center">Votre profil</h1>
        <!-- Formulaire -->
        <form action="" method="post">
            <!-- Zones de saisie -->
            <hr>
            <!-- Prénom -->
            <label for="prenom">Prénom</label>
            <input class="form-control" type="text" name="prenom" id="prenom" placeholder="Jean" maxlength="26" required>
            <!-- Nom -->
            <label for="nom">Nom</label>
            <input class="form-control" type="text" name="nom" id="nom" placeholder="Dupont" maxlength="12" required>
            <!-- Email -->
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="exemple@exemple.com" maxlength="50" required>
            <!-- Nouveau mot de passe -->
            <label for="password">Nouveau mot de passe</label>
            <input class="form-control" type="password" name="password" id="password" placeholder="***********" maxlength="99" required>
            <!-- Vérification du nouveau mot de passe -->
            <label for="password-verify">Vérification du nouveau mot de passe</label>
            <input class="form-control" type="password" name="password-verify" id="password-verify" placeholder="***********" maxlength="99" required>
            <hr>
            <!-- Boutons de navigation -->
            <button type="submit">Modifier</button>
            <a class="button" href="<?= ROOT ?>">
                <button id="" type="button">
                    Retour
                </button>
            </a>
            <a class="button" href="#" onclick="show()">
                <button id="" type="button">
                    Supprimer le compte
                </button>
            </a>
        </form>

    </section>
    <article id="overlay">
        <section class="box small-w">
            <!-- Titre -->
            <h1 class="box-title text-center">Voulez-vous vraiment supprimer votre compte ?</h1>
            <!-- Formulaire -->
            <form action="" method="post">
                <hr>
                <!-- Boutons de choix -->
                <button type="submit">Oui</button>
                <a class="button" href="#" onclick="hide()">
                    <button type="button">
                        Retour
                    </button>
                </a>
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
