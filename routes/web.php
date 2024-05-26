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
Route::group(['middleware' => 'auth:admin'], function () {
//Route::group([ ], function () {
    Route::get("logout", [\App\Http\Controllers\AuthController::class, "logout"])->name("logout");

    Route::resource("patient", \App\Http\Controllers\PatientController::class)->except("destroy", "show");
    Route::get("patient/dataTable", [\App\Http\Controllers\PatientController::class, "dataTable"])->name("patient.dataTable");

    Route::resource("user", \App\Http\Controllers\UserController::class)->except(["destroy", "show"]);
    Route::get("user/dataTable", [\App\Http\Controllers\UserController::class, "dataTable"])->name("user.dataTable");

    Route::resource("PatientSpecialCondition", \App\Http\Controllers\PatientSpecialConditionController::class)->except(["destroy", "show"]);
    Route::get("PatientSpecialCondition/view/{patientId}", [\App\Http\Controllers\PatientSpecialConditionController::class, "view"])->name("PatientSpecialCondition.view");
    Route::get("PatientSpecialCondition/dataTable", [\App\Http\Controllers\PatientSpecialConditionController::class, "dataTable"])->name("PatientSpecialCondition.dataTable");

    Route::resource("patient_drug", \App\Http\Controllers\PatientDrugController::class)->except(["destroy", "show"]);
    Route::get("patient_drug/view/{patientId}", [\App\Http\Controllers\PatientDrugController::class, "view"])->name("patient_drug.view");
    Route::get("patient_drug/dataTable", [\App\Http\Controllers\PatientDrugController::class, "dataTable"])->name("patient_drug.dataTable");

    Route::resource("drp-report", \App\Http\Controllers\DrpReportController::class)->except(["destroy", "show"]);
    Route::get("drp-report/dataTable", [\App\Http\Controllers\DrpReportController::class, "dataTable"])->name("drp-report.dataTable");

    Route::resource("drug", \App\Http\Controllers\DrugController::class)->except(["destroy", "show"]);
    Route::get("drug/dataTable", [\App\Http\Controllers\DrugController::class, "dataTable"])->name("drug.dataTable");
    Route::get("drug/delete/{id}", [\App\Http\Controllers\DrugController::class, "delete"])->name("drug.delete");

    Route::resource("content", \App\Http\Controllers\ContentController::class)->except(["destroy", "show", "create", "store"]);
    Route::get("content/dataTable", [\App\Http\Controllers\ContentController::class, "dataTable"])->name("content.dataTable");

    Route::resource("demoRequest", \App\Http\Controllers\DemoRequestController::class)->except(["destroy", "update","edit", "show", "create", "store"]);
    Route::get("demoRequest/dataTable", [\App\Http\Controllers\DemoRequestController::class, "dataTable"])->name("demoRequest.dataTable");
    Route::get("demoRequest/delete/{id}", [\App\Http\Controllers\DemoRequestController::class, "delete"])->name("demoRequest.delete");


    Route::resource("post_cat", \App\Http\Controllers\PostCatController::class)->except(["destroy","show"]);
    Route::get("post_cat/dataTable", [\App\Http\Controllers\PostCatController::class, "dataTable"])->name("post_cat.dataTable");
    Route::get("post_cat/delete/{id}", [\App\Http\Controllers\PostCatController::class, "delete"])->name("post_cat.delete");

    Route::resource("post", \App\Http\Controllers\PostController::class)->except(["destroy","show"]);
    Route::get("post/dataTable", [\App\Http\Controllers\PostController::class, "dataTable"])->name("post.dataTable");
    Route::get("post/delete/{id}", [\App\Http\Controllers\PostController::class, "delete"])->name("post.delete");

    Route::get("profile", [\App\Http\Controllers\AuthController::class, "profile"])->name("profile");
    Route::patch("profile/update", [\App\Http\Controllers\AuthController::class, "updateProfile"])->name("profile.update");
    Route::get("profile/edit-password", [\App\Http\Controllers\AuthController::class, "editPassword"])->name("profile.editPassword");
    Route::patch("profile/update-password", [\App\Http\Controllers\AuthController::class, "updatePassword"])->name("profile.updatePassword");


});


Route::get("login", [\App\Http\Controllers\AuthController::class, "form"])->name("login");
Route::post("login", [\App\Http\Controllers\AuthController::class, "login"])->name("login");
