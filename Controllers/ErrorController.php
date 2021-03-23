<?php

class ErrorController {

    // Erreur HTML 400 - Mauvaise requète
    public static function error400() {
        $O_model = new ErrorModel();
        Buffer::show("ErrorView", array('error' => $O_model->error_400()));
    }

    // Erreur HTML 401 - Non autorisé
    public static function error401() {
        $O_model = new ErrorModel();
        Buffer::show("ErrorView", array('error' => $O_model->error_401()));
    }

    // Erreur HTML 403 - Interdiction
    public static function error403() {
        $O_model = new ErrorModel();
        Buffer::show("ErrorView", array('error' => $O_model->error_403()));
    }

    // Erreur HTML 404 - Objet introuvable
    public static function error404($S_target) {
        $O_model = new ErrorModel();
        Buffer::show("ErrorView", array('error' => $O_model->error_404($S_target)));
    }

}