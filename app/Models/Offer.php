<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Offer extends Model
{
    public function getOffers($resume_id) {

            return DB::table('offers')
                ->where('resume_id',$resume_id)
                ->get();
    }

    public function getOfferById($id) {

        return DB::table('offers')
            ->where('id',$id)
            ->first();
    }

    public function dbDelete($id) {
        DB::table('offers')
            ->where('id',$id)
            ->delete();
    }

}
