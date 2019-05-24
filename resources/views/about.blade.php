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
        <li class="breadcrumb-item active">About</li>
    </ol>
    <!-- //banner-text -->
    <section class="banner_bottom1 py-md-5">
        <div class="container py-4 mt-2">
            <h3 class="heading-agileinfo text-center">About  <span>Us</span></h3>
            <div class="inner_sec_info_wthree_agile mt-md-5 pt-3">
                <div class="row help_full">
                    <div class="col-lg-6 banner_bottom_grid help">
                        <img src="{{asset('images/about.jpg')}}" alt=" " class="img-fluid">
                    </div>
                    <div class="col-lg-6 banner_bottom_left1">
                        <h4>Lorem Ipsum convallis diam</h4>
                        <p>Pellentesque convallis diam consequat magna vulputate malesuada. Cras a ornare elit. Nulla viverra pharetra sem, eget
                            pulvinar neque pharetra ac.</p>
                        <p>Lorem Ipsum convallis diam consequat magna vulputate malesuada. Cras a ornare elit. Nulla viverra pharetra sem, eget
                            pulvinar neque pharetra ac.Nullal condimentum interdum vel eget enim. Curabitur mattis orci sed le. Nullal condimentum interdum vel eget enim. Curabitur mattis orci sed le.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- choose -->
    <section class="choose py-5">
        <div class="container py-md-4 mt-md-3">
            <div class="row inner_w3l_agile_grids-1 ">
                <div class="col-lg-6 w3layouts_choose_left_grid1">
                    <div class="choose_top">
                        <h4 class="mb-3 mt-3 text-white">Feel Free to Contact Our Agents Directly</h4>
                        <p class="text-white">Nulla pellentesque mi non laoreet eleifend. Integer porttitor mollisar lorem, at molestie arcu pulvinar ut. Proin ac fermentum est. Cras mi ipsum, consectetur ac ipsum in, egestas vestibulum tellus.Proin ac fermentum est. Cras mi ipsum, consectetur ac ipsum in, egestas vestibulum tellus.</p>
                        <a href="services.html" class="btn btn-primary mt-3">Read More</a>
                    </div>
                </div>
                <div class="col-lg-6 w3layouts_choose_left_grid2">
                    <div class="row">
                        <div class="col-md-6 w3l_choose_bottom1 mt-3 pt-md-4">
                            <div class="choose_bottom_top">
                                <span class="fa fa-gift mb-2"></span>
                                <h5 class="card-title text-uppercase my-3">Weddings</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 w3l_choose_bottom2">
                            <div class="choose_bottom_top">
                                <span class="fa fa-cutlery mb-2"></span>
                                <h5 class="card-title text-uppercase my-3">Parties</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 w3l_choose_bottom3 mt-3 pt-md-4">
                            <div class="choose_bottom_top">
                                <span class="fa fa-music mb-2"></span>
                                <h5 class="card-title text-uppercase my-3">Entertainment</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 w3l_choose_bottom4">
                            <div class="choose_bottom_top">
                                <span class="fa fa-glass mb-2"></span>
                                <h5 class="card-title text-uppercase my-3">Celebrations</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //choose -->
@endsection