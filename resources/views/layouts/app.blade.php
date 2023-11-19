<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <title>@yield('title')</title>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased font-monospace">
    @if (Auth::check())
        <!--Main Navigation-->
        <header>
            @include('layouts.partials.header')
        </header>
        <!--Main Navigation-->

        <!--Main layout-->
        <main class="container-fluid" style="margin-top: 60px;">
            <div class="row">
                <div class="col-2">
                    @include('layouts.partials.sidebar')
                </div>

                <div class="col-10 content-wrapper px-4 bg-secondary-subtle">
                    @yield('content')
                </div>
            </div>
        </main>
        <!--Main layout-->
    @else
        <div class="wrapper thetop">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    @endif

    <!-- Script-->
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

    @isset($chart)
        {!! $chart->script() !!}
    @endisset

    @isset($chart)
        {!! $chart_product->script() !!}
    @endisset

    @isset($chart_transaction_flow)
        {!! $chart_transaction_flow->script() !!}
    @endisset

    @stack('script')
    <!-- Script-->
</body>
</html>
