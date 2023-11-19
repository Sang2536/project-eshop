@extends('layouts.app')

@section('title', 'Edit Invoice Discount')

@section('content')
<div class="container-fluit">
    <h1>Edit Invoice Discount</h1>

    {!! Form::open(['url' => route('invoce-discounts.update', $invoice_discount->id), 'method' => 'PUT', 'id' => 'invoce-discount-edit-form', 'class' => 'mx-1 mx-md-4', 'files' => true]) !!}
        <div class="row">
            <h4>Infomation</h4>
            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', $invoice_discount->name, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Name']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('code', 'Code') !!}
                {!! Form::text('code', $invoice_discount->code, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Code']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('quantity', 'Quantity') !!}
                {!! Form::number('quantity', $invoice_discount->quantity, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Quantity', 'min' => '0']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('type', 'Type') !!}
                {!! Form::select('type', ['fixed' => 'Fixed amount', 'percent' => 'Percent invoice', 'gift' => 'Gift'], $invoice_discount->type, ['class' => 'form-select w-100', 'required', 'placehoder' => 'Type']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('value', 'Value Discount') !!}
                {!! Form::text('value', $invoice_discount->value, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Value Discount']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('value_limit', 'Value Limit') !!}
                {!! Form::text('value_limit', $invoice_discount->rule_value, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Value Limit']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('start_date', 'Start Date') !!}
                {!! Form::date('start_date', @formatDate($invoice_discount->start_date), ['class' => 'form-control w-100', 'required', 'placehoder' => 'Start Date']) !!}
                @isset($err)
                    @empty($err)
                        <p class="text-danger">{{ $err['err_start_date'] }}</p>
                    @endempty
                @endisset
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('end_date', 'End Date') !!}
                {!! Form::date('end_date', @formatDate($invoice_discount->end_date), ['class' => 'form-control w-100', 'required', 'placehoder' => 'End Date']) !!}
            </div>

            <div class="clearfix"><br /></div>

            <h4>Conditions apply</h4>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('total_invoice', 'Total Invoice') !!}
                {!! Form::number('total_invoice', null, ['class' => 'form-control w-100', 'min' => '0', 'placehoder' => 'Total Invoice']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('contact_rank', 'Contact Rank') !!}
                {!! Form::select('contact_rank', $contact_rank, $invoice_discount->group_contact_id, ['class' => 'form-select w-100', 'placehoder' => 'Contact Rank']) !!}
            </div>
        </div>

        <div class="clearfix"><br /></div>

        <div class="text-center pt-1 mt-5 pb-1">
            {!! Form::submit('Update', ['id' => 'invoice-discount-update-submit', 'class' => 'btn btn-primary btn-block bg-primary mb-3']) !!}
        </div>
    {!! Form::close() !!}
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function () {

    });
</script>
@endpush
