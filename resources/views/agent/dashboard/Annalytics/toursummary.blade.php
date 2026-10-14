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


    </style>
@endsection
@section('content')


    <!-- Data Table -->
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
                                   <h3 class="NotesHeader"><b>Notes:</b></h3>
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
                                <table class="table w-100 listing-table" id="advProfileSummaryTable">
                                    <thead class="table-bg">
                                        <tr>
                                            <th>Tour Title</th>
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
  
    <!-- Print Tour Report Modal -->
    <div class="modal fade upload-modal programmatic" id="printReport" tabindex="-1" role="dialog"
            aria-labelledby="printReport" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-white">
                            <img src="{{ asset('assets/dashboard/img/admin-report.png') }}" class="custompopicon"
                                alt="cross">
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
                                    <!-- <div class="form-group mb-4">
                                        <div class="d-flex align-items-center flex-wrap gap-20">
                                            <p class="mb-2 font-weight-bold" style="min-width: 100px">Report Type : 
                                        
                                        </div>
                                    </div> -->
                                    
                                    <div class="form-group">

                                        <!-- <div class="d-flex align-items-center flex-wrap gap-20 mb-4">
                                            <p class="mb-0 font-weight-bold" style="min-width: 10px">Full Report :</p>
                                            <div class="d-flex align-items-center flex-wrap gap-10">
                                            
                                                <input class="form-check-input ml-1" style="height: 85px; width: 17px;" type="radio" name="period"
                                                    id="periodEntire" value="entire">
                                                
                                            </div>
                                        </div> -->

                                    
                                        <div class="d-flex align-items-center flex-wrap gap-20">
                                            <p class="mb-0 font-weight-bold" style="min-width: 10px">Period :</p>
                                            <div class="d-flex align-items-center flex-wrap gap-10">
                                                <!-- Entire Radio -->

                                            <!-- <div class="form-check">
                                                <input class="form-check-input" type="radio" name="period"
                                                    id="periodEntire" value="entire">
                                                <label class="form-check-label" for="periodEntire">Entire</label>
                                            </div> -->

                                                    <div class="form-group d-flex align-items-center gap-5 mb-0">
                                                        <label for="fromDate" class="form-check-label">From : </label>
                                                        <input type="text" style="width: 290px;" class="form-control js_datepicker" id="fromDate" name="fromDate">
                                                    </div>
                                                    <div class="form-group d-flex align-items-center gap-5 mb-0">
                                                        <label for="toDate" class="form-check-label">To : </label>
                                                        <input type="text" style="width: 290px;" class="form-control js_datepicker" id="toDate" name="toDate">
                                                    </div>
                                            </div>
                                        </div>
                                    </div>




                                    <!-- Footer -->
                                    <div class="modal-footer justify-content-end">
                                    
                                        <button type="button" class="" 
                                            id="view_pdf_report">View Report</button>
                                        <button type="button" class="btn-cancel-modal" id="print_report">Print</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>

     <!-- Current Location Modal -->
     <div class="upload-modal fade modal programmatic" id="current_location" tabindex="-1" role="dialog"
        aria-labelledby="current_location" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white">
                        <img src="{{ asset('assets/dashboard/img/map.png') }}" class="custompopicon" alt="cross">
                        Current Location - <span id="modal-member-id"></span>
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h5 class="custom_modal_text">
                                The current Location for <span id="modal-member-name"></span> is : 
                                <b id="modal-member-location"></b>
                            </h5>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn-success-modal" data-dismiss="modal">Ok</button>
                                <!-- <button type="button" class="btn-success-modal" data-dismiss="modal">Send Message</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tour Report Modal -->
    <div class="modal fade upload-modal bd-example-modal-lg" id="listingReportModal" tabindex="-1" role="dialog"
            aria-labelledby="tour_summaryLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document" style="max-width: 70%; width: 70%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tour_summary">
                                <img src="{{ asset('assets/dashboard/img/tour-summary.png') }}" class="custompopicon"> Tour Summury
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive tour_summary">
                                <table cellpadding="8" cellspacing="0" class="w-100 table  table-border">
                                    <thead>
                                        <tr style="background-color: #0c223d; color: white; font-weight: bold; text-align:center">
                                        
                                            <th style="text-align:center;">Member ID</th>
                                            <th style="text-align:center;">Name</th>
                                            <th style="text-align:center;">Mobile</th>
                                            <th style="text-align:center;">Tour Name</th>
                                            <th style="text-align:center;">Locations</th>
                                            <th style="text-align:center;">Start Date</th>
                                            <th style="text-align:center;">End Date</th>
                                            <th style="text-align:center;">Days</th>
                                            <th style="text-align:center;">Pin Up</th>
                                            <th style="text-align:center;">Listing Fee</th>
                                            <th style="text-align:center;">Agent Fee</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listingReportBody">
                                    
                                    </tbody>
                                </table>
                            </div>

                            <div class="modal-footer justify-content-end mt-3">
                                <button type="button" class="btn-cancel-modal" id="save_change">Print</button>
                                <button type="button" class="btn-success-modal" data-dismiss="modal" value="close" id="close_change">Ok</button>
                            </div>
                        </div>
                    </div>
                </div>
    </div>

     <!-- Tour Summary Modal -->
    <div class="modal fade upload-modal bd-example-modal-lg" id="tour_detail_summary_old" tabindex="-1" role="dialog"
        aria-labelledby="tour_summaryLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
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
                        <table cellpadding="8" cellspacing="0" class="w-100 table"
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
                                    <td style="text-align:right;"><div class="num_value"><x-curFormat/><span>120.00</span></div></td>
                                </tr>
                                <tr style="background:#f9f9f9;">
                                    <td style="text-align:center;">SA</td>
                                    <td style="text-align:center;">16-01-2025</td>
                                    <td style="text-align:center;">28-01-2025</td>
                                    <td>Platinum</td>
                                    <td style="text-align:center;">12</td>
                                    <td style="text-align:right;"><div class="num_value"><x-curFormat/><span>96.00</span></div></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">Vic</td>
                                    <td style="text-align:center;">29-01-2025</td>
                                    <td style="text-align:center;">23-02-2025</td>
                                    <td>Platinum</td>
                                    <td style="text-align:center;">26</td>
                                    <td style="text-align:right;"><div class="num_value"><x-curFormat/><span>208.00</span></div></td>
                                </tr>
                                <tr style="background:#f9f9f9;">
                                    <td style="text-align:center;">Vic</td>
                                    <td style="text-align:center;">29-01-2025</td>
                                    <td style="text-align:center;">23-02-2025</td>
                                    <td>Gold</td>
                                    <td style="text-align:center;">26</td>
                                    <td style="text-align:right;"><div class="num_value"><x-curFormat/><span>156.00</span></div></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">Vic</td>
                                    <td style="text-align:center;">03-02-2025</td>
                                    <td style="text-align:center;">09-02-2025</td>
                                    <td>Pin Up</td>
                                    <td style="text-align:center;">(1 week)</td>
                                    <td style="text-align:right;"><div class="num_value"><x-curFormat/><span>475.00</span></div></td>
                                </tr>
                                <tr style="background:#f9f9f9;">
                                    <td style="text-align:center;">Tas</td>
                                    <td style="text-align:center;">24-02-2025</td>
                                    <td style="text-align:center;">05-03-2025</td>
                                    <td>Gold</td>
                                    <td style="text-align:center;">10</td>
                                    <td style="text-align:right;"><div class="num_value"><x-curFormat/><span>60.00</span></div></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">NSW</td>
                                    <td style="text-align:center;">06-03-2025</td>
                                    <td style="text-align:center;">31-03-2025</td>
                                    <td>Platinum</td>
                                    <td style="text-align:center;">26</td>
                                    <td style="text-align:right;"><div class="num_value"><x-curFormat/><span>208.00</span></div></td>
                                </tr>
                                <tr style="background:#f9f9f9;">
                                    <td style="text-align:center;">Qld</td>
                                    <td style="text-align:center;">01-04-2025</td>
                                    <td style="text-align:center;">15-04-2025</td>
                                    <td>Platinum</td>
                                    <td style="text-align:center;">15</td>
                                    <td style="text-align:right;"><div class="num_value"><x-curFormat/><span>120.00</span></div></td>
                                </tr>
                                <tr style="font-weight:bold;">
                                    <td colspan="4" style="
                                        text-align:right;">Totals:</td>
                                                                            <td style="
                                            border-top: 1px solid; border-bottom: 1px solid; text-align:center;">104</td>
                                                                            <td style="
                                            border-top: 1px solid; border-bottom: 1px solid; text-align:right;"><div class="num_value"><x-curFormat/><span>1,443.00</span></div></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>

                    <div class="modal-footer justify-content-end mt-3">
                        
                        <button type="button" class="btn-cancel-modal" id="save_change">Print</button>
                        <button type="button" class="btn-success-modal" data-dismiss="modal" value="close"
                            id="close_change">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade upload-modal bd-example-modal-lg" id="tour_detail_summary" tabindex="-1" role="dialog"
        aria-labelledby="tour_summaryLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tour_summary">
                        <img src="{{ asset('assets/dashboard/img/tour-summary.png') }}" class="custompopicon"> 
                        Tour Summary - <span id="summaryModalMemberId"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive tour_summary">
                        <table cellpadding="8" cellspacing="0" class="w-100 table" style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">
                            <thead>
                                <tr style="background-color: #0c223d; color: white; font-weight: bold; text-align:center">
                                    <th style="text-align:center; font-weight: bold;">Location</th>
                                    <th style="text-align:center; font-weight: bold;">Start Date</th>
                                    <th style="text-align:center; font-weight: bold;">Finish Date</th>
                                    <th style="text-align:center; font-weight: bold;">Membership Type</th>
                                    <th style="text-align:center; font-weight: bold;">Days</th>
                                    <th style="text-align:center;font-weight: bold; ">Listing Fee</th>
                                </tr>
                            </thead>
                            <tbody id="tourSummaryDetailBody">
                                <!-- Injected dynamically via AJAX -->
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer justify-content-end mt-3">
                        <button type="button" class="btn-cancel-modal" id="printSummaryBtn">Print</button>
                        <button type="button" class="btn-success-modal" data-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
   


