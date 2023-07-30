<?php

namespace App\Http\Requests\Subject;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:64'],
            'last_name'  => ['sometimes', 'string', 'max:64'],
            'phones'         => ['array'],
            'phones.*.phone' => [
                'phone',
                Rule::unique('phones')->where(function ($query) {
                    $query->whereNot('subject_id', $this->subject->id)->whereNull('deleted_at');
                })
            ]
        ];
    }
}
