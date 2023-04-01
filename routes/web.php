<?php

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

Route::get('collections', [App\Http\Controllers\FrontendController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::controller(App\Http\Controllers\CategoryController::class)->group(function (){
        Route::get('category', 'index');
        Route::get('category/create', 'create');
        Route::post('category', 'store');
        Route::get('category/{category_id}/delete', 'destroy');
    });
});

Route::prefix('admin')->group(function () {
    Route::controller(App\Http\Controllers\PostController::class)->group(function (){
        Route::get('posts', 'index');
        Route::get('posts/create', 'create');
        Route::post('posts', 'store');
        Route::get('posts/{post}/edit', 'edit');
        Route::put('posts/{post}', 'update');
        Route::get('posts/{post}/delete', 'destroy');

    });
});
