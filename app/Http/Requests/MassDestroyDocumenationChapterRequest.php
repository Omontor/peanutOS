<?php

namespace App\Http\Requests;

use App\Models\DocumenationChapter;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDocumenationChapterRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('documenation_chapter_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:documenation_chapters,id',
        ];
    }
}
