@extends('layouts.app')

@section('title', 'Configs')

@section('content')
<div class="container-fluid">
    <h1>Configs</h1>

    {!! Form::open(['url' => route('configs.update', 1), 'method' => 'PUT', 'id' => 'config-form', 'class' => 'mx-1 mx-md-4', 'files' => true]) !!}
    <div class="row">
        <h4>Website</h4>
        <div class="col-md-6 col-lg-6 col-xl-4 mb-4">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', $config->name, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Name']) !!}
        </div>

        <div class="col-md-6 col-lg-6 col-xl-4 mb-4">
            {!! Form::label('satus', 'Status') !!} <br />
            {!! Form::checkbox('status', $config->status, ($config->status == 'active') ? true : false, ['class' => 'form-check-input', 'required']) !!}
            Active
        </div>

        <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
            {!! Form::label('start_date', 'Start date') !!}
            {!! Form::date('start_date', $config->start_date, ['class' => 'form-control w-100 bg-secondary', 'required', 'readonly']) !!}
        </div>

        <div class="clearfix"><br /></div>

        <div class="col-md-6 col-lg-6 col-xl-4 mb-4">
            {!! Form::label('logo', 'Logo') !!}
            {!! Form::file('logo', ['id' => 'photo', 'accept' => 'image/*', 'class' => 'form-control-file w-100 mb-4']); !!}
            <img src="{{ $config->logo }}" class="rounded mx-auto d-block" width="100%" height="250px" alt="logo" />
        </div>

        <div class="col-md-6 col-lg-6 col-xl-4 mb-4">
            {!! Form::label('logo_icon', 'Logo icon') !!}
            {!! Form::file('logo_icon', ['id' => 'photo', 'accept' => 'image/*', 'class' => 'form-control-file w-100 mb-4']); !!}
             <img src="{{ $config->logo_icon }}" class="rounded mx-auto d-block" width="100px" height="100px" alt="logo" />
        </div>

        <div class="clearfix"><br /></div>

        <div class="col-md-12 col-lg-12 col-xl-12 mb-4">
            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', $config->description, ['class' => 'form-control w-100', 'rows' => '6', 'placehoder' => 'Descripton']) !!}
            </div>
        </div>

        <div class="clearfix"><br /></div>
        <h4>Background</h4>

        <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
            {!! Form::label('bg_color', 'Background color') !!}
            {!! Form::text('bg_color', null, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Background color']) !!}
        </div>

        <div class="col-md-8 col-lg-8 col-xl-8 mb-4">
            {!! Form::label('options', 'Option Background Color') !!}
            <ul>
                <li>Class: [bg-primary], [bg-secondary], [bg-info], [bg-danger], [bg-success], [bg-warning], [bg-dark]</li>
                <li>Style: [background-color: lightblue], [background-color: yellow]</li>
            </ul>
        </div>

        <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
            {!! Form::label('bg_image', 'Background image') !!}
            {!! Form::file('bg_image', null, ['id' => 'bg-image', 'accept' => 'image/*', 'class' => 'form-control-file w-100']); !!}
        </div>

        <div class="clearfix"><br /></div>
        <h4>Font</h4>

        <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
            {!! Form::label('font_family', 'Font family') !!}
            {!! Form::text('font_family', null, ['class' => 'form-control w-100', 'required', 'placehoder' => 'Font family']) !!}
        </div>

        <div class="col-md-8 col-lg-8 col-xl-8 mb-4">
            {!! Form::label('options', 'Option Fonts') !!}
            <ul>
                <li>Sans-Serif: [Arial, Helvetica, sans-serif], [Geneva, Verdana, sans-serif], [Tahoma, Verdana, sans-serif], ["Sofia", sans-serif], ["Audiowide", sans-serif]</li>
                <li>Monospace: ["Courier New", Courier, monospace]</li>
                <li>Cursive: ["Brush Script MT", cursive]</li>
                <li>Fantasy: [Copperplate, Papyrus, fantasy]</li>
            </ul>
        </div>

        <div class="clearfix"><br /></div>

        <div class="text-center pt-1 mt-5 pb-1">
            {!! Form::submit('Update', ['id' => 'config-submit', 'class' => 'btn btn-primary btn-block bg-primary mb-3']) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection

@push('script')
<script type="text/javascript">

</script>
@endpush
