@extends('layouts.app')

@section('title', 'Contacts')

@section('content')
<div class="container-fluid">
    <h1>Contacts</h1>

    <a href=" {{ route("contacts.create") }}" role="button" class="btn btn-primary btn-block bg-primary">
        <i class="fas fa-plus fa-fw me-1"></i><span>Add Contact</span>
    </a>

    <table class="table table-bordered table-striped w-100" id="contact-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Photo</th>
                <th>Contact Id</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Status</th>
                <th>Type</th>
                <th>Rank</th>
                <th style="min-width: 150px;">Created by</th>
                <th style="min-width: 250px;">Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('table#contact-table').DataTable({
            processing: true,
            serverSide: true,
            scrollY: "75vh",
            scrollX: true,
            scrollCollapse: true,
            ajax: {
                type: "GET",
                url: "{{ route('contacts.index') }}",
                data: function (d) {  }
            },
            columnDefs: [
                {
                    "targets": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    "orderable": false,
                },
                {
                    "targets": [1, 10],
                    "searchable": false,
                },
            ],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'photo', name: 'photo'},
                {data: 'cid', name: 'cid'},
                {data: 'name', name: 'name'},
                {data: 'address', name: 'address'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'},
                {data: 'status', name: 'status'},
                {data: 'type', name: 'type'},
                {data: 'rank', name: 'rank'},
                {data: 'created_by', name: 'created_by'},
                {data: 'action', name: 'action'},
            ],
        });
    });
</script>
@endpush
