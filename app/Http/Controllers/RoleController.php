<?php

namespace App\Http\Controllers;

use App\Models\Role as ModelsRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\Datatables\Datatables;

class RoleController extends Controller
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

        if ($request->ajax()) {
            $roles = ModelsRole::select('id','rid', 'name', 'type', 'roles', 'description')->get();

            return Datatables::of($roles)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action = '<a href="' . route("roles.show", $row->id) . '" role="button" class="btn btn-info btn-block bg-info btn-sm">
                        <i class="fa-solid fa-eye fa-fw me-1"></i><span>Show</span>
                    </a>';

                    if ($row->type != 'administrator') {
                        $action .= '<a href="' . route("roles.edit", $row->id) . '" role="button" class="btn btn-secondary btn-block bg-secondary btn-sm">
                            <i class="fas fa-edit fa-fw me-1"></i><span>Edit</span>
                        </a>';
                        $action .= '<a href="' . route("roles.destroy", $row->id) . '" role="button" class="btn btn-danger btn-block bg-danger btn-sm">
                            <i class="fa fa-trash fa-fw me-1"></i><span>Delete</span>
                        </a>';
                    }

                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('roles/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
}
