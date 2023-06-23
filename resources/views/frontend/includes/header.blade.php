<header>
    <!-- top Header -->

    <!-- /top Header -->

    <!-- header -->
    <div id="header">
        <div class="container">
            <div class="pull-left">
                <!-- Logo -->
                <div class="header-logo">
                    <a class="logo" href="{{ route('frontend.home.index') }}">
                        <h1>House<span style="color: #F8694A">ware</span></h1>
                    </a>
                </div>
                <!-- /Logo -->

                <!-- Search -->
                <div class="header-search" style="">
                    <form method="get" action="{{ route('frontend.product.search') }}">
{{--                        @csrf--}}
                        <input class="input " type="text" placeholder="Nhập tên sản phẩm" name="keyword">
                        <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <!-- /Search -->
            </div>
            <div class="pull-right">
                <ul class="header-btns">
                    <!-- Account -->
                    <li style="width: 210px" class="header-account dropdown default-dropdown header-drop">
                        <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                            <div class="header-btns-icon">
                                <i class="fa fa-user-o"></i>
                            </div>
                            <strong class="text-uppercase">Tài khoản <i class="fa fa-caret-down"></i></strong>
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user())
                            <a href="#" class="text-uppercase">{{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
                        @else
                            <a href="{{ route('login.form') }}" class="text-uppercase">Đăng nhập</a>
                        @endif
                        @if(\Illuminate\Support\Facades\Auth::user())
                            <ul class="custom-menu">
{{--                                <li><a href="#"><i class="fa fa-user-o"></i> Cài đặt tài khoản</a></li>--}}
                                @if(\Illuminate\Support\Facades\Auth::user())
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <a>
                                                <button class="dropdown-item"><i class="btn fa fa-sign-out"
                                                                                 aria-hidden="true"></i> Đăng xuất
                                                </button>
                                            </a>
                                        </form>
                                    </li>
                                @else
                                    <li><a href="{{ route('login.form') }}"><i class="fa fa-unlock-alt"></i> Đăng
                                            nhập</a></li>
                                @endif
                            </ul>
                        @endif
                    </li>
                    <!-- /Account -->

                    <!-- Cart -->
                    <li class="header-cart dropdown default-dropdown header-drop">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            <div class="header-btns-icon">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="qty">{{ Gloudemans\Shoppingcart\Facades\Cart::count() }}</span>
                            </div>
                            <strong class="text-uppercase">Giỏ hàng</strong>
                            <br>
                            <span>{{ Gloudemans\Shoppingcart\Facades\Cart::total() }} VND</span>
                        </a>
                        <div class="custom-menu">
                            <div id="shopping-cart">
                                <div class="shopping-cart-list">
                                    @foreach(Gloudemans\Shoppingcart\Facades\Cart::content() as $item)
                                        <div class="product product-widget">
                                            <div class="product-thumb">
                                                <img src="/{{ $item->options->image }}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-price">{{ number_format($item->price) }} VND <span
                                                        class="qty">x{{ $item->qty }}</span></h3>
                                                <h2 class="product-name"><a href="#">{{ $item->name }}</a></h2>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if(Gloudemans\Shoppingcart\Facades\Cart::count() == 0)
                                    <div style="text-align: center" class="alert alert-info" role="alert">
                                        Chưa có sản phẩm nào trong giỏ hàng. Hãy tiếp tục mua sắm nào!
                                    </div>
                                @else
                                    <div class="shopping-cart-btns">
                                        <a href="{{ route('frontend.cart.index') }}">
                                            <button class="main-btn">Chi tiết</button>
                                        </a>
                                        <button class="primary-btn">Thanh toán <i class="fa fa-arrow-circle-right"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </li>
                    <!-- /Cart -->

                    <!-- Mobile nav toggle-->
                    <li class="nav-toggle">
                        <button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
                    </li>
                    <!-- / Mobile nav toggle -->
                </ul>
            </div>
        </div>
        <!-- header -->
    </div>
    <!-- container -->
</header>
