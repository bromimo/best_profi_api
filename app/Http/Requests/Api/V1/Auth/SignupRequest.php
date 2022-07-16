<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name'             => ['required', 'alpha'],
            'last_name'              => ['alpha'],
            'email'                  => ['required', 'email', 'unique:users,email'],
            'password'               => ['required', 'min:8'],
            'password_confirmation ' => ['required', 'confirmed']
        ];
    }
}
