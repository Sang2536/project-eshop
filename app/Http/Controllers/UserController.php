<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use App\Models\UserRole as ModelsUserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(! Gate::allows('administrator')) {
            return redirect()->back();
        }

        if($request->ajax()) {
            $users = ModelsUser::select('id', 'uid', 'name', 'email', 'display_name')->get();

            return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $action = '<a href="' . route("users.show", $row->id) . '" role="button" class="btn btn-info btn-block bg-info btn-sm">
                        <i class="fa-solid fa-eye fa-fw me-1"></i><span>Show</span>
                    </a>';

                $role_type = ModelsUserRole::where('user_roles.ur_uid', $row->id)
                            ->join('roles', 'user_roles.ur_rid', 'roles.id')
                            ->select('roles.type as r_type')->first();

                if($role_type->r_type != 'administrator') {
                    $action .= '<a href="' . route("users.edit", $row->id) . '" role="button" class="btn btn-secondary btn-block bg-secondary btn-sm">
                            <i class="fas fa-edit fa-fw me-1"></i><span>Edit</span>
                        </a>';
                    $action .= '<a href="' . route("users.destroy", $row->id) . '" role="button" class="btn btn-danger btn-block bg-danger btn-sm">
                        <i class="fa fa-trash fa-fw me-1"></i><span>Delete</span>
                    </a>';
                }

                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('users/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function profile($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.layout');
        }

        //  should add columns in table: avatar, slogan, note, last_login
        $user = ModelsUser::where('id', $id)
                ->select('id', 'uid', 'name', 'email', 'display_name')
                ->first();

        return view('users/profile')->with(['user' => $user]);
    }

    public function setting($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.layout');
        }

        //  should add columns in table: avatar, slogan, note, last_login
        $user = ModelsUser::where('id', $id)
                ->select('id', 'uid', 'name', 'email', 'display_name')
                ->first();

        return view('users/setting')->with(['user' => $user]);
    }
}
