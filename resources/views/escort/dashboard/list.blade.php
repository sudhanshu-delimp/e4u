@extends('layouts.escort')
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

    .parsley-errors-list {
        list-style: none;
        color: rgb(248, 0, 0);
        padding: 0;
    }

    .parsley-errors-list li {
        font-size: 14px;
        line-height: 18px;
        margin-top: 6px;
    }

    /* .suspension-note-list {
                    list-style-position: outside;
                    padding-left: 20px;
                } */

    .suspension-note-list li {
        text-indent: 4px;
        /* Adds space after number */
    }

    #btn_suspend_profile,
    #btn_upgrade,
    #btn_add_brb,
    #btn_extend_profile,
    #btn_pinup_profile,
    #btn_bumpup_profile,
    #btn_cancel_profile {
        display: none;
    }

    button#btn_add_brb:hover {
        background: #0c223dcf;
        border: 1px solid #0c223dcf;
    }

    .add--list {
        display: flex;
        justify-content: space-between;
    }

    .modal-lg {
        max-width: 600px !important;
    }
</style>
@endsection
@section('content')
<div class="d-flex flex-column container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">


    <div class="d-sm-flex align-items-center justify-content-between">
        <div class="custom-heading-wrapper">
            <h1 class="h1">{{ $type == 'past' ? 'Archive' : 'Listed' }}
                Profiles</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                aria-expanded="true"><b>Help?</b></span>
        </div>
        @if (request('from') == 'dashboard')
        <div class="back-to-dashboard">
            <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
            </a>
        </div>
        @endif
    </div>

        <div class="row">
            <div class="col-md-12 mb-4 collapse" id="notes">
                <div class="card " id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>Use this feature to review and make changes to your Profiles.</li>
                            <li>You can view and edit a Profile by selecting 'Action'. By selecting the Action
                                function, you will be able to {{ $type == 'past' ? 'Duplicate,' : '' }} Delete, Edit
                                or
                                View the Profile and Add Playmates.</li>
                            @if ($type != 'past')
                                <li>
                                    To display your Playmates avatar in any Profile, select <strong>Add Playmates</strong>
                                    from Action.
                                    You can add multiple Playmates. Only your Playmates in the Location the Profile is
                                    listed at the time
                                    can be added to the Profile. If your Playmate leaves the Location while your Profile is
                                    active, or
                                    they suspend their Profile, they will be automatically removed from the Profile for the
                                    suspended
                                    period, and permanently if they have left the Location. If your Playmate returns to your
                                    Location, they will automatically be added back into the Listed Profile.
                                </li>
                            @endif


                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div id="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box-body">
                    @if ($type != 'past')
                    <div>
                        <div class="add--list listingActionButtons">
                            <div class="">

                                        {{-- <div class="pinup-tooltip-wrapper"> --}}
                                        <button style="padding: 10px;" class="btn btn-warning esc-tooltip-wrap"
                                            data-toggle="modal" data-target="#pinup_profile" id="btn_pinup_profile"
                                            @if ($activePinup) disabled title="" @endif>List Pin
                                            Up
                                            @if ($activePinup)
                                                <span class="esc-tooltip-2">You already have an active <br> Pin Up. You can
                                                    book <br> after it
                                                    expires.</span>
                                            @endif
                                        </button>

                                        <button class="btn upgrade-btn esc-tooltip-wrap" data-toggle="modal"
                                            data-target="#upgrade_modal" id="btn_upgrade">Upgrade
                                            <span class="esc-tooltip-2">Upgrade your Membership <br> Type</span>
                                        </button>


                                        <button style="padding: 10px;" class="btn btn-custom-success esc-tooltip-wrap"
                                            data-toggle="modal" data-target="#extend_profile" id="btn_extend_profile">
                                            Extend Listing
                                            <span class="esc-tooltip-2">Extend your Listing to a <br> new end date</span>
                                        </button>
                                        <button style="padding: 10px;" class="btn btn-bump-up esc-tooltip-wrap"
                                            data-toggle="modal" data-target="#bumpup_profile" id="btn_bumpup_profile"> Bump
                                            Up
                                            <span class="esc-tooltip-2">Bump your Listing up to <br> the top of the
                                                Listings</span>
                                        </button>
                                        <button style="padding: 10px;" class="btn btn-primary esc-tooltip-wrap"
                                            data-toggle="modal" data-target="#suspend_profile"
                                            id="btn_suspend_profile">Suspend Listing
                                            <span class="esc-tooltip-2">Take down your Listing <br> for a set period</span>
                                        </button>
					<button style="padding: 10px;" class="btn btn-danger esc-tooltip-wrap"
                                    data-toggle="modal" data-target="#cancel_profile"
                                    id="btn_cancel_profile">Cancel Listing
                                    <span class="esc-tooltip-2">Take down your Profile</span>
                                </button>



                                    </div>
                                    <button class="btn brb-btn esc-tooltip-wrap" data-toggle="modal" data-target="#add_brb"
                                        id="btn_add_brb">Add BRB
                                        <span class="esc-tooltip-2">Be Right Back display</span>
                                    </button>
                                </div>
                            </div>
                            <br>
                        @endif
                        <div class="table-responsive">
                            <table class="table w-100" id="sailorTable">
                                <thead id="table-sec" class="table-bg">
                                    <tr>
                                        <th>ID</th>
                                        <th class="w-auto">Profile Name</th>
                                        <th class="w-auto">Location</th>
                                        <th class="w-auto">Stage Name</th>
                                        <th class="w-auto">Membership</th>
                                        <th class="w-auto">Mobile Number</th>
                                        <!-- <th class="w-auto">Competitor</th>-->
                                        <th class="w-auto">Date Created</th>
                                        <th>Status</th>
                                        <th>Start Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--middle content end here-->
    <!--right side bar start from here-->
