@extends('app')
@section('contents')
    <div class="jumbotron text-center">
        <h1 class="display-3">Thank You!</h1>
        <p class="lead"><strong>Your Transaction with Transaction-Id -{{$wallet->token}}- was Successful</strong></p>
        <hr>
        <p>
            Having trouble? <span>Message Our Agent Online</span>
        </p>
        <p class="lead">
            <a style=" background-color: #80bb01 !important; border-color: #80bb01 !important;" class="btn btn-primary btn-sm" href="{{route('user.dashboard')}}">View Your Balance</a>
        </p>
    </div>
@endsection
