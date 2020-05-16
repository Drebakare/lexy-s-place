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
                                    <th class="pro-thumbnail">Image</th>
                                    <th class="pro-title">Product</th>
                                    <th class="pro-price">Price</th>
                                    <th class="pro-quantity">Quantity</th>
                                    <th class="pro-subtotal">Total</th>
                                    <th class="pro-remove">Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="pro-thumbnail"><a href="#"><img src="{{asset('_landing/assets/images/products/product20.jpg')}}" class="img-fluid" alt="Product"></a></td>
                                    <td class="pro-title"><a href="#">Lorem Ipsum lorem ipsum</a></td>
                                    <td class="pro-price"><span>N2,000</span></td>
                                    <td class="pro-quantity"><div class="pro-qty"><input type="text" value="3"></div></td>
                                    <td class="pro-subtotal"><span>N6,000</span></td>
                                    <td class="pro-remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="pro-thumbnail"><a href="#"><img src="{{asset('_landing/assets/images/products/product20.jpg')}}" class="img-fluid" alt="Product"></a></td>
                                    <td class="pro-title"><a href="#">Lorem Ipsum lorem ipsum</a></td>
                                    <td class="pro-price"><span>N2,000</span></td>
                                    <td class="pro-quantity"><div class="pro-qty"><input type="text" value="3"></div></td>
                                    <td class="pro-subtotal"><span>N6,000</span></td>
                                    <td class="pro-remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="pro-thumbnail"><a href="#"><img src="{{asset('_landing/assets/images/products/product20.jpg')}}" class="img-fluid" alt="Product"></a></td>
                                    <td class="pro-title"><a href="#">Lorem Ipsum lorem ipsum</a></td>
                                    <td class="pro-price"><span>N2,000</span></td>
                                    <td class="pro-quantity"><div class="pro-qty"><input type="text" value="3"></div></td>
                                    <td class="pro-subtotal"><span>N6,000</span></td>
                                    <td class="pro-remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
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

                            <div class="discount-coupon">
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
                            </div>

                            <!--=======  End of Discount Coupon  =======-->

                        </div>


                        <div class="col-lg-6 col-12 d-flex">
                            <!--=======  Cart summery  =======-->

                            <div class="cart-summary">
                                <div class="cart-summary-wrap">
                                    <h4>Cart Summary</h4>
                                    <p>Sub Total <span>N18,000.00</span></p>
                                    <p>Shipping Cost <span>$00.00</span></p>
                                    <h2>Grand Total <span>N18,000.00</span></h2>
                                </div>
                                <div class="cart-summary-button">
                                    <button class="checkout-btn">Checkout</button>
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
@endsection
