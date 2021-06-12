<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ClientesController;
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
$parameters = [
    'clientes' => 'cliente'
];

Route::post('entrar', [
    ApiAuthController::class,'signIn'
])->name('api.auth.sing-in');

Route::post('registrar', [
    ClientesController::class, 'store'
])->name('api.cliente.store');

Route::middleware('auth:api')->group(function () use ($parameters){

    Route::delete('sair', [
        ApiAuthController::class, 'signOut'
    ])->name('api.auth.sign-out');

    Route::post('renovar', [
        ApiAuthController::class, 'refresh'
    ])->name('api.auth.refresh');

    Route::get('eu',[
        ApiAuthController::class, 'me'
    ])->name('api.auth.me');

    Route::apiResources([
        'clientes' => ClientesController::class
    ],['parameters' => $parameters]);


});
