<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OffersController extends Controller
{
    public function index($resume_id){

          $offers=(new Offer())->getOffers($resume_id);

          return view('employee.offers',compact('offers'));

    }

    public function changeStatus($id,Request $request)
    {
        DB::table('resume_offers')->where('id',$id)
            ->update($request->all());

        return response('ok',200);
    }

    public function show($id)
    {
        $offer = (new Offer())->getOfferById($id);

        return view('employee.watch-offer',compact('offer'));
    }

    public function delete($id)
    {
        (new Offer())->dbDelete($id);

        return ['response'=>'deleted'];
    }
}
