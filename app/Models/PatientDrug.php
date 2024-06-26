<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDrug extends Model
{
    use HasFactory;
    protected $guarded=["id"];
    public $timestamps=false;
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }
}
