@extends('layouts.app')
@section('styles')
    <style>
        .custom-para{
            transition-duration: 500ms;
            background-color: #ffffff;
            color: #7d7d7d;
            border: 2px solid #cb8670;
            padding: 15px;
        }
        .table thead th {
            border-bottom: 2px solid #cb8670;
        }
        .table-bordered td, .table-bordered th {
            border: 2px solid #cb8670;
        }
    </style>
@endsection
@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <section class="breadcumb-area bg-img d-flex align-items-center justify-content-center mb-5" style="background-image: url('images/bg-img/bg-3.jpg');">
        <div class="bradcumbContent">
            <h2>Helping Plan</h2>
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
                            <!-- Post Thumb -->
{{--                            <div class="blog-post-thumb">--}}
{{--                                <img src="{{asset('images/blog-img/1.jpg')}}" alt="">--}}
{{--                            </div>--}}
                            <!-- Post Content -->
                            <div class="post-content">
                                <!-- Post Date-->
                                <a href="#" class="post-date btn palatin-btn">Helping Plan</a>
                                <!-- Post Title -->
                                <a href="#" class="post-title">PLEASE READ PLAN CAREFULLY BEFORE SIGNUP.</a>
                                <h6>
                                    <p role="button" class="custom-para">THIS SYSTEM ALLOWED YOU UNLIMITED ID BY SAME DETAILS BUT ANY REJECTED ID WILL EFFECT ON EVERY ID BY SAME DETAILS.
                                    </p>
                                </h6>
                                <h6>
                                    <p role="button" class="custom-para">AFTER SIGNUP YOU WILL RECEIVE A LINK AMOUNT OF 500 FOR PROVIDE HELP.
                                    </p>
                                </h6>
                                <h6>
                                    <p role="button" class="custom-para">AFTER CONFIRMED 500 LINK YOUR ID WILL BE ACTIVATED AND YOU WILL ENTER IN COMPANY AUTO SINGLE LINE POOL.
                                    </p>
                                </h6>
                                <h6>
                                    <p role="button" class="custom-para">NOW YOU WILL EARN NONWORKING INCOME BY EVERY ID HELPING INCOME RUPEES 20 AND AUTO GET HELP LINK RUPEES 1000 AND 500 AUTO GIVE HELP LINK ALWAYS WILL CONTINUE.
                                    </p>
                                </h6>
                                <h6>
                                    <p role="button" class="custom-para">DIRECT INCOME RUPEES 100 PER ID UNLIMITED REFERRALS IN WORKING WALLET.
                                    </p>
                                </h6>
                                <h6>
                                    <p role="button" class="custom-para">WORKING INCOME WITHDRAWAL MINIMUM 500 AND MAXIMUM 5000 PER DAY.
                                    </p>
                                </h6>
                                <h6>
                                    <p role="button" class="custom-para">LINK TIME 10 AM TO 5 PM MONDAY TO SATURDAY FULLY AUTO AND LINK REJECTION TIME 6 HOURS ONLY EXTENTION 12 HOURS.
                                    </p>
                                </h6>
                                <h6>
                                    <p role="button" class="custom-para">ANY REJECTED OR BLOCKED ID WILL NOT BE OPENED ANY CONDITIONS.
                                    </p>
                                </h6>
                                <h6>
                                    <p role="button" class="custom-para">SINGLE LINE INCOME WILL BE CALCULATED AFTER EVERY GIVE HELP ACCEPTED AND IT WILL RESUME BETWEEN GET HELP AND GIVE HELP LINK ON DASHBOARD.
                                    </p>
                                </h6>
                                <h6>
                                    <p role="button" class="custom-para">SINGLE LINE INCOME 20 RUPEES PER ID NO DIRECT REQUIRED,25 RUPEES PER ID AFTER 2 DIRECT ID,40 RUPEES PER ID AFTER 5 DIRECT ID AND 50 RUPEES PER ID AFTER 10 DIRECT IDS OR MORE.
                                    </p>
                                </h6>
                                <h3 class="tittle text-center mb-md-5 mb-4">SINGLE LINE INCOME CHART</h3>
                                <div class="table-responsive">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" style="border-color: #cb8670">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="text-center">Sr. No.</th>
                                                <th scope="col" class="text-center">Provide Help</th>
                                                <th scope="col" class="text-center">Receive Help</th>
                                                <th scope="col" class="text-center">Direct ID Required</th>
                                                <th scope="col" class="text-center">Income per ID</th>
                                                <th scope="col" class="text-center">Limitation</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row" class="text-center">1</th>
                                                <td class="text-center">500</td>
                                                <td class="text-center">1000</td>
                                                <td class="text-center">None</td>
                                                <td class="text-center">20</td>
                                                <td class="text-center">Unlimited</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-center">2</th>
                                                <td class="text-center">500</td>
                                                <td class="text-center">1000</td>
                                                <td class="text-center">2</td>
                                                <td class="text-center">25</td>
                                                <td class="text-center">Unlimited</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-center">3</th>
                                                <td class="text-center">500</td>
                                                <td class="text-center">1000</td>
                                                <td class="text-center">5</td>
                                                <td class="text-center">40</td>
                                                <td class="text-center">Unlimited</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-center">4</th>
                                                <td class="text-center">500</td>
                                                <td class="text-center">1000</td>
                                                <td class="text-center">10 or More</td>
                                                <td class="text-center">50</td>
                                                <td class="text-center">Unlimited</td>
                                            </tr>
                                            </tbody>
                                        </table>
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