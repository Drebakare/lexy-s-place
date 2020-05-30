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
                            <li><a href="{{route('user.dashboard')}}"><i class="fa fa-user"></i> Dashboard</a></li>
                            <li class="active"> Order</li>
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
                                    <th class="pro-title">Reference</th>
                                    <th class="pro-title">Product</th>
                                    <th class="pro-price">Unit Price</th>
                                    <th class="pro-quantity">Quantity</th>
                                    <th class="pro-subtotal">Total Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($summaries as $key => $summary)
                                    <tr>
                                        {{--
                                        <td class="pro-thumbnail"><a href="#"><img src="{{asset('_landing/assets/images/products/product20.jpg')}}" class="img-fluid" alt="Product"></a></td>
--}}
                                        <td class="pro-title">{{$summary->token}}</td>
                                        <td class="pro-title"><a href="{{route('customer.view-product', ['name' => $summary->product->name, 'token' => $summary->product->token])}}">{{$summary->product->name}}</a></td>
                                        <td class="pro-price"><span>{{$summary->price}}</span></td>
                                        <td class="pro-quantity">
                                            <div class="pro-qty">
                                                <input {{--onblur="update_quantity('{{$product["token"]}}', {{$product["quantity"]}})"--}} id="input-quantity-3" type="number" value="{{$summary->qty}}" disabled>
                                            </div></td>
                                        <td class="pro-subtotal"><span>{{$summary->sub_total}}</span></td>
{{--
                                        <td class="pro-remove"><a href="#" onclick="remove_product('{{$product['token']}}')"><i class="fa fa-trash-o"></i></a></td>
--}}
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
                                    <h4>Order Summary</h4>
                                    <p>Sub Total <span>N {{number_format($get_order->total_price)}}</span></p>
                                    <p>Shipping Cost <span>N 00.00</span></p>
                                    <p>Payment Status <span>{{$get_order->status == 0 ? "Pending" : "Finished"}}</span></p>
                                    <p>Order Status <span>{{$get_order->order_status == 0 ? "Pending" : "Finished"}}</span></p>
                                    <h2>Total Price <span>N {{number_format($get_order->total_price)}}</span></h2>
                                    <h2>Total Paid <span>N {{number_format($get_order->total_paid)}}</span></h2>
                                </div>
                            </div>

                            <!--=======  End of Cart summery  =======-->

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


