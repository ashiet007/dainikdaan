@extends('layouts.app')
@section('styles')

    <style type="text/css">
        .text-style1 {
            text-transform: uppercase;
        }

        .text-style2 {
            text-transform: lowercase;
        }

        input.parsley-success,
        select.parsley-success,
        textarea.parsley-success {
            color: #468847;
            background-color: #DFF0D8;
            border: 1px solid #D6E9C6;
        }

        input.parsley-error,
        select.parsley-error,
        textarea.parsley-error {
            color: #B94A48;
            background-color: #F2DEDE;
            border: 1px solid #EED3D7;
        }

        .parsley-errors-list {
            margin: 2px 0 3px;
            padding: 0;
            list-style-type: none;
            font-size: 0.9em;
            line-height: 0.9em;
            opacity: 0;
            color: #B94A48;

            transition: all .3s ease-in;
            -o-transition: all .3s ease-in;
            -moz-transition: all .3s ease-in;
            -webkit-transition: all .3s ease-in;
        }

        .parsley-errors-list.filled {
            opacity: 1;
        }
        .card{
            margin: 15px 0px 15px 0px;
        }
        .card-title{
            margin-bottom: 0px;
        }
        select.form-control option {
            background: #f8f9fa;
        }
        .py-3 {
            padding-top: 1rem !important;
        }
    </style>
