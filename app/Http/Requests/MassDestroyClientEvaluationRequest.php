<?php

namespace App\Http\Requests;

use App\Models\ClientEvaluation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyClientEvaluationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('client_evaluation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:client_evaluations,id',
        ];
    }
}
