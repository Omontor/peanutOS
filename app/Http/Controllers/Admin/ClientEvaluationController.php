<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyClientEvaluationRequest;
use App\Http\Requests\StoreClientEvaluationRequest;
use App\Http\Requests\UpdateClientEvaluationRequest;
use App\Models\Client;
use App\Models\ClientEvaluation;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ClientEvaluationController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('client_evaluation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientEvaluations = ClientEvaluation::with(['client'])->get();

        return view('admin.clientEvaluations.index', compact('clientEvaluations'));
    }

    public function create()
    {
        abort_if(Gate::denies('client_evaluation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.clientEvaluations.create', compact('clients'));
    }

    public function store(StoreClientEvaluationRequest $request)
    {
        $clientEvaluation = ClientEvaluation::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $clientEvaluation->id]);
        }

        return redirect()->route('admin.client-evaluations.index');
    }

    public function edit(ClientEvaluation $clientEvaluation)
    {
        abort_if(Gate::denies('client_evaluation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clientEvaluation->load('client');

        return view('admin.clientEvaluations.edit', compact('clientEvaluation', 'clients'));
    }

    public function update(UpdateClientEvaluationRequest $request, ClientEvaluation $clientEvaluation)
    {
        $clientEvaluation->update($request->all());

        return redirect()->route('admin.client-evaluations.index');
    }

    public function show(ClientEvaluation $clientEvaluation)
    {
        abort_if(Gate::denies('client_evaluation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientEvaluation->load('client');

        return view('admin.clientEvaluations.show', compact('clientEvaluation'));
    }

    public function destroy(ClientEvaluation $clientEvaluation)
    {
        abort_if(Gate::denies('client_evaluation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientEvaluation->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientEvaluationRequest $request)
    {
        ClientEvaluation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('client_evaluation_create') && Gate::denies('client_evaluation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ClientEvaluation();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
