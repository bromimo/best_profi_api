<?php

namespace App\Http\Requests\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleUpdateRequest extends FormRequest
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
            'schedule'          => ['required', 'array'],
            'schedule.*.day'    => ['required', 'integer', 'between:0,6'],
            'schedule.*.time'   => ['required', 'array'],
            'schedule.*.time.*' => ['required', 'string', 'date_format:H:i:s']
        ];
    }
}
