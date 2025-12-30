<!-- Sidebar -->
<ul class="sticky-top navbar-nav bg-gradient-primary sidebar sidebar-dark accordion db-custom-sidebar"
    id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand text-left pb-3" href="{{ asset('/') }}">
        <img src="{{ asset('assets/app/img/logo.svg') }} " alt="" class="e4u_logo">
    </a>

    <span style="color:#FF3C5F;" class="font-weight-normal pl-3 pb-4">Agent Console </span>
    <!-- Divider -->
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('agent.dashboard') }}" id="dashboard">
            <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10 0.720703V6.7207H18V0.720703H10ZM10 18.7207H18V8.7207H10V18.7207ZM0 18.7207H8V12.7207H0V18.7207ZM0 10.7207H8V0.720703H0V10.7207Z"
                    fill="white" />
            </svg>
            <span id="dash"
                style="{{ $_SERVER['REQUEST_URI'] == '/agent-dashboard' ? 'color: #e5365a;' : '' }}">Dashboard </span>
        </a>
    </li>
    <!-- Divider -->
    <!-- Heading -->



    {{-- my account --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <img src="{{ asset('assets/dashboard/img/menu-icon/my-account.png') }}" alt="">
            <span>My Account</span>
        </a>
        <div id="collapseTwo" class="collapse @if (request()->segment(2) == 'update-account' ||
                request()->segment(2) == 'change-password' ||
                request()->segment(2) == 'notifications-and-features' ||
                request()->segment(2) == 'upload-avatar' ||
                request()->segment(2) == 'bank_account') show @endif;"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-2 collapse-inner rounded pb-0 mb-0 pt-0">
                <a class="collapse-item" href="{{ route('agent.account.edit') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'update-account' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : '' }}">
                        Edit my account</span>
                </a>
                <a class="collapse-item" href="{{ route('agent.change.password') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/Change-Password.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'change-password' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : '' }}">Change
                        password</span>
                </a>

                <a class="collapse-item" href="{{ route('agent.notifications-and-features') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/ccthree.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'notifications-and-features' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : '' }}">Notifications
                        & Features</span>
                </a>
                <a class="collapse-item" href="{{ route('upload-avatar') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'upload-avatar' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : '' }}">Upload
                        my avatar</span>
                </a>
                <a class="collapse-item" href="{{ route('bank_account') }}">
                    <img src="{{ asset('assets/app/img/sales-performance.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'bank_account' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : '' }}">Bank
                        Account</span>
                </a>
            </div>
        </div>
    </li>

     {{-- devider --}}
    <li
        style="border-bottom:1px solid rgba(255,255,255,0.8);margin:0px 30px 0 15px; margin-top: 10px;margin-bottom: 15px;">
    </li>
    {{-- end --}}

    {{-- end --}}
    {{-- Management --}}
    <li class="nav-item">
        {{-- Management --}}
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Management">
            <img src="{{ asset('assets/dashboard/img/menu-icon/administration.png') }}">
            <span>Management</span>
        </a>
        <div id="Management" class="collapse  @if (in_array(request()->segment(2), ['advertiser-list', 'calculate-reckoner']) ||
                in_array(request()->segment(3), [
                    'new-requests',
                    'history-requests',
                    'monthly-report',
                    'summary',
                    'submit_ticket',
                    'my-income',
                    'create-information-package',
                    'create-prospect',
                    'database-centers',
                    'saved-reports',
                ])) show @endif"
            data-parent="#accordionSidebar">
            <div class="collapse-inner">

                {{-- My Advertisers --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#MyAdvertisers">
                    <svg width="22" height="17" viewBox="0 0 22 17" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14 10.7207C11.3 10.7207 6 12.0207 6 14.7207V16.7207H22V14.7207C22 12.0207 16.7 10.7207 14 10.7207ZM14 8.7207C15.0609 8.7207 16.0783 8.29928 16.8284 7.54913C17.5786 6.79899 18 5.78157 18 4.7207C18 3.65984 17.5786 2.64242 16.8284 1.89228C16.0783 1.14213 15.0609 0.720703 14 0.720703C12.9391 0.720703 11.9217 1.14213 11.1716 1.89228C10.4214 2.64242 10 3.65984 10 4.7207C10 5.78157 10.4214 6.79899 11.1716 7.54913C11.9217 8.29928 12.9391 8.7207 14 8.7207ZM4 11.7207L3.4 11.2207C1.4 9.3207 0 8.1207 0 6.6207C0 5.4207 1 4.4207 2.2 4.4207C2.9 4.4207 3.6 4.7207 4 5.2207C4.4 4.7207 5.1 4.4207 5.8 4.4207C7 4.4207 8 5.3207 8 6.6207C8 8.1207 6.6 9.3207 4.6 11.2207L4 11.7207Z"
                            fill="#C2CFE0" />
                    </svg>
                    <span>My Advertisers</span>
                </a>
                <div id="MyAdvertisers" class="collapse @if (request()->segment(3) == 'new-requests' ||
                        request()->segment(3) == 'history-requests' ||
                        request()->segment(2) == 'advertiser-list' ||
                        request()->segment(2) == 'calculate-reckoner') show @endif;"
                    data-parent="#Management">
                    <div class="py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('agent.new-requests') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/request.png') }}">
                            <span style="{{ request()->segment(3) == 'new-requests' ? 'color: #e5365a;' : '' }}">New
                                Requests</span>
                        </a>


                        <a class="collapse-item" href="{{ route('agent.history-requests') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/history.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'history-requests' ? 'color: #e5365a;' : '' }}">History
                                Requests</span>
                        </a>



                        <a class="collapse-item" href="{{ route('agent.advertiser-list', ['from' => 'sidebar']) }}">

                            <img src="{{ asset('assets/dashboard/img/menu-icon/list-current.png') }}">
                            <span
                                style="{{ request()->segment(2) == 'advertiser-list' ? 'color: #e5365a;' : '' }}">List
                                Advertisers</span>
                        </a>

                        <a class="collapse-item" href="{{ route('pricingsummaries') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/pricing-summary.png') }}">
                            <span
                                style="{{ request()->segment(2) == 'calculate-reckoner' ? 'color: #e5365a;' : '' }}">Pricing
                                Summary</span>
                        </a>
                    </div>
                </div>
                {{-- end --}}

                {{-- fee --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Fees">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/commision.png') }}">

                    <span>Fees</span>
                </a>
                <div id="Fees" class="collapse @if (request()->segment(3) == 'monthly-report' ||
                        request()->segment(3) == 'summary' ||
                        request()->segment(3) == 'my-income') show @endif;"
                    data-parent="#Management">

                    <div class="py-0 collapse-inner rounded mb-2">

                        <a class="collapse-item" href="{{ route('Fees.summary') }}">
                            <img
                                src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">
                            <span style="{{ request()->segment(3) == 'summary' ? 'color: #e5365a;' : '' }}">Fees
                                Summary</span>
                        </a>

                        <a class="collapse-item" href="{{ route('Fees.monthly-report') }}">
                            <img
                                src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'monthly-report' ? 'color: #e5365a;' : '' }}">Monthly
                                Report</span>
                        </a>


                        <a class="collapse-item" href="{{ route('Fees.my-income', ['from' => 'sidebar']) }}">
                            <img
                                src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">
                            <span style="{{ request()->segment(3) == 'my-income' ? 'color: #e5365a;' : '' }}">My
                                Income</span>
                        </a>





                    </div>
                </div>
                {{-- end --}}

                {{-- Marketing --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#marketing">
                    <img src="{{ asset('assets/app/img/folded-booklet.png') }}">
                    <span>Marketing</span>
                </a>
                <div id="marketing" class=" collapse  @if (request()->segment(3) == 'create-information-package' ||
                        request()->segment(3) == 'create-prospect' ||
                        request()->segment(3) == 'database-centers' ||
                        request()->segment(3) == 'saved-reports') show @endif;"
                    data-parent="#Management">
                    <div class="py-0 collapse-inner rounded mb-2">
                        <a class="collapse-item" href="{{ route('agent.database-centers', ['from' => 'sidebar']) }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/data-center.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'database-centers' ? 'color: #e5365a;' : '' }}">Database
                                (Centres)</span>
                        </a>
                        <a class="collapse-item" href="{{ route('marketing.create-information-package') }}">
                            <img src="{{ asset('assets/app/img/helptips.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'create-information-package' ? 'color: #e5365a;' : '' }}">Information
                                Packages</span>
                        </a>
                        <a class="collapse-item"
                            href="{{ route('marketing.agencreate-prospect', ['from' => 'sidebar']) }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/prospect.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'create-prospect' ? 'color: #e5365a;' : '' }}">Prospect
                                Lists</span>
                        </a>
                        <a class="collapse-item" href="{{ route('agent.saved-reports') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/saved-reports.png') }}">
                            <span
                                style="{{ request()->segment(3) == 'saved-reports' ? 'color: #e5365a;' : '' }}">Saved
                                Reports</span>
                        </a>

                    </div>
                </div>
                {{-- end --}}
            </div>
        </div>
    </li>
    {{-- end --}}

    {{-- devider --}}
    <li
        style="border-bottom:1px solid rgba(255,255,255,0.8);margin:0px 30px 0 15px; margin-top: 10px;margin-bottom: 15px;">
    </li>
    {{-- end --}}

    {{-- Administration --}}
    <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Administration">
            <img src="{{ asset('assets/dashboard/img/menu-icon/management.png') }}">
            <span>Administration</span>
        </a>
        <div id="Administration" class="collapse  
        @if (in_array(request()->segment(2), [ 
        'advertiser-profiles','advertiser-social-media','toursummary','prospets-memberships','agent-messages', 'guidelines', 'forms',
            'abbreviations','classification-laws','help','laws','ticket-list'
        ]) || in_array(request()->segment(1), ['submit_ticket'])) show @endif"
            data-parent="#accordionSidebar">
            <div class="collapse-inner">

                {{-- Analytics --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Analytics"
                    aria-expanded="false" aria-controls="collapseTwo">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">

                    <span>Analytics</span>
                </a>
                <div id="Analytics" class="collapse @if (request()->segment(2) == 'advertiser-profiles' ||
                        request()->segment(2) == 'advertiser-social-media' ||
                        request()->segment(2) == 'toursummary' ||
                        request()->segment(2) == 'prospets-memberships') show @endif;"
                    data-parent="#Administration">

                    <div class="py-0 collapse-inner rounded mb-2">
                        <a class="collapse-item" href="{{ route('agent.advertiser-profiles') }}">
                            <img src="{{ asset('assets/app/img/user.png') }}">
                            <span
                                style="{{ request()->segment(2) == 'advertiser-profiles' ? 'color: #e5365a;' : '' }}">Profile
                                Summary</span>
                        </a>

                        <a class="collapse-item" href="{{ route('agent.toursummary') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/tour-summary.png') }}">
                            <span style="{{ request()->segment(2) == 'toursummary' ? 'color: #e5365a;' : '' }}">Tour
                                Summary</span>
                        </a>
                    </div>
                </div>
                {{-- end --}}

                {{-- Communication --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Communication"
                    aria-expanded="false" aria-controls="Communication">
                    <img width="16" height="17"
                        src="{{ asset('assets/dashboard/img/menu-icon/communication.png') }}">
                    <span>Communication</span>
                </a>

                <div id="Communication" class="collapse @if (in_array(request()->segment(2), ['agent-messages', 'guidelines', 'forms'])) show @endif"
                    data-parent="#Administration">

                    <div class="py-0 collapse-inner rounded mb-2">


                        <!-- Forms -->
                        <a class="collapse-item" href="{{ route('agent.forms') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/form.png') }}">
                            <span style="{{ request()->segment(2) == 'forms' ? 'color: #e5365a;' : '' }}">Forms</span>
                        </a>

                        <!-- Guidelines -->
                        <a class="collapse-item" href="{{ route('agent.guidelines') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/guide.png') }}">
                            <span
                                style="{{ request()->segment(2) == 'guidelines' ? 'color: #e5365a;' : '' }}">Guidelines</span>
                        </a>
                        <!-- Messages -->
                        <a class="collapse-item" href="{{ route('agent.agent-messages') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/chat.png') }}">
                            <span
                                style="{{ request()->segment(2) == 'agent-messages' ? 'color: #e5365a;' : '' }}">Messages</span>
                        </a>
                    </div>
                </div>
                {{-- end --}}

                {{-- Community --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Community"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/com.png') }}">
                    <span>Community</span>
                </a>
                <div id="Community" class="collapse @if (request()->segment(2) == 'abbreviations' ||
                        request()->segment(2) == 'classification-laws' ||
                        request()->segment(2) == 'help' ||
                        request()->segment(2) == 'laws') show @endif;"
                    data-parent="#Administration">
                    <div class="py-0 collapse-inner rounded mb-2">
                        <a class="collapse-item" href="{{ route('agent.abbreviations') }}">
                            <img src="{{ asset('assets/app/img/Abrieviations.png') }}">
                            <span
                                style="{{ request()->segment(2) == 'abbreviations' ? 'color: #e5365a;' : '' }}">Abbreviations</span>
                        </a>
                        <a class="collapse-item" href="{{ route('agent.classification-laws') }}">
                            <img src="{{ asset('assets/app/img/Abrieviations.png') }}">
                            <span
                                style="{{ request()->segment(2) == 'classification-laws' ? 'color: #e5365a;' : '' }}">Classification
                                laws</span>
                        </a>
                        <a class="collapse-item" href="{{ route('agent.help') }}">
                            <img src="{{ asset('assets/app/img/helptips.png') }}">
                            <span style="{{ request()->segment(2) == 'help' ? 'color: #e5365a;' : '' }}">Help &
                                Tips</span>
                        </a>
                        <a class="collapse-item" href="{{ route('agent.laws') }}">
                            <img src="{{ asset('assets/app/img/gavel.png') }}">
                            <span style="{{ request()->segment(2) == 'laws' ? 'color: #e5365a;' : '' }}">Local
                                Laws</span>
                        </a>
                    </div>
                </div>
                {{-- end --}}
                {{-- Support tickets --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tickets"
                    aria-expanded="true" aria-controls="collapseten">
                    <img src="{{ asset('assets/app/img/ticket.png') }}">
                    <span>Support tickets</span>
                </a>
                <div id="tickets" class=" collapse  @if (request()->segment(2) == 'ticket-list' || request()->segment(1) == 'submit_ticket') show @endif;"
                    data-parent="#Administration">
                    <div class="py-0 collapse-inner rounded mb-2">
                        <a class="collapse-item show" href="{{ url('submit_ticket') }}">
                            <img src="{{ asset('assets/app/img/right-30.png') }}">
                            <span
                                style="{{ request()->segment(1) == 'submit_ticket' ? 'color: #e5365a;' : '' }}">Submit
                            </span>
                        </a>

                        <a class="collapse-item" href="{{ route('support-ticket.list') }}">
                            <img src="{{ asset('assets/app/img/view-48.png') }}">
                            <span style="{{ request()->segment(2) == 'ticket-list' ? 'color: #e5365a;' : '' }}">View &
                                reply
                            </span>
                        </a>

                    </div>
                </div>
                {{-- end --}}
            </div>
        </div>
    </li>
</ul>

<!-- End of Sidebar -->
