@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container">
    <h1>Profile</h1>

    <div class="row">
        {!! Form::open(['url' => route('units.store'), 'method' => 'POST', 'id' => 'unit-create-form', 'class' => 'mx-1 mx-md-4']) !!}
            <div class="col-md-6 col-lg-6 col-xl-6 mb-6">
                {!! Form::label('display_name', 'Display name') !!}
                {!! Form::text('display_name', $user->display_name, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Display name']) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        // ...
    });
</script>
@endpush