<script>

  $(document).ready(function () {


    var table = $('#advProfileSummaryTable').DataTable({
      language: {
         search: "Search: _INPUT_",
         searchPlaceholder: "Search by Member ID"
      },
      info: true,
      lengthChange: true,
      searching: true,
      bStateSave: false,
      
      order: [
         
      ],
      processing: true,
      serverSide: true,
      paging: true,
      ajax: {
         url: "{{ route('agent.analytic-tour-list-ajax') }}",
         type: "GET",
         dataSrc: function(json) {
            var totalRows = json.recordsTotal || json.recordsFiltered;
            $(".totalListing").text(totalRows);
            $(".serverTime").text(json.server_time);
            $(".uptimeClass").html(json.server_up_time);
            

                if (json.data && json.data.length > 0) {
                var parseDate = function(dateStr) {
                    if (!dateStr) return null;
                    var parts = dateStr.split('-');
                    return new Date(parts[2], parts[1] - 1, parts[0]);
                };

                var minStartDate = null;
                var maxEndDate = null;

                json.data.forEach(function(row) {
                    var startDate = parseDate(row.start_date);
                    var endDate = parseDate(row.end_date);

                    if (startDate && (!minStartDate || startDate < minStartDate)) {
                        minStartDate = startDate;
                    }
                    if (endDate && (!maxEndDate || endDate > maxEndDate)) {
                        maxEndDate = endDate;
                    }
                });

                // Format dates back to string format DD-MM-YYYY
                var formatDate = function(dateObj) {
                    if (!dateObj) return '';
                    var d = String(dateObj.getDate()).padStart(2, '0');
                    var m = String(dateObj.getMonth() + 1).padStart(2, '0');
                    var y = dateObj.getFullYear();
                    return `${d}-${m}-${y}`;
                };

                var firstStartDate = formatDate(minStartDate);
                var lastEndDate = formatDate(maxEndDate);

                $("#fromDate").datepicker("option", "minDate", firstStartDate);
                $("#toDate").datepicker("option", "maxDate", lastEndDate);

            }                       



            return json.data;
         }
      },
      columns: [
        {
            data: 'tour_name',
            name: 'tour_name',
            searchable: false,
            orderable: false,
        },
        {
            data: 'member_id',
            name: 'member_id',
            orderable: false,
        },

        {
            data: 'name',
            name: 'name',
            orderable: false,
        },

        {
            data: 'mobile',
            name: 'mobile',
            searchable: false,
            orderable: false,
        },
        {
            data: 'no_of_location',
            name: 'no_of_location',
            searchable: false,
            orderable: false,
        },
        {
            data: 'start_date',
            name: 'start_date',
            searchable: false,
            orderable: false,
        },
        {
            data: 'end_date',
            name: 'end_date',
            searchable: false,
            orderable: false,
        },
        {
            data: 'total_days',
            name: 'total_days',
            searchable: false,
            orderable: false,
        },

        {
            data: 'pin_up',
            name: 'pin_up',
            searchable: false,
            orderable: false,
        },
        {
            data: 'listing_fee',
            name: 'listing_fee',
            searchable: false,
            orderable: false,
        },
        {
            data: 'adgent_fee',
            name: 'adgent_fee',
            searchable: false,
            orderable: false,
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
            class: 'text-center'
        }
      ]
   });


    $('#current_location').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget); 
        

        var memberId = button.data('memberid');
        var memberName = button.data('membername');
        var location = button.data('location');


        var modal = $(this);
        modal.find('#modal-member-id').text(memberId ?? 'N/A');
        modal.find('#modal-member-name').text(memberName ?? 'Member');
        modal.find('#modal-member-location').text(location ?? 'Not specified');
    });
    
    
    $("#fromDate, #toDate").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true
    });

    $("#toDate").on("change", function() {
        var toDateVal = $(this).datepicker("getDate");
        $("#fromDate").datepicker("option", "maxDate", toDateVal);
    });

    $("#fromDate").on("change", function() {
        var fromDateVal = $(this).datepicker("getDate");
        $("#toDate").datepicker("option", "minDate", fromDateVal);
    });



    //  ########### Print Report ##################  
    $('#print_report').on('click', async function () {

        let fromDate = $('#fromDate').val();
        let toDate = $('#toDate').val();

        console.log('fromDate',fromDate);
        console.log('toDate',toDate);

        let fromParts = fromDate.split('-');
        let toParts = toDate.split('-');


        let formattedFromDate = `${fromParts[2]}-${fromParts[1]}-${fromParts[0]}`;
        let formattedToDate = `${toParts[2]}-${toParts[1]}-${toParts[0]}`;


        if (!fromDate) {
            $('#fromDate').focus();
            swal_error_warning('Tour Report','Please select From date.');
            return;
        }

        if (!toDate) {
            $('#toDate').focus();
            swal_error_warning('Tour Report','Please select To date.');
            return;
        }

       if (formattedFromDate > formattedToDate) {
            swal_error_warning('Tour Report','From date cannot be greater than To date.');
            $('#fromDate').focus();
            return;
        }

       

        let requestUrl = "{{ route('agent.generate_tour_pdf') }}" + `?from_date=${fromDate}&to_date=${toDate}`;
        swal_waiting_popup({'title': 'Printing Report...'});                            
        try {
            let response = await fetch(requestUrl, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json, application/pdf'
                }
            });

            let contentType = response.headers.get('content-type') || '';
            if (response.ok && contentType.includes('application/pdf')) {
                Swal.close();
                let blob = await response.blob();
                let pdfUrl = URL.createObjectURL(blob);
                window.open(pdfUrl, '_blank');
                return;
            }

            let data = await response.json();
            if (data.errors) {
                Swal.close();
                let firstKey = Object.keys(data.errors)[0];
                swal_error_warning(data.errors[firstKey][0]);
            } else {
                Swal.close();
                swal_error_warning('Profile Report', data.message || 'Unable to generate report.');
            }

        } catch (error) {
            Swal.close();
            console.error('Report Generation Error:', error);
            swal_error_warning('Profile Report', 'Something went wrong. Please try again.');
        }
    }); 


    //  ########### View Pdf Report ##################                                 
    $(document).on('click', '#view_pdf_report', function (e) {
        e.preventDefault();

        let $btn =$(this);
        let fromDate = $('#fromDate').val();
        let toDate = $('#toDate').val();

        let fromParts = fromDate.split('-');
        let toParts = toDate.split('-');

        let formattedFromDate = `${fromParts[2]}-${fromParts[1]}-${fromParts[0]}`;
        let formattedToDate = `${toParts[2]}-${toParts[1]}-${toParts[0]}`;


        if (!fromDate) {
            $('#fromDate').focus();
            swal_error_warning('Tour Report','Please select From date.');
            return;
        }

        if (!toDate) {
            $('#toDate').focus();
            swal_error_warning('Tour Report','Please select To date.');
            return;
        }

       if (formattedFromDate > formattedToDate) {
            swal_error_warning('Tour Report','From date cannot be greater than To date.');
            $('#fromDate').focus();
            return;
        }

       
        // Append format=json so controller returns response()->json(...)
        let requestUrl = "{{ route('agent.generate_tour_pdf') }}" + `?from_date=${fromDate}&to_date=${toDate}&format=json`;                                

        $btn.prop('disabled', true).text('Loading...');
        swal_waiting_popup({'title': 'Fetching Report...'});

        $.ajax({
            url: requestUrl,
            type: 'GET',
            dataType: 'json',
            success: function (res) {
                Swal.close();
                $btn.prop('disabled', false).text('View Report');

                if (!res.status) {
                    swal_error_warning('Tour Report', res.message || 'Unable to load report.');
                    return;
                }
            
                let html = '';
                if (res.data && res.data.length) {
                    res.data.forEach((item, index) => {
                        html += `
                            <tr>
                               
                                <td class="text-center">${item.member_id}</td>
                                <td>${item.name}</td>
                                <td>${item.mobile}</td>
                                <td>${item.tour_name}</td>
                                <td class="text-center">${item.no_of_location}</td>
                                <td class="text-center">${item.start_date}</td>
                                <td class="text-center">${item.end_date}</td>
                                <td class="text-center">${item.total_days}</td>
                                <td class="text-center">${item.pin_up}</td>
                                <td class="text-right">
                                    <div class="num_value"><x-curFormat/><span>${item.listing_fee}</span></div>
                                </td>
                                <td class="text-right">
                                    <div class="num_value"><x-curFormat/><span>${item.agent_fee}</span></div>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    html = `<tr><td colspan="12" class="text-center">No record found.</td></tr>`;
                }

                $('#listingReportBody').html(html);
                $('#listingReportModal').modal('show');
            },
            error: function (xhr) {
                Swal.close();
                $btn.prop('disabled', false).text('View Report');
                let err = xhr.responseJSON ? xhr.responseJSON.message : 'Something went wrong.';
                swal_error_warning('Tour Report', err);
            }
        });
    });
   // ########### End Pdf Report ##################                                  

    // $(document).on('click', '.open-summary-modal', function (e) {                                
    //      $('#tour_detail_summary').modal('show');                               
    // });


    $(document).on('click', '.open-summary-modal', function (e) {
        e.preventDefault();

        let tourId = $(this).data('id');
        let memberId = $(this).data('member_id');

        if (!tourId) return;

        // Show waiting popup
        swal_waiting_popup({'title': 'Loading Summary...'});

        $.ajax({
            url: "{{ route('agent.get_tour_summary_detail') }}",
            type: 'GET',
            data: { tour_id: tourId },
            dataType: 'json',
            success: function (res) {
                Swal.close();

                if (!res.status) {
                    swal_error_warning('Tour Summary', res.message || 'Unable to load summary.');
                    return;
                }

                $('#summaryModalMemberId').text(res.member_id || memberId);

                let html = '';
                if (res.data && res.data.length > 0) {
                    res.data.forEach((row, index) => {

                      console.log('row.pinup_data',row.pinup_data);

                        let bgStyle = (index % 2 !== 0) ? 'style="background:#f9f9f9;"' : '';
                        let membershipText = '';
                        if (Array.isArray(row.membership) && row.membership.length > 0) {
                            membershipText = row.membership
                                .map(m => `${m.member_id} - ${m.plan}`)
                                .join('<br>'); 
                        } else {
                            membershipText = row.membership || '-';
                        }

                        html += `
                            <tr ${bgStyle}>
                                <td style="text-align:center;">${row.location}</td>
                                <td style="text-align:center;">${row.start_date}</td>
                                <td style="text-align:center;">${row.end_date}</td>
                                <td style="text-align:center;">${membershipText}</td>
                                <td style="text-align:center;">${row.days}</td>
                                <td style="text-align:right;">
                                    <div class="num_value"><x-curFormat/><span>${row.listing_fee}</span></div>
                                </td>
                            </tr>
                        `;


                            if (row.is_pinup && row.pinup_data) {
                                // Format membership array/string into "member_id - plan"
                               

                                // Format listing fee to 2 decimal places
                                let pinupFee = typeof row.pinup_data.listing_fee === 'number'
                                    ? row.pinup_data.listing_fee.toFixed(2)
                                    : (row.pinup_data.listing_fee || '0.00');

                                html += `
                                    <tr ${bgStyle}>
                                        <td style="text-align:center;">${row.pinup_data.location}</td>
                                        <td style="text-align:center;">${row.pinup_data.start_date}</td>
                                        <td style="text-align:center;">${row.pinup_data.end_date}</td>
                                        <td style="text-align:center;">${row.pinup_data.membership}</td>
                                        <td style="text-align:center;">${row.pinup_data.days}</td>
                                        <td style="text-align:right;">
                                            <div class="num_value"><x-curFormat/><span>${pinupFee}</span></div>
                                        </td>
                                    </tr>
                                `;
                            }

                        // if(row.is_pinup)
                        // {
                        //     html += `
                        //     <tr ${bgStyle}>
                        //         <td style="text-align:center;">${row.pinup_data.location}</td>
                        //         <td style="text-align:center;">${row.pinup_data.start_date}</td>
                        //         <td style="text-align:center;">${row.pinup_data.end_date}</td>
                        //         <td style="text-align:center;">${row.pinup_data.membership}</td>
                        //         <td style="text-align:center;">${row.pinup_data.days}</td>
                        //         <td style="text-align:right;">
                        //             <div class="num_value"><x-curFormat/><span>${row.pinup_data.listing_fee}</span></div>
                        //         </td>
                        //     </tr>
                        // `;
  
                        // }

                    });

                    // Append Totals row
                    html += `
                        <tr style="font-weight:bold;">
                            <td colspan="4" style="text-align:right;">Totals:</td>
                            <td style="border-top: 1px solid; border-bottom: 1px solid; text-align:center;">${res.total_days}</td>
                            <td style="border-top: 1px solid; border-bottom: 1px solid; text-align:right;">
                                <div class="num_value"><x-curFormat/><span>${res.total_fee}</span></div>
                            </td>
                        </tr>
                    `;
                } else {
                    html = `<tr><td colspan="6" class="text-center">No location details found.</td></tr>`;
                }

                $('#tourSummaryDetailBody').html(html);
                $('#tour_detail_summary').modal('show');
            },
            error: function (xhr) {
                Swal.close();
                let err = xhr.responseJSON ? xhr.responseJSON.message : 'Something went wrong.';
                swal_error_warning('Tour Summary', err);
            }
        });
    });

                                    //$('#tour_detail_summary_old').modal('show');      
     
});

</script>   


@endpush
