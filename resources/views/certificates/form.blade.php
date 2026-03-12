@extends('layouts.app')

@section('content')
    <div class="nxl-content">
        <div class="main-content">

            <div class="row">
                <div class="col-12">

                    <div class="card stretch stretch-full">
                        <div class="card-body">

                            <h4 class="fw-bold mb-4">
                                {{ $mode == 'edit' ? 'Edit Certificate' : 'Create Certificate' }}
                            </h4>

                            @if ($mode == 'edit')
                                <form action="{{ route('certificates.update', $certificate->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                @else
                                    <form action="{{ route('certificates.store') }}" method="POST"
                                        enctype="multipart/form-data">
                            @endif

                            @csrf


                            {{-- COMPANY + SUPERVISOR --}}

                            <div class="row mb-4">

                                <div class="col-md-4">

                                    <label>Company</label>

                                    <select name="company_id" class="form-control">

                                        <option value="">Select Company</option>

                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}"
                                                {{ old('company_id', $certificate->company_id ?? '') == $company->id ? 'selected' : '' }}>

                                                {{ $company->name }}

                                            </option>
                                        @endforeach

                                    </select>

                                </div>


                                <div class="col-md-4">

                                    <label>Supervisor</label>

                                    <select name="supervisor_id" id="supervisor" class="form-control">

                                        <option value="">Select Supervisor</option>

                                        @foreach ($supervisors as $supervisor)
                                            <option value="{{ $supervisor->id }}" data-contact="{{ $supervisor->contact }}"
                                                {{ old('supervisor_id', $certificate->supervisor_id ?? '') == $supervisor->id ? 'selected' : '' }}>

                                                {{ $supervisor->name }}

                                            </option>
                                        @endforeach

                                    </select>

                                </div>


                                <div class="col-md-4">

                                    <label>Supervisor Contact</label>

                                    <input type="text" name="inspection_supervisor_contact" id="supervisor_contact"
                                        class="form-control"
                                        value="{{ old('inspection_supervisor_contact', $certificate->inspection_supervisor_contact ?? '') }}">

                                </div>

                            </div>



                            {{-- VEHICLE DETAILS --}}

                            <h5 class="fw-bold mt-3 mb-3">Vehicle Details</h5>

                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label>Registration No</label>
                                    <input type="text" name="vehicle_registration_no" class="form-control"
                                        value="{{ old('vehicle_registration_no', $certificate->vehicle_registration_no ?? '') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Vehicle Make</label>
                                    <input type="text" name="vehicle_make" class="form-control"
                                        value="{{ old('vehicle_make', $certificate->vehicle_make ?? '') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Vehicle Model</label>
                                    <input type="text" name="vehicle_model" class="form-control"
                                        value="{{ old('vehicle_model', $certificate->vehicle_model ?? '') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Chassis No</label>
                                    <input type="text" name="chassis_no" class="form-control"
                                        value="{{ old('chassis_no', $certificate->chassis_no ?? '') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Engine No</label>
                                    <input type="text" name="engine_no" class="form-control"
                                        value="{{ old('engine_no', $certificate->engine_no ?? '') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Vehicle Emission Norm</label>
                                    <input type="text" name="vehicle_emission_norm" class="form-control"
                                        value="{{ old('vehicle_emission_norm', $certificate->vehicle_emission_norm ?? '') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Date of Registration</label>
                                    <input type="date" name="date_of_registration" class="form-control"
                                        value="{{ old('date_of_registration', $certificate->date_of_registration ?? '') }}">
                                </div>

                            </div>

                            <h5 class="fw-bold mt-4 mb-3">Certification Details</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3"> <label>Date of First Inspection</label> <input type="date"
                                        name="date_of_first_inspection" class="form-control"
                                        value="{{ old('date_of_first_inspection', $certificate->date_of_first_inspection ?? '') }}">
                                </div>
                                <div class="col-md-4 mb-3"> <label>Certificate Date</label> <input type="date"
                                        name="certificate_date" class="form-control"
                                        value="{{ old('certificate_date', $certificate->certificate_date ?? '') }}"> </div>
                                <div class="col-md-4 mb-3"> <label>Certificate Valid To</label> <input type="date"
                                        name="certificate_valid_to" class="form-control"
                                        value="{{ old('certificate_valid_to', $certificate->certificate_valid_to ?? '') }}">
                                </div>
                                {{-- <div class="col-md-4 mb-3"> <label>Last Suraksha Details</label> <input type="date"
                                        name="last_suraksha_details" class="form-control"
                                        value="{{ old('last_suraksha_details', $certificate->last_suraksha_details ?? '') }}">
                                </div> --}}
                               
                                <div class="col-md-4 mb-3"> <label>Client Contact</label> <input type="text"
                                        name="principal_client_contact" class="form-control"
                                        value="{{ old('principal_client_contact', $certificate->principal_client_contact ?? '') }}">
                                </div>
                            </div>

                            {{-- TANK DETAILS --}}

                            <h5 class="fw-bold mt-4 mb-3">Tank Details</h5>

                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label>Tank Type</label>
                                    <input type="text" name="tank_type" class="form-control"
                                        value="{{ old('tank_type', $certificate->tank_type ?? '') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>CCE No</label>
                                    <input type="text" name="cce_no" class="form-control"
                                        value="{{ old('cce_no', $certificate->cce_no ?? '') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Calibration</label>
                                    <input type="text" name="calibration" class="form-control"
                                        value="{{ old('calibration', $certificate->calibration ?? '') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Last Product Carried</label>
                                    <input type="text" name="last_product_carried" class="form-control"
                                        value="{{ old('last_product_carried', $certificate->last_product_carried ?? '') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Capacity</label>
                                    <input type="text" name="capacity" class="form-control"
                                        value="{{ old('capacity', $certificate->capacity ?? '') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>No of Compartments</label>
                                    <input type="number" name="no_of_compartments" class="form-control"
                                        value="{{ old('no_of_compartments', $certificate->no_of_compartments ?? '') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Compartment Details</label>
                                    <input type="text" name="compartment_details" class="form-control"
                                        value="{{ old('compartment_details', $certificate->compartment_details ?? '') }}">
                                </div>

                            </div>



                            {{-- TRANSPORTER DETAILS --}}

                            <h5 class="fw-bold mt-4 mb-3">Transporter Details</h5>

                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label>Transporter Name</label>
                                    <input type="text" name="transporter_name" class="form-control"
                                        value="{{ old('transporter_name', $certificate->transporter_name ?? '') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Contact No</label>
                                    <input type="text" name="transporter_contact" class="form-control"
                                        value="{{ old('transporter_contact', $certificate->transporter_contact ?? '') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Contact Person</label>
                                    <input type="text" name="contact_person" class="form-control"
                                        value="{{ old('contact_person', $certificate->contact_person ?? '') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Driver Name</label>
                                    <input type="text" name="driver_name" class="form-control"
                                        value="{{ old('driver_name', $certificate->driver_name ?? '') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Driver Mobile</label>
                                    <input type="text" name="driver_mobile" class="form-control"
                                        value="{{ old('driver_mobile', $certificate->driver_mobile ?? '') }}">
                                </div>

                            </div>



                            {{-- VEHICLE IMAGE --}}

                            <h5 class="fw-bold mt-4 mb-3">Vehicle Image</h5>

                            <div class="row">

                                <div class="col-md-6">

                                    <label>Upload Photo</label>

                                    <input type="file" name="vehicle_photo" class="form-control" accept="image/*">

                                </div>


                                <div class="col-md-6">

                                    <label>Scan Using Camera</label>

                                    <button type="button" class="btn btn-primary" onclick="openCamera()">Scan</button>

                                    <div id="cameraBox" style="display:none;margin-top:10px">

                                        <video id="video" width="100%" autoplay></video>

                                        <div class="mt-2">

                                            <button type="button" class="btn btn-success"
                                                onclick="capturePhoto()">Capture</button>

                                            <button type="button" class="btn btn-danger"
                                                onclick="closeCamera()">Cancel</button>

                                        </div>

                                        <canvas id="canvas" style="display:none"></canvas>

                                        <input type="hidden" name="captured_image" id="captured_image">

                                    </div>

                                    <p id="cameraError" class="text-danger"></p>

                                </div>

                            </div>



                            {{-- CHECKLIST --}}

                            @php
                                $checklistPath = resource_path('views/certificates/checklist.json');
                                $checklist = file_exists($checklistPath)
                                    ? json_decode(file_get_contents($checklistPath), true)
                                    : [];
                            @endphp

                            <h5 class="fw-bold mt-4 mb-3">Suraksha Inspection Checklist</h5>

                            <div class="row">

                                @foreach ($checklist as $item)
                                    <div class="col-md-4 mb-3">

                                        <label>{{ $item['id'] }}. {{ $item['label'] }}</label>

                                        <select name="{{ $item['key'] }}" class="form-control">

                                            <option value="">Select</option>

                                            <option value="Y">Y</option>

                                            <option value="N">N</option>

                                            <option value="NA">NA</option>

                                        </select>

                                    </div>
                                @endforeach

                            </div>



                            <div class="mt-4">

                                <button class="btn btn-primary">
                                    {{ $mode == 'edit' ? 'Update Certificate' : 'Create Certificate' }}
                                </button>

                                <a href="{{ route('certificates.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>

                            </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>



    <script>
        document.getElementById("supervisor").addEventListener("change", function() {

            let contact = this.options[this.selectedIndex].dataset.contact || '';

            document.getElementById("supervisor_contact").value = contact;

        });


        let stream;

        function openCamera() {

            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(s) {

                    stream = s;

                    document.getElementById("cameraBox").style.display = "block";

                    document.getElementById("video").srcObject = s;

                })
                .catch(function() {

                    document.getElementById("cameraError").innerText = "No camera device found";

                });

        }

        function capturePhoto() {

            let video = document.getElementById("video");

            let canvas = document.getElementById("canvas");

            canvas.width = video.videoWidth;

            canvas.height = video.videoHeight;

            canvas.getContext("2d").drawImage(video, 0, 0);

            let image = canvas.toDataURL("image/png");

            document.getElementById("captured_image").value = image;

            closeCamera();

        }

        function closeCamera() {

            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }

            document.getElementById("cameraBox").style.display = "none";

        }
    </script>
@endsection
