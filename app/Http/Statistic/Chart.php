<?php


namespace App\Http\Statistic;


use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Chart
{

    public function topSpecialtiesBid($today)
    {
                $start_date = clone(new Carbon($today))->addDays(-30);
                 $statisticSpecialtyForWeek= DB::table('bids')
                    ->select('specialties.name', DB::raw('count(bids.id) as total'))
                    ->join('specialties','bids.specialty_id','=','specialties.id')
                    ->whereBetween('publication_date',array($start_date, $today))
                    ->groupBy('specialties.name')
                    ->orderBy('total','desc')
                    ->limit(3)
                    ->get();
                $statisticSpecialtyForWeek['date']=$start_date->format('Y-m-d').'/'.$today;

                return $statisticSpecialtyForWeek;
    }


}
