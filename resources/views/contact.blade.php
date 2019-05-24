@extends('layouts.app')
@section('content')
    <!-- banner -->
    <div class="inner-banner">
    @include('partials.homeNav')
    <!-- //header -->

    </div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item active">Contact</li>
    </ol>
    <!-- //banner-text -->
    <!-- contact -->
    <section class="banner-bottom-w3ls pt-lg-5 pt-md-3 pt-3">
        <div class="inner-sec-wthreelayouts pt-md-5 pt-md-3 pt-3">
            <h2 class="heading-agileinfo text-center  mb-4">Get In Touch</h2>
            @if(Session::has('flash_message'))
                <div class="alert alert-success">{{Session::get('flash_message')}}
                </div>
            @endif
            <div class="container pt-sm-5">
                <div class="address row mb-5">
                    <div class="col-lg-6 address-grid-w3l">
                        <div class="row address-info">
                            <div class="col-3 address-left text-center">
                                <span class="fa fa-map"></span>
                            </div>
                            <div class="col-9 address-right text-left">
                                <h6 class="ad-info text-uppercase mb-2">Address</h6>
                                <p> California, USA

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 address-grid-w3l">
                        <div class="row address-info">
                            <div class="col-3 address-left text-center">
                                <span class="fa fa-envelope"></span>
                            </div>
                            <div class="col-9 address-right text-left">
                                <h6 class="ad-info text-uppercase mb-2">Email</h6>
                                <p>Email :
                                    <a href="mailto:dainikdaan@gmail.com"> dainikdaan@gmail.com</a>
                                </p>
                            </div>

                        </div>
                    </div>
{{--                    <div class="col-lg-4 address-grid-w3l">--}}
{{--                        <div class="row address-info">--}}
{{--                            <div class="col-3 address-left text-center">--}}
{{--                                <span class="fa fa-mobile"></span>--}}
{{--                            </div>--}}
{{--                            <div class="col-9 address-right text-left">--}}
{{--                                <h6 class="ad-info text-uppercase mb-2">Phone</h6>--}}
{{--                                <p>+1 234 567 8901</p>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d423286.27404345275!2d-118.69191921441556!3d34.02016130939095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c75ddc27da13%3A0xe22fdf6f254608f4!2sLos+Angeles%2C+CA%2C+USA!5e0!3m2!1sen!2sin!4v1522474296007" allowfullscreen></iframe>

                    </div>
                    <div class="col-md-6 main_grid_contact">
                        <div class="form">
                            <h4 class="mb-4 text-left">Send us a message</h4>
                            <form action="{{route('contact.storeQuery')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label class="my-2">Name</label>
                                    <input class="form-control" type="text" name="name" placeholder="" required="">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" name="email" placeholder="" required="">
                                </div>
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea id="textarea" placeholder="" name="message"></textarea>
                                </div>
                                <div class="input-group1">
                                    <button class="form-control" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //contact -->
@endsection