@extends('admin_app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Create Period</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">Create Period</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add a New Booking Period</h4>
                            <p class="card-title-desc">Fill all information below. Ensure all fields are filled Properly as deleting will not be possible after adding a new booking period</p>
                            <form method="post" action="{{route('submit-period-form')}}" enctype="multipart/form-data" >
                                @csrf
                                <div class="row pb-5">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="productname">Period</label>
                                            <input id="productname" name="period" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="productname">Price</label>
                                            <input id="productname" name="price" type="number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="productname">Select Room</label>
                                            <select name="room_id" class="form-control" required>
                                                @foreach($rooms as $room)
                                                    <option value="{{$room->id}}">{{$room->room_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mr-1 waves-effect waves-light">Add new Period</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Periods</h4>
                            <p class="card-title-desc">
                                List of Periods
                            </p>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Reference</th>
                                    <th>Period</th>
                                    <th>Room</th>
                                    <th>Price</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($periods as $key => $period)
                                    <tr>
                                        <td>{{$period->id}}</td>
                                        <td>{{$period->token}}</td>
                                        <td>{{$period->period}}</td>
                                        <td>{{$period->room->room_name}}</td>
                                        <td>{{$period->price}}</td>
                                        <td>{{$period->created_at}}</td>
                                        <td>
                                            <a href="#edit-period-{{$key}}" data-toggle="modal">
                                                <span data-toggle="tooltip" data-placement="top" title data-original-title="Edit Period Details">
                                                    <i class="mdi mdi-square-edit-outline mdi-24px"></i>
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

    @foreach($periods as $key => $period)
        <div class="modal fade" id="edit-period-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Edit Period Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="card-title">Edit Period Details</h4>
                    <p class="card-title-desc">Fill all information below correct.</p>
                    <form method="post" action="{{route('edit-period-details', ['token' => $period->token])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row pb-5">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="productname">Period</label>
                                    <input id="productname" value="{{$period->period}}" name="period" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="productname">Price</label>
                                    <input id="productname" name="price" value="{{$period->price}}" type="number" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="productname">Select Room</label>
                                    <select name="room_id" class="form-control" required>
                                        @foreach($rooms as $room)
                                            <option value="{{$room->id}}">{{$room->room_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mr-1 waves-effect waves-light">Edit Period Details</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach
@endsection
