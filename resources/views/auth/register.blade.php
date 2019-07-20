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
        .required
        {
            color: red;
        }
        .single-blog-post .post-content {
            background-color: #f1d9d1;
        }
    </style>
@endsection
@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <section class="breadcumb-area bg-img d-flex align-items-center justify-content-center mb-5" style="background-image: url('images/bg-img/bg-3.jpg');">
        <div class="bradcumbContent">
            <h2>Register</h2>
        </div>
    </section>
    <!-- ##### Blog Area Start ##### -->
    <!-- //banner-text -->
    <div class="blog-area section-padding-0-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="palatin-blog-posts">

                        <!-- ##### Single Blog Post ##### -->
                        <div class="single-blog-post mb-100 wow fadeInUp" data-wow-delay="100ms">
                            <!-- Post Content -->
                            <div class="post-content">
                                <!-- Post Date-->
                                <a href="#" class="post-date btn palatin-btn">Fill every details carefully</a>
                                <!-- Post Title -->
                                <div class="form">
                                    <form action="{{route('register.create')}}" method="post" id="registerform">
                                        {{csrf_field()}}
                                        <div class="alert bg-color">
                                            <h3 class="text-capitalize text-white">Sponsor Details</h3>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="form-group col-md-6">
                                                <input id="sponsorId" type="text" class="margin2 form-control" name="sponsor_id"
                                                       value="{{!empty($sponsorDetails) ? $sponsorDetails['user_name']:old('sponsor_id')}}" placeholder="SPONSOR ID" required="" onchange="getSponsorDetails();">
                                                @if ($errors->has('sponsor_id'))
                                                    <span class="help-block">
                                                        <strong class="text-danger">{{ $errors->first('sponsor_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input id="sponsorName" type="text" class="form-control text-style1" name="sponsor_name" value="{{!empty($sponsorDetails) ? $sponsorDetails['name']:old('sponsor_name')}}" placeholder="SPONSOR NAME" required="" readonly="readonly">
                                                @if ($errors->has('sponsor_name'))
                                                    <span class="help-block">
                                                        <strong class="text-danger">{{ $errors->first('sponsor_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <br>
                                        <div class="alert bg-color">
                                            <h3 class="text-capitalize text-white">Personal Details</h3>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="form-group col-md-6">
                                                <input id="name" type="text" class="margin2 form-control text-style1" name="name" value="{{ old('name') }}" placeholder="FULL NAME AS PER BANK DETAILS" required="">
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input id="user_name" type="text" class="form-control text-style2" name="user_name" value="{{ old('user_name') }}" placeholder="USERNAME" required="">
                                                @if ($errors->has('user_name'))
                                                    <span class="help-block">
                                                        <strong class="text-danger">{{ $errors->first('user_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="form-group col-md-6">
                                                <select class="margin2 form-control" name="state_id" id="state" required="" onchange="getdistricts();">
                                                    <option value=""><-- SELECT STATE --></option>
                                                    @foreach($states as $state)
                                                        <option value="{{$state->id}}" {{$state->id == old('state_id') ? 'selected':''}}>{{$state->name}}</option>
                                                    @endforeach
                                                    @if ($errors->has('state_id'))
                                                        <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('state_id') }}</strong>
                                    </span>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <select class="form-control" name="district_id" required id="district" required="">
                                                    <option value=""><-- SELECT DISTRICT --></option>
                                                    @if ($errors->has('district_id'))
                                                        <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('district_id') }}</strong>
                                    </span>
                                                    @endif
                                                </select>

                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="form-group col-md-6">
                                                <input id="mobile" type="number" class="margin2 form-control" name="mob_no" value="" placeholder="MOBILE NUMBER" required="">
                                                @if ($errors->has('mob_no'))
                                                    <span class="help-block">
                                                        <strong class="text-danger">{{ $errors->first('mob_no') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <br>
                                        <div class="alert bg-color">
                                            <h3 class="text-capitalize text-white">Payment Details</h3>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="form-group col-md-6">
                                                <select class="margin2 form-control" name="bank_id" required="">
                                                    <option value=""><-- SELECT BANK --></option>
                                                    @foreach($banks as $bank)
                                                        <option value="{{$bank->id}}" {{$bank->id == old('bank_id') ? 'selected':''}}>{{$bank->name}}</option>
                                                    @endforeach
                                                    @if ($errors->has('bank_id'))
                                                        <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('bank_id') }}</strong>
                                    </span>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input id="account-number" type="text" class="form-control" name="account_no" value="{{ old('account_no') }}" placeholder="ACCOUNT NUMBER" required="">
                                                @if ($errors->has('account_no'))
                                                    <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('account_no') }}</strong>
                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="form-group col-md-6">
                                                <select id="account-type" class="margin2 form-control text-style1" placeholder="SELECT ACCOUNT TYPE" name="account_type" required="">
                                                    <option value="SAVING"> Saving</option>
                                                    <option value="CURRENT"> Current</option>
                                                    @if ($errors->has('account_type'))
                                                        <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('account_type') }}</strong>
                                    </span>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input id="ifsc-code" type="text" class="form-control text-style1" name="ifsc_code" value="{{ old('ifsc_code') }}" placeholder="BANK IFSC CODE">
                                                @if ($errors->has('ifsc_code'))
                                                    <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('ifsc_code') }}</strong>
                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="form-group col-md-6">
                                                <input id="branch" type="text" class="form-control text-style1" name="branch" value="{{ old('branch') }}" placeholder="BANK BRANCH" required="">
                                                @if ($errors->has('branch'))
                                                    <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('branch') }}</strong>
                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <br>
                                        <div class="alert bg-color">
                                            <h3 class="text-capitalize text-white">Wallet Details</h3>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="form-group col-md-6">
                                                <input id="paytm" type="number" class="margin2 form-control" name="paytm_no" value="{{ old('paytm_no') }}" placeholder="PAYTM NUMBER (OPTIONAL)">
                                                @if ($errors->has('paytm_no'))
                                                    <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('paytm_no') }}</strong>
                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input id="gpay" type="number" class="form-control" name="gpay_no" value="{{ old('gpay_no') }}" placeholder="GPAY NUMBER (OPTIONAL)">
                                                @if ($errors->has('gpay_no'))
                                                    <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('gpay_no') }}</strong>
                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <br>
                                        <div class="alert bg-color">
                                            <h3 class="text-capitalize text-white">Password Details</h3>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="form-group col-md-6">
                                                <input id="password" type="password" class="margin2 form-control" name="password" placeholder="PASSWORD" required="">
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="CONFIRM PASSWORD" required="">
                                            </div>
                                        </div>
                                        <div class="input-group1 mt-3">
                                            <button type="button" class="btn palatin-btn m-2 submit"><i class="fa fa-spinner fa-spin d-none submit-loader"></i> Register </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    <button type="button" class="btn btn-primary" id="verifyOtp"><i class="fa fa-spinner fa-spin d-none verify-loader"></i> Verify OTP</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! $validator->selector('#registerform') !!}
    <script>
        $('.submit').click(function () {
            if($('#registerform').valid())
            {
                $('.submit-loader').removeClass('d-none');
                var number = $('#mobile').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('register.sendOtp') }}",
                    method: 'post',
                    data: {
                        number: number
                    },
                    success: function (result) {
                        $('.submit-loader').addClass('d-none');
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
                        $('.submit-loader').addClass('d-none');
                        swal({
                            title: "Error!",
                            text: "Something went wrong",
                            icon: "error",
                        });
                    }
                });
            }
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
                url: "{{ route('register.getDistricts') }}",
                method: 'post',
                data: {
                    state_id: stateId
                },
                success: function (result) {
                    $('.loader').css('display', 'none');
                    $('#district').empty();
                    $('#district').append('<option value=""><-- SELECT DISTRICT --></option>');
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
                url: "{{ route('register.getSponsorDetails') }}",
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
                    swal({
                        title: "Error!",
                        text: "Invalid Sponsor",
                        icon: "error",
                    });
                }
            });

        }
    </script>
    <script>
        $('#verifyOtp').click(function () {
            $('.verify-loader').removeClass('d-none');
            var otp = $('#otp').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('register.verifyOtp') }}",
                method: 'post',
                data: {
                    otp: otp
                },
                success: function (result) {
                    swal({
                        title: "Success!",
                        text: result.message,
                        icon: "success",
                    }).then((value) => {
                        $('#exampleModal').modal('hide');
                        $('#registerform').submit();
                    });
                },
                error: function (xhr) {
                    $('.verify-loader').addClass('d-none');
                    swal({
                        title: "Error!",
                        text: xhr.responseJSON.error,
                        icon: "error",
                    });
                }
            });
        });
        $("#resend").on('click', function () {
            var number = $('#mobile').val();
            $.ajax({
                url: "{{route('register.sendOtp')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                method: 'post',
                data: {
                    number: number,
                },
                success: function(data){
                    counter();
                    swal({
                        title: "Success!",
                        text: data.message,
                        icon: "success",
                    });
                },
                error: function(xhr, status, error){
                    swal({
                        title: "Error!",
                        text: "Someting went wrong",
                        icon: "error",
                    });
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
