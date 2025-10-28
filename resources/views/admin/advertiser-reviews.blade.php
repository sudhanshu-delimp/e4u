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

        .manage-table table tr:first-child td {
            border-top: 1px solid #000 !important;
        }

        .paging_simple_numbers {
            margin-top: 18px;
        }

        .dataTables_info {
            margin-top: 18px;
        }

        .table-report-info tr td {
            border: 0;
        }

        .table-report-info th {
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
                <h1 class="h1"> Advertiser Reviews </h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b>
                </span>
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
                            <ol class="level-2">
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
                    <table class="table" id="advertiserReviewTable">
                        <thead class="table-bg">
                            <tr>
                                <th>
                                    Ref

                                </th>
                                <th>
                                    Date

                                </th>
                                <th>
                                    Escort ID
                                </th>
                                <th>Viewer ID</th>
                                <th>
                                    Mobile
                                </th>
                                <th>Status</th>
                                {{-- <th>Review</th> --}}
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="10%" >123</td>
                                <td >25-05-2025</td>
                                <td >E60110</td>
                                <td >V60110</td>
                                <td >12021021521</td>
                                <td >Current</td>
                                <td class="text-center">
                                    <div class="dropdown no-arrow ml-3">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>

                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">

                                            <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#">

                                                <i class="fa fa-hourglass-half text-dark"></i> Pending
                                            </a>

                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#" data-toggle="modal" data-target="#confirm-popup">

                                                <i class="fa fa-check-circle text-dark"></i>Published
                                            </a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                href="#" data-toggle="modal" data-target="#rejected-popup">

                                                <i class="fa fa-ban text-dark"></i>Rejected
                                            </a>

                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex view_member_report justify-content-start gap-10 align-items-center"
                                                href="#">

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

        <div class="col-md-12" id="print-advertiser-reviews">
            <div class="my-account-card">
                <div class="card-head">                    
                    <h2 class="font-weight-bold">My Report Information </h2>
                    <div>
                        <button class="print-btns"  type="button"><i class ="fa fa-print"></i> Print Report</button>
                        <button class="btn-cancel-modal close_report_btn"  type="button"> Close</button>
                    </div>
                    
                    <input type="hidden" id="printReportId" value="">
                </div>
                <table class="table  w-100 table-report-info"> 
                    <tr class="details-row">
                        <td colspan="7">
                          <div>
                            <table class="table border-0 table-report-info">
                              <tbody>
                                <tr>
                                            <th>Our Ref:</th>
                                            <td class="report_ref">#30</td>
                                            <th>Date:</th>
                                            <td class="report_date">14-05-2025</td>
                                        </tr>
                                        <tr>
                                            <th>Escort ID:</th>
                                            <td class="report_escort_id">14-05-2025</td>
                                            <th>Viewer ID:</th>
                                            <td class="report_viewer_id">WA - Perth</td>
                                        </tr>
                                        <tr>
                                            
                                            <th >Status:</th>
                                            <td class="report_status">Current</td>
                                            <th>Mobile:</th>
                                            <td class="report_mobile">Adrian Weinstein</td>
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
                                <input type="checkbox" style="margin:0;"> <span style="font-weight:600;">Reject Review</span>
                            </label>
                            </td>
                            <td colspan="2" style="border:1px solid #000; padding:8px;">
                            <label style="display:inline-flex; align-items:center; gap:6px; margin:0;">
                                <input type="checkbox" style="margin:0;"> <span style="font-weight:600;">Publish Review</span>
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

    {{-- confirm modal --}}
    <div class="modal fade upload-modal" id="confirm-popup" tabindex="-1" role="dialog" aria-labelledby="confirmPopupLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header border-0">
                <input type="hidden" id="status_data_id">
                <input type="hidden" id="status_data_value">
                <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                    <img src="{{ asset('assets/dashboard/img/question-mark.png') }}" alt="resolved"  class="custompopicon">
                    <span>Confirmation <span class="ref_clas"></span></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>

            <div class="modal-body pb-0 teop-text text-center">
                <h6 class="popu_heading_style mt-2">
                    <span id="Lname">Are you sure you want to <span class="add_review_title"></span> this Review?</span>
                </h6>

            </div>

            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">Cancel</button>
                <button type="button" class="btn-success-modal saveStatus" data-dismiss="modal" aria-label="Close">Save</button>
            </div>
        </div>
    </div>
</div>


    {{-- published modal --}}
    <div class="modal fade upload-modal" id="confirm_publish_popup" tabindex="-1" role="dialog"
        aria-labelledby="confirmPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header border-0">
                    <h5 class="modal-title d-flex align-items-center " id="confirmPopupLabel">
                        <img src="{{ asset('assets/dashboard/img/published.png') }}" id="custompopicon" alt="published"
                            class="custompopicon">
                        <span class="success-modal-title">Published</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body text-center">
                    <h6 class="popu_heading_style mt-2">
                        <span id="" class="success-modal-text">We’re happy to inform you that your query
                        has been <br> successfully resolved.</span>
                    </h6>

                </div>

                <div class="modal-footer justify-content-center border-0 pb-4">
                    <button type="button" class="btn-success-modal px-4" data-dismiss="modal"
                        aria-label="Close">OK</button>
                </div>
            </div>
        </div>
    </div>
 
@endsection
@push('script')
    
    
    </script>

    <script>

    $(document).on('click', '.close_report_btn', function(e) {
        e.preventDefault();
        $("#print-advertiser-reviews").hide();
    });

    $(document).on('click', '.print-btns', function(e) {
        e.preventDefault();
        
        var printReportId = $("#printReportId").val();
        var printUrl = "{{route('admin.print.single-member-reviews')}}?report_id="+printReportId;
        location.href = printUrl;
    });

    $("#print-advertiser-reviews").slideUp();

    $(document).on('click', '.view_member_report', function(e) {
        e.preventDefault();

        // Get the data-id value
        var reviewId = $(this).data('id');
        $("#printReportId").val(reviewId);
        console.log("Report ID:", reviewId); 
        let routeUrl = '{{route("admin.single-member-reviews.ajax")}}';
        $("#print-advertiser-reviews")
        .stop(true, true) // stop any current animation
        .slideUp(0)       // instantly hide
        .slideDown(800);  // slide down again

        viewMemberReportAjax(reviewId, routeUrl);

        $('html, body').animate({
            scrollTop: $("#print-advertiser-reviews").offset().top
        }, 500); // 500ms for smooth scroll

        
        
    });

    $(document).on('click', '.update-review-status', function(e) {
        e.preventDefault();
        let reportId = $(this).data('id');
        let status = $(this).data('value');
        let ref = $(this).data('ref');
        //let st = status == 'published' ? 'publish' : 'reject';

        if(status == 'pending'){
            st = 'mark as pending';
        }else if(status == 'rejected'){
            st = 'reject';
        }else{
            st = 'publish';
        }

        $('#status_data_id').val(reportId);
        $('#status_data_value').val(status);
        $('.add_review_title').text(st);
        $('.ref_class').text(ref);
        //$("#success-popup").modal('show');

        console.log(reportId, status);  
        
    });

    $(document).on('click', '.saveStatus', function(e) {
        e.preventDefault();
        let reviewId = $('#status_data_id').val();
        let status = $('#status_data_value').val();
        var reviewData = {
            'reviewId' :reviewId,
            'status' :status,
        }

        let imageUrl = '{{ asset("assets/dashboard/img/rejected.png") }}';
        if(status == 'published'){
            $(".success-modal-title").text('Published');
            imageUrl = '{{ asset("assets/dashboard/img/published.png") }}';
            $("#custompopicon").attr('src', imageUrl );

            $(".success-modal-text").text('This Review is now Published');

        }else if(status == 'rejected'){
            $(".success-modal-title").text('Rejected');
            imageUrl = '{{ asset("assets/dashboard/img/rejected.png") }}';
            $("#custompopicon").attr('src', imageUrl );
            $(".success-modal-text").text('This Review is now Rejected.');
        }else{
            $(".success-modal-title").text('Pending');
            $("#custompopicon").attr('src', imageUrl);
            $(".success-modal-text").text('We’re sorry to inform you that your review has been updated to pending.');
        }
        
        var url = "{{route('admin.advertiser.reviews-status')}}";
        updateMemberReportStatus(reviewData, url);
    });

    function updateMemberReportStatus(reportData, routeUrl)
    {
        const reportId = $(this).data('id');

        $.ajax({
            url: routeUrl, // replace with your actual route
            method: 'POST',
            data:{
                'review_id':reportData.reviewId,
                'status':reportData.status,
            },
            success: function(response) {
                if(response.error == false){

                    $('#advertiserReviewTable').DataTable().ajax.reload(null, false);
                    var myModal = new bootstrap.Modal(document.getElementById('confirm_publish_popup'));
                    myModal.show();
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

    function viewMemberReportAjax(review_id, routeUrl)
    {
        const reportId = $(this).data('id');

        $.ajax({
            url: routeUrl, // replace with your actual route
            method: 'GET',
            data:{
                'review_id':review_id
            },
            success: function(response) {
                if(response.error == false){
                    console.log(response.data);

                    let status = (response.data.status == 'pending') ? 'Pending' : response.data.status;

                    $(".report_ref").text('#'+response.data.id +''+ response.data.escort_id);
                    $(".report_date").text(response.data.formatted_created_at);
                    $(".report_escort_id").text(response.data.escort.user.member_id);
                    $(".report_viewer_id").text(response.data.user.member_id);
                    $(".report_status").text(status);
                    $(".report_comment").text(capitalizeFirstLetter(response.data.description));
                    $(".report_mobile").text(response.data.user.phone);
                }
            },
            error: function(xhr) {
                console.error('Failed to fetch data');
                $('#view-listing .modal-body').html('<p class="text-danger">Error loading data...</p>');
            }
        });
    }

    ajaxReload('advertiserReviewTable', "{{ route('admin.advertiser-reviews.ajax') }}",'GET')
 
    function ajaxReload(tableId, ajaxUrl, method)
    {
        var table = $('#'+tableId).DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Escort ID..."
            },

            processing: true,
            serverSide: true,
            paging: true,
            info: true,
            searching: true,
            bStateSave: true,
            // ordering:false,
            // autoWidth: false,
            columnDefs: [
                { width: "12%", targets: 1 } 
            ],
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
                { data: 'date', name: 'date',  },
                { data: 'escort_id', name: 'escort_id' },
                { data: 'viewer_id', name: 'viewer_id' },
                { data: 'mobile', name: 'mobile' },
                { 
                    data: 'status', name: 'status',
                    orderable: false,
                    searchable: false
                },
                // { data: 'review', name: 'review'},
                { data: 'action', name: 'action', orderable: false }
            ]
        });
    }
    </script>
@endpush
