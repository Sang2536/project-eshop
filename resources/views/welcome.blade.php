@extends('layouts.app')

@section('title', 'EShop')

@section('content')
<!-- Hero -->
<div class="text-center bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/new/slides/041.webp'); background-repeat: no-repeat; background-size: cover; height: 100vh;">
    <div class="mask h-100" style="background-color: rgba(0, 0, 0, 0.6);">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="text-white">
                <h1 class="mb-3">EShop</h1>
                <h4 class="mb-3">Welcome To The Admin Page</h4>
                <a class="btn btn-outline-light btn-lg" href="/login" role="button">Login</a>
            </div>
        </div>
    </div>
</div>
<!-- Hero -->
@endsection

