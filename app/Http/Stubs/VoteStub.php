<?php

namespace App\Http\Stubs;

use Illuminate\Support\Facades\Http;

class VoteStub
{
    public static function index()
    {
        $uri = config('api_thecatapi.url').'/votes';
        $body = [['id' => 1, 'name' => 'some_name']];
        $code = 200;
        $headers = [];

        Http::fake([$uri => Http::response($body, $code, $headers)]);
    }

    public static function show($id)
    {
        $uri = config('api_thecatapi.url')."/votes/$id";
        $body = ['id' => 1, 'name' => 'some_name'];
        $code = 200;
        $headers = [];

        Http::fake([$uri => Http::response($body, $code, $headers)]);
    }

    public static function store()
    {
        $uri = config('api_thecatapi.url').'/votes';
        $body = ['message' => 'SUCCESS', 'id' => 1];
        $code = 201;
        $headers = [];

        Http::fake([$uri => Http::response($body, $code, $headers)]);
    }

    public static function destroy($id)
    {
        $uri = config('api_thecatapi.url')."/votes/$id";
        $body = ['message' => 'SUCCESS'];
        $code = 200;
        $headers = [];

        Http::fake([$uri => Http::response($body, $code, $headers)]);
    }
}
