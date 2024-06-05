<?php

// Appel des emplacements de dossiers
require 'Constants.php';

final class AutoLoad {

    // Chargement des classes du dossier "Config"
    public static function loadConfig($S_className) {
        $S_file = Constants::configFolder()."$S_className.php";
        return static::load($S_file);
    }

    // Chargement des classes du dossier "Controllers"
    public static function loadControllers($S_className) {
        $S_file = Constants::controllersFolder()."$S_className.php";
        return static::load($S_file);
    }

    // Chargement des classes du dossier "Models"
    public static function loadModels($S_className) {
        $S_file = Constants::modelsFolder()."$S_className.php";
        return static::load($S_file);
    }

    // Chargement des classes du dossier "Views"
    public static function loadViews($S_className) {
        $S_file = Constants::viewsFolder()."$S_className.php";
        return static::load($S_file);
    }

    // Chargement des routes
    public static function loadRoutes() {
        $S_file = Constants::configFolder()."Routes.php";
        return static::load($S_file);
    }

    // Chargement des fichiers
    private static function load($S_file) {
        if (is_readable($S_file)) {
            require $S_file;
        }
    }

}

// Ajout des fichiers à l'autoloader
spl_autoload_register("AutoLoad::loadConfig");
spl_autoload_register("AutoLoad::loadControllers");
spl_autoload_register("AutoLoad::loadModels");
spl_autoload_register("AutoLoad::loadViews");

// Chargement du buffer et des routes
Buffer::open();
AutoLoad::loadRoutes();