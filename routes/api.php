<?php

use Illuminate\Http\Request;

use App\Estudi;
use App\Dia;
use App\Cita;

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

Route::middleware('auth:api')->group(function () {

    Route::get('/cites', 'API\CitaController@index');

    Route::get('/cita/{cita}/block', 'API\CitaController@block');

    Route::get('/cita/{cita}/cancel', 'API\CitaController@cancel');
});

Route::get('/estudis', 'API\EstudiController@index');

Route::get('/estudi/{estudi}', 'API\EstudiController@show');

Route::get('/dia/{dia}/buides', 'API\DiaController@showWithEmpty');
