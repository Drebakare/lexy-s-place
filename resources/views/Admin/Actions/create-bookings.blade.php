@extends('admin_app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Create Bookings</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">Create Bookings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add a New Booking</h4>
                            <p class="card-title-desc">Fill all information below. Ensure all fields are filled Properly as deleting will not be possible after adding a new booking</p>
                            <form method="post" action="{{route('submit-booking-form')}}" enctype="multipart/form-data" >
                                @csrf
                                <div class="row pb-5">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="productname">Select Period</label>
                                            <select name="period_id" class="form-control" required>
                                                @foreach($periods as $period)
                                                    <option value="{{$period->id}}">{{$period->period}} in {{$period->room->room_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mr-1 waves-effect waves-light">Add new Booking</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Bookings</h4>
                            <p class="card-title-desc">
                                List of Exisiting Periods
                            </p>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Period</th>
                                    <th>Room</th>
                                    <th>Receipt No</th>
                                    <th>Activated By</th>
                                    <th>Status</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($bookings as $key => $booking)
                                    <tr>
                                        <td>{{$booking->user->first_name}}</td>
                                        <td>{{$booking->period->period}}</td>
                                        <td>{{$booking->period->room->room_name}}</td>
                                        <td>{{$booking->receipt_no}}</td>
                                        <td>{{$booking->activated_by == null ? "Null" : $booking->activatedBy->first_name}}</td>
                                        <td>{{$booking->booking_status == 0 ? "Pending" : "Completed"}}</td>
                                        <td>{{$booking->created_at}}</td>
                                        <td>
                                            @if($booking->booking_status == 1)
                                                <a href="{{route('admin.cancel-booking', ['token' => $booking->token])}}">
                                                <span data-toggle="tooltip" data-placement="top" title data-original-title="Pend Booking">
                                                    <i class="mdi mdi-close-thick mdi-24px"></i>
                                                </span>
                                                </a>

                                                <a href="{{route('admin.print-booking-receipt', ['token' => $booking->token])}}">
                                                <span data-toggle="tooltip" data-placement="top" title data-original-title="Print Receipt">
                                                    <i class="mdi mdi-printer mdi-24px"></i>
                                                </span>
                                                </a>
                                            @else
                                                <a href="{{route('admin.confirm-booking', ['token' => $booking->token])}}">
                                                <span data-toggle="tooltip" data-placement="top" title data-original-title="Mark as Completed">
                                                    <i class="mdi mdi-bookmark-check mdi-24px"></i>
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
