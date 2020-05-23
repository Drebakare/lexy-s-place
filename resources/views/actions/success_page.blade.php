@extends('app')
@section('contents')
    <div class="jumbotron text-center">
        <h1 class="display-3">Thank You!</h1>
        <p class="lead"><strong>Your Order is Received and Currently Being Processed.</strong> Kindly Relax as You Await Your Order</p>
        <hr>
        <p>
            Having trouble? <span>Message Our Agent Online</span>
        </p>
        <p class="lead">
            <a style=" background-color: #80bb01 !important; border-color: #80bb01 !important;" class="btn btn-primary btn-sm" href="{{route('user.view-order', ['token' => $order->token])}}">View Your Order</a>
        </p>
    </div>
@endsection
