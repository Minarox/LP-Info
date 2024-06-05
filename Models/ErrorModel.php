<?php

class ErrorModel {

    // Variables contenant les erreurs et leur description
    private string $S_400 = "Error 400 - Bad Request";
    private string $S_401 = "Error 401 - Unauthorized";
    private string $S_403 = "Error 403 - Forbidden";

    // Renvoie l'erreur HTML 400
    public function error_400() {
        return $this->S_400;
    }

    // Renvoie l'erreur HTML 401
    public function error_401() {
        return $this->S_401;
    }

    // Renvoie l'erreur HTML 403
    public function error_403() {
        return $this->S_403;
    }

    // Renvoie l'erreur HTML 404
    public function error_404($S_target) {
        return "Error 404 - ".$S_target." not found";
    }

}