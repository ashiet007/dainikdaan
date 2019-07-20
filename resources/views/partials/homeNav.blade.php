
<!-- ##### Header Area Start ##### -->
<header class="header-area">
    <!-- Navbar Area -->
    <div class="palatin-main-menu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="palatinNav">

                    <!-- Nav brand -->
                    <a href="{{url('/')}}" class="nav-brand"><img src="{{asset('images/core-img/logo1.png')}}" alt=""></a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- close btn -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                <li class="{{ Route::currentRouteNamed('home.index') ? 'active' : '' }}"><a href="{{url('/')}}">Home</a></li>
                                <li class="{{ Route::currentRouteNamed('home.about') ? 'active' : '' }}"><a href="{{route('home.about')}}">About Us</a></li>
                                <li class="{{ Route::currentRouteNamed('home.plan') ? 'active' : '' }}"><a href="{{route('home.plan')}}">Helping Plan</a></li>
                                <li class="{{ Route::currentRouteNamed('home.contact') ? 'active' : '' }}"><a href="{{route('home.contact')}}">Contact</a></li>
                                @auth
                                <li><a href="#">{{Auth::User()->name}}</a>
                                    <ul class="dropdown">
                                        @if(Auth::user()->hasRole('User'))
                                           <li><a href="{{ url('/user/dashboard') }}"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
                                        @endif
                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                {{csrf_field()}}
                                            </form>
                                            <li><a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i> Logout</a></li>
                                    </ul>
                                </li>
                                @endauth
                            </ul>
                            @guest
                            <!-- Button -->
                            <div class="menu-btn">
                                <a href="{{url('/login')}}" class="btn palatin-btn">Login</a>
                            </div>
                            <div class="menu-btn">
                                <a href="{{route('register')}}" class="btn palatin-btn">Register</a>
                            </div>
                            @endguest
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ##### Header Area End ##### -->