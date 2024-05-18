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

}
