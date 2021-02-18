<main class="container-lg">
    <!-- Boite principale -->
    <section class="row large-w box">
        <section class="col-2 align-self-center">
            <img id="profil-picture" src="<?= $_SESSION['avatar'] ?>" alt="Image de profil du compte.">
        </section>
        <section class="col-10">
            <!-- Titre -->
            <h1 class="box-title">Votre profil</h1>
            <hr>
            <article class="row">
                <section class="col-6">
                    <div>
                        <h2>Prénom :</h2>
                        <p><?= $_SESSION['first_name'] ?></p>
                    </div>
                    <div>
                        <h2>Nom :</h2>
                        <p><?= $_SESSION['last_name'] ?></p>
                    </div>
                </section>
                <section class="col-6">
                    <div>
                        <h2>Email :</h2>
                        <p><?= $_SESSION['email'] ?></p>
                    </div>
                    <div>
                        <h2>Date de création :</h2>
                        <p><?= $_SESSION['created_at'] ?></p>
                    </div>
                </section>
            </article>
        </section>
        <hr>
        <a class="button" href="<?= ROOT ?>">
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
</main>