<?php

use App\Http\Controllers\PropertyController;
use App\Http\Controllers\CertificatesController;
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

// TODO CREATE API

Route::controller(PropertyController::class)->group(function (){
    Route::get('/properties', 'index')->name('index');
    Route::get('/properties/{id}','property')->name('property');
    Route::post('/property','create')->name('create');
    Route::patch('/property/{id}','update')->name('update');
    Route::delete('/property/{id}','destroy')->name('destroy');
    Route::get('/property/{id}/certificate','getCertificates')->name('certificate');
    Route::get('/property/{id}/notes','getNotes')->name('notes');
});

Route::controller(CertificatesController::class)->group(function (){
    Route::get('/certificate', 'index')->name('index');
    Route::get('/certificate/{id}', 'certificate')->name('certificate');
    Route::post('/certificate', 'create')->name('create');

});

