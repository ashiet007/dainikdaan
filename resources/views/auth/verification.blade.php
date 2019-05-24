@extends('layouts.app')

@section('content')
    <div class="mian-content inner-page">
        <div class="header-top-w3layouts">
            <div class="container">
                <header>
                    @include('partials.headerNavbar')
                </header>
            </div>
        </div>
    </div>
    <!--// banner-text -->
    <!-- /breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home.index') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">Register</li>
    </ol>
    <!-- //breadcrumb -->
    <section class="banner-bottom-w3ls py-lg-5 py-md-5 py-3">
        <div class="container">
            <div class="inner-sec-w3layouts py-lg-5 heading-padding py-3">
                <h3 class="tittle text-center mb-md-5 mb-4">Mobile Verification</h3>
                    @if (Session::has('flash_message'))
                    <div class="container">
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ Session::get('flash_message') }}
                        </div>
                    </div>
                    @endif 
                    <form class="form-horizontal" method="POST" action="{{ route('verification.sendOtp') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('mobile_no') ? ' has-error' : '' }}">
                            <label for="mobile_no" class="col-md-4 control-label">Mobile Number</label>

                            <div class="col-md-6">
                                <input id="mobile_no" type="number" class="form-control" name="mobile_no" value="{{ old('mobile_no') }}" placeholder="Enter Mobile Number" required autofocus>
                                @if ($errors->has('mobile_no'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('mobile_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-4">
                                 <input class="form-control form-submit" type="submit" value="Send OTP">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>           
@endsection
