<main class="container w-xxl">
    <!-- Titre général pour l'accessibilité -->
    <h1 id="accessibility">État, valeurs et historiques des capteurs.</h1>
    <!-- Comparaison des 2 capteurs -->
    <article class="m-1 box">
        <!-- Titre -->
        <h2 class="comparison-title">Droits de l'utilisateur "<?= $table ?>"</h2>
        <!-- Diagramme de comparaison -->
        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                <tr>
                    <?php foreach ($columns as $column): ?>
                        <th><?= $column ?> &nbsp;|&nbsp; </th>
                    <?php endforeach ?>
                </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                    <?php foreach ($data as $values): ?>
                    <tr>
                        <?php foreach ($values as $value): ?>
                            <th><?= $value ?> &nbsp;|&nbsp; </th>
                        <?php endforeach ?>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </article>
</main>