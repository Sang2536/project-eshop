@extends('layouts.app')

@section('title', 'Invoice Discounts')

@section('content')
<div class="container-fluit">
    <h1>Invoice Discounts</h1>

    <a href=" {{ route("invoce-discounts.create") }}" id="invoce-discount-create" class="btn btn-primary btn-block bg-primary btn-sm">
        <i class="fas fa-plus fa-fw me-1"></i><span>Add Discount</span>
    </a>

    <table class="table table-bordered table-striped w-100" id="invoce-discount-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Code</th>
                <th>Quantity</th>
                <th>Type</th>
                <th>Value</th>
                <th>Created By</th>
                <th style="min-width: 250px;">Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div class="modal fade" id="invoice-discount-show-modal" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('table#invoce-discount-table').DataTable({
            processing: true,
            serverSide: true,
            scrollY: "75vh",
            scrollX: true,
            scrollCollapse: true,
            ajax: {
                type: "GET",
                url: "{{ route('invoce-discounts.index') }}",
                data: function (d) {  }
            },
            columnDefs: [
                {
                    "targets": [0, 7],
                    "orderable": false,
                    "searchable": false,

                },
            ],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'code', name: 'code'},
                {data: 'quantity', name: 'quantity'},
                {data: 'type', name: 'type'},
                {data: 'value', name: 'value'},
                {data: 'created_by', name: 'created_by'},
                {data: 'action', name: 'action'},
            ],
        });
    });

    $(document).on('click', 'a.invoice_discount_show', function() {
        var href_invoice_discount_show_modal = $(this).attr('data-href');

        $('div#invoice-discount-show-modal').load(href_invoice_discount_show_modal, function() {
            $(this).modal('show');
        });
    });
</script>
@endpush
