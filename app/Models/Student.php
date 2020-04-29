<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    protected $fillable = ['grade_id','user_id'];

    public function getStudents($grade_id)
    {
        return DB::table('students')
            ->join('users','users.id','=','students.user_id')
            ->join('grades','grades.id','=','students.grade_id')
            ->where('grades.id',$grade_id)
            ->get(['students.id','users.surname','users.name','users.patronymic']);
    }


}
