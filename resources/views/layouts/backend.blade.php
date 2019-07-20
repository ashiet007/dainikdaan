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
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
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
    @if(Auth::user()->hasRole('Admin'))
        @if(Request()->route()->getPrefix() == '/admin')
            @include('partials.adminNav')
        @elseif(Auth::user()->hasRole('User') && Request()->route()->getPrefix() == '/user')
            @include('partials.userNav')
        @endif
    @elseif(Auth::user()->hasRole('User'))
        @include('partials.userNav')
    @endif
<section class="breadcumb-area bg-img d-flex align-items-center justify-content-center backend-dashboard" style="background-image: url('/images/bg-img/bg-3.jpg');">
    <div class="bradcumbContent">
    </div>
</section>
<!-- ##### Breadcumb Area End ##### -->
@yield('content')
<!-- ##### Footer Area Start ##### -->
<footer class="footer-area">
    <div class="container">
        <div class="row">

            <!-- Footer Widget Area -->
            <div class="col-12 col-lg-5">
                <div class="footer-widget-area">
                    <a href="#" class="d-block"><img src="{{asset('images/core-img/logo1.png')}}" alt=""></a>
                </div>
            </div>
            <!-- Copywrite Text -->
            <div class="col-12">
                <div class="copywrite-text">
                    <p><a href="#"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Magic Bandhan</a></p>
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
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('.table').DataTable();
    } );
</script>
<script src="{{asset('js/active.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
<script>
    new ClipboardJS('.btn-clip');
</script>
@include('sweet::alert')
@yield('scripts')
<script src="{{asset('js/custom.js')}}"></script>
</body>

</html>