@endsection
@section('content')
    <div class="inner-banner">
        @include('partials.homeNav')
    </div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{url('/')}}">Home</a>
        </li>
        <li class="breadcrumb-item active">Register</li>
    </ol>
    <!-- //banner-text -->
    <section class="banner-bottom-w3ls py-lg-5 py-md-5 py-3">
        <div class="container">
            <div class="inner-sec-w3layouts py-lg-5 heading-padding py-3">
                <h3 class="tittle text-center mb-md-5 mb-4">Register</h3>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form-horizontal" id="form" method="POST" action="{{ route('register.register') }}" onkeydown="return event.key != 'Enter';">
                    {{ csrf_field() }}
                    <div class="card border border-success">
                        <div class="card-header bg-success text-white">
                            <h4 class="card-title font-weight-bold">Sponsor Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('sponsor_id') ? ' has-error' : '' }}">
                                        <label for="sponsorId" class="col-md-6 control-label">Sponsor ID
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12">
                                            <input id="sponsorId" type="text" class="form-control" name="sponsor_id"
                                                   value="{{!empty($sponsorDetails) ? $sponsorDetails['user_name']:old('sponsor_id')}}"
                                                   placeholder="SPONSOR ID" data-parsley-trigger="focusout" required=""
                                                   onchange="getSponsorDetails();">
                                            @if ($errors->has('sponsor_id'))
                                                <span class="help-block">
                                                    <strong class="text-danger">{{ $errors->first('sponsor_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('sponsor_name') ? ' has-error' : '' }}">
                                        <label for="sponsorName" class="col-md-6 control-label">Sponsor Name</label>
                                        <div class="col-md-12">
                                            <input id="sponsorName" type="text" class="form-control text-style1"
                                                   name="sponsor_name"
                                                   value="{{!empty($sponsorDetails) ? $sponsorDetails['name']:old('sponsor_name')}}" placeholder="Sponsor Name" required="" readonly="readonly">
                                            @if ($errors->has('sponsor_name'))
                                                <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('sponsor_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border border-success">
                        <div class="card-header bg-success text-white">
                            <h4 class="card-title font-weight-bold">Personal Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Name
                                            <span class="required">*</span>
                                        </label>

                                        <div class="col-md-12">
                                            <input id="name" type="text" class="form-control text-style1" name="name"
                                                   value="{{ old('name') }}" placeholder="Full Name As Per Bank Details"
                                                   data-parsley-trigger="focusout" data-parsley-pattern="/^[A-Za-z\s]+$/"
                                                   data-parsley-minlength="3" data-parsley-maxlength="41" required="">
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                                        <label for="user_name" class="col-md-4 control-label">User Name
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12">
                                            <input id="user_name" type="text" class="form-control text-style2" name="user_name"
                                                   value="{{ old('user_name') }}"
                                                   placeholder="ONLY CHARACTERS & NUMBER ARE ALLOWED"
                                                   data-parsley-trigger="focusout" required=""
                                                   data-parsley-pattern="/^[a-zA-Z]{3}[A-Z0-9a-z]*$/" data-parsley-minlength="3"
                                                   data-parsley-maxlength="21"
                                                   data-parsley-remote="{{route('validation.remote')}}">
                                            @if ($errors->has('user_name'))
                                                <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('user_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('mob_no') ? ' has-error' : '' }}">
                                        <label for="mobile" class="col-md-6 control-label">Mobile
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12">
                                            <input id="mobile" type="number" class="form-control" name="mob_no" value=""
                                                   placeholder="10 DIGIT NUMERIC ONLY" required=""
                                                   data-parsley-trigger="focusout" data-parsley-type="digits"
                                                   data-parsley-minlength="10" data-parsley-maxlength="10">
                                            @if ($errors->has('mob_no'))
                                                <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('mob_no') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">E-Mail Address
                                            <span class="required">*</span>
                                        </label>

                                        <div class="col-md-12">
                                            <input id="email" type="email" class="form-control text-style2" name="email"
                                                   value="{{ old('email') }}" placeholder="E-MAIL ADDRESS"
                                                   data-parsley-trigger="focusout" required="" data-parsley-type="email">

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('state_id') ? ' has-error' : '' }}">
                                        <label for="state" class="col-md-6 control-label">State
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12">
                                            <select class="form-control" name="state_id" id="state" required=""
                                                    onchange="getdistricts();" data-parsley-trigger="focusout">
                                                <option value=""><-- Select state --></option>
                                                @foreach($states as $state)
                                                    <option value="{{$state->id}}" {{$state->id == old('state_id') ? 'selected':''}}>{{$state->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('state_id'))
                                                <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('state_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('district_id') ? ' has-error' : '' }}">
                                        <label for="district" class="col-md-6 control-label">District
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12">
                                            <select class="form-control" name="district_id" required id="district"
                                                    data-parsley-trigger="focusout" required="">
                                                <option value=""><-- Select district --></option>
                                            </select>
                                            @if ($errors->has('district_id'))
                                                <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('district_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display: none">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('alternate_mob_no') ? ' has-error' : '' }}">
                                        <label for="alternate-mobile-number" class="col-md-6 control-label">Alternate Mobile
                                            Number</label>
                                        <div class="col-md-12">
                                            <input id="alternate-mobile-number" type="number" class="form-control"
                                                   name="alternate_mob_no" value="{{ old('alternate_mob_no') }}"
                                                   placeholder="10 DIGIT NUMERIC ONLY" data-parsley-trigger="focusout"
                                                   data-parsley-type="digits" data-parsley-minlength="10"
                                                   data-parsley-maxlength="10">
                                            @if ($errors->has('alternate_mob_no'))
                                                <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('alternate_mob_no') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border border-success">
                        <div class="card-header bg-success text-white">
                            <h4 class="card-title font-weight-bold">Payment Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('bank_id') ? ' has-error' : '' }}">
                                        <label for="bank-name" class="col-md-6 control-label">Bank Name
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12">
                                            <select class="form-control" name="bank_id" data-parsley-trigger="focusout"
                                                    required="">
                                                <option value=""><-- Select bank --></option>
                                                @foreach($banks as $bank)
                                                    <option value="{{$bank->id}}" {{$bank->id == old('bank_id') ? 'selected':''}}>{{$bank->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('bank_id'))
                                                <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('bank_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('account_no') ? ' has-error' : '' }}">
                                        <label for="account-number" class="col-md-6 control-label">Account Number
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12">
                                            <input id="account-number" type="text" class="form-control" name="account_no"
                                                   value="{{ old('account_no') }}" placeholder="ENTER YOUR ACCOUNT NUMBER"
                                                   data-parsley-trigger="focusout" required="">
                                            @if ($errors->has('account_no'))
                                                <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('account_no') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('account_type') ? ' has-error' : '' }}">
                                        <label for="account-type" class="col-md-6 control-label">Account Type
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12">
                                            <select id="account-type" class="form-control text-style1 js-example-basic-single"
                                                    placeholder="Select Type" name="account_type"
                                                    data-parsley-trigger="focusout" required="">
                                                <option value="SAVING"> Saving</option>
                                                <option value="CURRENT"> Current</option>
                                            </select>
                                            @if ($errors->has('account_type'))
                                                <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('account_type') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('ifsc_code') ? ' has-error' : '' }}">
                                        <label for="ifsc-code" class="col-md-6 control-label">Bank IFSC Code
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12">
                                            <input id="ifsc-code" type="text" class="form-control text-style1" name="ifsc_code"
                                                   value="{{ old('ifsc_code') }}" placeholder="BANK IFSC CODE"
                                                   data-parsley-trigger="focusout" required=""
                                                   data-parsley-pattern="/^([A-Z|a-z]{4}[0][A-Z0-9a-z]{6}$)/">
                                            @if ($errors->has('ifsc_code'))
                                                <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('ifsc_code') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('branch') ? ' has-error' : '' }}">
                                        <label for="branch" class="col-md-6 control-label">Bank Branch
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12">
                                            <input id="branch" type="text" class="form-control text-style1" name="branch"
                                                   value="{{ old('branch') }}" placeholder="BANK BRANCH"
                                                   data-parsley-trigger="focusout" required="">
                                            @if ($errors->has('branch'))
                                                <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('branch') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border border-success">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title font-weight-bold">Wallet Payment Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('paytm_no') ? ' has-error' : '' }}">
                                        <label for="paytm" class="col-md-6 control-label">Paytm Number</label>
                                        <div class="col-md-12">
                                            <input id="paytm" type="number" class="form-control" name="paytm_no"
                                                   value="{{ old('paytm_no') }}" placeholder="PAYTM NUMBER"
                                                   data-parsley-trigger="focusout" data-parsley-type="digits" data-parsley-minlength="10"
                                                   data-parsley-maxlength="10">
                                            @if ($errors->has('paytm_no'))
                                                <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('paytm_no') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('gpay_no') ? ' has-error' : '' }}">
                                        <label for="gpay" class="col-md-6 control-label">GPay Number</label>
                                        <div class="col-md-12">
                                            <input id="gpay" type="number" class="form-control" name="gpay_no"
                                                   value="{{ old('gpay_no') }}" placeholder="GPAY NUMBER"
                                                   data-parsley-trigger="focusout" data-parsley-type="digits" data-parsley-minlength="10"
                                                   data-parsley-maxlength="10">
                                            @if ($errors->has('gpay_no'))
                                                <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('gpay_no') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="role" value="User">
                        </div>
                    </div>
                    <div class="card border border-success">
                        <div class="card-header bg-success text-white">
                            <h4 class="card-title font-weight-bold">Password Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-6 control-label">Password
                                            <span class="required">*</span>
                                        </label>

                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control" name="password"
                                                   placeholder="PASSWORD" required="" data-parsley-trigger="focusout"
                                                   data-parsley-minlength="6">

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password-confirm" class="col-md-6 control-label">Confirm Password
                                            <span class="required">*</span>
                                        </label>

                                        <div class="col-md-12">
                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" placeholder="CONFIRM PASSWORD" required=""
                                                   data-parsley-trigger="focusout" data-parsley-equalto="#password"
                                                   data-parsley-minlength="6">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="next">
                            Next
                        </button>
                    </div>
                    <div class="form-group text-center" id="submitButton" style="display: none">
                        <div class="col-md-2 col-md-offset-4">
                            <input class="form-control btn btn-success form-submit" type="submit" value="Submit">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mobile Verification:</h5>
                </div>
                <div class="modal-body">
                    <div class="message">

                    </div>
                    <div class="form-group">
                        <input id="sentOtp" type="hidden" name="sentOtp" value="{{Session::get('otp')}}" id="sentOtp">
                        <label class="control-label col-md-6">Enter OTP</label>
                        <div class="col-md-10">
                            <input type="number" name="otp" class="form-control" id="otp">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="resend">Resend</button> Timer: <span id="count"></span> sec
                    <button type="button" class="btn btn-primary" id="verifyOtp">Verify OTP</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/parsley.min.js')}}"></script>
    <script>
        $('#form').parsley();
    </script>
    <script>
        $('#next').click(function () {
            $('#form').parsley().whenValidate().done(function() {
                var number = $('#mobile').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('home.sendOtp') }}",
                    method: 'post',
                    data: {
                        number: number
                    },
                    success: function (result) {
                        $('#sentOtp').val(result.otp);
                        $('#exampleModal').modal('show');
                        var successHtml = '<div class="alert alert-success">'+
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                            '<strong><i class="glyphicon glyphicon-ok-sign push-5-r"></i></strong> '+ result.message +
                            '</div>';
                        $('.message').html(successHtml);
                        counter();
                    },
                    error: function (xhr) {
                        alert('Someting went wrong');
                    }
                });
            });
        });
    </script>
    <script>
        function getdistricts() {
            $('.loader').show();
            var stateId = $('#state').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('home.getDistricts') }}",
                method: 'post',
                data: {
                    state_id: stateId
                },
                success: function (result) {
                    $('.loader').css('display', 'none');
                    $('#district').empty();
                    $('#district').append('<option value=""><-- Select district --></option>');
                    $.each(result.districts, function (index, value) {
                        $('#district').append($('<option>', {
                            value: index,
                            text: value
                        }));
                    });
                },
                error: function (xhr) {
                    $('.loader').css('display', 'none');
                }
            });
        }

        function getSponsorDetails() {
            $('.loader').show();
            var sponsorId = $('#sponsorId').val();
            $('#sponsorName').val('');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('home.getSponsorDetails') }}",
                method: 'post',
                data: {
                    sponsorId: sponsorId
                },
                success: function (result) {
                    $('.loader').css('display', 'none');
                    $('#sponsorName').val(result.sponsorName);
                    $('#sponsorName').attr('readonly', 'readonly');
                },
                error: function (xhr) {
                    $('.loader').css('display', 'none');
                    alert('Invalid Sponsor');
                }
            });

        }
    </script>
    <script>
        $('#verifyOtp').click(function () {
            var otp = $('#otp').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('home.verifyOtp') }}",
                method: 'post',
                data: {
                    otp: otp
                },
                success: function (result) {
                    var successHtml = '<div class="alert alert-success">'+
                        '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                        '<strong><i class="glyphicon glyphicon-ok-sign push-5-r"></i></strong> '+ result.message +
                        '</div>';
                    $('.message').html(successHtml);
                    $('#exampleModal').modal('hide');
                    $('#next').css('display','none');
                    $('#submitButton').css('display','block');
                },
                error: function (xhr) {
                    var successHtml = '<div class="alert alert-danger">'+
                        '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                        '<strong><i class="glyphicon glyphicon-ok-sign push-5-r"></i></strong> '+ xhr.responseJSON.error +
                        '</div>';
                    $('.message').html(successHtml);
                }
            });
        });
        $("#resend").on('click', function () {
            var number = $('#mobile').val();
            $.ajax({
                url: "{{route('home.sendOtp')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                method: 'post',
                data: {
                    number: number,
                },
                success: function(data){
                    counter();
                    $('#sentOtp').val(data.otp);
                    var successHtml = '<div class="alert alert-success">'+
                        '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                        '<strong><i class="glyphicon glyphicon-ok-sign push-5-r"></i></strong> '+ data.message +
                        '</div>';
                    $('.message').html(successHtml);
                },
                error: function(xhr, status, error){
                    alert('Someting went wrong');
                }
            });
        });
    </script>
    <script type="text/javascript">

        function counter(){
                var counter = 100;
                setInterval(function() {
                    counter--;
                    if (counter >= 0) {
                        $('#resend').attr('disabled','disabled');
                        span = document.getElementById("count");
                        span.innerHTML = counter;
                    }
                    // Display 'counter' wherever you want to display it.
                    if (counter === 0) {
                        $('#resend').removeAttr('disabled');
                        clearInterval(counter);
                    }

                }, 1000);
        }

    </script>
@endsection
