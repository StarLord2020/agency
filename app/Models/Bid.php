<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = [
        'company', 'description', 'position','address','salary','user_id','status_id','publication_date'
    ];
}
