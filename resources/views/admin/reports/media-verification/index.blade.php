@extends('layouts.admin')
@section('style')
    <style>
        td,
        th {
            vertical-align: middle !important;
        }

        #transactionSummaryTable td {
            white-space: normal !important;
            word-break: break-word;
        }

        .avatar img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }
        
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content-->
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">Media Verification</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>Media is managed in the following manner:
                                <ol class="level-2">
                                    <li>Escort:
                                        <ol class="level-3">
                                            <li>A selfie is uploaded with their Username, Membership ID and Mobile
                                                number printed (can be hand written) on a sheet of paper held up to
                                                their side and not obscuring any part of them (<b>Verification Image</b>).
                                            </li>
                                            <li>A drivers licence or passport which matches their Username and Home
                                                State is acceptable.</li>
                                        </ol>
                                    </li>
                                    <li>Centre:
                                        <ol class="level-3">
                                            <li>A photo is uploaded of the Centre’s business premises which displays
                                                the name of the business and the business number (<b>Verification
                                                    Image</b>); and for a Masseur
                                            </li>
                                            <li>A selfie is uploaded with the Masseur’s Username, Membership ID and
                                                Mobile number printed (can be hand written) on a sheet of paper held
                                                up to their side and not obscuring any part of them (<b>Verification
                                                    Image</b>).</li>
                                        </ol>
                                    </li>
                                </ol>
                            </li>
                            <li>Media verification only applies to photos. All uploaded photos by default are
                                Unverified.</li>
                            <li>
                                As soon as an Advertiser uploads the Verification Image, the status for all photos
                                changes to Verified, including any Listed Profile. In the case of a Centre, if the Centre
                                uploads a Verification Image of the Centre, the photos are Verified but the Masseurs are
                                not. A Masseur’s status is determined individually.

                            </li>
                            <li>
                                Once a Verification Image has been resolved, the report status is changed from Pending to
                                either:
                                <ol class="level-2">
                                    <li>Verified. All photos in the Advertiser’s Media retain the Verified status.</li>
                                    <li>Rejected. All photos in the Advertiser’s Media are changed to Unverified.
                                        Each Masseur’s status is addressed separately. Where a Masseur’s
                                        Verification Image is approved, then the Masseur’s Media is displayed as
                                        Verified, regardless of the Centre’s Media status.</li>
                                   
                                </ol>
                                 
                            </li>
                            The status of a Masseur is recorded separately and reflected according to the
                                    Masseur’s Verification Image outcome.
                        </ol>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-12 my-3">
               <div class="d-flex justify-content-end ">
                 <div class="total_listing">
                    <div><span>Pending Verifications: : </span></div>
                    <div><span class="totalInprogressTask">2</span></div>
                </div>
               </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table" id="mediaverifyTable">
                        <thead class="table-bg">
                            <tr>
                                <th>Member ID</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Submitted</th>
                                <th>Agent ID</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td>E60125</td>
                                <td>18-02-2026</td>
                                <td>Tiera</td>
                                <td>1438 028 728</td>
                                <td>Escort</td>
                                <td>N/A</td>
                                <td>Selfie</td>
                                <td><span class="custom_badge badge_pending">Pending</span></td>
                                 <td class="text-center">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu  dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" style="">
                                            
                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-profile"> <i
                                                    class="fa fa-check-circle"></i> Approve</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-profile"> <i
                                                    class="fa fa-ban"></i> Reject</a>
                                            <div class="dropdown-divider"></div>

                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view_image"> <i
                                                    class="fa fa-eye"></i> View Image</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                href="#" data-toggle="modal" data-target="#view-centre"> <i
                                                    class="fa fa-eye"></i> View Centre</a>

                                        </div>
                                    </div>
                                </td>
                            </tr> -->
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="modal fade upload-modal" id="confirm-popup" tabindex="-1" role="dialog" aria-labelledby="confirmPopupLabel" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header border-0">
                    <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                        <img src="{{ asset('assets/dashboard/img/question-mark.png') }}" alt="resolved" class="custompopicon">
                        <span>Confirmation</span>
                    </h5>
                    <input type="hidden" id="status_data_value" name="status_data_value" value="">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body pb-0 teop-text text-center">
                    <h5 class="popu_heading_style mt-2">
                        Are you sure you want to perform this action.
                    </h5>

                </div>
                <div class="modal-footer justify-content-center border-0 pb-4">

                    <button type="button" class="btn-success-modal saveStatus" data-dismiss="modal" aria-label="Close">Yes</button> <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">No</button>
                </div>
            </div>
        </div>
    </div> -->
    @include('admin.reports.modal.view_image')
    @include('admin.reports.modal.view_tag')
    @include('admin.reports.modal.view_centre')
    @include('admin.reports.modal.verify_masseur_images')
