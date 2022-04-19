<?php

namespace App\Http\Requests;

use App\Models\ProjectDocumentation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProjectDocumentationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('project_documentation_create');
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
