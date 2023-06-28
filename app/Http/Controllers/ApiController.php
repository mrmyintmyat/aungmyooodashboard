<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function fetchData()
    {
        $client = new Client();
        $response = $client->get('https://fakestoreapi.com/products');

        $data = json_decode($response->getBody(), true);

        return view('index', compact('data'));
    }
}
