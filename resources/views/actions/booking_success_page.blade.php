@extends('app')
@section('contents')
    <div class="jumbotron text-center">
        <h1 class="display-3">Thank You!</h1>
        <p class="lead"><strong>Your Booking with Booking-Id -{{$booking->receipt_no}}- was Successful</strong></p>
        <hr>
        <p>
            Having trouble? <span>Message Our Agent Online</span>
        </p>
        <p class="lead">
            <a style=" background-color: #80bb01 !important; border-color: #80bb01 !important;" class="btn btn-primary btn-sm" href="{{route('user.dashboard')}}">View Bookings</a>
        </p>
    </div>
@endsection
