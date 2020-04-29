<?php

namespace App\Http\Requests\Timetable;

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
        $rules=[
            '*.day' => 'required|string|not_in:none',
            '*.subject_user_id' => 'integer|not_in:none',
            '*.lesson' => 'integer|not_in:none',
            '*.grade_id' => 'integer|not_in:none',
            '*.classroom_id' => 'integer|not_in:none',
            '*.semester' => 'integer|not_in:none'
        ];

        return $rules;
    }
}
