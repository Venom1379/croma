@extends('layouts.app')
@section('content')

<div class="nxl-content">
    <div class="main-content">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body">

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h3 class="fw-bold mb-0">Supervisor</h3>
                             
                            </div>
                            <div>
                                <a href="{{ route('supervisors.create') }}" class="btn btn-primary">
                                    + Create Supervisors
                                </a>
                            </div>
                        </div>

       
                        <div class="table-responsive">
                            <table class="table table-hover" id="usersTable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                    
                                        <th>Status</th>
                                        <th width="220px">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- REQUIRED JS -->


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


<script>
$(document).ready(function () {

    let table = $('#usersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('supervisors.datatable') }}",
            data: function (d) {
                d.role = $('#roleFilter').val();
                d.status = $('#statusFilter').val();
            }
        },
        columns: [
    { data: 'id', name: 'id' },
    { data: 'name', name: 'name' },
    { data: 'email', name: 'email' },
    { data: 'contact', name: 'contact' },

    { data: 'status', name: 'status', orderable:false, searchable:false },
    { data: 'action', name: 'action', orderable:false, searchable:false },
]

    });

    // Filters reload
    $('#roleFilter, #statusFilter').on('change', function () {
        table.ajax.reload();
    });

    // Delete
    $(document).on('click', '.btn-delete', function () {

        let id = $(this).data('id');

        if (!confirm("Are you sure you want to delete this user?")) {
            return;
        }

        $.ajax({
            url: "/supervisors/delete/" + id,
            type: "DELETE",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (res) {
                if (res.status) {
                    table.ajax.reload();
                    alert(res.message);
                }
            }
        });
    });

});
</script>

@endsection