@endsection
@section('script')

<script>
    $(document).ready(function() {
        var table = $("#mediaverifyTable").DataTable({
            language: {
            search: "Search: _INPUT_",
            searchPlaceholder: "Search by Member ID"
            },

            processing: true,
            serverSide: true,
            lengthChange: true,
            searchable:false,
            bStateSave: false,
            ajax: {
                url: "{{ route('admin.media-verification-list') }}",
                dataSrc: function (json) {
                    $('.totalInprogressTask').text(json.totalPending);
                    return json.data;
                }                    
            },
            columns: [
                {
                    data: 'member_id',
                    name: 'member_id',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'N/A'
                },
                {
                    data: 'created_date',
                    name: 'created_date',
                    searchable: false,
                    orderable: false,
                    defaultContent: 'N/A'
                },
                {
                    data: 'name',
                    name: 'name',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'N/A'
                },
                {
                    data: 'mobile',
                    name: 'mobile',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'N/A'
                },
                {
                    data: 'submitted',
                    name: 'submitted',
                    searchable: true,
                    orderable: false,
                    defaultContent: 'N/A'
                },
                {
                    data: 'agent_id',
                    name: 'agent_id',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'N/A'
                },
                {
                    data: 'type',
                    name: 'type',
                    searchable: true,
                    orderable: false,
                    defaultContent: 'N/A'
                },
                {
                    data: 'status_text',
                    name: 'status_text',
                    searchable: false,
                    orderable: false,
                    defaultContent: 'N/A'
                },
                {
                    data: 'action',
                    name: 'edit',
                    searchable: false,
                    orderable: false,
                    defaultContent: 'N/A',
                    class: 'text-center'
                },
            ],
            order: [],
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            pageLength: 10,
        });

        var mediaVerificationId = 0;
        $(document).on('click', '.view-image-btn', function () {
            mediaVerificationId = $(this).data('id');
            var userId = $(this).data('user-id');
            var memberId = $(this).data('member-id');
            var status = $(this).data('status');

            if (status === 'Verified' || status === 'Rejected') {
                $('.approve-btn').hide();
                $('.reject-btn').hide();
            }else{
                $('.approve-btn').show();
                $('.reject-btn').show();
            }
            
            $('#media-images').html('Loading...');
            $.ajax({
                url: "{{ route('admin.media-verification-image') }}",
                method: "GET",
                data: {
                    id: mediaVerificationId,
                    user_id: userId
                },
                success: function (response) {
                    $('#verification-image').attr('src',response.media_verification_image);
                    $('#member-id').text(memberId);
                    if (response.status) {
                        let mediaImages = '';
                        $.each(response.media_img, function (key, img) {
                            mediaImages += img;
                        });
                        $('#media-images').html(mediaImages);
                    } else {
                        $('#view_image .modal-body').html('<p>No images found</p>');
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        }); 

        $(document).off('click', '.approve-btn');
        $(document).on('click', '.approve-btn', function () {
            let id = $(this).data('id');
            if (!id){
                id = mediaVerificationId;
            };
            Swal.fire({
                text: "You want to approve this media verification.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Approve it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    changeMediaVerificationStatus(id , 1);
                }
            });
        }); 


        $(document).off('click', '.reject-btn');
        $(document).on('click', '.reject-btn', function () {
            let id = $(this).data('id');
            if (!id){
                id = mediaVerificationId;
            };
            Swal.fire({
                text: "You want to reject this media verification.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Reject it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    changeMediaVerificationStatus(id , 2);
                }
            });
        }); 


        function changeMediaVerificationStatus(mediaVerificationId, status) {
            $.ajax({
                url: "{{ route('admin.update-media-verification') }}",
                method: "POST",
                data: {
                    id: mediaVerificationId,
                    _token: "{{ csrf_token() }}",
                    status: status
                },
                success: function (response) {
                    if (response.status) {
                        $('#view_image').modal('hide');
                        $('#mediaverifyTable').DataTable().ajax.reload();   
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    alert('An error occurred while approving media verification');
                }
            });
        }
    });

$(document).on('click', '.printImages', function () {
    window.print();
});
    
</script>
@endsection
