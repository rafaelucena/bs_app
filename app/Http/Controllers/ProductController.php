<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ProductController extends Controller
{
    private $defaultUrl = 'http://localhost:8111/api/v2/products';

    public function index()
    {
        $client = new Client();
        $request = $client->request('GET', $this->defaultUrl);

        $products = json_decode($request->getBody());

        return view('index', compact('products'));
    }

    public function available($input = 1)
    {
        $client = new Client();
        $request = $client->request('GET', "$this->defaultUrl?amount>=$input");

        $products = json_decode($request->getBody());

        return view('index', compact('products'));
    }

    public function having($input = 0)
    {
        $client = new Client();
        $request = $client->request('GET', "$this->defaultUrl?amount>=$input");

        $products = json_decode($request->getBody());

        return view('index', compact('products'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $client = new Client();
        $client->request('POST', $this->defaultUrl, [
            'form_params' => [
                'name' => $request->get('name'),
                'amount' => $request->get('amount'),
            ]
        ]);

        return redirect('products')->with('success', 'Information has been added');
    }

    public function edit($id)
    {
        $client = new Client();
        $request = $client->request('GET', "$this->defaultUrl/$id");

        $product = json_decode($request->getBody());

        return view('edit', compact('product','id'));
    }

    public function update(Request $request, $id)
    {
        $client = new Client();
        $client->request('PUT', "$this->defaultUrl/$id", [
            'form_params' => [
                'name' => $request->get('name'),
                'amount' => $request->get('amount'),
            ]
        ]);

        return redirect('products')->with('success', 'Information has been updated');
    }

    public function destroy(Request $request, $id)
    {
        $client = new Client();
        $client->request('DELETE', "$this->defaultUrl/$id");

        return redirect('products')->with('success', 'Information has been deleted');
    }
}
