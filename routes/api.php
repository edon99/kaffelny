<?php


use App\Http\Controllers\API\Auth\AuthentificationController;
use App\Http\Controllers\API\OfferController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::post('/register', [AuthentificationController::class, 'register']);
Route::post('/login', [AuthentificationController::class, 'login']);
Route::post('/provider/register', [AuthentificationController::class, 'registerProvider']);
Route::post('/provider/login', [AuthentificationController::class, 'loginProvider']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthentificationController::class, 'user']);
    Route::get('/provider', [AuthentificationController::class, 'provider']);
    Route::post('/offers/create', [OfferController::class, 'createOffer']);
    Route::get('/offers/', [OfferController::class, 'getOffers']);
    Route::get('/offers/nearby', [OfferController::class, 'fetchNearbyOffers']);
    Route::get('/offers/user/all', [OfferController::class, 'getUserOffers']);
    Route::get('/offers/provider/all', [OfferController::class, 'getProviderOffers']);
    Route::get('/offers/{id}', [OfferController::class, 'getOfferDetails']);
    Route::put('/offers/{id}/accept', [OfferController::class, 'acceptOffer']);
    Route::put('/offers/{id}/cancel', [OfferController::class, 'cancelOffer']);



});


