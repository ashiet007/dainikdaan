@extends('layouts.backend')
@section('styles')
<style type="text/css">
    .select2-container--default .select2-selection--multiple {
    background-color: white;
    border: 1px solid #aaa;
    border-radius: 4px;
    cursor: text;
}
   .text-style1{
        text-transform: uppercase;
    }
    .text-style2{
        text-transform: lowercase;
    }
</style>
@endsection
@section('content')
<section class="py-5 col-md-12">
    <div class="container-fluid">
        <div class="row admin">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center font-weight-bold text-uppercase">Create New User</div>
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('user.createUser') }}">
                        {{ csrf_field() }}
                        <h5 class="card-title font-weight-bold text-uppercase">Sponsor Details</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('sponsor_id') ? ' has-error' : '' }}">
                                        <label for="sponser-id" class="col-md-6 control-label">Sponsor ID
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12">
                                            {!! Form::select('sponsor_id',$sponsorId,null,('required' == 'required') ? ['class' => 'js-example-basic-single form-control', 'required' => 'required','placeholder' => 'Select Username','onchange' =>'getSponsorDetails()','id'=>'sponsorId'] : ['class' => 'js-example-basic-single form-control','placeholder' => 'Select Username','onchange' =>'getSponsorDetails()','id'=>'sponsorId']) !!}
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
                                                   value="{{!empty($sponsorDetails) ? $sponsorDetails['name']:old('sponsor_name')}}"
                                                   placeholder="Sponsor Name" data-parsley-trigger="focusout" required=""
                                                   readonly="readonly">
                                            @if ($errors->has('sponsor_name'))
                                                <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('sponsor_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('identity') ? ' has-error' : '' }}">
                                        <label for="identity" class="col-md-6 control-label">Identity</label>

                                        <div class="col-md-12">
                                            <select id="identity" name="identity" class="form-control js-example-basic-single" required="required">
                                                <option value="fake"> Fake</option>
                                            </select>
                                            @if ($errors->has('identity'))
                                                <span class="help-block">
                                                    <strong class="text-danger">{{ $errors->first('identity') }}</strong>
                                                </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <h5 class="card-title font-weight-bold text-uppercase">Personal Details</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Name
                                            <span class="required">*</span>
                                        </label>

                                        <div class="col-md-12">
                                            <input id="name" type="text" class="form-control text-style1" name="name" value="{{ old('name') }}" placeholder="Full Name As Per Bank Details" required autofocus>

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
                                            <input id="user_name" type="text" class="form-control text-style2" name="user_name" value="{{ old('user_name') }}" placeholder="Only Characters & Numbers are Allowed" required autofocus>

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
                                        <label for="mobile" class="col-md-6 control-label">Mobile Number
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12">
                                            <input id="mobile" type="number" class="form-control" name="mob_no" value="{{ old('mob_no') }}" placeholder="10 Digit Numeric Only" required>

                                            @if ($errors->has('mob_no'))
                                                <span class="help-block">
                                                    <strong class="text-danger">{{ $errors->first('mob_no') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('alternate_mob_no') ? ' has-error' : '' }}">
                                        <label for="alternate-mobile-number" class="col-md-6 control-label">Alternate Mobile Number</label>
                                        <div class="col-md-12">
                                            <input id="alternate-mobile-number" type="number" class="form-control" name="alternate_mob_no" value="{{ old('alternate_mob_no') }}" placeholder="10 Digit Numeric Only">
                                            @if ($errors->has('alternate_mob_no'))
                                                <span class="help-block">
                                                    <strong class="text-danger">{{ $errors->first('alternate_mob_no') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>                           
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('state_id') ? ' has-error' : '' }}">
                                        <label for="state_id" class="col-md-6 control-label">State
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12">
                                            <select class="form-control" name="state_id" id="state" required="" onchange="getdistricts();">
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
                                        <label for="district_id" class="col-md-6 control-label">District
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12">
                                            <select class="form-control" name="district_id" id="district" required="">
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">E-Mail Address
                                            <span class="required">*</span>
                                        </label>

                                        <div class="col-md-12">
                                            <input id="email" type="email" class="form-control text-style2" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        <h5 class="card-title font-weight-bold text-uppercase">Payment Details</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('bank_id') ? ' has-error' : '' }}">
                                        <label for="bank-name" class="col-md-6 control-label">Bank Name
                                           <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12">
                                            {!! Form::select('bank_id',$banks,null,('required' == 'required') ? ['class' => 'js-example-basic-single form-control', 'required' => 'required','placeholder' => 'Select Bank...'] : ['class' => 'js-example-basic-single form-control','placeholder' => 'Select Bank...']) !!}
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
                                            <input id="account-number" type="text" class="form-control text-style1" name="account_no" value="{{ old('account_no') }}" placeholder="Enter Your Account Number">
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
                                            <select id="account-type" name="account_type" placeholder="Choose Account Type..." class="form-control js-example-basic-single">
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
                                            <input id="ifsc-code" type="text" class="form-control text-style1" name="ifsc_code" value="{{ old('ifsc_code') }}" placeholder="Bank IFSC Code">
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
                                            <input id="branch" type="text" class="form-control text-style1" name="branch" value="{{ old('branch') }}" placeholder="Bank Branch">
                                            @if ($errors->has('branch'))
                                                <span class="help-block">
                                                    <strong class="text-danger">{{ $errors->first('branch') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>                         
                            </div>
                        <h5 class="card-title font-weight-bold text-uppercase">Wallet Payment Details</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('paytm_no') ? ' has-error' : '' }}">
                                        <label for="paytm" class="col-md-6 control-label">Paytm Number</label>
                                        <div class="col-md-12">
                                            <input id="paytm" type="text" class="form-control" name="paytm_no" value="{{ old('paytm_no') }}" placeholder="Paytm Number">
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
                                            <input id="gpay" type="text" class="form-control" name="gpay_no" value="{{ old('gpay_no') }}" placeholder="GPay Number">
                                            @if ($errors->has('gpay_no'))
                                                <span class="help-block">
                                                    <strong class="text-danger">{{ $errors->first('gpay_no') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>                           
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="role" value="User">
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-6 control-label">Password
                                            <span class="required">*</span>
                                        </label>

                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

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
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2 col-md-offset-4">
                                    <input class="btn btn-primary" type="submit" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script type="text/javascript">
// $(document).ready(function() {
//     $(".js-example-basic-multiple").select2();
// });
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
@endsection