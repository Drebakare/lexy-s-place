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
                            <li class="active">Cart</li>
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


    <div class="page-section section mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#">
                        <!--=======  cart table  =======-->

                        <div class="cart-table table-responsive mb-40">
                            <table class="table">
                                <thead>
                                <tr>
{{--
                                    <th class="pro-thumbnail">Image</th>
--}}
                                    <th class="pro-title">Product</th>
                                    <th class="pro-price">Unit Price</th>
                                    <th class="pro-quantity">Quantity</th>
                                    <th class="pro-subtotal">Total Price</th>
                                    <th class="pro-remove">Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(session()->get('cart') as $key => $product)
                                    <tr>
{{--
                                        <td class="pro-thumbnail"><a href="#"><img src="{{asset('_landing/assets/images/products/product20.jpg')}}" class="img-fluid" alt="Product"></a></td>
--}}
                                        <td class="pro-title"><a href="#">{{$product["name"]}}</a></td>
                                        <td class="pro-price"><span>{{$product["price"]}}</span></td>
                                        <td class="pro-quantity">
                                            <div class="pro-qty">
                                                <input onblur="update_quantity('{{$product["token"]}}', {{$product["quantity"]}})" id="input-quantity-{{$product["token"]}}" type="number" value="{{$product["quantity"]}}">
                                                <a href="#"  onclick="increment_quantity('{{$product["token"]}}')" class="inc qty-btn">+</a>
                                                <a href="#" onclick="decrement_quantity('{{$product["token"]}}')" class= "dec qty-btn">-</a>
                                            </div></td>
                                        <td class="pro-subtotal"><span>{{$product["price"] * $product["quantity"] }}</span></td>
                                        <td class="pro-remove"><a href="#" onclick="remove_product('{{$product['token']}}')"><i class="fa fa-trash-o"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!--=======  End of cart table  =======-->


                    </form>

                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <!--=======  Calculate Shipping  =======-->


                            <!--=======  End of Calculate Shipping  =======-->

                            <!--=======  Discount Coupon  =======-->

                            {{--<div class="discount-coupon">
                                <h4>Discount Coupon Code</h4>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-25">
                                            <input type="text" placeholder="Coupon Code">
                                        </div>
                                        <div class="col-md-6 col-12 mb-25">
                                            <input type="submit" value="Apply Code">
                                        </div>
                                    </div>
                                </form>
                            </div>--}}

                            <!--=======  End of Discount Coupon  =======-->

                        </div>


                        <div class="col-lg-6 col-12 d-flex">
                            <!--=======  Cart summery  =======-->

                            <div class="cart-summary">
                                <div class="cart-summary-wrap">
                                    <h4>Cart Summary</h4>
                                    <p>Sub Total <span>N {{number_format($total)}}</span></p>
                                    <p>Shipping Cost <span>N 00.00</span></p>
                                    <h2>Grand Total <span>N {{number_format($total)}}</span></h2>
                                </div>
                                <div class="cart-summary-button">
                                    <button onclick="location.href='{{route('cart.checkout')}}'" class="checkout-btn">Checkout</button>
                                    <button class="update-btn">Update Cart</button>
                                </div>
                            </div>

                            <!--=======  End of Cart summery  =======-->

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--=====  End of Cart page content  ======-->
    <meta name="_token" content="{{ app('Illuminate\Encryption\Encrypter')->encrypt(csrf_token()) }}" />
    <meta name="_token" content="{{ app('Illuminate\Encryption\Encrypter')->encrypt(csrf_token()) }}" />
@endsection
@section('script_contents')
    <script type="text/javascript">
        function increment_quantity(cart_id) {
            $("#input-quantity-"+cart_id). attr('disabled', true);
            var inputQuantityElement = $("#input-quantity-"+cart_id);
            var newQuantity = parseInt($(inputQuantityElement).val())+1;
            /*$(inputQuantityElement).val(newQuantity);*/
            updateCart(cart_id, newQuantity);
        }
        function decrement_quantity(cart_id) {
            var inputQuantityElement = $("#input-quantity-"+cart_id);
            if($(inputQuantityElement).val() > 1)
            {
                $("#input-quantity-"+cart_id). attr('disabled', true);
                var newQuantity = parseInt($(inputQuantityElement).val()) - 1;
                /*$(inputQuantityElement).val(newQuantity);*/
                updateCart(cart_id, newQuantity);
            }
        }
        function update_quantity(cart_id, previous_qty) {
            var inputQuantityElement = $("#input-quantity-"+cart_id);
            var newQuantity = parseInt($(inputQuantityElement).val());
            if (newQuantity === 0){
                toastr.error("Product Quantity Cannot be less than Zero");
                $(inputQuantityElement).val(previous_qty);
            }
            else{
                updateCart(cart_id,newQuantity)
            }
        }
        function remove_product(cart_id) {
            removeProductInCart(cart_id);
        }
        function updateCart(product_token, updated_quatity) {
            $.ajaxSetup({
                headers: {
                    'X-XSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });
            var data =  {
                product_qty : updated_quatity,
                token: product_token,
                _token: '{!! csrf_token() !!}',
            }
            $.ajax({
                url: "{{route('product.update-cart') }}",
                method: 'POST',
                contentType:"application/json",
                dataType: "json",
                data: JSON.stringify(data),
                cache: false,
                success: function(status){
                    if(status.status){
/*
                        $("#cart-info").html(status.info);
*/
                        /*$("button#add-product-to-cart"). attr('disabled', false)*/
                        /*$('#product-added').click();*/
                        toastr.success(status.msg);
                        location.reload();

                    }
                    else{
                        toastr.error(status.msg);
                    }

                },
                failure: function (result) {
                    console.log(result);
                }
            });
        }

        function removeProductInCart(product_token) {
            $.ajaxSetup({
                headers: {
                    'X-XSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });
            var data =  {
                token: product_token,
                _token: '{!! csrf_token() !!}',
            }
            $.ajax({
                url: "{{route('cart.remove-product') }}",
                method: 'POST',
                contentType:"application/json",
                dataType: "json",
                data: JSON.stringify(data),
                cache: false,
                success: function(status){
                    if(status.status){
/*
                        $("#cart-info").html(status.info);
*/
                        /*$("button#add-product-to-cart"). attr('disabled', false)*/
                        /*$('#product-added').click();*/
                        toastr.success(status.msg);
                        location.reload();
                    }
                    else{
                        toastr.error(status.msg);
                        location.reload();
                    }

                },
                failure: function (result) {
                    console.log(result);
                }
            });
        }

    </script>
@endsection

