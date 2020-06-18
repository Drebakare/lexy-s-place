@extends('admin_app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">View Products</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">View Products</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add a New Product</h4>
                            <p class="card-title-desc">Fill all information below. Ensure all fields are filled Properly as deleting will not be possible after adding a new product</p>
                            <form method="post" action="{{route('submit-product-form')}}" enctype="multipart/form-data" >
                                @csrf
                                <div class="row pb-5">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="productname">Product Name</label>
                                            <input id="productname" name="name" type="text" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="productname">Select Product Brand</label>
                                            <select name="brand" class="form-control" required>
                                                @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="productname">Select Product Type</label>
                                            <select name="drink_type" class="form-control" required>
                                                @foreach($drink_types as $drink_type)
                                                    <option value="{{$drink_type->id}}">{{$drink_type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="productname">Price</label>
                                            <input id="productname" name="price" type="number" class="form-control" min="0" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="productname">Alcoholic</label>
                                            <select name="isalcoholic" class="form-control" required>
                                                <option value="0">Non Alcoholic</option>
                                                <option value="1">Alcoholic</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="productname">Empty</label>
                                            <select name="hasempty" class="form-control" required>
                                                <option value="0">No Empty</option>
                                                <option value="1">Has Empty</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="card-title">Image Upload</h4>
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input" id="customFile" accept="image/*" required>
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="productdesc">Product Description</label>
                                            <textarea name="description" class="form-control" id="productdesc" rows="5" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mr-1 waves-effect waves-light">Add Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Products</h4>
                            <p class="card-title-desc">
                                View all Lexy's Place Products
                            </p>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Drink Type</th>
                                    <th>Price</th>
                                    <th>Alcoholic</th>
                                    <th>Reference</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                    @foreach($products as $key => $product)
                                        <tr>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->brand->brand_name}}</td>
                                            <td>{{$product->drinkType->name}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->alcoholic == 0 ? "None Alcoholic" : "Alcoholic" }}</td>
                                            <td>{{$product->token }}</td>
                                            <td>
                                                <a href="#view-description-{{$key}}" data-toggle="modal" >
                                                    <span data-toggle="tooltip" data-placement="top" title data-original-title="View Product's Description">
                                                        <i class="mdi mdi-eye mdi-24px"></i>
                                                    </span>
                                                </a>
                                                <a href="#view-image-{{$key}}" data-toggle="modal" >
                                                    <span data-toggle="tooltip" data-placement="top" title data-original-title="View Product's Image">
                                                        <i class="mdi mdi-image mdi-24px"></i>
                                                    </span>
                                                </a>
                                                <a href="#edit-product-{{$key}}" data-toggle="modal" >
                                                    <span data-toggle="tooltip" data-placement="top" title data-original-title="Edit Product's Details">
                                                        <i class="mdi mdi-circle-edit-outline mdi-24px"></i>
                                                    </span>
                                                </a>
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
    @foreach($products as $key => $product)
       <div class="modal fade" id="view-description-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-sm">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title mt-0" id="mySmallModalLabel">Product Description</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <h5 class=" text-center">
                       {{$product->description}}
                   </h5>
               </div>
           </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
   @endforeach
    @foreach($products as $key => $product)
        <div class="modal fade" id="view-image-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="mySmallModalLabel">Product's Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="justify-content-center">
                            <img src="{{asset('_landing/assets/images/products/'.$product->image)}}" class="img-fluid" alt="">
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
   @endforeach
   @foreach($products as $key => $product)
       <div class="modal fade" id="edit-product-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title mt-0" id="mySmallModalLabel">Edit Product's Details</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <h4 class="card-title">Edit Product's Details</h4>
                   <p class="card-title-desc">Fill all information below correct.</p>
                   <form method="post" action="{{route('edit-product-details', ['token' => $product->token])}}">
                       @csrf
                       <div class="row pb-5">
                           <div class="col-sm-6">
                               <div class="form-group">
                                   <label for="productname">Product Name</label>
                                   <input id="productname" value="{{$product->name}}" name="name" type="text" class="form-control" required>
                               </div>
                           </div>

                           <div class="col-sm-6">
                               <div class="form-group">
                                   <label for="productname">Select Product Brand</label>
                                   <select name="brand" class="form-control" required>
                                       @foreach($brands as $brand)
                                           <option value="{{$brand->id}}" @if($product->brand_id == $brand->id) selected @endif>{{$brand->brand_name}}</option>
                                       @endforeach
                                   </select>
                               </div>
                           </div>

                           <div class="col-sm-6">
                               <div class="form-group">
                                   <label for="productname">Select Product Type</label>
                                   <select name="drink_type" class="form-control" required>
                                       @foreach($drink_types as $drink_type)
                                           <option value="{{$drink_type->id}}" @if($product->drink_type_id == $drink_type->id) selected @endif>{{$drink_type->name}}</option>
                                       @endforeach
                                   </select>
                               </div>
                           </div>

                           <div class="col-sm-6">
                               <div class="form-group">
                                   <label for="productname">Price</label>
                                   <input id="productname" value="{{$product->price}}" name="price" type="number" class="form-control" min="0" required>
                               </div>
                           </div>

                           <div class="col-sm-6">
                               <div class="form-group">
                                   <label for="productname">Alcoholic</label>
                                   <select name="isalcoholic" class="form-control" required>
                                       <option value="0" @if($product->alcoholic == 0) selected @endif>Non Alcoholic</option>
                                       <option value="1" @if($product->alcoholic == 1) selected @endif>Alcoholic</option>
                                   </select>
                               </div>
                           </div>

                           <div class="col-sm-6">
                               <div class="form-group">
                                   <label for="productname">Empty</label>
                                   <select name="hasempty" class="form-control" required>
                                       <option value="0" @if($product->has_empty == 0) selected @endif>No Empty</option>
                                       <option value="1" @if($product->has_empty == 1) selected @endif>Has Empty</option>
                                   </select>
                               </div>
                           </div>
                           <div class="col-sm-6">
                               <h4 class="card-title">Image Upload</h4>
                               <div class="custom-file">
                                   <input type="file" name="image" class="custom-file-input" id="customFile" accept="image/*" >
                                   <label class="custom-file-label" for="customFile">Choose file</label>
                               </div>
                           </div>

                           <div class="col-sm-6">
                               <div class="form-group">
                                   <label for="productdesc">Product Description</label>
                                   <textarea name="description" class="form-control" id="productdesc" rows="5" required>{{$product->description}}</textarea>
                               </div>
                           </div>
                       </div>
                       <button type="submit" class="btn btn-success mr-1 waves-effect waves-light">Edit Product Details</button>
                   </form>
               </div>
           </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
   @endforeach
@endsection
