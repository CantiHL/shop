<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="{{asset('clients/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('clients/css/main.css')}}" rel="stylesheet">
</head>
<body>
	@include('clients.header')
	<hr>
<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					@if (session('message1'))
						<p class="alert-danger">{{ session('message1') }}</p>
					@endif
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="{{route('checkuser')}}" method="post">
							@csrf
							<input type="email" name="email_login" placeholder="Email" value="{{ request()->old('email_login') }}" />
							<p class="alert-danger">@error('email_login') {{ $message }}@enderror</p>
							<input type="password" name="password_login" placeholder="Password" value="{{ request()->old('password_login') }}" />
							<p class="alert-danger">@error('password_login') {{ $message }}@enderror</p>
							<button type="submit" class="btn btn-default">Login</button>

						</form>
                        <a href="#" style="margin-top: 2rem" class="btn btn-default">Login with google</a>

					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					@if (session('message'))
						<p class="alert-success">{{ session('message') }}</p>
					@endif
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="{{ route('register') }}" method="post">
							<input value="{{ request()->old('user_name') }}" type="text" name="user_name" placeholder="Name"/>
							<p class="alert-danger">@error('user_name') {{ $message }} @enderror</p>
							<input value="{{ request()->old('email') }}" type="email" name="email" placeholder="Email Address"/>
							<p class="alert-danger">@error('email') {{ $message }} @enderror</p>
							<input value="{{ request()->old('password') }}" type="password" name="password" placeholder="Password"/>
							<p class="alert-danger">@error('password') {{ $message }} @enderror</p>
							<input value="{{ request()->old('address') }}" type="text" name="address" placeholder="Address"/>
							<p class="alert-danger">@error('address') {{ $message }} @enderror</p>
							<input value="{{ request()->old('phone') }}" type="text" name="phone" placeholder="Phone"/>
							<p class="alert-danger">@error('phone') {{ $message }} @enderror</p>
							@csrf
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
		<hr>
		@include('clients.footer')
</body>
</html>
