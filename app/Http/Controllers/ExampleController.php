<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function index(Request $request)
    {
        $result['some_parameter'] = $request->input('some_parameter');

        // just another way for retrieve parameter
        $result['the_same_some_parameter'] = $request->some_parameter_key;

        $result['some_nested_parameter'] = $request->input('products.0.name');

        // returns true for 1, "1", true, "true", "on", and "yes"
        $result['some_boolean_value'] = $request->boolean('archived');

        $result['all_parameters_without_password'] = $request->except(['password']);

        $result['all_parameters'] = $request->all();

        // uri without domain
        $result['path'] = $request->path();

        $result['full_url'] = $request->fullUrl();

        $result['request_method'] = $request->method();

        $result['some_header'] = $request->header('Authorization', 'default_value');

        // returns bool
        $result['auth_header_exist'] = $request->hasHeader('Authorization');

        $result['ip_address'] = $request->ip();

        $result['some_cookie'] = $request->cookie('some_cookie');

        return response()->json($result);
    }
}
