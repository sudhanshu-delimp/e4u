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
</ul> 
<!-- End of Sidebar -->
