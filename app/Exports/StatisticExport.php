<?php

namespace App\Exports;

use App\Http\Statistic\Chart;
use App\Models\Bid;
use App\Models\User;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StatisticExport implements FromView
{
    public function view(): View
    {
        $todayDate = date("Y-m-d");
        return view('manager.exports.statistic', [
            'statistics' => (new Chart())->specialtiesForBid($todayDate),
            'statisticsResumes' => (new Chart())->specialtiesForResume($todayDate),
            'realizationBids' => (new Chart())->getStatisticsForSpecialties()

        ]);
    }
}
