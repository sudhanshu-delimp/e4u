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
                            <h1 class="h1">Listing
                                Summary </h1>
                            <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes"
                                aria-expanded="true">Help?</span>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="card collapse" id="notes" style="">
                                <div class="card-body">
                                   <h3 class="NotesHeader"><b>Notes:</b></h3>
                                    <ol>
                                        <li>This report provides information associated with all of your Listings (excluding Tours).</li>
                                        <li>
                                            It is a summary of your Advertisers Listed Profiles and revenue (Fees) you have earned.
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
                            <button class="btn-common mr-0 printReport" type="button" 
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


    <!-- Modal for displaying PDF report -->
   <div class="modal fade upload-modal programmatic" id="listingReportModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 60%; width: 60%;">
        <div class="modal-content">
           <div class="modal-header">
                    <h5 class="modal-title text-white">
                        <img src="{{ asset('assets/dashboard/img/admin-report.png') }}" class="custompopicon"
                            alt="cross">
                       Listing Report -  <span class="listing_report"></span>
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
            <div class="modal-body p-4" id="printableReportArea">
                <style>
                    .listing-table {
                        width: 100%;
                        border-collapse: collapse;
                        font-family: Arial, sans-serif;
                    }
                    .listing-table th {
                        background-color: #0d2a4a;
                        color: #ffffff;
                        font-weight: bold;
                        padding: 10px;
                        font-size: 13px;
                        text-align: center;
                        border: 1px solid #0d2a4a;
                    }
                    .listing-table td {
                        padding: 8px 10px;
                        font-size: 13px;
                        text-align: center;
                        border: 1px solid #cccccc;
                        color: #333333;
                    }
                    .report-title-header {
                        text-align: center;
                        color: #0d2a4a;
                        font-weight: 800;
                        margin-bottom: 25px;
                        font-size: 22px;
                    }
                </style>

               

                <div class="table-responsive">
                    <table class="listing-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Member ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Days</th>
                                <th>Pin Up</th>
                                <th>Listing Fee</th>
                                <th>Agent Fee</th>
                            </tr>
                        </thead>
                        <tbody id="listingReportBody">
                            <!-- Injected dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
               
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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


    $(document).on('click', '.open-activity-modal', function (e) {
        e.preventDefault();
        
        let purchaseId = $(this).data('id');
        let profile_id = $(this).data('profile_id');
        let advertiser_type = $(this).data('advertiser_type');
        let url = "{{ route('agent.activity_summary', ':id') }}".replace(':id', purchaseId);

        $.ajax({
            url: url,
            type: 'GET',
            data: {
            advertiser_type: advertiser_type,
            profile_id : profile_id,
            _t: new Date().getTime()
            },
            dataType: 'json',
            beforeSend: function () {
              
               $('#profile_activity_summury, #profile_activity_summary').remove();
               $('.modal-backdrop').remove();
            },
            success: function (response) {
                if (response.status === 'success') {
                    // Append new modal HTML to body
                    $('body').append(response.html);
                    $('#profile_activity_summury').modal('show');
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

    if (!fromDate || !toDate) {
        swal_error_warning('Profile Report', 'Please select both From and To dates.');
        return;
    }

    let url = $('#advertiserFilter').val();
    let advertiserType = url ? url.split('/').pop() : 'escort';

    let requestUrl = "{{ route('agent.generate_profile_pdf', ['id' => '__TYPE__']) }}"
        .replace('__TYPE__', advertiserType) + `?from_date=${fromDate}&to_date=${toDate}&format=json`;

    $btn.prop('disabled', true).text('Loading...');
     swal_waiting_popup({
               'title': 'Fetching Report...'
            });

    $.ajax({
        url: requestUrl,
        type: 'GET',
        dataType: 'json',
        success: function (res) {
            Swal.close();
            $btn.prop('disabled', false).text('View Report');

            if (!res.status) {
                swal_error_warning('Profile Report', res.message || 'Unable to load report.');
                return;
            }
           
            let res_type = res.advertiserType;
            $('.listing_report').text(res.advertiserType);$('#reportTypeTitle').text(res.advertiserType);
            let html = '';
            if (res.data && res.data.length) {
                res.data.forEach((item, index) => {
                    let profile = item.escort || item.massage_profile || {};
                    let paymentInfo = item.payment_items && item.payment_items.payment ? item.payment_items.payment : {};

                                    

                    let memberId = item.member_id || '-';
                    let name = item.member_name ||  '-';
                    let mobile = item.member_mobile || '-';
                    let startDate = item.start_date || '-';
                    let endDate = item.end_date || '-';
                    let isPinUp ="";

                    if(res_type!='Massage Centre')
                    {
                         isPinUp = (profile.pinup && profile.pinup.length > 0) ? 'Yes' : 'No';
                    }
                    else
                    {
                          isPinUp = 'NA';
                    }
                    
                    let totalDays = item.total_days || '-';

                    let listingFee = parseFloat(item.paid_rate || item.total_rate || 0);
                    let agentCommissionPercent = parseFloat(paymentInfo.agent_commission_percent || 0);
                    let agentFee = (listingFee * agentCommissionPercent) / 100;

                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${memberId}</td>
                            <td>${name}</td>
                            <td>${mobile}</td>
                            <td>${startDate}</td>
                            <td>${endDate}</td>
                            <td>${totalDays}</td>
                            <td>${isPinUp}</td>
                            <td><div class="num_value">$<span>${listingFee.toFixed(2)}</span></div> </td>
                            <td><div class="num_value">$<span>${agentFee.toFixed(2)}</span></div></td>
                        </tr>
                    `;
                });
            } else {
                html = `<tr><td colspan="9" class="text-center">No record found.</td></tr>`;
            }

            $('#listingReportBody').html(html);
            $('#listingReportModal').modal('show');
        },
        error: function (xhr) {
             Swal.close();
            $btn.prop('disabled', false).text('View Report');
            let err = xhr.responseJSON ? xhr.responseJSON.message : 'Something went wrong.';
            swal_error_warning('Profile Report', err);
        }
    });
   });  
   // ########### End Pdf Report ##################                                 


    $('.printReport').on('click', function () {
         $('#printReport').modal('show');                               
    });

                                        

});





   



</script>
@endpush
