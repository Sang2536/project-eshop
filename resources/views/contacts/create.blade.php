@extends('layouts.app')

@section('title', 'Create Contact')

@section('content')
    <div class="container">
        <div class="order-2 order-lg-1">
            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Add Contact</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('message'))
                <ul>
                    <li class="text-danger"> {{ session('message') }}</li>
                </ul>
            @endif

            {!! Form::open(['route' => ('contacts.store'), 'method' => 'POST', 'id' => 'contact-create-form', 'class' => 'mx-1 mx-md-4', 'files' => true]) !!}
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-4 mb-4">
                        {!! Form::label('emai', 'Email') !!}
                        {!! Form::text('email', null, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Email']) !!}
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-4 mb-4">
                        {!! Form::label('prefix', 'Prefix') !!}
                        {!! Form::select('prefix', ['mr' => 'Mr.', 'mrs' => 'Mrs.'], null, ['class' => 'form-select w-100', 'placehoder' => 'Prefix']) !!}
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-4 mb-4">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Name']) !!}
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-4 mb-4">
                        {!! Form::label('address', 'Addres') !!}
                        {!! Form::text('address', null, ['class' => 'form-control w-100', 'placehoder' => 'Address']) !!}
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-4 mb-4">
                        {!! Form::label('phone', 'Phone') !!}
                        {!! Form::text('phone', null, ['class' => 'form-control w-100', 'placehoder' => 'Phone']) !!}
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-4 mb-4">
                        {!! Form::label('status', 'Status') !!}
                        {!! Form::select('status', ['active' => 'Active', 'inactive' => 'Inactive', 'blocked' => 'Blocked'], 'active', ['class' => 'form-select w-100', 'placehoder' => 'Status']) !!}
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-4 mb-4">
                        {!! Form::label('type', 'Type') !!}
                        {!! Form::select('type', ['customer' => 'Customer', 'supplier' => 'Supplier', 'both' => 'Both'], 'customer', ['class' => 'form-select w-100', 'placehoder' => 'Status']) !!}
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-4 mb-4">
                        {!! Form::label('rank', 'Rank') !!}
                        {!! Form::select('rank', ['bronze' => 'Bronze', 'silver' => 'Silver', 'gold' => 'Gold', 'platinum' => 'Platinum', 'diamond' => 'Diamond'], 'customer', ['class' => 'form-select w-100', 'placehoder' => 'Status']) !!}
                    </div>

                    <div class="clearfix"><br /></div>

                    <div class="col-md-6 col-lg-6 col-xl-4 mb-4">
                        {!! Form::label('photo', 'Photo') !!}
                        {!! Form::file('photo', ['id' => 'photo', 'accept' => 'image/*', 'class' => 'form-control-file w-100']); !!}
                    </div>

                    <div class="clearfix"><br /></div>

                    <div class="text-center pt-1 mt-5 pb-1">
                        {!! Form::submit('Add', ['id' => 'contact-create-submit', 'class' => 'btn btn-primary btn-block bg-primary mb-3']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
    </script>
@endpush

