<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bid extends Model
{
    protected $fillable = [
        'company', 'description', 'position','address','salary','user_id','status_id','publication_date'
    ];

    public function  getUserBid($id)
    {
        return DB::table('bids')
            ->join('statuses','bids.status_id','=','statuses.id')
            ->where('bids.user_id',$id)
            ->get(['bids.id',
                    'bids.company',
                    'bids.description',
                    'bids.position',
                    'bids.address',
                    'bids.salary',
                    'statuses.name'
                ]);
    }
}
