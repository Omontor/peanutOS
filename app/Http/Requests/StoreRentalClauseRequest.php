<?php

namespace App\Http\Requests;

use App\Models\RentalClause;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRentalClauseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rental_clause_create');
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
