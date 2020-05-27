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
                            <li class="active">Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====  End of breadcrumb area  ======-->

    <!--=============================================
    =            Checkout page content         =
    =============================================-->

    <div class="page-section section mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12 offset-md-2">
                    <!-- Checkout Form s-->
                    <form action="{{route('user.make-payment')}}" class="checkout-form" method="post">
                        @csrf
                        <div class="row row-40">
                            <div class="col-lg-7">
                                <div class="row">
                                    <!-- Cart Total -->
                                    <div class="col-12 mb-20">

                                        <h4 class="checkout-title">Cart Total</h4>

                                        <div class="checkout-cart-total">

                                            <h4>Product <span>Total</span></h4>
                                                <ul>
                                                    @foreach(session()->get('cart') as $key => $product)
                                                        <li>{{$product['name']}} x {{$product['quantity']}} <span>{{$product['price'] * $product['quantity']}}</span></li>
                                                    @endforeach
                                                </ul>


                                            <p>Sub Total <span>N {{number_format($total)}}</span></p>
                                            <p>Shipping Fee <span>N 00.00</span></p>
                                            <p style="font-size: x-small">
                                              Tax  <span>VAT of N {{number_format($total * ($tax->tax/(100 + $tax->tax)))}} inclusive</span>

                                            </p>
                                            <h4>Grand Total <span>N {{number_format($total)}}</span></h4>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 ">

                                <!-- Billing Address -->
                                <div id="billing-form" class="mb-40">
                                    <h4 class="checkout-title">Sitting Location</h4>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Table*</label>
                                            <select name="table" id="table-number" class="nice-select">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <input value="{{$total}}" name="amount" hidden>
                                        <div class="col-md-6 mt-md-4" >
                                            <button type="submit"  class="place-order" style="width: 100% !important; height: 45px !important; background-color: #80bb01 !important;"> Make Payment Online</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

