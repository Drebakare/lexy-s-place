@extends('admin_app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Raise Order</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">Raise Order</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Order's Information</h4>
                            <h6>Kindly supply correct information</h6>
                                <div class="row mt-5">
                                    <div class="col-sm-6 ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="control-label">Store</label>
                                                    <select name="store" id="products-list" class="form-control select2" >
                                                        <option value="" selected disabled>Select Product</option>
                                                        @foreach($products as $product)
                                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="manufacturerbrand">Qty Left in Stock</label>
                                                    <input name="stock-qty" id="stock-qty"  type="number" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="manufacturerbrand">Qty to Buy</label>
                                                        <input name="qty" id="buy-qty"  type="number" class="form-control" min="1" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" id="add-product-btn" class="btn btn-outline-primary mr-1 waves-effect waves-light">Add Product</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title mb-3">Order Summary</h4>

                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr id="summary-title">
                                                                <th>Product</th>
                                                                <th>Qty</th>
                                                                <th>Price/Unit</th>
                                                                <th>Sub Price (N)</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Total :</th>
                                                                <th></th>
                                                                <th></th>
                                                                <th id="total-price">0</th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <button type="submit" class="mt-3 btn btn-outline-success mr-1 waves-effect waves-light">Process Order</button>
                                                </div>
                                                <!-- end table-responsive -->
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{--<div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Users</h4>
                            <p class="card-title-desc">
                                View all users on lexican
                            </p>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>First Name</th>
                                    <th>Role</th>
                                    <th>Level</th>
                                    <th>Activeness</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($users as $key => $user)
                                    <tr>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->first_name}}</td>
                                        <td>
                                            {{$user->role->role}}
                                        </td>
                                        <td>
                                            @if($user->role_id == 1)
                                                {{$user->customerDetail->membership->membership_name}}
                                            @else
                                                Staff
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->active == 1)
                                                Active
                                            @else
                                                Suspended
                                            @endif
                                        </td>
                                        <td>
                                            {{$user->created_at}}
                                        </td>
                                        <td>
                                            @if($user->role_id == 1)
                                                <a href="#edit-user-{{$key}}" data-toggle="modal" >
                                                    <span data-toggle="tooltip" data-placement="top" title data-original-title="Edit User's Membership Level">
                                                        <i class="mdi mdi-account-convert mdi-24px"></i>
                                                    </span>
                                                </a>
                                            @endif
                                            <a href="{{route('admin.view-user-details', ['token' => $user->token])}}">
                                                <span data-toggle="tooltip" data-placement="top" title data-original-title="View User's Details">
                                                    <i class="mdi mdi-eye-circle mdi-24px"></i>
                                                </span>
                                            </a>
                                            @if($user->active == 1)
                                                <a href="{{route('admin.suspend-user', ['token' => $user->token])}}">
                                                    <span data-toggle="tooltip" data-placement="top" title data-original-title="Suspend User">
                                                        <i class="mdi mdi-close-thick mdi-24px"></i>
                                                    </span>
                                                </a>
                                            @else
                                                <a href="{{route('admin.activate-user', ['token' => $user->token])}}">
                                                    <span data-toggle="tooltip" data-placement="top" title data-original-title="Activate User">
                                                        <i class="mdi mdi-check-outline mdi-24px"></i>
                                                    </span>
                                                </a>
                                            @endif
