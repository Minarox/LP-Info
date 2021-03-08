<main class="container w-xxl">
    <!-- Titre général pour l'accessibilité -->
    <h1 id="accessibility">État, valeurs et historiques des capteurs.</h1>
    <?php
        use App\Controllers\SensorsController;
        SensorsController::get();
        for ($i = 0; $i < NUMBER_SENSORS; $i++) {
            // TODO: Générer l'HTML en fonction du nombre de capteur
            null;
        }
    ?>
    <!-- Boite des capteurs -->
    <section class="row">
        <!-- Capteur -->
        <article class="col col-md col-lg m-3 mt-0 box row sensor" id="sensor0">
            <!-- Alerte du capteur -->
            <section class="sensor-alert" id="sensor0-alert">
                <!-- Titre et texte d'alerte / description -->
                <h2>Alerte du capteur intérieur :</h2>
                <p></p>
                <!-- Boutons de navigation de l'alerte -->
                <button onclick="alertDetails('indoor', false)" class="sensor-details-btn" id="sensor0-details-btn">Détails</button>
                <button onclick="alertDetails('indoor', true)" class="sensor-back-btn" id="sensor0-back-btn">Retour</button>
                <button onclick="closeAlert('indoor')">Fermer</button>
            </section>
            <!-- État, titre et diagramme -->
            <section class="col col-xxl-7 p-0">
                <!-- État et titre -->
                <h2 class="sensor-title">
                    <!-- Description de l'état du capteur -->
                    <i class="sensor-state" id="sensor0-state">Actif</i>
                    <canvas class="sensor-dot" id="sensor0-dot"></canvas>
                    &nbsp;<span id="sensor0-title">Capteur</span>
                </h2>
                <!-- Diagramme du capteur -->
                <article class="pt-2 charts w-100">
                    <canvas id="sensor0-charts"></canvas>
                </article>
            </section>
            <!-- Informations supplémentaires -->
            <section class="col-xxl ml-n4 separator row">
                <!-- Température actuelle -->
                <article class="col-xs row mb-3 mb-xxl-0">
                    <!-- Titre et description -->
                    <section class="col align-self-center">
                        <h3>Maintenant</h3>
                        <p>Température actuelle</p>
                    </section>
                    <!-- Valeur -->
                    <p class="col-1 align-self-center sensor-info" id="sensor0-now"></p>
                </article>
                <!-- Température maximale -->
                <article class="col-xs row mb-3 mb-xxl-0">
                    <!-- Titre et description -->
                    <section class="col align-self-center">
                        <h3>Maximale</h3>
                        <p>Température maximale enregistrée</p>
                    </section>
                    <!-- Valeur -->
                    <p class="col-1 align-self-center sensor-info" id="sensor0-max"></p>
                </article>
                <!-- Température minimale -->
                <article class="col-xs row">
                    <!-- Titre et description -->
                    <section class="col align-self-center">
                        <h3>Minimale</h3>
                        <p>Température minimale enregistrée</p>
                    </section>
                    <!-- Valeur -->
                    <p class="col-1 align-self-center sensor-info" id="sensor0-min"></p>
                </article>
            </section>
        </article>
        <!-- Capteur extérieur -->
        <article class="col col-md col-lg m-3 mt-0 box row sensor" id="sensor1">
            <!-- Alerte du capteur -->
            <section class="sensor-alert" id="sensor1-alert">
                <!-- Titre et texte d'alerte / description -->
                <h2>Alerte du capteur extérieur :</h2>
                <p></p>
                <!-- Boutons de navigation de l'alerte -->
                <button onclick="alertDetails('outdoor', false)" class="sensor-details-btn" id="sensor1-details-btn">Détails</button>
                <button onclick="alertDetails('outdoor', true)" class="sensor-back-btn" id="sensor1-back-btn">Retour</button>
                <button onclick="closeAlert('outdoor')">Fermer</button>
            </section>
            <!-- État, titre et diagramme -->
            <section class="col col-xxl-7 p-0">
                <!-- État et titre -->
                <h2 class="sensor-title">
                    <!-- Description de l'état du capteur -->
                    <i class="sensor-state" id="sensor1-state">Actif</i>
                    <canvas class="sensor-dot" id="sensor1-dot"></canvas>
                    &nbsp;<span id="sensor1-title">Capteur</span>
                </h2>
                <!-- Diagramme du capteur -->
                <article class="pt-2 charts w-100">
                    <canvas id="sensor1-charts"></canvas>
                </article>
            </section>
            <!-- Informations supplémentaires -->
            <section class="col-xxl ml-n4 separator row">
                <!-- Température actuelle -->
                <article class="col-xs row mb-3 mb-xxl-0">
                    <!-- Titre et description -->
                    <section class="col align-self-center">
                        <h3>Maintenant</h3>
                        <p>Température actuelle</p>
                    </section>
                    <!-- Valeur -->
                    <p class="col-1 align-self-center sensor-info" id="sensor1-now"></p>
                </article>
                <!-- Température maximale -->
                <article class="col-xs row mb-3 mb-xxl-0">
                    <!-- Titre et description -->
                    <section class="col align-self-center">
                        <h3>Maximale</h3>
                        <p>Température maximale enregistrée</p>
                    </section>
                    <!-- Valeur -->
                    <p class="col-1 align-self-center sensor-info" id="sensor1-max"></p>
                </article>
                <!-- Température minimale -->
                <article class="col-xs row">
                    <!-- Titre et description -->
                    <section class="col align-self-center">
                        <h3>Minimale</h3>
                        <p>Température minimale enregistrée</p>
                    </section>
                    <!-- Valeur -->
                    <p class="col-1 align-self-center sensor-info" id="sensor1-min"></p>
                </article>
            </section>
        </article>
    </section>
    <!-- Comparaison des 2 capteurs -->
    <article class="m-1 box">
        <!-- Titre -->
        <h2 class="comparison-title">Graphique comparatif</h2>
        <!-- Diagramme de comparaison -->
        <article class="comparison-chart w-100">
            <canvas class="pt-2" id="comparison"></canvas>
        </article>
    </article>
</main>
<script>
    const data_sensors = '<?= DATA_SENSORS ?>'
</script>