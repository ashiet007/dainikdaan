<h5 class="card-title text-uppercase font-weight-bold">Personal Details</h5>
<div class="row">
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Name
                <span class="required">*</span>
            </label>

            <div class="col-md-12">
                <input id="name" type="text" class="form-control text-style1" name="name" value="{{ $user->name }}" placeholder="Full Name As Per Bank Details" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
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
                <input id="user_name" type="text" class="form-control text-style2" name="user_name" value="{{ $user->user_name }}" placeholder="Only Characters & Numbers are Allowed" required autofocus readonly="readonly">

                @if ($errors->has('user_name'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('user_name') }}</strong>
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
                        <option value="{{$state->id}}" {{$state->id == $user->userDetails['state_id'] ? 'selected':''}}>{{$state->name}}</option>
                    @endforeach
                </select>

                @if ($errors->has('state_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('state_id') }}</strong>
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
                    @foreach($districts as $district)
                        <option value="{{$district->id}}" {{$district->id == $user->userDetails['district_id'] ? 'selected':''}}>{{$district->name}}</option>
                    @endforeach
                </select>
                @if ($errors->has('district_id'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('district_id') }}</strong>
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
                <input id="mobile" type="text" class="form-control" name="mob_no" value="{{ $user->userDetails['mob_no'] }}" placeholder="10 Digit Numeric Only" required>

                @if ($errors->has('mob_no'))
                    <span class="help-block">
                        <strong>{{ $errors->first('mob_no') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>
<h5 class="card-title text-dark text-uppercase font-weight-bold">Payment Details</h5>
<div class="row">
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('bank_id') ? ' has-error' : '' }}">
            <label for="bank-name" class="col-md-6 control-label">Bank Name
                <span class="required">*</span>
            </label>
            <div class="col-md-12">
                <select class="form-control" name="bank_id" required="">
                    <option value=""><-- Select bank --></option>
                    @foreach($banks as $bank)
                        <option value="{{$bank->id}}" {{$bank->id == $user->userDetails['bank_id'] ? 'selected':''}}>{{$bank->name}}</option>
                    @endforeach
                </select>
                @if ($errors->has('bank_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('bank_id') }}</strong>
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
                <input id="account-number" type="text" class="form-control" name="account_no" value="{{ $user->userDetails['account_no'] }}" placeholder="Enter Your Account Number">
                @if ($errors->has('account_no'))
                    <span class="help-block">
                        <strong>{{ $errors->first('account_no') }}</strong>
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
                <select class="form-control" name="account_type" required="">
                    <option value=""><-- Select Type --></option>
                        <option value="SAVING" {{'SAVING' == $user->userDetails['account_type'] ? 'selected':''}}>Saving
                        </option>
                    <option value="CURRENT" {{'CURRENT' == $user->userDetails['account_type'] ? 'selected':''}}>Current
                    </option>
                </select>
                @if ($errors->has('account_type'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('account_type') }}</strong>
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
                <input id="ifsc-code" type="text" class="form-control text-style1" name="ifsc_code" value="{{ $user->userDetails['ifsc_code'] }}" placeholder="Bank IFSC Code">
                @if ($errors->has('ifsc_code'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('ifsc_code') }}</strong>
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
                <input id="branch" type="text" class="form-control text-style1" name="branch" value="{{ $user->userDetails['branch'] }}" placeholder="Bank Branch">
                @if ($errors->has('branch'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('branch') }}</strong>
                                </span>
                @endif
            </div>
        </div>
    </div>
</div>
<h5 class="card-title text-dark text-uppercase font-weight-bold">Wallet Payment Details</h5>
<div class="row">
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('paytm_no') ? ' has-error' : '' }}">
            <label for="paytm" class="col-md-6 control-label">Paytm Number</label>
            <div class="col-md-12">
                <input id="paytm" type="text" class="form-control" name="paytm_no" value="{{ $user->userDetails['paytm_no'] }}" placeholder="Paytm Number">
                @if ($errors->has('paytm_no'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('paytm_no') }}</strong>
                                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('gpay_no') ? ' has-error' : '' }}">
            <label for="gpay" class="col-md-6 control-label">GPay Number</label>
            <div class="col-md-12">
                <input id="gpay" type="text" class="form-control" name="gpay_no" value="{{ $user->userDetails['gpay_no'] }}" placeholder="GPay Number">
                @if ($errors->has('gpay_no'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('gpay_no') }}</strong>
                                </span>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-6 control-label">Password
                <span class="required">*</span>
            </label>

            <div class="col-md-12">
                <input id="password" type="password" class="form-control" name="password"
                       placeholder="PASSWORD">

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
                       name="password_confirmation" placeholder="CONFIRM PASSWORD">
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

