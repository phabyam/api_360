<?php

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

//CLIENTES
Route::get('/clientes', 'App\Http\Controllers\ClienteController@index');
Route::post('/clientes', 'App\Http\Controllers\ClienteController@store');
Route::put('/clientes/{id}', 'App\Http\Controllers\ClienteController@update');
Route::delete('/clientes/{id}', 'App\Http\Controllers\ClienteController@destroy')->name('deleteCliente');

Route::get('/clientes/{id}', 'App\Http\Controllers\ClienteController@show');

//VIAJES
Route::get('/viajes', 'App\Http\Controllers\ViajeController@index');
Route::post('/viajes', 'App\Http\Controllers\ViajeController@store');