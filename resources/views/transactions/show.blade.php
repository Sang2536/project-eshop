<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $transactions->transaction_type }} - {{ $transactions->code }}</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                    <h5 class="text-decoration-underline text-center"><b>Contact</b></h5>

                    <p><b>Cotact Id:</b> {{ $transactions->contact_id }}</p>
                </div>

                <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                    <h5 class="text-decoration-underline text-center"><b>Transaction</b></h5>
                    {{-- <hr /> --}}

                    <p><b>Code:</b> {{ $transactions->code }}</p>
                    <p><b>Transaction date:</b> {{ $transactions->transaction_date }}</p>
                    <p><b>Transaction type:</b> {{ $transactions->transaction_type }}</p>
                    <p><b>Created by:</b> {{ $transactions->created_by }}</p>
                </div>

                <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                    <h5 class="text-decoration-underline text-center"><b>Payment</b></h5>

                    <p><b>Total amount:</b> {{ formatCurrency($transactions->total_amount) }}<i class="fa-solid fa-dong-sign"></i></p>
                    @empty(!$transactions->code_invoice_discount)
                        <p><b>Code discount:</b> {{ $transactions->code_invoice_discount }}</p>
                    @endempty
                    <p><b>Payment amount:</b> {{ formatCurrency($transactions->payment_amount) }}<i class="fa-solid fa-dong-sign"></i></p>
                    <p><b>Payment type:</b> {{ $transactions->payment_type }}</p>
                    <p><b>Payment status:</b> {{ $transactions->payment_status }}</p>
                    <p><b>Payment date ends:</b> {{ $transactions->payment_date_ends }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12 mb-4">
                    <h5 class="text-decoration-underline"><b>Detail transacton</b></h5>

                    <table class="table table-bordered table-striped w-100" id="sale-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($transaction_products); $i++)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $transaction_products[$i]->product_name }}</td>
                                    <td>{{ $transaction_products[$i]->quantity }}</td>
                                    <td>{{ formatCurrency($transaction_products[$i]->product_price) }}<i class="fa-solid fa-dong-sign"></i></td>
                                    <td>{{ formatCurrency($transaction_products[$i]->product_price) * $transaction_products[$i]->quantity }}<i class="fa-solid fa-dong-sign"></i></td>
                                </tr>
                            @endfor
                            <tr class="fw-bold">
                                <td colspan="4" class="text-center">Total Amount</td>
                                <td>{{ formatCurrency($transactions->total_amount) }}<i class="fa-solid fa-dong-sign"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
