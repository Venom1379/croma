@extends('layouts.app')

@section('content')
    <div class="nxl-content">

        <div class="page-header">
            <div class="page-header-left">
                <h5>Companies</h5>
            </div>

            <div class="page-header-right ms-auto">
                <a href="javascript:void(0)" class="btn btn-primary" id="addCompany">
                    Add Company
                </a>
            </div>
        </div>


        <div class="card">
            <div class="card-body">

                <table class="table table-hover" id="companyTable">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                </table>

            </div>
        </div>

    </div>


    {{-- MODAL --}}

    <div class="modal fade" id="companyModal">
        <div class="modal-dialog">

            <form id="companyForm">
                @csrf

                <input type="hidden" id="company_id">
                <input type="hidden" id="method">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 id="modalTitle">Add Company</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Contact</label>
                            <input type="number" name="contact" id="contact" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Address</label>
                            <textarea name="address" id="address" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <select name="is_active" id="is_active" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success">Save</button>
                    </div>

                </div>

            </form>

        </div>
    </div>


    {{-- DATATABLE --}}

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


    <script>
        $(function() {

            let table = $('#companyTable').DataTable({

                processing: true,
                serverSide: true,

                ajax: "{{ route('companies.datatable') }}",

                columns: [

                    {
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'contact'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action'
                    }

                ]

            });


            // ADD
            $('#addCompany').click(function() {

                $('#modalTitle').text('Add Company');

                $('#companyForm')[0].reset();

                $('#method').val('POST');

                $('#companyModal').modal('show');

            });


            // EDIT

            $(document).on('click', '.editBtn', function() {

                let id = $(this).data('id');

                $.get("{{ route('companies.edit', ':id') }}".replace(':id', id), function(data) {

                    $('#modalTitle').text('Edit Company');

                    $('#company_id').val(data.id);

                    $('#name').val(data.name);

                    $('#contact').val(data.contact);

                    $('#email').val(data.email);

                    $('#address').val(data.address);

                    $('#is_active').val(data.is_active);

                    $('#method').val('PUT');

                    $('#companyModal').modal('show');

                });

            });


            // SAVE

            $('#companyForm').submit(function(e) {

                e.preventDefault();

                let id = $('#company_id').val();

                let method = $('#method').val();

                let url = method == 'PUT' ?
                    "/companies/update/" + id :
                    "{{ route('companies.store') }}";

                $.ajax({

                    url: url,

                    type: method == 'PUT' ? 'POST' : 'POST',

                    data: $(this).serialize(),

                    success: function() {

                        $('#companyModal').modal('hide');

                        table.ajax.reload();

                    }

                });

            });


            // DELETE

            $(document).on('click', '.deleteBtn', function() {

                if (confirm('Delete company?')) {

                    let id = $(this).data('id');

                    $.ajax({

                        url: "/admin/companies/delete/" + id,

                        type: 'DELETE',

                        data: {
                            _token: '{{ csrf_token() }}'
                        },

                        success: function() {

                            table.ajax.reload();

                        }

                    });

                }

            });

        });
    </script>
@endsection
