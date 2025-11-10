<!-- Sidebar -->
<ul class="navbar-nav sidebar-bg sidebar sidebar-dark accordion db-custom-sidebar" id="accordionSidebar">
    <!-- Sidebar - Brand -->
        <a class="sidebar-brand text-left pb-3" href="{{ route('home') }}">
            <img src="{{ asset('assets/dashboard/img/operator/logo.png') }}" class="mb-3 w-50" alt="E4u Logo">
        </a>

        <span class="operator-sidebar-head">Operator Console</span>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('operator.index') }}">               
                <img src="{{asset('assets/dashboard/img/menu-icon/dashboard.png')}}" alt="dashboard">
                <span>Dashboard</span>
            </a>
        </li>


        {{----------------------------- My Account ------------------------------}}        
        
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne">
                
                <img src="{{ asset('assets/dashboard/img/menu-icon/man.png') }}">
                <span>My Account</span>
            </a>
            <div id="collapseOne" class="collapse @if (request()->segment(2) == 'edit-my-account' ||
                    request()->segment(2) == 'change-password' ||
                    request()->segment(2) == 'notifications-and-features' ||
                    request()->segment(2) == 'upload-avatar' ||
                    request()->segment(2) == 'bank-account') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="py-2 collapse-inner rounded pb-0 mb-0 pt-0">
                    <a class="collapse-item" href="{{ route('operator.edit-my-account') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'edit-my-account' ? 'color: #f5841f;' : '' }}">
                            Edit my account</span>
                    </a>
                    <a class="collapse-item" href="{{ route('operator.change-password') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Change-Password.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'change-password'  ? 'color: #f5841f;' : '' }}">Change
                            password</span>
                    </a>

                    {{-- <a class="collapse-item" href="{{ route('agent.notifications-and-features') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/ccthree.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'notifications-and-features' || request()->segment(2) == 'profile' ? 'color: #f5841f;' : '' }}">Notifications & Features</span>
                    </a> --}}
                    <a class="collapse-item" href="{{ route('operator.upload-avatar') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/Upload-my-avatar.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'upload-avatar' ? 'color: #f5841f;' : '' }}">Upload
                            my avatar</span>
                    </a>
                    <a class="collapse-item" href="{{ route('operator.bank-account') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/app/img/sales-performance.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'bank-account' ? 'color: #f5841f;' : '' }}">Bank Account</span>
                    </a>
                </div>
            </div>
        </li>
        {{----------------------------- E4u tab ------------------------------}}   
        
        
        {{----------------------------- Support Agents tab ------------------------------}}        
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Support"
            aria-expanded="true" aria-controls="Support">
                <img src="{{ asset('assets/dashboard/img/menu-icon/management.png') }}">
                <span>Support Agents</span>
            </a>
        </li>
        {{-- end --}}

        {{----------------------------- Commission tab ------------------------------}}        
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Commission"
            aria-expanded="true" aria-controls="Commission">
                <img src="{{ asset('assets/dashboard/img/menu-icon/commision.png') }}">
                <span>Commission</span>
            </a>
        </li>
        {{-- end --}}

        {{----------------------------- Marketing tab ------------------------------}}        
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Marketing"
            aria-expanded="true" aria-controls="Marketing">
                <img src="{{ asset('assets/app/img/folded-booklet.png') }}">
                <span>Marketing</span>
            </a>
        </li>
        {{-- end --}}

        {{-- devider line --}}
        <li style="border-bottom:1px solid rgba(255,255,255,0.8);margin:0px 30px 0 15px;"></li>
        {{-- end --}}

        {{----------------------------- Analytics tab ------------------------------}}        
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Analytics"
            aria-expanded="true" aria-controls="Analytics">
                <img src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">
                <span>Analytics</span>
            </a>
        </li>
        {{-- end --}}

        
        {{----------------------------- Communication tab ------------------------------}}        
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Communication"
            aria-expanded="true" aria-controls="Communication">
                <img src="{{ asset('assets/dashboard/img/menu-icon/communication.png') }}">
                <span>Communication</span>
            </a>
        </li>
        {{-- end --}}


        
        {{----------------------------- Community tab ------------------------------}}        
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Community"
            aria-expanded="true" aria-controls="Community">
                <img src="{{ asset('assets/dashboard/img/menu-icon/com.png') }}">
                <span>Community</span>
            </a>
        </li>
        {{-- end --}}


        
        {{----------------------------- Support Tickets tab ------------------------------}}        
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Support-Tickets"
            aria-expanded="true" aria-controls="Support-Tickets">
                <img src="{{ asset('assets/app/img/ticket.png') }}">
                <span>Support Tickets</span>
            </a>
        </li>
        {{-- end --}}

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                
                <img src="{{ asset('assets/dashboard/img/logo.svg') }}">
                <span>E4U</span>
            </a>
            <div id="collapseTwo" class="collapse @if (request()->segment(2) == 'e4u-monthly-report') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="py-2 collapse-inner rounded pb-0 mb-0 pt-0">
                    <a class="collapse-item" href="{{ route('operator.e4u-monthly-report') }}">
                        <img width="16" height="17" viewbox="0 0 16 17" fill="none"
                            src="{{ asset('assets/dashboard/img/menu-icon/account-edit.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'e4u-monthly-report' ? 'color: #f5841f;' : '' }}">
                            Monthly Report</span>
                    </a>
                    
                </div>
            </div>
        </li>
        {{-- end --}}

        {{----------------------------- Agents tab ------------------------------}}        
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Agents-Tab"
            aria-expanded="true" aria-controls="Agents-Tab">
                <img src="{{ asset('assets/dashboard/img/menu-icon/manage-people.png') }}">
                <span>Agents</span>
            </a>

            <div id="Agents-Tab"
                class="collapse @if( request()->segment(2) == 'agents-monthly-report') show @endif"
                aria-labelledby="headingProfile" data-parent="#accordionSidebar">

                <div class="py-0 collapse-inner rounded mb-2">
                    <a class="collapse-item" href="{{ route('operator.agents-monthly-report') }}">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/registration.png') }}">
                         <span style="{{ request()->segment(2) == 'agents-monthly-report' ? 'color: #f5841f;' : '' }}">Monthly Report</span>
                    </a>
                </div>
            </div>
        </li>
        {{-- end --}}
</ul> 
<!-- End of Sidebar -->
