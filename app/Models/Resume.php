<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Resume extends Model
{
    protected $fillable = ['education','skills','specialty_id','experience','user_id','status_id','publication_date'];

    public function  prepareForCreate($resume){

        if($this->unique($resume['user_id'])){

            Resume::create($resume);

            return ['response'=>'created'];
        }

        return ['response'=>'duplicated'];
    }
    public function unique($id){

        $res = DB::table('resumes')->where('user_id',$id)->first();

        if(!$res) {

            return true;
        }

       return false;
    }

    public function getResumeById($id) {

        return DB::table('resumes')
            ->join('specialties','specialties.id','=','resumes.specialty_id')
            ->where('user_id',$id)
            ->first();
    }
}
