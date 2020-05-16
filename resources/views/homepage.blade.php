@extends('app')
@section('contents')
    <!--=====  End of Header  ======-->

    <!--=============================================
    =            Hero slider Area         =
    =============================================-->

    <div class="hero-slider-container mb-35">
        <!--=======  Slider area  =======-->

        <div class="hero-slider-one">
            <!--=======  hero slider item  =======-->

            <div class="hero-slider-item slider-bg-1">
                <div class="slider-content d-flex flex-column justify-content-center align-items-center">
                    <h1>Lorem Ipsum</h1>
                    <p>Lorem Ipsum Lorem Ipsum Lorem Ipsum</p>
                    <a href="#" class="slider-btn">ORDER NOW</a>
                </div>
            </div>

            {{--<div class="hero-slider-item slider-bg-2">
                <div class="slider-content d-flex flex-column justify-content-center align-items-center">
                    <h1>Fresh & Nature</h1>
                    <p>get fresh food from our firm to your table</p>
                    <a href="shop-left-sidebar.html" class="slider-btn">SHOP NOW</a>
                </div>
            </div>--}}
        </div>

    </div>

   {{-- <div class="policy-section mb-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="policy-titles d-flex align-items-center flex-wrap">
                        <!--=======  single policy  =======-->

                        <div class="single-policy">
                            <span><img src="assets/images/policy-icon1.png" class="img-fluid" alt=""></span>
                            <p> FREE SHIPPING ON ORDERS OVER $200</p>
                        </div>

                        <!--=======  End of single policy  =======-->


                        <!--=======  single policy  =======-->

                        <div class="single-policy">
                            <span><img src="assets/images/policy-icon2.png" class="img-fluid" alt=""></span>
                            <p>30 -DAY RETURNS MONEY BACK</p>
                        </div>

                        <!--=======  End of single policy  =======-->

                        <!--=============================================
                        =            single policy         =
                        =============================================-->

                        <div class="single-policy">
                            <span><img src="assets/images/policy-icon3.png" class="img-fluid" alt=""></span>
                            <p> 24/7 SUPPORT</p>
                        </div>

                        <!--=====  End of single policy  ======-->

                    </div>
                </div>
            </div>
        </div>
    </div>--}}

    <div class="slider category-slider mb-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=======  category slider section title  =======-->

                    <div class="section-title">
                        <h3>top categories</h3>
                    </div>

                    <!--=======  End of category slider section title  =======-->

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!--=======  category container  =======-->
                    <div class="category-slider-container">
                        @foreach($categories as $category)
                            <div class="single-category">
                                <div class="category-image">
                                    <a href="#" title="Alcoholic">
                                        <img src="{{asset('_landing/assets/images/products/'.$category->category_image)}}" class="img-fluid" alt="">
                                    </a>
                                </div>
                                <div class="category-title">
                                    <h3>
                                        <a href="#">{{$category->name}}</a>
                                    </h3>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="slider tab-slider mb-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=======  category slider section title  =======-->

                    <div class="section-title">
                        <h3>Our Products</h3>
                    </div>

                    <!--=======  End of category slider section title  =======-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-slider-wrapper">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="featured" role="tabpanel" aria-labelledby="featured-tab">
                                <!--=======  tab slider container  =======-->
                                <div class="row products-background mb-4 " style="margin-right: 0px !important; margin-left: 0px!important;">
                                    @foreach($products as $product)
                                        <div class="gf-product tab-slider-sub-product col-md-3">
                                            <div class="image">
                                                <a href="{{route('customer.view-product', ['name' => $product->name, 'token' => $product->token])}}">
                                                    <span class="onsale">Sale!</span>
                                                    <img src="{{asset('_landing/assets/images/products/'. $product->image)}}" class="img-fluid" alt="">
                                                </a>
                                                {{--<div class="product-hover-icons">
                                                    <a class="active" href="#" data-tooltip="Add to cart"> <span class="fa fa-shopping-cart"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="fa fa-heart"></span> </a>
                                                </div>--}}
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="#">{{$product->drinkType->name}}</a>
                                                </div>
                                                <h3 class="product-title"><a href="#">{{$product->name}}</a></h3>
                                                <div class="price-box">
                                                    <span class="discounted-price">N{{number_format($product->price)}}</span>
{{--
                                                    <span class="discounted-price">N8,000</span>
--}}
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach

                                </div>
                                {{--<div class="pagination-container mt-4">
                                    <div class="container">
                                        <div class="row">
                                            --}}{{--<div class="col-lg-12">
                                                <!--=======  pagination-content  =======-->
--}}{{--
                                                --}}{{--<div class=" text-center">--}}{{--
                                                    <div class="offset-md-5 offset-4">
                                                        {{$products->links()}}
                                                    </div>
                                                    --}}{{--<ul>
                                                        <li><a class="active" href="#">1</a></li>
                                                        <li><a href="#">2</a></li>
                                                        <li><a href="#">3</a></li>
                                                        <li><a href="#">4</a></li>
                                                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                                    </ul>--}}{{--
                                                --}}{{--</div>--}}{{--

                                                <!--=======  End of pagination-content  =======-->
                                                 --}}{{--</div>--}}{{--
                                        </div>
                                    </div>
                                </div>--}}
                                <!--=======  End of tab slider container  =======-->
                            </div>
                            {{--<div class="tab-pane fade" id="new-arrivals" role="tabpanel" aria-labelledby="new-arrival-tab">
                                <!--=======  tab slider container  =======-->

                                <div class="tab-slider-container">
                                    <!--=======  single tab slider item  =======-->
                                    <div class="single-tab-slider-item">
                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <img src="assets/images/products/product03.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->

                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <span class="onsale">Sale!</span>
                                                    <img src="assets/images/products/product04.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="main-price">$89.00</span>
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->


                                    </div>
                                    <!--=======  End of single tab slider product  =======-->
                                    <!--=======  single tab slider item  =======-->
                                    <div class="single-tab-slider-item">
                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <span class="onsale">Sale!</span>
                                                    <img src="assets/images/products/product01.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a class="active" href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="main-price">$89.00</span>
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->

                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <img src="assets/images/products/product02.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->


                                    </div>
                                    <!--=======  End of single tab slider product  =======-->

                                    <!--=======  single tab slider item  =======-->
                                    <div class="single-tab-slider-item">
                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <span class="onsale">Sale!</span>
                                                    <img src="assets/images/products/product05.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="main-price">$89.00</span>
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->

                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <img src="assets/images/products/product06.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a class="active" href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->
                                    </div>
                                    <!--=======  End of single tab slider product  =======-->

                                    <!--=======  single tab slider item  =======-->
                                    <div class="single-tab-slider-item">
                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <span class="onsale">Sale!</span>
                                                    <img src="assets/images/products/product07.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="main-price">$89.00</span>
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->

                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <span class="onsale">Sale!</span>
                                                    <img src="assets/images/products/product08.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="main-price">$89.00</span>
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->
                                    </div>
                                    <!--=======  End of single tab slider product  =======-->

                                    <!--=======  single tab slider item  =======-->

                                    <div class="single-tab-slider-item">
                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <span class="onsale">Sale!</span>
                                                    <img src="assets/images/products/product09.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a class="active" href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="main-price">$89.00</span>
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->

                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <span class="onsale">Sale!</span>
                                                    <img src="assets/images/products/product10.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="main-price">$89.00</span>
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->


                                    </div>
                                    <!--=======  End of single tab slider product  =======-->
                                </div>

                                <!--=======  End of tab slider container  =======-->
                            </div>
                            <div class="tab-pane fade" id="on-sale" role="tabpanel" aria-labelledby="nav-onsale-tab">
                                <!--=======  tab slider container  =======-->

                                <div class="tab-slider-container">
                                    <!--=======  single tab slider item  =======-->

                                    <div class="single-tab-slider-item">
                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <span class="onsale">Sale!</span>
                                                    <img src="assets/images/products/product09.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a class="active" href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="main-price">$89.00</span>
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->

                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <span class="onsale">Sale!</span>
                                                    <img src="assets/images/products/product10.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="main-price">$89.00</span>
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->


                                    </div>
                                    <!--=======  End of single tab slider product  =======-->
                                    <!--=======  single tab slider item  =======-->
                                    <div class="single-tab-slider-item">
                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <span class="onsale">Sale!</span>
                                                    <img src="assets/images/products/product01.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a class="active" href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="main-price">$89.00</span>
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->

                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <img src="assets/images/products/product02.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->


                                    </div>
                                    <!--=======  End of single tab slider product  =======-->
                                    <!--=======  single tab slider item  =======-->
                                    <div class="single-tab-slider-item">
                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <img src="assets/images/products/product03.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->

                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <span class="onsale">Sale!</span>
                                                    <img src="assets/images/products/product04.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="main-price">$89.00</span>
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->


                                    </div>
                                    <!--=======  End of single tab slider product  =======-->
                                    <!--=======  single tab slider item  =======-->
                                    <div class="single-tab-slider-item">
                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <span class="onsale">Sale!</span>
                                                    <img src="assets/images/products/product05.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="main-price">$89.00</span>
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->

                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <img src="assets/images/products/product06.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a class="active" href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->
                                    </div>
                                    <!--=======  End of single tab slider product  =======-->

                                    <!--=======  single tab slider item  =======-->
                                    <div class="single-tab-slider-item">
                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <span class="onsale">Sale!</span>
                                                    <img src="assets/images/products/product07.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="main-price">$89.00</span>
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->

                                        <!--=======  tab slider sub product  =======-->

                                        <div class="gf-product tab-slider-sub-product">
                                            <div class="image">
                                                <a href="single-product.html">
                                                    <span class="onsale">Sale!</span>
                                                    <img src="assets/images/products/product08.jpg" class="img-fluid" alt="">
                                                </a>
                                                <div class="product-hover-icons">
                                                    <a href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                                    <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                                    <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                                    <a href="#" data-tooltip="Quick view" data-toggle = "modal" data-target="#quick-view-modal-container"> <span class="icon_search"></span> </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="shop-left-sidebar.html">Fast Foods</a>,
                                                    <a href="shop-left-sidebar.html">Vegetables</a>
                                                </div>
                                                <h3 class="product-title"><a href="single-product.html">Sed tempor ehicula non commodo</a></h3>
                                                <div class="price-box">
                                                    <span class="main-price">$89.00</span>
                                                    <span class="discounted-price">$80.00</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!--=======  End of tab slider sub product  =======-->
                                    </div>
                                    <!--=======  End of single tab slider product  =======-->
                                </div>

                                <!--=======  End of tab slider container  =======-->
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-section slider category-slider section mb-50">
       {{-- <div class="slider category-slider mb-35">--}}
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>Membership Offer</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="#">
                        <!-- Compare Table -->
                        <div class="compare-table table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                <tr>
                                    <td class="first-column">Membership</td>
                                    <td class="product-image-title">
                                        <a href="#" class="image"><img src="{{asset('_landing/assets/images/products/medal (1).png')}}" style="width: 50px!important; height: 50px!important;" class="img-fluid" alt="Compare Product"></a>
                                        <a href="#" class="category">Silver</a>
                                        <a href="#" class="title">Lorem Impsum Lorem Impsum</a>
                                    </td>
                                    <td class="product-image-title">
                                        <a href="#" class="image"><img src="{{asset('_landing/assets/images/products/medal (2).png')}}" style="width: 50px!important; height: 50px!important;" class="img-fluid" alt="Compare Product"></a>
                                        <a href="#" class="category">Bronze</a>
                                        <a href="#" class="title">Lorem Impsum Lorem Impsum</a>
                                    </td>
                                    <td class="product-image-title">
                                        <a href="#" class="image"><img src="{{asset('_landing/assets/images/products/medal.png')}}" style="width: 50px!important; height: 50px!important;" class="img-fluid" alt="Compare Product"></a>
                                        <a href="#" class="category">Gold</a>
                                        <a href="#" class="title">Lorem Impsum Lorem Impsum</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="first-column">Description</td>
                                    <td class="pro-desc"><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis veritatis culpa asperiores fugit omnis ducimus ullam facilis magnam quo vitae.</p></td>
                                    <td class="pro-desc"><p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quidem, ab assumenda. Sunt accusantium quae porro repellendus sed totam deserunt autem!</p></td>
                                    <td class="pro-desc"><p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illo, ad! Natus dolor voluptates, veniam provident vitae consequuntur adipisci expedita est!</p></td>
                                </tr>
                                <tr>
                                    <td class="first-column">Karaoke</td>
                                    <td class="pro-price"><i style="color: red" class="fa fa-remove"></i></td>
                                    <td class="pro-price"><i style="color: #80bb01" class="fa fa-check"></i></td>
                                    <td class="pro-price"><i style="color: #80bb01" class="fa fa-check"></i></td>
                                </tr>
                                <tr>
                                    <td class="first-column">King's Place</td>
                                    <td class="pro-price"><i style="color: red" class="fa fa-remove"></i></td>
                                    <td class="pro-price"><i style="color: #80bb01" class="fa fa-check"></i></td>
                                    <td class="pro-price"><i style="color: #80bb01" class="fa fa-check"></i></td>
                                </tr>
                                <tr>
                                    <td class="first-column">Extra Treat</td>
                                    <td class="pro-price"><i style="color: red" class="fa fa-remove"></i></td>
                                    <td class="pro-price"><i style="color: red" class="fa fa-remove"></i></td>
                                    <td class="pro-price"><i style="color: #80bb01" class="fa fa-check"></i></td>
                                </tr>
                                <tr>
                                    <td class="first-column"></td>
                                    <td class="pro-addtocart"><a href="#" class="add-to-cart" tabindex="0"><span>Proceed</span></a></td>
                                    <td class="pro-addtocart"><a href="#" class="add-to-cart" tabindex="0"><span>Proceed</span></a></td>
                                    <td class="pro-addtocart"><a href="#" class="add-to-cart" tabindex="0"><span>Proceed</span></a></td>
                                </tr>
                                {{--<tr>
                                    <td class="first-column">Delete</td>
                                    <td class="pro-remove"><button><i class="fa fa-trash-o"></i></button></td>
                                    <td class="pro-remove"><button><i class="fa fa-trash-o"></i></button></td>
                                    <td class="pro-remove"><button><i class="fa fa-trash-o"></i></button></td>
                                </tr>--}}
                                {{--<tr>
                                    <td class="first-column">Rating</td>
                                    <td class="pro-ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </td>
                                    <td class="pro-ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </td>
                                    <td class="pro-ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </td>
                                </tr>--}}
                                </tbody>
                            </table>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
