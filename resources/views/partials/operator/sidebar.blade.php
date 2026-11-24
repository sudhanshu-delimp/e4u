<!-- Sidebar -->
<ul class="navbar-nav sidebar-bg sidebar sidebar-dark accordion db-custom-sidebar" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand text-left pb-3">
        <img src="{{ asset('assets/dashboard/img/operator/logo.png') }}" class="w-50" alt="E4u Logo">
    </a>

    <span class="operator-sidebar-head console_heading">Operator Console</span>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('operator.index') }}">
            <svg width="64px" height="64px" viewBox="-7.2 -7.2 38.40 38.40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0">
                    <rect x="-7.2" y="-7.2" width="38.40" height="38.40" rx="19.2" fill="#eff0f6" strokewidth="0"></rect>
                </g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <rect width="24" height="24" fill="none"></rect>
                    <path d="M15.024 22C16.2771 22 17.3524 21.9342 18.2508 21.7345C19.1607 21.5323 19.9494 21.1798 20.5646 20.5646C21.1798 19.9494 21.5323 19.1607 21.7345 18.2508C21.9342 17.3524 22 16.2771 22 15.024V12C22 10.8954 21.1046 10 20 10H12C10.8954 10 10 10.8954 10 12V20C10 21.1046 10.8954 22 12 22H15.024Z" fill="#0c223d"></path>
                    <path d="M2 15.024C2 16.2771 2.06584 17.3524 2.26552 18.2508C2.46772 19.1607 2.82021 19.9494 3.43543 20.5646C4.05065 21.1798 4.83933 21.5323 5.74915 21.7345C5.83628 21.7538 5.92385 21.772 6.01178 21.789C7.09629 21.9985 8 21.0806 8 19.976L8 12C8 10.8954 7.10457 10 6 10H4C2.89543 10 2 10.8954 2 12V15.024Z" fill="#0c223d"></path>
                    <path d="M8.97597 2C7.72284 2 6.64759 2.06584 5.74912 2.26552C4.8393 2.46772 4.05062 2.82021 3.4354 3.43543C2.82018 4.05065 2.46769 4.83933 2.26549 5.74915C2.24889 5.82386 2.23327 5.89881 2.2186 5.97398C2.00422 7.07267 2.9389 8 4.0583 8H19.976C21.0806 8 21.9985 7.09629 21.789 6.01178C21.772 5.92385 21.7538 5.83628 21.7345 5.74915C21.5322 4.83933 21.1798 4.05065 20.5645 3.43543C19.9493 2.82021 19.1606 2.46772 18.2508 2.26552C17.3523 2.06584 16.2771 2 15.024 2H8.97597Z" fill="#003c3e"></path>
                </g>
            </svg>
            <span>Dashboard</span>
        </a>
    </li>
    <!-- Divider -->
    <div class="dropdown-divider"></div>
    <!-- end -->

    {{-- our Account --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#ourAccount"
            aria-expanded="true" aria-controls="ourAccount">

            <svg fill="#003c3e" width="64px" height="64px" viewBox="-7.2 -7.2 38.40 38.40" xmlns="http://www.w3.org/2000/svg" stroke="#0c223d">
                <g id="SVGRepo_bgCarrier" stroke-width="0">
                    <rect x="-7.2" y="-7.2" width="38.40" height="38.40" rx="19.2" fill="#eff0f6" strokewidth="0"></rect>
                </g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <title>Account Settings</title>
                    <path d="M9.6,3.32a3.86,3.86,0,1,0,3.86,3.85A3.85,3.85,0,0,0,9.6,3.32M16.35,11a.26.26,0,0,0-.25.21l-.18,1.27a4.63,4.63,0,0,0-.82.45l-1.2-.48a.3.3,0,0,0-.3.13l-1,1.66a.24.24,0,0,0,.06.31l1,.79a3.94,3.94,0,0,0,0,1l-1,.79a.23.23,0,0,0-.06.3l1,1.67c.06.13.19.13.3.13l1.2-.49a3.85,3.85,0,0,0,.82.46l.18,1.27a.24.24,0,0,0,.25.2h1.93a.24.24,0,0,0,.23-.2l.18-1.27a5,5,0,0,0,.81-.46l1.19.49c.12,0,.25,0,.32-.13l1-1.67a.23.23,0,0,0-.06-.3l-1-.79a4,4,0,0,0,0-.49,2.67,2.67,0,0,0,0-.48l1-.79a.25.25,0,0,0,.06-.31l-1-1.66c-.06-.13-.19-.13-.31-.13L19.5,13a4.07,4.07,0,0,0-.82-.45l-.18-1.27a.23.23,0,0,0-.22-.21H16.46M9.71,13C5.45,13,2,14.7,2,16.83v1.92h9.33a6.65,6.65,0,0,1,0-5.69A13.56,13.56,0,0,0,9.71,13m7.6,1.43a1.45,1.45,0,1,1,0,2.89,1.45,1.45,0,0,1,0-2.89Z"></path>
                </g>
            </svg>


            <span>The Operator Account</span>
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


    <!-- Divider -->
    <div class="dropdown-divider"></div>
    <!-- end -->

    {{-- Administration --}}
    <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Administration">

            <svg fill="#003c3e" height="64px" width="64px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-142.37 -142.37 759.31 759.31" xml:space="preserve" stroke="#0c223d">
                <g id="SVGRepo_bgCarrier" stroke-width="0">
                    <rect x="-142.37" y="-142.37" width="759.31" height="759.31" rx="379.655" fill="#eff0f6" strokewidth="0"></rect>
                </g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <g>
                        <path d="M255.204,102.3c-0.606-11.321-12.176-9.395-23.465-9.395C240.078,95.126,247.967,98.216,255.204,102.3z"></path>
                        <path d="M134.524,73.928c-43.825,0-63.997,55.471-28.963,83.37c11.943-31.89,35.718-54.788,66.886-63.826 C163.921,81.685,150.146,73.928,134.524,73.928z"></path>
                        <path d="M43.987,148.617c1.786,5.731,4.1,11.229,6.849,16.438L36.44,179.459c-3.866,3.866-3.866,10.141,0,14.015l25.375,25.383 c1.848,1.848,4.38,2.888,7.019,2.888c2.61,0,5.125-1.04,7.005-2.888l14.38-14.404c2.158,1.142,4.55,1.842,6.785,2.827 c0-0.164-0.016-0.334-0.016-0.498c0-11.771,1.352-22.875,3.759-33.302c-17.362-11.174-28.947-30.57-28.947-52.715 c0-34.592,28.139-62.739,62.723-62.739c23.418,0,43.637,13.037,54.43,32.084c11.523-1.429,22.347-1.429,35.376,1.033 c-1.676-5.07-3.648-10.032-6.118-14.683l14.396-14.411c1.878-1.856,2.918-4.38,2.918-7.004c0-2.625-1.04-5.148-2.918-7.004 l-25.361-25.367c-1.94-1.941-4.472-2.904-7.003-2.904c-2.532,0-5.063,0.963-6.989,2.904l-14.442,14.411 c-5.217-2.764-10.699-5.078-16.444-6.825V9.9c0-5.466-4.411-9.9-9.893-9.9h-35.888c-5.451,0-9.909,4.434-9.909,9.9v20.359 c-5.73,1.747-11.213,4.061-16.446,6.825L75.839,22.689c-1.942-1.941-4.473-2.904-7.005-2.904c-2.531,0-5.077,0.963-7.003,2.896 L36.44,48.048c-1.848,1.864-2.888,4.379-2.888,7.012c0,2.632,1.04,5.148,2.888,7.004l14.396,14.403 c-2.75,5.218-5.063,10.708-6.817,16.438H23.675c-5.482,0-9.909,4.441-9.909,9.915v35.889c0,5.458,4.427,9.908,9.909,9.908H43.987z"></path>
                        <path d="M354.871,340.654c15.872-8.705,26.773-25.367,26.773-44.703c0-28.217-22.967-51.168-51.184-51.168 c-9.923,0-19.118,2.966-26.975,7.873c-4.705,18.728-12.113,36.642-21.803,52.202C309.152,310.022,334.357,322.531,354.871,340.654z "></path>
                        <path d="M460.782,276.588c0-5.909-4.799-10.693-10.685-10.693H428.14c-1.896-6.189-4.411-12.121-7.393-17.75l15.544-15.544 c2.02-2.004,3.137-4.721,3.137-7.555c0-2.835-1.118-5.553-3.137-7.563l-27.363-27.371c-2.08-2.09-4.829-3.138-7.561-3.138 c-2.734,0-5.467,1.048-7.547,3.138l-15.576,15.552c-5.623-2.982-11.539-5.481-17.751-7.369v-21.958 c0-5.901-4.768-10.685-10.669-10.685H311.11c-2.594,0-4.877,1.04-6.739,2.578c3.26,11.895,5.046,24.793,5.046,38.552 c0,8.735-0.682,17.604-1.956,26.423c7.205-2.656,14.876-4.324,22.999-4.324c36.99,0,67.086,30.089,67.086,67.07 c0,23.637-12.345,44.353-30.872,56.303c13.48,14.784,24.195,32.324,31.168,51.976c1.148,0.396,2.344,0.684,3.54,0.684 c2.733,0,5.467-1.04,7.563-3.13l27.379-27.371c2.004-2.004,3.106-4.721,3.106-7.555s-1.102-5.551-3.106-7.563l-15.576-15.552 c2.982-5.621,5.497-11.555,7.393-17.75h21.957c2.826,0,5.575-1.118,7.563-3.138c2.004-1.996,3.138-4.72,3.138-7.555 L460.782,276.588z"></path>
                        <path d="M376.038,413.906c-16.602-48.848-60.471-82.445-111.113-87.018c-16.958,17.958-37.954,29.351-61.731,29.351 c-23.759,0-44.771-11.392-61.713-29.351c-50.672,4.573-94.543,38.17-111.145,87.026l-9.177,27.013 c-2.625,7.773-1.368,16.338,3.416,23.007c4.783,6.671,12.486,10.631,20.685,10.631h315.853c8.215,0,15.918-3.96,20.702-10.631 c4.767-6.669,6.041-15.234,3.4-23.007L376.038,413.906z"></path>
                        <path d="M120.842,206.782c0,60.589,36.883,125.603,82.352,125.603c45.487,0,82.368-65.014,82.368-125.603 C285.563,81.188,120.842,80.939,120.842,206.782z"></path>
                    </g>
                </g>
            </svg>

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


    <!-- Divider -->
    <div class="dropdown-divider"></div>
    <!-- end -->

    {{-- Management --}}
    <li class="nav-item">
        {{-- Management --}}
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Management">

            <svg fill="#003c3e" height="64px" width="64px" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="-89.1 -89.1 475.20 475.20" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 297 297">
                <g id="SVGRepo_bgCarrier" stroke-width="0">
                    <rect x="-89.1" y="-89.1" width="475.20" height="475.20" rx="237.6" fill="#eff0f6" strokewidth="0"></rect>
                </g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <g>
                        <path d="m112.632,185.074l6.88-3.972c2.804-1.619 3.765-5.205 2.146-8.01l-13.036-22.579c-1.086-1.881-3.057-2.933-5.083-2.933-0.995,0-2.003,0.253-2.926,0.787l-6.88,3.972c-0.945,0.545-1.947,0.794-2.923,0.794-3.063,0-5.872-2.449-5.872-5.872v-7.944c0-3.238-2.625-5.864-5.864-5.864h-26.073c-3.238,0-5.864,2.625-5.864,5.864v7.944c0,3.423-2.81,5.872-5.872,5.872-0.976,0-1.978-0.249-2.923-0.794l-6.88-3.972c-0.923-0.533-1.932-0.786-2.926-0.787-2.027,0-3.997,1.052-5.083,2.933l-13.036,22.579c-1.619,2.805-0.658,6.391 2.146,8.01l6.88,3.972c3.909,2.257 3.909,7.899 0,10.156l-6.88,3.972c-2.805,1.619-3.765,5.205-2.146,8.01l13.036,22.579c1.086,1.881 3.057,2.933 5.083,2.933 0.995,0 2.003-0.254 2.926-0.787l6.88-3.972c0.945-0.545 1.947-0.794 2.923-0.794 3.063,0 5.872,2.449 5.872,5.872v7.944c0,3.238 2.625,5.864 5.864,5.864h26.072c3.238,0 5.864-2.625 5.864-5.864v-7.944c0-3.423 2.81-5.872 5.872-5.872 0.976,0 1.978,0.249 2.923,0.794l6.88,3.972c0.923,0.533 1.932,0.787 2.926,0.787 2.027,0 3.997-1.052 5.083-2.933l13.036-22.579c1.619-2.805 0.658-6.391-2.146-8.01l-6.88-3.972c-3.908-2.257-3.908-7.9 0.001-10.156zm-46.594,22.474c-9.608,0-17.396-7.789-17.396-17.396 0-9.608 7.789-17.396 17.396-17.396s17.396,7.789 17.396,17.396c0,9.607-7.789,17.396-17.396,17.396z"></path>
                        <path d="m108.109,23.659c-3.146-3.144-8.243-3.144-11.389,0-3.145,3.146-3.145,8.244 0,11.389l14.39,14.389c-52.889,2.619-95.701,44.162-100.334,96.506l1.19-2.062c3.406-5.9 9.756-9.565 16.57-9.564 0.144,0 0.287,0.013 0.431,0.017 9.074-37.721 41.965-66.251 81.815-68.729l-14.062,14.061c-3.145,3.145-3.145,8.244 0,11.389 1.573,1.572 3.633,2.358 5.694,2.358s4.122-0.786 5.694-2.358l28.004-28.004c1.51-1.511 2.358-3.559 2.358-5.694 0-2.136-0.848-4.184-2.358-5.694l-28.003-28.004z"></path>
                        <path d="m209.868,64.857c17.881,0 32.428-14.547 32.428-32.428 0-17.882-14.547-32.429-32.428-32.429-17.881,0-32.428,14.547-32.428,32.428 0,17.881 14.547,32.429 32.428,32.429z"></path>
                        <path d="m273.039,152.276v-44.58c0-12.34-7.93-23.283-19.657-27.124l-.054-.018-17.152-2.84c-1.46-0.449-3.02,0.324-3.545,1.764l-19.462,53.399c-1.123,3.081-5.48,3.081-6.602,0l-19.462-53.399c-0.424-1.163-1.522-1.892-2.698-1.892-0.279,0-17.999,2.964-17.999,2.964-11.823,3.94-19.723,14.9-19.723,27.294v44.432c0,6.659 5.398,12.056 12.056,12.056h102.241c6.66-2.84217e-14 12.057-5.398 12.057-12.056z"></path>
                        <path d="m287.37,162.933c-0.673,9.215-8.233,14.858-17.45,15.526-7.062,40.425-41.207,71.64-82.979,74.237l14.061-14.061c3.145-3.146 3.145-8.244 0-11.389-3.146-3.144-8.243-3.144-11.389,0l-28.003,28.004c-3.145,3.146-3.145,8.244 0,11.389l28.003,28.003c1.573,1.572 3.633,2.358 5.694,2.358s4.122-0.786 5.694-2.358c3.145-3.145 3.145-8.244 0-11.389l-14.389-14.389c56.028-2.774 100.758-49.227 100.758-105.931z"></path>
                        <path d="m216.936,77.105c-0.747-0.814-1.84-1.224-2.946-1.224h-8.245c-1.105,0-2.198,0.41-2.946,1.224-1.157,1.261-1.325,3.082-0.504,4.505l4.407,6.644-2.063,17.405 4.063,10.808c0.396,1.087 1.933,1.087 2.33,0l4.063-10.808-2.063-17.405 4.407-6.644c0.822-1.423 0.654-3.244-0.503-4.505z"></path>
                    </g>
                </g>
            </svg>

            <span>Management</span>
        </a>
        <!-- Manage People -->
        <div id="Management" class="collapse  @if (in_array(request()->segment(3), ['staff', 'agent']) || in_array(request()->segment(4), ['agents-monthly-report', 'operator-monthly-report'])) show @endif"
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

                <div id="Reports-Tab" class="collapse @if (request()->segment(4) == 'agents-monthly-report' || request()->segment(4) == 'operator-monthly-report') show @endif"
                    aria-labelledby="headingProfile" data-parent="#Management">

                    <div class="collapse-inner rounded mb-2">
                        <a class="collapse-item" href="{{ route('operator.agents-monthly-report') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                            <span
                                style="{{ request()->segment(4) == 'agents-monthly-report' ? 'color: #f5841f;' : '' }}">Agents
                                Monthly</span>
                        </a>

                        <a class="collapse-item" href="{{ route('operator.operator-monthly-report') }}">
                            <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                            <span
                                style="{{ request()->segment(4) == 'operator-monthly-report' ? 'color: #f5841f;' : '' }}">
                                Monthly Report</span>
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



    <!-- Divider -->
    <div class="dropdown-divider"></div>
    <!-- end -->

    {{-- My Account --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#myAccount"
            aria-expanded="true" aria-controls="myAccount">
            <svg viewBox="-2.4 -2.4 28.8 28.8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0">
                    <rect x="-2.4" y="-2.4" width="28.8" height="28.8" rx="14.4" fill="#fff" strokewidth="0"></rect>
                </g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <rect width="24" height="24" fill="none"></rect>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5 9.5C5 7.01472 7.01472 5 9.5 5C11.9853 5 14 7.01472 14 9.5C14 11.9853 11.9853 14 9.5 14C7.01472 14 5 11.9853 5 9.5Z" fill="#003c3e"></path>
                    <path d="M14.3675 12.0632C14.322 12.1494 14.3413 12.2569 14.4196 12.3149C15.0012 12.7454 15.7209 13 16.5 13C18.433 13 20 11.433 20 9.5C20 7.567 18.433 6 16.5 6C15.7209 6 15.0012 6.2546 14.4196 6.68513C14.3413 6.74313 14.322 6.85058 14.3675 6.93679C14.7714 7.70219 15 8.5744 15 9.5C15 10.4256 14.7714 11.2978 14.3675 12.0632Z" fill="#003c3e"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.64115 15.6993C5.87351 15.1644 7.49045 15 9.49995 15C11.5112 15 13.1293 15.1647 14.3621 15.7008C15.705 16.2847 16.5212 17.2793 16.949 18.6836C17.1495 19.3418 16.6551 20 15.9738 20H3.02801C2.34589 20 1.85045 19.3408 2.05157 18.6814C2.47994 17.2769 3.29738 16.2826 4.64115 15.6993Z" fill="#003c3e"></path>
                    <path d="M14.8185 14.0364C14.4045 14.0621 14.3802 14.6183 14.7606 14.7837V14.7837C15.803 15.237 16.5879 15.9043 17.1508 16.756C17.6127 17.4549 18.33 18 19.1677 18H20.9483C21.6555 18 22.1715 17.2973 21.9227 16.6108C21.9084 16.5713 21.8935 16.5321 21.8781 16.4932C21.5357 15.6286 20.9488 14.9921 20.0798 14.5864C19.2639 14.2055 18.2425 14.0483 17.0392 14.0008L17.0194 14H16.9997C16.2909 14 15.5506 13.9909 14.8185 14.0364Z" fill="#003c3e"></path>
                </g>
            </svg>
            <span>The User Account</span>
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
                        My Account</span>
                </a>
                <a class="collapse-item" href="{{ route('operator.change-password') }}">
                    <img src="{{ asset('assets/dashboard/img/menu-icon/Change-Password.png') }}">
                    <span style="{{ request()->segment(2) == 'change-password' ? 'color: #f5841f;' : '' }}">Change
                        password</span>
                </a>
                {{-- <a class="collapse-item" href="{{ route('operator.upload-avatar') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/arrow.png') }}">
                <span
                    style="{{ request()->segment(2) == 'upload-avatar' ? 'color: #f5841f;' : '' }}">Upload
                    my avatar</span>
                </a> --}}
                {{-- <a class="collapse-item" href="{{ route('operator.bank-account') }}">
                <img src="{{ asset('assets/dashboard/img/menu-icon/bank.png') }}">
                <span style="{{ request()->segment(2) == 'bank-account' ? 'color: #f5841f;' : '' }}">Bank
                    Account</span>
                </a> --}}
            </div>
        </div>
    </li>






</ul>
<!-- End of Sidebar -->