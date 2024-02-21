<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\TypeController;
use App\Services\RouteService;

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

Route::redirect('/', '/components/create');


Route::prefix('/types')->controller(TypeController::class)->group(function () {
    Route::get('/', 'index')->name('type');
    Route::get('/show', 'show')->name('type.show');
});
Route::prefix('/panel')->group(function () {
    Route::resource('components', ComponentController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('pages', PageController::class);
});

Route::get(RouteService::buildPath(request()->getPathInfo()), ResourceController::class);


