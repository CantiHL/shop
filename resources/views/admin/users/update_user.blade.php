@extends('layouts.admin_layout')
@section('content')
@if ($errors->any())
    <p class="alert-danger text-center">
        <ul>
        	 @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </p>
@endif
@if (session('message'))
    <p class="alert-info text-center">{{ session('message') }}</p>
@endif

<h6 class="alert-secondary text-center p-3" >Update user</h6>
	<form action="" method="post" enctype="multipart/form-data" class="row g-3">
	  <div class="col-md-6">
	    <label class="form-label">Name</label>
	    <input name="name" type="text" class="form-control" value="{{ $data->user_name }}">
	  </div>
	  <div class="col-6">
	    <label  class="form-label">Email</label>
	    <input type="email" name="email" class="form-control" value="{{ $data->email }}">
	  </div>
        <div class="col-6">
            <label  class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $data->phone }}">
        </div>
        <div class="col-6">
            <label  class="form-label">Address</label>
            <input type="text" name="address" class="form-control" value="{{ $data->address }}">
        </div>
	  @csrf
	  <div class="col-12">
	    <button type="submit" class="btn btn-block mt-2 btn-primary">Update</button>
	  </div>
	</form>
@endsection
