@extends('app')
@section('contents')
    <div class="breadcrumb-area mb-50">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-container">
                        <ul>
                            <li><a href="{{route('homepage')}}"><i class="fa fa-home"></i> Home</a></li>
                            <li class="active">Login</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content  mb-50">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-xs-12 col-lg-6 mb-30 offset-md-3">
                    <!-- Login Form s-->
                    <form action="{{route('user.login')}}" method="post" >
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Login</h4>
                            @if(count($errors)>0)
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger"  style="margin-top: 10px; margin-left: 10px;">
                                        {{$error}}
                                    </div>
                                @endforeach
                            @endif
                            @if(session('failure'))
                                <div class="alert alert-danger" style="margin-top: 10px; margin-left: 10px;">
                                    {{session('failure')}}
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="alert alert-success" style=" margin-top: 10px; margin-left: 10px;">
                                    {{session('success')}}
                                </div>
                            @endif
                            <div class="row">
                                <div class=" col-md-6 col-12 text-center mb-20">
                                    <a @if(session()->has('age')) href="{{route('login.social',['social' => 'facebook'])}}" @else data-toggle="modal" data-target="#birth-confirmation" @endif class="btn btn-outline-primary btn-block">
                                        <i class="fa fa-facebook"></i> Sign in with Facebook
                                    </a>
                                </div>
                                <div class=" col-md-6 col-12 text-center mb-20">
                                    <a @if(session()->has('age')) href="{{route('login.social',['social' => 'google'])}}" @else data-toggle="modal" data-target="#birth-confirmation" @endif class="btn btn-outline-danger btn-block">
                                        <i class="fa fa-google"></i> Sign in with Google
                                    </a>
                                </div>
                                <div class=" col-12 or-separator">
                                    <i>or</i>
                                </div>
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Email Address*</label>
                                    <input name="email" class="mb-0" type="email" placeholder="Email Address" required>
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Password</label>
                                    <input name="password" class="mb-0" type="password" placeholder="Password" required>
                                </div>
                                <div class="col-md-8">
                                    <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input type="checkbox" id="remember_me">
                                        <label for="remember_me">Remember me</label>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                    <a href="#" data-toggle="modal" data-target="#forgot-password"> Forgotten password?</a>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="register-button mt-0">Login</button>
                                </div>

                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="forgot-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('user.forgot-password')}}" method="post" >
                        @csrf
                        <div class="login-form">
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Email Address*</label>
                                    <input name="email" class="mb-0" type="email" placeholder="Email Address" required>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="register-button mt-0">Proceed</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
