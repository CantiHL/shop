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
	    <label for="inputEmail4" class="form-label">Name</label>
	    <input name="name" type="text" class="form-control" id="inputEmail4" value="{{request()->old('name')}}">
	  </div>

	  <div class="col-md-6">
	    <label for="inputPassword4" class="form-label">Price</label>
	    <input name="price" type="text" class="form-control" id="inputPassword4" value="{{request()->old('price')}}">
	  </div>
        <div class="col-md-4">
            <label for="inputPassword4" class="form-label">Quantity</label>
            <input name="quantity" type="number" class="form-control" id="inputPassword4" value="{{request()->old('quantity')}}">
        </div>
	  <div class="col-md-4">
	    <label for="inputState" class="form-label">Brand</label>
	    <select name="brand_id" id="inputState" class="form-control">
		  @foreach ($data_brands as $brand)
		  <option value="{{$brand->id}}">{{$brand->name}}</option>
		  @endforeach

	    </select>
	  </div>
	  <div class="col-md-4">
	    <label for="inputState" class="form-label">Category</label>
	    <select name="category_id" id="inputState" class="form-control">
			@foreach ($data_categories as $category)
			<option value="{{$category->id}}">{{$category->name}}</option>
			@endforeach
	    </select>
	  </div>
	  <div class="col-12">
	    <label for="inputAddress" class="form-label">Description</label>
	    <textarea name="description" cols="30" rows="10" class="form-control">{{request()->old('description')}}</textarea>
	  </div>
	  <div class="col-6">
	    <label for="image" class="form-label">Image</label>
	    <input type="file" name="image" class="form-control" id="image" value="{{request()->old('image')}}">
	  </div>
	  @csrf
	  <div class="col-12">
	    <button type="submit" class="btn btn-block mt-2 btn-primary" value="Submit">Submit</button>
	  </div>
	</form>
@endsection
