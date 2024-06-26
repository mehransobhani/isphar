<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $guarded=["id"];
    public $timestamps=false;

    public function PatientSpecialCondition()
    {
        return $this->hasOne(PatientSpecialCondition::class,"patient_id","id");
    }
    public function patientDrug()
    {
        return $this->hasMany(PatientDrug::class,"patient_id","id")
        ;
    }
    public function patientHistory()
    {
        return $this->hasMany(PatientHistory::class,"patient_id","id");
    }
    public function drpReport()
    {
        return $this->hasMany(DrpReport::class,"patient_id","id");
    }

}
