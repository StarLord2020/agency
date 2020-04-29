<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classroom extends Model
{
    //
    protected  $fillable = ['name'];

    public function grade()
    {
        return $this->hasOne(Grade::class);
    }

    public function noClassroom(){

        return DB::table('classrooms')
            ->leftJoin('grades','classrooms.id','=','grades.classroom_id')
            ->where('grades.classroom_id',null);;
    }

    public function prepareFromCreate($classroom)
    {
        if($this->uniqueName($classroom['name']))
        {
            Classroom::create($classroom);

            return ['response'=>'created'];
        }
        else {

            return ['response'=>'nameDuplicate'];
        }

    }

    public function uniqueName($name)
    {
        $check = Classroom::where('name',$name)->first();

        if($check){

            return false;
        }

        return true;
    }

    public function getAll()
    {
        return DB::table('classrooms');
    }
}
