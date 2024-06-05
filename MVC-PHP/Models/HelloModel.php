<?php

class HelloModel {

    // Variables contenant les textes à afficher
    private string $S_helloWorld = "Hello World!";
    private string $S_welcome = "Welcome!";

    // Renvoie "Hello World!"
    public function getHelloWorld():string {
        return $this->S_helloWorld;
    }

    // Renvoie "Welcome!"
    public function getWelcome():string {
        return $this->S_welcome;
    }

}