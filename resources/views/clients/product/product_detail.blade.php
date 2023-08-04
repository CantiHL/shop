<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Product Details | E-Shopper</title>
     <link href="{{asset('clients/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('clients/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('clients/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('clients/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('clients/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('clients/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('clients/css/responsive.css')}}" rel="stylesheet">     
    <link rel="shortcut icon" href="{{asset('clients/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('clients/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('clients/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('clients/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('clients/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
@include('clients.header')
		<div class="container">
			<div class="row">
				<div class="col-sm-12 padding-right">
					@foreach($data as $product_detail)
					<div class="product-details"><!--product-details-->
						<div class="col-sm-4">
							<div class="view-product">
								<img src="{{asset('assets/img/'.$product_detail->product_image)}}" alt="" />
							</div>
						</div>
						<div class="col-sm-8">
							<form action="" method="post">
							@csrf
							<div class="product-information"><!--/product-information-->
								<h2>Product Name: {{$product_detail->product_name}}</h2>
								<input type="hidden" name="product_id" value="{{$product_detail->id}}">
								<img src="{{asset('clients/images/product-details/rating.png')}}" alt="" /><br>
								<span>
									<span>Price: {{number_format($product_detail->product_price,'0','','.')}}vnd</span>
									<a data-url="{{ route('add_to_cart',['id'=>$product_detail->id]) }}"  class="btn btn-fefault cart add-to-cart add_to_cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</a>
								</span>
								<p><b>Brand:</b> {{$product_detail->brand_name}}</p>
								<p><b>Category:</b> {{$product_detail->category_name}}</p>
								<p><b>Created_at:</b>{{$product_detail->created_at}}</p>
								<a href=""><img src="{{asset('clients/images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
								<label for="">Description: </label>
								<textarea readonly name="" id="" cols="30" rows="5">{{$product_detail->product_description}}</textarea>
							</div><!--/product-information-->
							</form>
						</div>
					</div><!--/product-details-->
					@endforeach
				</div>
			</div>
		</div>
		@include('clients.footer')
    <script src="{{asset('clients/js/jquery.js')}}"></script>
	<script src="{{asset('clients/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('clients/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('clients/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('clients/js/main.js')}}"></script>

        <script>
    	$(function(){
    		$.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
		$('.add_to_cart').on('click', function(event) {
    		event.preventDefault();
    		let url=$(this).data('url');
    		alert('Add to cacrt success');
    		$.ajax({
    			url: url,
    			type: 'get',
    			dataType: 'json',
    		})
    		.done(function() {
    			console.log("success");
    		})
    		.fail(function() {
    			console.log("error");
    		})
    		.always(function() {
    			console.log("complete");
    		});
    		
    	});
    	});
    	
    	
    </script>
</body>
</html>