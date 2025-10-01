
@extends('layouts.escort')
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
    <!--middle content start here-->
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">View Reviews</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <p></p>
                        <ol>
                            <li>View your published Reviews here.</li>
                            <li>Simply click the ‘View’ button to see what the Viewer has written about you.</li>
                            <li>Your Reviews will appear on all of your Profiles unless you disable them.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    <!--middle content end here-->
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

        <div class="col-lg-12">
            <div class="table-responsive custom-badge">
                <table class="table" id="EscortReviewTable" style="width: 100%">
                    <thead class="table-bg">
                        <tr>
                            <th>Ref</th>
                            <th>Date</th>
                            <th>Rating</th>
                            <th style="width: 100px;">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- === Row 1 === -->
                        <tr>
                            <td>125</td>
                            <td>25-05-2025</td>
                            <td>
                                <div class="escort-ratings">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="far fa-star"></i></li>
                                    <li><i class="far fa-star"></i></li>
                                    <li><i class="far fa-star"></i></li>
                                </div>
                            </td>
                            <td> <span class="badge badge-success">Published </span></td>
                            <td class="text-center">
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        
                                        <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal"
                                            data-target="#confirm-popup" href="#">
                                            <i class="fa fa-check-circle "></i> Published
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal"
                                            data-target="#confirm-popup" href="#">
                                            <i class="fa fa-user-slash"></i> Suspended
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="view_member_report dropdown-item d-flex align-items-center gap-10 toggle-report"
                                            href="#" data-id="1436">
                                            <i class="fa fa-eye mr-2"></i> View
                                        </a>
                                    </div>
                                </div>
                            </td>
                           
                        </tr>

                        <!-- === Row 2 === -->
                        <tr>
                            <td>124</td>
                            <td>20-05-2025</td>
                            <td>
                                <div class="escort-ratings">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li> 
                                    <li><i class="far fa-star"></i></li>
                                    <li><i class="far fa-star"></i></li>
                                </div>
                            </td>
                            <td><span class="badge badge-danger">Suspended</span></td>
                            <td class="text-center">
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        
                                        <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal"
                                            data-target="#confirm-popup" href="#">
                                            <i class="fa fa-check-circle "></i> Published
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal"
                                            data-target="#confirm-popup" href="#">
                                            <i class="fa fa-user-slash"></i> Suspended
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="view_member_report dropdown-item d-flex align-items-center gap-10 toggle-report"
                                            href="#" data-id="1436">
                                            <i class="fa fa-eye mr-2"></i> View
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
       
    </div>
</div>

<!--middle content end here-->
<!--right side bar start from here-->
</div>
<!--right side bar end-->
</div>



{{-- published modal --}}
<div class="modal fade upload-modal" id="confirm-popup" tabindex="-1" role="dialog" aria-labelledby="confirmPopupLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header border-0">
                <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                    <img src="{{ asset('assets/dashboard/img/published.png') }}" alt="published" class="custompopicon">
                    Published
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>

            <div class="modal-body text-center">
                <p style="font-size: 16px; color: #333; font-weight: bold;">We’re happy to inform you that your query has been <br> successfully resolved.</p>

            </div>

            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="button" class="btn-success-modal px-4" data-dismiss="modal" aria-label="Close">OK</button>
            </div>
        </div>
    </div>
</div>


{{-- rejected modal --}}
<div class="modal fade upload-modal" id="rejected-popup" tabindex="-1" role="dialog" aria-labelledby="rejectedPopupLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header border-0">
                <h5 class="modal-title d-flex align-items-center" id="rejectedPopupLabel">
                    <img src="{{ asset('assets/dashboard/img/rejected.png') }}" alt="rejected" class="custompopicon">
                    Rejected
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>

            <div class="modal-body text-center">
                <p style="font-size: 16px; color: #333; font-weight: bold;">We’re inform you that your query has been <br> Rejected.</p>

            </div>

            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="button" class="btn-success-modal px-4" data-dismiss="modal" aria-label="Close">OK</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')

@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
  
    <script>
        $(document).ready(function () {
    var table = $('#EscortReviewTable').DataTable({
        language: {
            search: "Search: _INPUT_",
            searchPlaceholder: "Search by Member ID"
        },
        paging: true,
        order: [[0, 'desc']]
    });

    // Toggle child rows
    $('#EscortReviewTable tbody').on('click', '.toggle-report', function (e) {
        e.preventDefault();
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var dataId = $(this).data("id");

        if (row.child.isShown()) {
            row.child.hide();
            $(this).html('<i class="fa fa-eye mr-2"></i> View');
        } else {
            // Replace below with dynamic HTML if needed
            var childHtml = `
                <div class="card p-3">
                    <h5 class="font-weight-bold text-blue-primary">Review Details</h5>
                    <table class="table mb-0">
                        <tr>
                            <th>Ref:</th><td class="border-0">${dataId}</td>
                            <th>Escort ID:</th><td class="border-0">V40161</td>
                        </tr>
                       
                        <tr>
                            <th>Mobile:</th>
                            <td class="border-0">5438 111 222</td>
                             <th>Escort’s Name:</th>
                            <td class="border-0">A126</td>
                        </tr>
                        <tr>
                            
                            <th>Home State:</th>
                            <td class="border-0">NSW</td>
                            <th>Status:</th>
                            <td class="border-0">Published</td>
                        </tr>
                        <tr>
                            <th>Comments:</th>
                            <td class="border-0">Best Escort and best services....</td>
                        </tr>
                        <!-- Add other rows -->
                    </table>
                </div>
            `;
            row.child(childHtml).show();
            $(this).html('<i class="fa fa-times mr-2"></i> Close');
        }
    });
});

    </script>
@endpush