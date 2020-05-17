<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ResumeOffer extends Model
{
    protected $table = 'resume_offers';
    protected $fillable =['user_id','resume_id','status','company','position','salary','description','specialty_id'];
    public function prepareForCreate($request){

        $bid=$request->all();
        if(!$this->unique($bid['resume_id'])){

            return ['response'=>'duplicated'];
        }
        $bid['user_id']= auth()->user()->id;
        $bid['status']='В рассмотрении';

        ResumeOffer::create($bid);

        return response('ok',200);
    }

    public function unique($resume_id){

        $res = DB::table('resume_offers')
            ->where('resume_id',$resume_id)
            ->where('user_id',auth()->user()->id)
            ->first();

        if(!$res) {

            return true;
        }

        return false;
    }

    public function getBidAnswers() {
        return DB::table('resume_offers')
            ->join('users','resume_offers.user_id','=','users.id')
            ->join('resumes','resume_offers.resume_id','=','resumes.id')
            ->join('specialties','resumes.specialty_id','=','specialties.id')
            ->where('users.id',auth()->user()->id)
            ->get(['users.fio as fio', 'users.address','users.email as contacts',
                    'resumes.education','resumes.skills','resumes.experience',
                    'specialties.name', 'resume_offers.status','resume_offers.id as id']
            );
    }
}
