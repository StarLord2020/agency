<?php


namespace App\Http\Statistic;


use Illuminate\Support\Facades\DB;

class Chart
{

    public function topSpecialtiesBid()
    {
        $res = DB::table('bids')
            ->select('specialties.name',count('specialty_id'))
            ->join('specialties','bids.specialty_id','=','specialties.id')
            ->groupBy('specialties.name')
            ->get();

    }

}
