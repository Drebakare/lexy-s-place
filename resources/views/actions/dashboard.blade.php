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
                            <li class="active">My Account</li>
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


    <div class="my-account-section section position-relative mb-50 fix">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="row">

                        <!-- My Account Tab Menu Start -->
                        <div class="col-lg-3 col-12">
                            <div class="card align-items-center">
                                <div class="mt-25">
                                    <img src="{{asset('_landing/assets/images/user.png')}}" class="card-img-top" style="height: 100px; width: 100px" alt="...">
                                </div>
                                <div class="card-body text-center">
                                    <h5>{{Auth::user()->first_name. " " . Auth::user()->last_name}}</h5>
                                    <h5>{{Auth::user()->email}}</h5>
                                    <h5 style="color: #80bb01">N {{number_format($customer_details->credit_balance)}}</h5>
                                    <i class="fa fa-id-badge"></i> {{$customer_details->membership->membership_name}}
                                </div>
                            </div>
                            <div class="myaccount-tab-menu nav" role="tablist">
                                {{--<a href="#dashboad" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                    Dashboard</a>--}}

                                <a  class="active" href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>

                                <a href="#transactions" data-toggle="tab"><i class="fa fa-exchange"></i> Transactions</a>

                                <a href="#recharge" data-toggle="tab"><i class="fa fa-google-wallet"></i> Credit Wallet </a>

                                <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Account Settings</a>

                                <a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                            </div>
                        </div>

                        <div class="col-lg-9 col-12">
                            <div class="tab-content" id="myaccountContent">
                                <!-- Single Tab Content Start -->
                                {{--<div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Dashboard</h3>
                                        --}}{{--<div class="row">
                                            <div class="col-md-4 col-lg-4 col-sm-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row align-items-center">
                                                            <div class="col-md-10 col-sm-10">
                                                                <h6 class="text-uppercase text-muted mb-2">Value</h6>
                                                                <span class="h5 mb-0"> #24000</span>
                                                                <span class="badge badge-success mt-n1">30%</span>
                                                            </div>
                                                            <div class="col-md-2 col-sm-2">
                                                                <span class="h3 fa fa-dollar text-muted mb-0"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>--}}{{--
                                        <div class="row card" style="border-color: white!important; height: 200px!important;">
                                                <div class="row card-body">
                                                    <div class="col-md-4 text-center align-items-center col-sm-6">
                                                        <h4>N 20,000</h4>
                                                        <p style="font-size: small">Total Spent</p>
                                                        <img src="{{asset('_landing/assets/images/sound.png')}}" style="width: 120px; height: 60px" />
                                                    </div>
                                                    <div class="col-md-4 text-center align-items-center col-sm-6">
                                                        <h4>N 20,000</h4>
                                                        <p style="font-size: small">Total Spent</p>
                                                        <img src="{{asset('_landing/assets/images/shopping.png')}}" style="width: 60px; height: 60px" />
                                                    </div>
                                                    <div class="col-md-4 text-center align-items-center col-sm-6">
                                                        <h4>N 20,000</h4>
                                                        <p style="font-size: small">Total Spent</p>
                                                        <img src="{{asset('_landing/assets/images/shopping.png')}}" style="width: 60px; height: 60px" />
                                                    </div>
                                                </div>

                                        </div>
                                        <div class="welcome">
                                            <p>Hello, <strong>{{Auth::user()->last_name}}</strong>
                                        </div>

                                        <p class="mb-0">Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem IpsumLorem IpsumLorem Ipsum Lorem Ipsum Lorem Ipsum</p>
                                    </div>
                                </div>--}}
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade show active" id="orders" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Orders</h3>

                                        <div class="myaccount-table table-responsive text-center">
                                            <table id="orders" class="table table-bordered">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Receipt No</th>
                                                    <th>Price</th>
                                                    <th>Table Number</th>
                                                    <th>Payment Status</th>
                                                    <th>Order Status</th>
                                                    <th>Date</th>
                                                    {{--<th></th>--}}
                                                    <th>Action</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($orders as $order)
                                                    <tr>
                                                        <td>{{$order->receipt_no}}</td>
                                                        <td>{{$order->total_price}}</td>
                                                        <td> Table - {{$order->table_id}}</td>
                                                        <td>{{$order->status == 0 ? 'Pending' : "Finished"}}</td>
                                                        <td>{{$order->order_status == 0 ? 'Pending' : "Finished"}}</td>
                                                        <td>{{Carbon\Carbon::parse($order->created_at)->format('d/m/Y')}}</td>
                                                        <td><a href="{{route('user.view-order', ['token' => $order->token])}}" class="btn">View</a></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="transactions" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>My Transactions</h3>
                                        <div class="myaccount-table table-responsive text-center">
                                            <table id="transactions" class="table table-bordered">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Transaction ID</th>
                                                    <th>Transaction Type</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($transactions as $transaction)
                                                    <tr>
                                                        <td>{{$transaction->transaction_no}}</td>
                                                        <td>{{$transaction->transaction_type}}</td>
                                                        <td>{{$transaction->amount}}</td>
                                                        <td>{{$transaction->transaction_status == 0 ? "Pending" : "Finished"}}</td>
                                                        <td>{{Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y')}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <div class="tab-pane fade" id="recharge" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Credit History</h3>
                                        <div class="row mt-5">
                                            @foreach($credits as $credit)
                                                @if($credit->transaction_type == 'Credit - Wallet')
                                                    <div class="col-md-4 col-sm-4">
                                                        <div class="wrimagecard wrimagecard-topimage">
                                                            <a href="#credit-wallet" data-toggle="modal" {{--data-target="#birth-confirmation"--}}>
                                                                <div class="wrimagecard-topimage_header" style="background-color: rgba(22, 160, 133, 0.1)">
                                                                   <span style="font-size: large"> N {{number_format($credit->amount)}}</span><center><i class="fa fa-credit-card" style="color:#BB7824"> </i></center>
                                                                </div>
                                                                <div class="wrimagecard-topimage_title" >
                                                                    <h4>
                                                                        <span style="font-size: small">{{$credit->transaction_no}}
                                                                            @if($credit->transaction_status == 0)
                                                                                <i class="fa fa-times" style="color:red; font-size: 20px !important;"></i>
                                                                            @else
                                                                                <i class="fa fa-check" style="color:#80bb01; font-size: 20px!important;"></i>
                                                                            @endif
                                                                        </span>
                                                                        <div class="pull-right badge" id="WrForms"></div>
                                                                    </h4>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                            <div class="col-md-4 col-sm-4">
                                                <div class="wrimagecard wrimagecard-topimage">
                                                    <a href="#credit-wallet" data-toggle="modal" {{--data-target="#birth-confirmation"--}}>
                                                        <div class="wrimagecard-topimage_header" style="background-color:  rgba(213, 15, 37, 0.1)">
                                                            <center><i class="fa fa-plus" style="color:#80bb01"> </i></center>
                                                        </div>
                                                        <div class="wrimagecard-topimage_title" >
                                                            <h4> New Credit
                                                                <div class="pull-right badge" id="WrForms"></div>
                                                            </h4>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                       {{-- @if(count($credits) > 5)
                                            <div class="pagination-container mt-4">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <!--=======  pagination-content  =======-->
                                                            <div class="text-center">
                                                                <div class="offset-md-5 offset-4">
                                                                    <ul>
                                                                        <li>
                                                                            {{$credits->links()}}
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif--}}
                                    </div>
                                </div>

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="account-info" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Account Settings</h3>

                                        <div class="account-details-form">
                                            <form action="{{route('user.update-profile')}}" method="post" class="mb-50">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-6 col-12 mb-30">
                                                        <input name="first_name" id="first_name" placeholder="First Name" value="{{Auth::user()->last_name != null ? Auth::user()->last_name : "Nill" }}" type="text">
                                                    </div>

                                                    <div class="col-lg-6 col-12 mb-30">
                                                        <input name="last_name" id="last_name" placeholder="Last Name" value="{{Auth::user()->first_name != null ? Auth::user()->first_name : "Nill" }}" type="text">
                                                    </div>

                                                    <div class="col-6 mb-30">
                                                        <input id="email" value="{{Auth::user()->email}}" placeholder="Email Address" type="email" disabled>
                                                    </div>
                                                    <div class="col-6 mb-30">
                                                        <input id="dob" placeholder="DOB" type="date" value="{{Auth::user()->DOB}}" disabled>
                                                    </div>

                                                    <div class="col-12">
                                                        <button type="submit" class="save-change-btn">Save Changes</button>
                                                    </div>

                                                </div>
                                            </form>
                                            <form action="{{route('user.change-password')}}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12 mb-30"><h4>Password change</h4></div>

                                                    <div class="col-12 mb-30">
                                                        <input name="old_password" id="current-pwd" placeholder="Current Password" type="password">
                                                    </div>

                                                    <div class="col-lg-6 col-12 mb-30">
                                                        <input name="password" id="new-pwd" placeholder="New Password" type="password">
                                                    </div>

                                                    <div class="col-lg-6 col-12 mb-30">
                                                        <input name="password_confirmation" id="confirm-pwd" placeholder="Confirm Password" type="password">
                                                    </div>

                                                    <div class="col-12">
                                                        <button class="save-change-btn">Proceed</button>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                            </div>
                        </div>
                        <!-- My Account Tab Content End -->
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="credit-wallet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <div class="logo mt-20 mb-10">
                            <h5 style="color: #80bb01">Credit Wallet</h5>
                        </div>
                        <h5> Kindly Provide the Detail Below</h5>
                        <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 mb-20">
                            <form action="{{route('user.credit-wallet')}}" method="post">
                                @csrf
                                <div class="login-form">
                                    <h6>Enter Transaction Details Below</h6>
                                    <div class="row">
                                        <div class="col-md-12 col-12 mb-20">
                                            <label>Amount</label>
                                            <input name="amount" class="mb-0" type="number" placeholder="Credit Amount" required>
                                        </div>
                                        <div class="col-6 offset-md-3 offset-sm-2 offset-xs-2">
                                            <button type="submit" class="register-button mt-0">Proceed</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <h6>This site uses cookies and by entering, you acknowledge that you have read our privace and cookie notice</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====  End of Cart page content  ======-->
@endsection
@section('script_contents')
    <script type="text/javascript">
        $(document).ready(function() {
            $('table#orders').DataTable({
                "order" : [[4,'desc']]
            });
        } );

        $(document).ready(function() {
            $('table#transactions').DataTable({
                "order" : [[4,'desc']]
            });
        } );
    </script>
@endsection
