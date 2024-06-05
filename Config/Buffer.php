<?php

final class Buffer {

    // Ouverture du buffer d'affichage
    public static function open() {
        ob_start();
    }

    // Récupération du contenu du buffer d'affichage
    public static function get() {
        return ob_get_clean();
    }

    // Affichage du contenu du buffer
    public static function show($S_View, $A_result = array()) {
        $S_file = Constants::viewsFolder().$S_View.'.php';
        $S_static = Constants::viewsFolder().'Template/';
        $I_pos = strpos($S_static, 'Views/');
        if (strpos($_GET['url'], '/') != false) {
            $A_result['path'] = "../";
        }
        $A_result['static'] = substr($S_static, $I_pos);
        ob_start();
        include $S_file;
        ob_end_flush();
    }

}