<main class="container-md">
    <section class="box">
        <!-- Titre -->
        <h1 class="box-title">Éditeur</h1>
        <hr>
        <form class="p-0" method="post" action="">
            <?php if (!empty($editor['id'])): ?>
            <label for="id" hidden>ID :</label>
            <input class="form-control" type="number" name="id" id="id" placeholder="ID" value="<?= $editor['id'] ??= '' ?>" required hidden>
            <?php endif; ?>
            <label for="title">Titre :</label>
            <input class="form-control" type="text" name="title" id="title" placeholder="Titre" maxlength="50" value="<?= $editor['title'] ??= '' ?>" required autocomplete>
            <label for="documentation">Contenu :</label>
            <textarea name="documentation" id="editor"><?= $editor['content_raw'] ??= '' ?></textarea>
            <button class="m-top" type="submit">Valider</button>
        </form>
    </section>
</main>