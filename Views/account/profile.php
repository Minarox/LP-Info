<main class="container-lg">
    <!-- Boite principale -->
    <section class="w-lg box">
        <!-- Titre -->
        <h1 class="box-title">Votre profil</h1>
        <hr>
        <section class="d-block d-sm-none mb-3 d-flex justify-content-center">
            <img id="profil-picture" src="<?= $_SESSION['avatar'] ?>" alt="Image de profil du compte.">
        </section>
        <article class="row">
            <section class="col-9 col-md-10 row">
                <section class="col-sm-6">
                    <div>
                        <h2>Prénom :</h2>
                        <p><?= $_SESSION['first_name'] ?></p>
                    </div>
                    <div>
                        <h2>Nom :</h2>
                        <p><?= $_SESSION['last_name'] ?></p>
                    </div>
                </section>
                <section class="col-sm-6 mt-3 mt-sm-0">
                    <div>
                        <h2>Email :</h2>
                        <p><?= $_SESSION['email'] ?></p>
                    </div>
                    <div>
                        <h2>Date de création :</h2>
                        <p><?= $_SESSION['created_at'] ?></p>
                    </div>
                </section>
            </section>
            <section class="d-none d-sm-block col-sm-3 col-md-2 align-self-center">
                <img id="profil-picture" src="<?= $_SESSION['avatar'] ?>" alt="Image de profil du compte.">
            </section>
        </article>
        <hr>
        <a class="button" href="<?= ROOT ?>account/edit">
            <button id="" type="button">
                Modifier
            </button>
        </a>
        <a class="button" href="#" onclick="show()">
            <button id="" type="button">
                Supprimer le compte
            </button>
        </a>
    </section>
    <article id="overlay">
        <section class="box w-sm">
            <!-- Titre -->
            <h1 class="box-title text-center">Voulez-vous vraiment supprimer votre compte ?</h1>
            <h2 class="text-center box-subtitle">Écrivez "delete <?= $_SESSION['email'] ?>" pour confirmez</h2>
            <!-- Formulaire -->
            <form action="" method="post">
                <hr>
                <label for="delete_confirm" hidden>Suppression du compte</label>
                <input class="form-control text-dark" type="text" name="delete_confirm" id="delete_confirm" required>
                <hr>
                <!-- Boutons de choix -->
                <button type="submit" name="delete">Confirmer la suppression</button>
                <a class="button" href="#" onclick="hide()">
                    <button type="button">
                        Retour
                    </button>
                </a>
            </form>
        </section>
    </article>
</main>