@extends('admin_app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">View User Details</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">User's Information</h4>
                            <form>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="productname">First Name</label>
                                            <input id="productname"  type="text" class="form-control" value="{{$user->first_name}}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="manufacturerbrand">Email Address</label>
                                            <input id="manufacturerbrand"  type="text" class="form-control" value="{{$user->email}}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Role</label>
                                            <input id="price" type="text" class="form-control" value="{{$user->role->role}}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="manufacturername">Last Name</label>
                                            <input id="manufacturername"  type="text" class="form-control" value="{{$user->last_name}}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="price">DOB</label>
                                            <input id="price" type="text" class="form-control" value="{{$user->DOB}}" disabled>
                                        </div>
                                        @if($user->role_id != 1 && $user->store_id)
                                            <div class="form-group">
                                                <label for="price">Store Name</label>
                                                <input id="price" type="text" class="form-control" value="{{$user->store->store_name}}" disabled>
                                            </div>
                                        @endif
                                        @if($user->role_id == 1 )
                                            <div class="form-group">
                                                <label for="price">Membership Level</label>
                                                <input id="price" type="text" class="form-control" value="{{$user->customerDetail->membership->membership_name}}" disabled>
                                            </div>
                                        @endif
                                     {{--   <div class="form-group">
                                            <label class="control-label">Category</label>
                                            <select class="form-control select2">
                                                <option>Select</option>
                                                <option value="AK">Alaska</option>
                                                <option value="HI">Hawaii</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Features</label>

                                            <select class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose ...">
                                                <option value="AK">Alaska</option>
                                                <option value="HI">Hawaii</option>
                                                <option value="CA">California</option>
                                                <option value="NV">Nevada</option>
                                                <option value="OR">Oregon</option>
                                                <option value="WA">Washington</option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="productdesc">Product Description</label>
                                            <textarea class="form-control" id="productdesc" rows="5"></textarea>
                                        </div>
--}}
                                    </div>
                                </div>
                                <a href="{{route('admin.view-users')}}" class="btn btn-primary mr-1 waves-effect waves-light"> << Go Back</a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
