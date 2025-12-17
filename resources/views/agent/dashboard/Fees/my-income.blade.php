@extends('layouts.agent')
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->
        <div class="row">
            <!-- Page Heading -->
            <div class="d-flex align-items-center justify-content-between col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">My Income</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                        aria-expanded="true"><b>Help?</b></span>
                </div>
                <div class="back-to-dashboard">

                    @if (request('from') !== 'sidebar')
                        <a href="{{ route('agent.dashboard') }}">
                            <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>
                            <li>You can view your Income according to the period displayed.</li>
                            <li>For an expanded summary of income, go to <a href="{{ route('Fees.summary') }}"
                                    class="custom_links_design">Fees Summary</a>. </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- end --}}
        {{-- 1st row --}}
        <div class="col-lg-12 card-wrapper">
            <div class="row p-4 rounded my-2" style="background-color: #c2cfe052;">
                {{-- 1st --}}
                <div class="col-lg-12">
                    <h4 class="font-weight-bold" style="color: var(--blue--text);">My Income (Advertisers)
                    </h4>
                </div>
                <div class="col-lg-12 card-list-wrapper">
                    <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label font-weight-bold">Today's Income
                            </div>
                            <div class="statistics-value"><span>$</span> 950.00</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/income.png') }}" alt="icon">
                        </div>
                    </div>

                    <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label font-weight-bold">Week to Date
                            </div>
                            <div class="statistics-value"><span>$</span> 2,500.00</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/income.png') }}" alt="icon">
                        </div>
                    </div>

                    <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label font-weight-bold">Month to Date
                            </div>
                            <div class="statistics-value"><span>$</span> 5,500.00</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/income.png') }}" alt="icon">
                        </div>
                    </div>

                    <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label font-weight-bold">Year to Date
                            </div>
                            <div class="statistics-value"><span>$</span> 75,5000.00</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/income.png') }}" alt="icon">
                        </div>
                    </div>
                </div>
                {{-- 2nd --}}
                <div class="col-lg-12">
                    <h4 class="font-weight-bold" style="color: var(--blue--text);">My Income (Escorts)

                    </h4>
                </div>


                <div class="col-lg-12 card-list-wrapper">
                    <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label font-weight-bold">Today's Income
                            </div>
                            <div class="statistics-value"><span>$</span> 450.00</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/income.png') }}" alt="icon">
                        </div>
                    </div>
                    <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label font-weight-bold">Week to Date
                            </div>
                            <div class="statistics-value"><span>$</span> 1,500.00</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/income.png') }}" alt="icon">
                        </div>
                    </div>
                    <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label font-weight-bold">Month to Date
                            </div>
                            <div class="statistics-value"><span>$</span> 2,500.00</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/income.png') }}" alt="icon">
                        </div>
                    </div>
                    <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label font-weight-bold">Year to Date
                            </div>
                            <div class="statistics-value"><span>$</span> 55,000.00</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/income.png') }}" alt="icon">
                        </div>
                    </div>
                </div>

                {{-- 3rd --}}
                <div class="col-lg-12">
                    <h4 class="font-weight-bold" style="color: var(--blue--text);">My Income (Massage Centres)

                    </h4>
                </div>
                <div class="col-lg-12 card-list-wrapper">
                    <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label font-weight-bold">Today's Income
                            </div>
                            <div class="statistics-value"><span>$</span> 150.00</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/income.png') }}" alt="icon">
                        </div>
                    </div>
                    <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label font-weight-bold">Week to Date
                            </div>
                            <div class="statistics-value"><span>$</span> 500.00</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/income.png') }}" alt="icon">
                        </div>
                    </div>
                    <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label font-weight-bold">Month to Date
                            </div>
                            <div class="statistics-value"><span>$</span> 750.00</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/income.png') }}" alt="icon">
                        </div>
                    </div>
                    <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label font-weight-bold">Year to Date
                            </div>
                            <div class="statistics-value"><span>$</span> 25,000.00</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/income.png') }}" alt="icon">
                        </div>
                    </div>
                </div>
            </div>
            {{-- end --}}


        </div>
    @endsection
    @section('script')
    @endsection
