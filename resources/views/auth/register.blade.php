@extends('layouts.app')

@section('title', 'Register')

@section('content')
<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

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

                                {!! Form::open(['route' => ('register-user'), 'method' => 'POST', 'id' => 'register-form', 'class' => 'mx-1 mx-md-4']) !!}
                                    <div class="w-100">
                                        <div class="form-group">
                                            {!! Form::label('name', 'Username') !!}
                                            {!! Form::text('name', null, ['class' => 'form-control w-100', 'placehoder' => 'Username']) !!}
                                        </div>
                                    </div>

                                    <div class="clearfix"><br /></div>

                                    <div class="w-100">
                                        <div class="form-group">
                                            {!! Form::label('email', 'Email') !!}
                                            {!! Form::email('email', null, ['class' => 'form-control w-100', 'placehoder' => 'Email']) !!}
                                        </div>
                                    </div>

                                    <div class="clearfix"><br /></div>

                                    <div class="w-100">
                                        <div class="form-group">
                                            {!! Form::label('password', 'Password') !!}
                                            {!! Form::password('password', ['class' => 'form-control w-100', 'placehoder' => 'Password']) !!}
                                        </div>
                                    </div>

                                    <div class="clearfix"><br /></div>

                                    <div class="w-100">
                                        <div class="form-group">
                                            {!! Form::label('repeat-password', 'Repeat Password') !!}
                                            {!! Form::password('repeat-password', ['class' => 'form-control w-100', 'placehoder' => 'Repeat Password']) !!}
                                        </div>
                                    </div>

                                    <div class="clearfix"><br /></div>

                                    <div class="text-center pt-1 mt-5 pb-1">
                                        {!! Form::submit('Register', ['id' => 'register-submit', 'class' => 'btn btn-primary btn-block bg-primary mb-3']) !!}
                                    </div>
                                {!! Form::close() !!}
                            </div>

                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                    class="img-fluid" alt="Sample image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script type="text/javascript">

</script>
@endpush
