<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subject extends Model
{
    protected $fillable = [
        'name'
    ];

    public function  prepareFromCreate($subject)
    {
        if($this->uniqueName($subject['name'])){

           Subject::create(['name'=>$subject['name']]);

           return ['response'=>'created'];
        }

        return ['response' => 'duplicate'];
    }

    public function uniqueName($name)
    {
        $check = Subject::where('name',$name)->first();

        if($check){

            return false;
        }

        return true;
    }

    public function getSubjects()
    {
        return DB::table('subjects');
    }

    public function getSubjectsForHomework($id)
    {
        return DB::table('subjects')
            ->join('subject_user','subject_user.subject_id','=','subjects.id')
            ->join('homeworks','homeworks.subject_user_id','=','subject_user.id')
            ->where('homeworks.grade_id',$id)
            ->groupBy('subjects.name','subjects.id')
            ->select('subjects.name','subjects.id')
            ->get(['subjects.name','subjects.id']);
    }

}
