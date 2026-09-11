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
                                   <h3 class="NotesHeader"><b>Notes:</b></h3>
                                    <ol>
                                        <li>This report provides information associated with all of your Profiles (excluding Tours).</li>
                                        <li>
                                            It is a summary of the Listed Profiles and revenue (Fees) you have derived from the
                                            Profiles, Escort and Massage Centres.
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end --}}
                    <div class="row">

                    <div class="col-md-12 col-sm-12 d-flex justify-content-between" style="gap: 50px;">

                <div class="d-flex justify-content-between align-items-center gap-2">
                  <select id="advertiserFilter" name="advertiser_type" class="form-select form-select-sm p-2" style="width: 200px;">
                     <option value="{{ route('agent.analytic-profiles-list-ajax','escort') }}">Escort</option>
                     <option value="{{ route('agent.analytic-profiles-list-ajax','massage') }}">Massage Center</option>
                  </select>
               </div>

                 <div class="d-flex justify-content-end my-3">
                                <button class="btn-common mr-0" type="button" data-target="#printReport"
                                    data-toggle="modal">Print Report</button>
                            </div>

                    </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">

                


                          
                            <div class="table-responsive">
                                <table class="table w-100" id="advProfileSummaryTable">
                                    <thead class="table-bg">
                                        <tr>
                                            <th>Member ID</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
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
                                        <!-- <tr>
                                            <td>E60165</td>
                                            <td>Jane</td>
                                            <td>0438 028 728</td>
                                            <td>01-01-2025</td>
                                            <td>15-04-2025</td>
                                            <td>104</td>
                                            <td>Yes</td>
                                            <td><div class="num_value"><x-curFormat/><span>1,443.00</span></div></td>
                                            <td> <div class="num_value"><x-curFormat/><span>72.15</span></div></td>
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
                                        </tr> -->

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

    <div class="modal fade upload-modal programmatic" id="printReport" tabindex="-1" role="dialog"
        aria-labelledby="printReport" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white">
                        <img src="{{ asset('assets/dashboard/img/admin-report.png') }}" class="custompopicon"
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
                                    <div class="d-flex align-items-center flex-wrap gap-20">
                                        <p class="mb-2 font-weight-bold" style="min-width: 100px">Report Type : <span class="rep_type"> Escort</span></p>
                                        <!-- <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="reportType"
                                                id="reportAll" value="all">
                                            <label class="form-check-label" for="reportAll">All</label>
                                        </div> -->
                                        <!-- <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="reportType"
                                                id="reportType" value="escort">
                                            <label class="form-check-label" for="reportEscort">Escort</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="reportType"
                                                id="reportType" value="massage">
                                            <label class="form-check-label" for="reportMassage">Massage Centre</label>
                                        </div> -->
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                   
                                    <div class="d-flex align-items-center flex-wrap gap-20">
                                        <p class="mb-0 font-weight-bold" style="min-width: 10px">Period :</p>
                                        <div class="d-flex align-items-center flex-wrap gap-10">
                                            <!-- Entire Radio -->

                                        <!-- <div class="form-check">
                                            <input class="form-check-input" type="radio" name="period"
                                                id="periodEntire" value="entire">
                                            <label class="form-check-label" for="periodEntire">Entire</label>
                                        </div> -->

                                                <div class="form-group d-flex align-items-center gap-10 mb-0">
                                                    <label for="fromDate" class="form-check-label">From: </label>
                                                    <input type="date" class="form-control" id="fromDate" name="fromDate">
                                                </div>
                                                <div class="form-group d-flex align-items-center gap-10 mb-0">
                                                    <label for="toDate" class="form-check-label">To:</label>
                                                    <input type="date" class="form-control" id="toDate" name="toDate">
                                                </div>
                                        </div>
                                    </div>
                                </div>




                                <!-- Footer -->
                                <div class="modal-footer justify-content-end">
                                   
                                    <button type="button" class="btn-cancel-modal" id="print_report">Print</button>
                                     <!-- <button type="button" class="btn-success-modal" data-dismiss="modal"
                                        id="close_change">View</button> -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Current Location --}}

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

    {{-- end --}}


    {{-- activity_summary --}}

    <div class="modal fade upload-modal bd-example-modal-lg" id="activity_summary" tabindex="-1" role="dialog"
        aria-labelledby="activity_summaryLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="activity_summary"><img
                            src="{{ asset('assets/dashboard/img/profile-summary.png') }}" class="custompopicon">Activity
                        Summary - E60165 </h5>
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
                    <div class="modal-footer justify-content-end mt-3">
                       
                        <button type="button" class="btn-cancel-modal" id="save_change">Print</button>
                        <button type="button" class="btn-success-modal" data-dismiss="modal" value="close"
                            id="close_change">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}



    {{-- profile_summary --}}
    <div class="modal fade upload-modal bd-example-modal-lg" id="profile_summary" tabindex="-1" role="dialog"
        aria-labelledby="profile_summaryLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profile_summary"><img
                            src="{{ asset('assets/dashboard/img/profile-summary.png') }}" class="custompopicon">Profile
                        Summary - E60165</h5>
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
                                    <td style="text-align:center; width:110px">Listing Fee</td>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- Main Row -->
                                <tr>
                                    <td style="text-align:center; font-weight:bold;"></td>
                                    <td style="text-align:center;">01-01-2025</td>
                                    <td style="text-align:center;">15-04-2025</td>
                                    <td style="text-align:center;">104</td>
                                    <td style="text-align:right;"><div class="num_value">$<span>3,120.00 </span></div></td>
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

                    <div class="modal-footer justify-content-end mt-3">
                        
                        <button type="button" class="btn-cancel-modal" id="save_change">Print</button>
                        <button type="button" class="btn-success-modal" data-dismiss="modal" value="close"
                            id="close_change">Ok</button>
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
         search: "Search: _INPUT_",
         searchPlaceholder: "Search by Member ID"
      },
      info: true,
      lengthChange: true,
      searching: true,
      bStateSave: true,
      order: [
         [4, 'desc']
      ],
      processing: true,
      serverSide: true,
      paging: true,
      ajax: {
         url: $("select[name='advertiser_type']").val(),
         type: "GET",
         dataSrc: function(json) {
            var totalRows = json.recordsTotal || json.recordsFiltered;
            $(".totalListing").text(totalRows);
            $(".serverTime").text(json.server_time);
            $(".uptimeClass").html(json.server_up_time);
            return json.data;
         }
      },
      columns: [{
            data: 'member_id',
            name: 'member_id',
            orderable: false,
         },
         {
            data: 'name',
            name: 'name'
         },
         {
            data: 'mobile',
            name: 'mobile',
            searchable: false,
         },
         {
            data: 'start_date',
            name: 'start_date',
            searchable: false,
         },
         {
            data: 'end_date',
            name: 'end_date',
            searchable: false,
         },
         {
            data: 'total_days',
            name: 'total_days',
            searchable: false,
         },
        
         {
            data: 'pin_up',
            name: 'pin_up',
            orderable: false,
         },
         {
            data: 'lsiting_fee',
            name: 'lsiting_fee',
            orderable: false,
         },
         {
            data: 'adgent_fee',
            name: 'adgent_fee',
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


 $("select[name='advertiser_type']").on("change", function() {
      var url = $(this).val();
      let selectedText = $(this).find(':selected').text();
      $('.rep_type').text(selectedText);
      table.ajax.url(url).load();
   });


   $(document).ready(function () {
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
});
     

$(document).ready(function () {

    $(document).on('click', '.open-summary-modal', function (e) {
        e.preventDefault();
        
        let purchaseId = $(this).data('id');
        let url = "{{ route('agent.profile_summary', ':id') }}".replace(':id', purchaseId);

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
              
                $('#profile_summary').remove();
            },
            success: function (response) {
                if (response.status === 'success') {
                    // Append new modal HTML to body
                    $('body').append(response.html);

                    // Trigger/Open Bootstrap Modal
                    $('#profile_summary').modal('show');
                }
            },
            error: function (xhr) {
                console.error('Failed to load profile summary modal:', xhr);
            }
        });
    });

   
    $(document).on('hidden.bs.modal', '#profile_summary', function () {
        $(this).remove();
    });



    $('#print_report').on('click', async function () {

        let fromDate = $('#fromDate').val();
        let toDate = $('#toDate').val();

        if (!fromDate) {
            $('#fromDate').focus();
            swal_error_warning('Profile Report','Please select From date.');
            return;
        }

        if (!toDate) {
            $('#toDate').focus();
            swal_error_warning('Profile Report','Please select To date.');
            return;
        }

        if (fromDate > toDate) {
            swal_error_warning('Profile Report','From date cannot be greater than To date.');
            $('#fromDate').focus();
            return;
        }

        let url = $('#advertiserFilter').val();
        let advertiserType = url.split('/').pop();

        let requestUrl = "{{ route('agent.generate_profile_pdf', ['id' => '__TYPE__']) }}"
            .replace('__TYPE__', advertiserType) + `?from_date=${fromDate}&to_date=${toDate}`;

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
                let blob = await response.blob();
                let pdfUrl = URL.createObjectURL(blob);
                window.open(pdfUrl, '_blank');
                return;
            }

            let data = await response.json();
            if (data.errors) {
                let firstKey = Object.keys(data.errors)[0];
                swal_error_warning(data.errors[firstKey][0]);
            } else {
                swal_error_warning('Profile Report', data.message || 'Unable to generate report.');
            }

        } catch (error) {
            console.error('Report Generation Error:', error);
            swal_error_warning('Profile Report', 'Something went wrong. Please try again.');
        }
    });                          


});
</script>
@endpush
