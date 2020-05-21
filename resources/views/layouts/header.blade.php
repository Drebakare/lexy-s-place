<header>
    <!--=======  header top  =======-->
    <div class="header-top pt-10 pb-10 pt-lg-10 pb-lg-10 pt-md-10 pb-md-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center text-sm-left">
                    <!-- currncy language dropdown -->
                    <!-- end of currncy language dropdown -->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  text-center text-sm-right">
                    <!-- header top menu -->
                    <div class="header-top-menu">
                        <ul>
                            <li><a href="#">My account</a></li>
                            <li><a href="{{route('cart.checkout')}}">Checkout</a></li>
                        </ul>
                    </div>
                    <!-- end of header top menu -->
                </div>
            </div>
        </div>
    </div>

    <!--=======  End of header top  =======-->

    <!--=======  header bottom  =======-->

    <div class="header-bottom header-bottom-one header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12 col-xs-12 text-lg-left text-md-center text-sm-center">
                    <!-- logo -->
                    <div class="logo mt-20 mb-10">
                        <a href="{{route('homepage')}}">
                            <h2 style="color: #80bb01">Lexy's Place</h2>
                        </a>
                    </div>
                    <!-- end of logo -->
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="menubar-top d-flex justify-content-between align-items-center flex-sm-wrap flex-md-wrap flex-lg-nowrap mt-sm-15">
                        <!-- header phone number -->
                        <div class="header-contact d-flex">
                            <div class="phone-icon">
                                <img src="{{asset('_landing/assets/images/icon-phone.png')}}" class="img-fluid" alt="">
                            </div>
                            <div class="phone-number">
                                Phone: <span class="number">+2348102780566</span>
                            </div>
                        </div>
                        <!-- end of header phone number -->
                        <!-- search bar -->
                        <div class="header-advance-search">
                            <form action="{{route('product.search')}}" method="get">
                                <input name="keyword" type="text" placeholder="Search your product">
                                <button type="submit"><span class="fa fa-search"></span></button>
                            </form>
                        </div>
                        <!-- end of search bar -->
                        <!-- shopping cart -->
                        <div class="shopping-cart" id="shopping-cart">
                            <a href="{{route('user.cart')}}">
                                <div class="cart-icon d-inline-block">
                                    <span class="fa fa-shopping-cart"></span>
                                </div>
                                <div class="cart-info d-inline-block">
                                    <p>Shopping Cart
                                        @if(session()->get('cart'))
                                            <?php
                                            $total = 0.0 ;
                                            foreach (session()->get('cart') as $cart){
                                                $total = $total + $cart["quantity"] * $cart["price"];
                                            }
                                            ?>
                                            <span id="cart-info">{{count(session()->get('cart'))}} items - N{{$total}}</span>
                                        @else
                                            <span id="cart-info"> 0 items - N 0</span>
                                        @endif

                                    </p>
                                </div>
                            </a>
                            <!-- end of shopping cart -->

                            <!-- cart floating box -->
                            @if(session()->get('cart'))
                                <div class="cart-floating-box" id="cart-floating-box">
                                    {{--<div class="cart-items">
                                        <div class="cart-float-single-item d-flex">
                                            <span class="remove-item"><a href="#"><i class="fa fa-times"></i></a></span>
                                            <div class="cart-float-single-item-image">
                                                <a href="#"><img src="{{asset('_landing/assets/images/products/product20.jpg')}}" class="img-fluid" alt=""></a>
                                            </div>
                                            <div class="cart-float-single-item-desc">
                                                <p class="product-title"> <a href="single-product.html">Lorem impsumsjks </a></p>
                                                <p class="price"><span class="count">1x</span> N 10</p>
                                            </div>
                                        </div>
                                    </div>--}}
                                    <div class="cart-calculation">
                                        <div class="floating-cart-btn text-center">
                                            <a href="{{route('cart.checkout')}}">Checkout</a>
                                            <a href="{{route('user.cart')}}">View Cart</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <!-- end of cart floating box -->
                        </div>
                    </div>

                    <!-- navigation section -->
                    <div class="main-menu">
                        <nav>
                            <ul>
                                <li class="active {{--menu-item-has-children--}}">
                                    <a href="{{route('homepage')}}">HOME</a>
                                    {{--<ul class="sub-menu d-none">
                                        <li><a href="index.html">Home Shop 1</a></li>
                                        <li><a href="index-2.html">Home Shop 2</a></li>
                                        <li><a href="index-3.html">Home Shop 3</a></li>
                                        <li><a href="index-4.html">Home Shop 4</a></li>
                                        <li><a href="index-5.html">Home Shop 5</a></li>
                                        <li><a href="index-6.html">Home Shop 6</a></li>
                                    </ul>--}}
                                </li>
                                <li class="{{--menu-item-has-children--}}">
                                    <a href="{{route('products.all')}}">Products</a>
                                    {{--<ul class="sub-menu d-none">
                                        <li class="menu-item-has-children"><a href="shop-4-column.html">shop grid</a>
                                            <ul class="sub-menu">
                                                <li><a href="shop-3-column.html">shop 3 column</a></li>
                                                <li><a href="shop-4-column.html">shop 4 column</a></li>
                                                <li><a href="shop-left-sidebar.html">shop left sidebar</a></li>
                                                <li><a href="shop-right-sidebar.html">shop right sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="shop-list.html">shop List</a>
                                            <ul class="sub-menu">
                                                <li><a href="shop-list.html">shop List</a></li>
                                                <li><a href="shop-list-left-sidebar.html">shop List Left Sidebar</a></li>
                                                <li><a href="shop-list-right-sidebar.html">shop List Right Sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="single-product.html">Single Product</a>
                                            <ul class="sub-menu">
                                                <li><a href="single-product.html">Single Product</a></li>
                                                <li><a href="single-product-variable.html">Single Product variable</a></li>
                                                <li><a href="single-product-affiliate.html">Single Product affiliate</a></li>
                                                <li><a href="single-product-group.html">Single Product group</a></li>
                                                <li><a href="single-product-tabstyle-2.html">Tab Style 2</a></li>
                                                <li><a href="single-product-tabstyle-3.html">Tab Style 3</a></li>
                                                <li><a href="single-product-gallery-left.html">Gallery Left</a></li>
                                                <li><a href="single-product-gallery-right.html">Gallery Right</a></li>
                                                <li><a href="single-product-sticky-left.html">Sticky Left</a></li>
                                                <li><a href="single-product-sticky-right.html">Sticky Right</a></li>
                                                <li><a href="single-product-slider-box.html">Slider Box</a></li>

                                            </ul>
                                        </li>
                                    </ul>--}}
                                </li>
                                @if(Auth::check())
                                    <li class="{{--menu-item-has-children--}}">
                                        <a href="{{route('account')}}">Dashboard</a>
                                    </li>
                                    <li class="{{--menu-item-has-children--}}">
                                        <a href="{{route('logout')}}">Logout</a>
                                    </li>
                                @else
                                    <li class="{{--menu-item-has-children--}}">
                                        <a href="{{route('login')}}">Login</a>
                                    </li>
                                    <li class="{{--menu-item-has-children--}}">
                                        <a href="{{route('registration')}}">Sign Up</a>
                                    </li>
                                @endif
                                <li><a href="#">CONTACT</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- end of navigation section -->
                </div>
                <div class="col-12">
                    <!-- Mobile Menu -->
                    <div class="mobile-menu d-block d-lg-none"></div>
                </div>
            </div>
        </div>
    </div>

    <!--=======  End of header bottom  =======-->
</header>
