@extends('layouts.agent')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">

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

        .tour_summary table td,
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
                            <h1 class="h1">Tour Summary</h1>
                            <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes"
                                aria-expanded="true">Help?</span>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="card collapse" id="notes" style="">
                                <div class="card-body">
                                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                                    <ol>
                                        <li>This report provides information associated with Tours.</li>
                                        <li>It is a summary of the Tour and revenue (Fees) you have derived from the Tour.</li>
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
                            <div class="table-responsive">
                                <table class="table w-100" id="advProfileSummaryTable">
                                    <thead class="table-bg">
                                        <tr>
                                            <th>Member ID</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Number of Locations</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Total Days</th>
                                            <th>Pin Up</th>
                                            <th>Listing Fee</th>
                                            <th>Agent’s Fee</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>E60165</td>
                                            <td>Jane</td>
                                            <td>0438 028 728</td>
                                            <td>6</td>
                                            <td>01-01-2025</td>
                                            <td>15-04-2025</td>
                                            <td>104</td>
                                            <td>Yes</td>
                                            <td><div class="num_value">$<span>1,443.00</span></div></td>
                                            <td> <div class="num_value">$<span>72.15</span></div></td>
                                            <td>
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
                                                            data-target="#current_location"> <i
                                                                class="fa fa-map-marker"></i> Current Location</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                            href="#" data-toggle="modal" data-target="#tour_summary">
                                                            <i class="fa fa-file-alt"></i> Tour Summary</a>

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
    <!-- Print Tour Report Modal -->

    <div class="modal fade programmatic" id="printReport">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color border-0">
                    <h5 class="modal-title text-white">
                        <img src="{{ asset('assets/dashboard/img/admin-report.png') }}" class="custompopicon" alt="cross">
                        Tour Report
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
                                        <p class="mb-0 font-weight-bold">Report Type:</p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="reportType" id="reportAll"
                                                value="all">
                                            <label class="form-check-label" for="reportAll">All</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="reportType"
                                                id="reportEscort" value="escort">
                                            <label class="form-check-label" for="reportEscort">Escort</label>
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
                                            <label for="fromDate" class="font-weight-medium mb-0">From:</label>
                                            <input type="date" class="form-control" id="fromDate" name="fromDate">
                                        </div>
                                        <div class="form-group d-flex align-items-center gap-10 mb-0">
                                            <label for="toDate" class="font-weight-medium mb-0">To:</label>
                                            <input type="date" class="form-control" id="toDate" name="toDate">
                                        </div>
                                    </div>
                                </div>




                                <!-- Footer -->
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn-success-modal" data-dismiss="modal"
                                        id="close_change">View</button>
                                    <button type="button" class="btn-success-modal" id="save_change">Print</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Current Location --}}

    <div class="upload-modal fade modal programmatic" id="current_location">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color border-0">

                    <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/map.png') }}"
                            class="custompopicon" alt="cross">Current Location - E60165</h5>
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
                            <h4>The current Location for Name is: <b>Location</b></h4>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn-success-modal" data-dismiss="modal" value="close"
                                    id="close_change">Ok</button>
                                    <button type="button" class="btn-success-modal" data-dismiss="modal" value="close"
                                    id="close_change">Send Message</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- end --}}





    {{-- tour_summary --}}
    <div class="modal fade upload-modal bd-example-modal-lg" id="tour_summary" tabindex="-1" role="dialog"
        aria-labelledby="tour_summaryLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-custom" role="document">
            <div class="modal-content basic-modal modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="tour_summary"><img
                            src="{{ asset('assets/dashboard/img/tour-summary.png') }}" class="custompopicon">Tour Summary
                        - E60165</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive tour_summary">
                        <table cellpadding="8" cellspacing="0" width="100%"
                            style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">

                            <thead>
                                <!-- Table Headings -->
                                <tr style="background-color: #0c223d; color: white; font-weight: bold; text-align:center">
                                    <td style="text-align:center;">Location</td>
                                    <td style="text-align:center;">Start Date</td>
                                    <td style="text-align:center;">Finish Date</td>
                                    <td style="">Membership Type </td>
                                    <td style="text-align:center;">Days</td>
                                    <td style="text-align:center;">Listing Fee</td>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td style="text-align:center;">WA</td>
                                    <td style="text-align:center;">01-01-2025</td>
                                    <td style="text-align:center;">15-01-2025</td>
                                    <td >Platinum</td>
                                    <td style="text-align:center;">15</td>
                                    <td style="text-align:right;"><div class="num_value">$<span>120.00</span></div></td>
                                </tr>
                                <tr style="background:#f9f9f9;">
                                    <td style="text-align:center;">SA</td>
                                    <td style="text-align:center;">16-01-2025</td>
                                    <td style="text-align:center;">28-01-2025</td>
                                    <td>Platinum</td>
                                    <td style="text-align:center;">12</td>
                                    <td style="text-align:right;"><div class="num_value">$<span>96.00</span></div></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">Vic</td>
                                    <td style="text-align:center;">29-01-2025</td>
                                    <td style="text-align:center;">23-02-2025</td>
                                    <td>Platinum</td>
                                    <td style="text-align:center;">26</td>
                                    <td style="text-align:right;"><div class="num_value">$<span>208.00</span></div></td>
                                </tr>
                                <tr style="background:#f9f9f9;">
                                    <td style="text-align:center;">Vic</td>
                                    <td style="text-align:center;">29-01-2025</td>
                                    <td style="text-align:center;">23-02-2025</td>
                                    <td>Gold</td>
                                    <td style="text-align:center;">26</td>
                                    <td style="text-align:right;"><div class="num_value">$<span>156.00</span></div></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">Vic</td>
                                    <td style="text-align:center;">03-02-2025</td>
                                    <td style="text-align:center;">09-02-2025</td>
                                    <td>Pin Up</td>
                                    <td style="text-align:center;">(1 week)</td>
                                    <td style="text-align:right;"><div class="num_value">$<span>475.00</span></div></td>
                                </tr>
                                <tr style="background:#f9f9f9;">
                                    <td style="text-align:center;">Tas</td>
                                    <td style="text-align:center;">24-02-2025</td>
                                    <td style="text-align:center;">05-03-2025</td>
                                    <td>Gold</td>
                                    <td style="text-align:center;">10</td>
                                    <td style="text-align:right;"><div class="num_value">$<span>60.00</span></div></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">NSW</td>
                                    <td style="text-align:center;">06-03-2025</td>
                                    <td style="text-align:center;">31-03-2025</td>
                                    <td>Platinum</td>
                                    <td style="text-align:center;">26</td>
                                    <td style="text-align:right;"><div class="num_value">$<span>208.00</span></div></td>
                                </tr>
                                <tr style="background:#f9f9f9;">
                                    <td style="text-align:center;">Qld</td>
                                    <td style="text-align:center;">01-04-2025</td>
                                    <td style="text-align:center;">15-04-2025</td>
                                    <td>Platinum</td>
                                    <td style="text-align:center;">15</td>
                                    <td style="text-align:right;"><div class="num_value">$<span>120.00</span></div></td>
                                </tr>
                                <tr style="font-weight:bold;">
                                    <td colspan="4" style="
                                        text-align:right;">Totals:</td>
                                                                            <td style="
                                            border-top: 1px solid; border-bottom: 1px solid; text-align:center;">104</td>
                                                                            <td style="
                                            border-top: 1px solid; border-bottom: 1px solid; text-align:right;"><div class="num_value">$<span>1,443.00</span></div></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>

                    <div class="modal-footer justify-content-center mt-3">
                        <button type="button" class="btn-success-modal" data-dismiss="modal" value="close"
                            id="close_change">Ok</button>
                        <button type="button" class="btn-success-modal" id="save_change">Print</button>
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
                searchPlaceholder: "Search By Member ID",
                sSearch: 'Search:'
            },
            processing: false,
            serverSide: false,
            lengthChange: true,
            order: [0, 'asc'],
            searchable: false,
            searching: true,
            bStateSave: true,
            columns: [
            { data: 'member_id', name: 'member_id', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'name', name: 'name', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'mobile', name: 'mobile', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'no_location', name: 'no_location', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'start_date', name: 'start_date', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'end_date', name: 'end_date', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'total_day', name: 'total_day', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'pinup', name: 'pinup', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'listing_fee', name: 'listing_fee', searchable: false, orderable:true ,defaultContent: 'NA'},
            { data: 'agent_fee', name: 'agent_fee', searchable: false, orderable:true ,defaultContent: 'NA'},
            { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA', class:'text-center' },
            ],
        });
    </script>
@endpush
