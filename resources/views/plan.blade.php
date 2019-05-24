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
        <li class="breadcrumb-item active">Plan</li>
    </ol>
    <section class="banner_bottom1 py-md-5">
        <div class="container py-4 mt-2">
            <h3 class="heading-agileinfo text-center">Danink Daan  <span>Plan</span></h3>
            <div class="inner_sec_info_wthree_agile mt-md-5 pt-3">
                <div class="row help_full">
                    <div class="col-lg-6 banner_bottom_grid help">
                        <img src="{{asset('images/about.jpg')}}" alt=" " class="img-fluid">
                    </div>
                    <div class="col-lg-6 banner_bottom_left1">
                        <h4>Here is our Donation Plan</h4>
                        <p><strong>1:- Nonworking Growth 10% upto 15 days</strong></p>
                        <p><strong>2:-</strong> Unlimited registrations are allowed by same details.</p>
                        <p><strong>3:-</strong> After registration you will receive a provide help link of 500 only and after you help will be accepted you will enter in the company global pool for any transaction.</p>
                        <p><strong>4:-</strong> Now there must be required of 2 direct active id for first get help 1000 and next 2 direct after every 10 cycles for get help 1000 and give help 500 will continue. </p>
                        <p><strong>5:-</strong> Direct income 20% of first give help of every member and working withdrawal minimum 500 maximum 2000 per day. </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <h3 class="tittle text-center mb-md-5 mb-4">EVERY 2 DIRECT ID HELPING CHART</h3>
    <div class="table-responsive">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col" class="text-center">Sr. No.</th>
                    <th scope="col" class="text-center">Give Help Amount</th>
                    <th scope="col" class="text-center">Get Help Amount</th>
                    <th scope="col" class="text-center">Net Saving</th>
                </tr>
                </thead>
                <tbody>
                @for($i = 1; $i<=10;$i++)
                <tr>
                    <th scope="row" class="text-center">{{$i}}</th>
                    <td class="text-center">500</td>
                    <td class="text-center">1000</td>
                    <td class="text-center">500</td>
                </tr>
                </tbody>
                @endfor
                <tfoot>
                <tr>
                    <th scope="col" class="text-center">Total Sum</th>
                    <th scope="col" class="text-center">5000</th>
                    <th scope="col" class="text-center">10000</th>
                    <th scope="col" class="text-center">5000</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="container-fluid">
        <h3><p class="text-danger">Every 2 direct will be counted next 10 round only give and get also.Get help link after 6 hours any time and working link instantly.</p></h3>
    </div>

    <div class="container-fluid">
        <p class="heading-donation" ><span class="heading-donation1"><strong>6:-</strong> </span> Link timing  24 X 7 daily  and rejection timing 18 hours only and extention 12 hours once.</p>

        <br/>
    </div>
    <p class="heading-donation text-center" ><span class="heading-donation1"><strong>THANK YOU</strong> </span></p>
    <br/>
    </div>
@endsection