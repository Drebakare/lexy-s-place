@extends('admin_app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Print Order Receipt</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">Print Receipt</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-title">
                                <h4 class="float-right font-size-16">Order: {{$order->receipt_no}}</h4>
                                <div class="mb-4">
                                    <h4>Lexy's Place</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <address>
                                        <strong>Billed To:</strong><br>
                                        {{$order->user->first_name}},
                                        {{$order->user->last_name}}<br>
                                    </address>
                                </div>
                                {{--<div class="col-sm-6 text-sm-right">
                                    <address class="mt-2 mt-sm-0">
                                        <strong>Shipped To:</strong><br>
                                        Kenny Rigdon<br>
                                        1234 Main<br>
                                        Apt. 4B<br>
                                        Springfield, ST 54321
                                    </address>
                                </div>--}}
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mt-3">
                                    <address>
                                        <strong>Payment By:</strong><br>
                                        {{$order->user->first_name}}
                                    </address>
                                </div>
                                <div class="col-sm-6 mt-3 text-sm-right">
                                    <address>
                                        <strong>Order Date:</strong><br>
                                        {{$order->created_at}}<br><br>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mt-3">
                                    <address>
                                        <strong>Activated By:</strong><br>
                                        {{$order->activatedBy->first_name}}, {{$order->activatedBy->last_name}}
                                    </address>
                                </div>
                            </div>
                            <div class="py-2 mt-3">
                                <h3 class="font-size-15 font-weight-bold">Order summary</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th class="text-right">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->orderSummaries as $key => $product)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$product->product->name}}</td>
                                            <td>{{$product->qty}}</td>
                                            <td class="text-right">{{$product->sub_total}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3" class="text-right">Sub Total</td>
                                        <td class="text-right">{{$order->total_price}}</td>
                                    </tr>
                                    {{--<tr>
                                        <td colspan="3" class="border-0 text-right">
                                            <strong>Shipping</strong></td>
                                        <td class="border-0 text-right">$13.00</td>
                                    </tr>--}}
                                    <tr>
                                        <td colspan="3" class="border-0 text-right">
                                            <strong>Total</strong></td>
                                        <td class="border-0 text-right"><h4 class="m-0">{{$order->total_price}}</h4></td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="d-print-none">
                                <div class="float-right">
                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i class="fa fa-print"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
@endsection

