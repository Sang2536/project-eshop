<?php

namespace App\Http\Controllers;

use App\Helpers\ContactHelper;
use App\Helpers\TransactionHelper;

class DashboardController extends Controller
{
    protected $transationHelper;
    protected $contactHelper;

    public function __construct(TransactionHelper $transactionHelper, ContactHelper $contactHelper)
    {
        $this->transationHelper = $transactionHelper;
        $this->contactHelper = $contactHelper;
    }

    public function index()
    {
        //  Amount
        $amount = [
            'revenue' => $this->transationHelper->getRevenue(),
            'amount_sale' => $this->transationHelper->getAmountByType('sell'),
            'amount_order' => $this->transationHelper->getAmountByType('order'),
            'amount_purchase' => $this->transationHelper->getAmountByType('purchase'),
        ];

        //  Contact
        $contact = [
            'quantity' => $this->contactHelper->getContact()->count(),
        ];

        //  top
        $top_product = $this->transationHelper->getTopProduct(10);
        
        $top = [
            'top_customer' => $this->transationHelper->getTopContacts('sell', 5),
            'top_purchase' => $this->transationHelper->getTopContacts('purchase', 5),
            'top_product' => $top_product,
        ];

        //  chart revenue
        $trans_by_date = $this->transationHelper->getTransactionByDate('sell');
        $arr_revenue = $trans_by_date->pluck('total_amount_by_date', 'month')->toArray();
        $chart = $this->transationHelper->getChart(array_keys($arr_revenue), array_values($arr_revenue), 'Revenue by month');

        //  chart top product
        $arr_top_product = $top_product->pluck('total_quantity_by_product', 'product_id')->toArray();
        $chart_product = $this->transationHelper->getChart(array_keys($arr_top_product), array_values($arr_top_product), 'Best-selling products', 'bar');

        return view('dashboards/index')->with(['amount' => $amount, 'contact' => $contact, 'top' => $top, 'chart' => $chart, 'chart_product' => $chart_product]);
    }
}
