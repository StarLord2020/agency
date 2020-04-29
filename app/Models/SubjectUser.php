<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubjectUser extends Model
{
    protected $table="subject_user";
    protected $fillable = [
        'subject_id','user_id'
    ];

    public function prepareForCreate($teacherAndSubject)
    {
        if($this->checkUnique($teacherAndSubject['user_id'],$teacherAndSubject['subject_id'])){

            SubjectUser::create(['user_id'=>$teacherAndSubject['user_id'],'subject_id'=>$teacherAndSubject['subject_id']]);

            return ['response' => 'created'];
        }

        return ['response' => 'duplicate'];
    }

    public function checkUnique($user_id,$subject_id){

        $check = SubjectUser::where('user_id',$user_id)->where('subject_id',$subject_id)->first();
        if($check)
        {

            return false;
        }

        return true;
    }

    public function getTeachers($subject_id)
    {
        return DB::table('subject_user')
            ->join('users','users.id','=','subject_user.user_id')
            ->join('subjects','subjects.id','=','subject_user.subject_id')
            ->where('subjects.id',$subject_id)
            ->get(['subject_user.id','users.surname','users.name','users.patronymic','subject_user.user_id']);
    }
}
