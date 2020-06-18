@extends('admin_app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Create Drink Type</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">Create Drink Type</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add a New Drink Type</h4>
                            <p class="card-title-desc">Fill all information below. Ensure all fields are filled Properly as deleting will not be possible after adding a new drink type</p>
                            <form method="post" action="{{route('submit-drinktype-form')}}" enctype="multipart/form-data" >
                                @csrf
                                <div class="row pb-5">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="productname"> Drink Type</label>
                                            <input id="productname" name="name" type="text" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="productname">Select Drink Type Category</label>
                                            <select name="drink_category" class="form-control" required>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
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
                                </div>
                                <button type="submit" class="btn btn-success mr-1 waves-effect waves-light">Add Drink Type</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Drink Types</h4>
                            <p class="card-title-desc">
                                List of Drink Types
                            </p>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Reference</th>
                                    <th>Drink Type</th>
                                    <th>Drink Category</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($drink_types as $key => $drink_type)
                                    <tr>
                                        <td>{{$drink_type->id}}</td>
                                        <td>{{$drink_type->token}}</td>
                                        <td>{{$drink_type->name}}</td>
                                        <td>{{$drink_type->drinkCategory->name}}</td>
                                        <td>{{$drink_type->created_at}}</td>
                                        <td>
                                            <a href="#edit-drink-{{$key}}" data-toggle="modal">
                                                <span data-toggle="tooltip" data-placement="top" title data-original-title="Edit Drink Type Details">
                                                    <i class="mdi mdi-square-edit-outline mdi-24px"></i>
                                                </span>
                                            </a>
                                            <a href="#view-image-{{$key}}" data-toggle="modal">
                                                <span data-toggle="tooltip" data-placement="top" title data-original-title="View Drink Type Image">
                                                    <i class="mdi mdi-eye mdi-24px"></i>
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
    @foreach($drink_types as $key => $drink_type)
        <div class="modal fade" id="view-image-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Drink Type Displayed Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="justify-content-center">
                        <img src="{{asset('_landing/assets/images/products/'.$drink_type->image)}}" class="img-fluid" alt="">
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach

    @foreach($drink_types as $key => $drink_type)
        <div class="modal fade" id="edit-drink-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Edit Drink Type Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="card-title">Edit Drink Type Details</h4>
                    <p class="card-title-desc">Fill all information below correct.</p>
                    <form method="post" action="{{route('edit-drink-details', ['token' => $drink_type->token])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="productname"> Drink Type</label>
                                    <input value="{{$drink_type->name}}" id="productname" name="name" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="productname">Select Drink Type Category</label>
                                    <select name="drink_category" class="form-control" required>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if($category->id == $drink_type->category_id) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h4 class="card-title">Image Upload</h4>
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="customFile" accept="image/*">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mr-1 waves-effect waves-light">Edit Drink Type</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach
@endsection
