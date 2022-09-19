<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::get('/countries', function() {
    return getCountries();
});

Route::apiResource('users', UserController::class);
