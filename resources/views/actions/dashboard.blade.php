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
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a href="#dashboad" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                    Dashboard</a>

                                <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>

                                <a href="#transactions" data-toggle="tab"><i class="fa fa-save"></i> Transactions</a>

                                <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Account Settings</a>

                                <a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                            </div>
                        </div>
                        <!-- My Account Tab Menu End -->

                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-12">
                            <div class="tab-content" id="myaccountContent">
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Dashboard</h3>

                                        <div class="welcome">
                                            <p>Hello, <strong>{{Auth::user()->last_name}}</strong>
                                        </div>

                                        <p class="mb-0">Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem IpsumLorem IpsumLorem Ipsum Lorem Ipsum Lorem Ipsum</p>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="orders" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Orders</h3>

                                        <div class="myaccount-table table-responsive text-center">
                                            <table id="orders" class="table table-bordered">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Receipt No</th>
                                                    <th>Price</th>
                                                    <th>Table Number</th>
                                                    <th>Status</th>
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
