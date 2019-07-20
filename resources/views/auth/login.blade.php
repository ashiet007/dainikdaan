@extends('layouts.app')
@section('styles')
    <style>
        .py-3 {
            padding-top: 1rem !important;
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
            <h2>Sign-In</h2>
        </div>
    </section>
    <!-- ##### Blog Area Start ##### -->
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
                                <a href="#" class="post-date btn palatin-btn">Enter Your credentials to sign in</a>
                                <!-- Post Title -->
                                <div class="card" style="border-color: #cb8670;">
                                    <div class="card-header" style="background-color: #cb8670;">
                                        <h3 class="text-capitalize font-weight-bold text-white">{{ __('Login') }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form">
                                            <form action="{{route('login.authenticate')}}" method="post" id="loginform">
                                                {{csrf_field()}}
                                                <input type="hidden" name="role" value="User">
                                                <div class="input-group form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" style="background-color: #cb8670;"><i class="fa fa-user text-white"></i></span>
                                                    </div>
                                                    <input type="text" class="margin2 form-control" name="user_name" value="{{ old('email') }}" placeholder="Username" required="">
                                                    @if ($errors->has('user_name'))
                                                        <span class="help-block">
                                                    <strong class="text-danger">{{ $errors->first('user_name') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                                <div class="input-group form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" style="background-color: #cb8670;"><i class="fa fa-key text-white"></i></span>
                                                    </div>
                                                    <input type="password" class="margin2 form-control" name="password" placeholder="Password" required="">
                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                    <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                                <div class="row align-items-center remember">
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>Remember Me
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" value="Login" class="btn palatin-btn m-2 float-right">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-footer" style="background-color: #cb8670;">
                                        <div class="d-flex justify-content-center links text-white">
                                            Don't have an account? <a href="{{route('register')}}" class="font-weight-bold text-white">&nbsp;Register Here</a>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('password.request') }}" class="text-white">Forgot your password?</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! $validator->selector('#loginform') !!}
@endsection
