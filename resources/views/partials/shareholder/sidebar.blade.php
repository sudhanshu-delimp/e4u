<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion db-custom-sidebar" id="accordionSidebar">
    <!-- Sidebar - Brand -->
        <a class="sidebar-brand text-left pb-3" href="{{ route('home') }}">
            <img src="{{ asset('assets/app/img/logo.svg') }}" class="mb-3" alt="E4u Logo">
        </a>

        <span class="sidebar-console-head">Shareholder Console</span>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('shareholder.index') }}">               
                <img src="{{asset('assets/dashboard/img/menu-icon/dashboard.png')}}" alt="dashboard">
                <span>Dashboard</span>
            </a>
        </li>

        
        {{----------------------------- My Account ------------------------------}}        
        
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne">
                
                <img src="{{ asset('assets/dashboard/img/menu-icon/man.png') }}">
                <span>Our Account</span>
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

</ul> 
<!-- End of Sidebar -->
