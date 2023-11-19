@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluit">
    <h1>Dashboard</h1>

    <div class="row mb-4">
        <div class="col-md-12 col-lg-12 col-xl-12 mb-4 d-flex flex-row">
            <h3>Year: </h3>
            {!! Form::select('year', ['2020' => 2020, '2021' => 2021, '2022' => 2022, '2023' => 2023], '2023', ['class w-10' => 'form-select', 'required']) !!}
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-8 col-lg-8 col-xl-8 mb-4">
            <div class="row">
                @foreach ($amount as $key => $value)
                    <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                        <div class="bg-image text-center rounded" style="background-image: url('https://khoinguonsangtao.vn/wp-content/uploads/2022/09/hinh-nen-cay-co-va-suong.jpg'); height: 15vh">
                            <h4>{{ $key }}</h4>
                            <h3>{{ $value }}<i class="fa-solid fa-dong-sign"></i></h3>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                    <div class="bg-image text-center rounded" style="background-image: url('https://khoinguonsangtao.vn/wp-content/uploads/2022/09/hinh-nen-cay-co-va-suong.jpg'); height: 15vh">
                        <h4>Contact</h4>
                        <h3>{{ $contact['quantity'] }} Members</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
            <img src="https://img.freepik.com/free-photo/peaceful-view-sunset-light_23-2148851752.jpg" class="img-thumbnail" alt="...">
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12 col-lg-12 col-xl-12 mb-4">
            {!! $chart->container() !!}
            <h4 class="text-center">Monthly revenue chart</h4>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 col-lg-6 col-xl-6 mb-4">
            <h3>Top customers</h3>
            <ul class="list-group mb-4">
                @foreach ($top['top_customer'] as $key => $value)
                    <li class="list-group-item">{{ $value['contact_id'] }} - {{ formatCurrency($value['total_amount_by_contact']) }}<i class="fa-solid fa-dong-sign"></i></li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-6 col-lg-6 col-xl-6 mb-4">
            <h3>Top supplier</h3>
            <ul class="list-group mb-4">
                @foreach ($top['top_purchase'] as $key => $value)
                    <li class="list-group-item">{{ $value['contact_id'] }} - {{ formatCurrency($value['total_amount_by_contact']) }}<i class="fa-solid fa-dong-sign"></i></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 col-lg-6 col-xl-6 mb-4">
            <h3>Top product</h3>
            <table class="table table-bordered table-striped w-100" id="contact-table">
                <thead>
                    <tr>
                        <th>Id.</th>
                        <th class="text-center">Name</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($top['top_product'] as $key => $value)
                        <tr>
                            <td>{{ $value['product_id'] }}</td>
                            <td>{{ $value['product_name'] }}</td>
                            <td class="text-center" style="min-width: 100px;">{{ $value['total_quantity_by_product'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-6 mb-4">
            {!! $chart_product->container() !!}
            <h5 class="text-center">Best-selling products chart</h5>
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">

</script>
@endpush
