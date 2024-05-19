<?php

namespace App\Http\Controllers;

use App\Classes\DataTable\DataTableInterface;
use App\Models\DrpReport;
use Illuminate\Http\Request;

class DrpReportController extends Controller
{
    private DataTableInterface $dataTable;

    public function __construct(DataTableInterface $dataTable)
    {
        $this->dataTable = $dataTable;
    }
    public function edit($id)
    {
        $model=DrpReport::with("Patient")->find($id);
        return  view("admin.drpReport.edit",compact("model"));
    }
    public function index()
    {
        return view("admin.drpReport.index");
    }
    public function create()
    {
        return view("admin.drpReport.create");
    }

    public function update(Request $request ,$id)
    {
        $this->validate($request, [
            "id" => "required ",
            "egfr_mdrd" => "required",
            "user_id" => "required",
            "egfr_ckd_epi" => "required",
            "patient_id" => "required",
            "crcl" => "required",
            "child_pough_score" => "required",
            "source " => "required",
            "form" => "required",
        ]);

        DrpReport::where("id", $request->id)
            ->update([
                "egfr_mdrd" => $request->egfr_mdrd,
                "user_id" => $request->user_id,
                "egfr_ckd_epi" => $request->egfr_ckd_epi,
                "patient_id" => $request->patient_id,
                "crcl" => $request->crcl,
                "child_pough_score" => $request->child_pough_score,
                "source" => $request->source,
                "form" => $request->form,
                "status" => $request->status,
                "description" => $request->description,

            ]);
        return back()->with('success', 'تلفیق دارویی بیمار با موفقیت ویرایش شد.');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "egfr_mdrd" => "required",
            "user_id" => "required",
            "egfr_ckd_epi" => "required",
            "patient_id" => "required",
            "crcl" => "required",
            "child_pough_score" => "required",
            " source " => "required",
            "form" => "required",
        ]);
        DrpReport::create([
            "egfr_mdrd" => $request->egfr_mdrd,
            "user_id" => $request->user_id,
            "egfr_ckd_epi" => $request->egfr_ckd_epi,
            "patient_id" => $request->patient_id,
            "crcl" => $request->crcl,
            "child_pough_score" => $request->child_pough_score,
            "source" => $request->source,
            "form" => $request->form,
            "status" => $request->status,
            "description" => $request->description,
            "created_date" => date("Y-m-d H:i:s", time())
        ]);
        return back()->with('success', 'تلفیق دارویی بیمار با موفقیت ثبت شد.');


    }

    public function dataTable()
    {
        return $this->dataTable->build();

    }
}
