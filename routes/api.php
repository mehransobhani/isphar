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

Route::get("home_page", [\App\Http\Controllers\Api\HomePageController::class, "index"]);

Route::get("blog", [\App\Http\Controllers\Api\BlogController::class, "getByCatId"]);
Route::get("blog/{id}", [\App\Http\Controllers\Api\BlogController::class, "view"]);


Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/forgot', [\App\Http\Controllers\Api\AuthController::class, 'forgot']);
Route::post('/forgot_code_verify', [\App\Http\Controllers\Api\AuthController::class, 'forgotCodeVerify']);
Route::post('/reset_password', [\App\Http\Controllers\Api\AuthController::class, 'resetPassword']);
Route::group(["as" => "user", "prefix" => "user"], function () {
//    ,'middleware' => 'auth:admin'
    Route::group(["as" => "patient", "prefix" => "patient"], function () {
        Route::get("/", [\App\Http\Controllers\Api\PatientController::class, "index"]);
        Route::get("/{id}", [\App\Http\Controllers\Api\PatientController::class, "find"]);
        Route::get("search", [\App\Http\Controllers\Api\PatientController::class, "search"]);
        Route::delete("delete", [\App\Http\Controllers\Api\PatientController::class, "delete"]);
        Route::post("insert", [\App\Http\Controllers\Api\PatientController::class, "insert"]);
        Route::patch("update", [\App\Http\Controllers\Api\PatientController::class, "update"]);
        Route::patch("tarkhis", [\App\Http\Controllers\Api\PatientController::class, "tarkhis"]);
        Route::patch("dead", [\App\Http\Controllers\Api\PatientController::class, "dead"]);

    });

    Route::group(["as" => "drp", "prefix" => "drp"], function () {
        Route::get("/", [\App\Http\Controllers\Api\DrpReportController::class, "index"]);
        Route::delete("delete", [\App\Http\Controllers\Api\DrpReportController::class, "delete"]);
        Route::post("insert", [\App\Http\Controllers\Api\DrpReportController::class, "insert"]);
        Route::patch("update", [\App\Http\Controllers\Api\DrpReportController::class, "update"]);
    });

    Route::group(["as" => "calcs", "prefix" => "calcs"], function () {
        Route::get("crcl_history", [\App\Http\Controllers\Api\CalcsHistoryController::class, "crcl_history"]);
        Route::get("egfr_mdrd_history", [\App\Http\Controllers\Api\CalcsHistoryController::class, "egfr_mdrd_history"]);
        Route::get("egfr_ckd_epi_history", [\App\Http\Controllers\Api\CalcsHistoryController::class, "egfr_ckd_epi_history"]);
        Route::get("child_pough_score_history", [\App\Http\Controllers\Api\CalcsHistoryController::class, "child_pough_score_history"]);
        Route::post("crcl_calc", [\App\Http\Controllers\Api\CalcsHistoryController::class, "crcl_calc"]);
        Route::post("egfr_mdrd_calc", [\App\Http\Controllers\Api\CalcsHistoryController::class, "egfr_mdrd_calc"]);
        Route::post("egfr_ckd_epi_calc", [\App\Http\Controllers\Api\CalcsHistoryController::class, "egfr_ckd_epi_calc"]);
        Route::post("child_pough_score_calc", [\App\Http\Controllers\Api\CalcsHistoryController::class, "child_pough_score_calc"]);
    });

    Route::get("add_special_conditions", [\App\Http\Controllers\Api\PatientSpecialConditionController::class, "insert"]);
    Route::delete("delete_special_conditions", [\App\Http\Controllers\Api\PatientSpecialConditionController::class, "delete"]);
    Route::patch("update_special_conditions", [\App\Http\Controllers\Api\PatientSpecialConditionController::class, "update"]);

    Route::get("add_patient_drug", [\App\Http\Controllers\Api\PatientDrugController::class, "insert"]);
    Route::delete("delete_special_conditions", [\App\Http\Controllers\Api\PatientDrugController::class, "delete"]);
    Route::patch("update_special_conditions", [\App\Http\Controllers\Api\PatientDrugController::class, "update"]);

    Route::get("drugs/search", [\App\Http\Controllers\Api\DrugController::class, "search"]);
    Route::get("dashboard", [\App\Http\Controllers\Api\DashboardController::class, "index"]);
    Route::patch("update", [\App\Http\Controllers\Api\UserController::class, "index"]);
    Route::post("change_pwd", [\App\Http\Controllers\Api\UserController::class, "changePwd"]);


});

Route::get("test", function () {
    \App\Classes\sms\Sms::send("09194961416", "Salam");
});
