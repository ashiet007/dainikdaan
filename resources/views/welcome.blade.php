@extends('layouts.app')
@section('content')
    <!-- banner -->
    <div class="banner">
        @include('partials.homeNav')
        <div class="container">
            <!-- banner-text -->
            <div class="banner-text">
                <div class="slider-info">
                    <h3>Premium Worldwide Logistics Network</h3>
                    <a href="#" class="banner-button btn mt-md-5 mt-4">Know More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- //banner-text -->
    <!--banner form-->
    <section class="banner_form py-5">
        <div class="container py-lg-3">
            <div class="row ban_form">
                <div class="col-lg-7 fom-left">
                    <div class="categories_sub cats1">
                        <h2 class="heading-agileinfo">About Dainik Daan</h2>
                        <p class="vam">Vivamus sed porttitor felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.Sed lorem enim, Vivamus sed porttitor felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.Sed lorem enim, </p></div>
                </div>
                <div class="col-lg-5 reg-fom">
                    <img src="{{asset('images/news-image.jpg')}}" class="img-fluid" alt="">
                    <hr>
                    @php
                        $news = \App\News::where('type', 'vertical')->first();
                    @endphp
                    <marquee direction="up" onmouseover="this.stop()" onmouseout="this.start()">
                    <div class="text-white">
                        <h4 class="font-weight-bold">{{strtoupper($news->subject)}}</h4> <small>Posted at: {{$news->updated_at->format('d, M Y h:i:s A')}}</small>
                    </div>
                    <p class="news-content">{{$news->details}}</p>
                    </marquee>
                </div>
            </div>
        </div>
    </section>
    <!--//banner form-->
    <!-- /services -->
    <section class="banner-bottom-wthree py-lg-5 py-md-5 py-3">
        <div class="container">
            <div class="inner-sec-w3ls py-lg-5 py-3">
                <h3 class="heading-agileinfo text-center">Grow Your Impact Online </h3>
                <div class="row middle-grids mt-md-5 pt-4">
                    <div class="col-lg-4 about-in-w3ls middle-grid-info text-center">
                        <div class="card">
                            <div class="card-body">
                                <span class="fa fa-bar-chart mb-2"></span>
                                <h5 class="card-title text-uppercase my-3">
                                    Analytics.</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 about-in-w3ls middle-grid-info active text-center">
                        <div class="card">
                            <div class="card-body">
                                <span class="fa fa-paperclip mb-2"></span>
                                <h5 class="card-title text-uppercase my-3">Listening</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 about-in-w3ls middle-grid-info text-center">
                        <div class="card">
                            <div class="card-body">
                                <span class="fa fa-print mb-2"></span>
                                <h5 class="card-title text-uppercase my-3">Presentation</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //services -->

    <!-- feedback -->
    <section class="news py-5">
        <div class="container py-xl-5 py-lg-3">
            <h3 class="heading-agileinfo text-white text-center">Recent FeedBack</h3>
            <div class="row mt-md-5 pt-4">
                <div class="col-md-4 item">
                    <div class="feedback-info py-5 px-4">
                        <h4 class="mb-2">Tempor incididunt ut labore hytnm
                        </h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sedc dnmo.</p>
                        <div class="feedback-grids mt-4">
                            <div class="feedback-img">
                                <img src="images/te1.jpg" class="img-fluid rounded-circle" alt="" />
                            </div>
                            <div class="feedback-img-info">
                                <h5>Mary Jane</h5>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 item-2">
                    <div class="feedback-info py-5 px-4">
                        <h4 class="mb-2">Tempor incididunt ut labore hytnm
                        </h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sedc dnmo.</p>
                        <div class="feedback-grids mt-4">
                            <div class="feedback-img">
                                <img src="images/te3.jpg" class="img-fluid rounded-circle" alt="" />
                            </div>
                            <div class="feedback-img-info">
                                <h5>Olivia Ruth</h5>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="feedback-info py-5 px-4">
                        <h4 class="mb-2">Tempor incididunt ut labore hytnm
                        </h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sedc dnmo.</p>
                        <div class="feedback-grids mt-4">
                            <div class="feedback-img">
                                <img src="images/te2.jpg" class="img-fluid rounded-circle" alt="" />
                            </div>
                            <div class="feedback-img-info">
                                <h5>Blake Joe</h5>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //feedback -->

@endsection