<!-- Contenu de la page -->
<main class="flex-container-boite decoration-top">
    <!-- Boite principale -->
    <section class="boite">
        <!-- Titre -->
        <h1>Votre profil</h1>
        <hr>
        <!-- Formulaire -->
        <form action="#" method="post">
            <!-- Zones de saisie -->
            <section class="flex-container-boite-horizontal">
                <section class="flex-container-boite-vertical" id="flex-container-boite-vertical-left">
                    <!-- Nom -->
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" placeholder="Dupont" required>
                    <!-- Email -->
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="exemple@exemple.com" required>
                </section>
                <section class="flex-container-boite-vertical">
                    <!-- Prénom -->
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" id="prenom" placeholder="Jean" required>
                    <!-- Nouveau mot de passe -->
                    <label for="password">Nouveau mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="***********" required>
                </section>
            </section>
            <!-- Boutons de navigation -->
            <section class="flex-container-boite-horizontal">
                <button type="submit">Modifier</button>
                <a href="<?= ROOT ?>">Retour</a>
            </section>
        </form>
    </section>
</main>
