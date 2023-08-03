<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/products', ProductController::class);
Route::apiResource('/orders', OrderController::class);
Route::get('/carts/{user_id}', [CartController::class, 'show'])->name('carts.show');
Route::put('/carts/{user_id}',[CartController::class, 'adauga'])->name('carts.adauga');
Route::delete('/carts/{user_id}/{id}', [CartController::class, 'sterge'])->name('carts.sterge');
Route::post('/users/register', [UserController::class, 'register'])->name('users.register');
Route::post('/users/login', [UserController::class, 'login'])->name('users.login');
Route::middleware('auth:sanctum')->post('/users/logout', [UserController::class, 'logout'])->name('users.logout');
Route::apiResource('/users', UserController::class);

