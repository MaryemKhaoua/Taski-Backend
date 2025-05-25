<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|string|unique:users,username',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'role' => 'required|in:admin,user',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username is required.',
            'username.unique' => 'This username is already taken.',
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.regex' => 'Password must include at least one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&).',
            'role.required' => 'Role is required.',
            'role.in' => 'Role must be either admin or user.',
        ];
    }
}
