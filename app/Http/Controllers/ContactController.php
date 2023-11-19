<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ContactHelper;

class ContactController extends Controller
{
    protected $contactHelper;

    public function __construct(ContactHelper $contactHelper)
    {
        $this->contactHelper = $contactHelper;
    }

    public function index(Request $request)
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        if($request->ajax()) {
            return $this->contactHelper->getDatatableForContact();
        }

        return view('contacts/index');
    }

    public function create()
    {
        return view('contacts/create');
    }

    public function store(Request $request)
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        try {
            $input = $request->only(['name', 'prefix', 'address', 'phone', 'email', 'status', 'type', 'rank']);

            $contact = $this->contactHelper->createContact($input);
        } catch (\Throwable $th) {
            abort(403, 'Message: ' . $th->getMessage());
        }

        return redirect()->route('contacts.index');
    }

    public function show($id)
    {
        if(auth()->check()) {
            return redirect()->route('login.layout');
        }

        $contact = $this->contactHelper->getContact($id);
        $list_contact = $this->contactHelper->selectDropdownForContact();

        return view('contacts/show')->with(['contact' => $contact, 'list_contact' => $list_contact]);
    }

    public function edit(Request $request, $id)
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        $contact = $this->contactHelper->getContact($id);

        return view('contacts/edit')->with(['contact' => $contact]);
    }

    public function update(Request $request, $id)
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        try {
            $input = $request->only(['name', 'prefix', 'address', 'phone', 'email', 'status', 'type', 'rank']);
            //  hasn't photo

            $unit = $this->contactHelper->updateContact($id, $input);
        } catch (\Throwable $th) {
            abort(403, 'Error: ' . $th->getMessage());
        }

        return redirect()->route('contacts.index');
    }

    public function destroy($id)
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        try {
            $this->contactHelper->destroyContact($id);
        } catch (\Throwable $th) {
            abort(403, 'Error: ' .$th->getMessage());
        }

        return redirect()->route('contacts.index');
    }
}
