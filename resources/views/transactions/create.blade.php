@extends('layouts.app')

@section('title', 'Create Transaction')

@section('content')
<div class="container-fluit">
    <h1>Create transaction</h1>

    {!! Form::open(['url' => route('transactions.store'), 'method' => 'POST', 'id' => 'sale-create-form', 'class' => 'mx-1 mx-md-4', 'files' => true]) !!}
        <div class="row">
            <h4>Infomation</h4>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('contact_id', 'Contact') !!}
                {!! Form::select('contact_id', $contacts, null, ['class' => 'form-select w-100', 'required', 'placehoder' => 'Contact']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('code', 'Code (*will not be editable after creation)') !!}
                {!! Form::text('code', null, ['class' => 'form-control w-100', 'placehoder' => 'Code']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('transaction_date', 'Transaction Date') !!}
                {!! Form::date('transaction_date', \Carbon\Carbon::now(), ['class' => 'form-control w-100', 'required', 'placehoder' => 'Transaction Date']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('transaction_type', 'Transaction type') !!}
                {!! Form::select('transaction_type', ['sell' => 'Sales Order', 'purchase' => 'Purchase Order', 'order' => 'The order'], 'sell', ['class' => 'form-select w-100', 'required', 'placehoder' => 'Transaction type']) !!}
            </div>

            <div class="col-md-6 col-lg-6 col-xl-6 mb-4">
                <div class="form-group">
                    {!! Form::label('note', 'Note') !!}
                    {!! Form::textarea('note', null, ['class' => 'form-control w-100', 'rows' => '3', 'placehoder' => 'Note']) !!}
                </div>
            </div>

            <div class="clearfix"><br /></div>
            <h4>Select Product</h4>

            <div class="col-md-6 col-lg-6 col-xl-6 mb-4">
                {!! Form::label('select_product', 'Product') !!}
                {!! Form::select('select_product[]', $products, null, ['class' => 'form-select w-100', 'id' => 'select-product-multiple', 'multiple', 'required', 'placehoder' => 'Product']) !!}
                <button type="button" id="button-select-product-submit" class="btn btn-primary btn-block bg-primary btn-sm mt-2">Select</button>
            </div>

            <div class="col-md-8 col-lg-12 col-xl-12 mb-4">
                <table class="table table-bordered table-striped w-100" id="select-product-table">
                    <thead>
                        <tr>
                            <th style="min-width: 100px;">Action</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Unit price</th>
                            <th>Total price</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <div class="clearfix"><br /></div>
            <h4>Discount</h4>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('code_invoice_discount', 'Code invoice discount') !!}
                {!! Form::text('code_invoice_discount', null, ['class' => 'form-control w-100', 'placehoder' => 'Code invoice discount']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('value', 'Value discount') !!}
                {!! Form::text('value', null, ['class' => 'form-control w-100', 'placehoder' => 'Value discount']) !!}
            </div>

            <div class="clearfix"><br /></div>
            <h4>Payment</h4>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4 hide">
                {!! Form::label('payment_amount', 'Payment amount') !!}
                {!! Form::number('payment_amount', 0, ['class' => 'form-control w-100', 'min' => '0', 'placehoder' => 'Payment amount']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('payment_type', 'Payment type') !!}
                {!! Form::select('payment_type', ['cash' => 'Cash', 'online' => 'Online'], 'cash', ['class' => 'form-select w-100', 'required', 'placehoder' => 'Unit']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('payment_date_ends', 'Payment date ends') !!}
                {!! Form::date('payment_date_ends', \Carbon\Carbon::now(), ['class' => 'form-control w-100', 'required', 'placehoder' => 'Payment date ends']) !!}
            </div>
        </div>

        <div class="clearfix"><br /></div>

        <div class="text-center pt-1 mt-5 pb-1">
            {!! Form::submit('Add', ['id' => 'transaction-create-submit', 'class' => 'btn btn-primary btn-block bg-primary mb-3']) !!}
        </div>
    {!! Form::close() !!}
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#select-product-multiple').select2();
    });

    $('button#button-select-product-submit').click(function () {
        var select_product_id = $('#select-product-multiple').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "{{ route('transactions.select-product') }}",
            data: {
                'arr_product_id': select_product_id
            },
            dataType: "json",
            success: function (response) {
                var html = '';

                if(response != null) {
                    var products = response['products'];

                    for (let i = 0; i < products.length; i++) {
                        console.log(products[i].name);
                        html += '<tr><td>x</td><td>'+ products[i].name +'</td><td><input type="number" min="1" value="1" id="select-product-quantity" /></td><td id="select-">'+ products[i].price_sale +'</td><td id="total_price">'+ products[i].price_sale +'</td></tr>';
                    }
                }

                $('table#select-product-table > tbody').html(html);
            }
        });
    });
</script>
@endpush
