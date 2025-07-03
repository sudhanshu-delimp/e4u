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
</style>
@endsection
@section('content')
<div class="container-fluid">
    <!--middle content-->
    <div class="row">
        <div class="col-md-12">
            <div class="v-main-heading">
                <h1> Advertiser Reports <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                        style="font-size:16px"><b>Help?</b> </span></h1>
            </div>
            <div class=" my-4">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>Reports are a consolidation of reports on Advertisers <strong>(Report)</strong>.</li>
                            <li>When a Report has been made about an Advertiser, place the Advertiser status on
                            ‘Suspended’ until the Report is resolved.</li>
                            <li>The Operations Team will assess the Report that has been made by the Viewer
                            regarding an Advertiser (usually an Escort) and produce the results to management
                            for a decision.</li>
                            <li>Where the decision is to:</li>
                            <ol  class="level-2">
                                <li>
                                    Cancel the Advertiser’s Membership, place the status on ‘Cancelled’
                                </li>
                                <li>
                                    Re-instate the Advertiser’s membership, place the status on ‘Registered’
                                </li>
                            </ol>
                            <p>then the Console will generate emails to the Member notifying accordingly the
                            outcome.</p>
                        </ol>

                    </div>
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
            <div class="row my-3">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <form class="search-form-bg navbar-search">
                        <div class="input-group">
                            <input type="text" class="search-form-bg-i form-control border-0 small"
                                placeholder="Search " aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn-right-icon" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="col-lg-8 col-md-12 col-sm-12 d-flex justify-content-end" style="gap: 50px;">
                  
                    <div class="total_listing">
                        <div><span>Total Listings : </span></div>
                        <div><span>4,456</span></div>
                    </div>
                </div> -->
            </div>
            <div class="table-responsive">
                <table class="table">
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
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-content">
                        <tr class="row-color">
                            <td width="10%" class="theme-color">123</td>
                            <td class="theme-color">25-05-2025</td>
                            <td class="theme-color">E60110</td>
                            <td class="theme-color">1438 028 733</td>
                            <td class="theme-color">WA</td>
                            <td class="theme-color">Current</td>
                            <td>
                                <div class="dropdown no-arrow ml-3">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>

                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                                        Current 
                                        <i class="fa fa-hourglass-half text-dark" ></i>
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="#"  data-toggle="modal" data-target="#confirm-popup">
                                        Resolved 
                                        <i class="fa fa-check-circle text-dark"></i>
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                                        View 
                                        <i class="fa fa-eye text-dark"></i>
                                    </a>
                                    </div>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination float-right pt-4">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">»</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="my-account-card">
                <div class="card-head">                    
                    <h2>My Report Information </h2>
                    <button class="print-btns" onclick="window.print()"><i class ="fa fa-print"></i> Print Report</button>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Member ID</label>
                        <span>M60178</span>
                    </div>
                    <div class="info-item">
                        <label>Member</label>
                        <span>Lins Massage</span>
                    </div>
                    <div class="info-item">
                        <label>IP Address</label>
                        <span>123.176.113.164</span>
                    </div>
                    <div class="info-item">
                        <label>Platform</label>
                        <span>Firefox</span>
                    </div>
                    <div class="info-item">
                        <label>Page</label>
                        <span>/escort-dashboard</span>
                    </div>
                    <div class="info-item">
                        <label>Listed Profiles (Escort)</label>
                        <span>08</span>
                    </div>
                    <div class="info-item">
                        <label>Published Masseurs (Massage Centre)</label>
                        <span>02</span>
                    </div>
                    <div class="info-item">
                        <label>Listed Advertisers (Agent)</label>
                        <span>01</span>
                    </div>
                    <div class="info-item">
                        <label>Legboxes (Viewer)</label>
                        <span>04</span>
                    </div>
                </div>
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
                            <th colspan="2" style="width: 30%;"><input type="checkbox"> Cancel Membership</th>
                            <th colspan="2" style="width: 30%;"><input type="checkbox"> Re-instate Membership</th>
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

<script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script>
<script>
CKEDITOR.replace('editor1', {
    fullPage: true,
    extraPlugins: 'docprops',
    // Disable content filtering because if you use full page mode, you probably
    // want to  freely enter any HTML content in source mode without any limitations.
    allowedContent: true,
    height: 320
});
</script>
@endsection
@push('script')
@endpush