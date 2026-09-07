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

                    @if (request('from') == 'dashboard')
                        <a href="{{ route('agent.dashboard') }}">
                            <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                        </a>
                    @endif
                </div>
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
        {{-- 1st row --}}
        <div class="col-lg-12 card-wrapper">
            <div class="row">
                {{-- 1st --}}
                <div class="col-lg-12 common-card mb-3">
                    <div class="card-top">
                        <div class="card-icon">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M3 6V17C3 18.6569 4.34315 20 6 20H20C20.5523 20 21 19.5523 21 19V16M19 8H5C3.89543 8 3 7.10457 3 6V6C3 4.89543 3.89543 4 5 4H18C18.5523 4 19 4.44772 19 5V8ZM19 8H20C20.5523 8 21 8.44772 21 9V12M21 12H18C16.8954 12 16 12.8954 16 14V14C16 15.1046 16.8954 16 18 16H21M21 12V16"
                                        stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <div class="card-heading">
                            <h2>My Income (Advertisers)</h2>
                        </div>
                    </div>
                    <hr class="custom-hr">
                    <div class="stats-card-grid  ">

                        <div class="stats-card">
                            <div class="stats-details">
                                <div class="stats-icon">
                                    <svg fill="#ff3c5f" height="24px" width="24px" version="1.1" id="Layer_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        viewBox="0 0 511.999 511.999" xml:space="preserve">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <g>
                                                <g>
                                                    <path
                                                        d="M256.298,101.846c-92.85,0-206.983,143.686-206.983,260.579c0,44.352,15.783,79.881,46.928,105.612 c35.323,29.174,89.169,43.962,160.054,43.962c70.625,0,124.319-14.906,159.567-44.319c31.069-25.916,46.82-61.673,46.82-106.262 C462.685,244.98,348.887,101.846,256.298,101.846z M264.276,302.614c23.697,12.525,53.196,28.124,53.196,59.042 c0,27.843-18.793,51.339-44.341,58.603v7.908c0,9.18-7.448,16.628-16.628,16.628c-9.18,0-16.628-7.448-16.628-16.628v-7.908 c-25.548-7.264-44.341-30.76-44.341-58.603c0-9.18,7.448-16.628,16.628-16.628c9.18,0,16.628,7.448,16.628,16.628 c0,15.285,12.428,27.713,27.713,27.713s27.713-12.428,27.713-27.713c0-10.89-18.036-20.417-35.486-29.64 c-23.697-12.525-53.196-28.124-53.196-59.042c0-27.843,18.793-51.339,44.341-58.603v-7.908c0-9.18,7.448-16.628,16.628-16.628 c9.18,0,16.628,7.448,16.628,16.628v7.908c25.548,7.264,44.341,30.76,44.341,58.603c0,9.18-7.448,16.628-16.628,16.628 c-9.18,0-16.628-7.448-16.628-16.628c0-15.285-12.428-27.713-27.713-27.713s-27.713,12.428-27.713,27.713 C228.791,283.864,246.825,293.391,264.276,302.614z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M347.037,20.547c-7.686-3.941-17.126-1.354-21.705,5.976c-6.95,11.14-16.639,13.932-23.545,14.311 c-12.016,0.855-24.087-5.25-32.454-15.816C256.752,9.115,236.844,0,214.728,0c-22.116,0-42.024,9.115-54.604,25.017 c-3.746,4.72-4.634,11.085-2.338,16.66c1.859,4.508,10.991,25.543,26.151,46.511c23.911-12.465,48.487-19.6,72.36-19.6 c23.868,0,48.444,7.139,72.347,19.615c15.169-20.974,24.306-42.019,26.166-46.528C358.1,33.678,354.722,24.498,347.037,20.547z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="stat-text">
                                    <div class="stats-label">Today's Income
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $advertisers['today'] }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="stats-card">
                            <div class="stats-details">

                                <div class="stats-icon">
                                    <div class="stats-icon">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path> </g></svg>
                                </div>
                                </div>
                                <div class="stats-text">
                                    <div class="stats-label font-weight-bold">Week to Date
                                    </div>
                                    <div class="stats-value"><span>$</span>  {{ $advertisers['week'] }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="stats-card">
                            <div class="stats-details">
                                <div class="stats-icon">
                                    <div class="stats-icon">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path> </g></svg>
                                </div>
                                </div>
                                <div class="stats-text">
                                    <div class="stats-label font-weight-bold">Month to Date
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $advertisers['month'] }}</div>
                                </div>
                            </div>

                        </div>

                        <div class="stats-card">
                            <div class="stats-details">

                                <div class="stats-icon">
                                   <div class="stats-icon">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path> </g></svg>
                                </div>
                                </div>
                                <div class="stats-text">
                                    <div class="stats-label font-weight-bold">Year to Date
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $advertisers['year'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 2nd --}}                
                <div class="col-lg-12 common-card mb-3">
                    <div class="card-top">
                        <div class="card-icon">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M3 6V17C3 18.6569 4.34315 20 6 20H20C20.5523 20 21 19.5523 21 19V16M19 8H5C3.89543 8 3 7.10457 3 6V6C3 4.89543 3.89543 4 5 4H18C18.5523 4 19 4.44772 19 5V8ZM19 8H20C20.5523 8 21 8.44772 21 9V12M21 12H18C16.8954 12 16 12.8954 16 14V14C16 15.1046 16.8954 16 18 16H21M21 12V16"
                                        stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <div class="card-heading">
                            <h2>My Income (Escorts)</h2>
                        </div>
                    </div>
                    <hr class="custom-hr">
                    <div class="stats-card-grid  ">

                        <div class="stats-card">
                            <div class="stats-details">
                                <div class="stats-icon">
                                    <svg fill="#ff3c5f" height="24px" width="24px" version="1.1" id="Layer_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        viewBox="0 0 511.999 511.999" xml:space="preserve">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <g>
                                                <g>
                                                    <path
                                                        d="M256.298,101.846c-92.85,0-206.983,143.686-206.983,260.579c0,44.352,15.783,79.881,46.928,105.612 c35.323,29.174,89.169,43.962,160.054,43.962c70.625,0,124.319-14.906,159.567-44.319c31.069-25.916,46.82-61.673,46.82-106.262 C462.685,244.98,348.887,101.846,256.298,101.846z M264.276,302.614c23.697,12.525,53.196,28.124,53.196,59.042 c0,27.843-18.793,51.339-44.341,58.603v7.908c0,9.18-7.448,16.628-16.628,16.628c-9.18,0-16.628-7.448-16.628-16.628v-7.908 c-25.548-7.264-44.341-30.76-44.341-58.603c0-9.18,7.448-16.628,16.628-16.628c9.18,0,16.628,7.448,16.628,16.628 c0,15.285,12.428,27.713,27.713,27.713s27.713-12.428,27.713-27.713c0-10.89-18.036-20.417-35.486-29.64 c-23.697-12.525-53.196-28.124-53.196-59.042c0-27.843,18.793-51.339,44.341-58.603v-7.908c0-9.18,7.448-16.628,16.628-16.628 c9.18,0,16.628,7.448,16.628,16.628v7.908c25.548,7.264,44.341,30.76,44.341,58.603c0,9.18-7.448,16.628-16.628,16.628 c-9.18,0-16.628-7.448-16.628-16.628c0-15.285-12.428-27.713-27.713-27.713s-27.713,12.428-27.713,27.713 C228.791,283.864,246.825,293.391,264.276,302.614z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M347.037,20.547c-7.686-3.941-17.126-1.354-21.705,5.976c-6.95,11.14-16.639,13.932-23.545,14.311 c-12.016,0.855-24.087-5.25-32.454-15.816C256.752,9.115,236.844,0,214.728,0c-22.116,0-42.024,9.115-54.604,25.017 c-3.746,4.72-4.634,11.085-2.338,16.66c1.859,4.508,10.991,25.543,26.151,46.511c23.911-12.465,48.487-19.6,72.36-19.6 c23.868,0,48.444,7.139,72.347,19.615c15.169-20.974,24.306-42.019,26.166-46.528C358.1,33.678,354.722,24.498,347.037,20.547z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="stat-text">
                                    <div class="stats-label">Today's Income
                                    </div>
                                    <div class="stats-value"><span>$</span>{{ $escorts['today'] }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="stats-card">
                            <div class="stats-details">

                                <div class="stats-icon">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path> </g></svg>
                                </div>
                                <div class="stats-text">
                                    <div class="stats-label font-weight-bold">Week to Date
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $escorts['week'] }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="stats-card">
                            <div class="stats-details">
                                <div class="stats-icon">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path> </g></svg>
                                </div>
                                <div class="stats-text">
                                    <div class="stats-label font-weight-bold">Month to Date
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $escorts['month'] }}</div>
                                </div>
                            </div>

                        </div>

                        <div class="stats-card">
                            <div class="stats-details">

                                <div class="stats-icon">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path> </g></svg>
                                </div>
                                <div class="stats-text">
                                    <div class="stats-label font-weight-bold">Year to Date
                                    </div>
                                    <div class="stats-value"><span>$</span>{{ $escorts['year'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 3nd --}}                
                <div class="col-lg-12 common-card">
                    <div class="card-top">
                        <div class="card-icon">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M3 6V17C3 18.6569 4.34315 20 6 20H20C20.5523 20 21 19.5523 21 19V16M19 8H5C3.89543 8 3 7.10457 3 6V6C3 4.89543 3.89543 4 5 4H18C18.5523 4 19 4.44772 19 5V8ZM19 8H20C20.5523 8 21 8.44772 21 9V12M21 12H18C16.8954 12 16 12.8954 16 14V14C16 15.1046 16.8954 16 18 16H21M21 12V16"
                                        stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <div class="card-heading">
                            <h2>My Income (Massage Centres)</h2>
                        </div>
                    </div>
                    <hr class="custom-hr">
                    <div class="stats-card-grid  ">

                        <div class="stats-card">
                            <div class="stats-details">
                                <div class="stats-icon">
                                    <svg fill="#ff3c5f" height="24px" width="24px" version="1.1" id="Layer_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        viewBox="0 0 511.999 511.999" xml:space="preserve">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <g>
                                                <g>
                                                    <path
                                                        d="M256.298,101.846c-92.85,0-206.983,143.686-206.983,260.579c0,44.352,15.783,79.881,46.928,105.612 c35.323,29.174,89.169,43.962,160.054,43.962c70.625,0,124.319-14.906,159.567-44.319c31.069-25.916,46.82-61.673,46.82-106.262 C462.685,244.98,348.887,101.846,256.298,101.846z M264.276,302.614c23.697,12.525,53.196,28.124,53.196,59.042 c0,27.843-18.793,51.339-44.341,58.603v7.908c0,9.18-7.448,16.628-16.628,16.628c-9.18,0-16.628-7.448-16.628-16.628v-7.908 c-25.548-7.264-44.341-30.76-44.341-58.603c0-9.18,7.448-16.628,16.628-16.628c9.18,0,16.628,7.448,16.628,16.628 c0,15.285,12.428,27.713,27.713,27.713s27.713-12.428,27.713-27.713c0-10.89-18.036-20.417-35.486-29.64 c-23.697-12.525-53.196-28.124-53.196-59.042c0-27.843,18.793-51.339,44.341-58.603v-7.908c0-9.18,7.448-16.628,16.628-16.628 c9.18,0,16.628,7.448,16.628,16.628v7.908c25.548,7.264,44.341,30.76,44.341,58.603c0,9.18-7.448,16.628-16.628,16.628 c-9.18,0-16.628-7.448-16.628-16.628c0-15.285-12.428-27.713-27.713-27.713s-27.713,12.428-27.713,27.713 C228.791,283.864,246.825,293.391,264.276,302.614z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M347.037,20.547c-7.686-3.941-17.126-1.354-21.705,5.976c-6.95,11.14-16.639,13.932-23.545,14.311 c-12.016,0.855-24.087-5.25-32.454-15.816C256.752,9.115,236.844,0,214.728,0c-22.116,0-42.024,9.115-54.604,25.017 c-3.746,4.72-4.634,11.085-2.338,16.66c1.859,4.508,10.991,25.543,26.151,46.511c23.911-12.465,48.487-19.6,72.36-19.6 c23.868,0,48.444,7.139,72.347,19.615c15.169-20.974,24.306-42.019,26.166-46.528C358.1,33.678,354.722,24.498,347.037,20.547z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="stat-text">
                                    <div class="stats-label">Today's Income
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $massageCentres['today'] }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="stats-card">
                            <div class="stats-details">

                                <div class="stats-icon">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path> </g></svg>
                                </div>
                                <div class="stats-text">
                                    <div class="stats-label font-weight-bold">Week to Date
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $massageCentres['week'] }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="stats-card">
                            <div class="stats-details">
                                <div class="stats-icon">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path> </g></svg>
                                </div>
                                <div class="stats-text">
                                    <div class="stats-label font-weight-bold">Month to Date
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $massageCentres['month'] }}</div>
                                </div>
                            </div>

                        </div>

                        <div class="stats-card">
                            <div class="stats-details">

                                <div class="stats-icon">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path> </g></svg>
                                </div>
                                <div class="stats-text">
                                    <div class="stats-label font-weight-bold">Year to Date
                                    </div>
                                    <div class="stats-value"><span>$</span> {{ $massageCentres['year'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end --}}


        </div>
    @endsection
    @section('script')
    @endsection