@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
.parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
}

#cke_1_contents {
    height: 150px !important;
}
/* table td,th{
    border-top: 0px !important;
    border: none;
}

table td,th{
    border-top: 0px !important;
    border: none;
} */
 .paging_simple_numbers{
    margin-top: 18px;
 }
 /* .dataTables_info{
    margin-top: 18px;
 } */
.table-report-info tr td{
    border: 0;
}
.table-report-info th{
    border-top: 0px solid #dee2e6 !important;
}

.popu_heading_style {
    font-family: Poppins;
    font-style: normal;
    font-weight: 500;
    font-size: 20px;
    line-height: 29px;
    color: #0C223D;
}
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content-->
    <div class="row">
        <div class="custom-heading-wrapper col-md-12">
            <h1 class="h1"> Advertiser Reports </h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                    style="font-size:16px"><b>Help?</b> </span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                    <ol>
                        <li>Reports are a consolidation of reports on Advertisers <span style="font-weight:400;color: #555;">(</span><b>Report</b><span style="font-weight:400;color: #555;">)</span>.</li>
                        <li>When a Report has been made about an Advertiser, place the Advertiser status on
                        'Suspended' until the Report is resolved.</li>
                        <li>The Operations Team will assess the Report that has been made by the Viewer
                        regarding an Advertiser (usually an Escort) and produce the results to management
                        for a decision.</li>
                        <li>Where the decision is to:</li>
                        <ol  class="level-2">
                            <li>
                                Cancel the Advertiser's Membership, place the status on 'Cancelled',
                            </li>
                            <li>
                                Re-instate the Advertiser's membership, place the status on 'Registered',
                            </li>
                        </ol>
                        <p>then the Console will generate emails to the Member notifying accordingly the
                        outcome.</p>
                    </ol>

                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="stats-container">
                <div class="stat-card-wrapper">
                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon"><i class="fas fa-calendar-day"></i></div>
                            <div class="stat-label">Today</div>
                        </div>
                        <div class="stat-number">{{$reports['today']}}</div>
                    </div>
    
                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon"><i class="fas fa-calendar-week"></i></div>
                            <div class="stat-label">This Month</div>
                        </div>
                        <div class="stat-number">{{$reports['month']}}</div>
                    </div>
    
                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                            <div class="stat-label">This Year</div>
                        </div>
                        <div class="stat-number">{{$reports['year']}}</div>
                    </div>
    
                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                            <div class="stat-label">All Time</div>
                        </div>
                        <div class="stat-number">{{$reports['all_time']}}</div>
                    </div>
                </div>
            </div> 
        </div>                             

        <div class="col-sm-12 col-md-12 col-lg-12 ">           
            <div class="table-responsive custom-badge">
                <table class="table" id="AdvertiserReportTable" style="width: 100%">
                    <thead class="table-bg">
                        <tr>
                            <th scope="col">
                            Ref

                            </th>
                            <th scope="col">
                            Date

                            </th>
                            <th scope="col">
                            Member ID
                            </th>
                            <th scope="col">
                            Mobile
                            </th>
                            <th scope="col">Home State</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-content">
                        
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="col-md-12" id="print-advertiser-report">
            <div class="my-account-card">
                <div class="card-head">                    
                    <h2 class="font-weight-bold">My Report Information </h2>
                    <button class="print-btns"  type="button"><i class ="fa fa-print"></i> Print Report</button>
                    <input type="hidden" id="printReportId" value="">
                </div>
                <table class="table  w-100 table-report-info"> 
                    <tr class="details-row">
                        <td colspan="7">
                          <div>
                            <table class="table border-0 table-report-info">
                              <tbody>
                                <tr >
                                  <th>Ref:</th>
                                  <td class="report_ref">#30</td>
                                  <th>Date:</th>
                                  <td class="report_date">14-05-2025</td>
                                </tr>
                                <tr>
                                  <th>Advertiser ID:</th>
                                  <td class="report_member_id">14-05-2025</td>
                                  <th>Viewer ID:</th>
                                  <td class="report_viewer_id">14-05-2025</td>
                                  {{-- <td class="report_escort_id">14-05-2025</td> --}}
                                  
                                </tr>
                                <tr>
                                  <th>Mobile :</th>
                                  <td class="report_mobile">WA - Perth</td>
                                  <th>Mobile:</th>
                                  <td class="report_viewer_mobile">Adrian Weinstein</td>
                                  
                                </tr>
                              
                                <tr>
                                  
                                  <th>Home State:</th>
                                  <td  class="report_home_state">WA</td>
                                  <th>Status:</th>
                                  <td colspan="3" class="report_status">Current</td>
                                </tr>
                                <tr>
                                  <th>Comments:</th>
                                  <td colspan="3" class="report_comment">Great service, very polite.</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </td>
                      </tr>
                </table>
                <div class="notes-section">
                    <div class="notes-label">Notes:</div>
                    <div class="lines"></div>
                    <div class="lines"></div>
                    <div class="lines"></div>
                    <div class="lines"></div>
                    <div class="lines"></div>
    
                    <div class="mt-5 table-responsive">
                    <table style="width:100%; border-collapse:collapse;">
                        <tr>
                            <td colspan="2" style="border:1px solid #000; padding:8px; font-weight:bold;">Management only:</td>
                            <td colspan="2" style="border:1px solid #000; padding:8px;">
                            <label style="display:inline-flex; align-items:center; gap:6px; margin:0;">
                                <input type="checkbox" style="margin:0;"> <span style="font-weight:600;">Cancel Membership</span>
                            </label>
                            </td>
                            <td colspan="2" style="border:1px solid #000; padding:8px;">
                            <label style="display:inline-flex; align-items:center; gap:6px; margin:0;">
                                <input type="checkbox" style="margin:0;"> <span style="font-weight:600;">Re-instate Membership</span>
                            </label>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="1" style="border:1px solid #000; padding:25px 12px; font-weight:bold; width:110px;" colspan="1">Name:</td>
                            <td colspan="2" style="border:1px solid #000; padding:25px 12px;"></td>
                            <td colspan="1" style="border:1px solid #000; padding:25px 12px; font-weight:bold; width:120px">Signature:</td>
                            <td colspan="2" style="border:1px solid #000; padding:25px 12px;"></td>
                        </tr>
                    </table>



                    </div>
    
                </div>
            </div>

        </div>
    </div>
