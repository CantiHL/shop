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
@foreach ($info_category as $record)
	<form action="" method="post" enctype="multipart/form-data" class="row g-3">
	  <div class="col-md-6">
	    <label for="inputEmail4" class="form-label">category Name</label>
	    <input name="category_name" type="text" class="form-control" id="inputEmail4" value="{{ $record->category_name }}">
	  </div>
	  <div class="col-6">
	    <label for="inputAddress2" class="form-label">category Image</label>
	    <input type="file" name="category_image" class="form-control" id="inputAddress2">
	  </div>
	  <div class="col-12">
	    <label for="inputAddress" class="form-label">category Description</label>
	    <textarea name="category_description" cols="30" rows="10" class="form-control" value="{{ $record->category_description }}">{{ $record->category_description }}</textarea>
	  </div>
	  @csrf
	  <div class="col-12">
	    <button type="submit" class="btn btn-block mt-2 btn-primary">Submit</button>
	  </div>
	</form>
@endforeach
@endsection