<?php

namespace App\Http\Requests;

use App\Models\TaskAction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTaskActionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('task_action_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:task_actions,id',
        ];
    }
}
