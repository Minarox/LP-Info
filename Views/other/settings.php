<main class="container-md">
    <!-- Titre général pour l'accessibilité -->
    <h1 id="accessibility">Personnalisation des alertes des différents capteurs.</h1>
    <?php
    use App\Controllers\SensorsController;
    SensorsController::get();

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
        <!-- Boite principale -->
        <article class="box'.$margin_box.'">
            <section>
                <!-- Titre -->
                <section class="row">
                    <h2 class="col box-title m-0">'.$name.' ['.$type.']</h2>
                    <a class="col-1 d-flex align-items-center justify-content-end" href=""><img src="'. SCRIPTS . 'images/download.png' .'"></a>
                </section>
                <hr>
                <!-- Sélection de l\'alerte -->
                <section class="row">
                    <label class="col-3 col-sm-2 col-lg-1 d-flex align-items-center" for="select-alert">Alertes</label>
                    <select class="col form-select" aria-label="Default select example" name="select-alert" id="select-alert" required>
                        <option selected>Sélectionnez une alerte</option>
                        <option value="1">Alerte 1</option>
                        <option value="2">Alerte 2</option>
                        <option value="3">Alerte 3</option>
                    </select>
                    <a class="col-2 col-md-1 button" href="#" onclick="show()">
                        <button class="mb-0" type="button">+</button>
                    </a>
                </section>
                <hr>
            </section>
            <form class="p-0" action="" method="post">
                <!-- Modification de l\'alerte sélectionnée -->
                <label for="name-alert">Nom de l\'alerte</label>
                <input class="form-control mb-3" type="text" name="name-alert" id="name-alert" placeholder="HotHotHot !" maxlength="80" required>
                <section class="row">
                    <div class="col pb-0">
                        <label for="operator-alert">Opérateur</label>
                        <select class="col form-select" aria-label="Default select example" name="operator-alert" id="operator-alert" required>
                            <option selected>Sélectionnez un opérateur</option>
                            <option value="1">></option>
                            <option value="2">=></option>
                            <option value="3">=</option>
                            <option value="4"><=</option>
                            <option value="5"><</option>
                        </select>
                    </div>
                    <div class="col pb-0">
                        <label for="value-alert">Valeur</label>
                        <input class="form-control" type="number" name="value-alert" id="value-alert" placeholder="35" maxlength="5" required>
                    </div>
                </section>
                <hr>
                <button class="m-0" name="update-alert" type="submit">Modifier</button>
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
                    <label for="name-alert">Nom de l\'alerte</label>
                    <input class="form-control" type="text" name="name-alert" id="name-alert" placeholder="HotHotHot !" maxlength="80" required>
                    <!-- Opérateur de l\'alerte -->
                    <label for="operator-alert">Opérateur</label>
                    <select class="form-select mb-3" aria-label="Default select example" name="operator-alert" id="operator-alert" required>
                        <option selected>Sélectionnez un opérateur</option>
                        <option value="1">></option>
                        <option value="2">=></option>
                        <option value="3">=</option>
                        <option value="4"><=</option>
                        <option value="5"><</option>
                    </select>
                    <!-- Valeur de l\'alerte -->
                    <label for="value-alert">Valeur</label>
                    <input class="form-control" type="number" name="value-alert" id="value-alert" placeholder="35" maxlength="5" required>
                    <hr>
                    <!-- Valider -->
                    <button type="submit" name="password_update">Créer</button>
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