<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Offer extends Model
{


    public function getOffers($resume_id) {
        return DB::table('resume_offers')
            ->join('users','users.id','=','resume_offers.user_id')
            ->join('specialties','specialties.id','=','resume_offers.specialty_id')
            ->where('resume_offers.resume_id',$resume_id)
            ->get(
                [   'users.FIO','users.email','users.address','specialties.name','resume_offers.id',
                    'resume_offers.position','resume_offers.company','resume_offers.salary',
                    'resume_offers.description','resume_offers.status',
                ]);
    }

    public function getOfferById($id) {

        return DB::table('resume_offers')
            ->join('users','users.id','=','resume_offers.user_id')
            ->join('specialties','specialties.id','=','resume_offers.specialty_id')
            ->where('resume_offers.id',$id)
            ->first( [   'users.FIO','users.email','users.address','specialties.name','resume_offers.id',
                'resume_offers.position','resume_offers.company','resume_offers.salary',
                'resume_offers.description','resume_offers.status','resume_offers.resume_id',
            ]);
    }

    public function dbDelete($id) {
        DB::table('resume_offers')
            ->where('id',$id)
            ->delete();
    }

}
