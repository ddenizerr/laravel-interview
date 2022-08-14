<?php

use App\Http\Controllers\ApiController;
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

// TODO CREATE CONTROLLERS AND ACTIONS
// TODO CREATE API

Route::controller(ApiController::class)->group(function (){
    Route::get('/properties', 'index')->name('index');
    Route::get('/properties/{id}','property')->name('property');
    Route::post('/property','create')->name('create');
});
