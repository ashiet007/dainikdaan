@extends('layouts.backend')

@section('content')
    <section class="py-5 col-md-12">
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="h6 text-uppercase mb-0">Security</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.changeSecurity') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                                <label for="current_password" class="col-md-6 control-label">Current Password
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input id="current_password" type="password" class="form-control" name="current_password" placeholder="CURRENT PASSWORD" required="required">
                                    @if ($errors->has('current_password'))
                                        <span class="help-block">
                    <strong>{{ $errors->first('current_password') }}</strong>
                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-6 control-label">New Password
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="NEW PASSWORD" required="required">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password-confirm" class="col-md-6 control-label">Confirm Password
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="CONFIRM PASSWORD" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <input class="form-submit btn btn-primary" type="submit" value="Update Password" onclick="return confirm('Confirm update?');">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection