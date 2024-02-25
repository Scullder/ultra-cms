<?php

use App\Http\Controllers\RenderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\PageController;
use App\Http\Controllers\Panel\ComponentController;
use App\Http\Controllers\Panel\TypeController;
use App\Http\Controllers\Site\DefaultController;
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

Route::prefix(config('route.panel_path'))->group(function () {
    Route::get('/categories/select', [CategoryController::class, 'select'])->name('categories.select');
    Route::get('/pages/select', [PageController::class, 'select'])->name('pages.select');
    
    Route::resource('categories', CategoryController::class);
    Route::resource('pages', PageController::class);
    Route::resource('components', ComponentController::class);
    Route::resource('types', TypeController::class);
    Route::get('/render/selected', [RenderController::class, 'getSelected'])->name('render.selected');
});

Route::get(RouteService::buildPath(request()->getPathInfo()), DefaultController::class);
