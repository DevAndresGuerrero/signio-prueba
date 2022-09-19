<?php

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::get('/countries', fn () => getCountries());
Route::get('/country/{query}', fn ($query) => getCountry($query));
Route::get('/categories', fn () => Category::all());
Route::apiResource('users', UserController::class);
