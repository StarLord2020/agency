<?php

namespace App\Http\Requests\Manager;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|unique:specialties,name|max:255',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Название специальности',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Поле должно быть заполнено',
            'name.unique'  => 'Такое поле уже есть',
        ];
    }
}
