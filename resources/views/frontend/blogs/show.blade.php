@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.blog.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.blogs.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $blog->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $blog->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.excerpt') }}
                                    </th>
                                    <td>
                                        {{ $blog->excerpt }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $blog->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.thumb_image') }}
                                    </th>
                                    <td>
                                        @if($blog->thumb_image)
                                            <a href="{{ $blog->thumb_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $blog->thumb_image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.banner_image') }}
                                    </th>
                                    <td>
                                        @if($blog->banner_image)
                                            <a href="{{ $blog->banner_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $blog->banner_image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.gallery') }}
                                    </th>
                                    <td>
                                        @foreach($blog->gallery as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.blog.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $blog->description !!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.blogs.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection