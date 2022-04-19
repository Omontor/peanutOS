<?php

namespace App\Http\Requests;

use App\Models\ChapterContent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreChapterContentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('chapter_content_create');
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
