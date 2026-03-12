@extends('layouts.app')

@section('content')

<div class="nxl-content">

<div class="page-header">
<div class="page-header-left d-flex align-items-center">
<div class="page-header-title">
<h5 class="m-b-10">
{{ isset($supervisor) ? 'Edit Supervisor' : 'Create Supervisor' }}
</h5>
</div>
</div>
</div>

<div class="main-content">

<div class="row">
<div class="col-12">

<div class="card stretch stretch-full">

<div class="card-body">

@if(isset($supervisor))
<form action="{{ route('supervisors.update',$supervisor->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@else
<form action="{{ route('supervisors.store') }}" method="POST" enctype="multipart/form-data">
@csrf
@endif

<div class="row">

<div class="col-md-4 mb-4">
<label>Name *</label>
<input type="text" name="name" class="form-control"
value="{{ old('name',$supervisor->name ?? '') }}">
</div>

<div class="col-md-4 mb-4">
<label>Email *</label>
<input type="email" name="email" class="form-control"
value="{{ old('email',$supervisor->email ?? '') }}">
</div>

<div class="col-md-4 mb-4">
<label>Contact *</label>
<input type="text" name="contact" class="form-control"
value="{{ old('contact',$supervisor->contact ?? '') }}">
</div>

<div class="col-md-4 mb-4">
<label>Alternate Contact</label>
<input type="text" name="alt_contact" class="form-control"
value="{{ old('alt_contact',$supervisor->alt_contact ?? '') }}">
</div>

<div class="col-md-4 mb-4">
<label>DOB</label>
<input type="date" name="dob" class="form-control"
value="{{ old('dob',$supervisor->dob ?? '') }}">
</div>

<div class="col-md-4 mb-4">
<label>Gender</label>

<select name="gender" class="form-control">

<option value="">Select</option>

<option value="male"
{{ old('gender',$supervisor->gender ?? '')=='male'?'selected':'' }}>
Male
</option>

<option value="female"
{{ old('gender',$supervisor->gender ?? '')=='female'?'selected':'' }}>
Female
</option>

<option value="other"
{{ old('gender',$supervisor->gender ?? '')=='other'?'selected':'' }}>
Other
</option>

</select>

</div>

<div class="col-md-4 mb-4">

<label>Status</label>

<select name="is_active" class="form-control">

<option value="1"
{{ old('is_active',$supervisor->is_active ?? 1)==1?'selected':'' }}>
Active
</option>

<option value="0"
{{ old('is_active',$supervisor->is_active ?? 1)==0?'selected':'' }}>
Inactive
</option>

</select>

</div>

<div class="col-md-4 mb-4">

<label>Photo</label>

<input type="file" name="photo" class="form-control">

@if(!empty($supervisor->photo))
<small class="d-block mt-2">
<a href="{{ asset($supervisor->photo) }}" target="_blank">
View Photo
</a>
</small>
@endif

</div>

<div class="col-md-12 mb-4">

<label>Address</label>

<textarea name="address" class="form-control" rows="2">{{ old('address',$supervisor->address ?? '') }}</textarea>

</div>

<div class="col-md-12 mb-4">

<label>Remark</label>

<textarea name="remark" class="form-control" rows="2">{{ old('remark',$supervisor->remark ?? '') }}</textarea>

</div>

<div class="col-md-4 mb-4">

<label>Password {{ isset($supervisor) ? '' : '*' }}</label>

<div class="input-group">

<input type="password" name="password" id="password" class="form-control">

<button type="button" class="btn btn-outline-secondary"
onclick="togglePassword('password',this)">
<i class="fa fa-eye"></i>
</button>

</div>

</div>

<div class="col-md-4 mb-4">

<label>Confirm Password</label>

<div class="input-group">

<input type="password" name="password_confirmation"
id="password_confirmation"
class="form-control">

<button type="button"
class="btn btn-outline-secondary"
onclick="togglePassword('password_confirmation',this)">

<i class="fa fa-eye"></i>

</button>

</div>

</div>

</div>

<div class="row">

<div class="col-md-12 d-flex gap-2">

<button type="submit" class="btn btn-primary">
{{ isset($supervisor) ? 'Update' : 'Create' }}
</button>

<a href="{{ route('supervisors.index') }}" class="btn btn-secondary">
Cancel
</a>

</div>

</div>

</form>

</div>

</div>

</div>
</div>

</div>

</div>

<script>

function togglePassword(id,btn){

let input=document.getElementById(id)
let icon=btn.querySelector("i")

if(input.type==="password"){

input.type="text"
icon.classList.remove("fa-eye")
icon.classList.add("fa-eye-slash")

}else{

input.type="password"
icon.classList.remove("fa-eye-slash")
icon.classList.add("fa-eye")

}

}

</script>

@endsection