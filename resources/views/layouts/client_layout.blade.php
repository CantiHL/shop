<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop_Digital</title>
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/responsive.css')}}" rel="stylesheet">
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
    		alert('Add to cart success');
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
