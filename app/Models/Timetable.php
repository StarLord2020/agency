<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Timetable extends Model
{

    protected $fillable = ['lesson','subject_user_id','grade_id','classroom_id','day','description','semester','created_at','updated_at'];

    public function prepareForStudent($grade_id,$semester) {

       $timetable = DB::table('timetables')
           ->join('subject_user','subject_user.id',"=",'timetables.subject_user_id')
           ->join('users','users.id',"=",'subject_user.user_id')
           ->join('classrooms','classrooms.id','=','timetables.classroom_id')
           ->join('subjects','subjects.id','=','subject_user.subject_id')
           ->where('timetables.grade_id',$grade_id)
           ->where('timetables.semester',$semester)
           ->orderBy('timetables.lesson')
           ->get(['users.name',
               'users.surname',
               'users.patronymic',
               'classrooms.name as classroom',
               'subjects.name as subject',
               'timetables.lesson',
               'timetables.day'
               ]);

       return $this->groupForStudent($timetable->groupBy('day')->toArray());
    }

    public function groupForStudent($timetable){
        $result=[];

        $lessonsForDays['Понедельник']=[];
        $lessonsForDays['Вторник']=[];
        $lessonsForDays['Среда']=[];
        $lessonsForDays['Четверг']=[];
        $lessonsForDays['Пятница']=[];
        $lessonsForDays['Суббота']=[];
        foreach ($timetable as $day) {
            $j=0;
            for ($i = 0; $i <= 7; $i++) {

                if ( $day[$i-$j]??"") {

                    if ($day[$i-$j]->lesson == $i+1) {

                        array_push($lessonsForDays[$day[$i-$j]->day], $day[$i-$j]);
                    }
                    else {
                        array_push($lessonsForDays[$day[$i-$j]->day] , null);
                        $j++;
                    }
                }
                else
                {
                    break;
                }
            }
        }
        for ($i=0;$i<=7;$i++)
        {
            $lessons=[
                'lesson'=>['Lesson'=>$i+1],
                "monday"=>$lessonsForDays['Понедельник'][$i]??' ',
                "tuesday"=>$lessonsForDays['Вторник'][$i]??' ',
                "wednesday"=>$lessonsForDays['Среда'][$i]??' ',
                "thursday"=>$lessonsForDays['Четверг'][$i]??' ',
                "friday"=>$lessonsForDays['Пятница'][$i]??' ',
                "saturday"=>$lessonsForDays['Суббота'][$i]??' ',
            ];
            array_push($result,$lessons);
        }
        return ['response'=>'OK','timetable'=>$result];
    }

    public function show($grade,$semester)
    {
        return DB::table('timetables')
            ->leftJoin ('subject_user','timetables.subject_user_id','=','subject_user.id')
            ->leftJoin('grades','timetables.grade_id','=','grades.id')
            ->leftJoin('subjects','subject_user.subject_id','=','subjects.id')
            ->leftJoin('users','subject_user.user_id','=','users.id')
            ->leftJoin('classrooms','timetables.classroom_id','=','classrooms.id')
            ->where('timetables.grade_id','=',$grade)
            ->where('timetables.semester','=',$semester)
            ->select('timetables.day',
                            'timetables.semester',
                            'timetables.lesson',
                            'grades.name as grade',
                            'classrooms.name as classroom',
                            'subject_user.id as subject_user_id',
                            'users.name',
                            'users.id as user_id',
                            'users.surname',
                            'users.patronymic',
                            'subjects.name as subject',
                            'timetables.id')
            ->get();
    }
    public function getInfoForLesson($id)
    {
        return DB::table('subject_user')
            ->join('subjects','subject_user.subject_id','=','subjects.id')
            ->join('users','subject_user.user_id','=','users.id')
            ->where('subject_user.id',$id)
            ->select(   'subject_user.id',
                                'users.name as name',
                                'users.surname as surname',
                                'users.patronymic as patronymic',
                                'subjects.id as subject_id',
                                'users.id as users_id',
                                'subjects.name as subject')
            ->get();
    }
    public function timetableFormation($grade,$semester)
    {
        $dbTimetableData=$this->show($grade,$semester);

        $timetable=[];
         $Sorted = $dbTimetableData->sortBy('lesson')->groupBy('day')->toArray();
                 $lessonsForDays['Понедельник']=[];
                $lessonsForDays['Вторник']=[];
                 $lessonsForDays['Среда']=[];
                $lessonsForDays['Четверг']=[];
                $lessonsForDays['Пятница']=[];
                $lessonsForDays['Суббота']=[];
                foreach ($Sorted as $day) {
                    $j=0;
                    for ($i = 0; $i <= 7; $i++) {

                        if ( $day[$i-$j]??"") {

                            if ($day[$i-$j]->lesson == $i+1) {

                                array_push($lessonsForDays[$day[$i-$j]->day], $day[$i-$j]);
                            }
                            else {
                                 array_push($lessonsForDays[$day[$i-$j]->day] , null);
                                $j++;
                            }
                        }
                        else
                        {
                            break;
                        }
                    }
                }
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
        return $timetable;

        }
    public function getTeachers()
    {
        return DB::table('subject_user')
            ->join('subjects','subject_user.subject_id','=','subjects.id')
            ->join('users','subject_user.user_id','=','users.id')

              ->get(['users.id as user_id',
                'subject_user.id',
                'users.name as name',
                 'users.surname as surname',
                 'users.patronymic as patronymic',
                'subjects.id as subject_id',
                'subjects.name as subject']);
    }
    public function checkTeacher($record){

        $check = DB::table('timetables')
            ->where('day',$record['day'])
            ->where('lesson',$record['lesson'])
            ->where('subject_user_id',$record['subject_user_id'])
            ->where('subject_user_id','<>',null)
            ->where('semester',$record['semester'])->first();
            if($check){
                return 'Duplicate';
            }
             return false;
    }
    public function checkClassroom($record)
    {
        $check = DB::table('timetables')
            ->where('day',$record['day'])
            ->where('classroom_id',$record['classroom_id'])
            ->where('classroom_id','<>',null)
            ->where('lesson',$record['lesson'])->first();
            if ($check)
            {
                return "Duplicate";
            }
            return false;
    }
    public function checkTeacherUpdate($record,$id){

        $check = DB::table('timetables')
            ->where('day',$record['day'])
            ->where('lesson',$record['lesson'])
            ->where('subject_user_id',$record['subject_user_id'])
            ->where('id','<>',$id)
            ->where('semester',$record['semester'])->first();
        if($check){
            return 'Duplicate';
        }
        return false;
    }
    public function checkClassroomUpdate($record,$id)
    {
        $check = DB::table('timetables')
            ->where('day',$record['day'])
            ->where('classroom_id',$record['classroom_id'])
            ->where('id','<>',$id)
            ->where('lesson',$record['lesson'])->first();
        if ($check)
        {
            return "Duplicate";
        }
        return false;
    }
    public function checkLesson($lesson)
    {
        $check = DB::table('timetables')
            ->where('day',$lesson['day'])
            ->where('lesson',$lesson['lesson'])
            ->where('grade_id',$lesson['grade_id'])
            ->where('semester',$lesson['semester'])->first();
        if($check){
            return 'isset';
        }
        return false;
    }
    public function getSubjects()
    {
        return DB::table('subjects')
            ->select('id','name');
    }
    public function getGrades()
    {
        return DB::table('grades')
            ->select('id','name');
    }
    public function  getClassrooms()
    {
        return DB::table('classrooms')
            ->select('id','name');
    }
    public function UpdateTimetable($request,$id)
    {
        $response['duplicateTeacher']=[];
        $response['duplicateClassroom']=[];
        $response['result']='';
        $duplicateTeacher=$this->checkTeacherUpdate($request,$id);
        $duplicateClassroom=$this->checkClassroomUpdate($request,$id);
        if (!$duplicateTeacher && !$duplicateClassroom) {

        }
        else {
            $response['duplicateTeacher']['lesson'.$request['lesson']]=$duplicateTeacher;
            $response['duplicateClassroom']['lesson'.$request['lesson']]=$duplicateClassroom;
        }

        if (!count($response['duplicateTeacher'])||!count($response['duplicateClassroom'])) {
            $response['result']='OK';
            DB::table('timetables')
                ->where('id', $id)
                ->update(['subject_user_id' => $request->subject_user_id,'classroom_id' => $request->classroom_id]);
        }
        return $response;
    }
    public function addLesson($request)
    {
        $result=[];
        $id='';
        $response['duplicateTeacher']=[];
        $response['duplicateClassroom']=[];
        $response['result']='';
            $duplicateTeacher=$this->checkTeacher($request);
            $duplicateClassroom=$this->checkClassroom($request);
            if (!$duplicateTeacher && !$duplicateClassroom) {
            }
            else {
                $response['duplicateTeacher']['lesson' . $request['lesson']] = $duplicateTeacher;
                $response['duplicateClassroom']['lesson' . $request['lesson']] = $duplicateClassroom;
            }
        if (!count($response['duplicateTeacher'])&&!count($response['duplicateClassroom'])) {
            $item=Timetable::create($request);
             $id=$item->id;
            $response['result']='OK';
        }
        return [$response,$id];
    }
    public function  addTimeTable($request)
    {
        $result=[];
        $response['duplicateTeacher']=[];
        $response['duplicateClassroom']=[];
        $response['result']='';
        foreach ($request as $item) {
            $duplicateTeacher=$this->checkTeacher($item);
            $isset=$this->checkLesson($item);
            $duplicateClassroom=$this->checkClassroom($item);
            if (!$duplicateTeacher && !$duplicateClassroom &&!$isset) {
                $item['created_at'] = date('Y-m-d H:i:s');
                $item['updated_at'] = date('Y-m-d H:i:s');
                array_push($result, $item);
            }
            else {
                $response['duplicateTeacher']['lesson'.$item['lesson']]=$duplicateTeacher;
                $response['duplicateClassroom']['lesson'.$item['lesson']]=$duplicateClassroom;
                if ($isset)
                {
                    $response['result']='isset';
                }
            }
        }
        if (!count($response['duplicateTeacher'])&&!count($response['duplicateClassroom'])) {
            DB::table('timetables')->insert($result);
            $response['result']='OK';
        }
        return $response;
    }
}
