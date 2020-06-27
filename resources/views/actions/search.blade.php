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
                                <li><a href="{{route('product.type', ['drink_type' => 'alcoholic'])}}">Alcoholic</a></li>
                                <li><a href="{{route('product.type', ['drink_type' => 'non-alcoholic'])}}">Non-Alcoholic</a></li>
                            </ul>
                        </div>

                        <div class="sidebar mb-35">
                            <h3 class="sidebar-title">Product Brands</h3>
                            <ul class="product-categories">
                                @foreach($brands as $brand)
                                    <li><a href="{{route('product.brand', ['brand_name' => $brand->brand_name])}}">{{$brand->brand_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>


                        {{--<div class="sidebar">
                            <h3 class="sidebar-title">Product Tags</h3>
                            <!--=======  tag container  =======-->

                            <ul class="tag-container">
                                <li><a href="#">Coke</a> </li>
                                <li><a href="#">Drink</a> </li>
                                <li><a href="#">Orange</a> </li>
                                <li><a href="#">strawberry</a> </li>
                            </ul>

                            <!--=======  End of tag container  =======-->
                        </div>--}}

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
                                                            <a {{--id="add-product"--}} href="#" data-toggle="modal" data-target="#display-confirmation-{{$product->token}}">
                                                                <span class="discounted-price pl-3"><i class="fa fa-cart-plus"></i></span>
                                                            </a>
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
    <meta name="_token" content="{{ app('Illuminate\Encryption\Encrypter')->encrypt(csrf_token()) }}" />
    <div class="modal fade" id="cart-confirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Product Successfully Added To Cart</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <h6 style="padding-top: 11px !important;"> Effectively Added to Cart</h6>
                        <div class="row" style="padding-top: 11px !important;">
                            <div class="col-lg-6 col-md-6 col-sm-12  mb-3" >
                                <a href="#" class="btn btn-outline-dark mt-0" data-dismiss="modal"><span style="font-size: 14px">Continue Shopping</span></a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12  mb-3">
                                <a  href="{{route('user.cart')}}" class="btn btn-outline-success mt-0"><span style="font-size: 14px">View Cart and Checkout</span> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($products as $product)
        <div class="modal fade" id="display-confirmation-{{$product->token}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Kindly Enter Product Quantity</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <h6 style="padding-top: 11px !important;"> Product Quantity</h6>
                            <div class="row" style="padding-top: 11px !important;">
                                <div class="col-lg-6 col-md-6 col-sm-12  mb-3" >
                                    <div class="pro-qty mr-20 mb-xs-20">
                                        <input id="product-qty" type="number" min="1">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12  mb-3">
                                    <button  onclick="addProductToCart('{{$product->token}}')" class="btn btn-outline-success mt-0"><span style="font-size: 14px">Add to Cart</span> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <button type="button" id="product-added" class="btn btn-primary" data-toggle="modal" data-target="#cart-confirmation" hidden>
        ""
    </button>
@endsection
@section('script_contents')
    <script type="text/javascript">
        function addProductToCart(token){
            var product_token =  token;
            var product_qty = $('#product-qty').val();
            if (product_qty === ""){
                toastr.error('Kindly Supply the Product Quantity')
            }
            else{
                $.ajaxSetup({
                    headers: {
                        'X-XSRF-Token': $('meta[name="_token"]').attr('content')
                    }
                });
                var data =  {
                    product_qty : product_qty,
                    product_token: product_token,
                    _token: '{!! csrf_token() !!}',
                }
                $.ajax({
                    url: "{{route('product.add-to-cart') }}",
                    method: 'POST',
                    contentType:"application/json",
                    dataType: "json",
                    data: JSON.stringify(data),
                    cache: false,
                    success: function(status){
                        if(status.status){
                            $("#cart-info").html(status.info);
                            $('#display-confirmation-'+product_token).modal('hide');
                            $('#product-added').click();
                        }
                        else{
                            console.log(status);
                            toastr.error(status.msg);
                        }

                    },
                    failure: function (result) {
                        console.log(result);
                    }
                });
            }

        }
    </script>
@endsection
