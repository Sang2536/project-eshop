@extends('layouts.app')

@section('title', 'Transactions')

@section('content')
<div class="container">
    <h1>Transactions</h1>

    <a href="{{ route("transactions.create") }}" role="button" class="btn btn-primary btn-block bg-primary btn-sm unit_create">
        <i class="fas fa-plus fa-fw me-1"></i><span>Add transaction</span>
    </a>

    <table class="table table-bordered table-striped" id="transaction-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Code</th>
                <th style="min-width: 150px;">Contact</th>
                <th>Transaction type</th>
                <th>Transaction date</th>
                <th style="min-width: 80px;">Total amount</th>
                <th style="min-width: 280px;">Payment info</th>
                <th style="min-width: 100px;">Created by</th>
                <th style="min-width: 250px;">Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div class="modal fade" id="transaction-show-modal" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('table#transaction-table').DataTable({
            processing: true,
            serverSide: true,
            scrollY: "75vh",
            scrollX: true,
            scrollCollapse: true,
            ajax: {
                type: "GET",
                url: "{{ route('transactions.index') }}",
                data: function (d) {  }
            },
            columnDefs: [
                {
                    "targets": [0, 2, 8],
                    "orderable": false,
                    "searchable": false,
                },
            ],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'code', name: 'code'},
                {data: 'contact_name', name: 'contact_name'},
                {data: 'transaction_type', name: 'transaction_type'},
                {data: 'transaction_date', name: 'transaction_date'},
                {data: 'total_amount', name: 'total_amount'},
                {data: 'payment_info', name: 'payment_info'},
                {data: 'tran_created_by', name: 'tran_created_by'},
                {data: 'action', name: 'action'},
            ],
        });
    });

    $(document).on('click', 'a.transaction_show', function() {
        var href_transaction_show_modal = $(this).attr('data-href');

        $('div#transaction-show-modal').load(href_transaction_show_modal, function() {
            $(this).modal('show');
        });
    });
</script>
@endpush
