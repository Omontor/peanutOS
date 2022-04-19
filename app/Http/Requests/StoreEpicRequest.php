<?php

namespace App\Http\Requests;

use App\Models\Epic;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEpicRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('epic_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'asignees.*' => [
                'integer',
            ],
            'asignees' => [
                'array',
            ],
            'start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'reporter_id' => [
                'required',
                'integer',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
