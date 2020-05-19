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
    public function getStatistic($id)
    {
        $todayDate = date("Y-m-d");
        $start_date = clone(new Carbon($todayDate))->addDays(-30);
         $published =DB::table('bids')
            ->select( DB::raw('count(bids.id) as total'))
            ->join('statuses','bids.status_id','=','statuses.id')
            ->whereBetween('bids.publication_date',array($start_date, $todayDate))
            ->where('bids.specialty_id',$id)
             ->where('bids.status_id',2)
            ->get();
         $accepted=DB::table('bid_offers')
             ->select( DB::raw('count(bid_offers.id) as total'))
             ->join('bids','bids.id','=','bid_offers.bid_id')
             ->where('bids.specialty_id',$id)
             ->where('bid_offers.status','Принято')
             ->get();

        $result=['success'=>$accepted[0]->total,'cancel'=>$published[0]->total-$accepted[0]->total,'date'=>$start_date->format('Y-m-d').'/'.$todayDate];
         return $result;
    }
    public function getStatisticSalaryForSpecialty($id)
    {
        $todayDate = date("Y-m-d");
        $start_date = clone(new Carbon($todayDate))->addDays(-30);
        $salaryAvg=DB::table('bids')
            ->whereBetween('bids.publication_date',array($start_date, $todayDate))
            ->where('bids.specialty_id',$id)
            ->where('bids.status_id','2')
            ->select(DB::raw('AVG(bids.salary) as salaryAvg'))
            ->first();
        $salaryMax=DB::table('bids')
            ->select('bids.salary')
            ->whereBetween('bids.publication_date',array($start_date, $todayDate))
            ->where('bids.specialty_id',$id)
            ->where('bids.status_id','2')
            ->orderBy('bids.salary', 'desc')->first();

        return ((['salaryAvg'=>round($salaryAvg->salaryAvg??0, 0),'salaryMax'=>round($salaryMax->salary??0,0),'date'=>$start_date->format('Y-m-d').'/'.$todayDate]));
    }
}
