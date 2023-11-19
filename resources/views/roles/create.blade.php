@extends('layouts.app')

@section('title', 'Add Roles')

@section('content')
    <div class="container">
        <div class="order-2 order-lg-1">
            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Add Role</p>

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

            {!! Form::open(['route' => ('role.store'), 'method' => 'POST', 'id' => 'role-create-form', 'class' => 'mx-1 mx-md-4']) !!}
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-4">
                        <div class="form-group">
                            {!! Form::label('name', 'Role name') !!}
                            {!! Form::text('name', null, ['class' => 'form-control w-100', 'placehoder' => 'Role name']) !!}
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-4">
                        <div class="form-group">
                            {!! Form::label('type', 'Role type') !!}
                            {!! Form::select('type', ['other' => 'other', 'administrator' => 'administrator', 'admin' => 'admin', 'collaborators' => 'collaborators'], null, ['class' => 'form-select w-100', 'placehoder' => 'Type']) !!}
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-4">
                        <div class="form-group">
                            {!! Form::label('descripton', 'Description') !!}
                            {!! Form::textarea('descripton', null, ['class' => 'form-control w-100', 'placehoder' => 'Descripton']) !!}
                        </div>
                    </div>

                    <div class="clearfix"><br /></div>

                    @include('roles/role')

                    <div class="clearfix"><br /></div>

                    <div class="text-center pt-1 mt-5 pb-1">
                        {!! Form::submit('Add', ['id' => 'role-create-submit', 'class' => 'btn btn-primary btn-block bg-primary mb-3']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('script')
@endpush
