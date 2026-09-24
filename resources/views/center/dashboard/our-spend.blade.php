@extends('layouts.center')
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <div class="custom-heading-wrapper">
                        <h1 class="h1">Our Spend</h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                            aria-expanded="true"><b>Help?</b></span>
                    </div>
                    <div class="back-to-dashboard">
                        <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                            <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b></h3>
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
            <div class="col-lg-12 mb-3">
                <div class="common-grid">
                    <div class="common-card">
                        <div class="card-top">
                            <div class="card-icon">
                                <x-icon name="spend" />                                
                            </div>
                            <div class="card-heading">
                                <h2>Advertising</h2>
                            </div>
                        </div>
                        <hr class="custom-hr">
                        <div class="common-stars">
                            <div class="stats-detail">
                                <div class="stats-label">Week to Date
                                </div>
                                <div class="stats-value">$ {{ $data['advertiseServices']['week_to_date'] }}</div>

                            </div>
                            <div class="stats-detail">
                                <div class="stats-label">Same period last year
                                </div>
                                <div class="stats-value">$ {{ $data['advertiseServices']['same_week_period_last_year'] }}
                                </div>

                            </div>
                            <hr class="custom-hr">
                            <div class="stats-detail">
                                <div class="stats-label">Month to Date

                                </div>
                                <div class="stats-value">$ {{ $data['advertiseServices']['month_to_date'] }}</div>

                            </div>
                            <div class="stats-detail">
                                <div class="stats-label">Same period last year
                                </div>
                                <div class="stats-value">$ {{ $data['advertiseServices']['same_month_period_last_year'] }}
                                </div>

                            </div>
                            <hr class="custom-hr">
                            <div class="stats-detail">
                                <div class="stats-label">Year to date</div>
                                <div class="stats-value">$ {{ $data['advertiseServices']['year_to_date'] }}</div>

                            </div>
                            <div class="stats-detail">
                                <div class="stats-label">Same period last year
                                </div>
                                <div class="stats-value">$ {{ $data['advertiseServices']['same_year_period_last_year'] }}
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="common-card">
                        <div class="card-top">
                            <div class="card-icon">                                
                                <x-icon name="spend" />     
                            </div>
                            <div class="card-heading">
                                <h2>Other Services</h2>
                            </div>
                        </div>
                        <hr class="custom-hr">
                        <div class="common-stars">
                            <div class="stats-detail disabled-link">
                                <div class="stats-label">Email account
                                </div>
                                <div class="stats-value">$ ${{ $data['otherServices']['email_account'] }}</div>
                            </div>
                            <div class="stats-detail disabled-link">
                                <div class="stats-label">Mobile SIM
                                </div>
                                <div class="stats-value">$ {{ $data['otherServices']['mobile_sim'] }}</div>
                            </div>
                            <div class="stats-detail">
                                <div class="stats-label">Product
                                </div>
                                <div class="stats-value">$ {{ $data['otherServices']['product'] }}</div>
                            </div>
                            <div class="stats-detail disabled-link">
                                <div class="stats-label">Support (E4U)
                                </div>
                                <div class="stats-value">$ {{ $data['otherServices']['support'] }}</div>
                            </div>
                        </div>
                        <div class="card-note">
                            <div class="stats-detail">
                                <div class="stats-label">Year to date total
                                </div>
                                <div class="stats-value"><span>$</span> {{ $data['otherServices']['year_to_date_total'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end row --}}

    </div>
@endsection
@section('script')
@endsection
