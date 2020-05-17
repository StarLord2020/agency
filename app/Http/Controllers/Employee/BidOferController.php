<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\BidOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BidOferController extends Controller
{
    public function index()
    {
        $resumes=(new BidOffer())->getAnswer();

        return view('employee.send-resume-index',compact('resumes'));
    }

    public function addResume($bid_id,$resume_id)
    {
        return (new BidOffer())->add($bid_id,$resume_id);
    }

    public function delete($id){

        DB::table('bid_offers')
            ->where('id',$id)
            ->where('user_id',auth()->user()->id)
            ->delete();

        return response('ok',200);
    }
}
