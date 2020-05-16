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
    public function  getBids()
    {
        return DB::table('bids')
            ->join('statuses','bids.status_id','=','statuses.id')
            ->join('users','bids.user_id','=','users.id')
            ->join('specialties','bids.specialty_id','=','specialties.id')
            ->where('bids.status_id','2')
            ->get(['bids.id',
                'users.fio',
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
            ->join('users','bids.user_id','=','users.id')
            ->join('specialties','bids.specialty_id','=','specialties.id')
            ->where('bids.status_id','1')
            ->get(['bids.id',
                'users.fio',
                'bids.company',
                'bids.description',
                'bids.position',
                'bids.address',
                'bids.salary',
                'specialties.name as specialty',
                'statuses.name'
            ]);
    }
    public function  getBidById($id)
    {
        return DB::table('bids')
            ->join('users','bids.user_id','=','users.id')
            ->join('statuses','bids.status_id','=','statuses.id')
            ->join('specialties','bids.specialty_id','=','specialties.id')
            ->where('bids.id',$id)
            ->first(['bids.id',
                'users.fio',
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
