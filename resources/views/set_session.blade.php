<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title Of Site -->
    <title>Lexy's Place</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS
	============================================ -->
    <!-- Bootstrap CSS -->
    <link href="{{asset('_landing/assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- FontAwesome CSS -->
    <link href="{{asset('_landing/assets/css/font-awesome.min.css')}}" rel="stylesheet">

    <!-- Elegent CSS -->
    <link href="{{asset('_landing/assets/css/font-awesome.min.css')}}" rel="stylesheet">

    <!-- Plugins CSS -->
    <link href="{{asset('_landing/assets/css/plugins.css')}}" rel="stylesheet">

    <!-- Helper CSS -->
    <link href="{{asset('_landing/assets/css/helper.css')}}" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{asset('_landing/assets/css/main.css')}}" rel="stylesheet">

    <!-- Modernizer JS -->
    <script src="{{asset('_landing/assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Fav and Touch Icons -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body style="background-image: url("{{asset('_landing/assets/images/sliders/home1-slider1.jpeg')}}")">
<div class="modal fade" id="store_session_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <div class="logo mt-20 mb-10">
                        <a href="{{route('homepage')}}">
                            <h4 style="color: #80bb01">Lexican Investment LTD</h4>
                        </a>
                    </div>
                    <h5> Lets know what branch You are Visiting</h5>
                    <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 mb-20">
                        <form action="{{route('set-store-session')}}" method="post">
                            @csrf
                            <div class="login-form">
                                <h4>Select Store</h4>
                                <div class="row">
                                    <label>Select Store Branch</label>
                                    <select name="store" id="table-number" class="nice-select">
                                        @foreach(\App\Helpers\Stores::Stores() as $store)
                                            <option value="{{$store->id}}">{{$store->store_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="col-6 offset-md-3 offset-sm-2 offset-xs-2">
                                        <button type="submit" class="register-button mt-0">Select</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<button type="button" id="set_store_session" class="btn btn-primary" data-toggle="modal" data-target="#store_session_form" hidden>
</button>
<!-- JS
============================================ -->
<!-- jQuery JS -->
<script src="{{asset('_landing/assets/js/vendor/jquery.min.js')}}"></script>

<!-- Popper JS -->
<script src="{{asset('_landing/assets/js/popper.min.js')}}"></script>

<!-- Bootstrap JS -->
<script src="{{asset('_landing/assets/js/bootstrap.min.js')}}"></script>

<!-- Plugins JS -->
<script src="{{asset('_landing/assets/js/plugins.js')}}"></script>

<!-- Main JS -->
<script src="{{asset('_landing/assets/js/main.js')}}"></script>

{{--// paystack--}}
<script src="https://js.paystack.co/v1/inline.js"></script>

<script src="{{asset('_landing/assets/js/paystackjs.js')}}"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">
    @if(session('failure'))
    toastr.error('{{session("failure")}}');
    @endif
    @if(count($errors)>0)
    @foreach($errors->all() as $error)
    toastr.error('{{$error}}');
    @endforeach
    @endif
    @if(session('success'))
    toastr.success('{{session("success")}}');
    @endif

</script>
<script type="text/javascript">
    /* $( document ).ready(function() {
{{--@if(!Auth::check() && !session()->has('age'))
                $('#click_me').click();
            @endif--}}
    });*/
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
<script type="text/javascript">
    $( document ).ready(function() {
        @if(!session()->has('check_store_session'))
        $('button#set_store_session').click();
        @endif
    });
</script>
</body>
</html>
