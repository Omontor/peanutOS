<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContactFormRequest;
use App\Http\Requests\StoreContactFormRequest;
use App\Http\Requests\UpdateContactFormRequest;
use App\Models\ContactForm;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactFormController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contact_form_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactForms = ContactForm::all();

        return view('frontend.contactForms.index', compact('contactForms'));
    }

    public function create()
    {
        abort_if(Gate::denies('contact_form_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.contactForms.create');
    }

    public function store(StoreContactFormRequest $request)
    {
        $contactForm = ContactForm::create($request->all());

        return redirect()->route('frontend.contact-forms.index');
    }

    public function edit(ContactForm $contactForm)
    {
        abort_if(Gate::denies('contact_form_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.contactForms.edit', compact('contactForm'));
    }

    public function update(UpdateContactFormRequest $request, ContactForm $contactForm)
    {
        $contactForm->update($request->all());

        return redirect()->route('frontend.contact-forms.index');
    }

    public function show(ContactForm $contactForm)
    {
        abort_if(Gate::denies('contact_form_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.contactForms.show', compact('contactForm'));
    }

    public function destroy(ContactForm $contactForm)
    {
        abort_if(Gate::denies('contact_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactForm->delete();

        return back();
    }

    public function massDestroy(MassDestroyContactFormRequest $request)
    {
        ContactForm::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
