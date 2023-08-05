<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop_Digital</title>
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/responsive.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>
<body>
    @include('clients.header')
    <section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
                        @include('clients.side_bar')
					</div>
				</div>

				<div class="col-sm-9 padding-right">
						@yield('content')

				</div>

			</div>
		</div>
	</section>
    <div class="container">
        @include('clients.comment')
    </div>

    @include('clients.footer')
    <script src="{{asset('assets/js/jquery.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('assets/js/price-range.js')}}"></script>
    <script src="{{asset('assets/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
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
