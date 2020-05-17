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
        return view('manager.statisctic',compact('topSpecialtyBids'));
    }
}
