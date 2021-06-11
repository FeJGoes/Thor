<?php

use App\Http\Controllers\APIAuthController;
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

Route::post('entrar', [
    APIAuthController::class,'signIn'
])->name('api.auth.sing-in');

Route::post('registrar', [
    APIAuthController::class,'signIn'
])->name('api.auth.sing-in');

Route::middleware('auth:api')->group(function () {

    Route::delete('sair', [
        APIAuthController::class, 'signOut'
    ])->name('api.auth.sign-out');

    Route::post('renovar', [
        APIAuthController::class, 'refresh'
    ])->name('api.auth.refresh');

    Route::get('eu',[
        APIAuthController::class, 'me'
    ])->name('api.auth.me');



});
