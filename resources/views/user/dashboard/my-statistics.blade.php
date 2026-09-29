@extends('layouts.userDashboard')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <style type="text/css">
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0)
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">

        <!-- Page Heading -->

        <div class="row">
            <div class="col-md-12 custom-heading-wrapper justify-content-between">
                <div class="d-flex align-items-center">
                    <h1 class="h1">My Statistics</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                        aria-expanded="true"><b>Help?</b></span>
                </div>

                <div class="back-to-dashboard">
                    <a href="{{ url()->previous() ?? route('user-dashboard') }}">
                        <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b></h3>

                        <ol>
                            <li>Your statistics reflect the activity generated on the Website for each of the categories set
                                out on this page.</li>
                            <li>Some of the statistics can be viewed in more detail in other parts of the Website.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-4">
                <div class="common-grid">
                    <div class="common-card">
                        <div class="card-top">
                            <div class="card-icon">
                                <svg fill="#ff3c5f" height="64px" width="64px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 215.639 215.639" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M118.713,101.426h86.426c4.142,0,7.5-3.357,7.5-7.5C212.639,42.135,170.504,0,118.713,0c-4.142,0-7.5,3.357-7.5,7.5v86.426 C111.213,98.068,114.571,101.426,118.713,101.426z M126.213,15.354c37.547,3.555,67.517,33.524,71.072,71.072h-71.072V15.354z"></path> <path d="M101.427,118.606V35.287c0-4.143-3.358-7.5-7.5-7.5C42.135,27.787,0,69.922,0,121.713 c0,51.791,42.135,93.926,93.927,93.926c25.087,0,48.673-9.771,66.415-27.511c1.478-1.477,2.265-3.511,2.185-5.599 c-0.074-1.904-0.874-3.707-2.219-5.04L101.427,118.606z M93.927,200.639c-43.52,0-78.927-35.406-78.927-78.926 c0-40.991,31.41-74.784,71.427-78.572v78.572c0,1.989,0.79,3.896,2.197,5.304l55.561,55.562 C130.07,194.274,112.486,200.639,93.927,200.639z"></path> <path d="M208.139,109.256h-86.426c-3.034,0-5.768,1.827-6.929,4.63c-1.161,2.803-0.519,6.028,1.626,8.174l61.1,61.1 c0.07,0.069,0.142,0.139,0.214,0.206l0.013,0.012c1.439,1.329,3.265,1.99,5.088,1.99c1.923,0,3.843-0.735,5.304-2.196 c17.74-17.739,27.51-41.326,27.51-66.415C215.639,112.613,212.281,109.256,208.139,109.256z M182.578,167.015l-42.758-42.759h60.47 C198.812,140.028,192.686,154.818,182.578,167.015z"></path> </g> </g></svg>
                            </div>

                            <div class="card-heading">
                                <h2>My Statistics</h2>
                            </div>
                        </div>
                        <hr class="custom-hr">
                        <div class="common-stars">
                            <div class="stats-detail">
                                <div class="stats-label">My Legbox
                                </div>
                                <div class="stats-value">25</div>
                            </div>

                            <div class="stats-detail">
                                <div class="stats-label">Notes
                                </div>
                                <div class="stats-value">125</div>
                            </div>

                            <div class="stats-detail">
                                <div class="stats-label">Reviews Posted
                                </div>
                                <div class="stats-value">32</div>
                            </div>

                            <div class="stats-detail">
                                <div class="stats-label">E4U Reports
                                </div>
                                <div class="stats-value">125</div>
                            </div>
                            <div class="stats-detail">
                                <div class="stats-label">Punterbox Reports
                                </div>
                                <div class="stats-value">125</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('script')
    <!-- file upload plugin start here -->
    <!-- file upload plugin end here -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
@endpush
