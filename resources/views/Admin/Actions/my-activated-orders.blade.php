@extends('admin_app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">All Orders Activated By Me</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">My Activated Orders</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">My Orders</h4>
                            <p class="card-title-desc">
                                All My Activated Orders
                            </p>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Receipt No</th>
                                    <th>Total Price</th>
                                    <th>Table No</th>
                                    <th>Status</th>
                                    <th>Activated By</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $key => $order)
                                    <tr>
                                        <td>{{$order->receipt_no}}</td>
                                        <td>{{$order->total_price}}</td>
                                        <td>{{$order->table->table_name}}</td>
                                        <td>
                                            @if($order->order_status == 0)
                                                Pending
                                            @elseif($order->order_status == 1)
                                                Completed
                                            @else
                                                Cancel
                                            @endif
                                        </td>
                                        <td>
                                            {{$order->activated_by == null ? "Not Yet Attended To" : $order->activatedBy->first_name}}
                                        </td>
                                        <td>{{$order->created_at}}</td>
                                        <td>
                                            <a href="{{route('admin.view-order-details', ['token' => $order->token])}}">
                                                <span data-toggle="tooltip" data-placement="top" title data-original-title="View Orders Details">
                                                    <i class="mdi mdi-eye-circle mdi-24px"></i>
                                                </span>
                                            </a>
                                            @if($order->order_status == 0)
                                                <a href="{{route('admin.activate-order', ['token' => $order->token])}}">
                                                <span data-toggle="tooltip" data-placement="top" title data-original-title="Mark as Completed">
                                                    <i class="mdi mdi-check mdi-24px"></i>
                                                </span>
                                                </a>
                                            @endif
                                            @if($order->order_status == 1)
                                                <a href="{{route('admin.print-order-details', ['token' => $order->token])}}">
                                                    <span data-toggle="tooltip" data-placement="top" title data-original-title="Print Receipt">
                                                        <i class="mdi mdi-printer mdi-24px"></i>
                                                    </span>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
@endsection

