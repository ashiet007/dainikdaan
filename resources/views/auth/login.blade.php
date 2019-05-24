@extends('layouts.app')
@section('styles')
    <style>
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
            <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item active">Login</li>
    </ol>
    <!-- //banner-text -->
    <section class="banner-bottom-w3ls py-lg-5 py-md-5 py-3">
        <div class="container">
            <div class="inner-sec-w3layouts py-lg-5 heading-padding py-3">
                <h3 class="tittle text-center mb-md-5 mb-4">Login</h3>
                    @if(Session::has('message'))
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                       <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                            <div class="input-group col-md-6 offset-md-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                                </div>
                                <input id="user_name" type="text" class="form-control" name="user_name" value="{{ old('email') }}" placeholder="Username" required autofocus>
                                @if ($errors->has('user_name'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="input-group col-md-6 offset-md-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 offset-md-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2 offset-md-3">
                                 <input class="form-control btn btn-success form-submit" type="submit" value="login">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
            
@endsection
