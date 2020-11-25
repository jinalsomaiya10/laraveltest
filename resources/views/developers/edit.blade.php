@extends('layouts.devlayout')
@section('content')
<h2 style="margin-top: 12px;" class="text-center">Edit Developer</a></h2>
<br>
<form action="{{ route('developers.update', $developer->id) }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
@method('PATCH')
<div class="row">
<div class="col-md-12">
<div class="form-group">
<strong>First Name</strong>
<input type="text" name="first_name" class="form-control" placeholder="Enter Firstname" value="{{ $developer->first_name }}">
<span class="text-danger">{{ $errors->first('first_name') }}</span>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<strong>Last Name</strong>
<input type="text" name="last_name" class="form-control" placeholder="Enter Lastname" value="{{ $developer->last_name }}">
<span class="text-danger">{{ $errors->first('last_name') }}</span>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<strong>Email</strong>
<input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{ $developer->email }}">
<span class="text-danger">{{ $errors->first('email') }}</span>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<strong>Phone Number</strong>
<input type="text" name="phone_number" class="form-control" placeholder="Enter Phone Number" value="{{ $developer->phone_number }}">
<span class="text-danger">{{ $errors->first('phone_number') }}</span>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<strong>Address</strong>
<textarea class="form-control" col="2" name="address" placeholder="Enter Address">{{ $developer->address }}</textarea>
<span class="text-danger">{{ $errors->first('address') }}</span>
</div>
</div>    
<div class="col-md-12">
<div class="form-group">
<strong>Avatar</strong>
@if($developer->avatar)
<img id="original" src="{{ asset('image/'.$developer->avatar) }}" height="70" width="70">
@endif
<input type="file" name="avatar" class="form-control" placeholder="" value="{{ $developer->avatar }}">
<span class="text-danger">{{ $errors->first('avatar') }}</span>
</div>
</div>
<div class="col-md-12">
<button type="submit" class="btn btn-primary">Submit</button>
</div>
</div>
</form>
@endsection