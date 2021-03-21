<main class="container-md">
    <?php if (!$documentations): ?>
        <section class="box">
            <!-- Titre -->
            <h1 class="box-title hr">Aucun message</h1>
            <p class="box-subtitle">Les utilisateurs n'ont pas encore posté de messages.</p>
            <hr>
            <a class="button" href="<?= ROOT ?>">
                <button class="m-0" type="button">
                    Retour à l'accueil
                </button>
            </a>
        </section>
    <?php else: ?>
        <?php foreach ($documentations as $documentation): ?>
            <section class="box mb-4">
                <!-- Titre -->
                <h1 class="box-title hr"><?= $documentation['title'] ?></h1>
                <p class="box-subtitle">Par <?= $documentation['username'] ?> le <?= date("d-m-Y à H:i:s", strtotime($documentation['date'])) ?>
                </p>
                <hr>
                <?php if ($documentation['user_id'] == $_SESSION['id'] ??= -1): ?>
                <section class="d-flex bd-highlight">
                    <p class="flex-grow-1 m-0 me-2 bd-highlight"><?= $documentation['content'] ?></p>
                    <a class="p-0 bd-highlight" href="#" onclick="show(<?= $documentation['id'] ?>)"><img src="<?= SCRIPTS . 'images/download.png' ?>" alt="Bouton de suppression du commentaire."></a>
                </section>
                <?php else: ?>
                    <p class="m-0"><?= $documentation['content'] ?></p>
                <?php endif; ?>
            </section>
            <article class="overlay center" id="overlay<?= $documentation['id'] ?>">
                <section class="box w-md">
                    <!-- Titre -->
                    <h1 class="box-title text-center">Suppression du message</h1>
                    <p class="box-subtitle text-center">Voulez vous vraiment supprimer le message "<?= $documentation['title'] ?>" ?</p>
                    <!-- Formulaire -->
                    <form action="" method="post">
                        <hr>
                        <input type="number" name="id" value="<?= $documentation['id'] ?>" required hidden>
                        <!-- Valider -->
                        <button type="submit" name="remove-edition">Supprimer</button>
                        <button type="button" onclick="hide(<?= $documentation['id'] ?>)">Retour</button>
                    </form>
                </section>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</main>