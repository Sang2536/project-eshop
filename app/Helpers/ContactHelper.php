<?php
namespace App\Helpers;

use App\Models\Contact;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class ContactHelper
{
    function getContact($id = null) : Object
    {
        $contacts = null;

        if (empty($id)) {
            $contacts = Contact::all();
        } else {
            $contacts = Contact::findOrFail($id);
        }

        return $contacts;
    }

    public function getContactUseWhere($column, $value) : Object
    {
        $contacts =  Contact::where($column, $value)->get();

        return $contacts;
    }

    function selectDropdownForContact() : Object
    {
        $contacts = Contact::select('id', DB::raw('CONCAT(type, ": ", name, " (Cid: ", cid, ")") as name_cid'))->pluck('name_cid', 'id');

        return $contacts;
    }

    public function getDatatableForContact()
    {
        $contacts = $this->getContact();

        return DataTables::of($contacts)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $action = '<a href="' . route("contacts.show", $row->id) . '" role="button" id="contact-show" class="btn btn-info btn-block bg-info btn-sm">
                <i class="fa-solid fa-eye fa-fw me-1"></i><span>Show</span>
            </a> &nbsp';

            if (auth()->user()->id == $row->created_by || Gate::allows('administrator')) {
                $action .= '<a href="' . route("contacts.edit", $row->id) . '" role="button" class="btn btn-secondary btn-block bg-secondary btn-sm">
                    <i class="fas fa-edit fa-fw me-1"></i><span>Edit</span>
                    </a> &nbsp';
                $action .= '<a href="' . route("contacts.destroy", $row->id) . '" role="button" class="btn btn-danger btn-block bg-danger btn-sm">
                        <i class="fa fa-trash fa-fw me-1"></i><span>Delete</span>
                    </a> &nbsp';
            }

            return $action;
        })
        ->editColumn('created_by', function ($row) {
            $user = User::where('id', $row->created_by)->select('uid', 'name')->first();

            return $user->name. '<br />(uid: ' . $user->uid .')';
        })
        ->editColumn('photo', function ($row) {
            $src = '#';

            $photo = '<img src="'. $src .'" class="rounded mx-auto d-block" alt="'. $row->cid .'">';

            return $photo;
        })
        ->rawColumns(['action', 'created_by', 'photo'])
        ->make(true);
    }

    function createContact(array $input) : Object
    {
        // save image

        $contact = [
            'cid' => generateRandomString('012345789ABCDEFGHIJKLMNOPQRSTUVWXYZ', 12),
            'name' => $input['name'],
            'prefix' => $input['prefix'],
            'address' => $input['address'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'photo' => null,
            'status' => $input['status'],
            'type' => $input['type'],
            'rank' => $input['rank'],
            'created_by' => auth()->user()->id
        ];

        $output = Contact::create($contact);

        return $output;
    }

    public function updateContact($id, $input) : Object
    {
        $contact = $this->getContact($id);

        // change image

        $contact->name = $input['name'];
        $contact->prefix = $input['prefix'];
        $contact->address = $input['address'];
        $contact->phone = $input['phone'];
        $contact->email = $input['email'];
        $contact->status = $input['status'];
        $contact->type = $input['type'];
        $contact->rank = $input['rank'];
        $contact->save();

        return $contact;
    }

    public function destroyContact($id) : Bool {
        $contact = Contact::where('id', $id)->delete();

        return true;
    }
}
