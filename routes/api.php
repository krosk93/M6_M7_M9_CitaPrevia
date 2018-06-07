<?php

use Illuminate\Http\Request;

use App\Estudi;
use App\Dia;

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
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/dia/{dia}', function (Dia $dia) {
        return $dia->load('cites');
    });
});

Route::get('/estudis', function() {
    return Estudi::all();
});

Route::get('/estudi/{estudi}', function(Estudi $estudi) {
    return $estudi->load('dies');
});

Route::get('/dia/{dia}/buides', function (Dia $dia) {
    return $dia->load(['cites' => function($query) {
      $query->where('estat', 'buit');
    }]);
});
