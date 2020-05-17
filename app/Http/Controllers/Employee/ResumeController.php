<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreRequest;
use App\Models\Offer;
use App\Models\Resume;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function showResume()
    {
        $resumes = (new Resume())->getResumesByUser();
        $offers=[];

        return view('employee.show-resume',compact('resumes','offers'));
    }

    public function getPublicResumes($bid_id)
    {
        $resumes = (new Resume())->getPublicResumesByUser();

        return view('employee.send-resume',compact('resumes','bid_id'));
    }

    public function create()
    {
        $specialty = (new Specialty())->getSpecialties();

        return view('employee.create-resume',compact('specialty'));
    }


    public function store(StoreRequest $request)
    {
        $resume = $request->all();
        $resume['user_id']= Auth::id();
        $resume['status_id']= 1;

        return (new Resume()) -> prepareForCreate($resume);
    }

    public function show(Resume $resume)
    {
        //
    }

    public function edit(Resume $resume)
    {
        $specialty = (new Specialty())->getSpecialties();

        return view('employee.edit-resume',compact('resume','specialty'));
    }

    public function update(Request $request, Resume $resume)
    {
        $data = $request->only(['education',
            'specialty_id',
            'status_id',
            'skills',
            'experience',
            'publication_date']);


        $resume->update($data);

        return ['response'=>'updated'];
    }

    public function destroy(Resume $resume)
    {
        $resume->delete();

        return ['response'=>'deleted'];
    }
}
