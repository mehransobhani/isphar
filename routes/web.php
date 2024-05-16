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

Route::group(['as' => 'patient.', 'prefix' => 'patient'], function () {
    Route::get("index", [\App\Http\Controllers\PatientController::class, "index"])->name("index");
    Route::get("create", [\App\Http\Controllers\PatientController::class, "create"])->name("create");
    Route::get("edit/{id}", [\App\Http\Controllers\PatientController::class, "edit"])->name("edit");
    Route::post("store", [\App\Http\Controllers\PatientController::class, "store"])->name("store");
    Route::post("update", [\App\Http\Controllers\PatientController::class, "update"])->name("update");
});
