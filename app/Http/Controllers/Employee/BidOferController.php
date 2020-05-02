<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\BidOffer;
use Illuminate\Http\Request;

class BidOferController extends Controller
{
    public function addResume($bid_id)
    {
        return (new BidOffer())->add($bid_id);
    }
}
