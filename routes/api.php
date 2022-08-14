<?php

use App\Http\Controllers\NoteController;
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

Route::controller(PropertyController::class)->group(function (){
    Route::get('/properties', 'index');
    Route::get('/properties/{id}','property');
    Route::post('/property','create');
    Route::patch('/property/{id}','update');
    Route::delete('/property/{id}','destroy');
    Route::get('/property/{id}/certificate','getCertificates');
    Route::get('/property/certificate/count','haveMoreThan5Certificates');
    Route::get('/property/certificate/count/raw','haveMoreThan5CertificatesRaw');
});

Route::controller(CertificatesController::class)->group(function (){
    Route::get('/certificate', 'index')->name('index');
    Route::get('/certificate/{id}', 'certificate')->name('certificate');
    Route::post('/certificate', 'create')->name('create');

});

Route::controller(NoteController::class)->group(function (){

    Route::get('/{type}/{id}/note','show');
    Route::post('/{type}/{id}/note','create');
});

