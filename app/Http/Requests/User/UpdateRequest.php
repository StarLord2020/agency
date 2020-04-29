<?php

namespace App\Http\Requests\User;

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
            $id = request()->route('user')->id;

            $rules = [
                'name' => 'required|min:4|max:20',
                'surname' => 'required|min:4|max:20',
                'patronymic' => 'required|min:4|max:20',
                'email' => ['required','email', 'max:255', 'unique:users,email,'.$id],
                'birthday' => 'required',
                'number' => 'required|min:9|max:13',
                'address' => 'required|max:255',
                'sex' => 'required',
                'role' => 'required',
                'password' =>"nullable|min:8|max:16"
            ];

        return $rules;
    }
}
