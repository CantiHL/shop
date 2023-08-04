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
	    <label for="inputEmail4" class="form-label">Product Name</label>
	    <input name="product_name" type="text" class="form-control" id="inputEmail4" value="{{ $record->product_name }}">
	  </div>
	  
	  <div class="col-md-6">
	    <label for="inputPassword4" class="form-label">Product Price</label>
	    <input name="product_price" type="text" class="form-control" id="inputPassword4" value="{{ $record->product_price }}">
	  </div>
	  <div class="col-md-6">
	    <label for="inputState" class="form-label">Product Brand</label>
	    <select name="product_brand_id" id="inputState" class="form-control" value="{{ $record->product_brand_id }}">
			@foreach ($data_brands as $brand)
			@if ($brand->brand_id==$record->product_brand_id)
				<option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
			@else
				<option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
			@endif
			@endforeach
	    </select>
	  </div>
	  <div class="col-md-6">
	    <label for="inputState" class="form-label">Product Category</label>
	    <select name="product_category_id" id="inputState" class="form-control" value="{{ $record->product_category_id }}">
			@foreach ($data_categories as $category)
			@if ($category->category_id==$record->product_category_id)
				<option selected value="{{$category->category_id}}">{{$category->category_name}}</option>
			@else
				<option value="{{$category->category_id}}">{{$category->category_name}}</option>
			@endif
			@endforeach
	    </select>
	  </div>
	  <div class="col-12">
	    <label for="inputAddress" class="form-label">Product Description</label>
	    <textarea name="product_description" cols="30" rows="10" class="form-control" >{{ $record->product_description }}</textarea>
	  </div>
	  <div class="col-6">
	    <label for="inputAddress2" class="form-label">Product Image</label>
	    <input type="file" name="product_image" class="form-control" id="inputAddress2" value="{{ $record->product_image }}">
	  </div>
	  <div class="col-6">
	    <label for="inputAddress2" class="form-label">Product Date</label>
	    <input type="date" name="product_date" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" value="{{ $record->product_date }}">
	  </div>
	  @csrf
	  <div class="col-12">
	    <button type="submit" class="btn btn-block mt-2 btn-primary">Submit</button>
	  </div>
	</form>
@endforeach
@endsection