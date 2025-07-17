<!-- Sidebar -->
<ul class="sticky-top navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand text-left pb-3" href="{{ asset('/') }}">
        <img src="{{ asset('assets/app/img/logo.svg') }} " alt="">
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
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8 0.720703C9.06087 0.720703 10.0783 1.14213 10.8284 1.89228C11.5786 2.64242 12 3.65984 12 4.7207C12 5.78157 11.5786 6.79899 10.8284 7.54913C10.0783 8.29928 9.06087 8.7207 8 8.7207C6.93913 8.7207 5.92172 8.29928 5.17157 7.54913C4.42143 6.79899 4 5.78157 4 4.7207C4 3.65984 4.42143 2.64242 5.17157 1.89228C5.92172 1.14213 6.93913 0.720703 8 0.720703ZM8 10.7207C12.42 10.7207 16 12.5107 16 14.7207V16.7207H0V14.7207C0 12.5107 3.58 10.7207 8 10.7207Z"
                    fill="#C2CFE0" />
            </svg>
            <span>My Account</span>
        </a>
        <div id="collapseTwo" class="collapse @if (request()->segment(2) == 'update-account' ||
                request()->segment(2) == 'change-password' ||
                request()->segment(2) == 'upload-avatar' ||
                request()->segment(2) == 'bank_account') show @endif;"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-2 collapse-inner rounded pb-0 mb-0 pt-0">
                <a class="collapse-item" href="{{ route('agent.account.edit') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'update-account' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : '' }}">
                        Edit my account</span>
                </a>
                <a class="collapse-item" href="{{ route('agent.change.password') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/Change-Password.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'change-password' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : '' }}">Change
                        password</span>
                </a>
                <a class="collapse-item" href="{{ route('upload-avatar') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'upload-avatar' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : '' }}">Upload
                        my avatar</span>
                </a>
                <a class="collapse-item" href="{{ route('bank_account') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/app/img/sales-performance.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'bank_account' || request()->segment(2) == 'profile' ? 'color: #e5365a;' : '' }}">Bank
                        Account</span>
                </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Escorts" aria-expanded="true"
            aria-controls="collapseTwo">
            <svg width="22" height="17" viewBox="0 0 22 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M14 10.7207C11.3 10.7207 6 12.0207 6 14.7207V16.7207H22V14.7207C22 12.0207 16.7 10.7207 14 10.7207ZM14 8.7207C15.0609 8.7207 16.0783 8.29928 16.8284 7.54913C17.5786 6.79899 18 5.78157 18 4.7207C18 3.65984 17.5786 2.64242 16.8284 1.89228C16.0783 1.14213 15.0609 0.720703 14 0.720703C12.9391 0.720703 11.9217 1.14213 11.1716 1.89228C10.4214 2.64242 10 3.65984 10 4.7207C10 5.78157 10.4214 6.79899 11.1716 7.54913C11.9217 8.29928 12.9391 8.7207 14 8.7207ZM4 11.7207L3.4 11.2207C1.4 9.3207 0 8.1207 0 6.6207C0 5.4207 1 4.4207 2.2 4.4207C2.9 4.4207 3.6 4.7207 4 5.2207C4.4 4.7207 5.1 4.4207 5.8 4.4207C7 4.4207 8 5.3207 8 6.6207C8 8.1207 6.6 9.3207 4.6 11.2207L4 11.7207Z"
                    fill="#C2CFE0" />
            </svg>
            <span>My Advertisers</span>
        </a>
        <div id="Escorts" class="collapse @if (request()->segment(3) == 'new-requests' ||
                request()->segment(3) == 'history-requests' ||
                request()->segment(2) == 'user-escorts-list' ||
                request()->segment(2) == 'pricingsummaries') show @endif;" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('agent.new-requests') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/request.png') }}">
                    <span style="{{ request()->segment(3) == 'new-requests' ? 'color: #e5365a;' : '' }}">New
                        Requests</span>
                </a>


                <a class="collapse-item" href="{{ route('agent.history-requests') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/history.png') }}">
                    <span style="{{ request()->segment(3) == 'history-requests' ? 'color: #e5365a;' : '' }}">History
                        Requests</span>
                </a>

                <a class="collapse-item" href="{{ route('agent.manage.escorts.list') }}">
                    <svg width="19" height="17" viewBox="0 0 19 17" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5 9.7207V7.7207H19V9.7207H5ZM5 15.7207V13.7207H19V15.7207H5ZM5 3.7207V1.7207H19V3.7207H5ZM1 4.7207V1.7207H0V0.720703H2V4.7207H1ZM0 13.7207V12.7207H3V16.7207H0V15.7207H2V15.2207H1V14.2207H2V13.7207H0ZM2.25 6.7207C2.44891 6.7207 2.63968 6.79972 2.78033 6.94037C2.92098 7.08103 3 7.27179 3 7.4707C3 7.6707 2.92 7.8607 2.79 7.9907L1.12 9.7207H3V10.7207H0V9.8007L2 7.7207H0V6.7207H2.25Z"
                            fill="#C2CFE0" />
                    </svg>
                    <span class="pl-3"
                        style="{{ request()->segment(2) == 'user-escorts-list' ? 'color: #e5365a;' : '' }}">List
                        Advertisers</span>
                </a>
                <a class="collapse-item" href="{{ route('pricingsummaries') }}">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.00023 3.7208H12.0002L15.2902 0.420798C15.3832 0.32707 15.4938 0.252676 15.6156 0.201907C15.7375 0.151138 15.8682 0.125 16.0002 0.125C16.1322 0.125 16.2629 0.151138 16.3848 0.201907C16.5067 0.252676 16.6173 0.32707 16.7102 0.420798L19.2902 3.0108C19.4765 3.19816 19.581 3.45161 19.581 3.7158C19.581 3.97998 19.4765 4.23344 19.2902 4.4208L17.0002 6.7208H9.00023V8.7208C9.00023 8.98602 8.89487 9.24037 8.70733 9.42791C8.5198 9.61544 8.26544 9.7208 8.00023 9.7208C7.73501 9.7208 7.48066 9.61544 7.29312 9.42791C7.10558 9.24037 7.00023 8.98602 7.00023 8.7208V5.7208C7.00023 5.19037 7.21094 4.68166 7.58601 4.30658C7.96109 3.93151 8.46979 3.7208 9.00023 3.7208ZM3.00023 8.7208V12.7208L0.710226 15.0108C0.523975 15.1982 0.419434 15.4516 0.419434 15.7158C0.419434 15.98 0.523975 16.2334 0.710226 16.4208L3.29023 19.0108C3.38319 19.1045 3.49379 19.1789 3.61565 19.2297C3.73751 19.2805 3.86821 19.3066 4.00023 19.3066C4.13224 19.3066 4.26294 19.2805 4.3848 19.2297C4.50666 19.1789 4.61726 19.1045 4.71023 19.0108L9.00023 14.7208H13.0002C13.2654 14.7208 13.5198 14.6154 13.7073 14.4279C13.8949 14.2404 14.0002 13.986 14.0002 13.7208V12.7208H15.0002C15.2654 12.7208 15.5198 12.6154 15.7073 12.4279C15.8949 12.2404 16.0002 11.986 16.0002 11.7208V10.7208H17.0002C17.2654 10.7208 17.5198 10.6154 17.7073 10.4279C17.8949 10.2404 18.0002 9.98602 18.0002 9.7208V8.7208H11.0002V9.7208C11.0002 10.2512 10.7895 10.7599 10.4144 11.135C10.0394 11.5101 9.53066 11.7208 9.00023 11.7208H7.00023C6.46979 11.7208 5.96109 11.5101 5.58601 11.135C5.21094 10.7599 5.00023 10.2512 5.00023 9.7208V6.7208L3.00023 8.7208Z"
                            fill="#C2CFE0" />
                    </svg>
                    <span class="pl-3"
                        style="{{ request()->segment(2) == 'pricingsummaries' ? 'color: #e5365a;' : '' }}">Pricing
                        Summary</span>
                </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Commision"
            aria-expanded="false" aria-controls="collapseTwo">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                src="{{ asset('assets/dashboard/img/menu-icon/commision.png') }}">

            <span>Commission</span>
        </a>
        <div id="Commision" class="collapse @if (request()->segment(3) == 'statements' || request()->segment(3) == 'summary') show @endif;"
            data-parent="#accordionSidebar" class="collapse" style="">

            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('Commision.statements') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">
                    <span
                        style="{{ request()->segment(3) == 'statements' ? 'color: #e5365a;' : '' }}">Statements</span>
                </a>
                <a class="collapse-item" href="{{ route('Commision.summary') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/file-document-multiple-outline.png') }}">
                    <span style="{{ request()->segment(3) == 'summary' ? 'color: #e5365a;' : '' }}">Summary</span>
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#marketing"
            aria-expanded="false" aria-controls="collapseTwo">
            <img src="{{ asset('assets/app/img/folded-booklet.png') }}">
            <span>Marketing</span>
        </a>
        <div id="marketing" class=" collapse  @if (request()->segment(3) == 'create-information-package' || request()->segment(3) == 'create-prospect') show @endif;"
            aria-labelledby="headingten" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('marketing.create-information-package') }}">
                    <img src="{{ asset('assets/app/img/helptips.png') }}">
                    <span
                        style="{{ request()->segment(3) == 'create-information-package' ? 'color: #e5365a;' : '' }}">Create
                        Information Package</span>
                </a>
                <a class="collapse-item" href="{{ route('marketing.agencreate-prospect') }}">
                    <img src="{{ asset('assets/app/img/create.png') }}">
                    <span style="{{ request()->segment(3) == 'create-prospect' ? 'color: #e5365a;' : '' }}">Prospect
                        List</span>
                </a>

            </div>
        </div>
    </li>
    {{--  --}}
    <li style="border-bottom:1px solid rgba(255,255,255,0.8);margin:0px 30px 0 15px;"></li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Analytics"
            aria-expanded="false" aria-controls="collapseTwo">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">

            <span>Analytics</span>
        </a>
        <div id="Analytics" class="collapse @if (request()->segment(2) == 'advertiser-profiles' ||
                request()->segment(2) == 'advertiser-social-media' ||
                request()->segment(2) == 'prospets-memberships') show @endif;"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">

            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item" href="{{ route('agent.advertiser-profiles') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/app/img/user.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'advertiser-profiles' ? 'color: #e5365a;' : '' }}">Advertiser
                        Profiles</span>
                </a>
                <a class="collapse-item" href="{{ route('agent.advertiser-social-media') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'advertiser-social-media' ? 'color: #e5365a;' : '' }}">Advertiser
                        Social Media</span>
                </a>
                <a class="collapse-item" href="{{ route('agent.prospets-memberships') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/app/img/membership.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'prospets-memberships' ? 'color: #e5365a;' : '' }}">Prospets
                        & Memberships</span>
                </a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Communication"
            aria-expanded="false" aria-controls="collapseTwo">
            <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                src="{{ asset('assets/dashboard/img/menu-icon/ccone.png') }}">

            <span>Communication</span>
        </a>
        <div id="Communication" class="collapse @if (request()->segment(2) == 'advertiser-profiles' ||
                request()->segment(2) == 'advertiser-social-media' ||
                request()->segment(2) == 'prospets-memberships') show @endif;"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">

            <div class="py-0 collapse-inner rounded mb-2">
                {{-- <a class="collapse-item" href="{{ route('agent.advertiser-profiles') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/app/img/user.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'advertiser-profiles' ? 'color: #e5365a;' : '' }}">Advertiser
                        Profiles</span>
                </a>
                <a class="collapse-item" href="{{ route('agent.advertiser-social-media') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/dashboard/img/menu-icon/at.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'advertiser-social-media' ? 'color: #e5365a;' : '' }}">Advertiser
                        Social Media</span>
                </a>
                <a class="collapse-item" href="{{ route('agent.prospets-memberships') }}">
                    <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                        src="{{ asset('assets/app/img/membership.png') }}">
                    <span
                        style="{{ request()->segment(2) == 'prospets-memberships' ? 'color: #e5365a;' : '' }}">Prospets
                        & Memberships</span>
                </a> --}}
                <a class="collapse-item" href="{{ route('agent.agent-messages')}}">
                  <img src="{{ asset('assets/dashboard/img/menu-icon/chat.png')}}">
                  <span style="{{request()->segment(2) == 'agent-messages' ? 'color: #e5365a;' : ''}}">Messages</span>
              </a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Community"
            aria-expanded="true" aria-controls="collapseTwo">
            <img width="16" height="17" viewBox="0 0 16 17" fill="none"
                src="{{ asset('assets/dashboard/img/menu-icon/com.png') }}">
            </img>
            <span>Community</span>
        </a>
        <div id="Community" class="collapse @if (request()->segment(2) == 'abbreviations' ||
                request()->segment(2) == 'classification-laws' ||
                request()->segment(2) == 'help' ||
                request()->segment(2) == 'laws') show @endif;"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
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
                    <span style="{{ request()->segment(2) == 'help' ? 'color: #e5365a;' : '' }}">Help & Tips</span>
                </a>
                <a class="collapse-item" href="{{ route('agent.laws') }}">
                    <img src="{{ asset('assets/app/img/gavel.png') }}">
                    <span style="{{ request()->segment(2) == 'laws' ? 'color: #e5365a;' : '' }}">Local Laws</span>
                </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tickets"
            aria-expanded="true" aria-controls="collapseten">
            <img src="{{ asset('assets/app/img/ticket.png') }}">
            <span>Support tickets</span>
        </a>
        <div id="tickets" class=" collapse  @if (request()->segment(1) == 'support_tickets' || request()->segment(1) == 'submit_ticket') show @endif;"
            aria-labelledby="headingten" data-parent="#accordionSidebar" style="">
            <div class="py-0 collapse-inner rounded mb-2">
                <a class="collapse-item show" href="{{ url('submit_ticket') }}">
                    <img src="{{ asset('assets/app/img/right-30.png') }}">
                    <span style="{{ request()->segment(1) == 'submit_ticket' ? 'color: #e5365a;' : '' }}">Submit
                        ticket</span>
                </a>

                <a class="collapse-item" href="{{ route('support-ticket.list') }}">
                    <img src="{{ asset('assets/app/img/view-48.png') }}">
                    <span style="{{ request()->segment(2) == 'list' ? 'color: #e5365a;' : '' }}">View & reply
                        tickets</span>
                </a>

            </div>
        </div>
    </li>
</ul>

<!-- End of Sidebar -->
