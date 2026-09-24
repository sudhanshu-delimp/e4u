@extends('layouts.center')
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <div class="custom-heading-wrapper">
                        <h1 class="h1">Our Statistics</h1>
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
                                <x-icon name="statistics" />                                
                            </div>
                            <div class="card-heading">
                                <h2>My Statistics</h2>
                            </div>
                        </div>
                        <hr class="custom-hr">
                        <div class="commom-stars">
                            <div class="stats-detail">
                                <div class="stats-label">Profile Views Today
                                </div>
                                <div class="stats-value">0</div>
                            </div>
                            <div class="stats-detail">
                                <div class="stats-label">Media Views Today
                                </div>
                                <div class="stats-value">0</div>
                            </div>
                            <div class="stats-detail">
                                <div class="stats-label">Recommendations This Week

                                </div>
                                <div class="stats-value">0</div>
                            </div>
                            <div class="stats-detail">
                                <div class="stats-label">Reviews Posted This Week
                                </div>
                                <div class="stats-value">0</div>
                            </div>
                        </div>
                    </div>

                    <div class="common-card">
                        <div class="card-top">
                            <div class="card-icon">
                                <svg width="24px" height="24px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                    fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill="#ff3c5f"
                                            d="M8,0 C12.4183,0 16,3.58173 16,8 C16,12.4183 12.4183,16 8,16 C3.58167,16 0,12.4183 0,8 C0,3.58173 3.58167,0 8,0 Z M8,2 C4.68628,2 2,4.68628 2,8 C2,11.3137 4.68628,14 8,14 C11.3137,14 14,11.3137 14,8 C14,4.68628 11.3137,2 8,2 Z M8,7 C8.51280357,7 8.93550255,7.38604429 8.99327177,7.88337975 L9,8 L9,11 C9,11.5523 8.55225,12 8,12 C7.48719643,12 7.06449745,11.613973 7.00672823,11.1166239 L7,11 L7,8 C7,7.44772 7.44775,7 8,7 Z M8,4 C8.55225,4 9,4.44772 9,5 C9,5.55228 8.55225,6 8,6 C7.44775,6 7,5.55228 7,5 C7,4.44772 7.44775,4 8,4 Z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <div class="card-heading">
                                <h2>Critical Information</h2>
                            </div>
                        </div>
                        <hr class="custom-hr">
                        <div class="commom-stars">
                            <div class="stats-detail">
                                <div class="stats-label">Profiles Currently Posted
                                </div>
                                <div class="stats-value">0</div>
                            </div>
                            <div class="stats-detail">
                                <div class="stats-label">Upcoming Profiles
                                </div>
                                <div class="stats-value">0</div>
                            </div>
                        </div>
                    </div>

                    <div class="common-card">
                        <div class="card-top">
                            <div class="card-icon">
                                <svg fill="#ff3c5f" height="64px" width="64px" version="1.1" id="Capa_1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 215.639 215.639" xml:space="preserve">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g>
                                            <path
                                                d="M118.713,101.426h86.426c4.142,0,7.5-3.357,7.5-7.5C212.639,42.135,170.504,0,118.713,0c-4.142,0-7.5,3.357-7.5,7.5v86.426 C111.213,98.068,114.571,101.426,118.713,101.426z M126.213,15.354c37.547,3.555,67.517,33.524,71.072,71.072h-71.072V15.354z">
                                            </path>
                                            <path
                                                d="M101.427,118.606V35.287c0-4.143-3.358-7.5-7.5-7.5C42.135,27.787,0,69.922,0,121.713 c0,51.791,42.135,93.926,93.927,93.926c25.087,0,48.673-9.771,66.415-27.511c1.478-1.477,2.265-3.511,2.185-5.599 c-0.074-1.904-0.874-3.707-2.219-5.04L101.427,118.606z M93.927,200.639c-43.52,0-78.927-35.406-78.927-78.926 c0-40.991,31.41-74.784,71.427-78.572v78.572c0,1.989,0.79,3.896,2.197,5.304l55.561,55.562 C130.07,194.274,112.486,200.639,93.927,200.639z">
                                            </path>
                                            <path
                                                d="M208.139,109.256h-86.426c-3.034,0-5.768,1.827-6.929,4.63c-1.161,2.803-0.519,6.028,1.626,8.174l61.1,61.1 c0.07,0.069,0.142,0.139,0.214,0.206l0.013,0.012c1.439,1.329,3.265,1.99,5.088,1.99c1.923,0,3.843-0.735,5.304-2.196 c17.74-17.739,27.51-41.326,27.51-66.415C215.639,112.613,212.281,109.256,208.139,109.256z M182.578,167.015l-42.758-42.759h60.47 C198.812,140.028,192.686,154.818,182.578,167.015z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="card-heading">
                                <h2>Profile Statistics</h2>
                            </div>
                        </div>
                        <hr class="custom-hr">
                        <div class="commom-stars">
                            <div class="stats-detail">
                                <div class="stats-label">Profile Views Today
                                </div>
                                <div class="stats-value">0</div>
                            </div>
                            <div class="stats-detail">
                                <div class="stats-label">Profile Views This Week
                                </div>
                                <div class="stats-value">0</div>
                            </div>
                            <div class="stats-detail">
                                <div class="stats-label">Year to Date

                                </div>
                                <div class="stats-value">0</div>
                            </div>

                        </div>
                    </div>

                    <div class="common-card">
                        <div class="card-top">
                            <div class="card-icon">
                                <svg fill="#ff3c5f" height="64px" width="64px" version="1.1" id="Capa_1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 215.639 215.639" xml:space="preserve">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g>
                                            <path
                                                d="M118.713,101.426h86.426c4.142,0,7.5-3.357,7.5-7.5C212.639,42.135,170.504,0,118.713,0c-4.142,0-7.5,3.357-7.5,7.5v86.426 C111.213,98.068,114.571,101.426,118.713,101.426z M126.213,15.354c37.547,3.555,67.517,33.524,71.072,71.072h-71.072V15.354z">
                                            </path>
                                            <path
                                                d="M101.427,118.606V35.287c0-4.143-3.358-7.5-7.5-7.5C42.135,27.787,0,69.922,0,121.713 c0,51.791,42.135,93.926,93.927,93.926c25.087,0,48.673-9.771,66.415-27.511c1.478-1.477,2.265-3.511,2.185-5.599 c-0.074-1.904-0.874-3.707-2.219-5.04L101.427,118.606z M93.927,200.639c-43.52,0-78.927-35.406-78.927-78.926 c0-40.991,31.41-74.784,71.427-78.572v78.572c0,1.989,0.79,3.896,2.197,5.304l55.561,55.562 C130.07,194.274,112.486,200.639,93.927,200.639z">
                                            </path>
                                            <path
                                                d="M208.139,109.256h-86.426c-3.034,0-5.768,1.827-6.929,4.63c-1.161,2.803-0.519,6.028,1.626,8.174l61.1,61.1 c0.07,0.069,0.142,0.139,0.214,0.206l0.013,0.012c1.439,1.329,3.265,1.99,5.088,1.99c1.923,0,3.843-0.735,5.304-2.196 c17.74-17.739,27.51-41.326,27.51-66.415C215.639,112.613,212.281,109.256,208.139,109.256z M182.578,167.015l-42.758-42.759h60.47 C198.812,140.028,192.686,154.818,182.578,167.015z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="card-heading">
                                <h2>Media Statistics</h2>
                            </div>
                        </div>
                        <hr class="custom-hr">
                        <div class="commom-stars">
                            <div class="stats-detail">
                                <div class="stats-label">Media Views Today
                                </div>
                                <div class="stats-value">0</div>
                            </div>
                            <div class="stats-detail">
                                <div class="stats-label">Media Views This Weeks
                                </div>
                                <div class="stats-value">0</div>
                            </div>
                            <div class="stats-detail">
                                <div class="stats-label">Year to Date
                                </div>
                                <div class="stats-value">0</div>
                            </div>
                        </div>
                    </div>

                    <div class="common-card">
                        <div class="card-top">
                            <div class="card-icon">
                                <svg width="24px" height="24px" fill="#ff3c5f" version="1.1" baseProfile="tiny"
                                    id="Layer_1" xmlns:x="&amp;ns_extend;" xmlns:i="&amp;ns_ai;"
                                    xmlns:graph="&amp;ns_graphs;" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" width="64px"
                                    height="64px" viewBox="0 0 42 42" xml:space="preserve">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M6.5,25.5v4c0.016,2.812,1.344,2.375,2.328,1.531L14.5,25.91v2.59c0,2.43,0.56,3,3,3h9c0,0,5.209,6.125,5.25,6.084 c0.75,0.916,2.781,0.604,2.75-1.084v-5h3c2.45,0,3-0.609,3-3v-15c0-2.4-0.59-3-3-3h-10v-2c0-2.47-0.46-3-3-3h-21c-2.36,0-3,0.51-3,3 v13c0,2.439,0.55,4,3,4H6.5z M31.5,28.5v4.721l-4-4.721h-9c-0.75,0-1-0.27-1-1v-13c0-0.67,0.31-1,1-1h18c0.689,0,1,0.37,1,0.94V27.5 c0,0.721-0.359,1-1,1H31.5z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <div class="card-heading">
                                <h2>Feedback</h2>
                            </div>
                        </div>
                        <hr class="custom-hr">
                        <div class="commom-stars">
                            <div class="stats-detail">
                                <div class="stats-label">Reviews Today
                                </div>
                                <div class="stats-value">0</div>
                            </div>
                            <div class="stats-detail">
                                <div class="stats-label">Reviews This Week
                                </div>
                                <div class="stats-value">0</div>
                            </div>
                            <div class="stats-detail">
                                <div class="stats-label">Year to Date

                                </div>
                                <div class="stats-value">0</div>
                            </div>
                            <hr class="custom-hr">
                            <div class="stats-detail">
                                <div class="stats-label">Recommendations Today
                                </div>
                                <div class="stats-value">0</div>
                            </div>
                            <div class="stats-detail">
                                <div class="stats-label">Recommendations This Week

                                </div>
                                <div class="stats-value">0</div>
                            </div>
                            <div class="stats-detail">
                                <div class="stats-label">Year to Date
                                </div>
                                <div class="stats-value">0</div>
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
