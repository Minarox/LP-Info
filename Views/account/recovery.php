<main class="container-fluid">
    <!-- Inscription -->
    <section class="box w-sm">
        <!-- Titre -->
        <h1 class="box-title text-center">Récupération du compte</h1>
        <!-- Formulaire -->
        <form action="" method="post">
            <hr>
            <!-- Champ caché userid -->
            <label class="d-none" for="user_id">Userid</label>
            <input class="form-control" type="hidden" name="user_id" value="<?= $user_id ??= null ?>" id="user_id" placeholder="*************" maxlength="99" required>
            <!-- Champ caché timestamp -->
            <label class="d-none" for="timestamp">Timestamp</label>
            <input class="form-control" type="hidden" name="timestamp" value="<?= $timestamp ??= null ?>" id="timestamp" placeholder="*************" maxlength="99" required>
            <!-- Mot de passe -->
            <label for="password">Nouveau mot de passe</label>
            <input class="form-control" type="password" name="password" id="password" placeholder="*************" maxlength="99" required autocomplete="new-password">
            <!-- Vérification du mot de passe -->
            <label for="password-verif">Vérification du mot de passe</label>
            <input class="form-control" type="password" name="password-verif" id="password-verif" placeholder="*************" maxlength="99" required autocomplete="new-password">
            <hr>
            <!-- Bouton de validation -->
            <button type="submit">Valider</button>
        </form>
    </section>
</main>
