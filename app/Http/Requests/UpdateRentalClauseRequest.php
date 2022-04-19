<?php

namespace App\Http\Requests;

use App\Models\RentalClause;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRentalClauseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rental_clause_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'content' => [
                'required',
            ],
        ];
    }
}
