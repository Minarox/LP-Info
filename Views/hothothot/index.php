<!-- Contenu de la page -->
<main>
    <!-- Titre général pour l'accessibilité -->
    <h1 id="accessibilite">État, valeurs et historiques des capteurs.</h1>
    <!-- Boite des capteurs -->
    <section class="flex-container-general">
        <!-- Capteur intérieur -->
        <article class="flex-container-general-boite decoration-top" id="Interieur">
            <!-- Alerte du capteur -->
            <section id="alerteInterieur">
                <!-- Titre et texte d'alerte / description -->
                <h2>Alerte du capteur intérieur :</h2>
                <p></p>
                <!-- Boutons de navigation de l'alerte -->
                <button onclick="detailsAlerte('Interieur', false)" id="btnDetailsInterieur">Détails</button>
                <button onclick="detailsAlerte('Interieur', true)" id="btnRetourInterieur">Retour</button>
                <button onclick="fermerAlerte('Interieur')">Fermer</button>
            </section>
            <!-- État, titre et diagramme -->
            <section>
                <!-- État et titre -->
                <h2 id="titreInt">
                    <!-- Description de l'état du capteur -->
                    <i id="etatInt">Actif</i>
                    <canvas id="dotInt"></canvas>
                    &nbsp;Capteur intérieur
                </h2>
                <!-- Diagramme du capteur -->
                <article class="diagrammes">
                    <canvas id="DiagrammeInterieur"></canvas>
                </article>
            </section>
            <!-- Informations supplémentaires -->
            <section>
                <!-- Température actuelle -->
                <article class="flex-container-general-temperature separation separation-top">
                    <!-- Titre et description -->
                    <section>
                        <h3>Maintenant</h3>
                        <p>Température actuelle</p>
                    </section>
                    <!-- Valeur -->
                    <p class="temp-centrer" id="nowInt">00&deg;C</p>
                </article>
                <!-- Température maximale -->
                <article class="flex-container-general-temperature marge separation">
                    <!-- Titre et description -->
                    <section>
                        <h3>Maximale</h3>
                        <p>Température maximale enregistrée</p>
                    </section>
                    <!-- Valeur -->
                    <p class="temp-centrer" id="maxInt">00&deg;C</p>
                </article>
                <!-- Température minimale -->
                <article class="flex-container-general-temperature separation">
                    <!-- Titre et description -->
                    <section>
                        <h3>Minimale</h3>
                        <p>Température minimale enregistrée</p>
                    </section>
                    <!-- Valeur -->
                    <p class="temp-centrer" id="minInt">00&deg;C</p>
                </article>
            </section>
        </article>
        <!-- Capteur extérieur -->
        <article class="flex-container-general-boite decoration-top" id="Exterieur">
            <!-- Alerte du capteur -->
            <section id="alerteExterieur">
                <!-- Titre et texte d'alerte / description -->
                <h2>Alerte du capteur extérieur :</h2>
                <p></p>
                <!-- Boutons de navigation de l'alerte -->
                <button onclick="detailsAlerte('Exterieur', false)" id="btnDetailsExterieur">Détails</button>
                <button onclick="detailsAlerte('Exterieur', true)" id="btnRetourExterieur">Retour</button>
                <button onclick="fermerAlerte('Exterieur')">Fermer</button>
            </section>
            <!-- État, titre et diagramme -->
            <section>
                <!-- État et titre -->
                <h2 id="titreExt">
                    <!-- Description de l'état du capteur -->
                    <i id="etatExt">Actif</i>
                    <canvas id="dotExt"></canvas>
                    &nbsp;Capteur extérieur
                </h2>
                <!-- Diagramme du capteur -->
                <article class="diagrammes">
                    <canvas id="DiagrammeExterieur"></canvas>
                </article>
            </section>
            <!-- Informations supplémentaires -->
            <section>
                <!-- Température actuelle -->
                <article class="flex-container-general-temperature separation separation-top">
                    <!-- Titre et description -->
                    <section>
                        <h3>Maintenant</h3>
                        <p>Température actuelle</p>
                    </section>
                    <!-- Valeur -->
                    <p class="temp-centrer" id="nowExt">00&deg;C</p>
                </article>
                <!-- Température maximale -->
                <article class="flex-container-general-temperature marge separation">
                    <!-- Titre et description -->
                    <section>
                        <h3>Maximale</h3>
                        <p>Température maximale enregistrée</p>
                    </section>
                    <!-- Valeur -->
                    <p class="temp-centrer" id="maxExt">00&deg;C</p>
                </article>
                <!-- Température minimale -->
                <article class="flex-container-general-temperature separation">
                    <!-- Titre et description -->
                    <section>
                        <h3>Minimale</h3>
                        <p>Température minimale enregistrée</p>
                    </section>
                    <!-- Valeur -->
                    <p class="temp-centrer" id="minExt">00&deg;C</p>
                </article>
            </section>
        </article>
    </section>
    <!-- Comparaison des 2 capteurs -->
    <article class="decoration-top" id="boiteComparaison">
        <!-- Titre -->
        <h2>Comparaison</h2>
        <!-- Diagramme de comparaison -->
        <article class="diagrammeComparaison">
            <canvas id="DiagrammeComparaison"></canvas>
        </article>
    </article>
</main>