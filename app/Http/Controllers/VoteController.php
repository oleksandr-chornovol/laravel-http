<?php

namespace App\Http\Controllers;

use App\Http\Stubs\VoteStub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VoteController extends Controller
{
    public function index()
    {
        if (env('OFFLINE_MODE')) {
            VoteStub::index();
        }

        $response = Http::withHeaders(config('api_thecatapi.default_headers'))
            ->get(config('api_thecatapi.url').'/votes');

        return response($response->json(), $response->status());
    }

    public function show($id)
    {
        if (env('OFFLINE_MODE')) {
            VoteStub::show($id);
        }

        $response = Http::withHeaders(config('api_thecatapi.default_headers'))
            ->get(config('api_thecatapi.url')."/votes/$id");

        return response($response->json(), $response->status());
    }

    public function store(Request $request)
    {
        if (env('OFFLINE_MODE')) {
            VoteStub::store();
        }

        $response = Http::withHeaders(config('api_thecatapi.default_headers'))
            ->post(config('api_thecatapi.url').'/votes', $request->all());

        return response($response->json(), $response->status());
    }

    public function destroy($id)
    {
        if (env('OFFLINE_MODE')) {
            VoteStub::destroy($id);
        }

        $response = Http::withHeaders(config('api_thecatapi.default_headers'))
            ->delete(config('api_thecatapi.url')."/votes/$id");

        return response($response->json(), $response->status());

    }
}
