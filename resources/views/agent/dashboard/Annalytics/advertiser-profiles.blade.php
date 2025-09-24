@extends('layouts.agent')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">

    <style type="text/css">
        .select2-container .select2-choice,
        .select2-result-label {
            font-size: 1.5em;
            height: 52px !important;
            overflow: auto;
        }

        .select2-arrow,
        .select2-chosen {
            padding-top: 6px;
        }

        span.select2.select2-container.select2-container--default>span.selection>span {
            height: 52px !important;
        }

        .profile_summary table td,
        th {
            border: none;
        }
    </style>
@endsection
@section('content')
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                    <!--middle content-->
                    {{-- Page Heading   --}}
                    <div class="row">
                        <div class="custom-heading-wrapper col-lg-12">
                            <h1 class="h1">Profile Summary</h1>
                            <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes"
                                aria-expanded="true">Help?</span>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="card collapse" id="notes" style="">
                                <div class="card-body">
                                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                                    <ol>
                                        <li>This report provides information associated with all of your Profiles (excluding
                                            Tours).</li>
                                        <li>It is a summary of the Listed Profiles and revenue (Commission) you have derived
                                            from
                                            the profiles, Escort and Massage Centres.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end --}}
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="d-flex justify-content-end my-3">
                                <button class="btn-common mr-0" type="button" data-target="#printReport"
                                    data-toggle="modal">Print Report</button>
                            </div>
                            <div class="table-responsive-xl">
                                <table class="table" id="advProfileSummaryTable">
                                    <thead class="table-bg">
                                        <tr>
                                            <th scope="col">Member ID
                                            </th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">End Date</th>
                                            <th scope="col">Total Days</th>
                                            <th scope="col">Pin Up</th>
                                            <th scope="col">Fee</th>
                                            <th scope="col">Commissions</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-content">
                                        <tr>
                                            <td>E60165</td>
                                            <td>Jane</td>
                                            <td>0438 028 728</td>
                                            <td>01-01-2025</td>
                                            <td>15-04-2025</td>
                                            <td>104</td>
                                            <td>Yes</td>
                                            <td> <span class="pr-3">$</span> 1,443.00</td>
                                            <td> <span class="pr-3">$</span> 72.15</td>
                                            <td class="text-center">
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button"
                                                        id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i
                                                            class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                    </a>
                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink" style="">

                                                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                            href="#" data-toggle="modal"
                                                            data-target="#activity_summary">
                                                            <i class="fa fa-file-alt"></i> Activity Summary</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                            href="#" data-toggle="modal"
                                                            data-target="#current_location"> <i
                                                                class="fa fa-map-marker"></i> Current Location</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                            href="#" data-toggle="modal"
                                                            data-target="#profile_summary"> <i class="fa fa-file-alt"></i>
                                                            Profile Summary</a>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--right side bar end-->
                </div>
            </div>
        </div>
    </div>
    @include('agent.dashboard.partials.playmates-modal')
    <!-- Print Profile Report Modal -->

    <div class="modal programmatic" id="printReport">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color border-0">
                    <h5 class="modal-title text-white">
                        <img src="{{ asset('assets/dashboard/img/profile-report.png') }}" class="custompopicon"
                            alt="cross">
                        Profile Report
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Report Type -->
                                <div class="form-group mb-4">
                                    <div class="d-flex align-items-center gap-20">
                                        <p class="mb-2 font-weight-bold">Report Type:</p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="reportType"
                                                id="reportAll" value="all">
                                            <label class="form-check-label" for="reportAll">All</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="reportType"
                                                id="reportEscort" value="escort">
                                            <label class="form-check-label" for="reportEscort">Escort</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="reportType"
                                                id="reportMassage" value="massage">
                                            <label class="form-check-label" for="reportMassage">Massage Centre</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p class="mb-0 font-weight-bold">Period:</p>
                                    <div class="d-flex align-items-center gap-20">

                                        <!-- Entire Radio -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="period"
                                                id="periodEntire" value="entire">
                                            <label class="form-check-label" for="periodEntire">Entire</label>
                                        </div>

                                        <div class="form-group d-flex align-items-center gap-10 mb-0">
                                            <label for="fromDate" class="font-weight-medium mb-0">From</label>
                                            <input type="date" class="form-control" id="fromDate" name="fromDate">
                                        </div>
                                        <div class="form-group d-flex align-items-center gap-10 mb-0">
                                            <label for="toDate" class="font-weight-medium mb-0">To</label>
                                            <input type="date" class="form-control" id="toDate" name="toDate">
                                        </div>
                                    </div>
                                </div>




                                <!-- Footer -->
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn-success-modal" data-dismiss="modal"
                                        id="close_change">View</button>
                                    <button type="button" class="btn-cancel-modal" id="save_change">Print</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Current Location --}}

    <div class="modal programmatic" id="current_location">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color border-0">

                    <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/map.png') }}"
                            class="custompopicon" alt="cross">Current Location</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="text-center">The current Location for Name is: <b>Location</b></h5>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn-success-modal" data-dismiss="modal" value="close"
                                    id="close_change">Ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- end --}}


    {{-- activity_summary --}}

    <div class="modal fade upload-modal bd-example-modal-lg" id="activity_summary" tabindex="-1" role="dialog"
        aria-labelledby="activity_summaryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-custom" role="document">
            <div class="modal-content basic-modal modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="activity_summary"><img
                            src="{{ asset('assets/dashboard/img/profile-summary.png') }}" class="custompopicon">Activity
                        Summary - Member ID </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <table border="1" cellpadding="10" cellspacing="0" width="100%"
                        style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">


                        <!-- Table Headings -->
                        <tr style="background-color: #0c223d; color: white; font-weight: bold; text-align:center">
                            <td style="text-align:center;">Period</td>
                            <td style="text-align:center;">Profile Views</td>
                            <td style="text-align:center;">Media Views</td>
                            <td style="text-align:center;">Playbox Views</td>
                            <td style="text-align:center;">Legbox</td>
                        </tr>

                        <!-- Row 1 -->
                        <tr>
                            <td style="font-weight: bold; background:#0c223d; color:#fff;">This Week:
                            </td>
                            <td style="text-align:center;">15</td>
                            <td style="text-align:center;">12</td>
                            <td style="text-align:center;">10</td>
                            <td style="text-align:center;">2</td>
                        </tr>

                        <!-- Row 2 -->
                        <tr>
                            <td style="font-weight: bold; background:#0c223d; color:#fff;">Year to Date:
                            </td>
                            <td style="text-align:center;">259</td>
                            <td style="text-align:center;">198</td>
                            <td style="text-align:center;">201</td>
                            <td style="text-align:center;">42</td>
                        </tr>
                        <!-- Table Headings -->
                        <tr style="background-color: #0c223d; color: white; font-weight: bold; text-align:center">
                            <td style="border-bottom:0px"></td>
                            <td style="text-align:center;">Recommendations</td>
                            <td style="text-align:center;">Reviews</td>
                            <td style="text-align:center;">Reports</td>
                            <td style="text-align:center;">Social Media</td>
                        </tr>
                        <!-- Row 1 -->
                        <tr>
                            <td style="font-weight: bold;  background:#0c223d; color:#fff;">This Week:
                            </td>
                            <td style="text-align:center;">6</td>
                            <td style="text-align:center;">1</td>
                            <td style="text-align:center;">1</td>
                            <td style="text-align:center;">4</td>
                        </tr>

                        <!-- Row 2 -->
                        <tr>
                            <td style="font-weight: bold;  background:#0c223d; color:#fff;">Year to Date:
                            </td>
                            <td style="text-align:center;">84</td>
                            <td style="text-align:center;">6</td>
                            <td style="text-align:center;">12</td>
                            <td style="text-align:center;">125</td>
                        </tr>
                        <!-- Footer Row -->
                    </table>
                    <div class="modal-footer justify-content-center mt-3">
                        <button type="button" class="btn-success-modal" data-dismiss="modal" value="close"
                            id="close_change">Ok</button>
                        <button type="button" class="btn-cancel-modal" id="save_change">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}



    {{-- profile_summary --}}
    <div class="modal fade upload-modal bd-example-modal-lg" id="profile_summary" tabindex="-1" role="dialog"
        aria-labelledby="profile_summaryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-custom" role="document">
            <div class="modal-content basic-modal modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="profile_summary"><img
                            src="{{ asset('assets/dashboard/img/profile-summary.png') }}" class="custompopicon">Profile
                        Summary - Member ID</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive profile_summary">
                        <table cellpadding="8" cellspacing="0" width="100%"
                            style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">

                            <thead>
                                <!-- Table Headings -->
                                <tr style="background-color: #0c223d; color: white; font-weight: bold; text-align:center">
                                    <td style="text-align:center;">Masseur ID</td>
                                    <td style="text-align:center;">Start Date</td>
                                    <td style="text-align:center;">Finish Date</td>
                                    <td style="text-align:center;">Days</td>
                                    <td style="text-align:center;">Fee</td>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- Main Row -->
                                <tr>
                                    <td style="text-align:center; font-weight:bold;"></td>
                                    <td style="text-align:center;">01-01-2025</td>
                                    <td style="text-align:center;">15-04-2025</td>
                                    <td style="text-align:center;">104</td>
                                    <td style="text-align:right;">$ 3,120.00</td>
                                </tr>

                                <!-- Sub Rows -->
                                <tr style="background:#f9f9f9;">
                                    <td style="text-align:center;">001</td>
                                    <td style="text-align:center;">01-01-2025</td>
                                    <td style="text-align:center;">28-01-2025</td>
                                    <td style="text-align:center;">15</td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td style="text-align:center;">002</td>
                                    <td style="text-align:center;">29-01-2025</td>
                                    <td style="text-align:center;">23-02-2025</td>
                                    <td style="text-align:center;">26</td>
                                    <td></td>
                                </tr>

                                <tr style="background:#f9f9f9;">
                                    <td style="text-align:center;">003</td>
                                    <td style="text-align:center;">29-01-2025</td>
                                    <td style="text-align:center;">23-02-2025</td>
                                    <td style="text-align:center;">26</td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td style="text-align:center;">004</td>
                                    <td style="text-align:center;">24-02-2025</td>
                                    <td style="text-align:center;">05-03-2025</td>
                                    <td style="text-align:center;">10</td>
                                    <td></td>
                                </tr>

                                <tr style="background:#f9f9f9;">
                                    <td style="text-align:center;">005</td>
                                    <td style="text-align:center;">06-03-2025</td>
                                    <td style="text-align:center;">31-03-2025</td>
                                    <td style="text-align:center;">26</td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td style="text-align:center;">006</td>
                                    <td style="text-align:center;">01-04-2025</td>
                                    <td style="text-align:center;">15-04-2025</td>
                                    <td style="text-align:center;">15</td>
                                    <td></td>
                                </tr>

                                <!-- Footer -->
                                <tr style="font-weight:bold;">
                                    <td colspan="3" style="text-align:right;">Total days Masseurs:</td>
                                    <td style="text-align:center;">104</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer justify-content-center mt-3">
                        <button type="button" class="btn-success-modal" data-dismiss="modal" value="close"
                            id="close_change">Ok</button>
                        <button type="button" class="btn-cancel-modal" id="save_change">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- end --}}
@endsection
@push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script>
        var table = $('#advProfileSummaryTable').DataTable({
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search By Member Id",
                sSearch: 'Search:'
            },
            processing: false,
            serverSide: false,
            lengthChange: true,
            order: [0, 'asc'],
            searchable: false,
            searching: true,
            bStateSave: true
        });
    </script>
@endpush
