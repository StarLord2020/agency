<?php

namespace App\Http\Requests\Homework;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'lesson'=>'required|integer',
            'subject_user_id'=>'required|integer',
            'grade_id'=>'required|integer',
            'day'=>"required|string",
            'name' => 'required|string',
            'description'=>'required|string',
            'deadline'=>'required'
        ];
    }
}
