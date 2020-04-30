<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Specialty extends Model
{
    public function getSpecialty() {

        return DB::table('specialties')->get(['id','name']);
    }
}