--}}{{--
                                            <button class="btn btn-sm btn-outline-primary waves-effect waves-light" data-toggle="modal" data-target="#edit-store-{{$key}}"> Edit</button>
--}}{{--
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>--}}
             </div>
         </div>
    </div>
    {{--@foreach($users as $key => $user)
        <div class="modal fade" id="edit-user-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Edit User's Membership Level</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="card-title">Edit Membership Level</h4>
                    <p class="card-title-desc">Fill all information below correct.</p>
                    <form method="post" action="{{route('edit-membership-details', ['token' => $user->token])}}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="productname">User Email</label>
                                    <input id="productname" value="{{$user->email}}" name="store_name" type="text" class="form-control" required disabled>
                                </div>
                            </div>
                            @if($user->role_id == 1)
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="productname">Change Membership Level</label>
                                        <select name="membership_level" class="form-control" required>
                                            @foreach($memberships as $membership)
                                                <option value="{{$membership->id}}" @if($user->customerDetail->membership->id == $membership->id) selected @endif>{{$membership->membership_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success mr-1 waves-effect waves-light">Edit Membership</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach--}}
    <meta name="_token" content="{{ app('Illuminate\Encryption\Encrypter')->encrypt(csrf_token()) }}" />
@endsection
@section('script_contents')
    <script type="text/javascript">
        $(window).on('load', function () {
            var app = @json($products);
            var product_app = {}
            for (let j=app.length-1; j >= 0; j--){
                key_value = app[j].id;
                value = app[j];
                product_app[key_value] = value;
            }
            var cart = [];
            var store_id = {{Auth::user()->store_id}};
            $('select#products-list').on('change', function () {
                let product_id = $('select#products-list').val();
                if (product_id != null){
                    $('button#add-product-btn').attr('disabled', true);
                    fetchStockDetails(product_id,store_id)
                }
                else{
                    toastr.error("No Product is Selected");
                }
            })
            $('button#add-product-btn').on('click',function () {
                let product_id = $('select#products-list').val();
                let qty = $('input#buy-qty').val();
                if (product_id != null && qty != null){
                    $('button#add-product-btn').attr('disabled', true);
                    let selected_product = product_app[product_id];
                    if (cart.length == 0){
                        let product_data = {
                            token: selected_product.token,
                            name: selected_product.name,
                            quantity: qty,
                            price: selected_product.price
                        }
                        cart.push(product_data);
                        let total = 0
                        for (let i = 0 ; i < cart.length; i++){
                            total = total + cart[i].price * cart[i].quantity;
                            let html ='<tr id="product-'+1+'"><th>' + cart[i].name + '</th>'
                                html+='<th>' + cart[i].quantity + '</th>'
                                html+='<th>' + cart[i].price + '</th>'
                                html +='<th>' + cart[i].price * cart[i].quantity + '</th>'
                                html +='</tr>'
                                $(html).insertAfter('#summary-title');
                        }
                        $('th#total-price').html(total)
                        toastr.success('Product Successfully Added');
                        $('button#add-product-btn').attr('disabled', false);
                    }
                    else{
                        for (let i = 0 ; i < cart.length; i++){
                            if (cart[i].token === selected_product.token){
                                toastr.error('Product Already Exist')
                                $('button#add-product-btn').attr('disabled', false);
                                return
                            }
                        }
                        let product_data = {
                            token: selected_product.token,
                            name: selected_product.name,
                            quantity: qty,
                            price: selected_product.price
                        }
                        cart.push(product_data);
                        let total = 0
                        for(let k = 0; k < cart.length; k++){
                            $('tr#product-'+k+'').remove()
                        }
                        for (let i = 0 ; i < cart.length; i++){
                            total = total + cart[i].price * cart[i].quantity;
                            let html ='<tr id="product-'+1+'"><th>' + cart[i].name + '</th>'
                            html+='<th>' + cart[i].quantity + '</th>'
                            html+='<th>' + cart[i].price + '</th>'
                            html +='<th>' + cart[i].price * cart[i].quantity + '</th>'
                            html +='</tr>'
                            $(html).insertAfter('#summary-title');
                        }
                        $('th#total-price').html(total)
                        toastr.success('Product Successfully Added');
                        $('button#add-product-btn').attr('disabled', false);
                        console.log(cart);
                    }
                }
                else{
                    toastr.error("No Product or Qty is Selected");
                }
            })
            function fetchStockDetails(product_id, store) {
                $.ajaxSetup({
                    headers: {
                        'X-XSRF-Token': $('meta[name="_token"]').attr('content')
                    }
                });
                var data =  {
                    product_id: product_id,
                    _token: '{!! csrf_token() !!}',
                    store_id: store,
                }
                $.ajax({
                    url: "{{route('order.fetch-stock') }}",
                    method: 'POST',
                    contentType:"application/json",
                    dataType: "json",
                    data: JSON.stringify(data),
                    cache: false,
                    success: function(stock){
                        if(stock.status){
                            $('input#stock-qty').val(stock.data)
                            $('button#add-product-btn').attr('disabled', false);
                            toastr.success(stock.msg);
                        }
                        else{
                            toastr.error(stock.msg);
                        }
                    },
                    failure: function (stock) {
                        console.log(stock);
                    }
                });
            }
        })
    </script>
@endsection
