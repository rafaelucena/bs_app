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

        foreach ($this->attributes as $attribute) {
            $this->{$attribute} = null;
        }
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

    public function findAll($query = array())
    {
        if (empty($query)) {
            $request = $this->handler->request('GET', $this->baseUrl);
        } else {
            $input = $query['amount'];
            if ($input != '0') {
                $request = $this->handler->request('GET', "$this->baseUrl?amount>=$input");
            } else {
                $request = $this->handler->request('GET', "$this->baseUrl?amount=$input");
            }
        }

        $result = array();

        $found = json_decode($request->getBody(), 1);

        foreach ($found as $find) {
            $local = clone $this;

            foreach ($this->attributes as $attribute) {
                $local->{$attribute} = $find[$attribute];
            }

            $result[] = $local;
        }

        return $result;
    }

    public function update()
    {
        $this->handler->request('PUT', "$this->baseUrl/$this->id", [
            'form_params' => [
                'name' => $this->name,
                'amount' => $this->amount,
            ]
        ]);
    }

    public function save()
    {
        $this->handler->request('POST', $this->baseUrl, [
            'form_params' => [
                'name' => $this->name,
                'amount' => $this->amount,
            ]
        ]);
    }

    public function delete()
    {
        $this->handler->request('DELETE', "$this->baseUrl/$this->id");
    }
}
