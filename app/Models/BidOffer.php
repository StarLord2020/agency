<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BidOffer extends Model
{
    protected $fillable = ['bid_id','resume_id','user_id','status'];
    protected $table = 'bid_offers';
    public function add($bid_id,$resume_id)
    {
        if(!$this->unique($bid_id)){

            return ['response'=>'duplicated'];
        }
        $bidOffer['bid_id']=$bid_id;
        $bidOffer['user_id']=auth()->user()->id;
        $bidOffer['resume_id']=$resume_id;
        $bidOffer['status']='В рассмотрении';

        BidOffer::create($bidOffer);

        return ['response'=>'created'];
    }

    public function unique($bid_id){

        $res = DB::table('bid_offers')
            ->where('bid_id',$bid_id)
            ->where('user_id',auth()->user()->id)
            ->first();

        if(!$res) {

            return true;
        }

        return false;
    }
    public function getBidOffers($bid_id) {
        return DB::table('bid_offers')
            ->join('users','bid_offers.user_id','=','users.id')
            ->join('resumes','bid_offers.resume_id','=','resumes.id')
            ->join('specialties','resumes.specialty_id','=','specialties.id')
            ->where('bid_offers.bid_id',$bid_id)
            ->get(['users.fio as fio', 'users.address','users.email as contacts',
                'resumes.education','resumes.skills','resumes.experience',
                'specialties.name', 'bid_offers.status','bid_offers.id as id']
                );
    }
    public function getBidOfferById($id) {
        return DB::table('bid_offers')
            ->join('users','bid_offers.user_id','=','users.id')
            ->join('resumes','bid_offers.resume_id','=','resumes.id')
            ->join('specialties','resumes.specialty_id','=','specialties.id')
            ->where('bid_offers.id',$id)
            ->first(['users.fio as fio', 'users.address','users.email as contacts',
                    'resumes.education','resumes.skills','resumes.experience',
                    'specialties.name', 'bid_offers.status','bid_offers.id as id',
                    'bid_offers.bid_id']
            );
    }

    public function getAnswer() {
        return DB::table('bid_offers')
            ->join('users','bid_offers.user_id','=','users.id')
            ->join('bids','bid_offers.bid_id','=','bids.id')
            ->join('resumes','resumes.id','=','bid_offers.resume_id')
            ->join('specialties','resumes.specialty_id','=','specialties.id')
            ->where('bid_offers.user_id',auth()->user()->id)
            ->get(['bid_offers.id as id', 'bids.company','bids.description',
                'bids.position','bids.address','bids.salary','specialties.name as specialty',
                'bid_offers.status','users.email'
                ]
            );
    }

}
