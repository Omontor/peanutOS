<?php

namespace App\Http\Requests;

use App\Models\StatusTask;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStatusTaskRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('status_task_edit');
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
