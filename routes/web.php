<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstrumentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('instruments.index');
});

Route::resource('instruments', InstrumentController::class);

require __DIR__.'/auth.php';
