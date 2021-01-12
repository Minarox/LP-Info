<!-- Contenu de la page -->
<main class="flex-container-identification decoration-top">
    <!-- Inscription -->
    <section>
        <!-- Titre et redirection vers connexion -->
        <h1>Inscription</h1>
        <p>Vous avez un compte ?<br><a href="/connexion">Se connecter</a></p>
        <hr id="separateur">
        <!-- Formulaire -->
        <form class="flex-container-identification-vertical" action="#" method="post">
            <!-- Nom -->
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" placeholder="Dupont" required>
            <!-- Prénom -->
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" placeholder="Jean" required>
            <!-- Email -->
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="exemple@exemple.com" required>
            <!-- Mot de passe -->
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" placeholder="*************" required>
            <!-- Vérification du mot de passe -->
            <label for="password-verif">Vérification du mot de passe</label>
            <input type="password" name="password-verif" id="password-verif" placeholder="*************" required>
            <!-- Bouton de validation -->
            <section>
                <button type="submit">Inscription</button>
            </section>
        </form>
    </section>
</main>