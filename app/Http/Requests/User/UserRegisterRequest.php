<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $rules = [
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'number_id' => ['required', 'numeric', 'unique:users,number_id'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['confirmed', 'string', 'min:8', 'required'],
        ];

        return $rules;
    }
    public function massages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name string' => 'El nombre debe ser valido'
        ];
    }
}