</div>

<!--middle content end here-->
<!--right side bar start from here-->
</div>
<!--right side bar end-->
</div>
<div class="modal fade upload-modal" id="confirm-popup" tabindex="-1" role="dialog" aria-labelledby="confirmPopupLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header border-0">
                <input type="hidden" id="status_data_id">
                <input type="hidden" id="status_data_value">
                <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                    <img src="{{ asset('assets/dashboard/img/question-mark.png') }}" alt="resolved"  class="custompopicon">
                    <span>Confirmation</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>

            <div class="modal-body pb-0 teop-text text-center">
                <h6 class="popu_heading_style mt-2">
                    <span id="Lname">Are you sure you want to perform this action.</span>
                </h6>

            </div>

            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">Cancel</button>
                <button type="button" class="btn-success-modal saveStatus" data-dismiss="modal" aria-label="Close">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade upload-modal" id="success_popup" tabindex="-1" role="dialog" aria-labelledby="confirmPopupLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header border-0">
                <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                    <img src="{{ asset('assets/dashboard/img/unblock.png') }}" alt="resolved"  class="custompopicon">
                    <span class="success-modal-title">Resolved</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>

            <div class="modal-body pb-0 teop-text text-center">
                <h6 class="popu_heading_style mt-2">
                    <span class="Lname success-modal-text">We’re happy to inform you that your query has been <br> successfully resolved.</span>
                </h6>

            </div>

            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="button" class="btn-success-modal" data-dismiss="modal" aria-label="Close">OK</button>
            </div>
        </div>
    </div>
</div>


 {{-- add notes  --}}
<div class="modal fade upload-modal" id="add-note-popup" tabindex="-1" role="dialog" aria-labelledby="confirmPopupLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header border-0">
                <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                    <img src="{{ asset('assets/dashboard/img/add-task.png') }}" alt="resolved"  class="custompopicon">
                    Add Note
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>

           <div class="modal-body">
                <form>
                    <!-- Notes -->
                    <div class="form-group mb-3">
                        <label for="notes"><strong>Notes:</strong></label>
                        <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="Enter notes here..."></textarea>
                    </div>

                    
                    <!-- Name -->
                    <div class="form-group mb-3">
                        <label for="name"><strong>Name:</strong></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter name">
                    </div>

                    <!-- Signature -->
                    <div class="form-group mb-3">
                        <label for="signature"><strong>Signature:</strong></label>
                        <input type="text" id="signature" name="signature" class="form-control" placeholder="Enter signature">
                    </div>
                    <!-- Management Only Section -->
                    <div class="form-group mb-3 d-flex align-items-center justify-content-start gap-10">
                        <label><strong>Management Only:</strong></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="cancelMembership" name="management_action" value="cancel">
                            <label class="form-check-label" for="cancelMembership">Cancel Membership</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="reinstateMembership" name="management_action" value="reinstate">
                            <label class="form-check-label" for="reinstateMembership">Re-instate Membership</label>
                        </div>
                    </div>


                </form>
            </div>

            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="button" class="btn-cancel-modal px-4" data-dismiss="modal" aria-label="Close">Cancel</button>
                <button type="button" class="btn-success-modal px-4" data-dismiss="modal" aria-label="Close">Submit</button>
            </div>
        </div>
    </div>
</div>
{{-- end notes --}}

