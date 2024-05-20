<?php

namespace App\Providers;

use App\Classes\DataTable\DataTableInterface;
use App\Classes\DataTable\DemoRequest\DemoRequestDataTable;
use App\Classes\DataTable\DrpReport\DrpReportDataTable;
use App\Classes\DataTable\Drug\DrugDataTable;
use App\Classes\DataTable\Patient\PatientDataTable;
use App\Classes\DataTable\PatientDrug\PatientDrugDataTable;
use App\Classes\DataTable\PatientSpecialCondition\PatientSpecialConditionDataTable;
use App\Classes\DataTable\User\UserDataTable;
use App\Http\Controllers\DemoRequestController;
use App\Http\Controllers\DrpReportController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientDrugController;
use App\Http\Controllers\PatientSpecialConditionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\ServiceProvider;

class DataTableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->when(DemoRequestController::class)
            ->needs(DataTableInterface::class)
            ->give(DemoRequestDataTable::class);

        $this->app->when(UserController::class)
            ->needs(DataTableInterface::class)
            ->give(UserDataTable::class);

        $this->app->when(PatientController::class)
            ->needs(DataTableInterface::class)
            ->give(PatientDataTable::class);

        $this->app->when(PatientSpecialConditionController::class)
            ->needs(DataTableInterface::class)
            ->give(PatientSpecialConditionDataTable::class);

        $this->app->when(PatientDrugController::class)
            ->needs(DataTableInterface::class)
            ->give(PatientDrugDataTable::class);

        $this->app->when(DrpReportController::class)
            ->needs(DataTableInterface::class)
            ->give(DrpReportDataTable::class);

        $this->app->when(DrugController::class)
            ->needs(DataTableInterface::class)
            ->give(DrugDataTable::class);

    }
}
