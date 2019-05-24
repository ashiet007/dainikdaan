
<div id="sidebar" class="sidebar py-3">
    <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MAIN</div>
    <ul class="sidebar-menu list-unstyled">
        <li class="sidebar-list-item"><a href="{{route('admin.dashboard')}}" class="sidebar-link text-muted active"><i class="o-home-1 mr-3 text-gray"></i><span>Dashboard</span></a></li>
        <li class="sidebar-list-item"><a href="{{ url('/admin/users') }}" class="sidebar-link text-muted"><i class="o-user-1 mr-3 text-gray"></i><span>Users</span></a></li>
        <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#report" aria-expanded="false" aria-controls="report" class="sidebar-link text-muted"><i class="o-settings-window-1 mr-3 text-gray"></i><span>Admin Actions</span></a>
            <div id="report" class="collapse">
                <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                    <li class="sidebar-list-item"><a href="{{ url('/admin/news') }}" class="sidebar-link text-muted pl-lg-5">Publish News</a></li>
                    <li class="sidebar-list-item"><a href="{{ route('user.createUserForm') }}" class="sidebar-link text-muted pl-lg-5">Create Fake User</a></li>
                    <li class="sidebar-list-item"><a href="{{ route('action.index') }}" class="sidebar-link text-muted pl-lg-5">Block/Unblock User</a></li>
                    <li class="sidebar-list-item"><a href="{{ route('action.linkAction') }}" class="sidebar-link text-muted pl-lg-5">Total Link ON/OFF</a></li>
                </ul>
            </div>
        </li>
        <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#pages" aria-expanded="false" aria-controls="pages" class="sidebar-link text-muted"><i class="o-network-1 mr-3 text-gray"></i><span>Downline</span></a>
            <div id="pages" class="collapse">
                <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                    <li class="sidebar-list-item"><a href="{{ route('downline.directTeam') }}" class="sidebar-link text-muted pl-lg-5">Total Direct Team</a></li>
                    <li class="sidebar-list-item"><a href="{{ route('downline.totalDownline') }}" class="sidebar-link text-muted pl-lg-5">Total Downline</a></li>
                    <li class="sidebar-list-item"><a href="{{ route('downline.rejectedMembers') }}" class="sidebar-link text-muted pl-lg-5">Total Rejected </a></li>
                    <li class="sidebar-list-item"><a href="{{ route('downline.blockedMembers') }}" class="sidebar-link text-muted pl-lg-5">Total Blocked</a></li>
                </ul>
            </div>
        </li>
        <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#joining" aria-expanded="false" aria-controls="joining" class="sidebar-link text-muted"><i class="o-id-card-1 mr-3 text-gray"></i><span>Joining Report</span></a>
            <div id="joining" class="collapse">
                <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                    <li class="sidebar-list-item"><a href="{{ route('joining.index')}}" class="sidebar-link text-muted pl-lg-5">Date-wise joining</a></li>
                    <li class="sidebar-list-item"><a href="{{ route('joining.newJoining') }}" class="sidebar-link text-muted pl-lg-5">Total New Joining</a></li>
                </ul>
            </div>
        </li>
        <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#team" aria-expanded="false" aria-controls="team" class="sidebar-link text-muted"><i class="o-like-hand-1 mr-3 text-gray"></i><span>Link Report </span></a>
            <div id="team" class="collapse">
                <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                    <li class="sidebar-list-item"><a href="{{ route('linkReport.accptedLink') }}" class="sidebar-link text-muted pl-lg-5">Accepted Link</a></li>
                    <li class="sidebar-list-item"><a href="{{ route('linkReport.rejectedLink') }}" class="sidebar-link text-muted pl-lg-5">Rejected Link</a></li>
                    <li class="sidebar-list-item"><a href="{{ route('linkReport.pendingLink') }}" class="sidebar-link text-muted pl-lg-5">Pending Link</a></li>
                </ul>
            </div>
        </li>
        <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#stored" aria-expanded="false" aria-controls="stored" class="sidebar-link text-muted"><i class="o-paper-stack-1 mr-3 text-gray"></i><span>Stored Link </span></a>
            <div id="stored" class="collapse">
                <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                    <li class="sidebar-list-item"><a href="{{ route('linkReport.sendersList') }}" class="sidebar-link text-muted pl-lg-5">Senders List</a></li>
                    <li class="sidebar-list-item"><a href="{{ route('linkReport.receiverList') }}" class="sidebar-link text-muted pl-lg-5">Receivers List</a></li>
                </ul>
            </div>
        </li>
        <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#fund" aria-expanded="false" aria-controls="fund" class="sidebar-link text-muted"><i class="o-statistic-1 mr-3 text-gray"></i><span>Fund Management </span></a>
            <div id="fund" class="collapse">
                <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                    <li class="sidebar-list-item"><a href="{{ route('fund.addFundForm') }}" class="sidebar-link text-muted pl-lg-5">Add Fund</a></li>
                    <li class="sidebar-list-item"><a href="{{ route('fund.fundList') }}" class="sidebar-link text-muted pl-lg-5">Added Fund History</a></li>
                </ul>
            </div>
        </li>
        <li class="sidebar-list-item"><a href="{{ url('/admin/give-helps') }}" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Give Helps</span></a></li>
        <li class="sidebar-list-item"><a href="{{ url('/admin/get-helps') }}" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Get Help helping</span></a></li>
        <li class="sidebar-list-item"><a href="{{ url('/admin/get-helps-working') }}" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Get Help Working</span></a></li>
        <li class="sidebar-list-item"><a href="{{ route('user.viewSecurity') }}" class="sidebar-link text-muted"><i class="o-profile-1 mr-3 text-gray"></i><span>Change Password</span></a></li>
        <li class="sidebar-list-item"><a href="{{ url('admin/contact') }}" class="sidebar-link text-muted"><i class="o-letter-1 mr-3 text-gray"></i><span>Contact</span></a></li>
    </ul>
</div>
