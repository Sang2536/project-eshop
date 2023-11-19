@extends('layouts.app')

@section('title', 'Chart')

@section('content')
<div class="container-fluit">
    <div class="row">
        <h1>Chart</h1>
        <div class="w-100">
            {!! $chart->container() !!}
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">

</script>
@endpush
