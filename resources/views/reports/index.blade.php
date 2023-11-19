@extends('layouts.app')

@section('title', 'Reports')

@section('content')
    <div class="py-2">
        <!-- Custom Tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#report_general" data-toggle="tab"><i class="fa fa-cubes me-2"></i>General</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#report_purchase" data-toggle="tab"><i class="fa fa-hourglass-half me-2"></i>Puchase</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#report_sale" data-toggle="tab"><i class="fa fa-hourglass-half me-2"></i>Sale</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#report_prfit" data-toggle="tab"><i class="fa fa-hourglass-half me-2"></i>Profit</a>
            </li>
        </ul>

        <div class="tab-content py-2">
            <div class="tab-pane active" id="report_general">
                <h4>Report General</h4>
                @include('reports.report_general')
            </div>
            <div class="tab-pane" id="report_purchase">
                <h4>Report Purchase</h4>
            </div>
            <div class="tab-pane" id="report_sale">
                <h4>Report Sale</h4>
            </div>
            <div class="tab-pane" id="report_prfit">
                <h4>Report Profit</h4>
                @include('reports.report_profit')
            </div>
        </div>
    </div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {});
    });
</script>
@endpush
