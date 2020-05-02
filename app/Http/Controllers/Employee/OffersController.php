<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OffersController extends Controller
{
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
