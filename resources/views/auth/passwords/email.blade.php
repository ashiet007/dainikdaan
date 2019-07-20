@extends('layouts.app')

@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <section class="breadcumb-area bg-img d-flex align-items-center justify-content-center mb-5" style="background-image: url('/images/bg-img/bg-3.jpg');">
        <div class="bradcumbContent">
            <h2>Forget Password</h2>
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
                                <a href="#" class="post-date btn palatin-btn">Enter Your Username</a>
                                <!-- Post Title -->
                                <div class="card" style="border-color: #cb8670;">
                                    <div class="card-header" style="background-color: #cb8670;">
                                        <h3 class="text-capitalize font-weight-bold text-white">{{ __('Forget Password') }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form">
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
                                                <div class="alert alert-warning">
                                                    Enter Your Username to get password on your registered mobile number.
                                                </div>
                                                <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                                                    <label for="user_name" class="col-md-4 control-label font-weight-bold">Username</label>
                                                    <div class="col-md-12">
                                                        <input id="user_name" type="text" class="form-control" name="user_name" value="{{ old('user_name') }}" placeholder="Enter your username" required>
                                                        @if ($errors->has('user_name'))
                                                            <span class="help-block">
                                                                <strong class="text-danger">{{ $errors->first('user_name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <input type="submit" value="Send Password" class="btn palatin-btn m-2 float-right">
                                                    </div>
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
        </div>
    </div>
@endsection
