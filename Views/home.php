<?php
    use App\Controllers\SensorsController;
    SensorsController::get();
?>
<main class="container w-xxl">
    <!-- Titre général pour l'accessibilité -->
    <h1 id="accessibility">État, valeurs et historiques des capteurs.</h1>
    <!-- Boite des capteurs -->
    <section class="row">
        <!-- Capteur intérieur -->
        <article class="col col-md col-lg m-3 mt-0 box row" id="indoor">
            <!-- Alerte du capteur -->
            <section id="indoor-alert">
                <!-- Titre et texte d'alerte / description -->
                <h2>Alerte du capteur intérieur :</h2>
                <p></p>
                <!-- Boutons de navigation de l'alerte -->
                <button onclick="alertDetails('indoor', false)" id="indoor-details-btn">Détails</button>
                <button onclick="alertDetails('indoor', true)" id="indoor-back-btn">Retour</button>
                <button onclick="closeAlert('indoor')">Fermer</button>
            </section>
            <!-- État, titre et diagramme -->
            <section class="col">
                <!-- État et titre -->
                <h2 id="indoor-title">
                    <!-- Description de l'état du capteur -->
                    <i id="indoor-state">Actif</i>
                    <canvas id="indoor-dot"></canvas>
                    &nbsp;Capteur intérieur
                </h2>
                <!-- Diagramme du capteur -->
                <article class="pt-2 charts w-100">
                    <canvas id="indoor-charts"></canvas>
                </article>
            </section>
            <!-- Informations supplémentaires -->
            <section class="col-xxl separator row">
                <!-- Température actuelle -->
                <article class="col-xs row mb-3 mb-xxl-0">
                    <!-- Titre et description -->
                    <section class="col align-self-center">
                        <h3>Maintenant</h3>
                        <p>Température actuelle</p>
                    </section>
                    <!-- Valeur -->
                    <p class="col-1 align-self-center" id="indoor-now">00&deg;C</p>
                </article>
                <!-- Température maximale -->
                <article class="col-xs row mb-3 mb-xxl-0">
                    <!-- Titre et description -->
                    <section class="col align-self-center">
                        <h3>Maximale</h3>
                        <p>Température maximale enregistrée</p>
                    </section>
                    <!-- Valeur -->
                    <p class="col-1 align-self-center" id="indoor-max">00&deg;C</p>
                </article>
                <!-- Température minimale -->
                <article class="col-xs row">
                    <!-- Titre et description -->
                    <section class="col align-self-center">
                        <h3>Minimale</h3>
                        <p>Température minimale enregistrée</p>
                    </section>
                    <!-- Valeur -->
                    <p class="col-1 align-self-center" id="indoor-min">00&deg;C</p>
                </article>
            </section>
        </article>
        <!-- Capteur extérieur -->
        <article class="col col-md col-lg m-3 mt-0 box row" id="outdoor">
            <!-- Alerte du capteur -->
            <section id="outdoor-alert">
                <!-- Titre et texte d'alerte / description -->
                <h2>Alerte du capteur extérieur :</h2>
                <p></p>
                <!-- Boutons de navigation de l'alerte -->
                <button onclick="alertDetails('outdoor', false)" id="outdoor-details-btn">Détails</button>
                <button onclick="alertDetails('outdoor', true)" id="outdoor-back-btn">Retour</button>
                <button onclick="closeAlert('outdoor')">Fermer</button>
            </section>
            <!-- État, titre et diagramme -->
            <section class="col">
                <!-- État et titre -->
                <h2 id="outdoor-title">
                    <!-- Description de l'état du capteur -->
                    <i id="outdoor-state">Actif</i>
                    <canvas id="outdoor-dot"></canvas>
                    &nbsp;Capteur extérieur
                </h2>
                <!-- Diagramme du capteur -->
                <article class="pt-2 charts w-100">
                    <canvas id="outdoor-charts"></canvas>
                </article>
            </section>
            <!-- Informations supplémentaires -->
            <section class="col-xxl separator row">
                <!-- Température actuelle -->
                <article class="col-xs row mb-3 mb-xxl-0">
                    <!-- Titre et description -->
                    <section class="col align-self-center">
                        <h3>Maintenant</h3>
                        <p>Température actuelle</p>
                    </section>
                    <!-- Valeur -->
                    <p class="col-1 align-self-center" id="outdoor-now">00&deg;C</p>
                </article>
                <!-- Température maximale -->
                <article class="col-xs row mb-3 mb-xxl-0">
                    <!-- Titre et description -->
                    <section class="col align-self-center">
                        <h3>Maximale</h3>
                        <p>Température maximale enregistrée</p>
                    </section>
                    <!-- Valeur -->
                    <p class="col-1 align-self-center" id="outdoor-max">00&deg;C</p>
                </article>
                <!-- Température minimale -->
                <article class="col-xs row">
                    <!-- Titre et description -->
                    <section class="col align-self-center">
                        <h3>Minimale</h3>
                        <p>Température minimale enregistrée</p>
                    </section>
                    <!-- Valeur -->
                    <p class="col-1 align-self-center" id="outdoor-min">00&deg;C</p>
                </article>
            </section>
        </article>
    </section>
    <!-- Comparaison des 2 capteurs -->
    <article class="m-1 box">
        <!-- Titre -->
        <h2>Comparaison</h2>
        <!-- Diagramme de comparaison -->
        <article class="comparison-chart w-100">
            <canvas class="pt-2" id="comparison"></canvas>
        </article>
    </article>
    <hr>
    <h4>Capteur 1</h4>
    <p><?= DATA_SENSOR_1?></p>
    <hr>
    <h4>Capteur 2</h4>
    <p><?= DATA_SENSOR_2 ?></p>
</main>