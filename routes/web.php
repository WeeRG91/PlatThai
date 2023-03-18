<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\PlatController;
use App\Http\Controllers\RoleController;
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

Route::prefix('admin')->name('admin.')->group(function (){

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

        Route::post('search', [IngredientController::class, 'search'])->name('search');
        Route::post('allergen/{ingredient}', [IngredientController::class, 'isAllergen'])->name('isAllergen');

        /**
         * API
         */
        Route::post('toggle-stock/{ingredient}', [IngredientController::class, 'toggleStock'])->name('toggleStock');
    });

    Route::name('image.')->prefix('image')->group(function (){
        Route::get('index', [ImageController::class, 'index'])->name('index');
        Route::get('{id}/delete', [ImageController::class, 'delete'])->name('delete');
    });

    Route::name('utilisateur.')->prefix('utilisateur')->group(function (){
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('index', [UserController::class, 'index'])->name('index');
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [UserController::class, 'update'])->name('update');
        Route::get('{id}/delete', [UserController::class, 'delete'])->name('delete');
    });

    Route::name('role.')->prefix('role')->group(function (){
        Route::get('create', [RoleController::class, 'create'])->name('create');
        Route::post('store', [RoleController::class, 'store'])->name('store');
        Route::get('index', [RoleController::class, 'index'])->name('index');
        Route::get('{id}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [RoleController::class, 'update'])->name('update');
        Route::get('{id}/delete', [RoleController::class, 'delete'])->name('delete');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
