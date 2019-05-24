<div id="sidebar" class="sidebar py-3">
    <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">PANEL</div>
    <ul class="sidebar-menu list-unstyled">
        <li class="sidebar-list-item"><a href="{{route('user.index')}}" class="sidebar-link text-muted active"><i class="o-home-1 mr-3 text-gray"></i><span>Dashboard</span></a></li>
        <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#pages" aria-expanded="false" aria-controls="pages" class="sidebar-link text-muted"><i class="o-id-card-1 mr-3 text-gray"></i><span>Profile</span></a>
            <div id="pages" class="collapse">
                <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                    <li class="sidebar-list-item"><a href="{{route('profile.viewProfile')}}" class="sidebar-link text-muted pl-lg-5">View Profile</a></li>
                    <li class="sidebar-list-item"><a href="{{route('profile.viewSponsor')}}" class="sidebar-link text-muted pl-lg-5">Sponsor Details</a></li>
                    <li class="sidebar-list-item"><a href="{{route('profile.viewSecurity')}}" class="sidebar-link text-muted pl-lg-5">Security</a></li>
                </ul>
            </div>
        </li>
        <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#team" aria-expanded="false" aria-controls="team" class="sidebar-link text-muted"><i class="o-network-1 mr-3 text-gray"></i><span>My Team</span></a>
            <div id="team" class="collapse">
                <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                    <li class="sidebar-list-item"><a href="{{route('team.registeredList')}}" class="sidebar-link text-muted pl-lg-5">Registered List</a></li>
                    <li class="sidebar-list-item"><a href="{{route('team.activeList')}}" class="sidebar-link text-muted pl-lg-5">Active List</a></li>
                    <li class="sidebar-list-item"><a href="{{route('team.directList')}}" class="sidebar-link text-muted pl-lg-5">Direct List</a></li>
                    <li class="sidebar-list-item"><a href="{{route('team.rejectedList')}}" class="sidebar-link text-muted pl-lg-5">Rejected List</a></li>
                </ul>
            </div>
        </li>
        <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#report" aria-expanded="false" aria-controls="report" class="sidebar-link text-muted"><i class="o-statistic-1 mr-3 text-gray"></i><span>My Help Report</span></a>
            <div id="report" class="collapse">
                <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                    <li class="sidebar-list-item"><a href="{{route('report.provideHelpReport')}}" class="sidebar-link text-muted pl-lg-5">Given Help</a></li>
                    <li class="sidebar-list-item"><a href="{{route('report.receiveHelpReport')}}" class="sidebar-link text-muted pl-lg-5">Taken Help</a></li>
                    <li class="sidebar-list-item"><a href="{{route('report.rejectedHelpReport')}}" class="sidebar-link text-muted pl-lg-5">Rejected Help</a></li>
                </ul>
            </div>
        </li>
        <li class="sidebar-list-item"><a href="{{route('income.direct')}}" class="sidebar-link text-muted"><i class="o-repository-1 mr-3 text-gray"></i><span>My Wallet</span></a></li>
        <li class="sidebar-list-item"><a href="{{url('user/messages')}}" class="sidebar-link text-muted"><i class="o-letter-1 mr-3 text-gray"></i><span>My Messages</span></a></li>
    </ul>
</div>