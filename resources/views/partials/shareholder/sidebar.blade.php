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
                <span>My Account</span>
            </a>
            <div id="collapseOne" class="collapse @if (request()->segment(2) == 'edit-my-account' ||
                    request()->segment(2) == 'change-password' ||
                    request()->segment(2) == 'notifications' ||
                    request()->segment(2) == 'upload-my-avatar') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class=" collapse-inner rounded pb-0 mb-0 pt-0">
                    <a class="collapse-item" href="{{ route('shareholder.edit-my-account') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'edit-my-account' ? 'color: #ff3c5f;' : '' }}">
                            Edit my account</span>
                    </a>
                    <a class="collapse-item" href="{{ route('shareholder.change-password') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'change-password'  ? 'color: #ff3c5f;' : '' }}">Change
                            password</span>
                    </a>

                    <a class="collapse-item" href="{{ route('shareholder.notifications') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'notifications' ? 'color: #ff3c5f;' : '' }}">Notifications</span>
                    </a>
                    <a class="collapse-item" href="{{ route('shareholder.upload-my-avatar') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'upload-my-avatar' ? 'color: #ff3c5f;' : '' }}">Upload
                            my avatar</span>
                    </a>
                </div>
            </div>
        </li>
        
        {{----------------------------- Blackbox Tech Pty Ltd tab ------------------------------}}        
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Blackbox"
                aria-expanded="true" aria-controls="Blackbox">
                
                <img src="{{ asset('assets/dashboard/img/menu-icon/box.png') }}">
                <span>Blackbox Tech Pty Ltd</span>
            </a>
            <div id="Blackbox" class="collapse 
            @if (request()->segment(2) == 'annual-report' ||
                    request()->segment(2) == 'directors' ||
                    request()->segment(2) == 'portfolio' ||
                    request()->segment(2) == 'contact-us') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class=" collapse-inner rounded pb-0 mb-0 pt-0">
                    <a class="collapse-item" href="{{ route('shareholder.annualreport') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'annual-report' ? 'color: #ff3c5f;' : '' }}">
                            Annual Report</span>
                    </a>

                    <a class="collapse-item" href="{{ route('shareholder.directors', ['from' => 'sidebar']) }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'directors' ? 'color: #ff3c5f;' : '' }}">
                           Directors</span>
                    </a>

                    <a class="collapse-item" href="{{ route('shareholder.portfolio') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'portfolio' ? 'color: #ff3c5f;' : '' }}">
                            Portfolio</span>
                    </a>

                    <a class="collapse-item" href="{{ route('shareholder.contact-us') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'contact-us' ? 'color: #ff3c5f;' : '' }}">
                            Contact Us</span>
                    </a>
                </div>
            </div>
        </li>
        {{-- end --}}


         {{----------------------------- Communications ------------------------------}}        
         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Communications"
                aria-expanded="true" aria-controls="Communications">
                
                <img src="{{ asset('assets/dashboard/img/menu-icon/ccone.png') }}">
                <span>Communications</span>
            </a>
            <div id="Communications" class="collapse @if (request()->segment(2) == 'shareholder-notices' ||
                    request()->segment(2) == 'newsletter') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class=" collapse-inner rounded pb-0 mb-0 pt-0">
                    <a class="collapse-item" href="{{ route('shareholder.shareholder-notices') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'shareholder-notices' ? 'color: #ff3c5f;' : '' }}">
                            Shareholder Notices</span>
                    </a>

                    <a class="collapse-item" href="{{ route('shareholder.newsletter') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'newsletter' ? 'color: #ff3c5f;' : '' }}">
                           Newsletter</span>
                    </a>
                </div>
            </div>
        </li>
        {{-- end --}}


        {{----------------------------- E4u Information ------------------------------}}        
         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#E4uInformation"
                aria-expanded="true" aria-controls="E4uInformation">
                
                <img src="{{ asset('assets/dashboard/img/menu-icon/information.png') }}">
                <span>E4u Information</span>
            </a>
            <div id="E4uInformation" class="collapse @if (request()->segment(2) == 'registrations' ||
                    request()->segment(2) == 'revenue') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class=" collapse-inner rounded pb-0 mb-0 pt-0">
                    <a class="collapse-item" href="{{ route('shareholder.registrations', ['from' => 'sidebar']) }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'registrations' ? 'color: #ff3c5f;' : '' }}">
                            Registrations</span>
                    </a>

                    <a class="collapse-item" href="{{ route('shareholder.revenue', ['from' => 'sidebar']) }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'revenue' ? 'color: #ff3c5f;' : '' }}">
                           Revenue</span>
                    </a>
                </div>
            </div>
        </li>
        {{-- end --}}

         {{----------------------------- Global Monitoring ------------------------------}}        
         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#globalMonitoring"
                aria-expanded="true" aria-controls="globalMonitoring">
                
                <img src="{{ asset('assets/dashboard/img/menu-icon/chart.png') }}">
                <span>Global Monitoring</span>
            </a>
            <div id="globalMonitoring" class="collapse @if (request()->segment(2) == 'escort-listings' ||
                    request()->segment(2) == 'massage-centre-listings'||
                    request()->segment(2) == 'pin-up-listing') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class=" collapse-inner rounded pb-0 mb-0 pt-0">
                    <a class="collapse-item" href="{{ route('shareholder.escort-listings', ['from' => 'sidebar']) }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'escort-listings' ? 'color: #ff3c5f;' : '' }}">
                            Escort Listings</span>
                    </a>

                    <a class="collapse-item" href="{{ route('shareholder.massage-centre-listings') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'massage-centre-listings' ? 'color: #ff3c5f;' : '' }}">
                           Massage Centre Listings</span>
                    </a>

                    
                    <a class="collapse-item" href="{{ route('shareholder.pin-up-listing') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'pin-up-listing' ? 'color: #ff3c5f;' : '' }}">
                           Pin Up Listing</span>
                    </a>
                </div>
            </div>
        </li>
        {{-- end --}}


        {{----------------------------- Shareholder Documents ------------------------------}}        
         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Shareholderdoc"
                aria-expanded="true" aria-controls="Shareholderdoc">
                
                <img src="{{ asset('assets/dashboard/img/menu-icon/profit.png') }}">
                <span>Shareholder Documents</span>
            </a>
            <div id="Shareholderdoc" class="collapse @if (request()->segment(2) == 'annual-profit-and-loss' ||
                    request()->segment(2) == 'balance-sheet' || 
                    request()->segment(2) == 'constitution' ||
                    request()->segment(2) == 'shareholder-minutes' ||
                    request()->segment(2) == 'shareholder-updates') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class=" collapse-inner rounded pb-0 mb-0 pt-0">
                    <a class="collapse-item" href="{{ route('shareholder.annual-profit-and-loss') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'annual-profit-and-loss' ? 'color: #ff3c5f;' : '' }}">
                            Annual Profit & Loss</span>
                    </a>

                    <a class="collapse-item" href="{{ route('shareholder.balance-sheet') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'balance-sheet' ? 'color: #ff3c5f;' : '' }}">
                           Balance Sheet</span>
                    </a>

                    
                    <a class="collapse-item" href="{{ route('shareholder.constitution') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'constitution' ? 'color: #ff3c5f;' : '' }}">
                           Constitution</span>
                    </a>
                    <a class="collapse-item" href="{{ route('shareholder.shareholder-minutes') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'shareholder-minutes' ? 'color: #ff3c5f;' : '' }}">
                           Shareholder Minutes</span>
                    </a>
                    <a class="collapse-item" href="{{ route('shareholder.shareholder-updates') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'shareholder-updates' ? 'color: #ff3c5f;' : '' }}">
                           Shareholder Updates</span>
                    </a>
                </div>
            </div>
        </li>
        {{-- end --}}

         {{----------------------------- Share Register ------------------------------}}        
         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ShareRegister"
                aria-expanded="true" aria-controls="ShareRegister">
                
                <img src="{{ asset('assets/dashboard/img/menu-icon/share.png') }}">
                <span>Share Register</span>
            </a>
            <div id="ShareRegister" class="collapse @if (request()->segment(2) == 'share-value' ||
                    request()->segment(2) == 'overview' || 
                    request()->segment(2) == 'shareholders') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class=" collapse-inner rounded pb-0 mb-0 pt-0">
                    <a class="collapse-item" href="{{ route('shareholder.overview') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'overview' ? 'color: #ff3c5f;' : '' }}">
                            Overview</span>
                    </a>

                    <a class="collapse-item" href="{{ route('shareholder.shareholders', ['from' => 'sidebar']) }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'shareholders' ? 'color: #ff3c5f;' : '' }}">
                           Shareholders</span>
                    </a>

                    
                    <a class="collapse-item" href="{{ route('shareholder.share-value') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'share-value' ? 'color: #ff3c5f;' : '' }}">
                           Share Value</span>
                    </a>
                </div>
            </div>
        </li>
        {{-- end --}}

           {{----------------------------- Statistics  ------------------------------}}        
         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Statistics"
                aria-expanded="true" aria-controls="Statistics">
                
                <img src="{{ asset('assets/dashboard/img/menu-icon/statistic.png') }}">
                <span>Statistics </span>
            </a>
            <div id="Statistics" class="collapse @if (request()->segment(2) == 'escort-statistics' ||
                    request()->segment(2) == 'massage-centre-statistics') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class=" collapse-inner rounded pb-0 mb-0 pt-0">
                    

                    <a class="collapse-item" href="{{ route('shareholder.escort-statistics', ['from' => 'sidebar']) }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'escort-statistics' ? 'color: #ff3c5f;' : '' }}">
                           Escort Statistics</span>
                    </a>

                    
                    <a class="collapse-item" href="{{ route('shareholder.massage-centre-statistics', ['from' => 'sidebar']) }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'massage-centre-statistics' ? 'color: #ff3c5f;' : '' }}">
                           Massage Centre Statistics</span>
                    </a>
                </div>
            </div>
        </li>
        {{-- end --}}

         {{----------------------------- Subsidiaries ------------------------------}}        
         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Subsidiaries"
                aria-expanded="true" aria-controls="Subsidiaries">
                
                <img src="{{ asset('assets/dashboard/img/menu-icon/branch.png') }}">
                <span>Subsidiaries</span>
            </a>
            <div id="Subsidiaries" class="collapse @if (request()->segment(2) == 'overview-and-portfolio' ||
                    request()->segment(2) == 'profit-and-loss' || 
                    request()->segment(2) == 'balance-sheets') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class=" collapse-inner rounded pb-0 mb-0 pt-0">
                    <a class="collapse-item" href="{{ route('shareholder.overview-and-portfolio') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'overview-and-portfolio' ? 'color: #ff3c5f;' : '' }}">
                           Overview & Portfolio</span>
                    </a>

                    <a class="collapse-item" href="{{ route('shareholder.profit-and-loss') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'profit-and-loss' ? 'color: #ff3c5f;' : '' }}">
                           Annual Profit & Loss</span>
                    </a>

                    
                    <a class="collapse-item" href="{{ route('shareholder.balance-sheets') }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'balance-sheets' ? 'color: #ff3c5f;' : '' }}">
                           Balance Sheet</span>
                    </a>
                </div>
            </div>
        </li>
        {{-- end --}}



         {{----------------------------- Support Tickets ------------------------------}}        
         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#SupportTickets"
                aria-expanded="true" aria-controls="SupportTickets">
                
                <img src="{{ asset('assets/app/img/ticket.png') }}">
                <span>Support Tickets</span>
            </a>
            <div id="SupportTickets" class="collapse @if (request()->segment(2) == 'submit' ||
                    request()->segment(2) == 'view-and-reply') show @endif;"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class=" collapse-inner rounded pb-0 mb-0 pt-0">
                    

                    <a class="collapse-item" href="{{ route('shareholder.submit', ['from' => 'sidebar']) }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'submit' ? 'color: #ff3c5f;' : '' }}">
                           Submit</span>
                    </a>

                    
                    <a class="collapse-item" href="{{ route('shareholder.view-and-reply', ['from' => 'sidebar']) }}">
                        <img 
                            src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                        <span
                            style="{{ request()->segment(2) == 'view-and-reply' ? 'color: #ff3c5f;' : '' }}">
                           View & Reply</span>
                    </a>
                </div>
            </div>
        </li>
        {{-- end --}}


</ul> 
<!-- End of Sidebar -->
