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

    <style>
        .slider {
            width: 100%;
            height: 300px;
            overflow: hidden;
            position: relative;
        }

        .slide {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
    </style>
</head>
<body>
    @include('clients.header')
    <div class="container">
        <div class="slider_cover row">
            <div class="col-sm-3">
                <img width="100%" height="100%" src="{{asset('assets/img/poster.png')}}" alt="Slide 1">
            </div>
            <div class="col-sm-9">
                <div class="slider">
                    <div class="slide">
                        <img width="100%" height="100%" src="{{asset('assets/img/1.png')}}" alt="Slide 1">
                    </div>
                    <div class="slide">
                        <img width="100%" height="100%" src="{{asset('assets/img/2.png')}}" alt="Slide 2">
                    </div>
                    <div class="slide">
                        <img width="100%" height="100%" src="{{asset('assets/img/3.png')}}" alt="Slide 3">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section style="margin-top: 30px">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
                        @include('clients.side_bar')
					</div>
                    <img style="margin-top: 50px"  width="100%" height="100%" src="{{asset('assets/img/poster.png')}}" alt="Slide 1">
				</div>
				<div class="col-sm-9 padding-right">
						@yield('content')
				</div>
			</div>
		</div>
	</section>
    @include('clients.footer')
    <script src="{{asset('assets/js/jquery.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
</body>
</html>
