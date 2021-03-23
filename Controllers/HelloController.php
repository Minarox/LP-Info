<?php

class HelloController {

    // "Hello World!"
    public static function helloWorld() {
        $O_model = new HelloModel();
        Buffer::show("HelloView", array('hello' => $O_model->getHelloWorld()));
    }

    // "Welcome!"
    public static function welcome() {
        $O_model = new HelloModel();
        Buffer::show("HelloView", array('hello' => $O_model->getWelcome()));
    }

}