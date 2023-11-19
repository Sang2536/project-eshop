@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container">
    <h1>Users</h1>
    <table class="table table-bordered table-striped" id="user-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>User Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Display Name</th>
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
        $('table#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                type: "GET",
                url: "{{ route('users.index') }}",
                data: function (d) {  }
            },
            columnDefs: [
                {
                    "targets": [1, 2, 3, 4, 5],
                    "orderable": false,
                    "searchable": false,
                },
            ],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'uid', name: 'uid'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'display_name', name: 'display_name'},
                {data: 'action', name: 'action'},
            ],
        });
    });
</script>
@endpush
