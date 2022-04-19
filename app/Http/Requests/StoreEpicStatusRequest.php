<?php

namespace App\Http\Requests;

use App\Models\EpicStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEpicStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('epic_status_create');
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
