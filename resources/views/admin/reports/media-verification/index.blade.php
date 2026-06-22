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

    .printBtn.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        pointer-events: none;
    }

    .printMasseursImgBtn.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        pointer-events: none;
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
                        <tr>
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
                                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                            href="#" data-toggle="modal" data-target="#view_tag"> <i
                                                class="fa fa-eye"></i> View Tag</a>


                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                     <tr>
                        <th colspan="9" class="border-0"></th>
                    </tr>
                    <tfoot class="bg-first t-foot">
                        <tr>
                            <th colspan="3" class="text-left border-0">Server time: <span class="serverTime">{{date('d-m-Y h:i a')}}</span></th>
                            <th colspan="3" class="text-center border-0">Refresh time:<span class="refreshSeconds"> 15</span></th>
                            <th colspan="3" class="text-right border-0" style="text-align:right!important;">Up time: <span class="uptimeClass">{{ getAppUptime() }}</span></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.reports.modal.view_image')
@include('admin.reports.modal.view_tag')
@include('admin.reports.modal.view_centre')
@include('admin.reports.modal.verify_masseur_images')

<script type="text/javascript" src="{{asset('assets/plugins/ajax/libs/jquery/jquery.min.js')}}"></script>
<script>
    $(document).ready(function(e) {
        ajaxReload();
        let countdown = 15;
        setInterval(() => {
            countdown--;
            $(".refreshSeconds").text(' '+countdown);

            if (countdown <= 0) {
                $('#mediaverifyTable').DataTable().ajax.reload(null, false);
                countdown = 15;
                
            }

        }, 1000);

        $('#customSearch').on('keyup', function() {
            $('#mediaverifyTable').DataTable().search(this.value).draw();
        });
    })

    function ajaxReload() {
        var table = $("#mediaverifyTable").DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Member ID"
            },

            processing: true,
            serverSide: true,
            lengthChange: true,
            searchable: false,
            bStateSave: false,
            ajax: {
                url: "{{ route('admin.media-verification-list') }}",
                dataSrc: function(json) {
                    $('.totalInprogressTask').text(json.totalPending);
                    $(".serverTime").text(json.server_time);
                    $(".uptimeClass").html(json.server_up_time);
                    return json.data;
                }
            },
            columns: [{
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
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            pageLength: 10,
        });
    }

    $(document).ready(function() {
        var mediaVerificationId = 0;
        var userId = 0;
        var memberId = 0;
        var userType = 0;

        $(document).on('click', '.view-image-btn', function() {
            mediaVerificationId = $(this).data('id');
            userId = $(this).data('user-id');
            memberId = $(this).data('member-id');
            status = $(this).data('status');
            userType = $(this).data('user_type');
            let category = $(".verification-img-popup .nav-link.active").attr('data-type');
            if (userType == '4') {
                $('#pinups-tab').hide();
            } else {
                $('#pinups-tab').show();
            }
            $('.printBtn').attr('href', '/admin-dashboard/gallery-pdf/' + mediaVerificationId + '/' + userId);

            if (status === 'Verified' || status === 'Rejected') {
                $('.approve-btn').hide();
                $('.reject-btn').hide();
            } else {
                $('.approve-btn').show();
                $('.reject-btn').show();
            }

            $('#media-images').html('Loading...');

            getMediaVerificationImage(userId, mediaVerificationId, category, memberId);
        });

        function checkPrintBtn() {
            let hasImages =
                $('#banners_img').children().length > 0 ||
                $('#pinup_img').children().length > 0 ||
                $('#media-images').children().length > 0;

            if (hasImages) {
                $('.printBtn').removeClass('disabled').off('click');
            } else {
                $('.printBtn').addClass('disabled').off('click').on('click', function(e) {
                    e.preventDefault();
                });
            }
        }

        function getMediaVerificationImage(userId, mediaVerificationId, category, memberId) {
            $.ajax({
                url: "{{ route('admin.media-verification-image') }}",
                method: "GET",
                data: {
                    id: mediaVerificationId,
                    user_id: userId,
                    type: category
                },
                success: function(response) {
                    $('#verification-image').attr('src', response.media_verification_image);
                    $('#member-id').text(memberId);
                    if (response.status) {
                        let mediaImages = '';
                        $.each(response.media_img, function(key, img) {
                            mediaImages += img;
                        });
                        if (category == "pinups") {
                            $('#pinup_img').html(response.media_pinup_image);
                        } else if (category == "banners") {
                            $('#banners_img').html(response.media_banner_image);
                        } else {
                            $('#media-images').html(mediaImages);
                        }

                    } else {
                        $('#view_image .modal-body').html('<p>No images found</p>');
                    }
                    checkPrintBtn();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        $(document).off('click', '.approve-btn');
        $(document).on('click', '.approve-btn', function() {
            let id = $(this).data('id');
            if (!userType) {
                userType = $(this).attr('data-user_type');
            }

            if (!id) {
                id = mediaVerificationId;
            };
            Swal.fire({
                text: "You want to approve this Media Verification.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    changeMediaVerificationStatus(id, 1, userType);
                }
            });
        });


        $(document).off('click', '.reject-btn');
        $(document).on('click', '.reject-btn', function() {
            if (!userType) {
                userType = $(this).attr('data-user_type');
            }
            let id = $(this).data('id');
            if (!id) {
                id = mediaVerificationId;
            };
            Swal.fire({
                text: "You want to reject this media verification.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, reject it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    changeMediaVerificationStatus(id, 2, userType);
                }
            });
        });


        function changeMediaVerificationStatus(mediaVerificationId, status, userType) {
            $.ajax({
                url: "{{ route('admin.update-media-verification') }}",
                method: "POST",
                data: {
                    id: mediaVerificationId,
                    _token: "{{ csrf_token() }}",
                    status: status,
                    user_type: userType
                },
                success: function(response) {
                    if (response.status) {
                        swal.fire('', response.message, 'success');
                        $('#view_image').modal('hide');
                        $('#mediaverifyTable').DataTable().ajax.reload();
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('An error occurred while approving media verification');
                }
            });
        }

        $(document).off('click', '.verification-img-popup');
        $(document).on('click', '.verification-img-popup .nav-link', function() {
            let activeGalleryTab = $(".verification-img-popup .nav-link.active").attr('data-type');
            getMediaVerificationImage(userId, mediaVerificationId, activeGalleryTab, memberId);
        });

    });

    $(document).on('click', '#view_image [data-dismiss="modal"]', function() {
        $('#myTab .nav-link').removeClass('active').attr('aria-selected', 'false');
        $('#gallery-tab').addClass('active').attr('aria-selected', 'true');
        $('.tab-pane').removeClass('active show');
        $('#gallery').addClass('active show');
        setTimeout(function() {
            let modal = $('#view_image');
            modal.removeClass('show').css('display', 'none');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

        }, 200);
    });


   $(document).on('click', '.view-centre-btn', function () {

    let mc_id = $(this).data('id');

    $.ajax({
        url: "{{ route('admin.masseurs_media-verification-list') }}",
        type: "POST",
        data: {
            id: mc_id
        },

        success: function (response) {

            let html = '';

            if (!response.data || response.data.length === 0) {
                html = `<tr><td colspan="5">No data found</td></tr>`;
            } else {

                response.data.forEach(function (item) {

                    let tooltipWrapper = '';

                    // Only for Approved / Rejected
                    if (item.status !== '0') {
                        tooltipWrapper = `
                            <div class="e4u-tooltip">
                                <span class="custom_badge ${item.status_class}">
                                    ${item.status_text}
                                </span>
                                ${item.tooltip}
                            </div>
                        `;
                    } else {
                        // Pending (no tooltip)
                        tooltipWrapper = `
                            <span class="custom_badge ${item.status_class}">
                                ${item.status_text}
                            </span>
                        `;
                    }

                    html += `
                        <tr>
                            <td>${item.id}</td>
                            <td>${item.date}</td>
                            <td>${item.name}</td>
                            <td>${item.type}</td>
                            <td style="width:120px;">
                                ${tooltipWrapper}
                            </td>
                        </tr>
                    `;
                });
            }

            $('#viewCentreTableBody').html(html);
        },

        error: function (xhr) {
            console.log('Error:', xhr.responseText);

            $('#viewCentreTableBody').html(`
                <tr>
                    <td colspan="4">Something went wrong</td>
                </tr>
            `);
        }
    });
});

    $(document).on('click', '.view-tag-btn', function() {

        let mc_id = $(this).data('id');
        $.ajax({
            url: "{{ route('admin.masseurs_media-verification-tag') }}",
            type: "POST",
            data: {
                id: mc_id
            },

            success: function(response) {

                $('#viewTagTableBody').html(response.html);

                $('#viewTagModal').modal('show');
            },

            error: function(xhr) {
                console.log(xhr.responseText);

                $('#viewTagTableBody').html(`
                <tr><td colspan="6">Something went wrong</td></tr>
            `);
            }
        });
    });

    let profile_id = null;
    let masseur_member_id = null ;
    let profile_verification_id = null;

    $(document).on('click', '.view-masseur-image-btn', function() {
        let profile_id = $(this).data('id');
        profile_verification_id = $(this).data('verification-id');
        // masseur_member_id = $(this).data('masseur_member-id');
        let profile_member_id = $(this).data('member-id');
        $('.member_id').html(profile_member_id);
        $('#view_tag').modal('hide');
        let status = $(this).data('status');
        if (status == '1' || status == '2') {
            $('.approveMasseursBtn').hide();
            $('.rejectMasseursBtn').hide();
        } else {
            $('.approveMasseursBtn').show();
            $('.rejectMasseursBtn').show();
        }

        $('.printMasseursImgBtn').attr('href', '/admin-dashboard/masseur-gallery-pdf/' + profile_verification_id + '/' + profile_id);
        $.ajax({
            url: "{{ route('admin.getProfileImages') }}",
            type: "GET",
            data: {
                profile_id: profile_id,
                verification_id: profile_verification_id,
                status: status
            },

            success: function(res) {
                $('.view_img_gallery_masseur .thumbnail').html(res.thumbnail);
                $('.view_img_gallery_masseur .other_images').html(res.gallery);
                $('.view_img_gallery_masseur .verification').html(res.verification);
                checkMasseurPrintBtn();  
            }
        });

    });



function checkMasseurPrintBtn() {

    let hasImages = $('.other_images .verify_icon_wrapper img').length > 0;

    if (hasImages) {
        $('.printMasseursImgBtn')
            .removeClass('disabled')
            .css('pointer-events', 'auto')
            .attr('aria-disabled', 'false');
    } else {
        $('.printMasseursImgBtn')
            .addClass('disabled')
            .css('pointer-events', 'none')
            .attr('aria-disabled', 'true');
    }
}
        
    $(document).on('click', '.masseurs-approve-btn', function(e) {
        e.preventDefault();
        e.stopPropagation();
        let id = $(this).data('verification-id');
        masseur_member_id = $(this).data('masseur_member-id');
        if (!id) {
            console.log("ID missing");
            return;
        }

        Swal.fire({
            text: "You want to approve this Media Verification.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, approve it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                changeMediaVerificationStatusForMasseurs(id, 1,masseur_member_id);
            }
        });
    });


    $(document).on('click', '.approveMasseursBtn', function(e) {
        e.preventDefault();
        e.stopPropagation();
       
        if (!profile_verification_id) {
            console.log("ID missing");
            return;
        }

        Swal.fire({
            text: "You want to approve this Media Verification.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, approve it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                changeMediaVerificationStatusForMasseurs(profile_verification_id, 1,$('.member_id').html());
            }
        });
    });

    $(document).on('click', '.rejectMasseursBtn', function(e) {
        e.preventDefault();
        e.stopPropagation();
       
        if (!profile_verification_id) {
            console.log("ID missing");
            return;
        }

        Swal.fire({
            text: "You want to reject this Media Verification.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, reject it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                changeMediaVerificationStatusForMasseurs(profile_verification_id, 2,$('.member_id').html());
            }
        });
    });


    $(document).off('click', '.masseurs-reject-btn');
    $(document).on('click', '.masseurs-reject-btn', function() {
       
        let id = $(this).data('verification-id');
        let masseur_member_id = $(this).data('masseur_member-id');
        if (!id) {
            console.log("ID missing");
            return;
        }
        Swal.fire({
            text: "You want to reject this media verification.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, reject it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                changeMediaVerificationStatusForMasseurs(id, 2 , masseur_member_id);
            }
        });
    });

    function changeMediaVerificationStatusForMasseurs(mediaVerificationId, status, masseur_member_id) {
        
        $.ajax({
            url: "{{ route('admin.update-masseurs-media-verification') }}",
            method: "POST",
            data: {
                id: mediaVerificationId,
                _token: "{{ csrf_token() }}",
                status: status,
                masseur_member_id: masseur_member_id
            },
            success: function(response) {
                if (response.status) {
                    swal.fire('', response.message, 'success');
                    $('#view_tag').modal('hide');
                    $('#verify_masseur_images').modal('hide');
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('An error occurred while  media verification');
            }
        });
    }
</script>
@endsection