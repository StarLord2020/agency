<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function index() {
        $myResumes=(new Resume())->getAllResumes();
        return view('manager.index-resume',compact('myResumes'));
    }
    public function update(Request $request, Resume $resume)
    {
        $data = $request->only([
            'status_id','publication_date']);
        $resume->update($data);

        return ['response'=>'updated'];
    }
    public function show($id)
    {
        $resume = (new Resume())->getResumeById($id);

        return view('manager.show-resume',compact('resume'));
    }
}
