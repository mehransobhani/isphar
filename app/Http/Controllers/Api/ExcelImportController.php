<?php

namespace App\Http\Controllers;

use App\Imports\ExcelImport;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImportController extends Controller
{
    //
    private $keys = [
        "fullname",
        "national_code",
        "birth_date",
        "gender",
        "admission_date",
        "file_number",
        "room_name",
        "room_number",
        "bed_number",
        "doctor",
        "cause",
        "source",
        "source_number",
        "description",
    ];


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);
        try {
            DB::beginTransaction();
            $file = $request->file('file');
            $arrays = Excel::toArray(new ExcelImport, $file);
            $arrays = $arrays[0];
            foreach ($arrays as $array) {
                if($arrays[0] == $array)
                    continue;
                $collection = [];
                foreach ($array as $key => $value) {
                    $collection[$this->keys[$key]] = $value;
                    $collection["created_date"] = createdAt();
                }
                Patient::create($collection);
            }
            DB::commit();
            return $this->apiResponse("Completed");
        } catch (\Throwable $exception) {
            DB::rollBack();
            return $this->apiResponse("Error", 500);
        }
    }
}
