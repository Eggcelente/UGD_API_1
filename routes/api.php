<?php


use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BookingController;
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

Route::post('/login', [App\Http\Controllers\UserController::class, 'login']);
Route::post('/inputProduct', [App\Http\Controllers\ProductController::class, 'inputProduct']);
Route::apiResource('user', UserController::class);
Route::apiResource('product', ProductController::class);
Route::apiResource('Booking', BookingController::class);

