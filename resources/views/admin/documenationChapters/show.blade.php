@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.documenationChapter.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.documenation-chapters.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.documenationChapter.fields.id') }}
                        </th>
                        <td>
                            {{ $documenationChapter->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documenationChapter.fields.title') }}
                        </th>
                        <td>
                            {{ $documenationChapter->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documenationChapter.fields.project_documentation') }}
                        </th>
                        <td>
                            {{ $documenationChapter->project_documentation->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documenationChapter.fields.description') }}
                        </th>
                        <td>
                            {!! $documenationChapter->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.documenation-chapters.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#chapter_chapter_contents" role="tab" data-toggle="tab">
                {{ trans('cruds.chapterContent.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="chapter_chapter_contents">
            @includeIf('admin.documenationChapters.relationships.chapterChapterContents', ['chapterContents' => $documenationChapter->chapterChapterContents])
        </div>
    </div>
</div>

@endsection