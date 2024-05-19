<?php

namespace App\Http\Controllers;

use App\Classes\DataTable\DataTableInterface;
use App\Classes\DataTable\DemoRequest\DemoRequestDataTable;

class DemoRequestController extends Controller
{
    private $dataTable;

    public function __construct(DataTableInterface $dataTable)
    {
        $this->dataTable = $dataTable;
    }
    public function index()
    {
        return view("admin.demoRequest.index");
    }

    public function dataTable()
    {
         return $this->dataTable->build();
    }
}
