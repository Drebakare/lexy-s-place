@extends('app')
@section('contents')
    <div class="jumbotron text-center">
        <h1 class="display-3">Oops!</h1>
        <p class="lead"><strong>Your Payment for Your Order with reference - 1567372gdbssh Could not be Confirmed{{--{{session('receipt_no')}}- {{session('failure')}}--}}.</strong></p>
        <hr>
        <p>
            <span>Kindly, Message One of Our Agent Online For Payment Confirmation</span>
        </p>
        {{--<p class="lead">
            <a style=" background-color: #80bb01 !important; border-color: #80bb01 !important;" class="btn btn-primary btn-sm" href="#">View Your Order</a>
        </p>--}}
    </div>
@endsection
