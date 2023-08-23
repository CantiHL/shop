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
@foreach ($info_product as $record)
	<form action="" method="post" enctype="multipart/form-data" class="row g-3">
	  <div class="col-md-6">
	    <label for="inputEmail4" class="form-label">Name</label>
	    <input name="name" type="text" class="form-control" id="inputEmail4" value="{{ $record->name }}">
	  </div>

	  <div class="col-md-6">
	    <label for="inputPassword4" class="form-label">Price</label>
	    <input name="price" type="text" class="form-control" id="inputPassword4" value="{{ $record->price }}">
	  </div>
	  <div class="col-md-6">
	    <label for="inputState" class="form-label">Brand</label>
	    <select name="brand_id" id="inputState" class="form-control" value="{{ $record->brand_id }}">
			@foreach ($data_brands as $brand)
			@if ($brand->id==$record->brand_id)
				<option selected value="{{$brand->id}}">{{$brand->name}}</option>
			@else
				<option value="{{$brand->id}}">{{$brand->name}}</option>
			@endif
			@endforeach
	    </select>
	  </div>
	  <div class="col-md-6">
	    <label for="inputState" class="form-label">Category</label>
	    <select name="category_id" id="inputState" class="form-control" value="{{ $record->category_id }}">
			@foreach ($data_categories as $category)
			@if ($category->id==$record->id)
				<option selected value="{{$category->id}}">{{$category->name}}</option>
			@else
				<option value="{{$category->id}}">{{$category->name}}</option>
			@endif
			@endforeach
	    </select>
	  </div>
	  <div class="col-12">
	    <label for="inputAddress" class="form-label">Description</label>
	    <textarea name="description" cols="30" rows="10" class="form-control" >{{ $record->description }}</textarea>
	  </div>
	  <div class="col-6">
	    <label for="inputAddress2" class="form-label">Image</label>
	    <input type="file" name="image" class="form-control" id="inputAddress2" value="{{ $record->image }}">
	  </div>
	  @csrf
	  <div class="col-12">
	    <button type="submit" class="btn btn-block mt-2 btn-primary">Submit</button>
	  </div>
	</form>
@endforeach
@endsection
