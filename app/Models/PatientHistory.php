<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientHistory extends Model
{
    protected $table="patient_history";

    protected $guarded=["id"];
    public $timestamps=false;

    use HasFactory;
}
