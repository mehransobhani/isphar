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

Route::resource("patient",\App\Http\Controllers\PatientController::class)->except("destroy","show");
Route::get("patient/dataTable", [\App\Http\Controllers\PatientController::class, "dataTable"])->name("patient.dataTable");

Route::resource("user",\App\Http\Controllers\UserController::class)->except(["destroy","show"]);
Route::get("user/dataTable", [\App\Http\Controllers\UserController::class, "dataTable"])->name("user.dataTable");


Route::resource("PatientSpecialCondition",\App\Http\Controllers\PatientSpecialConditionController::class)->except(["destroy","show"]);
Route::get("PatientSpecialCondition/view/{patientId}", [\App\Http\Controllers\PatientSpecialConditionController::class, "view"])->name("PatientSpecialCondition.view");
Route::get("PatientSpecialCondition/dataTable", [\App\Http\Controllers\PatientSpecialConditionController::class, "dataTable"])->name("PatientSpecialCondition.dataTable");

Route::resource("patient_drug",\App\Http\Controllers\PatientDrugController::class)->except(["destroy","show"]);
Route::get("patient_drug/view/{patientId}", [\App\Http\Controllers\PatientDrugController::class, "view"])->name("patient_drug.view");
Route::get("patient_drug/dataTable", [\App\Http\Controllers\PatientDrugController::class, "dataTable"])->name("patient_drug.dataTable");

Route::resource("drp-report",\App\Http\Controllers\DrpReportController::class)->except(["destroy","show"]);
Route::get("drp-report/dataTable", [\App\Http\Controllers\DrpReportController::class, "dataTable"])->name("drp-report.dataTable");

Route::resource("drug",\App\Http\Controllers\DrugController::class)->except(["destroy","show"]);
Route::get("drug/dataTable", [\App\Http\Controllers\DrugController::class, "dataTable"])->name("drug.dataTable");

Route::resource("content",\App\Http\Controllers\ContentController::class)->except(["destroy","show","create","store"]);
Route::get("content/dataTable", [\App\Http\Controllers\ContentController::class, "dataTable"])->name("content.dataTable");

Route::group(['as' => 'DemoRequest.', 'prefix' => 'DemoRequest'], function () {
     Route::get("", [\App\Http\Controllers\DemoRequestController::class, "index"])->name("index");
    Route::get("dataTable", [\App\Http\Controllers\DemoRequestController::class, "dataTable"])->name("dataTable");
});
