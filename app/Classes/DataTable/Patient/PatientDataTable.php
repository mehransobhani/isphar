<?php

namespace App\Classes\DataTable\Patient;

use App\Classes\DataTable\DataTableInterface;
use App\Models\Patient;
use Yajra\DataTables\DataTables;

class PatientDataTable implements  DataTableInterface
{
    public function build()
    {
        $model = Patient::with("PatientSpecialCondition")->with("patientDrug")->get();

        return DataTables::of($model)
            ->editColumn('edit', function ($data) {
                return "<a class='btn btn-danger waves-effect waves-light' href='" . route('patient.edit', $data->id) . "'>ویرایش</a>";
            })
            ->editColumn('PatientSpecialCondition', function ($data) {
                $check = $data->PatientSpecialCondition;
                return $check ? "بله" : "خیر";
            })
            ->editColumn('patientDrug', function ($data) {
                $check = $data->patientDrug;
                return $check ? "بله" : "خیر";
            })
            ->editColumn('PatientSpecialConditionView', function ($data) {
                $check = $data->PatientSpecialCondition;

                if ($check)
                    return "<a class='btn btn-danger waves-effect waves-light' href='" . route('PatientSpecialCondition.view', $data->PatientSpecialCondition->id) . "'>مشاهده شرایط خاص بیمار</a>";
                else
                    return "";
            })  ->editColumn('patientDrugView', function ($data) {
                $check = $data->patientDrug;

                if ($check)
                    return "<a class='btn btn-danger waves-effect waves-light' href='" . route('patient_drug.view', $data->id) . "'>مشاهده تلفیق دارویی بیمار</a>";
                else
                    return "";
            })
            ->rawColumns(['edit', 'PatientSpecialConditionView' , 'patientDrugView'])
            ->make(true);

    }
}
