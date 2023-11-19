@extends('layouts.app')

@section('title', 'Create Invoice Discount')

@section('content')
<div class="container-fluit">
    <h1>Create Invoice Discount</h1>

    {!! Form::open(['url' => route('invoce-discounts.store'), 'method' => 'POST', 'id' => 'invoce-discount-create-form', 'class' => 'mx-1 mx-md-4', 'files' => true]) !!}
        <div class="row">
            <h4>Infomation</h4>
            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Name']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('code', 'Code') !!}
                {!! Form::text('code', null, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Code']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('quantity', 'Quantity') !!}
                {!! Form::number('quantity', 0, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Quantity', 'min' => '0']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('type', 'Type') !!}
                {!! Form::select('type', ['fixed' => 'Fixed amount', 'percent' => 'Percent invoice', 'gift' => 'Gift'], 'voucher', ['class' => 'form-select w-100', 'required', 'placehoder' => 'Type']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('value', 'Value') !!}
                {!! Form::text('value', null, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Value']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('value_limit', 'Value Limit') !!}
                {!! Form::number('value_limit', null, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Value Limit']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('start_date', 'Start Date') !!}
                {!! Form::date('start_date', \Carbon\Carbon::now(), ['class' => 'form-control w-100', 'required', 'placehoder' => 'Start Date']) !!}
                @isset($err)
                    @empty($err)
                        <p class="text-danger">{{ $err['err_start_date'] }}</p>
                    @endempty
                @endisset
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('end_date', 'End Date') !!}
                {!! Form::date('end_date', \Carbon\Carbon::now(), ['class' => 'form-control w-100', 'required', 'placehoder' => 'End Date']) !!}
            </div>

            <div class="clearfix"><br /></div>

            <h4>Conditions apply</h4>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('total_invoice', 'Total Invoice') !!}
                {!! Form::number('total_invoice', 0, ['class' => 'form-control w-100', 'min' => '0', 'placehoder' => 'Total Invoice']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('contact_rank', 'Contact Rank') !!}
                {!! Form::select('contact_rank', $contact_rank, null, ['class' => 'form-select w-100', 'placehoder' => 'Contact Rank']) !!}
            </div>
        </div>

        <div class="clearfix"><br /></div>

        <div class="text-center pt-1 mt-5 pb-1">
            {!! Form::submit('Add', ['id' => 'invoice-discount-create-submit', 'class' => 'btn btn-primary btn-block bg-primary mb-3']) !!}
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
