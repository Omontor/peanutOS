<?php

namespace App\Http\Requests;

use App\Models\StaticClause;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStaticClauseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('static_clause_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:static_clauses,id',
        ];
    }
}
