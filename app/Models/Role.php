<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    public function getRole($id) {

        return DB::table('roles')
            ->where('id',$id)
            ->get('name');
    }
}
