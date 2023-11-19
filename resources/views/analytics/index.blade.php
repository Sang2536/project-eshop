@extends('layouts.app')

@section('title', 'Analytics')

@section('content')
    <div>
        <h1>Analytics</h1>

        <div class="row mb-4">
            <h4 class="text-center">Market analysis</h4>

            <ul class="list-group mb-4">
                <li class="list-group-item">Scale and growth rate of each customer group</i></li>
                <li class="list-group-item">The direction the market is moving towards</i></li>
                <li class="list-group-item">Growth and market penetration capabilities</i></li>
                <li class="list-group-item">Competitors</i></li>
            </ul>
        </div>

        <div class="row mb-4">
            <div class="col-md-12 col-lg-12 col-xl-12 mb-4">
                {!! $chart->container() !!}
                <h4 class="text-center">Expected revenue chart</h4>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6 col-lg-6 col-xl-6 mb-4">
                <h4>Revenue analysis</h4>
                <table class="table table-bordered table-striped w-100" id="contact-table">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Expected amount</th>
                            <th>Profit (%)</th>
                            <th>Point evaluation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Avg 12 month</td>
                            <td>Total amount / 12</td>
                            <td>Default: 0%</td>
                            <td>Default: 5/10</td>
                        </tr>
                        @for ($i = 1; $i <= 10; $i++)
                            <tr>
                                <td>{!! $i !!}</td>
                                <td>Product {!! $i !!}</td>
                                <td>Quantity {!! $i !!}</td>
                                <td>Total amount {!! $i !!}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-6 mb-4">
                {!! $chart_transaction_flow->container() !!}
                <h4 class="text-center">Transaction flow analysis</h4>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6 col-lg-6 col-xl-6 mb-4">
                {!! $chart_product->container() !!}
                <h4 class="text-center">Best-selling product analysis chart</h4>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-6 mb-4">
                <div class="row">
                    <h4>Detailed table analyzing best-selling products</h4>
                    <table class="table table-bordered table-striped w-100" id="contact-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 10; $i++)
                                <tr>
                                    <td>{!! $i !!}</td>
                                    <td>Product {!! $i !!}</td>
                                    <td>Quantity {!! $i !!}</td>
                                    <td>Total amount {!! $i !!}</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script type="text/javascript">

</script>
@endpush
