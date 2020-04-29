<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Homework extends Model
{
    protected $fillable = ['subject_user_id','day','lesson','semester','grade_id','name','description','deadline'];

    public function getUser($id){

          return DB::table('subject_user')
            ->join('users','users.id',"=",'subject_user.user_id')
            ->join('subjects','subjects.id','=','subject_user.subject_id')
            ->where('subject_user.user_id','=',$id)
            ->get([
                'users.id',
                'subject_user.id as subject_user_id',
            ]);
    }
    public function getHomework($request)
    {
        $timetable=[];

        $begin=Carbon::parse($request['begin'])->format('Y-m-d');
        $end=Carbon::parse($request['end'])->format('Y-m-d');
        $dbTimetableData=(new Timetable())->show($request['grade_id'],$request['semester']);

        $homeworks=DB::table('homeworks')
        ->where('grade_id',$request['grade_id'])
        ->where('semester',$request['semester'])
        ->where('deadline','>=',$begin)
         ->where('deadline','<=',$end)
         ->get();

         $sortedTimetable=$dbTimetableData->sortBy('lesson')->groupBy('day')->toArray();

          $sortedHomeWork=$homeworks->sortBy('lesson')->groupBy('day')->toArray();
        $lessonsForDays['Понедельник']=[];
        $lessonsForDays['Вторник']=[];
        $lessonsForDays['Среда']=[];
        $lessonsForDays['Четверг']=[];
        $lessonsForDays['Пятница']=[];
        $lessonsForDays['Суббота']=[];

        foreach ($sortedTimetable as $day) {
            $j=0;
            $h=0;
            for ($i = 0; $i <= 7; $i++) {

                if ( $day[$i-$j]??"") {

                    if ($day[$i-$j]->lesson == $i+1) {
                        if (($sortedHomeWork[$day[$i - $j]->day][$i - $h]->description ?? '')&& $sortedHomeWork[$day[$i - $h]->day][$i - $h]->lesson==$i+1) {
                            $day[$i - $j]->description = $sortedHomeWork[$day[$i - $h]->day][$i - $h]->description;
                            $day[$i - $j]->nameHomeWork = $sortedHomeWork[$day[$i - $h]->day][$i - $h]->name ;
                            $day[$i - $j]->idHomeWork = $sortedHomeWork[$day[$i - $h]->day][$i - $h]->id;
                        }
                        else{

                            $day[$i - $j]->description =null;
                            $day[$i - $j]->nameHomeWork =null;
                            $day[$i - $j]->idHomeWork = null;
                            $h++;
                        }
                        array_push($lessonsForDays[$day[$i - $j]->day], $day[$i - $j]);
                    }
                    else {
                        array_push($lessonsForDays[$day[$i-$j]->day] , null);
                        $j++;
                        $h++;

                    }
                }
                else
                {

                }
            }
        }
        $lessonsForDays;
        for ($i=0;$i<=7;$i++)
        {
            $lessons=[
                'lesson'=>$i+1,
                "monday"=>$lessonsForDays['Понедельник'][$i]??' ',
                "tuesday"=>$lessonsForDays['Вторник'][$i]??' ',
                "wednesday"=>$lessonsForDays['Среда'][$i]??' ',
                "thursday"=>$lessonsForDays['Четверг'][$i]??' ',
                "friday"=>$lessonsForDays['Пятница'][$i]??' ',
                "saturday"=>$lessonsForDays['Суббота'][$i]??' ',
            ];
            array_push($timetable,$lessons);
        }
//        if(!$sortedHomeWork)
//        {
//            $timetable=null;
//            $timetable=
//        }
        return $timetable;

    }
    public function addHomeWork($request)
    {
        $id='';
        $request['deadline']=Carbon::parse($request['deadline'])->format('Y-m-d');

        $homework=Homework::create($request);
        $id=$homework->id;
        return ['OK',$id];
    }

    public function getHomeworkForSubject($subject_id)
    {   $grade_id = (new Grade())->getStudentGrade();

        $homeworks = DB::table('homeworks')
            ->join('subject_user','subject_user.id','=','homeworks.subject_user_id')
            ->join('users','users.id','=','subject_user.user_id')
            ->where('homeworks.grade_id',$grade_id[0]->id)
            ->where('subject_user.subject_id',$subject_id)
            ->get([
                'homeworks.name as homework',
                'homeworks.description',
                'homeworks.deadline',
                'homeworks.lesson',
                'users.name',
                'users.patronymic',
                'users.surname'
            ]);

        for($i=0;$i<count($homeworks);$i++){

            $homeworks[$i]->fullName = $homeworks[$i]->surname.' '.$homeworks[$i]->name." ".$homeworks[$i]->patronymic;
        }

        return $homeworks;
    }
}
