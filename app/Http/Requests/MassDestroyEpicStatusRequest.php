<?php

namespace App\Http\Requests;

use App\Models\EpicStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEpicStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('epic_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:epic_statuses,id',
        ];
    }
}
