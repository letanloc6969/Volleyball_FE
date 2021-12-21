
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i
                                        class="fa fa-phone"></i> {{ getConfigValueFromSettingTable('phone_contact') }}
                                </a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> {{getConfigValueFromSettingTable('email')}}
                                </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{getConfigValueFromSettingTable('facebook_link')}}"><i
                                        class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-md-4 clearfix">
                    <div class="logo pull-left">
                        <a href="index.html"><img src="/eshopper/images/home/logo.png" alt=""/></a>
                    </div>
                    <div class="btn-group pull-right clearfix">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="">Canadian Dollar</a></li>
                                <li><a href="">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 clearfix">
                    <div class="shop-menu clearfix pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ route('checkout.payment') }}"><i class="fa fa-star"></i> Payment</a></li>

                            @if(Auth::check())
                                <li><a href="{{ route('customers.checkout') }}"><i class="fa fa-crosshairs"></i>
                                        Checkout</a></li>
                            @else
                                <li><a href="{{ route('customers.login') }}"><i class="fa fa-crosshairs"></i>
                                        Checkout</a></li>
                            @endif
                            <li><a href="{{ route('products.showCart') }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    Cart
                                </a>
                            </li>

                            @if(Auth::check())
                                <li>
                                    <a href="{{ route('customers.logout') }}">LOG OUT</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{route('customers.login')}}"><i class="fa fa-lock"></i> Login Or Register</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    @include('components.main_menu')
                </div>
                <div class="col-sm-5">
                    <form action="{{ route('products.search') }}" method="POST">
                        @csrf
                        <div class="search_box pull-right">
                            <input name="keyWords_submit" type="text" placeholder="Search Product"/>
                            <input name="search_items" type="submit" class="btn btn-primary btn-sm" style="margin-top: -1px;color: black">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header>
<!--/header-->
