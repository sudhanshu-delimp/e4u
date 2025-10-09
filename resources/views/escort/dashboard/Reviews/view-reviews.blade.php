
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
    /* #EscortReviewTable tbody td{
        text-align: center !important;
    } */
    .escort-ratings {
        justify-content : center;
    } 
    </style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content start here-->
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">Reviews</h1>
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

        <div class="col-lg-12">
            <div class="table-responsive custom-badge">
                <table class="table" id="EscortReviewTable" style="width: 100%">
                    <thead class="table-bg">
                        <tr>
                            <th >Ref</th>
                            <th >Date</th>
                            <th class="text-center">Rating</th>
                            <th class="text-center" style="width: 100px;">Status</th>
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

<!-- confirmation model -->
    <div class="modal " id="confirm_modal" style=" padding-right: 15px;" aria-modal="true"
        role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color border-0">
                    <h5 class="modal-title text-white">
                        <img src="/assets/dashboard/img/ban.png" class="custompopicon" id="modal-icon">
                        <span style="color:white" id="modal_suspend_title">Review Suspended</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="popu_heading_style mb-0 mt-4" style="text-align: center;">
                        Are you sure that you want to <span class="bodyMessageTitle">suspend</span> this <br> Review <span class="bodyMessageSentence">from</span> all of your Profiles?
                    </h5>
                </div>
                <div class="modal-footer" style="justify-content: center;">
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal" id="close">No</button>
                    <button type="submit" class="btn-success-modal" data-review-id="" data-review-status="" data-dismiss="modal" id="saveReviewInfo" >Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->
    <!-- success model -->
    <div class="modal " id="success_modal" style=" padding-right: 15px;" aria-modal="true"
        role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color border-0">
                    <h5 class="modal-title text-white">
                        <img src="/assets/dashboard/img/unblock.png" class="custompopicon" id="modal-icon">
                        <span style="color:white" id="modal-title">Review <span class="modal_success_title">Suspended</span></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="http://127.0.0.1:8000/assets/app/img/newcross.png"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="popu_heading_style mb-0 mt-4" style="text-align: center;">
                        <span id="comman_str"></span>
                        <span class="success_common_msg">Status updated succesfully.</span>
                    </h5>
                </div>
                <div class="modal-footer" style="justify-content: center;">
                    <button type="submit" class="btn-success-modal" data-dismiss="modal" id="close">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->


@endsection
@push('script')

