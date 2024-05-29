<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalcsHistory extends Model
{
    protected $table="calcs_history";
    use HasFactory;
    protected $guarded=["id"];
    public $timestamps=false;
}
