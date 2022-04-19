<?php

namespace App\Http\Requests;

use App\Models\StatusTask;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStatusTaskRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('status_task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:status_tasks,id',
        ];
    }
}
