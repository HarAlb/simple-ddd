<?php

use App\Api\V1\Admin\ApiAdminController;
use App\Api\V1\AuthAdmin\ApiAuthAdminController;
use App\Api\V1\Category\ApiCategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function (){
    Route::post('/login', [ApiAuthAdminController::class, 'login']);
});

Route::group(['middleware' => ['auth:admin-api', 'scopes:admin']], function (){
    Route::get('/profile', [ApiAdminController::class, 'profile']);

    Route::apiResource('categories', ApiCategoryController::class);
});