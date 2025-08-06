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
table td,th{
    border-top: 0px !important;
    border: none;
}
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content-->
    <div class="row">
        <div class="custom-heading-wrapper col-md-12">
            <h1 class="h1"> Advertiser Reviews </h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                    style="font-size:16px"><b>Help?</b> </span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                    <ol>
                        <li>Reviews are a consolidation of reviews on Advertisers (<b>Review</b>).</li>
                        <li>When a Review has been made about an Advertiser, the Review remains pending
                            until approved.</li>
                        <li>The Operations Team will assess the Review that has been made by the Viewer
                            regarding an Advertiser (usually an Escort) and produce any adverse results to
                            management for a decision.</li>
                        <li>Where the decision is to:</li>
                        <ol  class="level-2">
                            <li>
                                Reject the Review, place the Review status on ‘Rejected’; or
                            </li>
                            <li>
                                Approve the Review, place the status on ‘Approved’,
                            </li>
                        </ol>
                        <p>then the Console will generate emails to the Members notifying them accordingly of
                            the outcome.</p>
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
                        <div class="stat-number">2</div>
                    </div>
    
                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon"><i class="fas fa-calendar-week"></i></div>
                            <div class="stat-label">This Month</div>
                        </div>
                        <div class="stat-number">25</div>
                    </div>
    
                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                            <div class="stat-label">This Year</div>
                        </div>
                        <div class="stat-number">125</div>
                    </div>
    
                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                            <div class="stat-label">All Time</div>
                        </div>
                        <div class="stat-number">1,258</div>
                    </div>
                </div>
            </div> 
        </div>                             

        <div class="col-sm-12 col-md-12 col-lg-12 ">
            
            <div class="table-responsive">
                <table class="table w-100" id="advertiserReviewTable">
                    <thead class="table-bg" >
                        <tr>
                            <th scope="col">
                            Ref

                            </th>
                            <th scope="col">
                            Date

                            </th>
                            <th scope="col">
                            Escort ID
                            </th>
                            <th scope="col">Viewer ID</th>
                            <th scope="col">
                            Mobile
                            </th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-content">
                        <tr class="row-color">
                            <td width="10%" class="theme-color">123</td>
                            <td class="theme-color">25-05-2025</td>
                            <td class="theme-color">E60110</td>
                            <td class="theme-color">V60110</td>
                            <td class="theme-color">12021021521</td>
                            <td class="theme-color">Current</td>
                            <td class="text-center">
                                <div class="dropdown no-arrow ml-3">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>

                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    
                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#">
                                       
                                        <i class="fa fa-hourglass-half text-dark" ></i> Pending 
                                    </a>
                                    
                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#"  data-toggle="modal" data-target="#confirm-popup">
                                        
                                        <i class="fa fa-check-circle text-dark"></i>Published
                                    </a>
                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#"  data-toggle="modal" data-target="#confirm-popup">
                                        
                                        <i class="fa fa-ban text-dark"></i>Rejected
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#">
                                       
                                        <i class="fa fa-eye text-dark"></i> View 
                                    </a>
                                    </div>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="my-account-card">
                <div class="card-head">                    
                    <h2 class="font-weight-bold">My Review Information </h2>
                    <button class="print-btns" onclick="window.print()" type="button"><i class ="fa fa-print"></i> Print Report</button>
                </div>
                <table class="table  w-100"> 
                    <tr class="details-row">
                        <td colspan="7">
                          <div>
                            <table class="table border-0">
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
            </div>
            
            <div class="notes-section">
                <div class="notes-label">Notes:</div>
                <div class="lines"></div>
                <div class="lines"></div>
                <div class="lines"></div>
                <div class="lines"></div>
                <div class="lines"></div>

                <div class="manage-table table-responsive">
                    <table>
                        <tr>
                            <th colspan="1" style="width: 30%;">Management only:</th>
                            <th colspan="2" style="width: 30%;"><input type="checkbox"> Reject Review</th>
                            <th colspan="2" style="width: 30%;"><input type="checkbox"> Publish Review</th>
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
                    <img src="{{ asset('assets/app/img/resolved.png') }}" alt="alert" style="width: 24px; margin-right: 8px;">
                    Published
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
                <button type="button" class="btn-success-modal px-4" data-dismiss="modal" aria-label="Close">OK</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
   var table = $("#advertiserReviewTable").DataTable({
    language: {
        search: "Search: _INPUT_",
        searchPlaceholder: "Search by Escort ID or Viewer ID..."
    },
    info: true,
    paging: true,
    lengthChange: true,
    searching: true,
    bStateSave: true,
    order: [[1, 'desc']],
    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
    pageLength: 10
});

 </script>
@endpush