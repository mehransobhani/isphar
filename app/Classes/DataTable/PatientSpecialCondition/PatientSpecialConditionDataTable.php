<?php

namespace App\Classes\DataTable\PatientSpecialCondition;

use App\Classes\DataTable\DataTableInterface;
use App\Models\PatientSpecialCondition;
use Yajra\DataTables\DataTables;

class PatientSpecialConditionDataTable implements  DataTableInterface
{

    public function build()
    {
        $model = PatientSpecialCondition::query()->with("patient")->with("user");
        return DataTables::of($model)
            ->addColumn('edit', function ($data) {
                return "<a class='btn btn-danger waves-effect waves-light' href='" . route('PatientSpecialCondition.edit', $data->id) . "'>ویرایش</a>";
            })
             ->editColumn('naresayi_koliavi', function ($data) {
                return $data->naresayi_koliavi?"بله":"خیر";
             })    ->editColumn('masrafe_sigar', function ($data) {
                return $data->masrafe_sigar?"بله":"خیر";
             })    ->editColumn('kambode_g6pd', function ($data) {
                return $data->kambode_g6pd?"بله":"خیر";
             })    ->editColumn('naresayi_kabedi', function ($data) {
                return $data->naresayi_kabedi?"بله":"خیر";
             })    ->editColumn('radiology', function ($data) {
                return $data->radiology?"بله":"خیر";
             })    ->editColumn('masrafe_alcol', function ($data) {
                return $data->masrafe_alcol?"بله":"خیر";
             }) ->editColumn('hasasiate_daruyi', function ($data) {
                return $data->hasasiate_daruyi?"بله":"خیر";
             }) ->editColumn('soe_masrafe_mavad', function ($data) {
                return $data->soe_masrafe_mavad?"بله":"خیر";
             }) ->editColumn('bardari', function ($data) {
                return $data->bardari?"بله":"خیر";
             }) ->editColumn('shirdehi', function ($data) {
                return $data->shirdehi?"بله":"خیر";
             }) ->editColumn('anti_biotic', function ($data) {
                return $data->anti_biotic?"بله":"خیر";
             }) ->editColumn('vaksan', function ($data) {
                return $data->vaksan?"بله":"خیر";
             })
            ->rawColumns(['edit'])

            ->make(true);
    }
}