</div>

<!-- extend profile modal start here -->
<div class="modal fade upload-modal modal-form-extend" id="extend_profile" tabindex="-1" role="dialog"
    aria-labelledby="extendProfileTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static"
    aria-modal="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <img src="{{ asset('/assets/dashboard/img/extend-profile.png') }}" class="custompopicon"
                        alt="extend">
                    Extend Listing
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img id="modal_close_extend" src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img_resize_in_smscreen">
                    </span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container p-0">
                            <form action="{{ route('escort.account.listing_checkout', ['type' => 'extend']) }}"
                                method="POST" id="extend_form">
                                {{ csrf_field() }}
                                <!-- Profile select -->
                                <div class="form-group row">
                                    <label class="col-sm-3" for="">Profile:</label>
                                    <div class="col-sm-9">
                                        <select
                                            class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp"
                                            id="extendProfileId" name="escort_id[]"
                                            data-parsley-errors-container="#extend-profile-errors" required
                                            data-parsley-required-message="Select Profile">
                                            <option value="">Select Profile</option>

                                        </select>
                                        <span id="extend-profile-errors"></span>
                                    </div>
                                </div>

                                <!-- Extend Period -->
                                <div class="form-group row extend--profile">
                                    <label class="col-sm-3">Extend Period:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input extend-period" type="radio"
                                                        name="extend_days" id="extendDay1" value="1" disabled>
                                                    <label class="form-check-label" for="extendDay1">1 day</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input extend-period" type="radio"
                                                        name="extend_days" id="extendDay5" value="5" disabled>
                                                    <label class="form-check-label" for="extendDay5">5 days</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input extend-period" type="radio"
                                                        name="extend_days" id="extendDay10" value="10" disabled>
                                                    <label class="form-check-label" for="extendDay10">10 days</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="hidden" name="membership[]" id="extendMembership">
                                                <input type="hidden" name="start_date[]" id="extendStartDate">
                                                <input type="text" id="extendEndDate"
                                                    class="form-control form-control-sm removebox_shdow js_datepicker"
                                                    name="end_date[]" required disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fee -->
                                {{-- <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="">Fee:</label>
                                <div class="col-sm-4">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" style="border-radius: 0rem; font-size:0.8rem;padding: 0px 10px;">$</span>
                                    <span class="form-control" id="extendFeeLive" style="background-color: #e9ecef; border: 1px solid #ced4da;">0.00</span>
                                </div>
                                </div>
                            </div> --}}

                                <hr style="background-color: #0C223D" class="mt-4">

                                <!-- Notes -->
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <p class="mb-1"><b>Notes:</b></p>
                                        <ol class="pl-4 text-justify">
                                            <li>The Fee is calculated according to the Membership Type.</li>
                                            <li>You agree to your Card being debited the Fee.</li>
                                            <li>Details of this transaction can be viewed in the Transaction Summary.
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                                <div class="modal-footer" style="text-align: right; display: block;">
                                    <button type="submit" class="btn-success-modal">Proceed to Payment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- end extend profile modal -->

