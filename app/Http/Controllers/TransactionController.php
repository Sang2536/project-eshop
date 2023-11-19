<?php

namespace App\Http\Controllers;

use App\Helpers\ContactHelper;
use App\Helpers\DiscountHelper;
use App\Helpers\ProductHelper;
use App\Helpers\TransactionHelper;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionHelper;
    protected $contactHelper;
    protected $productHelper;
    protected $discountHelper;

    public function __construct(TransactionHelper $transactionHelper, ContactHelper $contactHelper, DiscountHelper $discountHelper, ProductHelper $productHelper)
    {
        $this->transactionHelper = $transactionHelper;
        $this->contactHelper = $contactHelper;
        $this->productHelper = $productHelper;
        $this->discountHelper = $discountHelper;
    }

    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login.layout');
        }

        if(request()->ajax()) {
            return $this->transactionHelper->getDatatableOfTransaction();
        }

        return view('transactions/index');
    }

    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('login.layout');
        }

        $contacts = $this->contactHelper->selectDropdownForContact();
        $products = $this->productHelper->selectDropdownForProduct();

        return view('transactions/create')->with(['contacts' => $contacts, 'products' => $products]);
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login.layout');
        }

        try {
            //  create transactions
            $input = $request->only(['code', 'contact_id', 'transaction_date', 'transaction_type', 'payment_type', 'payment_amount', 'payment_date_ends', 'note', 'select_product', 'code_invoice_discount']);

            $transaction = $this->transactionHelper->createTransaction($input);

            //  create transaction_products
            if (!empty($transaction)) {
                $input_1 = [
                    'transaction_id' => $transaction->id,
                    'product_ids' => $request->post('select_product'),
                ];

                $tran_product = $this->transactionHelper->createTransactionPrduct($input_1);
            }

            //  update quantity in product

            //  update quantity in invoice_discount
        } catch (\Throwable $th) {
            abort(403, 'File ' . $th->getFile() . ' in line ' . $th->getLine() . '. Error ' . $th->getMessage());
        }

        return redirect()->route('transactions.index');
    }

    public function show($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.layout');
        }

        $transactions = $this->transactionHelper->getTransaction($id);
        $transaction_products = $this->transactionHelper->getTransactionProductUseWhere('transaction_id', $id);

        return view('transactions/show')->with(['transactions' => $transactions, 'transaction_products' => $transaction_products]);
    }

    public function edit($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.layout');
        }

        $transaction = $this->transactionHelper->getTransaction($id);
        $transaction_products = $this->transactionHelper->getTransactionProductUseWhere('transaction_id', $id);

        $product_ids = [];
        foreach ($transaction_products as $key => $value) {
            array_push($product_ids, $value['product_id']);
        }

        $contacts = $this->contactHelper->selectDropdownForContact();
        $products = $this->productHelper->selectDropdownForProduct();

        return view('transactions/edit')->with(['transaction' => $transaction, 'transaction_products' => $transaction_products, 'product_ids' => $product_ids, 'contacts' => $contacts, 'products' => $products]);
    }

    public function update(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.layout');
        }

        try {
            //  create transactions
            $input = $request->only(['code', 'contact_id', 'transaction_date', 'transaction_type', 'payment_type', 'payment_amount', 'payment_date_ends', 'note', 'select_product', 'code_invoice_discount']);

            $transaction = $this->transactionHelper->updateTransaction($id, $input);

            //  create transaction_products
            if (!empty($transaction)) {
                // Error when delete multi
                $this->transactionHelper->destroyTransactionProduct($id);

                $input_1 = [
                    'transaction_id' => $transaction->id,
                    'product_ids' => $request->post('select_product'),
                ];

                $tran_product = $this->transactionHelper->createTransactionPrduct($input_1);
            }

            //  update quantity in product

            //  update quantity in discount
        } catch (\Throwable $th) {
            abort(403, 'File ' . $th->getFile() . ' in line ' . $th->getLine() . '. Error ' . $th->getMessage());
        }

        return redirect()->route('transactions.index');
    }

    public function destroy($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login.layout');
        }

        try {
            $tranansacton = $this->transactionHelper->destroyTransaction($id);
        } catch (\Throwable $th) {
            abort(403, 'File ' . $th->getFile() . ' in line ' . $th->getLine() . '. Error ' . $th->getMessage());
        }

        return redirect()->route('transactions.index');
    }

    public function selectProduct(Request $request) {
        $response = [];

        if($request->ajax()) {
            $product_ids = $request->post('arr_product_id');
            $transaction_id = $request->post('transaction_id');
        }

        return $response;
    }
}
