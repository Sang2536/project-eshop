<?php

namespace App\Http\Controllers;

use App\Models\Contact as ModelsContact;
use App\Models\Unit as ModelsUnit;

class ReportController extends Controller
{
    public function index()
    {
        $contacts = [
            'all_quantity' => ModelsContact::all()->count(),
            'status' => [
                'active' => ModelsContact::where('status', 'active')->get()->count(),
                'inactive' => ModelsContact::where('status', 'inactive')->get()->count(),
                'blocked' => ModelsContact::where('status', 'blocked')->get()->count(),
            ]
        ];

        $units = [
            'all_quantity' => ModelsUnit::all()->count()
        ];

        return view('reports/index')->with(['units' => $units, 'contacts' => $contacts]);
    }

    public function reportGeneral()
    {
        $contacts = [
            'all_quantity' => ModelsContact::all()->count(),
            'status' => [
                'active' => ModelsContact::where('status', 'active')->get()->count(),
                'inactive' => ModelsContact::where('status', 'inactive')->get()->count(),
                'blocked' => ModelsContact::where('status', 'blocked')->get()->count(),
            ]
        ];

        $units = [
            'all_quantity' => ModelsUnit::all()->count()
        ];

        return view('reports/report_general')->with(['units' => $units, 'contacts' => $contacts]);
    }

    public function reportProfit()
    {
        return view('reports/report_profit');
    }
}
