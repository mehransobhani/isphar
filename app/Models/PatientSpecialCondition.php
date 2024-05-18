<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientSpecialCondition extends Model
{
    use HasFactory;
    protected $guarded=["id"];
    public $timestamps=false;

    public function Patient()
    {
     return $this->belongsTo(Patient::class);
    }

}
