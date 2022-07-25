<?php

namespace App\Http\Requests\Api\V1\Journal;

use Illuminate\Foundation\Http\FormRequest;

class AddSubjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'alpha'],
            'last_name' => ['alpha'],
            'phone' => ['required', 'regex:/\+380\d{9}/', 'unique:phones,phone'],
            'instagram' => ['string']
        ];
    }

    public function messages()
    {
        return [
            'phone.regex' => 'The phone format must be like "+380xxxxxxxxx"'
        ];
    }
}
