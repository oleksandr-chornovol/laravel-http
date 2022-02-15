<?php

use App\Http\Controllers\ExampleController;
use App\Http\Controllers\TextController;
use App\Http\Controllers\VoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/http-example', [ExampleController::class, 'index']);

Route::resource('/votes', VoteController::class);

Route::post('text/analyze', [TextController::class, 'analyze']);
Route::get('text/average-of-statistical-data', [TextController::class, 'getAverageOfStatisticalData']);
Route::get('text/number-of-analyzed-texts', [TextController::class, 'getNumberOfAnalyzedTexts']);
