<?php

namespace App\Http\Requests\Subject;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
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
            'first_name'     => ['required', 'string', 'max:64'],
            'last_name'      => ['sometimes', 'string', 'max:64'],
            'phones'         => ['required', 'array'],
            'phones.*.phone' => ['required', 'phone', 'unique:phones,phone'],
            'instagram'      => ['string', 'unique:instagrams,account'],
            'telegram'       => ['integer', 'unique:telegrams,account']
        ];
    }
}
