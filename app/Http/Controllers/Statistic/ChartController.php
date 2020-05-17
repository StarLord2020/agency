<?php

namespace App\Http\Controllers\Statistic;

use App\Http\Controllers\Controller;
use App\Http\Statistic\Chart;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        $topSpecialtyBids=(new Chart())->topSpecialtiesBid();
        return view('index.index-bids',compact('myBids'));
    }
}
