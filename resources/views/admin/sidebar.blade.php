<nav class="sidebar-nav">
    <ul class="nav">
        @if(Auth::user()->hasRole('Admin'))
	        @if(Request()->route()->getPrefix() == '/admin')
			    @include('partials.adminSidebar')
			@elseif(Auth::user()->hasRole('User') && Request()->route()->getPrefix() == '/user')
			    @include('partials.userSidebar')
			@endif              
        @elseif(Auth::user()->hasRole('User'))
           @include('partials.userSidebar')
        @endif 
    </ul>
</nav>