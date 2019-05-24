@extends('layouts.app')

@section('content')
    <div class="inner-banner">
        @include('partials.homeNav')
    </div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item active">Forget Password</li>
    </ol>
    <!-- //banner-text -->
    <section class="banner-bottom-w3ls py-lg-5 py-md-5 py-3">
        <div class="container">
            <div class="inner-sec-w3layouts py-lg-5 heading-padding py-3">
                <h3 class="tittle text-center mb-md-5 mb-4">Forget Password</h3>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                     @if (session('flash_message'))
                        <div class="alert alert-danger">
                            {{ session('flash_message') }}
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <div class="alert alert-danger">
                            Enter Your Username and Your Password will be send to your mobile number.
                        </div>
                        <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                            <label for="user_name" class="col-md-4 control-label">Username</label>
                            <div class="col-md-6">
                                <input id="user_name" type="text" class="form-control" name="user_name" value="{{ old('user_name') }}" placeholder="Enter your username" required>

                                @if ($errors->has('user_name'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-4">
                                <input class="form-control btn btn-success form-submit" type="submit" value="Send Password">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
