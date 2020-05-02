<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\Specialty;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function index()
    {
        $myBids=(new Bid())->getBids();
        $specialty = (new Specialty())->getSpecialty();

        return view('employee.search-for-bid',compact('myBids','specialty'));
    }


    public function watchBid($id)
    {
        $bid=(new Bid())->getBidById($id);

        return view('employee.watch-bid',compact('bid'));
    }
}
