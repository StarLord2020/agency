<?php

namespace App\Http\Controllers\Statistic;

use App\Http\Controllers\Controller;
use App\Http\Statistic\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ChartController extends Controller
{
    public function index()
    {
        $todayDate = date("Y-m-d");
        $topSpecialtyBids=(new Chart())->topSpecialtiesBid($todayDate);
        $topSpecialtiesResumes=(new Chart())->topSpecialtiesResume($todayDate);
        return view('manager.statisctic',compact('topSpecialtyBids','topSpecialtiesResumes'));
    }
    public function getStatistic($id)
    {

        return response((new Chart())->getStatistic($id),200);
    }
    public function getStatisticSalaryForSpecialty($id)
    {

        return response((new Chart())->getStatisticSalaryForSpecialty($id),200);

    }
}
