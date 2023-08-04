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
@foreach ($info_brand as $record)
	<form action="" method="post" enctype="multipart/form-data" class="row g-3">
	  <div class="col-md-6">
	    <label for="inputEmail4" class="form-label">brand Name</label>
	    <input name="brand_name" type="text" class="form-control" id="inputEmail4" value="{{ $record->brand_name }}">
	  </div>
	  <div class="col-6">
	    <label for="inputAddress2" class="form-label">brand Image</label>
	    <input type="file" name="brand_image" class="form-control" id="inputAddress2" value="{{ $record->brand_image }}">
	  </div>
	  <div class="col-12">
	    <label for="inputAddress" class="form-label">brand Description</label>
	    <textarea name="brand_description" cols="30" rows="10" class="form-control">{{ $record->brand_description }}</textarea>
	  </div>
	  @csrf
	  <div class="col-12">
	    <button type="submit" class="btn btn-block mt-2 btn-primary">Submit</button>
	  </div>
	</form>
@endforeach
@endsection