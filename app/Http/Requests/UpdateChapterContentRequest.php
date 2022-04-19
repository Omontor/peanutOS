<?php

namespace App\Http\Requests;

use App\Models\ChapterContent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateChapterContentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('chapter_content_edit');
    }

    public function rules()
    {
        return [
            'chapter_id' => [
                'required',
                'integer',
            ],
            'content' => [
                'required',
            ],
        ];
    }
}
