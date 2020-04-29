<?php

namespace App\Http\Controllers\Admin\Super;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectUser\StoreRequest;
use App\Models\SubjectUser;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        redirect()->back();
    }

    public function teachersForSubject($id,$name)
    {
        $teachers = (new SubjectUser())->getTeachers($id);

        $subject = ['id'=>$id,'name'=>$name];

        return view('admin.super.subject-user.index',compact('teachers','subject'));
    }

    public function createForm($id,$name) {

        $teachers = (new User())
            ->getAllTeachers()
            ->get(['id','name','surname','patronymic']);

        $teachers = (new User())->groupFullName($teachers);
        $subject = ['id'=>$id,'name'=>$name];

        return view("admin.super.subject-user.create",compact('teachers','subject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("admin.super.subject-user.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {

        return (new SubjectUser())->prepareForCreate($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubjectUser  $subjectUser
     * @return \Illuminate\Http\Response
     */
    public function show(SubjectUser $subjectUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubjectUser  $subjectUser
     * @return \Illuminate\Http\Response
     */
    public function edit(SubjectUser $subjectUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubjectUser  $subjectUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubjectUser $subjectUser)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubjectUser  $subjectUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubjectUser $subjectUser)
    {
        $subjectUser->delete();

        return ['response'=>'deleted'];
    }
}
