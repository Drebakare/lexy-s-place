@extends('app')
@section('contents')
    <div class="breadcrumb-area mb-50">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-container">
                        <ul>
                            <li><a href="{{route('homepage')}}"><i class="fa fa-home"></i> Home</a></li>
                            <li><a href="#">{{$product->drinkType->name}}</a></li>
                            <li class="active">{{$product->name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="single-product-content ">
        <div class="container">
            <!--=======  single product content container  =======-->
            <div class="single-product-content-container mb-35">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-xs-12">


                        <!-- product image gallery -->
                        <div class="product-image-slider d-flex flex-custom-xs-wrap flex-sm-nowrap align-items-center mb-sm-35">
                            <!--Modal Tab Menu Start-->
                            <div class="product-small-image-list">
                                <div class="nav small-image-slider-single-product" role="tablist">
                                    <div class="single-small-image img-full">
                                        <a data-toggle="tab" id="single-slide-tab-1" href="#single-slide1"><img src="{{asset('_landing/assets/images/products/'. $product->image)}}"
                                                                                                                class="img-fluid" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <!--Modal Tab Menu End-->

                            <!--Modal Tab Content Start-->
                            <div class="tab-content product-large-image-list">
                                <div class="tab-pane fade show active" id="single-slide1" role="tabpanel" aria-labelledby="single-slide-tab-1">
                                    <!--Single Product Image Start-->
                                    <div class="single-product-img easyzoom img-full">
                                        <img src="{{asset('_landing/assets/images/products/'. $product->image)}}" class="img-fluid" alt="">
                                        <a href="{{asset('_landing/assets/images/products/'. $product->image)}}" class="big-image-popup"><i class="fa fa-search-plus"></i></a>
                                    </div>
                                    <!--Single Product Image End-->
                                </div>
                            </div>
                            <!--Modal Content End-->

                        </div>
                        <!-- end of product image gallery -->
                    </div>
                    <div class="col-lg-6 col-md-12 col-xs-12">
                        <!-- product quick view description -->
                        <div class="product-feature-details">
                            <h2 class="product-title mb-15">{{$product->name}}</h2>
                            {{--<p class="product-rating">
                                <i class="fa fa-star active"></i>
                                <i class="fa fa-star active"></i>
                                <i class="fa fa-star active"></i>
                                <i class="fa fa-star active"></i>
                                <i class="fa fa-star"></i>

                                <a href="#">(1 customer review)</a>
                            </p>--}}

                            <h2 class="product-price mb-15">
                                {{--<span class="main-price">$12.90</span>--}}
                                <span class="discounted-price"> N{{number_format($product->price)}}</span>
                            </h2>

                            <p class="product-description mb-20">
                                {{$product->description}}
                            </p>

                            <div class="cart-buttons mb-20">
                                <div class="pro-qty mr-20 mb-xs-20">
                                    <input id="product-qty" type="number" value="1">
                                </div>
                                <div class="add-to-cart-btn">
                                    <button id="add-product-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                </div>
                            </div>
                            <div class="single-product-category mb-20">
                                <h3>Categories: <span><a href="#">{{$product->drinkType->name}}</a></span></h3>
                            </div>


                            <div class="social-share-buttons">
                                <h3>share this product</h3>
                                <ul>
                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- end of product quick view description -->
                    </div>
                </div>
            </div>

            <!--=======  End of single product content container  =======-->

        </div>

    </div>

    <div class="single-product-tab-section mb-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-slider-wrapper">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab"
                                   aria-selected="true">Description</a>
                                <a class="nav-item nav-link" id="features-tab" data-toggle="tab" href="#features" role="tab"
                                   aria-selected="false">Features</a>
                                {{--<a class="nav-item nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                                   aria-selected="false">Reviews (3)</a>--}}
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                <p class="product-desc">
                                    {{$product->description}}
                                </p>
                            </div>
                            <div class="tab-pane fade" id="features" role="tabpanel" aria-labelledby="features-tab">
                                <table class="table-data-sheet">
                                    <tbody>
                                    <tr class="odd">
                                        <td>Name</td>
                                        <td>{{$product->name}}</td>
                                    </tr>
                                    <tr class="even">
                                        <td>Brand</td>
                                        <td>{{$product->brand->brand_name}}</td>
                                    </tr>
                                    <tr class="odd">
                                        <td>Drink Category</td>
                                        <td>{{$product->drinkType->name}}</td>
                                    </tr>
                                    <tr class="even">
                                        <td>Drink Type</td>
                                        <td>
                                            @if($product->acholic == 0)
                                                Non-Alcoholic
                                            @else
                                                Alcoholic
                                            @endif
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                        <h3>Related Products</h3>
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
                                    @foreach($related_products as $related)
                                        <div class="gf-product tab-slider-sub-product col-md-3">
                                            <div class="image">
                                                <a href="{{route('customer.view-product', ['name' => $related->name, 'token' => $related->token])}}">
                                                    <span class="onsale">Sale!</span>
                                                    <img src="{{asset('_landing/assets/images/products/'. $related->image)}}" class="img-fluid" alt="">
                                                </a>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="#">{{$related->drinkType->name}}</a>
                                                </div>
                                                <h3 class="product-title"><a href="#">{{$related->name}}</a></h3>
                                                <div class="price-box">
                                                    <span class="discounted-price">N{{number_format($related->price)}}</span>
                                                    {{--
                                                                                                        <span class="discounted-price">N8,000</span>
                                                    --}}
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach

                                </div>
                                @if(count($related_products) > 8)
                                    <div class="pagination-container mt-4">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <!--=======  pagination-content  =======-->

                                                    <div class=" text-center">
                                                        <div class="">
                                                            <ul>
                                                                <li>
                                                                    <a  href="#" class="btn btn-sm btn-outline-success">  view all >>> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
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
                        <h3>Other Products</h3>
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
                                    @foreach($other_products as $other)
                                        <div class="gf-product tab-slider-sub-product col-md-3">
                                            <div class="image">
                                                <a href="{{route('customer.view-product', ['name' => $other->name, 'token' => $other->token])}}">
                                                    <span class="onsale">Sale!</span>
                                                    <img src="{{asset('_landing/assets/images/products/'. $other->image)}}" class="img-fluid" alt="">
                                                </a>
                                            </div>
                                            <div class="product-content">
                                                <div class="product-categories">
                                                    <a href="#">{{$other->drinkType->name}}</a>
                                                </div>
                                                <h3 class="product-title"><a href="#">{{$other->name}}</a></h3>
                                                <div class="price-box">
                                                    <span class="discounted-price">N{{number_format($other->price)}}</span>
                                                    {{--
                                                                                                        <span class="discounted-price">N8,000</span>
                                                    --}}
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach

                                </div>
                                @if(count($related_products) > 8)
                                    <div class="pagination-container mt-4">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <!--=======  pagination-content  =======-->

                                                    <div class=" text-center">
                                                        <div class="">
                                                            <ul>
                                                                <li>
                                                                    <a  href="#" class="btn btn-sm btn-outline-success">  view all >>> </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
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
                        <h6 style="padding-top: 11px !important;">{{$product->name}} - Effectively Added to Cart</h6>
                        <div class="row" style="padding-top: 11px !important;">
                            <div class="col-lg-6 col-md-6 col-sm-12  mb-3" >
                                <a href="#" class="btn btn-outline-dark mt-0" data-dismiss="modal"><span style="font-size: 14px">Continue Shopping</span></a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12  mb-3">
                                <a  href="#" class="btn btn-outline-success mt-0"><span style="font-size: 14px">View Cart and Checkout</span> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="button" id="product-added" class="btn btn-primary" data-toggle="modal" data-target="#cart-confirmation" hidden>
        ""
    </button>
@endsection
@section('script_contents')
    <script type="text/javascript">
        $(window).on("load",function(){
            $('button#add-product-to-cart').on('click',function(){
                $("button#add-product-to-cart"). attr('disabled', true)
                let product_qty = $("#product-qty").val();
                let product_token = "{{$product->token}}";
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
                            $("button#add-product-to-cart"). attr('disabled', false)
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
            });
        });
    </script>
@endsection
