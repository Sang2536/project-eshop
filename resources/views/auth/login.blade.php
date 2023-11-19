@extends('layouts.app')

@section('title', 'Login')

@section('content')
<section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body mx-md-4">
                                <div class="text-center">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                                    style="width: 185px;" alt="logo">
                                    <h4 class="mt-1 mb-5 pb-1">Administrator</h4>
                                </div>

                                @if (count($errors) > 0)
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li class="text-danger"> {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if (session('message'))
                                    <ul>
                                        <li class="text-danger"> {{ session('message') }}</li>
                                    </ul>
                                @endif

                                {!! Form::open(['route' => ('login-user'), 'method' => 'post', 'id' => 'login-form', 'class' => 'mx-1 mx-md-4']) !!}
                                    {{ csrf_field() }}
                                    <p>Please login to your account</p>

                                    <div class="w-100">
                                        <div class="form-group">
                                            {!! Form::label('email', 'Email') !!}
                                            {!! Form::email('email', null, ['class' => 'form-control w-100', 'placeholder' => 'Email']); !!}
                                        </div>
                                    </div>

                                    <div class="clearfix"><br /></div>

                                    <div class="w-100">
                                        <div class="form-group">
                                            {!! Form::label('password', 'Password') !!}
                                            {!! Form::password('password', ['class' => 'form-control w-100', 'placeholder' => 'Password']) !!}
                                        </div>
                                    </div>

                                    <div class="clearfix"><br /></div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        {!! Form::submit('Login', ['id' => 'login-submit', 'class' => 'btn btn-primary btn-block bg-primary mb-3 w-100']) !!}
                                        <a class="text-muted" href="#!">Forgot password?</a>
                                    </div>
                                {!! Form::close() !!}

                                <div class="d-flex align-items-center justify-content-center pb-4">
                                    <p class="mb-0 me-2">Don't have an account?</p>
                                    <a class="btn btn-outline-danger" href="/register" role="button">Register</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center bg-image" style="background-image: url('https://vapa.vn/wp-content/uploads/2022/12/avatar-phong-canh-004.jpg'); background-repeat: no-repeat; background-size: cover;">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                <h4 class="mb-4">We are more than just a company</h4>
                                <p class="small mb-0">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
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
