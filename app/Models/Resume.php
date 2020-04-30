<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = ['education','skills','specialty_id','experience','user_id','status_id','publication_date'];
}
