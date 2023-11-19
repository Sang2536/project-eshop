@extends('layouts/app')

@section('title', 'Units')

@section('content')
<div class="container-fluid">
    <h1>Units</h1>

    <a data-href="{{ route("units.create") }}" role="button" class="btn btn-primary btn-block bg-primary btn-sm unit_create">
        <i class="fas fa-plus fa-fw me-1"></i><span>Add Unit</span>
    </a>

    <table class="table table-bordered table-striped w-100" id="unit-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Abbr</th>
                <th>Short Descripton</th>
                <th>Created By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div class="modal fade" id="unit-create-modal" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade" id="unit-show-modal" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade" id="unit-edit-modal" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
</div>
@endsection

@push('script')
<script>
    $(document).ready(function () {
        $('table#unit-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                type: "GET",
                url: "{{ route('units.index') }}",
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
                {data: 'name', name: 'name'},
                {data: 'abbr', name: 'abbr'},
                {data: 'short_description', name: 'short_description'},
                {data: 'created_by', name: 'created_by'},
                {data: 'action', name: 'action'},
            ],
        });
    });

    $(document).on('click', 'a.unit_create', function() {
        var href_unit_create_modal = $(this).attr('data-href');

        $('div#unit-create-modal').load(href_unit_create_modal, function() {
            $(this).modal('show');
        });
    });

    $(document).on('click', 'a.unit_show', function() {
        var href_unit_show_modal = $(this).attr('data-href');

        $('div#unit-show-modal').load(href_unit_show_modal, function() {
            $(this).modal('show');
        });
    });

    $(document).on('click', 'a.unit_edit', function() {
        var href_unit_edit_modal = $(this).attr('data-href');

        $('div#unit-edit-modal').load(href_unit_edit_modal, function() {
            $(this).modal('show');
        });
    });
</script>
@endpush
