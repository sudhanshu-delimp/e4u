<!-- Sidebar -->
<ul class="navbar-nav sidebar-bg sidebar sidebar-dark accordion db-custom-sidebar" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand text-left pb-3">
        <img src="{{ asset('assets/dashboard/img/operator/logo.png') }}" class="mb-3 w-50" alt="E4u Logo">
    </a>

    <span class="operator-sidebar-head">Operator Console</span>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('operator.index') }}">
            <img src="{{ asset('assets/dashboard/img/menu-icon/dashboard.png') }}" alt="dashboard">
            <span>Dashboard</span>
        </a>
    </li>


    {{-- our Account --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#ourAccount"
            aria-expanded="true" aria-controls="ourAccount">

            <img src="{{ asset('assets/dashboard/img/menu-icon/man.png') }}">
            <span>Our Account - the Operator</span>
        </a>
        <div id="ourAccount" class="collapse @if (request()->segment(2) == 'view-my-account') show @endif;"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class=" collapse-inner rounded pb-0 mb-0 pt-0">
                <a class="collapse-item" href="{{route('operator.my-operator')}}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png') }}">
                    <span style="{{ request()->segment(2) == 'view-my-account' ? 'color: #f5841f;' : '' }}">
                        View our account</span>
                </a>
            </div>
        </div>
    </li>


    <li style="border-bottom:1px solid rgba(255,255,255,0.8);margin:10px 30px 15px 15px;"></li>
    


    {{-- Administration --}}
    <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Administration">
            <img src="{{ asset('assets/dashboard/img/menu-icon/management.png') }}">
            <span>Administration</span>
        </a>
        <div id="Administration" class="collapse  
        @if (in_array(request()->segment(2), []) || in_array(request()->segment(1), [])) show @endif"
            data-parent="#accordionSidebar">
            <div class="collapse-inner">

                {{-- --------------------------- Analytics tab ---------------------------- --}}

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Analytics"
                    aria-expanded="true" aria-controls="Analytics">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">
                    <span>Analytics</span>
                </a>
                {{-- end --}}


                {{-- --------------------------- Communication tab ---------------------------- --}}

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Communication"
                    aria-expanded="true" aria-controls="Communication">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/communication.png') }}">
                    <span>Communication</span>
                </a>

                {{-- end --}}



                {{-- --------------------------- Community tab ---------------------------- --}}

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Community"
                    aria-expanded="true" aria-controls="Community">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/com.png') }}">
                    <span>Community</span>
                </a>

                {{-- end --}}



                {{-- --------------------------- Support Tickets tab ---------------------------- --}}

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Support-Tickets"
                    aria-expanded="true" aria-controls="Support-Tickets">
                    <img src="{{ asset('assets/app/img/ticket.png') }}">
                    <span>Support Tickets</span>
                </a>

                {{-- end --}}

            </div>
        </div>
    </li>

  
    <li style="border-bottom:1px solid rgba(255,255,255,0.8);margin:10px 30px 15px 15px;"></li>
   

    {{-- Management --}}
    <li class="nav-item">
        {{-- Management --}}
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Management">
            <img src="{{ asset('assets/dashboard/img/menu-icon/administration.png') }}">
            <span>Management</span>
        </a>
        <!-- Manage People -->
        <div id="Management" class="collapse  @if (in_array(request()->segment(3), ['staff', 'agent']) || in_array(request()->segment(2), ['agents-monthly-report', 'operator-monthly-report'])) show @endif"
            data-parent="#accordionSidebar">
            <div class="collapse-inner">
                <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#managePeopleMenu" aria-expanded="false" aria-controls="managePeopleMenu">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/manage-people.png') }}">
                            <span>Manage People</span>
                        </a>

                        <div id="managePeopleMenu"
                            class="collapse @if (in_array(request()->segment(3), ['staff','agent'])) show @endif"
                            data-parent="#Management">
                             <a class="collapse-item" href="{{ route('operator.operator.staff') }}">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/operator-staff.png') }}">
                                <span style="{{ request()->segment(3) == 'staff' ? 'color: #f5841f;' : '' }}">Staff</span>
                            </a>
                            <a class="collapse-item" href="javascript:void(0)">
                                <img src="{{ asset('assets/dashboard/img/menu-icon/manage-agents.png') }}">
                                <span style="{{ request()->segment(3) == 'agent' ? 'color: #f5841f;' : '' }}">Agents</span>
                            </a>
                        </div>


                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Commission"
                    aria-expanded="true" aria-controls="Commission">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/commision.png') }}">
                    <span>Commission</span>
                </a>


                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Marketing"
                    aria-expanded="true" aria-controls="Marketing">
                    <img src="{{ asset('assets/app/img/folded-booklet.png') }}">
                    <span>Marketing</span>
                </a>

                {{-- --------------------------- Reports tab ---------------------------- --}}

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Reports-Tab"
                    aria-expanded="true" aria-controls="Reports-Tab">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/reports.png') }}">
                    <span>Reports</span>
                </a>

                <div id="Reports-Tab" class="collapse @if (request()->segment(2) == 'agents-monthly-report' || request()->segment(2) == 'operator-monthly-report') show @endif"
                    aria-labelledby="headingProfile" data-parent="#Management">

                    <div class="collapse-inner rounded mb-2">
                        <a class="collapse-item" href="{{ route('operator.agents-monthly-report') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                            <span
                                style="{{ request()->segment(2) == 'agents-monthly-report' ? 'color: #f5841f;' : '' }}">Agents
                                Monthly</span>
                        </a>

                        <a class="collapse-item" href="{{ route('operator.operator-monthly-report') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                            <span
                                style="{{ request()->segment(2) == 'operator-monthly-report' ? 'color: #f5841f;' : '' }}">
                                Operator Monthly</span>
                        </a>
                    </div>
                </div>

                {{-- Support Agents --}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Support"
                    aria-expanded="true" aria-controls="Support">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/management.png') }}">
                    <span>Support Agents</span>
                </a>
                {{-- end --}}

                {{-- end --}}

            </div>


        </div>
    </li>
   


    <li style="border-bottom:1px solid rgba(255,255,255,0.8);margin:10px 30px 15px 15px;"></li>
  
    {{-- My Account --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#myAccount"
            aria-expanded="true" aria-controls="myAccount">

            <img src="{{ asset('assets/dashboard/img/menu-icon/man.png') }}">
            <span>My Account - the User</span>
        </a>
        <div id="myAccount" class="collapse @if (request()->segment(2) == 'edit-my-account' ||
                request()->segment(2) == 'change-password' ||
                request()->segment(2) == 'notifications-and-features' ||
                request()->segment(2) == 'upload-avatar' ||
                request()->segment(2) == 'bank-account') show @endif;"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class=" collapse-inner rounded pb-0 mb-0 pt-0">
                <a class="collapse-item" href="{{ route('operator.edit-my-account') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png') }}">
                    <span style="{{ request()->segment(2) == 'edit-my-account' ? 'color: #f5841f;' : '' }}">
                        Edit my account</span>
                </a>
                <a class="collapse-item" href="{{ route('operator.change-password') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/Change-Password.png') }}">
                    <span style="{{ request()->segment(2) == 'change-password' ? 'color: #f5841f;' : '' }}">Change
                        password</span>
                </a>
                {{--  <a class="collapse-item" href="{{ route('operator.upload-avatar') }}">
                       <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'upload-avatar' ? 'color: #f5841f;' : '' }}">Upload
                            my avatar</span>
                    </a> --}}
               {{--  <a class="collapse-item" href="{{ route('operator.bank-account') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/bank.png') }}">
                    <span style="{{ request()->segment(2) == 'bank-account' ? 'color: #f5841f;' : '' }}">Bank
                        Account</span>
                </a> --}}
            </div>
        </div>
    </li>






</ul>
<!-- End of Sidebar -->
