@extends('app')
@section('contents')
    <div class="breadcrumb-area mb-50">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-container">
                        <ul>
                            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                            <li class="active">Book Room</li>
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
                    <form action="{{route('user.final-bookings')}}" method="post">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Book Room</h4>
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
                                    <label>Choose Available Room and Period</label>
                                    <select name="period" id="table-number" class=" js-example-basic-single" style="width: 100%; min-height: 40px !important; " required>
                                        <option value=""> Select A Period</option>
                                        @foreach($periods as $period)
                                            <option value="@if($membership_id == 1 && $period->room_id == 2) @else{{$period->id}}@endif" @if($membership_id == 1 && $period->room_id == 2) disabled @endif>{{$period->room->room_name}} - ( {{$period->period}} ) ( N {{number_format($period->price)}} ) @if($membership_id == 1 && $period->room_id == 2) not Eligible @endif </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="register-button mt-0">Book Room</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
