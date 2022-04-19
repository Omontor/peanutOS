<?php

namespace App\Http\Requests;

use App\Models\DynamicClause;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDynamicClauseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('dynamic_clause_edit');
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
