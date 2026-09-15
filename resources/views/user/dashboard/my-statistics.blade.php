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
        <div class="col-lg-12 common-card mb-3">
            <div class="card-top">
                <div class="card-icon">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <defs>
                                <style>
                                    .a,
                                    .b {
                                        fill: none;
                                        stroke: #ff3c5f;
                                        stroke-linecap: round;
                                        stroke-linejoin: round;
                                        stroke-width: 1.9440000000000002;
                                    }

                                    .a {
                                        fill-rule: evenodd;
                                    }
                                </style>
                            </defs>
                            <path class="a" d="M2,2V20a2,2,0,0,0,2,2H22"></path>
                            <rect class="b" height="6" rx="1.5" width="3" x="6" y="12"></rect>
                            <rect class="b" height="6" rx="1.5" width="3" x="12" y="7"></rect>
                            <rect class="b" height="6" rx="1.5" width="3" x="18" y="3"></rect>
                        </g>
                    </svg>
                </div>
                <div class="card-heading">
                    <h2>My Statistics</h2>
                </div>
            </div>
            <hr class="custom-hr">
            <div class="stats-card-grid  ">

                <div class="stats-card">
                    <div class="stats-details">
                        <div class="stats-icon">
                            <svg fill="#ff3c5f" height="24px" width="24px" version="1.1" id="Layer_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="-51.2 -51.2 614.40 614.40" xml:space="preserve">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <g>
                                            <path
                                                d="M384,112.242c-27.827-27.828-81.296-42.573-128,4.131c-46.363-46.363-99.218-32.912-128-4.13L0,240.243L136.258,376.5 c66.36,66.36,173.901,65.583,239.484,0L512,240.242L384,112.242z M152.774,137.017c19.831-19.831,53.402-20.92,74.322,0 l28.903,28.905l28.904-28.905c22.429-22.429,55.512-18.811,74.322,0l88.95,88.95c-30.799-1.927-50.959-5.958-71.953-10.157 c-29.545-5.909-60.094-12.02-120.222-12.02c-60.129,0-90.678,6.11-120.222,12.02c-20.996,4.198-41.154,8.23-71.952,10.157 L152.774,137.017z M369.963,250.287c-31.556,12.772-58.944,23.574-113.964,23.574c-55.019,0-84.889-11.679-113.963-23.574 c32.943-6.279,57.305-11.461,113.964-11.461C312.66,238.825,344.174,244.958,369.963,250.287z M350.995,351.699l-0.175,0.175 c-52.199,52.199-137.246,52.393-189.787-0.148l-85.217-85.216c22.854,4.173,39.586,10.855,56.891,17.777 c30.248,12.099,61.525,24.61,123.293,24.61s93.045-12.511,123.293-24.61c17.304-6.922,34.037-13.604,56.891-17.777 L350.995,351.699z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="stat-text">
                            <div class="stats-label">My Legbox
                            </div>
                            <div class="stats-value">25</div>
                        </div>
                    </div>
                </div>

                <div class="stats-card">
                    <div class="stats-details">

                        <div class="stats-icon">
                            <div class="stats-icon">
                                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M11.7769 10L16.6065 11.2941" stroke="#ff3c5f" stroke-width="1.5" stroke-linecap="round"></path> <path d="M11 12.8975L13.8978 13.6739" stroke="#ff3c5f" stroke-width="1.5" stroke-linecap="round"></path> <path d="M20.3116 12.6473C19.7074 14.9024 19.4052 16.0299 18.7203 16.7612C18.1795 17.3386 17.4796 17.7427 16.7092 17.9223C16.6129 17.9448 16.5152 17.9621 16.415 17.9744C15.4999 18.0873 14.3834 17.7881 12.3508 17.2435C10.0957 16.6392 8.96815 16.3371 8.23687 15.6522C7.65945 15.1114 7.25537 14.4115 7.07573 13.641C6.84821 12.6652 7.15033 11.5377 7.75458 9.28263L8.27222 7.35077C8.35912 7.02646 8.43977 6.72546 8.51621 6.44561C8.97128 4.77957 9.27709 3.86298 9.86351 3.23687C10.4043 2.65945 11.1042 2.25537 11.8747 2.07573C12.8504 1.84821 13.978 2.15033 16.2331 2.75458C18.4881 3.35883 19.6157 3.66095 20.347 4.34587C20.9244 4.88668 21.3285 5.58657 21.5081 6.35703C21.669 7.04708 21.565 7.81304 21.2766 9" stroke="#ff3c5f" stroke-width="1.5" stroke-linecap="round"></path> <path d="M3.27222 16.647C3.87647 18.9021 4.17859 20.0296 4.86351 20.7609C5.40432 21.3383 6.10421 21.7424 6.87466 21.922C7.85044 22.1495 8.97798 21.8474 11.2331 21.2432C13.4881 20.6389 14.6157 20.3368 15.347 19.6519C15.8399 19.1902 16.2065 18.6126 16.415 17.9741M8.51621 6.44531C8.16368 6.53646 7.77741 6.63996 7.35077 6.75428C5.09569 7.35853 3.96815 7.66065 3.23687 8.34557C2.65945 8.88638 2.25537 9.58627 2.07573 10.3567C1.91482 11.0468 2.01883 11.8129 2.30728 13" stroke="#ff3c5f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            </div>
                        </div>
                        <div class="stats-text">
                            <div class="stats-label font-weight-bold">Notes
                            </div>
                            <div class="stats-value">125</div>
                        </div>
                    </div>
                </div>

                <div class="stats-card">
                    <div class="stats-details">
                        <div class="stats-icon">
                            <div class="stats-icon">
                               <svg fill="#ff3c5f" width="24px" height="24px" viewBox="0 0 96.00 96.00" xmlns="http://www.w3.org/2000/svg" stroke="#ff3c5f" stroke-width="2.496"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title></title> <g data-name="Customer Review" id="Customer_Review"> <path d="M69.54,20H26.46A10.47,10.47,0,0,0,16,30.46V54.54A10.47,10.47,0,0,0,26.46,65h11.8l9.35,11.81a.5.5,0,0,0,.78,0L57.74,65h11.8A10.47,10.47,0,0,0,80,54.54V30.46A10.47,10.47,0,0,0,69.54,20ZM79,54.54A9.48,9.48,0,0,1,69.54,64h-12a.49.49,0,0,0-.39.19L48,75.69l-9.11-11.5A.49.49,0,0,0,38.5,64h-12A9.48,9.48,0,0,1,17,54.54V30.46A9.48,9.48,0,0,1,26.46,21H69.54A9.48,9.48,0,0,1,79,30.46Z"></path> <polygon points="27.52 41.04 26.07 38.11 24.63 41.04 21.4 41.51 23.74 43.78 23.18 47 26.07 45.48 28.96 47 28.41 43.78 30.75 41.51 27.52 41.04"></polygon> <polygon points="38.36 41.04 36.92 38.11 35.48 41.04 32.25 41.51 34.58 43.78 34.03 47 36.92 45.48 39.81 47 39.26 43.78 41.59 41.51 38.36 41.04"></polygon> <polygon points="49.21 41.04 47.77 38.11 46.32 41.04 43.09 41.51 45.43 43.78 44.88 47 47.77 45.48 50.66 47 50.1 43.78 52.44 41.51 49.21 41.04"></polygon> <path d="M60.06,41l-1.45-2.93L57.17,41l-3.23.47,2.34,2.27L55.73,47l2.88-1.52L61.5,47,61,43.78l2.34-2.27Zm.19,2-.37.36L60,44l.2,1.22-1.09-.57-.47-.25-.46.25-1.09.57.2-1.22.09-.52L57,43.07l-.89-.87L57.31,42l.52-.08.24-.47.54-1.11.55,1.11.23.47.53.08,1.22.17Z"></path> <path d="M70.91,41l-1.45-2.93L68,41l-3.23.47,2.34,2.27L66.57,47l2.89-1.52L72.35,47l-.55-3.22,2.34-2.27Zm.19,2-.38.36.09.52L71,45.17l-1.09-.57-.47-.25L69,44.6l-1.1.57L68.11,44l.09-.52-.38-.36-.88-.87L68.16,42l.52-.08.24-.47.54-1.11L70,41.48l.23.47.52.08L72,42.2Z"></path> </g> </g></svg>
                            </div>
                        </div>
                        <div class="stats-text">
                            <div class="stats-label font-weight-bold">Reviews Posted
                            </div>
                            <div class="stats-value">32</div>
                        </div>
                    </div>

                </div>

                <div class="stats-card">
                    <div class="stats-details">

                        <div class="stats-icon">
                            <div class="stats-icon">
                                <svg fill="#ff3c5f" width="24px" height="24px" viewBox="0 0 32 32" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="Layer1"> <path d="M27,3c-0,-0.552 -0.448,-1 -1,-1l-20,0c-0.552,0 -1,0.448 -1,1l-0,26c0,0.552 0.448,1 1,1l20,0c0.552,0 1,-0.448 1,-1l-0,-26Zm-2,1l-0,24c-0,0 -18,0 -18,0c-0,-0 -0,-24 -0,-24l18,0Zm-9,10c-3.311,0 -6,2.689 -6,6c-0,3.311 2.689,6 6,6c3.311,0 6,-2.689 6,-6c-0,-3.311 -2.689,-6 -6,-6Zm-1,2.126c-1.724,0.445 -3,2.012 -3,3.874c-0,2.208 1.792,4 4,4c1.862,0 3.429,-1.276 3.874,-3l-3.874,0c-0.552,0 -1,-0.448 -1,-1l0,-3.874Zm-2,-4.126l6,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-6,0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Zm-2,-4l10,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-10,0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Z"></path> </g> </g></svg>
                            </div>
                        </div>
                        <div class="stats-text">
                            <div class="stats-label font-weight-bold">E4U Reports
                            </div>
                            <div class="stats-value">125</div>
                        </div>
                    </div>
                </div>

                <div class="stats-card">
                    <div class="stats-details">

                        <div class="stats-icon">
                            <div class="stats-icon">
                                <svg fill="#ff3c5f" width="24px" height="24px" viewBox="0 0 32 32" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="Layer1"> <path d="M27,3c-0,-0.552 -0.448,-1 -1,-1l-20,0c-0.552,0 -1,0.448 -1,1l-0,26c0,0.552 0.448,1 1,1l20,0c0.552,0 1,-0.448 1,-1l-0,-26Zm-2,1l-0,24c-0,0 -18,0 -18,0c-0,-0 -0,-24 -0,-24l18,0Zm-9,10c-3.311,0 -6,2.689 -6,6c-0,3.311 2.689,6 6,6c3.311,0 6,-2.689 6,-6c-0,-3.311 -2.689,-6 -6,-6Zm-1,2.126c-1.724,0.445 -3,2.012 -3,3.874c-0,2.208 1.792,4 4,4c1.862,0 3.429,-1.276 3.874,-3l-3.874,0c-0.552,0 -1,-0.448 -1,-1l0,-3.874Zm-2,-4.126l6,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-6,0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Zm-2,-4l10,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-10,0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Z"></path> </g> </g></svg>
                            </div>
                        </div>
                        <div class="stats-text">
                            <div class="stats-label font-weight-bold">Punterbox Reports
                            </div>
                            <div class="stats-value">125</div>
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
