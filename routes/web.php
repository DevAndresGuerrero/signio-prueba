<?php

use Illuminate\Support\Facades\Route;

// Route::view('/{any?}', 'welcome');

Route::view('/{vue?}', 'vue')->where('vue', '[\/\w\.-]*');
