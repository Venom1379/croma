@extends('layouts.app')

@section('content')
    <div class="nxl-content">

        <div class="main-content">

            <div class="row justify-content-center">

                <div class="col-lg-10">

                    <div class="card stretch stretch-full">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-4">

                                <div>
                                    <h3 class="fw-bold mb-0">Supervisor Details</h3>
                                    <p class="text-muted mb-0">View full information</p>
                                </div>

                                <div class="d-flex gap-2">

                                    <a href="{{ route('supervisors.index') }}" class="btn btn-secondary">
                                        Back
                                    </a>

                                    <a href="{{ route('supervisors.edit', $supervisor->id) }}" class="btn btn-primary">
                                        Edit
                                    </a>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Name</label>
                                    <div>{{ $supervisor->name }}</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Email</label>
                                    <div>{{ $supervisor->email }}</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Contact</label>
                                    <div>{{ $supervisor->contact ?? '-' }}</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Alternate Contact</label>
                                    <div>{{ $supervisor->alt_contact ?? '-' }}</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">DOB</label>
                                    <div>
                                        {{ $supervisor->dob ? \Carbon\Carbon::parse($supervisor->dob)->format('d-m-Y') : '-' }}
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Gender</label>
                                    <div>{{ ucfirst($supervisor->gender ?? '-') }}</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Status</label>

                                    <div>

                                        @if ($supervisor->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif

                                    </div>

                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold">Address</label>
                                    <div>{{ $supervisor->address ?? '-' }}</div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold">Remark</label>
                                    <div>{{ $supervisor->remark ?? '-' }}</div>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <h5 class="fw-bold">Documents</h5>
                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="fw-bold">Photo</label>

                                    <div>

                                        @if ($supervisor->photo)
                                            <a href="{{ asset($supervisor->photo) }}" target="_blank">

                                                <img src="{{ asset($supervisor->photo) }}"
                                                    style="width:120px;border-radius:8px;">

                                            </a>
                                        @else
                                            -
                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
