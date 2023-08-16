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
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/responsive.css')}}" rel="stylesheet">
</head>
<body>
    @include('clients.header')
    <div class="container">
        <div class="slider_cover row">
            <div class="col-sm-4">
                <img width="300px" height="300px" src="{{asset('assets/img/poster.png')}}" alt="Slide 1">
            </div>
            <div class="col-sm-8">
                <div class="slider">
                    <div class="slide">
                        <img src="{{asset('assets/img/products/26.jpg')}}" alt="Slide 1">
                    </div>
                    <div class="slide">
                        <img src="{{asset('assets/img/products/80.jpg')}}" alt="Slide 2">
                    </div>
                    <div class="slide">
                        <img src="{{asset('assets/img/products/115.jpg')}}" alt="Slide 3">
                    </div>
                    <div class="slide">
                        <img src="{{asset('assets/img/products/185.jpg')}}" alt="Slide 3">
                    </div>
                    <div class="slide">
                        <img src="{{asset('assets/img/Realme-114G-GRQ-800-200-800x200-1.png')}}" alt="Slide 3">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section style="margin-top: 30px">
		<div class="container">
			<div class="row">
{{--				<div class="col-sm-3">--}}
{{--					<div class="left-sidebar">--}}
{{--                        @include('clients.side_bar')--}}
{{--					</div>--}}
{{--				</div>--}}

				<div class="col-sm-12 padding-right">
						@yield('content')

				</div>

			</div>
		</div>
	</section>
{{--    <div class="container">--}}
{{--        @include('clients.comment')--}}
{{--    </div>--}}

    @include('clients.footer')
    <script src="{{asset('assets/js/jquery.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
</body>
</html>
