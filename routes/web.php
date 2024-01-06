<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DropdownController;
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

Route::get('/', [DropdownController::class, 'index']);
Route::get('/state/{country_id}', [DropdownController::class, 'state']);
Route::get('/city/{state_id}', [DropdownController::class, 'city']);



Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/category/{id}/show', [CategoryController::class, 'show'])->name('category.show');
Route::get('/category/fetch-all', [CategoryController::class, 'fetchAllCategory'])->name('category.fetchAll');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::post('/category/{id}/update', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');
