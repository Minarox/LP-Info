<?php

class DB {

    // Variables de connexion à la base de données
    private static string $S_host = "{host}";
    private static string $S_db = "{database}";
    private static string $S_user = "{user}";
    private static string $S_pass = "{password}";

    // Connexion à la base de données
    public static function PDO():PDO {
        try {
            $PDO = new PDO("mysql:host=".self::$S_host.";dbname=".self::$S_db, self::$S_user, self::$S_pass);
        } catch (Exception $e) {
            die(ErrorController::error401()."\n".$e->getMessage());
        }
        return $PDO;
    }
}