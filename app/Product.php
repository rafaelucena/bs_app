<?php

namespace App;

use GuzzleHttp\Client;

class Product
{
    // Attributes
    private $id;

    private $name;

    private $amount;

    // Usage
    private $handler;

    public function __construct()
    {
        $this->handler = new Client();
    }
}
