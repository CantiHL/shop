@extends('layouts.admin_layout')
@section('content')
@if (session('message'))
	<h2 class="alert-success">{{ session('message') }}</h2>
@endif
@if ($errors->any())
    <p class="alert-danger text-center">
        <ul>
        	 @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </p>
@endif
	<form action="" method="post" enctype="multipart/form-data" class="row g-3">
	  <div class="col-md-6">
	    <label for="inputEmail4" class="form-label">brand Name</label>
	    <input name="brand_name" type="text" class="form-control" id="inputEmail4">
	  </div>
	  <div class="col-md-6">
	    <label for="inputPassword4" class="form-label">brand Image</label>
	    <input name="brand_image" type="file" class="form-control" id="inputPassword4">
	  </div>
	  <div class="col-12">
	    <label for="inputAddress" class="form-label">brand Description</label>
	    <textarea name="brand_description" cols="30" rows="10" class="form-control"></textarea>
	  </div>
	  @csrf
	  <div class="col-12">
	    <button type="submit" class="btn btn-block mt-2 btn-info">Submit</button>
	  </div>
	</form>
@endsection