<?php

namespace App;

use GuzzleHttp\Client;

class Product
{
    // Attributes
    private $attributes = ['id', 'name', 'amount'];

    // Usage
    private $baseUrl;

    private $handler;

    public function __construct()
    {
        $this->baseUrl = 'http://localhost:8111/api/v2/products';
        $this->handler = new Client();
    }

    public function find($id)
    {
        $request = $this->handler->request('GET', "$this->baseUrl/$id");

        $found = json_decode($request->getBody(),1);

        foreach ($this->attributes as $attribute) {
            $this->{$attribute} = $found[$attribute];
        }

        return $this;
    }
}
