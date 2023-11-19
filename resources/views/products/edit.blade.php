@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container-fluit">
    <h1>Product Edit</h1>

    {!! Form::open(['url' => route('products.update', $product->id), 'method' => 'PUT', 'id' => 'create-edit-form', 'class' => 'mx-1 mx-md-4', 'files' => true]) !!}
        <div class="row">
            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', $product->name, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Name']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('sku', 'SKU (Cannot be edited*)') !!}
                {!! Form::text('sku', $product->sku, ['class' => 'form-control w-100', 'required', 'readonly', 'placehoder' => 'Sku']) !!}
            </div>

            <div class="clearfix"><br /></div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('category_id', 'Category') !!}
                {!! Form::select('category_id', $categories, $product->category_id, ['class' => 'form-select w-100', 'required', 'placehoder' => 'Category']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('type', 'Type') !!}
                {!! Form::select('type', $types, $product->type, ['class' => 'form-select w-100', 'required', 'placehoder' => 'Type']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('quantity', 'Quantity') !!}
                {!! Form::number('quantity', $product->quantity, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Quantity', 'min' => '0']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('unit_id', 'Unit') !!}
                {!! Form::select('unit_id', $units, $product->unit_id, ['class' => 'form-select w-100', 'required', 'placehoder' => 'Unit']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('price_buy', 'Price Buy') !!}
                {!! Form::number('price_buy', $product->price_buy, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Price Buy', 'min' => '0']) !!}
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                {!! Form::label('price_sale', 'Price Sale') !!}
                {!! Form::number('price_sale', $product->price_sale, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Price Sale', 'min' => '0']) !!}
            </div>

            <div class="clearfix"><br /></div>

            <div class="col-md-6 col-lg-6 col-xl-6 mb-4">
                {!! Form::label('photo', 'Photo') !!}
                {!! Form::file('photo', $product->photo, ['id' => 'photo', 'accept' => 'image/*', 'class' => 'form-control-file w-100']); !!}
            </div>

            <div class="col-md-6 col-lg-6 col-xl-6 mb-4">
                <div class="form-group">
                    {!! Form::label('short_description', 'Short Description') !!}
                    {!! Form::textarea('short_description', $product->short_description, ['class' => 'form-control w-100', 'placehoder' => 'Short Descripton']) !!}
                </div>
            </div>
        </div>

        <div class="clearfix"><br /></div>

        <div class="text-center pt-1 mt-5 pb-1">
            {!! Form::submit('Update', ['id' => 'product-update-submit', 'class' => 'btn btn-primary btn-block bg-primary mb-3']) !!}
        </div>
    {!! Form::close() !!}
</div>
@endsection

@push('script')
<script type="text/javascript"></script>
@endpush
