<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{Auth::User()->name}} - Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="_token" content="{{csrf_token()}}">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Google fonts - Popppins for copy-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
    <!-- orion icons-->
    <link rel="stylesheet" href="{{asset('css/orionicons.css')}}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('css/style.default.css')}}" id="theme-stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    @yield('styles')
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body>
<!-- navbar-->
<header class="header">
    <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a href="#" class="navbar-brand font-weight-bold text-uppercase text-base"><span>Name: </span><span class="text-black-50">{{Auth::User()->name}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Username: </span> <span class="text-lowercase text-black-50">{{Auth::User()->user_name}}</span> </a>
        <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
            @php
                $id = Auth::User()->id;
            $messages = \App\Message::where('receiver_id','unread')->get();
            @endphp
            <li class="nav-item dropdown mr-3"><a id="notifications" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-gray-400 px-1"><i class="fa fa-bell"></i>@if(count($messages))<span class="notification-icon"></span>@endif</a>
                <div aria-labelledby="notifications" class="dropdown-menu">
                    @if(count($messages))
                    @foreach($messages as $message)
                    <a href="{{ url('/user/messages', $message->id) }}" class="dropdown-item">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-sm bg-green text-white"><i class="fas fa-envelope"></i></div>
                            <div class="text ml-2">
                                <p class="mb-0">{{$message->message}}</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    @else
                        <a href="#" class="dropdown-item">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-sm bg-green text-white"><i class="fas fa-envelope"></i></div>
                            <div class="text ml-2">
                                <p class="mb-0">No Messages Available</p>
                            </div>
                        </div>
                        </a>
                    @endif
                    <div class="dropdown-divider"></div><a href="{{ url('user/messages') }}" class="dropdown-item text-center"><small class="font-weight-bold headings-font-family text-uppercase">View all notifications</small></a>
                </div>
            </li>
            <li class="nav-item"><button class="btn btn-danger"><a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="text-white" style="text-decoration: none;">Logout</a></button></li>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{csrf_field()}}
            </form>
        </ul>
    </nav>
</header>
<div class="d-flex align-items-stretch">
    @if(Auth::user()->hasRole('Admin'))
        @if(Request()->route()->getPrefix() == '/admin')
            @include('partials.adminNav')
        @elseif(Auth::user()->hasRole('User') && Request()->route()->getPrefix() == '/user')
            @include('partials.userNav')
        @endif
    @elseif(Auth::user()->hasRole('User'))
        @include('partials.userNav')
    @endif
    <div class="page-holder w-100 d-flex flex-wrap">
        @if (Session::has('flash_message'))
            <div class="container">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('flash_message') }}
                </div>
            </div>
        @endif
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="container alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>{{ $error }}</div>
                @endforeach
            @endif
        @yield('content')
        <footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 text-center text-md-left text-primary">
                        <p class="mb-2 mb-md-0">Dainik Daan &copy; 2019-2020</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<!-- JavaScript files-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/popper.js/umd/popper.min.js')}}"> </script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
<script>
    new ClipboardJS('.btn-clip');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
{{--<script src="{{asset('js/charts-home.js')}}"></script>--}}
<script src="{{asset('js/front.js')}}"></script>
@yield('scripts')
</body>
</html>