<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get("home_page",[\App\Http\Controllers\Api\HomePageController::class,"index"]);

Route::get("blog",[\App\Http\Controllers\Api\BlogController::class,"getByCatId"]);
Route::get("blog/{id}",[\App\Http\Controllers\Api\BlogController::class,"view"]);


Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/forgot', [\App\Http\Controllers\Api\AuthController::class, 'forgot']);
Route::post('/forgot_code_verify', [\App\Http\Controllers\Api\AuthController::class, 'forgotCodeVerify']);
Route::post('/reset_password', [\App\Http\Controllers\Api\AuthController::class, 'resetPassword']);
