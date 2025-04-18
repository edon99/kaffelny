<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::post('/register', [\App\Http\Controllers\API\Auth\AuthentificationController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\API\Auth\AuthentificationController::class, 'login']);
Route::post('/provider/register', [\App\Http\Controllers\API\Auth\AuthentificationController::class, 'registerProvider']);
Route::post('/provider/login', [\App\Http\Controllers\API\Auth\AuthentificationController::class, 'loginProvider']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [\App\Http\Controllers\API\Auth\AuthentificationController::class, 'user']);
    Route::get('/provider', [\App\Http\Controllers\API\Auth\AuthentificationController::class, 'provider']);
    Route::post('/offers/create', [\App\Http\Controllers\API\OfferController::class, 'createOffer']);
    Route::get('/offers/', [\App\Http\Controllers\API\OfferController::class, 'getOffers']);
    Route::get('/offers/{id}', [\App\Http\Controllers\API\OfferController::class, 'getOfferDetails']);

});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

