<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Specialty extends Model
{
    protected $fillable = ['name'];

    public function unique($name){

        $res = DB::table('specialties')->where('name',$name)->first();

        if(!$res) {

            return true;
        }
        return false;
    }
    public function createSpecialty($specialty)
    {
       $checkUniqie=$this->unique($specialty);
       if (!$checkUniqie)
       {
           return ['response'=>'duplicate'];
       }
       else {
           Specialty::create($specialty);
           return ['response'=>'created'];
       }
    }
    public function updateSpecialty($name,$specialty)
    {

        $checkUniqie=$this->unique($name);
        if (!$checkUniqie)
        {
            return ['response'=>'duplicate'];
        }
        else {
            $specialty->update($name);
            return ['response'=>'updated'];
        }
    }
    public function getSpecialties() {

        return DB::table('specialties')->get(['id','name']);
    }
    public function getSpecialty($id) {

        return DB::table('specialties')
            ->where('id',$id)
            ->get(['id','name']);
    }
}
