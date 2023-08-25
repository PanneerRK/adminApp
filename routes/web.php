<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
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

Route::get('/dashboard', function () {
    return view('layouts.dash_layout');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/edit_profile', [UserController::class, 'index'])->name('edit_profile');
    Route::post('/update_profile/{id}', [UserController::class, 'update'])->name('update_profile');
    Route::get('/conatct', [ContactController::class, 'index'])->name('contact');
    Route::post('/store_contact', [ContactController::class, 'store'])->name('store_contact');

    // Route::resource('category', CategoryController::class);
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');

    Route::resource('product', ProductController::class);
});

require __DIR__.'/auth.php';
