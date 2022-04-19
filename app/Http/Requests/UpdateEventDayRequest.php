<?php

namespace App\Http\Requests;

use App\Models\EventDay;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventDayRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_day_edit');
    }

    public function rules()
    {
        return [
            'date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'event_id' => [
                'required',
                'integer',
            ],
            'title' => [
                'string',
                'nullable',
            ],
        ];
    }
}
