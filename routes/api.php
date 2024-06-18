<?php

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

Route::get("home_page", [\App\Http\Controllers\Api\HomePageController::class, "index"]);

Route::get("blog", [\App\Http\Controllers\Api\BlogController::class, "getByCatId"]);
Route::get("blog/{id}", [\App\Http\Controllers\Api\BlogController::class, "view"]);

Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/forgot', [\App\Http\Controllers\Api\AuthController::class, 'forgot']);
Route::post('/forgot_code_verify', [\App\Http\Controllers\Api\AuthController::class, 'forgotCodeVerify']);
Route::post('/reset_password', [\App\Http\Controllers\Api\AuthController::class, 'resetPassword']);

Route::post('/request_demo', [\App\Http\Controllers\Api\DemoRequestController::class, 'submit']);


Route::group(["as" => "user", "prefix" => "user", "middleware" => "auth:sanctum" ], function () {
    Route::group(["as" => "patient", "prefix" => "patient"], function () {
    Route::post('/insert_from_excel', [\App\Http\Controllers\Api\ExcelImportController::class, 'import']);
        Route::get("/", [\App\Http\Controllers\Api\PatientController::class, "index"]);
        Route::get("search", [\App\Http\Controllers\Api\PatientController::class, "search"]);
        Route::delete("delete", [\App\Http\Controllers\Api\PatientController::class, "delete"]);
        Route::post("insert", [\App\Http\Controllers\Api\PatientController::class, "insert"]);
        Route::patch("update", [\App\Http\Controllers\Api\PatientController::class, "update"]);
        Route::post("tarkhis", [\App\Http\Controllers\Api\PatientController::class, "tarkhis"]);
        Route::post("dead", [\App\Http\Controllers\Api\PatientController::class, "dead"]);
        Route::get("/{id}", [\App\Http\Controllers\Api\PatientController::class, "find"]);
    });

    Route::group(["as" => "drp", "prefix" => "drp"], function () {
        Route::get("/", [\App\Http\Controllers\Api\DrpReportController::class, "index"]);
        Route::delete("delete", [\App\Http\Controllers\Api\DrpReportController::class, "delete"]);
        Route::post("insert", [\App\Http\Controllers\Api\DrpReportController::class, "insert"]);
        Route::patch("update", [\App\Http\Controllers\Api\DrpReportController::class, "update"]);
        Route::get("search", [\App\Http\Controllers\Api\DrpReportController::class, "search"]);
        Route::get("/{id}", [\App\Http\Controllers\Api\DrpReportController::class, "find"]);


    });
    Route::group(["as" => "calcs", "prefix" => "calcs"], function () {
        Route::post("calc_insert", [\App\Http\Controllers\Api\CalcsHistoryController::class, "calc_insert"]);
        Route::get("crcl_history", [\App\Http\Controllers\Api\CalcsHistoryController::class, "crcl_history"]);
    });
    Route::group(["as" => "drugs", "prefix" => "drugs"], function () {
        Route::get("search", [\App\Http\Controllers\Api\DrugController::class, "search"]);
        Route::post("insert", [\App\Http\Controllers\Api\DrugController::class, "insert"]);
    });

    Route::post("add_special_conditions", [\App\Http\Controllers\Api\PatientSpecialConditionController::class, "insert"]);
    Route::delete("delete_special_conditions", [\App\Http\Controllers\Api\PatientSpecialConditionController::class, "delete"]);
    Route::patch("update_special_conditions", [\App\Http\Controllers\Api\PatientSpecialConditionController::class, "update"]);
    Route::get("get_special_conditions", [\App\Http\Controllers\Api\PatientSpecialConditionController::class, "get"]);

    Route::post("add_patient_drug", [\App\Http\Controllers\Api\PatientDrugController::class, "insert"]);
    Route::delete("delete_patient_drug", [\App\Http\Controllers\Api\PatientDrugController::class, "delete"]);
    Route::post("update_patient_drug", [\App\Http\Controllers\Api\PatientDrugController::class, "update"]);
    Route::get("get_patient_drug", [\App\Http\Controllers\Api\PatientDrugController::class, "get"]);

    Route::get("dashboard", [\App\Http\Controllers\Api\DashboardController::class, "index"]);
    Route::post("update", [\App\Http\Controllers\Api\UserController::class, "update"]);
    Route::post("change_pwd", [\App\Http\Controllers\Api\UserController::class, "changePwd"]);

    Route::get("profile", [\App\Http\Controllers\Api\AuthController::class, "profile"]);

});
