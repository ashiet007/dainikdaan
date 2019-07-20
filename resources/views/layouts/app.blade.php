<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="_token" content="{{csrf_token()}}">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Magic Bandhan</title>

    <!-- Favicon -->
    <link rel="icon" href="{{asset('images/core-img/favicon.ico')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.css">
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @yield('styles')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">

</head>

<body>
<!-- Preloader -->
<div class="preloader d-flex align-items-center justify-content-center">
    <div class="cssload-container">
        <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
    </div>
</div>
@include('partials.homeNav')

@yield('content')
<!-- ##### Footer Area Start ##### -->
<footer class="footer-area">
    <div class="container">
        <div class="row">

            <!-- Footer Widget Area -->
            <div class="col-12 col-lg-5">
                <div class="footer-widget-area mt-50">
                    <a href="#" class="d-block mb-5"><img src="{{asset('images/core-img/logo1.png')}}" alt=""></a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris sceleri sque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus. </p>
                </div>
            </div>

            <!-- Footer Widget Area -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="footer-widget-area mt-50">
                    <h6 class="widget-title mb-5">Find us on the map</h6>
                    <img src="{{asset('images/bg-img/footer-map.png')}}" alt="">
                </div>
            </div>

            <!-- Footer Widget Area -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="footer-widget-area mt-50">
                    <h6 class="widget-title mb-5">Subscribe to our newsletter</h6>
                    <form action="#" method="post" class="subscribe-form">
                        <input type="email" name="subscribe-email" id="subscribeemail" placeholder="Your E-mail" required>
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>

            <!-- Copywrite Text -->
            <div class="col-12">
                <div class="copywrite-text mt-30">
                    <p><a href="#"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <a href="{{url('/')}}" target="_blank">Magic Bandhan</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ##### Footer Area End ##### -->

<!-- ##### All Javascript Script ##### -->
<!-- jQuery-2.2.4 js -->
<script src="{{asset('js/jquery/jquery-2.2.4.min.js')}}"></script>
<!-- Popper js -->
<script src="{{asset('js/bootstrap/popper.min.js')}}"></script>
<!-- Bootstrap js -->
<script src="{{asset('js/bootstrap/bootstrap.min.js')}}"></script>
<!-- All Plugins js -->
<script src="{{asset('js/plugins/plugins.js')}}"></script>
<!-- Active js -->
<script src="{{asset('js/active.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@include('sweet::alert')
@yield('scripts')
<script src="{{asset('js/custom.js')}}"></script>
</body>

</html>