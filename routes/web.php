<?php

use App\Http\Controllers\ConstructorTypesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('constructor/index');
});

Route::prefix('/constructor/types')->group(function () {
    Route::get('/', [ConstructorTypesController::class, 'index'])->name('constructor.types');
    Route::get('/select', [ConstructorTypesController::class, 'select'])->name('constructor.types.select');

});

