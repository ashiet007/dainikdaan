<!-- header -->
<header>
    <nav class="mnu navbar-light">
        <div class="logo" id="logo">
            <h1><a href="index.html">Dainik Daan</a></h1>
        </div>
        <label for="drop" class="toggle"><span class="fa fa-bars"></span></label>
        <input type="checkbox" id="drop">
        <ul class="menu">
            <li class="active"><a href="{{url('/')}}">Home</a></li>
            <li><a href="{{route('home.about')}}">About</a></li>
            <li><a href="{{route('home.plan')}}">Plan</a></li>
            <li><a href="{{route('home.contact')}}">Contact Us</a></li>
            <li style="padding: 5px;"><button class="btn btn-danger"><a href="{{url('/help-matching')}}">Match</a></button></li>
            @guest
            <li style="padding: 5px;"><button class="btn btn-danger"><a href="{{url('/login')}}">Login</a></button></li>
            <li style="padding: 5px;"><button class="btn btn-danger"><a href="{{route('register.showRegistrationForm')}}">Register</a></button></li>
            @else
            <li>
                <!-- First Tier Drop Down -->
                <label for="drop-3" class="toggle">{{ Auth::user()->name }} <span class="fa fa-angle-down" aria-hidden="true"></span> </label>
                <a href="#">{{ Auth::user()->name }}  <span class="fa fa-angle-down" aria-hidden="true"></span></a>
                <input type="checkbox" id="drop-3" />
                <ul>
                    <li>
                        @if(Auth::user()->hasRole('User'))
                            <a href="{{ url('/user/dashboard') }}"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
                            @endif
                    </li>

                    <li>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{csrf_field()}}
                        </form>
                        <button type="submit" class="btn btn-link dropdown-item"><a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i> Logout</a></button>
                    </li>
                </ul>
        @endguest
        </ul>
    </nav>
</header>
<!-- //header -->