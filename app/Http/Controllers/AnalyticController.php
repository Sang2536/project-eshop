<?php

namespace App\Http\Controllers;

use App\Charts\TransactionChart;
use App\Helpers\TransactionHelper;
use Illuminate\Http\Request;

class AnalyticController extends Controller
{
    protected $transationHelper;

    public function __construct(TransactionHelper $transactionHelper)
    {
        $this->transationHelper = $transactionHelper;
    }
    
    public function index()
    {
        $label_month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data_amount_month = [68980000, 110470000, 89480000, 90480000, 130490000, 74680000, 78900000, 89990000, 63570000, 68980000, 83400000, 74880000];
        $data_quantity_month = [1080, 1567, 1304, 1856, 2000, 1122, 1290, 1876, 1236, 1200, 1863, 1271];
        $label_trans_flow = ['Sell', 'Order', 'Purchase'];
        $data_trans_flow = [60, 10, 30];


        $chart = $this->transationHelper->getChart($label_month, $data_amount_month, 'Revenue');

        $chart_product = $this->transationHelper->getChart($label_month, $data_quantity_month, 'Best-selling products', 'bar');

        $chart_transaction_flow = $this->transationHelper->getChart($label_trans_flow, $data_trans_flow, 'Transaction flow', 'pie');

        return view('analytics/index')->with(['chart' => $chart, 'chart_product' => $chart_product, 'chart_transaction_flow' => $chart_transaction_flow]);
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
}
