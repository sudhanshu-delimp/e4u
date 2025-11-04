<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion db-custom-sidebar" id="accordionSidebar">
    <!-- Sidebar - Brand -->
        <a class="sidebar-brand text-left pb-3" href="{{ route('home') }}">
            <img src="{{ asset('assets/app/img/logo.svg') }}" class="mb-3" alt="E4u Logo">
        </a>

        <span class="sidebar-console-head">Operator Console</span>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('operator.index') }}">               
                <img src="{{asset('assets/dashboard/img/menu-icon/dashboard.png')}}" alt="dashboard">
                <span>Dashboard</span>
            </a>
        </li>
        {{----------------------------- E4u tab ------------------------------}}        
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#e4u-Tab"
            aria-expanded="true" aria-controls="e4u-Tab">
                <img src="{{ asset('assets/dashboard/img/menu-icon/man.png') }}">
                <span>E4U</span>
            </a>

            <div id="e4u-Tab"
                class="collapse @if(
                    request()->segment(2) == 'monthly-report'))
                ) show @endif"
                aria-labelledby="headingProfile" data-parent="#accordionSidebar">

                <div class="py-0 collapse-inner rounded mb-2">
                    <a class="collapse-item" href="#">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/registration.png') }}">
                        <span class="{{ request()->segment(2) == 'monthly-report' ? 'menu-active' : '' }}">Monthly Report</span>
                    </a>
                </div>
            </div>
        </li>
        {{-- end --}}

        {{----------------------------- Agents tab ------------------------------}}        
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Agents-Tab"
            aria-expanded="true" aria-controls="Agents-Tab">
                <img src="{{ asset('assets/dashboard/img/menu-icon/man.png') }}">
                <span>Agents</span>
            </a>

            <div id="Agents-Tab"
                class="collapse @if(
                    request()->segment(2) == 'monthly-report'))
                ) show @endif"
                aria-labelledby="headingProfile" data-parent="#accordionSidebar">

                <div class="py-0 collapse-inner rounded mb-2">
                    <a class="collapse-item" href="#">
                        <img src="{{ asset('assets/dashboard/img/menu-icon/registration.png') }}">
                        <span class="{{ request()->segment(2) == 'monthly-report' ? 'menu-active' : '' }}">Monthly Report</span>
                    </a>
                </div>
            </div>
        </li>
        {{-- end --}}
</ul> 
<!-- End of Sidebar -->
