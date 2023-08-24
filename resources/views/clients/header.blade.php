<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            @if(session('admin') !== null)
                                <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                            @endif
                            <li><a href="tel:84373245418"><i class="fa fa-phone"></i> +84373245418</a></li>
                            <li><a href="mailto:admin@gmail.com"><i class="fa fa-envelope"></i> cccanti.hl@gmail.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="https://www.facebook.com/profile.php?id=100024337758916"><i
                                        class="fa fa-facebook"></i></a></li>
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

    <div id="header-middle" class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{route('client_home')}}"><img src="{{ asset('clients/images/home/logo.png') }}"
                                                                alt=""/></a>

                    </div>

                </div>
                {{--                    <div class="col-sm-4">--}}
                {{--                        <div class="search">--}}
                {{--                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            @if (session('id'))
                                <li><a href="{{ route('user_account') }}"><i class="fa fa-user"></i> Account</a></li>
                            @endif
                            <li><a href="{{route('cart')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                            @if (session('id'))
                                <li><a href="{{route('logout')}}"><i
                                            class="fa fa-lock"></i>Hello, {{ session('user_name') }} Logout</a></li>
                            @else
                                <li><a href="{{ route('login') }}"><i class="fa fa-lock"></i> Login</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            {{--                <div class="menu">--}}
            {{--                    <ul class="nav">--}}
            {{--                        <li>--}}
            {{--                            <a class="nav-smartphone" href="">SMART PHONE</a>--}}
            {{--                            <ul class="nav-smartphone-more">--}}
            {{--                                <li><a class="" href="">Xiaomi</a></li>--}}
            {{--                                <li><a class="" href="">Iphone</a></li>--}}
            {{--                                <li><a class="" href="">Oppo</a></li>--}}
            {{--                                <li><a class="" href="">Nokia</a></li>--}}
            {{--                            </ul>--}}
            {{--                        </li>--}}
            {{--                        <li><a class="laptop" href="">LAPTOP</a></li>--}}
            {{--                        <li><a class="tablet" href="">TABLET</a></li>--}}
            {{--                        <li><a class="accessory" href="">ACCESSORY</a></li>--}}
            {{--                        <li><a class="smartwatch" href="">SMARTWATCH</a></li>--}}
            {{--                    </ul>--}}
            {{--                    <a class="" href=""></a>--}}
            {{--                </div>--}}
        </div>
    </div><!--/header-middle-->
</header><!--/header-->
<script>
    // var prevScrollpos = window.pageYOffset;
    // window.onscroll = function() {
    //     var currentScrollPos = window.pageYOffset;
    //     if (prevScrollpos > currentScrollPos) {
    //         document.getElementById("header-middle").style.top = "0";
    //     } else {
    //         document.getElementById("header-middle").style.top = "-120px";
    //     }
    //     prevScrollpos = currentScrollPos;
    // }
    function linkgg() {
        window.open('https://www.google.com/search?q=Shop+Digital&sxsrf=ALiCzsalv3Vstka1a_cS7kTOjKgeBV2x4Q%3A1663301473187&ei=YfcjY6uOC_a42roPoouW6AM&ved=0ahUKEwjrwtrruJj6AhV2nFYBHaKFBT0Q4dUDCA4&oq=Shop+Digital&gs_lcp=Cgdnd3Mtd2l6EAwyBQgAEIAEMgUIABDLATIFCAAQywEyBQgAEMsBMgUIABDLATIFCAAQywEyBQgAEMsBMgUIABDLATIFCAAQywEyBggAEB4QFjoECCMQJzoLCC4QgAQQsQMQgwE6CwgAEIAEELEDEIMBOggILhCABBCxAzoKCAAQsQMQgwEQQzoECAAQQzoECAAQAzoICC4QsQMQgwE6CgguELEDEIMBEEM6EQguEIAEELEDEIMBEMcBENEDOgoILhDHARDRAxBDOggIABCABBCxAzoNCC4QsQMQxwEQ0QMQQzoECC4QQzoHCAAQsQMQQzoHCCMQ6gIQJzoQCC4QsQMQgwEQxwEQ0QMQQzoLCC4QsQMQgwEQ1AI6DQguEMcBENEDENQCEEM6BwgAEMkDEEM6BQgAEJIDOgcIABAKEMsBOg0ILhCABBDHARDRAxAKSgQIQRgASgQIRhgAUABYtGhgmndoCHABeACAAcgCiAHvFZIBCDMuMTQuMS4ymAEAoAEBsAEKwAEB&sclient=gws-wiz');
    }
</script>
