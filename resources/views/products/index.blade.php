@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container-fluit">
    <h1>Products</h1>

    <a href=" {{ route("products.create") }}" id="product-create" class="btn btn-primary btn-block bg-primary btn-sm">
        <i class="fas fa-plus fa-fw me-1"></i><span>Add Product</span>
    </a>

    <table class="table table-bordered table-striped w-100" id="product-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Photo</th>
                <th style="min-width: 250px;">Name</th>
                <th>SKU</th>
                <th>Category</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Price Buy</th>
                <th>Price Sale</th>
                <th>Created By</th>
                <th style="min-width: 250px;">Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div class="modal fade" id="product-show-modal" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('table#product-table').DataTable({
            processing: true,
            serverSide: true,
            scrollY: "75vh",
            scrollX: true,
            scrollCollapse: true,
            ajax: {
                type: "GET",
                url: "{{ route('products.index') }}",
                data: function (d) {  }
            },
            columnDefs: [
                {
                    "targets": [0, 5],
                    "orderable": false,
                    "searchable": false,

                },
            ],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'photo', name: 'photo'},
                {data: 'name', name: 'name'},
                {data: 'sku', name: 'sku'},
                {data: 'category_name', name: 'category_name'},
                {data: 'type', name: 'type'},
                {data: 'quantity', name: 'quantity'},
                {data: 'unit_name', name: 'unit_name'},
                {data: 'price_buy', name: 'price_buy'},
                {data: 'price_sale', name: 'price_sale'},
                {data: 'created_by', name: 'created_by'},
                {data: 'action', name: 'action'},
            ],
        });
    });

    $(document).on('click', 'a.product_show', function() {
        var href_product_show_modal = $(this).attr('data-href');

        $('div#product-show-modal').load(href_product_show_modal, function() {
            $(this).modal('show');
        });
    });
</script>
@endpush
