<main>
    <!-- Titre général pour l'accessibilité -->
    <h1 id="accessibility">État, valeurs et historiques des capteurs.</h1>
    <!-- Boite des capteurs -->
    <section class="flex-container">
        <!-- Capteur intérieur -->
        <article class="flex-container-box topbar" id="indoor">
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
            <section>
                <!-- État et titre -->
                <h2 id="indoor-title">
                    <!-- Description de l'état du capteur -->
                    <i id="indoor-state">Actif</i>
                    <canvas id="indoor-dot"></canvas>
                    &nbsp;Capteur intérieur
                </h2>

                <!-- Diagramme du capteur -->
                <article class="charts">
                    <canvas id="indoor-charts"></canvas>
                </article>
            </section>
            <!-- Informations supplémentaires -->
            <section>
                <!-- Température actuelle -->
                <article class="flex-container-temp separator top-separator">
                    <!-- Titre et description -->
                    <section>
                        <h3>Maintenant</h3>
                        <p>Température actuelle</p>
                    </section>
                    <!-- Valeur -->
                    <p class="temp-center" id="indoor-now">00&deg;C</p>
                </article>
                <!-- Température maximale -->
                <article class="flex-container-temp margin separator">
                    <!-- Titre et description -->
                    <section>
                        <h3>Maximale</h3>
                        <p>Température maximale enregistrée</p>
                    </section>
                    <!-- Valeur -->
                    <p class="temp-center" id="indoor-max">00&deg;C</p>
                </article>
                <!-- Température minimale -->
                <article class="flex-container-temp separator">
                    <!-- Titre et description -->
                    <section>
                        <h3>Minimale</h3>
                        <p>Température minimale enregistrée</p>
                    </section>
                    <!-- Valeur -->
                    <p class="temp-center" id="indoor-min">00&deg;C</p>
                </article>
            </section>
        </article>
        <!-- Capteur extérieur -->
        <article class="flex-container-box topbar" id="outdoor">
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
            <section>
                <!-- État et titre -->
                <h2 id="outdoor-title">
                    <!-- Description de l'état du capteur -->
                    <i id="outdoor-state">Actif</i>
                    <canvas id="outdoor-state"></canvas>
                    &nbsp;Capteur extérieur
                </h2>
                <!-- Diagramme du capteur -->
                <article class="charts">
                    <canvas id="outdoor-charts"></canvas>
                </article>
            </section>
            <!-- Informations supplémentaires -->
            <section>
                <!-- Température actuelle -->
                <article class="flex-container-temp separator top-separator">
                    <!-- Titre et description -->
                    <section>
                        <h3>Maintenant</h3>
                        <p>Température actuelle</p>
                    </section>
                    <!-- Valeur -->
                    <p class="temp-center" id="outdoor-now">00&deg;C</p>
                </article>
                <!-- Température maximale -->
                <article class="flex-container-temp margin separator">
                    <!-- Titre et description -->
                    <section>
                        <h3>Maximale</h3>
                        <p>Température maximale enregistrée</p>
                    </section>
                    <!-- Valeur -->
                    <p class="temp-center" id="outdoor-max">00&deg;C</p>
                </article>
                <!-- Température minimale -->
                <article class="flex-container-temp separator">
                    <!-- Titre et description -->
                    <section>
                        <h3>Minimale</h3>
                        <p>Température minimale enregistrée</p>
                    </section>
                    <!-- Valeur -->
                    <p class="temp-center" id="outdoor-min">00&deg;C</p>
                </article>
            </section>
        </article>
    </section>
    <!-- Comparaison des 2 capteurs -->
    <article class="topbar" id="comparison-box">
        <!-- Titre -->
        <h2>Comparaison</h2>
        <!-- Diagramme de comparaison -->
        <article class="comparison-chart">
            <canvas id="comparison"></canvas>
        </article>
    </article>
</main>