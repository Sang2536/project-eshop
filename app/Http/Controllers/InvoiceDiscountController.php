<?php

namespace App\Http\Controllers;

use App\Helpers\DiscountHelper;
use Illuminate\Http\Request;

class InvoiceDiscountController extends Controller
{
    protected $discountHelper;

    public function __construct (DiscountHelper $discountHelper)
    {
        $this->discountHelper = $discountHelper;
    }

    public function index()
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        if(request()->ajax()) {
            return $this->discountHelper->getDatatabelForDiscount();
        }

        return view('invoice_discounts/index');
    }

    public function create()
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        $contact_rank = [
            '' => 'Do not apply',
            'bronze' => 'Bronze',
            'silver' => 'Silver',
            'gold' => 'Gold',
            'platinm' => 'Platinum',
            'diamond' => 'Diamond',
        ];

        return view('invoice_discounts/create')->with(['contact_rank' => $contact_rank]);
    }

    public function store(Request $request)
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        try {
            $err = $this->discountHelper->checkDatetime($request->post('start_date'), $request->post('end_date'));

            if (!empty($err)) {
                return back()->withInput(['err' => $err]);
            } else {
                $input = $request->only(['name', 'code', 'quantity', 'type', 'value', 'value_limit', 'start_date', 'end_date', 'total_invoice', 'contact_rank']);

                $dicount = $this->discountHelper->createInvoiceDiscount($input);
            }
        } catch (\Throwable $th) {
            abort(403, 'File ' . $th->getFile() . ' in line ' . $th->getLine() . '. Error ' . $th->getMessage());
        }

        return redirect()->route('invoce-discounts.index');
    }

    public function show($id)
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        $invoice_discount = $this->discountHelper->getInvoiceDicount($id);

        $details_code = $invoice_discount->details_code;

        return view('invoice_discounts/show')->with(['invoice_discount' => $invoice_discount, 'details_code' => $details_code]);
    }

    public function edit($id)
    {
        if(!auth()->check()) {
            return redirect()->route('login.layout');
        }

        $invoice_discount = $this->discountHelper->getInvoiceDicount($id);

        $contact_rank = [
            '' => 'Do not apply',
            'bronze' => 'Bronze',
            'silver' => 'Silver',
            'gold' => 'Gold',
            'platinm' => 'Platinum',
            'diamond' => 'Diamond'
        ];

        return view('invoice_discounts/edit')->with(['invoice_discount' => $invoice_discount, 'contact_rank' => $contact_rank]);
    }

    public function update(Request $request, $id)
    {
        if(!auth()->check()) {
            redirect()->route('login.layout');
        }

        try {
            $err = $this->discountHelper->checkDatetime($request->post('start_date'), $request->post('end_date'));

            if (!empty($err)) {
                return back()->withInput(['err' => $err]);
            } else {
                $input = $request->only(['name', 'code', 'quantity', 'type', 'value', 'value_limit', 'start_date', 'end_date', 'total_invoice', 'contact_rank']);

                $incoice_discount = $this->discountHelper->updateInvoiceDiscount($id, $input);
            }
        } catch (\Throwable $th) {
            $msg = sprintf('File %s in line %s. Error %s', $th->getFile(), $th->getLine(), $th->getMessage());
            
            abort(403, $msg);
        }

        return redirect()->route('invoce-discounts.index');
    }

    public function destroy($id)
    {
        try {
            $invoice_discount = $this->discountHelper->destroyDicount($id);
        } catch (\Throwable $th) {
            abort(403, 'Error: ' . $th->getMessage());
        }
    }
}
