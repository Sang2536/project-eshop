<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\UnitHelper;

class UnitController extends Controller
{
    protected $unitHelper;

    public function __construct(UnitHelper $unitHelper)
    {
        $this->unitHelper = $unitHelper;
    }

    public function index(Request $request)
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        if ($request->ajax()) {
            return $this->unitHelper->getDatatableForUnit();
        }

        return view('units/index');
    }

    public function create()
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        return view('units/create');
    }

    public function store(Request $request)
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        try {
            $input = $request->only(['name', 'abbr', 'short_description']);

            $unit = $this->unitHelper->createUnit($input);
        } catch (\Throwable $th) {
            abort(403, 'Error: ' .$th->getMessage());
        }

        return redirect()->route('units.index');
    }

    public function show($id)
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        $unit = $this->unitHelper->getUnit($id);

        return view('units/show')->with(['unit' => $unit]);
    }

    public function edit($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.layout');
        }

        $unit = $this->unitHelper->getUnit($id);

        return view('units/edit')->with(['unit' => $unit]);
    }

    public function update(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.layout');
        }

        try {
            $input = $request->only(['name', 'abbr', 'short_description']);

            $this->unitHelper->updateUnit($id, $input);
        } catch (\Throwable $th) {
            abort(403, 'Error: ' .$th->getMessage());
        }

        return redirect()->route('units.index');
    }

    public function destroy($id)
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        try {
            $response = $this->unitHelper->destroyUnit($id);
        } catch (\Throwable $th) {
            abort(403, 'Error: ' .$th->getMessage());
        }

        return redirect()->route('units.index');
    }
}
