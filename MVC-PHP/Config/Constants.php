<?php

final class Constants {

    // Constantes d'emplacement des différents dossiers
    const CONFIG = "/Config/";
    const CONTROLLERS = "/Controllers/";
    const MODELS = "/Models/";
    const VIEWS = "/Views/";

    // Emplacement de la racine
    public static function rootFolder() {
        return realpath(__DIR__."/../");
    }

    // Emplacement du dossier "Config"
    public static function configFolder() {
        return self::rootFolder().self::CONFIG;
    }

    // Emplacement du dossier "Controllers"
    public static function controllersFolder() {
        return self::rootFolder().self::CONTROLLERS;
    }

    // Emplacement du dossier "Models"
    public static function modelsFolder() {
        return self::rootFolder().self::MODELS;
    }

    // Emplacement du dossier "Views"
    public static function viewsFolder() {
        return self::rootFolder().self::VIEWS;
    }

}