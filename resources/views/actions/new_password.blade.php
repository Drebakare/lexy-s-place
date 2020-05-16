@extends('app')
@section('contents')
    <div class="breadcrumb-area mb-50">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-container">
                        <ul>
                            <li><a href="{{route('homepage')}}"><i class="fa fa-home"></i> Home</a></li>
                            <li class="active">Change Password</li>
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
                    <form action="{{route('user.final-change-password')}}" method="post" >
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Change Password</h4>
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
                                <div class="col-md-12 col-12 mb-20">
                                    <label>New Password</label>
                                    <input name="password" class="mb-0" type="password" placeholder="New Password" required>
                                    <input name="token" value="{{$token}}" hidden>
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Confirm Password</label>
                                    <input name="password_confirmation" class="mb-0" type="password" placeholder=" Confirm Password" required>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="register-button mt-0">Change Password</button>
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
