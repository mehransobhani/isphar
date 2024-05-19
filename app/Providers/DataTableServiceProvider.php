<?php

namespace App\Providers;

use App\Classes\DataTable\DataTableInterface;
use App\Classes\DataTable\DemoRequest\DemoRequestDataTable;
use App\Classes\DataTable\Patient\PatientDataTable;
use App\Classes\DataTable\PatientSpecialCondition\PatientSpecialConditionDataTable;
use App\Classes\DataTable\User\UserDataTable;
use App\Http\Controllers\DemoRequestController;
use App\Http\Controllers\PatientController;
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

    }
}
