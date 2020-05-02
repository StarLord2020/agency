<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = Auth::id();

        $rules = [
            'education' => 'required|max:255',
            'specialty_id' => 'required|integer',
            'experience' => 'required|string:255',
            'skills' => 'required|string:2500',
        ];

        return $rules;
    }
}
