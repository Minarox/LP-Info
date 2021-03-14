<main class="container-md">
    <!-- Titre général pour l'accessibilité -->
    <h1 id="accessibility">Personnalisation des alertes des différents capteurs.</h1>
    <!-- Boite du capteur -->
    <article class="box mb-4">
        <!-- Titre -->
        <h2 class="col box-title m-0">Paramètres généraux des capteurs</h2>
        <hr>
        <form class="p-0" action="" method="post">
            <!-- Modification de l\'alerte sélectionnée -->
            <section class="row">
                <div class="col-sm pb-0 mb-3 mb-sm-0">
                    <label for="value-sensors">Nombre de valeurs récentes</label>
                    <input class="form-control" type="number" name="value-sensors" id="value-sensors" placeholder="Par défaut : 11" maxlength="5" min="1" max="10000" value="<?= $_SESSION['nb_values_sensors'] ?>" required>
                </div>
                <div class="col-sm pb-0">
                    <label for="value-comparison">Nombre de valeurs à comparer</label>
                    <input class="form-control" type="number" name="value-comparison" id="value-comparison" placeholder="Par défaut : 128" maxlength="5" min="1" max="10000" value="<?= $_SESSION['nb_values_comparison'] ?>" required>
                </div>
            </section>
            <hr>
            <button class="m-0" name="update-parameters" type="submit">Modifier</button>
        </form>
    </article>
    <hr class="m-2 mb-4">
    <?php
    use App\Controllers\SensorsController;
    use App\Controllers\SettingsController;

    SensorsController::get($_SESSION['nb_values_comparison']);

    function box(int $id) {
        $data = json_decode(SENSORS_DATA, true);
        if ($data[$id]["name"]) {
            $name = 'Capteur '.$data[$id]["name"];
        } else {
            $name = $id;
        }
        if ($data[$id]["type"]) {
            $type = $data[$id]["type"];
        } else {
            $type = 'type inconnu';
        }
        if ($id == SENSORS_NUMBER - 1) {
            $margin_box = '';
        } else {
            $margin_box = ' mb-4';
        }

        echo '
        <!-- Boite du capteur -->
        <article class="box'.$margin_box.'">
            <section>
                <!-- Titre -->
                <section class="row">
                    <h2 class="col box-title m-0">'.$name.' ['.$type.']</h2>
                    <a class="col-1 d-flex align-items-center justify-content-end" href="" name="download-sensor'.$id.'"><img src="'. SCRIPTS . 'images/download.png' .'" alt="Bouton de téléchargement des données du capteur."></a>
                </section>
                <hr>
                <!-- Sélection de l\'alerte -->
                <section class="row">
                    <label class="col-sm-2 col-lg-1 d-flex align-items-center" for="select-alert-sensor'.$id.'">Alertes</label>
                    <select class="col form-select select-alert" aria-label="Default select example" name="select-alert-sensor'.$id.'" id="select-alert-sensor'.$id.'" required>
                        <option selected disabled>Sélectionnez une alerte</option>
        ';

        $alert_list = SettingsController::id($data[$id]['id']);
        foreach ($alert_list as $item) {
            echo "<option value='{$item['id']}'>{$item['name']}</option>";
        }

        echo '
                    </select>
                    <a class="col-2 col-md-1 button" href="#" onclick="show()">
                        <button class="mb-0" type="button">+</button>
                    </a>
                </section>
            </section>
            <form class="d-none p-0" action="" method="post">
                <hr>
                <!-- Modification de l\'alerte sélectionnée -->
                <label for="name-alert-sensor'.$id.'">Nom de l\'alerte</label>
                <input class="form-control mb-3" type="text" name="name-alert-sensor'.$id.'" id="name-alert-sensor'.$id.'" placeholder="HotHotHot !" maxlength="80" required>
                <section class="row">
                    <div class="col-sm pb-0 mb-3 mb-sm-0">
                        <label for="operator-alert-sensor'.$id.'">Opérateur</label>
                        <select class="col form-select" aria-label="Default select example" name="operator-alert-sensor'.$id.'" id="operator-alert-sensor'.$id.'" required>
                            <option selected>Sélectionnez un opérateur</option>
                            <option value="1">></option>
                            <option value="2">=></option>
                            <option value="3">=</option>
                            <option value="4"><=</option>
                            <option value="5"><</option>
                        </select>
                    </div>
                    <div class="col-sm pb-0">
                        <label for="value-alert-sensor'.$id.'">Valeur</label>
                        <input class="form-control" type="number" name="value-alert-sensor'.$id.'" id="value-alert-sensor'.$id.'" placeholder="35" maxlength="5" required>
                    </div>
                </section>
                <hr>
                <button class="m-0" name="update-alert-sensor'.$id.'" type="submit">Modifier</button>
            </form>
        </article>
        <article id="overlay">
            <section class="box w-md">
                <!-- Titre -->
                <h1 class="box-title text-center">Création d\'une nouvelle alerte</h1>
                <!-- Formulaire -->
                <form action="" method="post">
                    <hr>
                    <!-- Nom de l\'alerte -->
                    <label for="name-newalert-sensor'.$id.'">Nom de l\'alerte</label>
                    <input class="form-control" type="text" name="name-newalert-sensor'.$id.'" id="name-newalert-sensor'.$id.'" placeholder="HotHotHot !" maxlength="80" required>
                    <!-- Opérateur de l\'alerte -->
                    <label for="operator-newalert-sensor'.$id.'">Opérateur</label>
                    <select class="form-select mb-3" aria-label="Default select example" name="operator-newalert-sensor'.$id.'" id="operator-newalert-sensor'.$id.'" required>
                        <option selected>Sélectionnez un opérateur</option>
                        <option value="1">></option>
                        <option value="2">=></option>
                        <option value="3">=</option>
                        <option value="4"><=</option>
                        <option value="5"><</option>
                    </select>
                    <!-- Valeur de l\'alerte -->
                    <label for="value-newalert-sensor'.$id.'">Valeur</label>
                    <input class="form-control" type="number" name="value-newalert-sensor'.$id.'" id="value-newalert-sensor'.$id.'" placeholder="35" maxlength="5" required>
                    <hr>
                    <!-- Valider -->
                    <button type="submit" name="newalert-sensor'.$id.'">Créer</button>
                    <button type="button" onclick="hide()">Fermer</button>
                </form>
            </section>
        </article>
        ';
    }

    for ($i = 0; $i < SENSORS_NUMBER; $i++) {
        box($i);
    }
    ?>

</main>