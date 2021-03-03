<?php


namespace App\Core\Classes\SuperGlobals;


use JetBrains\PhpStorm\Pure;

class Request
{
    public Get $get;
    public Session $session;
    public Cookie $cookie;

    #[Pure] public function __construct()
    {
        $this->get = new Get();
        $this->session = new Session();
        $this->cookie = new Cookie();
    }
}