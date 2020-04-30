<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bid extends Model
{
    protected $fillable = [
        'company', 'description', 'position','address','salary','user_id','status_id','publication_date','specialty_id'
    ];

    public function  getUserBid($id)
    {
        return DB::table('bids')
            ->join('statuses','bids.status_id','=','statuses.id')
            ->join('specialties','bids.specialty_id','=','specialties.id')
            ->where('bids.user_id',$id)
            ->get(['bids.id',
                    'bids.company',
                    'bids.description',
                    'bids.position',
                    'bids.address',
                    'bids.salary',
                     'specialties.name as specialty',
                    'statuses.name'
                ]);
    }
    public function  getAllBids()
    {
        return DB::table('bids')
            ->join('statuses','bids.status_id','=','statuses.id')
            ->join('specialties','bids.specialty_id','=','specialties.id')
            ->get(['bids.id',
                'bids.company',
                'bids.description',
                'bids.position',
                'bids.address',
                'bids.salary',
                'specialties.name as specialty',
                'statuses.name'
            ]);
    }
}
