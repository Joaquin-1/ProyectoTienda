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

//Esta ruta específica está diseñada para devolver la información del usuario autenticado cuando se
//realiza una solicitud GET a "/user" y solo estará disponible para usuarios autenticados.


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
