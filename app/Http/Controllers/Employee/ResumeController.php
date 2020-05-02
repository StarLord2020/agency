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


    public function showResume() {

        $user_id = Auth::id();
        $resume = (new Resume())->getResumeById($user_id);
        $offers=[];
        if($resume){
            $offers = (new Offer())->getOffers($resume->id);
        }

        return view('employee.show-resume',compact('resume','offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialty = (new Specialty())->getSpecialty();

        return view('employee.create-resume',compact('specialty'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $resume = $request->all();
        $resume['user_id']= Auth::id();
        $resume['status_id']= 1;

        return (new Resume()) -> prepareForCreate($resume);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function show(Resume $resume)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function edit(Resume $resume)
    {
        $specialty = (new Specialty())->getSpecialty();

        return view('employee.edit-resume',compact('resume','specialty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resume $resume)
    {
        $resume->delete();

        return ['response'=>'deleted'];
    }
}
