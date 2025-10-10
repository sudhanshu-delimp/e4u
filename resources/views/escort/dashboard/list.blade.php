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
        #btn_add_brb,
        #btn_pinup_profile {
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
    </style>
@endsection
@section('content')
    <div class="d-flex flex-column container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <div class="row">
            <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1">{{ $type == 'past' ? 'Archive' : 'Listed' }}
                    Profiles</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#profile_and_tour_options"><b>Help?</b> </span>
            </div>
            <div class="col-md-12 mb-4 collapse" id="profile_and_tour_options">               
                <div class="card " id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>Use this feature to review and make changes to your Profiles.</li>
                            <li>You can view and edit a Profile by selecting 'Action'. By selecting the Action
                                function, you will be able to {{ $type == 'past' ? 'Duplicate,' : '' }} Delete, Edit
                                or
                                View the Profile.</li>
                            <li>To suspend a Profile listing go to <a href="/escort-dashboard/listings/upcoming"
                                    class="custom_links_design">View Listings</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div id="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-body table table-hover">
                        @if ($type != 'past')
                            <div>
                                <div class="add--list">
                                <div class="">
                                <button style="padding: 10px;" class="btn btn-info custom-btn-info" data-toggle="modal"
                                    data-target="#add_brb" id="btn_add_brb">Add BRB</button>
                                <button style="padding: 10px;" class="btn btn-primary" data-toggle="modal"
                                    data-target="#suspend_profile" id="btn_suspend_profile">Suspend Profile</button>
                                <button style="padding: 10px;" class="btn btn-custom-success" data-toggle="modal" data-target="#extend_profile" id="btn_extend_profile"> Extend Profile  </button>
                                </div>
                                <div class="pinup-tooltip-wrapper">
                                    <button style="padding: 10px;" class="btn btn-warning" data-toggle="modal"
                                        data-target="#pinup_profile" id="btn_pinup_profile" @if($activePinup) disabled title="" @endif>List Pin
                                        Up</button>
                                        @if($activePinup)
                                        <p class="pinup-tooltip">You already have an active pinup. You can book after it expires. </span>
                                        @endif
                                </div>
                                </div>
                            </div>
                            <br>
                        @endif
                        <table class="table table-hover" id="sailorTable">
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
                                    <!--<th>Joined E4U</th>-->
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                        </table>
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
    <div class="modal fade upload-modal" id="extend_profile" tabindex="-1" role="dialog" aria-labelledby="extendProfileTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <form action="{{ route('escort.account.listing_checkout')}}" method="POST" id="extend_form">
            {{ csrf_field() }}
            <div class="modal-content" style="width: 800px;position: absolute;top: 30px;">
              <div class="modal-header">
                <h5 class="modal-title">
                  <img src="/assets/app/img/profile-30.png" class="custompopicon" alt="extend" style="margin-right: 10px;">
                  Extend Profile
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">
                    <img id="modal_close_extend" src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                  </span>
                </button>
              </div>
      
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="container p-0">
      
                      <!-- Profile select -->
                      <div class="form-group row">
                        <label class="col-sm-3" for="">Profile:</label>
                        <div class="col-sm-8 pr-2">
                          <select class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp"
                                  id="extendProfileId"
                                  name="escort_id[]"
                                  data-parsley-errors-container="#extend-profile-errors"
                                  required
                                  data-parsley-required-message="Select Profile">
                            <option value="">Select Profile</option>
                            
                          </select>
                          <span id="extend-profile-errors"></span>
                        </div>
                      </div>
      
                      <!-- Extend Period -->
                      <div class="form-group row extend--profile">
                        <label class="col-sm-3">Extend Period:</label>
                        <div class="col-sm-9 row">
                          <div class="col-sm-6">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input extend-period" type="radio" name="extend_days" id="extendDay1" value="1" disabled>
                              <label class="form-check-label" for="extendDay1">1 day</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input extend-period" type="radio" name="extend_days" id="extendDay5" value="5" disabled>
                              <label class="form-check-label" for="extendDay5">5 days</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input extend-period" type="radio" name="extend_days" id="extendDay10" value="10" disabled>
                              <label class="form-check-label" for="extendDay10">10 days</label>
                            </div>
                          </div>
                          <div class="col-sm-5 pr-1">
                            <input type="hidden" name="membership[]" id="extendMembership">
                            <input type="hidden" name="start_date[]" id="extendStartDate">
                            <input type="date" id="extendEndDate" class="form-control form-control-sm removebox_shdow" name="end_date[]" required disabled>
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
                          <ol class="pl-4">
                            <li>The Fee is calculated according to the Membership Type.</li>
                            <li>You agree to your Card being debited the Fee.</li>
                            <li>Details of this transaction can be viewed in the Transaction Summary.</li>
                          </ol>
                        </div>
                      </div>
      
                    </div>
                  </div>
                </div>
              </div>
      
              <div class="modal-footer" style="text-align: center; display: block;">
                <button type="submit" class="btn-success-modal">Proceed</button>
              </div>
            </div>
          </form>
        </div>
      </div>      
  <!-- end extend profile modal -->  

    <!-- suspend profile modal start here -->
    <div class="modal fade upload-modal" id="suspend_profile" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static"
        aria-modal="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="suspend_form">
                <div class="modal-content" style="width: 800px;position: absolute;top: 30px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">
                                <img src="/assets/app/img/deactivate.png" class="custompopicon" alt="cross" style="margin-right: 10px;"> Suspend Profile</h5>
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
                                            <input type="hidden" name="hiddenSuspendPlanId" id="hiddenSuspendPlanId">
                                            <input type="hidden" id="hiddenSuspendProfileId">
                                            <input type="hidden" id="hiddenDiffDays" name="diffDays">
                                            <div class="col-sm-8">
                                                <select
                                                    class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp"
                                                    id="suspendProfileId" name="suspend_profile_id"
                                                    data-parsley-errors-container="#profile-errors" required
                                                    data-parsley-required-message="Select Profile">
                                                    <option value="">Select Profile</option>
                                                    @foreach ($suspended_escorts as $profile)
                                                        <option data-membership="{{ $profile['membership'] }}"
                                                            value="{{ $profile['id'] }}"
                                                            profile_name="{{ $profile['profile_name'] }}">
                                                            {{ $profile['id'] }} - {{ $profile['name'] }} @if (isset($profile['state']['name']))
                                                                - {{ $profile['state']['name'] }}
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span id="profile-errors"></span>
                                            </div>
                                            <div class="col-sm-1"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3" for=""> Suspension Period:</label>
                                            <div class="col-sm-9 row">
                                                @php
                                                    $minDate = \Carbon\Carbon::now()->addDay()->format('Y-m-d');
                                                @endphp
                                                <div class="col-sm-5">
                                                    <input type="date" id="suspendStartDate" required
                                                        min="{{ $minDate }}"
                                                        class="form-control form-control-sm removebox_shdow"
                                                        value="{{ $minDate }}" name="start_date"
                                                        data-parsley-type="" data-parsley-type-message="">
                                                    <span id="brb-time-errors"></span>
                                                </div>
                                                <div class="col-sm-1">
                                                    <span>to:</span>
                                                </div>
                                                <div class="col-sm-5">
                                                    <input type="date" id="suspendEndDate" required
                                                        min="{{ $minDate }}" max=""
                                                        class="form-control form-control-sm removebox_shdow"
                                                        name="end_date" data-parsley-type="" value="{{ $minDate }}"
                                                        data-parsley-type-message="">
                                                    <span id="brb-time-errors"></span>
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
                                        {{-- <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="">Credit:</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text" style="border-radius: 0rem; font-size:0.8rem;padding: 0px 10px;">$</span>
                                                <input type="number" readonly class="form-control"  step="0.01" min="0"  name="credit_price" value="0.0" id="credit_price" required>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <hr style="background-color: #0C223D" class="mt-4"> 
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <p class="mb-1"><b>Notes:</b></p>
                                                <ol class="pl-4">
                                                    <li> Use this feature to review and
                                                        make changes to your Profiles. Any changes you make to a Profile
                                                        will be applied to the
                                                        Profile once the changes are saved.</li>
                                                    <li> Once your Profile is suspended, it cannot be reinstated for the
                                                        suspended period.</li>
                                                    <li> To suspend a Profile listing,
                                                        click the button. You will be credited with the Fees according to
                                                        the suspension period.</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="text-align: center; display: block;">
                            <button type="submit" class="btn-success-modal" id="save_brb">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- end suspend profile modal -->

    <div class="modal programmatic" id="delete_profile" style="display: none">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content custome_modal_max_width">
                <div class="modal-header main_bg_color border-0">
                    <h5 class="modal-title" id="" style="color:white"><img src="/assets/app/img/block-user.png" class="custompopicon" alt="cross"> Delete Profile
                    </h5>
                   
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="current" name="current">
                    <input type="hidden" id="previous" name="previous">
                    <input type="hidden" id="label" name="label">
                    <input type="hidden" id="trigger-element">
                    <h3 class=""><span id="Lname"></span> </h3>
                    <h3 class=""><span id="log"></span> </h3>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel-modal" data-dismiss="modal"
                            value="close" id="close_change">Close</button>
                        <button type="button" class="btn-success-modal"
                            id="save_change">Delete</button>
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
@push('script')
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
                    if (records.recordsTotal > 0) {
                        $select.append('<option value="">-- Select Profile --</option>');
                        $.each(records.data, function (i, item) {
                            if(!item.is_extended){
                                $select.append(
                                    $('<option>', {
                                    value: item.id,
                                    text: `${item.id} - ${item.name} - ${item.state.name}`,
                                    'data-start': item.start_date,
                                    'data-end': item.end_date,
                                    'data-membership':item.membership,
                                    })
                                );
                            }
                        });
                    }

                    var api = this.api();
                    // var records = api.data().length;
                    var length = table.page.info().recordsTotal;
                    if (length == 0) {
                        $('#btn_suspend_profile').hide();
                        $('#btn_add_brb').hide();
                        $('#btn_pinup_profile').hide();
                    } else {
                        $('#btn_suspend_profile').show();
                        $('#btn_add_brb').show();
                        $('#btn_pinup_profile').show();
                    }

                    if (length <= 10) {
                        $('.dataTables_paginate').show();
                    } else {
                        $('.dataTables_paginate').show();
                    }
                },
                initComplete: function() {
                    if ($('#returnToReportBtn').length === 0) {
                        $('.dataTables_filter').append(
                            '<button id="returnToReportBtn" class="create-tour-sec my-3">Return to Report</button>'
                        );
                    }
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
                        searchable: false,
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
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'membership',
                        name: 'membership',
                        searchable: false,
                        orderable: true,
                        defaultContent: 'NA',
                        visible: shouldHide
                    },
                    //{ data: 'city_name', name: 'city_name', searchable: false, orderable:true ,defaultContent: 'NA'},

                    {
                        data: 'phone',
                        name: 'phone',
                        searchable: false,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'timezone_created_at',
                        name: 'created_at',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'enabled',
                        name: 'enabled',
                        searchable: false,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'action',
                        name: 'edit',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                ],
                order: [1, 'asc'],
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

        var formatDateLocal = function(date) {
            let y = date.getFullYear();
            let m = String(date.getMonth() + 1).padStart(2, '0');
            let d = String(date.getDate()).padStart(2, '0');
            return `${y}-${m}-${d}`;
        }

        $(document).on('change','#extendProfileId', function () {
            let endDate = $(this).find(':selected').data('end');
            let membership = $(this).find(':selected').data('membership');
            let startDate = $('#extendStartDate');
            let $membershipField = $('#extendMembership');
            let $dateField = $('#extendEndDate');
            let profileId = $(this).val();
            if($.trim(profileId)!=""){
                $dateField.removeAttr('disabled');
                $("input[name='extend_days']").removeAttr('disabled');
            }
            else{
                $dateField.attr('disabled','disabled');
                $("input[name='extend_days']").attr('disabled','disabled');
            }
            switch(membership){
                case 'Platinum':{
                    $membershipField.val(1);
                }break;
                case 'Gold':{
                    $membershipField.val(2);
                }break;
                case 'Silver':{
                    $membershipField.val(3);
                }break;
                case 'Free':{
                    $membershipField.val(4);
                }
            }
            if (endDate) {
                let extendStartDate = new Date(endDate);
                let extendEndDate = new Date(endDate);
                extendStartDate.setDate(extendStartDate.getDate() + 1);
                extendEndDate.setDate(extendEndDate.getDate() + 2);
                startDate.val(formatDateLocal(extendStartDate));
                $dateField.attr('min', formatDateLocal(extendEndDate)).val(formatDateLocal(extendEndDate));
                if ($dateField.val() && $dateField.val() < formatDateLocal(extendEndDate)) {
                    $dateField.val('');
                }
            } else {
                $dateField.removeAttr('min');
                $dateField.val('');
            }
        });

        $('input[name="extend_days"]').on('change', function () {
            let days = parseInt($(this).val(), 10);
            let $select = $('#extendProfileId');
            let endDate = $select.find(':selected').data('end');
            let $dateField = $('#extendEndDate');

            if (endDate && days) {
                let newDate = new Date(endDate);
                newDate.setDate(newDate.getDate() + days + 1);

                $dateField.val(formatDateLocal(newDate));
                //$dateField.prop('readonly', true); // make readonly
            } else {
                $dateField.val('');
                //$dateField.prop('readonly', false);
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
            
            if(startDate && escortId){
                console.log(escortId, startDate, endDate);
                $.ajax({
                url: '/escort-dashboard/listing/validate-date-range',
                method: 'POST',
                headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {startDate,endDate,escortId},
                beforeSend:function (){
                    formButton.disabled = true;
                    console.log(formButton);
                },
                success: function (response) {
                    if(response.success){
                        $('#extendEndDate').val('');
                        Swal.fire({
                            title: 'Listings',
                            text: `${response.message}`,
                            icon: 'warning'
                        });
                    }
                    formButton.disabled = false;

                },
                error: function (xhr, status, error) {
                console.error('Error in location filter:', error);
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
            $("#Lname").html("<p>Would you like to Delete?</p>");

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
            var source = e.relatedTarget;
            let selected_profile_id = $(source).data('id');
            let selected_profile_state = $(source).data('state');
            $('#duplicate-profile-modal input[name=escort_id]').val(selected_profile_id);
            $("#stageNameInp").attr('type', 'hidden');
            $("#stageNameInp").attr('name', '');
            $(".update_stage_name").addClass('d-none');
            $("#stageName").removeClass('d-none');
            // $(`#profile_state_id option`).show(); 
            // $(`#profile_state_id option[value="${selected_profile_state}"]`).hide(); 
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
            $('#suspendStartDate, #suspendEndDate').on('change', function() {
                let startDate = $('#suspendStartDate').val();
                let endDate = $('#suspendEndDate').val();

                calculateCredit(startDate, endDate);
            });

            function calculateCredit(startDate, endDate) {
                if (startDate && endDate) {
                    let start = new Date(startDate);
                    let end = new Date(endDate);

                    // Set time to start of day for both
                    start.setHours(0, 0, 0, 0);
                    end.setHours(0, 0, 0, 0);

                    // Calculate the difference in days (inclusive)
                    let diffTime = end - start;
                    let diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24)) + 1;
                    let planId = $('#hiddenSuspendPlanId').val();
                    var profileId = $('#hiddenSuspendProfileId').val();
                    $('#hiddenDiffDays').val(diffDays);

                    $.ajax({
                        url: '{{ route('suspend.calculate.credit.live') }}',
                        method: 'POST',
                        data: {
                            plan_id: planId,
                            days: diffDays,
                            profile_id: profileId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log('response')
                            console.log(response)
                            $('#creditCalculationLive').text(response.total_rate);
                            $('#suspendEndDate').attr('max', response.end_date);
                            $('#suspendStartDate').attr('max', response.start_date);

                            console.log($('#suspendEndDate').attr('max'), $('#suspendStartDate').attr(
                                'max'), ' jite');
                        }
                    });
                }
            }

            $('#suspendProfileId').on('change', function() {
                // var selectedPlanId = $(this).data('membership'); // Get selected profile ID
                var selectedPlanId = $(this).find(':selected').data('membership');
                var profileId = $(this).val();

                console.log("plan range " + selectedPlanId, profileId);

                $('#hiddenSuspendProfileId').val(profileId); // Set to hidden input
                $('#hiddenSuspendPlanId').val(selectedPlanId); // Set to hidden input

                let startDate = $('#suspendStartDate').val();
                let endDate = $('#suspendEndDate').val();

                calculateCredit(startDate, endDate);
            });
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
                success: function(data) {
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
@endpush
