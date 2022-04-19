<?php

namespace App\Http\Requests;

use App\Models\DocumenationChapter;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDocumenationChapterRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('documenation_chapter_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'project_documentation_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
