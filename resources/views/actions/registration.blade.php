@extends('app')
@section('contents')
    <div class="breadcrumb-area mb-50">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-container">
                        <ul>
                            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                            <li class="active">Registration</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content  mb-50">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-xs-12 col-lg-6 offset-md-3">
                    <form action="{{route('user.registration')}}" method="post">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Register</h4>
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
                                <div class="col-md-6 col-12 mb-20">
                                    <label>First Name</label>
                                    <input name="first_name" class="mb-0" type="text" placeholder="First Name" required>
                                </div>
                                <div class="col-md-6 col-12 mb-20">
                                    <label>Last Name</label>
                                    <input name="last_name" class="mb-0" type="text" placeholder="Last Name" required>
                                </div>
                                <div class="col-md-6 col-12 mb-20">
                                    <label>Email Address*</label>
                                    <input name="email" class="mb-0" type="email" placeholder="Email Address" required>
                                </div>
                                <div class="col-md-6 col-12 mb-20">
                                    <label>Date of Birth*</label>
                                    <input name="dob" class="mb-0" type="date" placeholder="DOB" required>
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Password</label>
                                    <input name="password" class="mb-0" type="password" placeholder="Password" required>
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Confirm Password</label>
                                    <input name="password_confirmation" class="mb-0" type="password" placeholder="Confirm Password" required>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="register-button mt-0">Register</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