@endsection
@push('script')

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    
<script>
$(document).ready(function() {
    $(document).on('click', '.print-btns', function(e) {
        e.preventDefault();
        
        var printReportId = $("#printReportId").val();
        var printUrl = "{{route('admin.print.single-member-reports')}}?report_id="+printReportId;
        location.href = printUrl;
    });

    $("#print-advertiser-report").slideUp();

    $(document).on('click', '.view_member_report', function(e) {
        e.preventDefault();

        // Get the data-id value
        var reportId = $(this).data('id');
        $("#printReportId").val(reportId);
        console.log("Report ID:", reportId); 
        let routeUrl = '{{route("admin.single-member-reports.ajax")}}';
        $("#print-advertiser-report")
        .stop(true, true) // stop any current animation
        .slideUp(0)       // instantly hide
        .slideDown(800);  // slide down again

        $('html, body').animate({
            scrollTop: $("#print-advertiser-report").offset().top
        }, 500); // 500ms for smooth scroll

        viewMemberReportAjax(reportId, routeUrl);
        
    });

    $(document).on('click', '.update-member-status', function(e) {
        e.preventDefault();
        let reportId = $(this).data('id');
        let status = $(this).data('val');

        $('#status_data_id').val(reportId);
        $('#status_data_value').val(status);

        //$("#success-popup").modal('show');

        console.log(reportId, status);
        
        
    });

    $(document).on('click', '.saveStatus', function(e) {
        e.preventDefault();
        let reportId = $('#status_data_id').val();
        let status = $('#status_data_value').val();
        var reportData = {
            'reportId' :reportId,
            'status' :status,
        }
        
        var url = "{{route('admin.advertiser.report-status')}}";
        updateMemberReportStatus(reportData, url);
    });

    function updateMemberReportStatus(reportData, routeUrl)
    {
        const reportId = $(this).data('id');

        $.ajax({
            url: routeUrl, // replace with your actual route
            method: 'POST',
            data:{
                'report_id':reportData.reportId,
                'status':reportData.status,
            },
            success: function(response) {
                if(response.error == false){
                    if(response.member_status == 'resolved'){
                        $(".success-modal-title").text('Resolved');
                        $(".success-modal-text").text('We’re happy to inform you that your query has been successfully resolved.');

                    }else{
                        $(".success-modal-title").text('Current');
                        $(".success-modal-text").text('We’re happy to inform you that we are currently working on your report.');
                    }

                    $('#AdvertiserReportTable').DataTable().ajax.reload(null, false);
                    // $("#success_popup").modal('show');
                    var myModal = new bootstrap.Modal(document.getElementById('success_popup'));
                    myModal.show();
                    // alert('sdfd');
                }
            },
            error: function(xhr) {
                console.error('Failed to fetch data');
                $('#view-listing .modal-body').html('<p class="text-danger">Error loading data...</p>');
            }
        });
    }

    function capitalizeFirstLetter(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    function viewMemberReportAjax(report_id, routeUrl)
    {
        const reportId = $(this).data('id');

        $.ajax({
            url: routeUrl, // replace with your actual route
            method: 'GET',
            data:{
                'report_id':report_id
            },
            success: function(response) {
                if(response.error == false){
                    let status = (response.data.report_status == 'pending') ? 'Current' : response.data.report_status;
                    $(".report_ref").text('#'+response.data.id +''+ response.data.escort_id);
                    $(".report_date").text(response.data.formatted_created_at);
                    $(".report_member_id").text(response.data.escort.user.member_id);
                    $(".report_escort_id").text(response.data.escort_id);
                    $(".report_viewer_id").text(response.data.viewer_id);
                    $(".report_status").text(capitalizeFirstLetter(status));
                    $(".report_home_state").text(response.data.escort.user.state_id);
                    $(".report_comment").text(capitalizeFirstLetter(response.data.report_desc));
                    $(".report_mobile").text(response.data.escort.user.phone);
                    $(".report_viewer_mobile").text(response.data.viewer.phone);
                }
            },
            error: function(xhr) {
                console.error('Failed to fetch data');
                $('#view-listing .modal-body').html('<p class="text-danger">Error loading data...</p>');
            }
        });
    }

    ajaxReload('AdvertiserReportTable', "{{ route('admin.advertiser-reports.ajax') }}",'GET')
 
    function ajaxReload(tableId, ajaxUrl, method)
    {
        var table = $('#'+tableId).DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Member ID"
            },
            processing: true,
            serverSide: true,
            paging: true,
            info: true,
            searching: true,
            bStateSave: true,
           // ordering: false,
            ajax: {
                url: ajaxUrl,
                type: method,
                dataSrc: function(json) {
                    return json.data;
                }
            },
                drawCallback: function (settings) {
            },
            columns: [
                { data: 'ref', name: 'ref' },
                { data: 'date', name: 'date' },
                { data: 'member_id', name: 'member_id' },
                { data: 'mobile', name: 'mobile' },
                { data: 'home_state', name: 'home_state' },
                { data: 'status', name: 'status'},
                { data: 'action', name: 'action', orderable: false, class: 'text-center' }
            ]
        });
    }

});
    
</script>
@endpush