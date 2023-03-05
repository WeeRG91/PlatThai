<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\PlatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::name('plat.')->prefix('plat')->group(function (){
    Route::get('create', [PlatController::class, 'create'])->name('create');
    Route::post('store', [PlatController::class, 'store'])->name('store');
    Route::get('index', [PlatController::class, 'index'])->name('index');
    Route::get('{id}/edit', [PlatController::class, 'edit'])->name('edit');
    Route::post('update', [PlatController::class, 'update'])->name('update');
    Route::get('{id}/delete', [PlatController::class, 'delete'])->name('delete');
});

Route::name('ingredient.')->prefix('ingredient')->group(function (){
    Route::get('create', [IngredientController::class, 'create'])->name('create');
    Route::post('store', [IngredientController::class, 'store'])->name('store');
    Route::get('index', [IngredientController::class, 'index'])->name('index');
    Route::get('{ingredient}/edit', [IngredientController::class, 'edit'])->name('edit');
    Route::post('update/{ingredient}', [IngredientController::class, 'update'])->name('update');
    Route::get('{id}/delete', [IngredientController::class, 'delete'])->name('delete');
});

Route::name('image.')->prefix('image')->group(function (){
    Route::get('{id}/delete', [ImageController::class, 'delete'])->name('delete');
});

Route::name('utilisateur.')->prefix('utilisateur')->group(function (){
    Route::get('create', [UserController::class, 'create'])->name('create');
    Route::post('store', [UserController::class, 'store'])->name('store');
    Route::get('index', [UserController::class, 'index'])->name('index');
    Route::get('{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::post('update/{user}', [UserController::class, 'update'])->name('update');
    Route::get('{id}/delete', [UserController::class, 'delete'])->name('delete');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
