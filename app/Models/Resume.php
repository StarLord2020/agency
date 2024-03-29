<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Resume extends Model
{
    protected $fillable = ['education','skills','specialty_id','experience','user_id','status_id','publication_date'];

    public function  prepareForCreate($resume){
        Resume::create($resume);

        return ['response'=>'created'];
    }

    public function  getAllResumes()
    {
        return DB::table('resumes')
            ->join('statuses','resumes.status_id','=','statuses.id')
            ->join('users','resumes.user_id','=','users.id')
            ->join('specialties','resumes.specialty_id','=','specialties.id')
            ->where('resumes.status_id','1')
            ->get(['resumes.id as id',
                'users.fio as fio',
                'users.email',
                'resumes.education',
                'resumes.skills',
                'resumes.experience',
                'specialties.name as specialty',
                'statuses.name'
            ]);
    }
    public function  getAllResumesForEmployer()
    {
        return DB::table('resumes')
            ->join('statuses','resumes.status_id','=','statuses.id')
            ->join('users','resumes.user_id','=','users.id')
            ->join('specialties','resumes.specialty_id','=','specialties.id')
            ->where('resumes.status_id','2')
            ->get(['resumes.id as id',
                'users.fio as fio',
                'users.address',
                'users.email',
                'resumes.education',
                'resumes.skills',
                'resumes.experience',
                'specialties.name as specialty',
                'statuses.name'
            ]);
    }
    public function  getResumeById($id)
    {
        return DB::table('resumes')
            ->join('statuses','resumes.status_id','=','statuses.id')
            ->join('users','resumes.user_id','=','users.id')
            ->join('specialties','resumes.specialty_id','=','specialties.id')
            ->where('resumes.id',$id)
            ->first(['resumes.id as id',
                'users.fio as fio',
                'users.email',
                'users.address',
                'resumes.education',
                'resumes.skills',
                'resumes.experience',
                'specialties.name as specialty',
                'statuses.name'
            ]);
    }
    public function getResumesByUser() {

        return DB::table('resumes')
            ->join('statuses','resumes.status_id','=','statuses.id')
            ->join('specialties','specialties.id','=','resumes.specialty_id')
            ->where('resumes.user_id',auth()->user()->id)
            ->get(['resumes.id','specialties.name','resumes.education','resumes.skills','resumes.experience','statuses.name as status']);
    }
    public function getPublicResumesByUser() {

        return DB::table('resumes')
            ->join('statuses','resumes.status_id','=','statuses.id')
            ->join('specialties','specialties.id','=','resumes.specialty_id')
            ->where('resumes.user_id',auth()->user()->id)
            ->where('statuses.id',2)
            ->get(['resumes.id','specialties.name','resumes.education','resumes.skills','resumes.experience','statuses.name as status']);
    }

}
