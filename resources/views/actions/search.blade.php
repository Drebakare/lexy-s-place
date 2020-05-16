@extends('app')
@section('contents')
    <!--=============================================
    =            breadcrumb area         =
    =============================================-->

    <div class="breadcrumb-area mb-50">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-container">
                        <ul>
                            <li><a href="{{route('homepage')}}"><i class="fa fa-home"></i> Home</a></li>
                            <li class="active">Search Results</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--=====  End of breadcrumb area  ======-->


    <!--=============================================
    =            Cart page content         =
    =============================================-->


    <div class="shop-page-container mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2 order-lg-1">
                    <!--=======  sidebar area  =======-->

                    <div class="sidebar-area">
                        <!--=======  single sidebar  =======-->

                        <div class="sidebar mb-35">
                            <h3 class="sidebar-title">PRODUCT CATEGORIES</h3>
                            <ul class="product-categories">
                                @foreach($categories as $category)
                                    <li><a  href="{{route('product.category', ['category' => $category->name])}}">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <!--=======  End of single sidebar  =======-->

                        <!--=======  single sidebar  =======-->

                        <div class="sidebar mb-35">
                            <h3 class="sidebar-title">Filter By</h3>
                            <ul class="product-categories">
                                <li><a href="#">Alcoholic</a></li>
                                <li><a href="#">Non-Alcoholic</a></li>
                            </ul>
                        </div>

                        <div class="sidebar mb-35">
                            <h3 class="sidebar-title">Product Brands</h3>
                            <ul class="product-categories">
                                @foreach($brands as $brand)
                                    <li><a href="#">{{$brand->brand_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>


                        <div class="sidebar">
                            <h3 class="sidebar-title">Product Tags</h3>
                            <!--=======  tag container  =======-->

                            <ul class="tag-container">
                                <li><a href="#">Coke</a> </li>
                                <li><a href="#">Drink</a> </li>
                                <li><a href="#">Orange</a> </li>
                                <li><a href="#">strawberry</a> </li>
                            </ul>

                            <!--=======  End of tag container  =======-->
                        </div>

                        <!--=======  End of single sidebar  =======-->
                    </div>

                    <!--=======  End of sidebar area  =======-->
                </div>
                <div class="col-lg-9 order-1 order-lg-2 mb-sm-35 mb-xs-35">
                    @if($status)
                        <div class="shop-header mb-35" >
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-12 d-flex flex-column flex-sm-row justify-content-between align-items-left align-items-sm-center">
                                    <p class="result-show-message" style="color: red !important;">No Result Found for {{$keyword}}</p>
                                </div>
                                <p class="result-show-message" style="color: greenyellow !important;">Related search is displayed below</p>
                            </div>
                        </div>
                    @endif
                    @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator )
                        <div class="shop-header mb-35">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-12 d-flex flex-column flex-sm-row justify-content-between align-items-left align-items-sm-center">
                                    <p class="result-show-message">Showing {{$products->currentPage()}}– {{$products->lastPage()}} of results</p>
                                </div>
                            </div>
                        </div>
                    @endif
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator )
                        @if(count($products) > 3)
                            <div class="pagination-container mt-4">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <!--=======  pagination-content  =======-->
                                            <div class=" text-center">
                                                <div class="">
                                                    <ul>
                                                        <li>
                                                            {{$products->links()}}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!--=====  End of Cart page content  ======-->
@endsection
