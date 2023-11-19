<?php
namespace App\Helpers;

use App\Charts\TransactionChart;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionProduct;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class TransactionHelper
{
    public function getTransaction($id = null) : Object
    {
        $transactions = null;

        if (empty($id)) {
            $transactions = Transaction::all();
        } else {
            $transactions = Transaction::findOrFail($id);
        }

        return $transactions;
    }

    public function getTransactionProduct($id = null) : Object
    {
        $trans_products = null;

        if (empty($id)) {
            $trans_products = TransactionProduct::all();
        } else {
            $trans_products = TransactionProduct::findOrFail($id);
        }

        return $trans_products;
    }

    public function getTransactionUseWhere($column, $value) : Object
    {
        $trans_products =  Transaction::where($column, $value)->get();

        return $trans_products;
    }

    public function getTransactionProductUseWhere($column, $value) : Object
    {
        $trans_products =  TransactionProduct::where($column, $value)->get();

        return $trans_products;
    }

    public function getTopContacts($type, $limit, $order_by = 'desc') : Object
    {
        $top_contact = Transaction::select('contact_id', DB::raw("SUM(total_amount) as total_amount_by_contact"))
        ->where('transaction_type', $type)
        ->orderBy('total_amount_by_contact', $order_by)
        ->groupBy('contact_id')
        ->limit($limit)
        ->get();

        return $top_contact;
    }

    public function getTopProduct($limit, $order_by = 'desc') : Object
    {
        $top_contact = TransactionProduct::select('product_id', 'product_name', DB::raw("SUM(quantity) as total_quantity_by_product"))
        ->orderBy('total_quantity_by_product', $order_by)
        ->groupBy('product_id', 'product_name')
        ->limit($limit)
        ->get();

        return $top_contact;
    }

    public function getTransactionByDate($type) : Object
    {
        $trans_by_date = Transaction::select(DB::raw("MONTH(transaction_date) as month"), DB::raw("SUM(total_amount) as total_amount_by_date"))
        ->where('transaction_type', $type)
        ->groupBy('month')
        ->get();

        return $trans_by_date;
    }

    public function getChart(array $label, array $data, string $name_chart = 'Name chart', string $type_chart = 'line', array $options = []) : Object {
        //  Chart (Type Chart: bar, line, pie, doughnut, bubble, radar, scatter)

        if (empty($options)) {
            $options = [
                'backgroundColor' => '#4e6160',
                'color' => '#ff4d4d',
            ];
        }
        
        $chart = new TransactionChart;
        $chart->labels($label);
        $chart->dataset($name_chart, $type_chart, $data)
                ->backgroundColor($options['backgroundColor'])
                ->color($options['color']);
        $chart->loaderColor('#10ebe0');

        return $chart;
    }

    public function getDatatableOfTransaction()
    {
        $transactions = $this->getTransaction();

        return DataTables::of($transactions)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $action = '<a data-href="' . route("transactions.show", $row->id) . '" role="button" class="btn btn-info btn-block bg-info btn-sm transaction_show">
                            <i class="fa-solid fa-eye fa-fw me-1"></i><span>Show</span>
                        </a> &nbsp';

                if (auth()->user()->id == $row->created_by || Gate::allows('administrator')) {
                    $action .= '<a href="' . route("transactions.edit", $row->id) . '" role="button" class="btn btn-secondary btn-block bg-secondary btn-sm">
                        <i class="fas fa-edit fa-fw me-1"></i><span>Edit</span>
                    </a> &nbsp';
                    $action .= '<a href="' . route("transactions.destroy", $row->id) . '" role="button" class="btn btn-danger btn-block bg-danger btn-sm">
                            <i class="fa fa-trash fa-fw me-1"></i><span>Delete</span>
                        </a> &nbsp';
                }

                return $action;
            })
            ->addColumn('contact_name', function ($row) {
                $contact = Contact::where('id', $row->contact_id)->select('cid', 'name')->first();

                $contact_name = '';
                if (!empty($contact->prefix)) {
                    $contact_name .= $contact->prefix;
                }
                $contact_name .= $contact->name . '<br />(Cid: ' . $contact->cid .')';

                return $contact_name;
            })
            ->addColumn('tran_created_by', function ($row) {
                $user = User::where('id', $row->created_by)->select('uid', 'name')->first();

                return $user->name. '<br />(uid: ' . $user->uid .')';
            })
            ->addColumn('payment_info', function ($row) {
                $payment_info = '<b>Payment type:</b> ' . $row->payment_type .'<br /><b>Payment status:</b> '. $row->payment_status .' ('. formatCurrency($row->payment_amount) .'<i class="fa-solid fa-dong-sign"></i>)';

                return $payment_info;
            })
            ->editColumn('total_amount', function ($row) {
                $total_amount = formatCurrency($row->total_amount) . '<i class="fa-solid fa-dong-sign"></i>';

                return $total_amount;
            })
            ->rawColumns(['action', 'contact_name', 'total_amount', 'tran_created_by', 'payment_info'])
            ->make(true);
    }

    public function createTransaction($input) : Object
    {
        $created_by = auth()->user()->id;

        $code = $input['code'];
        if (empty($code)) {
            $code = generateRandomString('012345789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        }

        $product_ids = $input['select_product'];

        $products = Product::whereIn('id', $product_ids)->get();

        $total_amount = 0;
        foreach($products->pluck('id')->toArray() as $key) {
            $total_amount += $products[$key]->price_sale;
        }

        $payment_amount = $input['payment_amount'] + 0;

        $payment_status = null;
        if($payment_amount - $total_amount > 0) {
            $error['payment_amount'] = 'Pament amount not large than total amount.';
        } elseif($payment_amount == 0) {
            $payment_status = 'debit';
        } elseif($payment_amount == $total_amount) {
            $payment_status = 'paid_off';
        } elseif($payment_amount - $total_amount < 0) {
            $payment_status = 'partial';
        } else {
            $payment_status = 'due';
        }

        $input['code'] = $code;
        $input['total_amount'] = $total_amount;
        $input['payment_amount'] = $payment_amount;
        $input['payment_status'] = $payment_status;
        $input['created_by'] = $created_by;

        // $trasaction = [
        //     'code' => $code,
        //     'contact_id' => Arr::get($input, 'contact_id'),
        //     'total_amount' => $total_amount,
        //     'transaction_date' => $input['transaction_date'],
        //     'transaction_type' => $input['transaction_type'],
        //     'payment_amount' => $payment_amount,
        //     'payment_type' => $input['payment_type'],
        //     'payment_status' => $payment_status,
        //     'payment_date_ends' => $input['payment_date_ends'],
        //     'details_payment' => null,
        //     'code_invoice_discount' => $input['code_invoice_discount'],
        //     'note' => $input['note'],
        //     'created_by' => $created_by,
        // ];

        $output = Transaction::create($input);

        return $output;
    }

    public function updateTransaction($id, $input) : Object
    {
        $product_ids = $input['select_product'];

        $products = Product::whereIn('id', $product_ids)->get();

        $total_amount = 0;
        foreach($products as $key => $value) {
            $total_amount += $products[$key]->price_sale;
        }

        $payment_amount = $input['payment_amount'] + 0;

        $payment_status = null;
        if($payment_amount - $total_amount > 0) {
            $error['payment_amount'] = 'Pament amount not large than total amount.';
        } elseif($payment_amount == 0) {
            $payment_status = 'debit';
        } elseif($payment_amount == $total_amount) {
            $payment_status = 'paid_off';
        } elseif($payment_amount - $total_amount < 0) {
            $payment_status = 'partial';
        } else {
            $payment_status = 'due';
        }

        $transaction = $this->getTransaction($id);

        $transaction->contact_id = $input['contact_id'];
        $transaction->total_amount = $total_amount;
        $transaction->transaction_date = $input['transaction_date'];
        $transaction->transaction_type = $input['transaction_type'];
        $transaction->payment_amount = $input['payment_amount'];
        $transaction->payment_type = $input['payment_type'];
        $transaction->payment_status = $payment_status;
        $transaction->payment_date_ends = $input['payment_date_ends'];
        $transaction->details_payment = null;
        $transaction->code_invoice_discount = $input['code_invoice_discount'];
        $transaction->note = $input['note'];

        $transaction->save();

        return $transaction;
    }

    public function destroyTransaction($id) : Bool
    {
        // $transaction = Transaction::where('id', $id)->delete();
        $transaction = $this->getTransaction($id);

        if ($transaction) {
            return false;
        }

        $transaction->delete();

        return true;
    }

    public function createTransactionPrduct($input) : Object
    {
        $product_ids = $input['product_ids'];

        foreach($product_ids as $value) {
            $product = Product::findOrFail($value);

            $trans_product = [
                'transaction_id' => $input['transaction_id'],
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_price' => $product->price_sale,
                'quantity' => 1,
            ];

            TransactionProduct::create($trans_product);
        }

        $output = $this->getTransactionProductUseWhere('transaction_id', $input['transaction_id']);

        return $output;
    }

    public function destroyTransactionProduct($id) : Bool
    {
        $transaction_products = TransactionProduct::where('transaction_id', $id)->delete();

        return true;
    }

    public function updateQuantityForTransaction($id, $quantity)
    {
        $product = TransactionProduct::findOrFail($id);

        $product->quantity = $quantity;
        $product->save();
    }

    public function getAmountByType(string $type) : Float
    {
        $trans = $this->getTransactionUseWhere('transaction_type', $type);

        $total_amount = 0;
        foreach ($trans as $key => $value)
        {
            $total_amount += $value['total_amount'];
        }

        return $total_amount;
    }

    public function getRevenue() : Float
    {
        $amount_sale = $this->getAmountByType('sell');
        $amount_order = $this->getAmountByType('order');
        $amount_purchase = $this->getAmountByType('purchase');

        return $amount_sale + $amount_order - $amount_purchase;
    }
}
