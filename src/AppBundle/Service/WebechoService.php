<?php

namespace AppBundle\Service;


class WebechoService
{
    private $webecho = null;

    function __construct($host, $token)
    {
        $config = new \Webecho\WebechoConfig([
            'host' => $host,
            'token' => $token
        ]);
        $this->webecho = new \Webecho\Webecho($config);
    }

    function getWebecho()
    {
        return $this->webecho;
    }
}