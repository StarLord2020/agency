<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\BidOffer;
use App\Models\ResumeOffer;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BidOffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($bid_id)
    {
        $bidOffers=(new BidOffer())->getBidOffers($bid_id);

        return view('employer.bid-offers-list',compact('bidOffers'));
    }


    public function createOffer($resume_id)
    {
        $specialities = (new Specialty())->getSpecialties();

        return view('employer.create-offer',compact('specialities','resume_id'));
    }


    public function store(Request $request)
    {

        return (new ResumeOffer())->prepareForCreate($request);
    }

    public function show($offer_id)
    {
        $bidOffer=(new BidOffer())->getBidOfferById($offer_id);

        return view('employer.watch-bid-offer',compact('bidOffer'));
    }

    public function changeStatus($id,Request $request)
    {
        DB::table('bid_offers')->where('id',$id)
            ->update($request->all());

        return response('ok',200);
    }

    public function getAnswers()
    {
        $answers = (new ResumeOffer())->getBidAnswers();

        return view('employer.send-bid-index',compact('answers'));
    }

    public function delete($id){

        DB::table('resume_offers')
            ->where('id',$id)
            ->where('user_id',auth()->user()->id)
            ->delete();

        return response('ok',200);
    }
}
