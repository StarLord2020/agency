<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BidOffer extends Model
{
    protected $fillable = ['fio','contacts','address','skills','specialty','experience','education','bid_id','resume_id','user_id'];
    protected $table = 'bid_offers';
    public function add($bid_id) {

        if(!$this->unique($bid_id)){

            return ['response'=>'duplicated'];
        }

        $user = Auth::user();
        $user_id = $user->id;
        $fio = $user->FIO;
        $email = $user->email;
        $address =  $user->address;
        $resume = DB::table('resumes')->where('user_id',$user_id)->first();
        if(!$resume) {

            return ['response'=>'noResume'];
        }
        $specialty = DB::table('specialties')->where('id',$resume->specialty_id)->first('name');
        $bidOffer['fio']=$fio;
        $bidOffer['contacts']=$email;
        $bidOffer['address']=$address;
        $bidOffer['skills']=$resume->skills;
        $bidOffer['specialty']=$specialty->name;
        $bidOffer['experience']=$resume->experience;
        $bidOffer['education']=$resume->education;
        $bidOffer['bid_id']=$bid_id;
        $bidOffer['user_id']=$user_id;
        $bidOffer['resume_id']=$resume->id;

        BidOffer::create($bidOffer);

        return ['response'=>'created'];
    }

    public function unique($bid_id){

        $res = DB::table('bid_offers')->where('bid_id',$bid_id)->first();

        if(!$res) {

            return true;
        }

        return false;
    }
    public function getBidOffers($bid_id) {
        return DB::table('bid_offers')
            ->join('users','bid_offers.user_id','=','users.id')
            ->join('specialties','bid_offers.specialty_id','=','specialties.id')
            ->join('resumes','bid_offers.resume_id','=','resumes.id')
            ->where('bid_id',$bid_id)
            ->get('users.fio as fio',
                'users.address as address',
                'users.number as contacts',
                ''
                );
    }
}
