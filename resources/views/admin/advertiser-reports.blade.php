@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
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
.table-report-info tr td{
    border: 0;
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
                        <li>Reports are a consolidation of reports on Advertisers (<b>Report</b>).</li>
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
            <div class="table-responsive">
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
        
        <div class="col-md-12">
            <div class="my-account-card print-advertiser-report">
                <div class="card-head">                    
                    <h2 class="font-weight-bold">My Report Information </h2>
                    <button class="print-btns" onclick="window.print()" type="button"><i class ="fa fa-print"></i> Print Report</button>
                </div>
                <table class="table  w-100 table-report-info"> 
                    <tr class="details-row">
                        <td colspan="7">
                          <div>
                            <table class="table border-0 table-report-info">
                              <tbody>
                                <tr >
                                  <th>Our Ref:</th>
                                  <td>#30</td>
                                  <th>Date:</th>
                                  <td>14-05-2025</td>
                                </tr>
                                <tr>
                                  <th>Escort ID:</th>
                                  <td>14-05-2025</td>
                                  <th>Viewer ID:</th>
                                  <td>WA - Perth</td>
                                </tr>
                                <tr>
                                  <th>Mobile:</th>
                                  <td>Adrian Weinstein</td>
                                  <th>Status:</th>
                                  <td>Current</td>
                                </tr>
                              
                                <tr>
                                  <th>Comments:</th>
                                  <td colspan="3">Great service, very polite.</td>
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
    
                    <div class="manage-table table-responsive">
                        <table>
                            <tr style="">
                                <th colspan="1" style="width: 30%;" class="pb-3">Management only:</th>
                                <th colspan="2" style="width: 30%;" class="pb-3"><input type="checkbox"> Cancel Membership</th>
                                <th colspan="2" style="width: 30%;" class="pb-3"><input type="checkbox"> Re-instate Membership</th>
                            </tr>
                            <tr>
                                <td style="width: 25%;">Name:</td>
                                <td style="width: 25%;"></td>
                                <td style="width: 25%;">Signature:</td>
                                <td style="width: 25%;"></td>
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
                <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                    <img src="{{ asset('assets/dashboard/img/unblock.png') }}" alt="resolved"  class="custompopicon">
                    Resolved
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>

            <div class="modal-body text-center">
                <p style="font-size: 16px; color: #333; font-weight: 500;">We’re happy to inform you that your query has been <br> successfully resolved.</p>

            </div>

            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="button" class="btn btn-danger px-4" data-dismiss="modal" aria-label="Close">OK</button>
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
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}
    "></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
//       var table = $("#AdvertiserReportTable").DataTable({
//       language: {
//          search: "Search: _INPUT_",
//          searchPlaceholder: "Search by Member ID..."
//       },
//       info: true,
//       paging: true,
//       lengthChange: true,
//       searching: true,
//       bStateSave: true,
//       pageLength: 10
//    });

    ajaxReload('AdvertiserReportTable', "{{ route('admin.advertiser-reports.ajax') }}",'GET')
 
    function ajaxReload(tableId, ajaxUrl, method)
    {
        var table = $('#'+tableId).DataTable({
            processing: true,
            serverSide: true,
            paging: true,
            info: true,
            searching: true,
            bStateSave: true,
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
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false }
            ]
        });
    }

    
</script>
@endpush