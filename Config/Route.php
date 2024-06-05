<?php

class Route {

    // Variables des routes et erreurs
    public static $A_validRoutes = array();
    public static $I_errorCount = 0;

    // Formatage de l'URL et récupération des variables
    public static function setUrl($S_url) {
        if (strpos($S_url, '/') != false) {
            $I_pos = strpos($S_url, '/');
            $_GET['int'] = substr($S_url, $I_pos+1);
            if (!is_numeric($_GET['int'])) {
                $_GET['url'] = "error";
            } else {
                $_GET['url'] = substr($S_url, 0, $I_pos)."/:int";
            }
        }
    }

    // Tableau des différentes routes possibles
    public static function setValidRoutes($A_validRoutes) {
        self::$A_validRoutes = $A_validRoutes;
    }

    // Appel GET vers la route souhaité
    public static function goTo($S_route, $O_function) {
        if (in_array($_GET['url'], self::$A_validRoutes)) {
            if ($_GET['url'] == $S_route) {
                $O_function->__invoke();
            }
        } elseif(self::$I_errorCount == 0) {
            ErrorController::error404("Route");
            self::$I_errorCount++;
        }
    }

}