<!-- suspend profile modal start here -->
<div class="modal fade upload-modal modal-form-suspend" id="suspend_profile" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static"
    aria-modal="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form id="suspend_form">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">
                            <img src="{{ asset('assets/app/img/deactivate.png') }}" class="custompopicon"
                                alt="cross"> Suspend Listing
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><img id="modal_close"
                                    src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container p-0">
                                    <div class="form-group row">
                                        <label class="col-sm-3" for=""> Profile:</label>
                                        <div class="col-sm-9">
                                            <select
                                                class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp"
                                                id="suspendProfileId" name="suspend_profile_id"
                                                data-parsley-errors-container="#profile-errors" required
                                                data-parsley-required-message="Select Profile">
                                                <option value="">Select Profile</option>
                                            </select>
                                            <span id="profile-errors"></span>
                                        </div>
                                        {{-- <div class="col-sm-1"></div> --}}
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3" for=""> Period:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <input type="text" id="suspendStartDate" required
                                                        class="form-control form-control-sm removebox_shdow js_datepicker"
                                                        name="start_date" data-parsley-type=""
                                                        data-parsley-type-message="">
                                                    <span id="brb-time-errors"></span>
                                                </div>
                                                <div class="col-sm-1">
                                                    <span>to:</span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" id="suspendEndDate" required
                                                        class="form-control form-control-sm removebox_shdow js_datepicker"
                                                        name="end_date" data-parsley-type=""
                                                        data-parsley-type-message="">
                                                    <span id="brb-time-errors"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="">Credit:</label>
                                        <div class="col-sm-4">
                                            <div class="input-group input-group-sm" style="padding-right: 25px;">
                                                <span class="input-group-text"
                                                    style="border-radius: 0rem; font-size:0.8rem;padding: 0px 10px;">$</span>
                                                <span class="form-control" id='creditCalculationLive'
                                                    style="background-color: #e9ecef; border: 1px solid #ced4da;">0.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="background-color: #0C223D" class="mt-4">
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <p class="mb-1"><b>Notes:</b></p>
                                            <ol class="pl-4 text-justify">

                                                <li> To suspend a Listing, select the Profile and suspension period,
                                                    then click Suspend. You will be credited with the Fees according to
                                                    the suspension period.</li>
                                                <li> Once your Profile is suspended, it cannot be reinstated for the
                                                    suspended period.</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="text-align: end; display: block;">
                        <button type="submit" class="btn-success-modal" id="save_brb" disabled>Suspend</button>
                        <button type="button" class="btn-cancel-modal" id="save_brb"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end suspend profile modal -->

<!-- suspend profile modal start here -->
@include('escort.dashboard.modal.cancel_profile_listing')
<!-- end suspend profile modal -->

<div class="modal fade upload-modal programmatic" id="delete_profile" style="display: none">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="" style="color:white"><img src="/assets/app/img/block-user.png"
                        class="custompopicon" alt="cross"> Delete Profile
                </h5>

                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>
            <div class="modal-body ">
                <input type="hidden" id="current" name="current">
                <input type="hidden" id="previous" name="previous">
                <input type="hidden" id="label" name="label">
                <input type="hidden" id="trigger-element">
                <h5 class="popu_heading_style mb-0 mt-4 text-center"><span id="Lname"></span> </h5>
                <h5 class="popu_heading_style mb-0 mt-4 text-center"><span id="log"></span> </h5>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal" value="close"
                        id="close_change">No</button>
                    <button type="button" class="btn-success-modal" id="save_change">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>


@if ($type != 'past')
@include('escort.dashboard.profile.modal.index')
@endif

