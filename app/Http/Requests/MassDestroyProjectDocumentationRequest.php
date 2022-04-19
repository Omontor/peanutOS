<?php

namespace App\Http\Requests;

use App\Models\ProjectDocumentation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProjectDocumentationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('project_documentation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:project_documentations,id',
        ];
    }
}
