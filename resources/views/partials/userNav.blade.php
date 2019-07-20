<!-- ##### Header Area Start ##### -->
<header class="header-area">
    <!-- Navbar Area -->
    <div class="palatin-main-menu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container admin-navbar">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="palatinNav">

                    <!-- Nav brand -->
                    <a href="{{route('user.index')}}" class="nav-brand"><img src="{{asset('images/core-img/logo1.png')}}" alt=""></a>

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
                                <li class="active"><a href="{{route('user.index')}}">Dashboard</a></li>
                                <li><a href="#">My Profiles</a>
                                    <ul class="dropdown">
                                        <li><a href="{{route('profile.viewProfile')}}">View Profile</a></li>
                                        <li><a href="{{route('profile.viewSponsor')}}">Sponsor Details</a></li>
                                        <li><a href="{{route('profile.viewSecurity')}}">Security</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">My Teams</a>
                                    <ul class="dropdown">
                                        <li><a href="{{route('team.registeredList')}}">Inactive List</a></li>
                                        <li><a href="{{route('team.activeList')}}">Active List</a></li>
                                        <li><a href="{{route('team.directList')}}">Direct List</a></li>
                                        <li><a href="{{route('team.rejectedList')}}">Rejected List</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Helping Report</a>
                                    <ul class="dropdown">
                                        <li><a href="{{route('report.provideHelpReport')}}">Given Help</a></li>
                                        <li><a href="{{route('report.receiveHelpReport')}}">Taken Help</a></li>
                                        <li><a href="{{route('report.rejectedHelpReport')}}">Rejected Help</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{route('income.direct')}}">My Wallet</a></li>
                                <li><a href="{{url('user/messages')}}">My Messages</a></li>
                                @auth
                                    <li><a href="#">{{Auth::User()->name}}</a>
                                        <ul class="dropdown">
                                            @if(Auth::user()->hasRole('User'))
                                                <li><a href="{{ url('/user/dashboard') }}"><i class="fa fa-user" aria-hidden="true"></i> {{Auth::user()->user_name}}</a></li>
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