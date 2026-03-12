@extends('layouts.app')

@section('content')
    <div class="nxl-content">
        <div class="main-content">

            <div class="row justify-content-center">
                <div class="col-lg-12">

                    <div class="card stretch stretch-full">
                        <div class="card-body">

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif


                            <div class="d-flex justify-content-between align-items-center mb-4">

                                <div>
                                    <h3 class="fw-bold mb-0">Vehicle Certificates</h3>
                                    <p class="text-muted mb-0">Manage Suraksha Certificates</p>
                                </div>

                                <div>
                                    <a href="{{ route('certificates.create') }}" class="btn btn-primary">
                                        + Create Certificate
                                    </a>
                                </div>

                            </div>


                            <div class="row mb-4">

                                <div class="col-md-3">
                                    <label class="mb-1">Supervisor</label>
                                    <select id="supervisorFilter" class="form-control">

                                        <option value="">All Supervisors</option>

                                        @foreach ($supervisors as $s)
                                            <option value="{{ $s->id }}">
                                                {{ $s->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>


                                <div class="col-md-3">
                                    <label class="mb-1">Status</label>

                                    <select id="statusFilter" class="form-control">

                                        <option value="">All Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>

                                    </select>

                                </div>

                            </div>



                            <div class="table-responsive">

                                <table class="table table-hover" id="certificateTable" style="width:100%">

                                    <thead>

                                        <tr>

                                            <th>#</th>
                                            <th>Vehicle No</th>
                                            <th>Transporter</th>
                                            <th>Certificate No</th>
                                            <th>Date</th>
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



    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>



    <script>
        $(document).ready(function() {

            let table = $('#certificateTable').DataTable({

                processing: true,
                serverSide: true,

                ajax: {
                    url: "{{ route('certificates.datatable') }}",

                    data: function(d) {

                        d.supervisor_id = $('#supervisorFilter').val();
                        d.status = $('#statusFilter').val();

                    }
                },

                columns: [

                    {
                        data: 'id'
                    },
                    {
                        data: 'vehicle'
                    },
                    {
                        data: 'transporter'
                    },
                    {
                        data: 'certificate_no'
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }

                ]

            });


            $('#supervisorFilter,#statusFilter').change(function() {

                table.ajax.reload();

            });

        });
    </script>
@endsection
