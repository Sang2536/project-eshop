<?php
namespace App\Helpers;

use App\Models\InvoiceDiscount;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class DiscountHelper
{
    public function getInvoiceDicount($id = null) : Object
    {
        $discounts = null;

        if (empty($id)) {
            $discounts = InvoiceDiscount::all();
        } else {
            $discounts = InvoiceDiscount::findOrFail($id);
        }

        return $discounts;
    }

    public function checkDatetime($start_date, $end_date) : Array {
        $err = [];

        if (strtotime(\Carbon\Carbon::now()) >= strtotime($start_date)){
            $err['err_start_date'] = 'The start date must be greater than today is date';
        } else if (strtotime($start_date) > strtotime($end_date)) {
            $err['err_start_date'] = 'The start date cannot be greater than the end date';
        }

        return $err;
    }

    public function getDatatabelForDiscount()
    {
        $invoice_discount = $this->getInvoiceDicount();

        return DataTables::of($invoice_discount)
            ->addIndexColumn()
            ->addColumn('action',function ($row) {
                $action = '<a data-href="' . route("invoce-discounts.show", $row->id) . '" role="button" class="btn btn-info btn-block bg-info btn-sm invoice_discount_show">
                            <i class="fa-solid fa-eye fa-fw me-1"></i><span>Show</span>
                        </a> &nbsp';

                if (auth()->user()->id == $row->created_by || Gate::allows('administrator') && strtotime(\Carbon\Carbon::now()) <= strtotime($row->start_date)) {
                        $action .= '<a href="' . route("invoce-discounts.edit", $row->id) . '" role="button" class="btn btn-secondary btn-block bg-secondary btn-sm">
                        <i class="fas fa-edit fa-fw me-1"></i><span>Edit</span>
                    </a> &nbsp';
                    $action .= '<a href="' . route("invoce-discounts.destroy", $row->id) . '" role="button" class="btn btn-danger btn-block bg-danger btn-sm">
                            <i class="fa fa-trash fa-fw me-1"></i><span>Delete</span>
                        </a> &nbsp';
                }

                return $action;
            })
            ->editColumn('created_by', function ($row) {
                $user = User::where('id', $row->created_by)->select('uid', 'name')->first();

                return $user->name. '<br />(uid: ' . $user->uid .')';
            })
            ->editColumn('value', function ($row) {
                $value =  $row->value;

                if ($row->type == 'fixed') {
                    $value .= '<i class="fa-solid fa-dong-sign"></i>';
                } elseif ($row->value == 'percent') {
                    $value .= '<b>%</b>';
                }

                return $value;
            })
            ->rawColumns(['action', 'created_by', 'value'])
            ->make(true);
    }

    public function createInvoiceDiscount($input)
    {
        $discount = [
            'name' =>  $input['name'],
            'code' => $input['code'],
            'type' => $input['type'],
            'quantity' => $input['quantity'],
            'value' => $input['value'],
            'rule_value' => $input['value_limit'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date'],
            'group_contact_id' => $input['contact_rank'],
            'created_by' => auth()->user()->id,
        ];

        $output = InvoiceDiscount::create($discount);

        return $output;
    }

    public function updateInvoiceDiscount($id, $input) : Object
    {
        $invoice_discount = $this->getInvoiceDicount($id);

        $invoice_discount['name'] = $input['name'];
        $invoice_discount['code'] = $input['code'];
        $invoice_discount['quantity'] = $input['quantity'];
        $invoice_discount['type'] = $input['type'];
        $invoice_discount['value'] = $input['value'];
        $invoice_discount['rule_value'] = $input['value_limit'];
        $invoice_discount['start_date'] = $input['start_date'];
        $invoice_discount['end_date'] = $input['end_date'];
        $invoice_discount['group_contact_id'] = $input['contact_rank'];
        $invoice_discount->save();

        return $invoice_discount;
    }

    public function destroyDicount($id) : Bool
    {
        $incoice_discunt = InvoiceDiscount::where('id', $id)->delete();

        return true;
    }

    function updateQuantityForDiscount($code, $quantity)
    {
        $discount = InvoiceDiscount::where('code', $code)->first();

        $discount->quantity = $quantity;
        $discount->save();
    }
}
