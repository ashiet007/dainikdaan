<!-- ##### Header Area Start ##### -->
<header class="header-area">
    <!-- Navbar Area -->
    <div class="palatin-main-menu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container admin-navbar">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="palatinNav">

                    <!-- Nav brand -->
                    <a href="{{route('admin.dashboard')}}" class="nav-brand"><img src="{{asset('images/core-img/logo1.png')}}" alt=""></a>

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
                                <li><a href="{{ url('/admin/users') }}">Users</a></li>
                                <li><a href="#">Admin Action</a>
                                    <ul class="dropdown">
                                        <li><a href="{{ url('/admin/news') }}">Publish News</a></li>
                                        <li><a href="{{ route('user.createUserForm') }}">Create Fake User</a></li>
                                        <li><a href="{{ route('action.index') }}">Block/Unblock User</a></li>
                                        <li><a href="{{ route('action.linkAction') }}">Total Link ON/OFF</a></li>
                                        <li><a href="{{ route('user.viewSecurity') }}">Change Password</a></li>
                                        <li><a href="{{ url('admin/contact') }}">Contact</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Downline</a>
                                    <ul class="dropdown">
                                        <li><a href="{{ route('downline.directTeam') }}">Total Direct Team</a></li>
                                        <li><a href="{{ route('downline.totalDownline') }}">Total Downline</a></li>
                                        <li><a href="{{ route('downline.rejectedMembers') }}">Total Rejected </a></li>
                                        <li><a href="{{ route('downline.blockedMembers') }}">Total Blocked</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Joining Report</a>
                                    <ul class="dropdown">
                                        <li><a href="{{ route('joining.index')}}">Date-wise joining</a></li>
                                        <li><a href="{{ route('joining.newJoining') }}">Total New Joining</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Link Report</a>
                                    <ul class="dropdown">
                                        <li><a href="{{ route('linkReport.accptedLink') }}">Accepted Link</a></li>
                                        <li><a href="{{ route('linkReport.rejectedLink') }}">Rejected Link</a></li>
                                        <li><a href="{{ route('linkReport.pendingLink') }}">Pending Link</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Stored Link</a>
                                    <ul class="dropdown">
                                        <li><a href="{{ route('linkReport.sendersList') }}">Senders List</a></li>
                                        <li><a href="{{ route('linkReport.receiverList') }}">Receivers List</a></li>
                                        <li><a href="{{ url('/admin/give-helps') }}">Give Helps</a></li>
                                        <li><a href="{{ url('/admin/get-helps') }}">Get Help helping</a></li>
                                        <li><a href="{{ url('/admin/get-helps-working') }}">Get Help Working</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Fund Management</a>
                                    <ul class="dropdown">
                                        <li><a href="{{ route('fund.addFundForm') }}">Add Fund</a></li>
                                        <li><a href="{{ route('fund.fundList') }}">Added Fund History</a></li>
                                    </ul>
                                </li>
                                @auth
                                    <li><a href="#">{{Auth::User()->name}}</a>
                                        <ul class="dropdown">
                                            @if(Auth::user()->hasRole('User'))
                                                <li><a href="{{ url('/user/dashboard') }}"><i class="fa fa-user" aria-hidden="true"></i> {{Auth::User()->user_name}}</a></li>
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
