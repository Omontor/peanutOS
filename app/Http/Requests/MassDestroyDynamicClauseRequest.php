<?php

namespace App\Http\Requests;

use App\Models\DynamicClause;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDynamicClauseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('dynamic_clause_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:dynamic_clauses,id',
        ];
    }
}
