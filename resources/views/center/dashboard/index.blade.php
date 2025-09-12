@extends('layouts.center')
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->

        <div class="row"> 
            <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1">Dashboard</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <p></p>
                        <ol>
                            <li>Click the card to view information.</li>
                            <li>
                                Some features can be changed here as well as from the relevant subject page. Where
                                you make a change, the relevant subject page will be updated.
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- box start --}}
            <div class="col-lg-4 box-wrapper">
                <div class="my-custom-box shadow-sm mt-0">
                    <a href="{{ route('center.dashboard.centre-statistics') }}">
                        <div class="box-icon">
                            <img src="{{ asset('assets/dashboard/img/boxicon/center/centre-statistics.png') }}"
                                class="my-svg-icons" alt="Centre Statistics">
                        </div>
                        <h2>
                            Centre Statistics
                        </h2>
                    </a>

                </div>
            </div>
            {{-- end --}}
            {{-- box start --}}
            <div class="col-lg-4 box-wrapper">
                <div class="my-custom-box shadow-sm mt-0">
                    <a href="{{ route('center.dashboard.legbox-viewer') }}">
                        <div class="box-icon">
                            <img src="{{ asset('assets/dashboard/img/boxicon/center/legbox-viewers.png') }}"
                                class="my-svg-icons" alt=" Legbox Viewers">
                        </div>
                        <h2>
                            Legbox Viewers
                        </h2>
                    </a>

                </div>
            </div>
            {{-- end --}}
            {{-- box start --}}
            <div class="col-lg-4 box-wrapper">
                <div class="my-custom-box shadow-sm mt-0">
                    <a href="{{ route('center.dashboard.our-spend') }}">
                        <div class="box-icon">
                            <img src="{{ asset('assets/dashboard/img/boxicon/center/our-spend.png') }}" class="my-svg-icons"
                                alt="My Spend">
                        </div>
                        <h2>
                            Our Spend
                        </h2>
                    </a>

                </div>
            </div>
            {{-- end --}}
            {{-- box start --}}
            <div class="col-lg-4 box-wrapper">
                <div class="my-custom-box shadow-sm">
                    <a href="{{ route('center.dashboard.our-statistics') }}">
                        <div class="box-icon">
                            <img src="{{ asset('assets/dashboard/img/boxicon/center/our-statistics.png') }}"
                                class="my-svg-icons" alt="Our Statistics">
                        </div>
                        <h2>
                            Our Statistics
                        </h2>
                    </a>

                </div>
            </div>
            {{-- end --}}
            {{-- box start --}}
            <div class="col-lg-4 box-wrapper">
                <div class="my-custom-box shadow-sm">
                    <a href="{{ route('center.dashboard.task-list') }}">
                        <div class="box-icon">
                            <img src="{{ asset('assets/dashboard/img/boxicon/center/task-list.png') }}" class="my-svg-icons"
                                alt="Task List">
                        </div>
                        <h2>
                            Task List
                        </h2>
                    </a>

                </div>
            </div>
            {{-- end --}}
            {{-- box start --}}
            <div class="col-lg-4 box-wrapper">
                <div class="my-custom-box shadow-sm">
                    <a href="{{ route('center.dashboard.manage-masseurs') }}">
                        <div class="box-icon">
                            <img src="{{ asset('assets/dashboard/img/boxicon/center/manage-masseurs.png') }}"
                                class="my-svg-icons" alt="Tour Schedule">
                        </div>
                        <h2>
                            Manage Masseurs
                        </h2>
                    </a>

                </div>
            </div>
            {{-- end --}}

            {{-- box start --}}
            <div class="col-lg-4 box-wrapper">
                <div class="my-custom-box shadow-sm">
                    <a href="{{ route('center.dashboard.manage-media') }}">
                        <div class="box-icon">
                            <img src="{{ asset('assets/dashboard/img/boxicon/center/manage-media.png') }}"
                                alt="Manage Media">
                        </div>
                        <h2>
                            Manage Media
                        </h2>
                    </a>

                </div>
            </div>
            {{-- end --}}

            {{-- box start --}}
            <div class="col-lg-4 box-wrapper">
                <div class="my-custom-box shadow-sm">
                    <a href="{{ route('center.dashboard.masseurs-statistics') }}">
                        <div class="box-icon">
                            <img src="{{ asset('assets/dashboard/img/boxicon/center/masseurs-statistics.png') }}"
                                alt="Masseurs Statistics">
                        </div>
                        <h2>
                            Masseurs Statistics
                        </h2>
                    </a>

                </div>
            </div>
            {{-- end --}}

            {{-- box start --}}
            <div class="col-lg-4 box-wrapper">
                <div class="my-custom-box shadow-sm">
                    <a href="{{ route('center.dashboard.logs-and-status') }}">
                        <div class="box-icon">
                            <img src="{{ asset('assets/dashboard/img/boxicon/center/logs-and-status.png') }}"
                                alt="Logs & Status">
                        </div>
                        <h2>
                            Logs & Status
                        </h2>
                    </a>

                </div>
            </div>
            {{-- end --}}
        </div>
        <div class="row my-3">
            <div class="col-lg-12">
                <div class="d-flex align-items-center justify-content-end custom-dash-btn">
                    <a href="{{ route('center.dashboard.customise-dashboard') }}">Customise Dashboard <i
                            class="fas fa-cog "></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row agent-dash d-none">
            <div class="col-lg-8 pr-2">
                <div class="sec-one">
                    <h2 class="h5 mt-2 mb-4 text-gray-800 font-weight-bold">My Statistics</h2>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card static-sec">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold mb-1 text-muted">Profile Views Today</div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800">25</div>
                                        </div>
                                        <div class="col-auto mt-3">
                                            <img src="{{ asset('assets/app/img/account-multiple-0.png') }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                        </div>
                        <div class="col-md-3 pl-0">
                            <div class="card static-sec-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold mb-1 text-muted">Media Views Today</div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800">125</div>
                                        </div>
                                        <div class="col-auto mt-3">
                                            <img src="{{ asset('assets/app/img/account-multiple-00.png') }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                        </div>
                        <div class="col-md-3 pl-0">
                            <div class="card static-sec">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold mb-1 text-muted">Recommendations This Week
                                            </div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800">32</div>
                                        </div>
                                        <div class="col-auto mt-3">
                                            <img src="{{ asset('assets/app/img/account-multiple-000.png') }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                        </div>
                        <div class="col-md-3 pl-0">
                            <div class="card static-sec-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold mb-1 text-muted">Reviews Posted This Week
                                            </div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800">125</div>
                                        </div>
                                        <div class="col-auto mt-3">
                                            <img src="{{ asset('assets/app/img/account-multiple-0000.png') }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 pl-2">
                <div class="sec-one pb-4">
                    <h2 class="h5 mt-2 mb-4 text-gray-800 font-weight-bold">My Income</h2>
                    <div class="row pb-1">
                        <div class="col-md-6 pr-0">
                            <div class="card">
                                <div class="card-body pl-2 pr-2 pt-4 pb-4 mt-1">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold mb-1 text-muted">Week to Date</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">$ 580.00</div>
                                        </div>
                                        <div class="col-6">
                                            <img src="{{ asset('assets/app/img/account-multiple-4.png') }}"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body pl-2 pr-2 pt-4 pb-4 mt-1">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold mb-1 text-muted">Month to Date</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">$ 3588.00</div>
                                        </div>
                                        <div class="col-6">
                                            <img src="{{ asset('assets/app/img/account-multiple-4.png') }}"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
