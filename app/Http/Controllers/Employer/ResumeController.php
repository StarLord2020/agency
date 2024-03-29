<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use App\Models\Specialty;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function index(){

        $resumes = (new Resume())->getAllResumesForEmployer();
        $specialties = (new Specialty())->getSpecialties();
        return view('employer.search-for-resumes',compact('resumes','specialties'));
    }

    public function show($resume_id)
    {
        $resume=(new Resume())->getResumeById($resume_id);

        return view('employer.watch-resume',compact('resume'));
    }
}
