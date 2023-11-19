@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container">
    <h1>Profile</h1>

    <div>
        <h4>{{ $user->name }}</h4>
        <h4>{{ $user->display_name }}</h4>
        <h4>{{ $user->uid }}</h4>
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
