<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

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

Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/detail/{id}', [ProductController::class, 'detail']);

Route::get('/products/register', [ProductController::class, 'register']);

Route::post('/products/register', [ProductController::class, 'store']);

Route::put('/products/{id}/update', [ProductController::class, 'update']);

Route::delete('/products/{id}/delete', [ProductController::class, 'destroy']);

Route::get('/products/search', [ProductController::class, 'search']);