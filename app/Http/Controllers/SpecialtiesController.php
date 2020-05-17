<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtiesController extends Controller
{
    public function getSpecialties()
    {
        $specialties=(new Specialty())->getSpecialties();

        return response($specialties,200);
    }
}
