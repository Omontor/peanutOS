<?php

namespace App\Http\Requests;

use App\Models\StaticClause;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStaticClauseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('static_clause_edit');
    }

    public function rules()
    {
        return [
            'content' => [
                'required',
            ],
            'title' => [
                'string',
                'required',
            ],
        ];
    }
}
