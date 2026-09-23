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
    
                @if (request('from') == 'dashboard')
                    <div class="back-to-dashboard">
                        <a href="{{ route('agent.dashboard') }}">
                            <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                        </a>
                    </div>
                @endif
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b></h3>
                        <ol>
                            <li>You can view your Income according to the period displayed.</li>
                            <li>For an expanded summary of income, go to <a href="{{ route('agent.fees.summary') }}"
                                    class="custom_links_design">Fees Summary</a>. </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- end --}}
        <div class="row">
            <div class="col-md-12">
                <div class="common-grid">
                    <div class="common-card">
                        <div class="card-top">
                            <div class="card-icon">
                                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M3 6V17C3 18.6569 4.34315 20 6 20H20C20.5523 20 21 19.5523 21 19V16M19 8H5C3.89543 8 3 7.10457 3 6V6C3 4.89543 3.89543 4 5 4H18C18.5523 4 19 4.44772 19 5V8ZM19 8H20C20.5523 8 21 8.44772 21 9V12M21 12H18C16.8954 12 16 12.8954 16 14V14C16 15.1046 16.8954 16 18 16H21M21 12V16" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        </path>
                                    </g>
                                </svg>
                            </div>

                            <div class="card-heading">
                                <h2>Escorts</h2>
                            </div>
                        </div>

                        <div class="common-stars">
                            <div class="stats-detail">
                                    <div class="stats-label">Today's Income
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $escorts['today'] }}</div>                        
                            </div>

                            <div class="stats-detail">
                                    <div class="stats-label">Week to Date
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $escorts['week'] }}</div>                        
                            </div>

                            <div class="stats-detail">
                                    <div class="stats-label">Month to Date
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $escorts['month'] }}</div>                        
                            </div>
                        </div>

                        <div class="card-note">
                            <div class="stats-detail">
                                    <div class="stats-label">Year to Date
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $escorts['year'] }}</div>                        
                            </div>
                        </div>
                    </div>
                    <div class="common-card">
                        <div class="card-top">
                            <div class="card-icon">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M3 6V17C3 18.6569 4.34315 20 6 20H20C20.5523 20 21 19.5523 21 19V16M19 8H5C3.89543 8 3 7.10457 3 6V6C3 4.89543 3.89543 4 5 4H18C18.5523 4 19 4.44772 19 5V8ZM19 8H20C20.5523 8 21 8.44772 21 9V12M21 12H18C16.8954 12 16 12.8954 16 14V14C16 15.1046 16.8954 16 18 16H21M21 12V16" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        </path>
                                    </g>
                                </svg>
                            </div>

                            <div class="card-heading">
                                <h2>Centres</h2>
                            </div>
                        </div>

                        <div class="common-stars">
                            <div class="stats-detail">
                                    <div class="stats-label">Today's Income
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $massageCentres['today'] }}</div>                        
                            </div>

                            <div class="stats-detail">
                                    <div class="stats-label">Week to Date
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $massageCentres['week'] }}</div>                        
                            </div>

                            <div class="stats-detail">
                                    <div class="stats-label">Month to Date
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $massageCentres['month'] }}</div>                        
                            </div>
                        </div>

                        <div class="card-note">
                            <div class="stats-detail">
                                    <div class="stats-label">Year to Date
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $massageCentres['year'] }}</div>                        
                            </div>
                        </div>
                    </div>
                    <div class="common-card">
                        <div class="card-top">
                            <div class="card-icon">
                                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M3 6V17C3 18.6569 4.34315 20 6 20H20C20.5523 20 21 19.5523 21 19V16M19 8H5C3.89543 8 3 7.10457 3 6V6C3 4.89543 3.89543 4 5 4H18C18.5523 4 19 4.44772 19 5V8ZM19 8H20C20.5523 8 21 8.44772 21 9V12M21 12H18C16.8954 12 16 12.8954 16 14V14C16 15.1046 16.8954 16 18 16H21M21 12V16" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        </path>
                                    </g>
                                </svg>
                            </div>

                            <div class="card-heading">
                                <h2>Advertisers</h2>
                            </div>
                        </div>

                        <div class="common-stars">
                            <div class="stats-detail">
                                    <div class="stats-label">Today's Income
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $advertisers['today'] }}</div>                        
                            </div>

                            <div class="stats-detail">
                                    <div class="stats-label">Week to Date
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $advertisers['week'] }}</div>                        
                            </div>

                            <div class="stats-detail">
                                    <div class="stats-label">Month to Date
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $advertisers['month'] }}</div>                        
                            </div>
                        </div>

                        <div class="card-note">
                            <div class="stats-detail">
                                    <div class="stats-label">Year to Date
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $advertisers['year'] }}</div>                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('script')
    @endsection