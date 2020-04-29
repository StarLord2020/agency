<?php

namespace App\Http\Controllers\Admin\Teacher\HeadTeacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Timetable\IndexRequest;
use App\Http\Requests\Timetable\LessonRequest;
use App\Http\Requests\Timetable\UpdateRequest;
use App\Models\Subject;
use App\Models\Timetable;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests\Timetable\StoreRequest;
use mysql_xdevapi\Result;

class TimetableController extends Controller
{

    public function index($grade=null,$semester=null)
    {
        $initialParameters['grade']=$grade;
        $initialParameters['semester']=$semester;
        $teachersAndThemSubjects=collect(["teachers"=>(new Timetable())->getTeachers(),
            "subjects"=>(new Timetable())->getSubjects()->get(),
            "grades"=>(new Timetable())->getGrades()->get(),
            'classrooms'=>(new Timetable())->getClassrooms()->get()]);

        return view('admin.teacher.head-teacher.timetable.index',compact('teachersAndThemSubjects','initialParameters'));
    }

    public function indexTimetable(IndexRequest $request)
    {
        return ['result'=>'OK','timetable'=>(new Timetable())->timetableFormation($request->grade_id,$request->semester)];

    }
    public function create()
    {
        $teachersAndThemSubjects=collect(["teachers"=>(new Timetable())->getTeachers(),
        "subjects"=>(new Timetable())->getSubjects()->get(),
        "grades"=>(new Timetable())->getGrades()->get(),
        'classrooms'=>(new Timetable())->getClassrooms()->get()]);
         return view('admin.teacher.head-teacher.timetable.create',compact('teachersAndThemSubjects'));
    }

    public function store( StoreRequest $request)
    {
        return (new Timetable())->addTimeTable($request->all());
    }
    public function StoreLesson(LessonRequest $request)
    {
        return (new Timetable())->addLesson($request->all());
    }

    public function show(Timetable $timetable)
    {

    }

    public function edit(Timetable $timetable)
    {
        $data=$timetable;
        $Timetable= ["teachers"=>(new Timetable())->getTeachers(),
        "subjects"=>(new Timetable())->getSubjects()->get(),
        'classrooms'=>(new Timetable())->getClassrooms()->get(),
        'info'=>(new Timetable())->getInfoForLesson($timetable->subject_user_id)];
        return view('admin.teacher.head-teacher.timetable.edit',compact('Timetable','data'));
    }

    public function update(UpdateRequest $request, Timetable $timetable)
    {
        $id=$timetable->only(['id']);
        $data = $request->only(['subject_user_id','classroom_id']);
        return (new Timetable())->UpdateTimetable($request,$id);;
    }

    public function destroy(Timetable $timetable)
    {
        $timetable->delete();
        return ['response'=>'deleted'];

    }
}
