@extends('layouts.app')

@section('title', 'Roles')

@section('content')
    <div class="container">
        <h1>Roles</h1>

        <a href=" {{ route("roles.create") }}" role="button" class="btn btn-primary btn-block bg-primary">
            <i class="fas fa-plus fa-fw me-3"></i><span>Add</span>
        </a>

        <table class="table table-bordered table-striped" id="role-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Role Id</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Roles</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('table#role-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                type: 'GET',
                url: "{{ route('roles.index') }}",
                data: function (d) {  }
            },
            columnDefs: [
                {
                    "targets": [1, 2, 3, 4, 5, 6],
                    "orderable": false,
                    "searchable": false,
                },
            ],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'rid', name: 'rid'},
                {data: 'name', name: 'name'},
                {data: 'type', name: 'type'},
                {data: 'roles', name: 'roles'},
                {data: 'description', name: 'description'},
                {data: 'action', name: 'action'},
            ]
        });
    });
</script>
@endpush