@include('escort.dashboard.partials.playmates-modal')
@include('escort.dashboard.partials.duplicate-profile-modal')
@endsection
@prepend('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
</script>

<script>
    var table;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        var shouldHide = "{{ $type == 'past' ? false : true }}";
        table = $("#sailorTable").DataTable({
            "language": {
                "zeroRecords": "There is no record of the search criteria you entered.",
                searchPlaceholder: "Search by ID or Profile Name"
            },
            processing: true,
            serverSide: true,
            lengthChange: true,
            searchable: false,
            bStateSave: false,
            drawCallback: function(settings) {
                let records = settings.json;
                let $select = $('#extendProfileId');
                $select.empty();

                let $selectSuspend = $('#suspendProfileId');
                $selectSuspend.empty();

                let $selectBumpUp = $('#bumpUpProfileId');
                $selectBumpUp.empty();

                let $selectPinUp = $('#pinup_profile_id');
                $selectPinUp.empty();

                let $selectUpgrade = $('#upgrade_profile_id');
                $selectUpgrade.empty();

                let $selectCancel = $('#cancelProfileId');
                $selectCancel.empty();

                if (records.recordsTotal > 0) {

                    $select.append('<option value="">-- Select Profile --</option>');
                    $.each(records.data, function(i, item) {
                        if (!item.is_extended && item.statusText != 'Upcoming' && !item.tour) {
                            $select.append(
                                $('<option>', {
                                    value: item.id,
                                    text: `${item.id} - ${item.name} - ${item.state.name}`,
                                    'data-start': item.start_date_formatted,
                                    'data-end': item.end_date_formatted,
                                    'data-membership': item.membership,
                                })
                            );
                        }
                    });

                    $selectSuspend.append('<option value="">-- Select Profile --</option>');
                    $.each(records.data, function(i, item) {
                        $selectSuspend.append(
                            $('<option>', {
                                value: item.id,
                                text: `${item.id} - ${item.name} - ${item.state.name}`,
                                'data-start': item.start_date_formatted,
                                'data-end': item.end_date_formatted,
                                'data-membership': item.membership_number,
                            })
                        );
                    });

                    $selectCancel.append('<option value="">-- Select Profile --</option>');
                    $.each(records.data, function(i, item) {
                        $selectCancel.append(
                            $('<option>', {
                                value: item.id,
                                text: `${item.id} - ${item.name} - ${item.state.name}`,
                                'data-start': item.start_date_formatted,
                                'data-end': item.end_date_formatted,
                                'data-membership': item.membership_number,
                            })
                        );
                    });

                    $selectBumpUp.append('<option value="">-- Select Profile --</option>');
                    $.each(records.data, function(i, item) {
                        if (item.current_active_pinup == null) {
                            $selectBumpUp.append(
                                $('<option>', {
                                    value: item.id,
                                    text: `${item.id} - ${item.name} - ${item.state.name}`,
                                    'data-start': item.start_date_formatted,
                                    'data-end': item.end_date_formatted,
                                    'data-membership': item.membership,
                                })
                            );
                        }
                    });

                    let existPinup = records.data.some(profile => profile.latest_active_pinup !=
                        null);

                    if (!existPinup) {
                        $selectPinUp.append('<option value="">-- Select Profile --</option>');
                        $.each(records.data, function(i, item) {
                            if (item.membership == 'Platinum') {
                                $selectPinUp.append(
                                    $('<option>', {
                                        value: item.id,
                                        text: `${item.id} - ${item.name} - ${item.state.name}`,
                                        'data-start': item.start_date_formatted,
                                        'data-end': item.end_date_formatted,
                                        'data-membership': item.membership,
                                    })
                                );
                            }
                        });
                    } else {
                        $("#btn_pinup_profile").attr('disabled', 'disabled')
                    }

                    $selectUpgrade.append('<option value="">-- Select Profile --</option>');
                    $.each(records.data, function(i, item) {
                        if (item.membership !== 'Platinum') {
                            $selectUpgrade.append(
                                $('<option>', {
                                    value: item.id,
                                    text: `${item.id} - ${item.name} - ${item.state.name} - ${item.membership}`,
                                    'data-start': item.start_date_formatted,
                                    'data-end': item.end_date_formatted,
                                    'data-membership': item.membership_number,
                                })
                            );
                        }
                    });
                    $(".listingActionButtons button").show();
                }


            },
            initComplete: function() {
                // if ($('#returnToReportBtn').length === 0) {
                //     $('.dataTables_filter').append(
                //         '<button id="returnToReportBtn" class="create-tour-sec my-3">Return to Report</button>'
                //     );
                // }
                $('#returnToReportBtn').on('click', function() {
                    var table = $('#sailorTable').DataTable();
                    table.search('').draw();
                });
            },

            ajax: {
                url: "{{ route('escort.list.dataTable', $type) }}",
                data: function(d) {
                    d.type = 'player';
                }


                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'pro_name',
                        name: 'profile_name',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'state_name',
                        name: 'state_name',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'stage_name',
                        name: 'stage_name',
                        searchable: false,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'membership',
                        name: 'membership',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA',
                        visible: shouldHide
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'timezone_created_at',
                        name: 'created_at',
                        searchable: false,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'statusBtn',
                        name: 'statusBtn',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date',
                        searchable: false,
                        orderable: true,
                        visible: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'action',
                        name: 'start_date',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA',
                        class: 'text-center'
                    },
                ],
                order: [8, 'asc'],
                pageLength: {{$datatable_entries }},
                lengthMenu: [25, 50, 75, 100],
            });
            //    $('#sailorTable_filter label').append('<i class="fa fa-search "></i>');

        $('#profile_state_id').change(function() {
            var stateId = $(this).val();
            console.log("id =" + $(this).val());
            var url = "{{ route('escort.stateByCity', ':id') }}";
            url = url.replace(':id', stateId);
            //console.log(url);
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    stateId: stateId
                },
                contentType: "application/json",
                success: function(data) {
                    var optionString = '';
                    $.each(data.data, function(index, elem) {
                        $('#profile_city_id').val(index);
                    });
                },
            });
        });

        $("#duplicate_profile_form").on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var parsleyForm = form.parsley();
            parsleyForm.whenValidate().then(function() {
                var url = "{{ route('escort.duplicate.profile') }}";
                var data = new FormData(form[0]);

                $.ajax({
                    method: 'POST',
                    url: url,
                    data: data,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        form.find('button[type=submit]').prop('disabled', true)
                            .html('<div class="spinner-border"></div>');
                    },
                    success: function(data) {
                        if (data.response.success) {
                            Swal.fire({
                                icon: "success",
                                text: data.response.message
                            });
                            form.find('button[type=submit]').prop('disabled', false)
                                .html('Save');
                            table.draw();
                            $("#duplicate_profile_form")[0].reset();
                            $('#duplicate-profile-modal').modal('hide');
                        } else {
                            Swal.fire({
                                icon: "error",
                                text: data.response.message
                            });
                        }
                    },

                });
            }, function() {
                console.log('Form validation failed');
            });
        });

    });

    // var formatDateLocal = function(date) {
    //     let y = date.getFullYear();
    //     let m = String(date.getMonth() + 1).padStart(2, '0');
    //     let d = String(date.getDate()).padStart(2, '0');
    //     return `${y}-${m}-${d}`;
    // }

    var getDateAfter = function(dateStr, after = 1) {
        let [day, month, year] = dateStr.split('-');
        let date = new Date(year, month - 1, day);
        date.setDate(date.getDate() + after);
        return `${String(date.getDate()).padStart(2, '0')}-${String(date.getMonth() + 1).padStart(2, '0')}-${date.getFullYear()}`;
    }

    let extendFrom = $(".modal-form-extend form");
    let extendFromButton = extendFrom.find('.modal-footer button[type="submit"]');
    extendFromButton.prop('disabled', true);

    $(document).on('change', '#extendProfileId', function() {
        let previousEndDateValue = $(this).find(':selected').data('end'); //getDateAfter
        let membership = $(this).find(':selected').data('membership');
        let $membershipField = $('#extendMembership');
        let extendStartDateObject = $('#extendStartDate');
        let extendEndDateObject = $('#extendEndDate');
        let profileId = $(this).val();
        if ($.trim(profileId) != "") {
            extendEndDateObject.removeAttr('disabled');
            $("input[name='extend_days']").removeAttr('disabled');
            extendFromButton.prop('disabled', false);
        } else {
            extendEndDateObject.attr('disabled', 'disabled');
            $("input[name='extend_days']").attr('disabled', 'disabled');
            extendFromButton.prop('disabled', true);
        }
        switch (membership) {
            case 'Platinum': {
                $membershipField.val(1);
            }
            break;
            case 'Gold': {
                $membershipField.val(2);
            }
            break;
            case 'Silver': {
                $membershipField.val(3);
            }
            break;
            case 'Free': {
                $membershipField.val(4);
            }
        }
        if (previousEndDateValue) {
            extendStartDateObject.val(getDateAfter(previousEndDateValue, 1));
            extendEndDateObject.val(getDateAfter(previousEndDateValue, 2));
            extendEndDateObject.datepicker('option', 'minDate', extendStartDateObject.val());
        } else {
            extendEndDateObject.datepicker('option', 'minDate', null);
            extendEndDateObject.val('');
        }
    });

    $('input[name="extend_days"]').on('change', function() {
        let days = parseInt($(this).val(), 10);
        let previousEndDateValue = $('#extendProfileId').find(':selected').data('end');
        let extendEndDateObject = $('#extendEndDate');

        if (previousEndDateValue && days) {
            extendEndDateObject.val(getDateAfter(previousEndDateValue, days));
        } else {
            extendEndDateObject.val('');
        }
    });

    $(document).on('change', '#extendEndDate', function() {
        let selected = document.querySelector('.extend-period:checked');
        selected.checked = false;
    });

    $(document).on('change', '#extendEndDate, #extendProfileId, .extend-period', function() {
        let startDate = $('#extendStartDate').val();
        let endDate = $('#extendEndDate').val();
        let escortId = $('#extendProfileId').find(':selected').val();
        let formButton = document.querySelector("#extend_profile form button[type='submit']");

        if (startDate && escortId) {
            $.ajax({
                url: '/escort-dashboard/listing/validate-date-range',
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    startDate,
                    endDate,
                    escortId
                },
                beforeSend: function() {
                    formButton.disabled = true;
                    console.log(formButton);
                },
                success: function(response, textStatus, xhr) {
                    console.log('requestPayload2success', xhr, response);
                    if (response.success) {
                        formButton.disabled = false;
                    }
                },
                error: function(xhr, status, error) {
                    let response = readXHR(xhr);
                    displaySwal(xhr).then((result) => {
                        if (result.isConfirmed) {
                            $('#extendEndDate').val('');
                            formButton.disabled = false;
                        }
                    });
                }
            });
        }
    });


    $(document).on('click', '.delete-center122', function(e) {
        e.preventDefault();
        var $this = $(this);
        var table = $('#sailorTable').DataTable();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post({
                    type: 'POST',
                    url: $this.attr('href')
                }).done(function(data) {
                    if (data.error == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                            footer: '<a href="">Why do I have this issue?</a>'
                        })
                    } else {
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );

                        table.row($this.parents('tr')).remove().draw();
                    }


                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        });
    });
    $(document).on('click', '.delete-center', function(e) {
        e.preventDefault();
        var $this = $(this);
        $("#Lname").html("Would you like to Delete?");

        $('#delete_profile').modal('show');

        $("#save_change").click(function(e) {
            console.log($this.attr('href'));
            $.ajax({
                method: "POST",
                url: $this.attr('href'),
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    location.reload();
                }

            })
        });
    });
    $(document).on('click', '.brb-inactivate', function(e) {
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            method: "POST",
            url: $this.attr('href'),
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data.response.success) {
                    table.draw();
                } else {
                    Swal.fire(
                        'Oops!',
                        data.response.message,
                        'error'
                    );
                }
            }
        });
    });

    $('#duplicate-profile-modal').on('shown.bs.modal', function(e) {
        var source = $(e.relatedTarget);
        let modelElement = $(this);
        let selected_profile_id = $(source).data('id');
        $('#duplicate-profile-modal input[name=escort_id]').val(selected_profile_id);
        $("#stageNameInp").attr('type', 'hidden');
        $("#stageNameInp").attr('name', '');
        $(".update_stage_name").addClass('d-none');
        $("#stageName").removeClass('d-none');
        modelElement.find('input[name="address"]').val(source.data('address'));
        modelElement.find('select[name="name"]').val(source.data('name'));
        modelElement.find('select[name="state_id"]').val(source.data('state'));
    });

    $('#play-mates-modal').on('shown.bs.modal', function(e) {

        var name, city, source = e.relatedTarget;
        console.log($(source).data('url'));
        $('#hidden_escort_id').val($(source).data('id'));

        if (name = $(source).data('name')) {
            $('#playmate-modal-name').html('Playmates for ' + $(source).data('name'));
        }

        if (city = $(source).data('city')) {
            $('#playmate-modal-location').html(
                '<svg width="14" height="21" viewBox="0 0 14 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 10C6.33696 10 5.70107 9.73661 5.23223 9.26777C4.76339 8.79893 4.5 8.16304 4.5 7.5C4.5 6.83696 4.76339 6.20107 5.23223 5.73223C5.70107 5.26339 6.33696 5 7 5C7.66304 5 8.29893 5.26339 8.76777 5.73223C9.23661 6.20107 9.5 6.83696 9.5 7.5C9.5 7.8283 9.43534 8.15339 9.3097 8.45671C9.18406 8.76002 8.99991 9.03562 8.76777 9.26777C8.53562 9.49991 8.26002 9.68406 7.95671 9.8097C7.65339 9.93534 7.3283 10 7 10V10ZM7 0.5C5.14348 0.5 3.36301 1.2375 2.05025 2.55025C0.737498 3.86301 0 5.64348 0 7.5C0 12.75 7 20.5 7 20.5C7 20.5 14 12.75 14 7.5C14 5.64348 13.2625 3.86301 11.9497 2.55025C10.637 1.2375 8.85652 0.5 7 0.5V0.5Z" fill="#FF3C5F"></path></svg>' +
                $(source).data('city'));
        }

        $.ajax({
            url: $(source).data('url'),
            success: function(data) {
                $('#playmate-template').html(data);
            }
        });
    });

    $('#play-mates-modal').on('hidden.bs.modal', function() {
        $('#playmate-template').html(
            '<div class="spinner-border text-secondary" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div>'
        );
        $('#playmate-modal-name').html('');
        $('#playmate-modal-location').html('');
    });

    $('#search-playmate-input').select2({
        dropdownParent: $("#play-mates-modal"),
        width: '100%',
        dropdownCssClass: "bigdrop",
        placeholder: {
            id: 0, // the value of the option
            text: "{{ asset('assets/app/img/service-provider/Frame-408.png') }}",
            name: 'Search playmate',
            member_id: 'Type name or member id',
        },
        allowClear: true,
        language: {
            inputTooShort: function() {
                return 'Enter Member Id or Name';
            }
        },
        createTag: function(params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: true // add additional parameters
            }
        },
        tags: false,
        minimumInputLength: 2,
        tokenSeparators: [','],
        ajax: {
            url: "{{ route('escort.playmates.find') }}",
            dataType: "json",
            type: "POST",
            data: function(params) {

                var queryParameters = {
                    query: params.term,
                    escort_id: $('#hidden_escort_id').val()
                }
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {

                        return {
                            text: item.default_image,
                            name: item.name,
                            member_id: item.member_id,
                            id: item.id
                        }
                    })
                };
            }
        },
        templateResult: formatEscortList,
        templateSelection: formatEscortList
    });

    $('#search-playmate-input').on('change', function(e) {
        console.log('ll', $(this).val());
        if ($(this).val()) {
            $('#playmate_submit_button').show();
        } else {
            $('#playmate_submit_button').hide();
        }
    });

    function formatEscortList(data) {
        console.log('ckjoiujk;', data);
        return $(
            '<span><img class="profile-user-img img-responsive img-circle img-profile rounded-circle small-round-fixed" src="' +
            data.text + '"> ' + data.name + ' || ' + data.member_id + '</span>');
    }

    $('#add-playmate-form').on('submit', function(e) {
        e.preventDefault();
        $('#playmate_submit_button').attr('disabled', true);
        $('#playmate_submit_button').html(
            '<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
        var $this = $(this);
        var escort_id = $('#hidden_escort_id').val();
        var member_id = $('#search-playmate-input').val();
        var url = $this.attr('action');
        $.post({
            type: $this.attr('method'),
            url: url,
            data: {
                escort_id: escort_id,
                playmate_id: member_id
            },
            success: function(data) {
                $('#search-playmate-input').val('');
                $('#playmate_submit_button').hide();
                $('#playmate-template').html(data);
            },
            error: function(data) {
                console.log(data);
            },
        }).done(function(data) {
            $('#playmate_submit_button').attr('disabled', false);
            $('#playmate_submit_button').html('Add Playmate');

            //$("#search-playmate-input").select2("val", "");

            $("#search-playmate-input").empty().trigger('change')
        });
    });

    $(document).on('click', '.remove-playmate', function(e) {
        e.preventDefault();

        var $this = $(this);
        var escort_id = $this.data('escort_id');
        var playmate_id = $this.data('playmate_id');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Remove',
            cancelButtonText: 'Cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post({
                    type: 'POST',
                    url: "{{ route('escort.playmates.remove') }}",
                    data: {
                        escort_id: escort_id,
                        playmate_id: playmate_id
                    },
                }).done(function(data) {
                    if (data.error == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message
                        });
                    } else {
                        swalWithBootstrapButtons.fire({
                            icon: 'success',
                            title: '',
                            text: data.message
                        });

                        $('#playmate-template').html(data.template);
                    }
                });
            }
        });
    });

    window.Parsley.addValidator('time', {
        validateString: function(value) {
            // Regex to validate time in HH:MM format (24-hour)
            return /^([01]\d|2[0-3]):([0-5]\d)$/.test(value);
        },
        messages: {
            en: 'Please enter a valid time (HH:MM).'
        }
    });
    $('#brb_form').parsley({});


    $("#brb_form").on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var profileId = $("#profile_id").val();
        var url = "{{ route('escort.brb.add') }}";
        var data = new FormData(form[0]);
        var selectedProfileName = $('#profile_id option:selected').attr('profile_name');

        $.ajax({
            method: 'POST',
            url: url,
            data: data,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data.response.success) {
                    Swal.fire({
                        icon: "success",
                        text: data.response.message
                    });
                    $("#brb_form")[0].reset();
                    $('#add_brb').modal('hide');
                    table.draw();
                } else {
                    Swal.fire({
                        icon: "error",
                        text: data.response.message
                    });
                }
            },

        });
    });

    $("#modal_close").on('click', function(e) {
        $("#brb_form")[0].reset();
        $("#suspend_form")[0].reset();
    });

    $(document).ready(function() {
        /* start handle suspend modal start and end date calendars */
        let suspendProfileObject = $('#suspendProfileId');
        let suspendStartDateObject = $('#suspendStartDate');
        let suspendEndDateObject = $('#suspendEndDate');
        let suspendFrom = $(".modal-form-suspend");
        let suspendFromButton = suspendFrom.find('.modal-footer button[type="submit"]');
        suspendFromButton.prop('disabled', true);

        suspendStartDateObject.datepicker('setDate', +1);
        suspendStartDateObject.datepicker('option', 'minDate', +1);

        suspendEndDateObject.datepicker('option', 'minDate', +1);

        suspendStartDateObject.datepicker('option', 'onSelect', function() {
            suspendEndDateObject.datepicker('option', 'minDate', $(this).val());
            suspendEndDateObject.datepicker('option', 'setDate', $(this).val());
            calculateCredit();
        });

        suspendEndDateObject.datepicker('option', 'onSelect', function() {
            suspendStartDateObject.datepicker('option', 'maxDate', $(this).val());
            calculateCredit();
        });

        suspendProfileObject.on('change', function() {
            let selectedOption = $(this).find(':selected');
            let listingMembership = selectedOption.data('membership');
            let listingStartDate = selectedOption.data('start');
            let listingEndDate = selectedOption.data('end');
            let profileId = selectedOption.val();

            suspendStartDateObject.datepicker('setDate', +1);
            suspendStartDateObject.datepicker('option', 'minDate', +1);
            suspendStartDateObject.datepicker('option', 'maxDate', listingEndDate);

            suspendEndDateObject.datepicker('setDate', null);
            suspendEndDateObject.datepicker('option', 'maxDate', listingEndDate);
            $("#creditCalculationLive").html('0.00');
            suspendFromButton.prop('disabled', true);
        });

        function calculateCredit() {
            let selectedOption = suspendProfileObject.find(':selected');
            if (suspendEndDateObject.val() && suspendStartDateObject.val()) {
                $.ajax({
                    url: "{{ route('suspend.calculate.credit.live') }}",
                    method: 'POST',
                    data: {
                        start_date: suspendStartDateObject.val(),
                        end_date: suspendEndDateObject.val(),
                        profile_id: selectedOption.val(),
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        suspendFromButton.prop('disabled', true);
                    },
                    success: function(response) {
                        $("#creditCalculationLive").html('0.00');
                        if (response.success) {
                            $("#creditCalculationLive").html(response.refund_amount);
                            $("#suspend_form").find('button[type=submit]').removeAttr('disabled');
                            suspendFromButton.prop('disabled', false);
                        } else {
                            $("#suspend_form").find('button[type=submit]').attr('disabled',
                                'disabled');
                            Swal.fire({
                                icon: "error",
                                text: response.message
                            });
                        }
                    }
                });
            }
        }

        /* end handle suspend modal start and end date calendars */
    });

    $("#suspend_form").on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = "{{ route('escort.profile.suspend') }}";
        var data = new FormData(form[0]);

        $.ajax({
            method: 'POST',
            url: url,
            data: data,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                showLoadingPopup();
                $("#suspend_form").find('button[type=submit]').attr('disabled', 'disabled');
            },
            success: function(data) {
                Swal.close();
                if (data.response.success) {
                    Swal.fire({
                        icon: "success",
                        text: data.response.message
                    });

                    // set suspend icon to profile 
                    $('#suspend_profile').modal('hide');
                    table.draw();
                } else {
                    Swal.fire({
                        icon: "error",
                        text: data.response.message
                    });
                }
                $("#suspend_form").find('button[type=submit]').removeAttr('disabled');
            },

        });
    });

    function stageNameInput(ele) {
        if ($(ele).val() == 'new') {
            $(ele).addClass('d-none');
            $("#stageNameInp").attr('type', 'text');
            $("#stageNameInp").attr('name', 'name');
            $(".update_stage_name").removeClass('d-none');
        }
        return true;
    }
</script>
<script src="{{ asset('js/escort/pinup.js') }}"></script>
<script src="{{ asset('js/escort/bumpup.js') }}"></script>
<script src="{{ asset('js/escort/upgrade.js') }}"></script>
@endprepend