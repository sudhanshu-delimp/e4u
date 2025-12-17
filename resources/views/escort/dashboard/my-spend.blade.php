@extends('layouts.escort')

@section('style')
    <style>
        .table thead {
            background-color: var(--blue--text);
            color: #fff;
        }

        .icon-col {
            font-size: 18px;
            text-align: left;
            color: var(--blue--text);
        }

        h5 {
            color: var(--blue--text);
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <div class="custom-heading-wrapper">
                <h1 class="h1">My Spend</h1>
                <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></h6>
            </div>
            <div class="back-to-dashboard">
                <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                    <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <p></p>
                        <ol>
                            <li>This page is a summary of all the Fees you have spent on the Services.</li>
                            <li>To assist you in keeping an idea of your spend with E4U, we have provided information on
                                your spend with E4U for the same time last year.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-2">
                <h4 class="font-weight-bold" style="color: var(--blue--text);">Advertising
                </h4>
            </div>
            {{-- col-6 --}}
            <div class="col-lg-6 my-2">
                <div class="my-spend-box-wrapper">
                    <div class="row">
                        {{-- my spen box --}}
                        <div class="col-lg-6">
                            
                            <div class="card shadow-sm border-1 my-spend-box">
                                <div class="card-body adv-summary-card">
                                    <div class="lft">
                                        <div class="spend-icons">
                                            <i class="fas fas fa-calendar-minus"></i>
                                        </div>
                                        <h5>Week to Date</h5>
                                    </div>
                                    <span class="amount-text">$580.00</span>
                                </div>
                            </div>
                        </div>
                        {{-- end --}}
                        {{-- my spen box --}}
                        <div class="col-lg-6">
                            
                            <div class="card shadow-sm border-1 my-spend-box">
                                <div class="card-body adv-summary-card">
                                    <div class="lft">
                                        <div class="spend-icons">
                                            <i class="fas fas fa-calendar-minus"></i>
                                        </div>
                                        <h5>Same period last year</h5>
                                    </div>
                                    <span class="amount-text">$1,280.00</span>
                                </div>
                            </div>
                        </div>
                        {{-- end --}}
                    </div>
                </div>
            </div>
            {{-- end --}}
            {{-- col-6 --}}
            <div class="col-lg-6 my-2">
                <div class="my-spend-box-wrapper">
                    <div class="row">

                        {{-- my spen box --}}
                        <div class="col-lg-6">
                            
                            <div class="card shadow-sm border-1 my-spend-box">
                                <div class="card-body adv-summary-card">
                                    <div class="lft">
                                        <div class="spend-icons">
                                            <i class="fas fas fa-calendar-minus"></i>
                                        </div>
                                        <h5>Month to Date</h5>
                                    </div>
                                    <span class="amount-text">$580.00</span>
                                </div>
                            </div>
                        </div>
                        {{-- end --}}
                        {{-- my spen box --}}
                        <div class="col-lg-6">
                            
                            <div class="card shadow-sm border-1 my-spend-box">
                                <div class="card-body adv-summary-card">
                                    <div class="lft">
                                        <div class="spend-icons">
                                            <i class="fas fas fa-calendar-minus"></i>
                                        </div>
                                        <h5>Same period last year</h5>
                                    </div>
                                    <span class="amount-text">$1,280.00</span>
                                </div>
                            </div>
                        </div>
                        {{-- end --}}
                    </div>
                </div>
            </div>
            {{-- end --}}

            {{-- col-6 --}}
            <div class="col-lg-12 my-2">
                <div class="my-spend-box-wrapper">
                    <div class="row">

                        {{-- my spen box --}}
                        <div class="col-lg-12 card-list-wrapper">
                            
                            <div class="card shadow-sm border-1 my-spend-box">
                                <div class="card-body adv-summary-card">
                                    <div class="lft">
                                        <div class="spend-icons">
                                            <i class="fas fas fa-calendar"></i>
                                        </div>
                                        <h5>Year to date</h5>
                                    </div>
                                    <span class="amount-text">$580.00</span>
                                </div>
                            </div>
                            <div class="card shadow-sm border-1 my-spend-box">
                                <div class="card-body adv-summary-card">
                                    <div class="lft">
                                        <div class="spend-icons">
                                            <i class="fas fas fa-calendar-minus"></i>
                                        </div>
                                        <h5>Same period last year</h5>
                                    </div>
                                    <span class="amount-text">$1,280.00</span>
                                </div>
                            </div>
                        </div>
                        {{-- end --}}

                    </div>
                </div>
            </div>
            {{-- end --}}
        </div>
        {{-- end row --}}

        {{-- 2nd row start --}}

        <div class="row">
            <div class="col-lg-12 my-2">
                <h4 class="font-weight-bold" style="color: var(--blue--text);">Other Services
                </h4>
            </div>
            <div class="col-lg-12 my-2">
                <div class="my-spend-box-wrapper">
                    <div class="row">
                        <div class="col-lg-12 card-list-wrapper">
                            
                           
                            <div class="card shadow-sm border-1 my-spend-box">
                                <div class="card-body adv-summary-card">
                                    <div class="lft">
                                        <div class="spend-icons">
                                            <i class="fas fas fa-envelope"></i>
                                        </div>
                                        <h5>Email account</h5>
                                    </div>
                                    <span class="amount-text">$100</span>
                                </div>
                            </div>
                            <div class="card shadow-sm border-1 my-spend-box">
                                <div class="card-body adv-summary-card">
                                    <div class="lft">
                                        <div class="spend-icons">
                                            <i class="fas fas fa-sim-card"></i>
                                        </div>
                                        <h5>Mobile SIM</h5>
                                    </div>
                                    <span class="amount-text">$10</span>
                                </div>
                            </div>
                            <div class="card shadow-sm border-1 my-spend-box">
                                <div class="card-body adv-summary-card">
                                    <div class="lft">
                                        <div class="spend-icons">
                                            <i class="fas fas fa-box"></i>
                                        </div>
                                        <h5>Product</h5>
                                    </div>
                                    <span class="amount-text">$120</span>
                                </div>
                            </div>
                            <div class="card shadow-sm border-1 my-spend-box">
                                <div class="card-body adv-summary-card">
                                    <div class="lft">
                                        <div class="spend-icons">
                                            <i class="fas fas fa-tools"></i>
                                        </div>
                                        <h5>Support (E4U)</h5>
                                    </div>
                                    <span class="amount-text">$1,280.00</span>
                                </div>
                            </div>
                            
                            <div class="card shadow-sm border-1 my-spend-box">
                                <div class="card-body adv-summary-card">
                                    <div class="lft">
                                        <div class="spend-icons">
                                            <i class="fas fa-chart-pie"></i>
                                        </div>
                                        <h5>Year to date total </h5>
                                    </div>
                                    <span class="amount-text">$1,280.00</span>
                                </div>
                            </div>
                        </div>
                        {{-- end --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
@endsection
