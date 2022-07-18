<?php

use Illuminate\Support\Facades\Route;
use App\Api\V1\Auth\ApiAuthController;
use App\Api\V1\User\ApiUserController;

Route::prefix('auth')->group(function (){
    Route::post('/login', [ApiAuthController::class, 'login']);
    Route::post('/register', [ApiAuthController::class, 'register']);
});

Route::group(['middleware' => 'auth:api'], function (){
    Route::get('/profile', [ApiUserController::class, 'profile']);
});