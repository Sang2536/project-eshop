@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container-fluit">
    <h1>Product Create</h1>

    {!! Form::open(['url' => route('products.store'), 'method' => 'POST', 'id' => 'create-create-form', 'class' => 'mx-1 mx-md-4', 'files' => true]) !!}
        <div class="row">
            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Name']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('sku', 'SKU (*will not be editable after creation)') !!}
                {!! Form::text('sku', null, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Sku']) !!}
            </div>

            <div class="clearfix"><br /></div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('category_id', 'Category') !!}
                {!! Form::select('category_id', $categories, null, ['class' => 'form-select w-100', 'required', 'placehoder' => 'Category']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('type', 'Type') !!}
                {!! Form::select('type', $types, 'single', ['class' => 'form-select w-100', 'required', 'placehoder' => 'Type']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('quantity', 'Quantity') !!}
                {!! Form::number('quantity', 0, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Quantity', 'min' => '0']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('unit_id', 'Unit') !!}
                {!! Form::select('unit_id', $units, null, ['class' => 'form-select w-100', 'required', 'placehoder' => 'Unit']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('price_buy', 'Price Buy') !!}
                {!! Form::number('price_buy', 0, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Price Buy', 'min' => '0']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('price_sale', 'Price Sale') !!}
                {!! Form::number('price_sale', 0, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Price Sale', 'min' => '0']) !!}
            </div>

            <div class="clearfix"><br /></div>

            <div class="col-md-6 col-lg-6 col-xl-6 mb-4">
                {!! Form::label('photo', 'Photo') !!}
                {!! Form::file('photo', ['id' => 'photo', 'accept' => 'image/*', 'class' => 'form-control-file w-100']); !!}
            </div>

            <div class="col-md-6 col-lg-6 col-xl-6 mb-4">
                <div class="form-group">
                    {!! Form::label('short_description', 'Short Description') !!}
                    {!! Form::textarea('short_description', null, ['class' => 'form-control w-100', 'placehoder' => 'Short Descripton']) !!}
                </div>
            </div>
        </div>

        <div class="clearfix"><br /></div>

        <div class="text-center pt-1 mt-5 pb-1">
            {!! Form::submit('Add', ['id' => 'product-create-submit', 'class' => 'btn btn-primary btn-block bg-primary mb-3']) !!}
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
