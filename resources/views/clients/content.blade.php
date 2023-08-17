@extends('layouts.client_layout')
@section('content')
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Smart Phone</h2>
						@foreach ($data_products as $record)
						<a href="{{ route('product_detail',['id'=>$record->id]) }}">
							<div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                            <div class="productinfo text-center">
                                                <input type="hidden" name="id" id="id" value="{{ $record->id }}">
                                                <img width="90%" src="{{ asset('assets/img/products/'.$record->product_image) }}" alt="" />
                                                <h2>${{ number_format($record->product_price,0,'','.') }}</h2>
                                                <p>Name: <strong>{{ strtoupper($record->product_name) }}</strong></p>
                                                <p>Category: {{ $record->category_name }}</p>
                                                <p>Brand: {{ $record->brand_name }}</p>
                        </a>
                                                <a data-url="{{ route('add_to_cart',['id'=>$record->id]) }}" class="btn btn-default add-to-cart add_to_cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                    </div>
                                </div>
							</div>
						@endforeach
					</div><!--features_items-->
                {{$data_products->links()}}
	@stop

