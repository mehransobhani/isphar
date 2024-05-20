<?php

namespace App\Http\Controllers;

use App\Classes\DataTable\DataTableInterface;
use App\Http\Requests\DrugRequest;
use App\Models\Drug;

class DrugController extends Controller
{
    private DataTableInterface $dataTable;

    public function __construct(DataTableInterface $dataTable)
    {
        $this->dataTable = $dataTable;
    }

    public function edit($id)
    {
        $model = Drug::find($id);
        return view("admin.drug.edit", compact("model" ));
    }

    public function index()
    {
        return view("admin.drug.index");
    }

    public function create()
    {
        return view("admin.drug.create" );
    }

    public function update(DrugRequest $request, $id)
    {
        Drug::where("id", $id)->update($request->update());
        return back()->with('success', 'دارو با موفقیت ویرایش شد.');
    }

    public function store(DrugRequest $request)
    {
        Drug::create($request->store());
        return back()->with('success', 'دارو با موفقیت ثبت شد.');
    }

    public function dataTable()
    {
        return $this->dataTable->build();
    }
}
