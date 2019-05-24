<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Dainik Daan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    <meta name="keywords" content="Wedding Planner Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
	SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
    <meta name="_token" content="{{csrf_token()}}">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Custom Theme files -->
    <link href="{{asset('css/bootstrap.css')}}" type="text/css" rel="stylesheet" media="all">
    <link href="{{asset('css/style.css')}}" type="text/css" rel="stylesheet" media="all">
    <!-- font-awesome icons -->
    <link href="{{asset('css/fontawesome-all.min.css')}}" rel="stylesheet">
    <!-- //Custom Theme files -->
    <!-- online-fonts -->
    <link href="//fonts.googleapis.com/css?family=Roboto:100i,400,500,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Josefin+Sans:300,400,600,700" rel="stylesheet">
    <!-- //online-fonts -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    @yield('styles')

</head>

<body>


@yield('content')
<!--/newsletter-->
<footer class="newsletter_right pymd-5 py-4" id="footer">
    <div class="container">
        <div class="inner-sec py-md-5 py-3">
            <div class="row mb-md-4 mb-md-3">
                <div class="col-lg-3 col-md-6 social-info text-left">
                    <h3 class="tittle1 foot mb-md-5 mb-4 text-white">Get in touch</h3>
                    <p>0926k 4th block building,king Avenue, </p>
                    <p class="my-2"> New York City,USA</p>
                    <p class="phone">phone: +0444 555 6789</p>
                    <p class="phone my-2">Fax: +0444 555 6789</p>
                    <p class="phone">Mail:
                        <a href="mailto:info@example.com">info@example.com</a>
                    </p>

                </div>
                <div class="col-lg-3 col-md-6 social-info text-left">
                    <h3 class="tittle1 foot mb-md-5 mb-4 text-white">About Us</h3>
                    <p>Curabitur non nulla sit amet nislinit tempus convallis quis ac lectus. lac inia eget consectetur sed, convallis at tellus.
                        Nulla porttitor accumsana tincidunt. Vestibulum ante ipsum primis tempus convallis.</p>

                </div>
                <div class="col-lg-6 col-md-12 n-right tex-left">
                    <h3 class="tittle1 foot mb-md-5 mb-4 text-white">Subscribe our Newsletter</h3>
                    <form action="#" method="post">
                        <div class="form-group d-flex">
                            <input class="form-control" type="email" name="Email" placeholder=" Email Address" required="">
                            <button class="form-control submit text-uppercase" type="submit ">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copyright py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <p class="copy-right mt-2">© 2019 Dainik Daan. All Rights Reserved
                </p>
            </div>
            <div class="col-md-4">
                <ul class="social-icons scial justify-content-end">
                    <li class="mr-1"><a href="#"><span class="fa fa-facebook"></span></a></li>
                    <li class="mx-1"><a href="#"><span class="fa fa-twitter"></span></a></li>
                    <li class="mx-1"><a href="#"><span class="fa fa-google-plus"></span></a></li>
                    <li class="mx-1"><a href="#"><span class="fa fa-linkedin"></span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--//newsletter-->
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@yield('scripts')
</body>
</html>