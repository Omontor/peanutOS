<?php

namespace App\Http\Requests;

use App\Models\EpicStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEpicStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('epic_status_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
