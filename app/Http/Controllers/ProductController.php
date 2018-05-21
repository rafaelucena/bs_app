<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use GuzzleHttp\Client;

class ProductController extends Controller
{
    private $defaultUrl = 'http://localhost:8111/api/v2/products';

    public function index()
    {
        $products = new Product();
        $products = $products->findAll();

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
        $product = new Product();

        $product->name = $request->get('name');
        $product->amount = $request->get('amount');

        $product->save();

        return redirect('products')->with('success', 'Information has been added');
    }

    public function edit($id)
    {
        $product = new Product();
        $product = $product->find($id);

        return view('edit', compact('product','id'));
    }

    public function update(Request $request, $id)
    {
        $product = new Product();
        $product = $product->find($id);

        $product->name = $request->get('name');
        $product->amount = $request->get('amount');

        $product->update();

        return redirect('products')->with('success', 'Information has been updated');
    }

    public function destroy(Request $request, $id)
    {
        $client = new Client();
        $client->request('DELETE', "$this->defaultUrl/$id");

        return redirect('products')->with('success', 'Information has been deleted');
    }
}
