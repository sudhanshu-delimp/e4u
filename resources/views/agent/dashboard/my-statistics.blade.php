@extends('layouts.agent')
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->
        <div class="row">
            <!-- Page Heading -->
            <div class="d-flex align-items-center justify-content-between col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">My Statistics</h1>
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
                            <li>You can view all of your statistics here.</li>
                            <li>For an expanded summary on any of your statistics, go to Analytics in the side bar menu.
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="common-grid">
                    <div class="common-card">
                        <div class="card-top">
                            <div class="card-icon">
                                <svg fill="#ff3c5f" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                    viewBox="0 0 256 178" enable-background="new 0 0 256 178" xml:space="preserve">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M183.882,38.248c0,8.995,7.292,16.287,16.287,16.287c8.995,0,16.287-7.292,16.287-16.287s-7.292-16.287-16.287-16.287 C191.174,21.961,183.882,29.253,183.882,38.248z M167.193,92.774v-12.72c0-11.179,9.126-20.349,20.349-20.349h26.642 c11.179,0,20.349,9.126,20.349,20.349v12.72H167.193z M95.721,2.416v23.543c-2.871,0-8.236,0.615-12.1,1.784 c-10.322,3.123-19.031,10.11-24.369,21.786L2,175.584h78.75l5.069-16.893c22.193-5.386,38.809-22.446,45.51-43.894l0.084,0.001 c0.167-0.748,0.389-1.483,0.627-2.214H254V2.416H95.721z M246.125,104.709H115.408c-2.957,15.124-14.146,28.884-29.224,35.043 c-0.487,0.199-0.992,0.293-1.488,0.293c-1.552,0-3.023-0.924-3.647-2.449c-0.822-2.013,0.143-4.311,2.156-5.134 c14.768-6.032,25.085-20.66,25.105-35.583v-3.981h40.386c5.966-0.001,10.803-4.837,10.803-10.803c0-5.962-4.83-10.797-10.793-10.802 l-70.91-0.053c-2.174,0-3.938-1.763-3.938-3.938s1.763-3.938,3.938-3.938h25.799V10.291h142.529V104.709z M115.408,25.959H159.5 v7.875h-44.092V25.959z M115.408,45.647H159.5v7.875h-44.092V45.647z">
                                        </path>
                                    </g>
                                </svg>
                            </div>

                            <div class="card-heading">
                                <h2>Escort Memberships</h2>
                            </div>
                        </div>
                         <hr class="custom-hr">
                        <div class="common-stars">
                            <div class="stats-detail">
                                <div class="stats-label">New today
                                </div>
                                <div class="stats-value">{{$escort_membership_today}}</div>
                            </div>

                            <div class="stats-detail">
                                <div class="stats-label">New this week
                                </div>
                                <div class="stats-value">{{$escort_membership_week}}</div>
                            </div>

                            <div class="stats-detail">
                                <div class="stats-label">New this month
                                </div>
                                <div class="stats-value">{{$escort_membership_month}}</div>
                            </div>

                            <div class="stats-detail">
                                <div class="stats-label">New this year
                                </div>
                                <div class="stats-value">{{$escort_membership_years_total}}</div>
                            </div>
                        </div>

                        <div class="card-note">
                            <div class="stats-detail">
                                <div class="stats-label"> Ongoing Total
                                </div>
                                <div class="stats-value">{{$escort_membership_ongoing_total}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="common-card">
                        <div class="card-top">
                            <div class="card-icon">
                                <svg fill="#ff3c5f" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                    viewBox="0 0 256 178" enable-background="new 0 0 256 178" xml:space="preserve">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M183.882,38.248c0,8.995,7.292,16.287,16.287,16.287c8.995,0,16.287-7.292,16.287-16.287s-7.292-16.287-16.287-16.287 C191.174,21.961,183.882,29.253,183.882,38.248z M167.193,92.774v-12.72c0-11.179,9.126-20.349,20.349-20.349h26.642 c11.179,0,20.349,9.126,20.349,20.349v12.72H167.193z M95.721,2.416v23.543c-2.871,0-8.236,0.615-12.1,1.784 c-10.322,3.123-19.031,10.11-24.369,21.786L2,175.584h78.75l5.069-16.893c22.193-5.386,38.809-22.446,45.51-43.894l0.084,0.001 c0.167-0.748,0.389-1.483,0.627-2.214H254V2.416H95.721z M246.125,104.709H115.408c-2.957,15.124-14.146,28.884-29.224,35.043 c-0.487,0.199-0.992,0.293-1.488,0.293c-1.552,0-3.023-0.924-3.647-2.449c-0.822-2.013,0.143-4.311,2.156-5.134 c14.768-6.032,25.085-20.66,25.105-35.583v-3.981h40.386c5.966-0.001,10.803-4.837,10.803-10.803c0-5.962-4.83-10.797-10.793-10.802 l-70.91-0.053c-2.174,0-3.938-1.763-3.938-3.938s1.763-3.938,3.938-3.938h25.799V10.291h142.529V104.709z M115.408,25.959H159.5 v7.875h-44.092V25.959z M115.408,45.647H159.5v7.875h-44.092V45.647z">
                                        </path>
                                    </g>
                                </svg>
                            </div>

                            <div class="card-heading">
                                <h2>Centre Memberships</h2>
                            </div>
                        </div>
                         <hr class="custom-hr">
                        <div class="common-stars">
                            <div class="stats-detail">
                                <div class="stats-label">New today
                                </div>
                                <div class="stats-value">{{$massage_membership_today}}</div>
                            </div>

                            <div class="stats-detail">
                                <div class="stats-label">New this week
                                </div>
                                <div class="stats-value">{{$massage_membership_week}}</div>
                            </div>

                            <div class="stats-detail">
                                <div class="stats-label">New this month
                                </div>
                                <div class="stats-value">{{$massage_membership_month}}</div>
                            </div>

                            <div class="stats-detail">
                                <div class="stats-label">New this year
                                </div>
                                <div class="stats-value">{{$massage_membership_years_total}}</div>
                            </div>
                        </div>

                        <div class="card-note">
                            <div class="stats-detail">
                                <div class="stats-label"> Ongoing Total
                                </div>
                                <div class="stats-value">{{$massage_membership_ongoing_total}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="common-card">
                        <div class="card-top">
                            <div class="card-icon">
                                <svg fill="#ff3c5f" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                    viewBox="0 0 256 178" enable-background="new 0 0 256 178" xml:space="preserve">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M183.882,38.248c0,8.995,7.292,16.287,16.287,16.287c8.995,0,16.287-7.292,16.287-16.287s-7.292-16.287-16.287-16.287 C191.174,21.961,183.882,29.253,183.882,38.248z M167.193,92.774v-12.72c0-11.179,9.126-20.349,20.349-20.349h26.642 c11.179,0,20.349,9.126,20.349,20.349v12.72H167.193z M95.721,2.416v23.543c-2.871,0-8.236,0.615-12.1,1.784 c-10.322,3.123-19.031,10.11-24.369,21.786L2,175.584h78.75l5.069-16.893c22.193-5.386,38.809-22.446,45.51-43.894l0.084,0.001 c0.167-0.748,0.389-1.483,0.627-2.214H254V2.416H95.721z M246.125,104.709H115.408c-2.957,15.124-14.146,28.884-29.224,35.043 c-0.487,0.199-0.992,0.293-1.488,0.293c-1.552,0-3.023-0.924-3.647-2.449c-0.822-2.013,0.143-4.311,2.156-5.134 c14.768-6.032,25.085-20.66,25.105-35.583v-3.981h40.386c5.966-0.001,10.803-4.837,10.803-10.803c0-5.962-4.83-10.797-10.793-10.802 l-70.91-0.053c-2.174,0-3.938-1.763-3.938-3.938s1.763-3.938,3.938-3.938h25.799V10.291h142.529V104.709z M115.408,25.959H159.5 v7.875h-44.092V25.959z M115.408,45.647H159.5v7.875h-44.092V45.647z">
                                        </path>
                                    </g>
                                </svg>
                            </div>

                            <div class="card-heading">
                                <h2>Advertiser Memberships</h2>
                            </div>
                        </div>
                         <hr class="custom-hr">
                        <div class="common-stars">
                            <div class="stats-detail">
                                <div class="stats-label">New today
                                </div>
                                <div class="stats-value">{{$advertiser_membership_today}}</div>
                            </div>

                            <div class="stats-detail">
                                <div class="stats-label">New this week
                                </div>
                                <div class="stats-value">{{$advertiser_membership_week}}</div>
                            </div>

                            <div class="stats-detail">
                                <div class="stats-label">New this month
                                </div>
                                <div class="stats-value">{{$advertiser_membership_month}}</div>
                            </div>

                            <div class="stats-detail">
                                <div class="stats-label">New this year
                                </div>
                                <div class="stats-value">{{$advertiser_membership_years_total}}</div>
                            </div>
                        </div>

                        <div class="card-note">
                            <div class="stats-detail">
                                <div class="stats-label"> Ongoing Total
                                </div>
                                <div class="stats-value">{{$advertiser_ongoing_total}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="common-card">
                        <div class="card-top">
                            <div class="card-icon">
                                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">

                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                    </g>

                                    <g id="SVGRepo_iconCarrier">

                                        <path
                                            d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                            stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                        </path>

                                        <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                                            stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                        </path>

                                    </g>

                                </svg>
                            </div>

                            <div class="card-heading">
                                <h2>Escort Profiles</h2>
                            </div>
                        </div>
                         <hr class="custom-hr">
                        <div class="common-stars">
                            <div class="stats-detail">
                                <div class="stats-label">New today
                                </div>
                                <div class="stats-value">{{$escort_profile_today}}</div>
                            </div>

                            <div class="stats-detail">
                                <div class="stats-label">New this week
                                </div>
                                <div class="stats-value">{{$escort_profile_week}}</div>
                            </div>

                            <div class="stats-detail">
                                <div class="stats-label">New this month
                                </div>
                                <div class="stats-value">{{$escort_profile_month}}</div>
                            </div>
                            

                            <div class="stats-detail">
                                <div class="stats-label">New this year
                                </div>
                                <div class="stats-value">{{$escort_profile_year_total}}</div>
                            </div>
                        </div>

                        <div class="card-note">
                            <div class="stats-detail">
                                <div class="stats-label"> Ongoing Total
                                </div>
                                <div class="stats-value">{{$escort_profile_ongoing_total}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="common-card">
                        <div class="card-top">
                            <div class="card-icon">
                                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">

                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                    </g>

                                    <g id="SVGRepo_iconCarrier">

                                        <path
                                            d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                            stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                        </path>

                                        <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                                            stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                        </path>

                                    </g>

                                </svg>
                            </div>

                            <div class="card-heading">
                                <h2>Centre Profiles</h2>
                            </div>
                        </div>
                         <hr class="custom-hr">
                        <div class="common-stars">
                            <div class="stats-detail">
                                <div class="stats-label">New today
                                </div>
                                <div class="stats-value">{{$massage_profile_today}}</div>
                            </div>

                            <div class="stats-detail">
                                <div class="stats-label">New this week
                                </div>
                                <div class="stats-value">{{$massage_profile_week}}</div>
                            </div>

                            <div class="stats-detail">
                                <div class="stats-label">New this month
                                </div>
                                <div class="stats-value">{{$massage_profile_month}}</div>
                            </div>
                            

                            <div class="stats-detail">
                                <div class="stats-label">New this year
                                </div>
                                <div class="stats-value">{{$massage_profile_year_total}}</div>
                            </div>
                        </div>

                        <div class="card-note">
                            <div class="stats-detail">
                                <div class="stats-label"> Ongoing Total
                                </div>
                                <div class="stats-value">{{$massage_profile_year_total}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="common-card">
                        <div class="card-top">
                            <div class="card-icon">
                                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">

                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                    </g>

                                    <g id="SVGRepo_iconCarrier">

                                        <path
                                            d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                            stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                        </path>

                                        <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                                            stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                        </path>

                                    </g>

                                </svg>
                            </div>

                            <div class="card-heading">
                                <h2>Adevertiser Profiles</h2>
                            </div>
                        </div>
                         <hr class="custom-hr">
                        <div class="common-stars">
                            <div class="stats-detail">
                                <div class="stats-label">New today
                                </div>
                                <div class="stats-value">{{$advertiser_profile_today}}</div>
                            </div>

                            <div class="stats-detail">
                                <div class="stats-label">New this week
                                </div>
                                <div class="stats-value">{{$advertiser_profile_week}}</div>
                            </div>

                            <div class="stats-detail">
                                <div class="stats-label">New this month
                                </div>
                                <div class="stats-value">{{$advertiser_profile_month}}</div>
                            </div>
                            

                            <div class="stats-detail">
                                <div class="stats-label">New this year
                                </div>
                                <div class="stats-value">{{$advertiser_profile_year_total}}</div>
                            </div>
                        </div>

                        <div class="card-note">
                            <div class="stats-detail">
                                <div class="stats-label"> Ongoing Total
                                </div>
                                <div class="stats-value">{{$advertiser_profile_ongoing_total}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
