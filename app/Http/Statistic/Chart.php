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
                    ->whereBetween('bids.publication_date',array($start_date, $today))
                     ->where('bids.status_id','2')
                    ->groupBy('specialties.name')
                    ->orderBy('total','desc')
                    ->limit(3)
                    ->get();
                $statisticSpecialtyForWeek['date']=$start_date->format('Y-m-d').'/'.$today;

                return $statisticSpecialtyForWeek;
    }
    public function topSpecialtiesResume($today)
    {
        $start_date = clone(new Carbon($today))->addDays(-30);
        $statisticSpecialtyForWeek= DB::table('resumes')
            ->select('specialties.name', DB::raw('count(resumes.id) as total'))
            ->join('specialties','resumes.specialty_id','=','specialties.id')
            ->whereBetween('resumes.publication_date',array($start_date, $today))
            ->where('resumes.status_id','2')
            ->groupBy('specialties.name')
            ->orderBy('total','desc')
            ->limit(3)
            ->get();
        $statisticSpecialtyForWeek['date']=$start_date->format('Y-m-d').'/'.$today;

        return $statisticSpecialtyForWeek;
    }

}
