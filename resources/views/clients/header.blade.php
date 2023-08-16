<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
                                @if(session('id')==2)
                                    <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                                @endif
								<li><a href="tel:84373245418"><i class="fa fa-phone"></i> +84373245418</a></li>
								<li><a href="mailto:admin@gmail.com"><i class="fa fa-envelope"></i>  Email us</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="https://www.facebook.com/profile.php?id=100024337758916"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a onclick="linkgg()"></button><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->

		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{route('client_home')}}"><img src="{{ asset('clients/images/home/logo.png') }}" alt="" /></a>
						</div>
					</div>

					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								@if (session('id'))
								 <li><a href="{{ route('user_account') }}"><i class="fa fa-user"></i> Account</a></li>
								@endif
								<li><a href="{{route('cart')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								@if (session('id'))
									<li><a href="{{route('logout')}}"><i class="fa fa-lock"></i>Hello, {{ session('user_name') }} Logout</a></li>
								@else
									<li><a href="{{ route('login') }}"><i class="fa fa-lock"></i> Login</a></li>
								@endif

							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	</header><!--/header-->
<script>
	function linkgg() {
		window.open('https://www.google.com/search?q=Shop+Digital&sxsrf=ALiCzsalv3Vstka1a_cS7kTOjKgeBV2x4Q%3A1663301473187&ei=YfcjY6uOC_a42roPoouW6AM&ved=0ahUKEwjrwtrruJj6AhV2nFYBHaKFBT0Q4dUDCA4&oq=Shop+Digital&gs_lcp=Cgdnd3Mtd2l6EAwyBQgAEIAEMgUIABDLATIFCAAQywEyBQgAEMsBMgUIABDLATIFCAAQywEyBQgAEMsBMgUIABDLATIFCAAQywEyBggAEB4QFjoECCMQJzoLCC4QgAQQsQMQgwE6CwgAEIAEELEDEIMBOggILhCABBCxAzoKCAAQsQMQgwEQQzoECAAQQzoECAAQAzoICC4QsQMQgwE6CgguELEDEIMBEEM6EQguEIAEELEDEIMBEMcBENEDOgoILhDHARDRAxBDOggIABCABBCxAzoNCC4QsQMQxwEQ0QMQQzoECC4QQzoHCAAQsQMQQzoHCCMQ6gIQJzoQCC4QsQMQgwEQxwEQ0QMQQzoLCC4QsQMQgwEQ1AI6DQguEMcBENEDENQCEEM6BwgAEMkDEEM6BQgAEJIDOgcIABAKEMsBOg0ILhCABBDHARDRAxAKSgQIQRgASgQIRhgAUABYtGhgmndoCHABeACAAcgCiAHvFZIBCDMuMTQuMS4ymAEAoAEBsAEKwAEB&sclient=gws-wiz');
	}
</script>
