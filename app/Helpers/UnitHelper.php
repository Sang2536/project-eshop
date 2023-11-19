<?php
namespace App\Helpers;

use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class UnitHelper
{
    public function checkUserPermissions($uid = null) {
        //  Authentication
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        //  Authorization
        if (!empty($uid)) {
            if (Gate::allows('administrator')) {
                abort(403, 'Action is not allowed!');
            }

            //  kiểm tra như dưới phèn quá (dùng DB) => dùng Gate và Policy
            if (auth()->user()->id != $uid) {
                abort(403, 'Action is not allowed!');
            }
        }
    }

    public function getUnit($id = null) : Object {
        $units = null;

        if (empty($id)) {
            $units = Unit::all();
        } else {
            $units = Unit::findOrFail($id);
        }

        return $units;
    }

    public function selectDropdownForUnit() : Array {
        $units = Unit::select('id', 'name')->pluck('name', 'id');

        return $units;
    }

    public function getDatatableForUnit() {
        $units = $this->getUnit();

        return DataTables::of($units)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $action = '<a data-href="' . route("units.show", $row->id) . '" role="button" class="btn btn-info btn-block bg-info btn-sm unit_show">
                        <i class="fa-solid fa-eye fa-fw me-1"></i><span>Show</span>
                    </a> &nbsp';

                if (auth()->user()->id == $row->created_by || Gate::allows('administrator')) {
                    $action .= '<a data-href="' . route("units.edit", $row->id) . '" role="button" class="btn btn-secondary btn-block bg-secondary btn-sm unit_edit">
                        <i class="fas fa-edit fa-fw me-1"></i><span>Edit</span>
                    </a> &nbsp';
                    $action .= '<a href="' . route("units.destroy", $row->id) . '" role="button" class="btn btn-danger btn-block bg-danger btn-sm">
                            <i class="fa fa-trash fa-fw me-1"></i><span>Delete</span>
                        </a> &nbsp';
                }

                return $action;
            })
            ->editColumn('created_by', function ($row) {
                $user = User::where('id', $row->created_by)->select('uid', 'name')->first();

                return $user->name. '<br />(uid: ' . $user->uid .')';
            })
            ->rawColumns(['action', 'created_by'])
            ->make(true);
    }

    public function createUnit(array $input) : Object {
        $unit = [
            'name' => $input['name'],
            'abbr' => $input['abbr'],
            'short_description' => $input['short_description'],
            'created_by' => auth()->user()->id
        ];

        $output = Unit::create($unit);

        return $output;
    }

    public function updateUnit($id, $input) : Object {
        $unit = $this->getUnit($id);

        $unit->name = $input['name'];
        $unit->abbr = $input['abbr'];
        $unit->short_description = $input['short_description'];
        $unit->save();

        return $unit;
    }

    public function destroyUnit($id) : Bool {
        $unit = Unit::where('id', $id)->delete();

        return true;
    }
}
