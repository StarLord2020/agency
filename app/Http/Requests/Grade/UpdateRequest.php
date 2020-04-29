<?php

namespace App\Http\Requests\Grade;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();
        if($user->role=='Админ')
        {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>['string', 'max:6', 'unique:grades,name,'.$this['id']],
            'user_id'=>['integer', 'unique:grades,user_id,'.$this['id'],'nullable'],
            'classroom_id'=>['integer','unique:grades,classroom_id,'.$this['id'],'nullable'],
        ];
    }
}