@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
  
    <script>

        var escortReviewTable = $('#EscortReviewTable').DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Ref ID..."
            },
            processing: true,
            serverSide: false,
            paging: true,
            info: true,
            lengthChange: false,
            searching: false,
            bStateSave: true,
            ordering: true,
            ajax: {
                url: "{{ route('escort.reviews-profile-by-ajax') }}",
                type: "GET",
                dataSrc: function(json) {
                    return json.data;
                }
            },
                drawCallback: function (settings) {
            },
            columns: [
                { data: 'ref', name: 'ref' },
                { data: 'date', name: 'date' },
                { data: 'rating', name: 'rating', orderable: false },
                { 
                    data: 'status', name: 'status',
                    orderable: false,
                    searchable: false
                },
                { data: 'action', name: 'action', orderable: false }
            ]
        });

        $(document).on('click', '.update-review-status', function(e) {
            e.preventDefault(); // prevent default link behavior

            const reviewId = $(this).attr('data-review-id');
            const status = $(this).attr('data-status');
            $("#saveReviewInfo").attr('data-review-id',reviewId);
            $("#saveReviewInfo").attr('data-review-status',status);
            var statusTitle = status == 'suspended' ? 'suspend' : 'publish';
            var bodyMessageSentence = status == 'suspended' ? 'from' : 'on';

            $("#modal_suspend_title").text('Review '+capitalizeFirstLetter(statusTitle));
            $(".bodyMessageTitle").text(statusTitle);
            $(".bodyMessageSentence").text(bodyMessageSentence);
            $(".modal_success_title").text(capitalizeFirstLetter(statusTitle));

            var myModal = new bootstrap.Modal(document.getElementById('confirm_modal'));
            myModal.show();
        });

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        // Toggle child rows
        $('#EscortReviewTable tbody').on('click', '.toggle-report-hide', function (e) {
            console.log('hide report');
            $(this).parents('tr').hide();
        })

    // Toggle child rows
    $('#EscortReviewTable tbody').on('click', '.toggle-report', function (e) {
        e.preventDefault();
        var tr = $(this).closest('tr');
        var row = escortReviewTable.row(tr);
        var dataId = $(this).data("id");
        let routeUrl = "{{ route('get-single-user-review-details', ':id') }}".replace(':id', dataId);
        let reviewId = dataId;

        viewReviewReportAjax(row, reviewId, routeUrl, $(this));

    });

    function viewReviewReportAjax(row, review_id, routeUrl, obj)
    {
        const reportId = $(this).data('id');

        $.ajax({
            url: routeUrl, // replace with your actual route
            method: 'GET',
            success: function(response) {
                
                var childHtml = ``;

                if(response.error == false){
                    // if (row.child.isShown()) {
                    //     row.child.hide();
                    //     obj.html('<i class="fa fa-eye mr-2"></i> View');
                    // } else {
                        // Replace below with dynamic HTML if needed
                        childHtml = `
                            <div class="card p-3">
                                <div class="d-flex justify-content-between">
                                    <h5 class="font-weight-bold text-blue-primary">Review Details</h5>
                                    <button class="btn-cancel-modal toggle-report-hide" style="font-size: 12px; padding: 5px 10px;" > Close </button>
                                </div>
                                <table class="table mb-0">
                                    <tr>
                                        <th>Ref:</th><td class="border-0">`+response.data.id + response.data.escort_id+`</td>
                                        <th>Escort's Membership Number:</th><td class="border-0">`+response.data.escort_id+`</td>
                                    </tr>
                                
                                    <tr>
                                        <th>Mobile:</th>
                                        <td class="border-0">`+response.data.escort.user.phone+`</td>
                                        <th>Escort’s Name:</th>
                                        <td class="border-0">`+response.data.escort.name+`</td>
                                    </tr>
                                    <tr>
                                        
                                        <th>Home State:</th>
                                        <td class="border-0">`+response.data.escort.user.state.name+`</td>
                                        <th>Status:</th>
                                        <td class="border-0">`+capitalizeFirstLetter(response.data.status)+`</td>
                                    </tr>
                                    <tr>
                                        <th>Viewer Name:</th>
                                        <td class="border-0">`+response.data.user.name+`</td>
                                        <th>Comments:</th>
                                        <td class="border-0">`+response.data.description+`</td>
                                    </tr>
                                    <!-- Add other rows -->
                                </table>
                            </div>
                        `;
                        row.child(childHtml).show();
                        //obj.html('<i class="fa fa-times mr-2"></i> Close');
                        obj.html('<i class="fa fa-eye mr-2"></i> View');
                    // }
                }
            },
            error: function(xhr) {
                console.error('Failed to fetch data');
                $('#view-listing .modal-body').html('<p class="text-danger">Error loading data...</p>');
            }
        });
    }

    $(document).on('click', '#saveReviewInfo', function(e) {
            e.preventDefault(); 

            var reviewId = $(this).attr('data-review-id');
            var status = $(this).attr('data-review-status');

            $.ajax({
                url: '{{ route("user-review-status-update") }}', // replace with your actual route
                method: 'POST',
                data:{
                    'review_id':reviewId,
                    'status':status,
                },
                success: function(response) {
                    console.log(response);
                    if(response.error == false){
                        if(response.review_status == 'suspended'){
                            $(".success-modal-title").text('Suspended');
                            
                            $(".success-modal-text").text('The review has been successfuly suspended.');

                        }else{
                            $(".success-modal-title").text('Published');
                            $(".success-modal-text").text('The review has been successfuly published.');
                        }

                        $(".success_common_msg").text(response.message);

                        $('#EscortReviewTable').DataTable().ajax.reload(null, false);
                        var myModal = new bootstrap.Modal(document.getElementById('success_modal'));
                        myModal.show();
                    }
                },
                error: function(xhr) {
                    $('#view-listing .modal-body').html('<p class="text-danger">Error loading data...</p>');
                }
            });
        });

    </script>
@endpush