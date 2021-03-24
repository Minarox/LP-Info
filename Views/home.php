<main class="container w-xxl">
    <!-- Titre général pour l'accessibilité -->
    <h1 id="accessibility">État, valeurs et historiques des capteurs.</h1>
    <!-- Comparaison des 2 capteurs -->
    <article class="m-1 box">
        <!-- Titre -->
        <h2 class="comparison-title">Droits de l'utilisateur "<?= "{$_SESSION['username']}" ?>"</h2>
        <!-- Diagramme de comparaison -->
        <article class="comparison-chart w-100">
            <ul>
                <?php foreach ($permissions as $grant): ?>
                <li><?= $grant ?></li>
                <?php endforeach ?>
            </ul>
        </article>
    </article>
</main>