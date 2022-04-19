<?php

namespace App\Http\Requests;

use App\Models\TaskAction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTaskActionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('task_action_edit');
    }

    public function rules()
    {
        return [
            'task_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'title' => [
                'string',
                'required',
            ],
        ];
    }
}
