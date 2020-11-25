@extends('layouts.devlayout')
@section('content')
<h2 style="margin-top: 12px;" class="text-center">Add Developer</a></h2>
<br>
<form action="{{ route('developers.store') }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="row">
<div class="col-md-12">
<div class="form-group">
<strong>First Name</strong>
<input type="text" name="first_name" class="form-control" placeholder="Enter Firstname" value="{{ old('first_name') }}">
<span class="text-danger">{{ $errors->first('first_name') }}</span>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<strong>Last Name</strong>
<input type="text" name="last_name" class="form-control" placeholder="Enter Lastname" value="{{ old('last_name') }}">
<span class="text-danger">{{ $errors->first('last_name') }}</span>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<strong>Email</strong>
<input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{ old('email') }}">
<span class="text-danger">{{ $errors->first('email') }}</span>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<strong>Phone Number</strong>
<input type="text" name="phone_number" class="form-control" placeholder="Enter Phone Number" value="{{ old('phone_number') }}">
<span class="text-danger">{{ $errors->first('phone_number') }}</span>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<strong>Address</strong>
<textarea class="form-control" col="2" name="address" placeholder="Enter Address">{{ old('address') }}</textarea>
<span class="text-danger">{{ $errors->first('address') }}</span>
</div>
</div>    
<div class="col-md-12">
<div class="form-group">
<strong>Avatar</strong>
<input type="file" name="avatar" class="form-control" placeholder="">
<span class="text-danger">{{ $errors->first('avatar') }}</span>
</div>
</div>
<div class="col-md-12">
<button type="submit" class="btn btn-primary">Submit</button>
</div>
</div>
</form>
@endsection