<?php

namespace App\Http\Requests;

use App\Models\ProjectStory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProjectStoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('project_story_edit');
    }

    public function rules()
    {
        return [
            'project_id' => [
                'required',
                'integer',
            ],
            'description' => [
                'required',
            ],
            'gallery' => [
                'array',
            ],
            'youtube_url' => [
                'string',
                'nullable',
            ],
        ];
    }
}
