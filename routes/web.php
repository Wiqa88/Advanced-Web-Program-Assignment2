<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstrumentController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('instruments.index');
});

Route::resource('instruments', InstrumentController::class);

Route::resource('categories', CategoryController::class);
