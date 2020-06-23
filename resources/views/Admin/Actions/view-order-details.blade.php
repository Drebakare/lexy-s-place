@extends('admin_app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">View Order Details</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">View Order Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-centered mb-0 table-nowrap">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->orderSummaries as $product)
                                        <tr>
                                            <td>
                                                {{$product->product->name}}
                                            </td>
                                            <td>
                                                {{$product->price}}
                                            </td>
                                            <td>
                                                {{$product->qty}}
                                            </td>
                                            <td>
                                                {{$product->sub_total}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{--<div class="row mt-4">
                                <div class="col-sm-6">
                                    <a href="ecommerce-products.html" class="btn btn-secondary">
                                        <i class="mdi mdi-arrow-left mr-1"></i> Continue Shopping </a>
                                </div> <!-- end col -->

                            </div>--}} <!-- end row-->
                        </div>
                    </div>
                </div>

            </div>
         </div>
    </div>
@endsection

