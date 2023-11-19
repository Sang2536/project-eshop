@extends('layouts.app')

@section('title', 'Categoies')

@section('content')
<div class="container-fluid">
    <h1>Categories</h1>

    <a data-href="{{ route("categories.create") }}" role="button" class="btn btn-primary btn-block bg-primary btn-sm category_create">
        <i class="fas fa-plus fa-fw me-1"></i><span>Add Category</span>
    </a>

    <table class="table table-bordered table-striped w-100" id="category-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Code</th>
                <th>Parent Category</th>
                <th>Type</th>
                <th>Description</th>
                <th>Created By</th>
                <th style="min-width: 250px;">Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div class="modal fade" id="category-create-modal" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade" id="category-show-modal" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade" id="category-edit-modal" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('table#category-table').DataTable({
            processing: true,
            serverSide: true,
            scrollY: "75vh",
            scrollX: true,
            scrollCollapse: true,
            ajax: {
                type: "GET",
                url: "{{ route('categories.index') }}",
                data: function (d) {  }
            },
            columnDefs: [
                {
                    "targets": [0, 7],
                    "searchable": false,
                    "orderable": false,
                },
            ],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'code', name: 'code'},
                {data: 'parent_id', name: 'parent_id'},
                {data: 'type', name: 'type'},
                {data: 'description', name: 'description'},
                {data: 'created_by', name: 'created_by'},
                {data: 'action', name: 'action'},
            ],
        });
    });

    $(document).on('click', 'a.category_create', function() {
        var href_category_create = $(this).attr('data-href');

        $('div#category-create-modal').load(href_category_create, function() {
            console.log(href_category_create);
            $(this).modal('show');
        });
    });

    $(document).on('click', 'a.category_show', function() {
        var href_category_show = $(this).attr('data-href');

        $('div#category-show-modal').load(href_category_show, function() {
            $(this).modal('show');
        });
    });

    $(document).on('click', 'a.category_edit', function() {
        var href_category_edit = $(this).attr('data-href');

        $('div#category-edit-modal').load(href_category_edit, function() {
            $(this).modal('show');
        });
    });
</script>
@endpush
