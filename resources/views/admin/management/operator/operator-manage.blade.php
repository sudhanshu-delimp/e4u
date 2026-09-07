@extends('layouts.admin')
@section('style')
    <style>

    </style>
@stop
@section('content')
    @php
        $securityLevel = isset(auth()->user()->staff_detail->security_level)
            ? auth()->user()->staff_detail->security_level
            : 0;
        $addAccess = staffPageAccessPermission($securityLevel, 'add');
        $addAccessEnabled = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';
        $editAccess = staffPageAccessPermission($securityLevel, 'edit');
        $editAccessEnabled = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
        $adv_commissionfee =  $commissionfee[0]['amount'];
        $massg_commissionfee =$commissionfee[1]['amount'];
        $commissionAdvertisingType = $commissionfee[0]['amount_type'];
        $commissionRegistrationType = $commissionfee[1]['amount_type'];
    @endphp
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                <div class="row">
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">Manage Operator</h1>
                        <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes"
                            aria-expanded="true">Help?</span>
                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="card collapse" id="notes">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b></h3>
                                <ol>
                                    <li>Manage the Operator from here.</li>
                                    <li>Update the Operator's details and status from here.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="row pb-3">
                            @if ($addAccessEnabled)
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="bothsearch-form" style="gap: 10px;">
                                        @if (count($countryNotAssignToOperator) > 0)
                                            <button type="button" class="btn-common mr-0" data-toggle="modal"
                                                data-target="#addOperator">Add Operator</button>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="table-responsive">
                            <table class="table mb-3" id="operator_data_table">
                                <thead class="table-bg">
                                    <tr>
                                        <th>ID</th>
                                        <th>Operator</th>
                                        <th>Territory</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Agents</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-content">

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Operator popup form -->
    <div class="modal fade upload-modal" id="addOperator" tabindex="-1" role="dialog" aria-labelledby="addOperatorLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addOperatorTitle"> <img
                            src="{{ asset('assets/dashboard/img/operators.png') }}" class="custompopicon"> Add New Operator
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="add_operator" id="add_operator" method="POST" action="{{ route('admin.add.operator') }}"
                        enctype="multipart/form-data">
                        <div class="row">
                            <!-- Section: Personal Details -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Operator Details</h6>
                            </div>

                            <div class="col-6 mb-3">
                                <label class="form-check-label" for="operator_id">Operator ID</label>
                                <input type="text" class="form-control rounded-0" readonly>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-check-label" for="date_ppointed">Date Appointed</label>
                                <input type="text" class="form-control rounded-0" readonly>
                            </div>

                            <div class="col-6 mb-3">
                                <label class="form-check-label" for="company_name">Company Name</label>
                                <input type="text" class="form-control rounded-0" name="company_name" id="company_name">
                                <span class="text-danger error-company_name"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-check-label" for="business_name">Business Name</label>
                                <input type="text" class="form-control rounded-0" name="business_name"
                                    id="business_name">
                                <span class="text-danger error-business_name"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-check-label" for="abn">ABN</label>
                                <input type="text" class="form-control rounded-0" name="abn" id="abn"
                                    maxlength="11">
                                <span class="text-danger error-abn"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-check-label" for="business_address">Business Address</label>
                                <input type="text" class="form-control rounded-0" name="business_address"
                                    id="business_address">
                                <span class="text-danger error-business_address"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-check-label" for="business_number">Business Number</label>
                                <input type="text" class="form-control rounded-0" name="business_number"
                                    id="business_number" oninput="this.value = this.value.replace(/\D/g,'');"
                                    maxlength="14">
                                <span class="text-danger error-business_number"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-check-label" for="point_of_contact">Point of Contact</label>
                                <input type="text" class="form-control rounded-0" name="point_of_contact"
                                    id="point_of_contact">
                                <span class="text-danger error-point_of_contact"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-check-label" for="phone">Mobile</label>
                                <input type="text" class="form-control rounded-0 formatMobile" name="phone"
                                    id="phone" oninput="this.value = this.value.replace(/\D/g,'');" maxlength="14"
                                    onfocus="this.value = this.value.replace(/\D/g,'');">
                                <span class="text-danger error-phone"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-check-label" for="email">Email</label>
                                <input type="email" class="form-control rounded-0" name="email" id="email">
                                <span class="text-danger error-email"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-check-label" for="country_id">Territory</label>
                                <select class="form-control rounded-0" name="country_id" id="country_id">
                                    <option value="">Select Territory</option>
                                    @foreach ($countryNotAssignToOperator as $skey => $country)
                                        <option value="{{ $skey }}">{{ $country['name'] }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-country_id"></span>
                            </div>
                            <div class="col-12 mb-3 d-flex align-items-center justify-content-start gap-10 flex-wrap">
                                <h6 class="mb-0 text-blue-primary">Method of Contact:</h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_1"
                                        name="contact_type[]" value="1">
                                    <label class="form-check-label" for="viewer_contact_type_1">Messaging</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_2"
                                        name="contact_type[]" value="2">
                                    <label class="form-check-label" for="viewer_contact_type_2">Text</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_3"
                                        name="contact_type[]" value="3">
                                    <label class="form-check-label" for="viewer_contact_type_3">Email</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_4"
                                        name="contact_type[]" value="4">
                                    <label class="form-check-label" for="viewer_contact_type_4">Call Us</label>
                                </div>
                                <span class="text-danger error-contact_type"></span>
                            </div>
                            <!-- Section: Agreement Details -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Agreement Details</h6>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-check-label" for="agreement_date">Date</label>
                                <input type="text" class="form-control rounded-0 js_datepicker" name="agreement_date"
                                    id="agreement_date">
                                <span class="text-danger error-agreement_date"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-check-label" for="term">Term</label>
                                <input type="text" class="form-control rounded-0" name="term" id="term">
                                <span class="text-danger error-term"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-check-label" for="term">Fee</label>
                                <input type="text" class="form-control rounded-0" name="fee" id="fee"
                                    maxlength="100">
                                <span class="text-danger error-fee"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Upload Agreement</h6>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="file" name="agreement_file" id="agreement_file">
                                <span class="text-danger error-agreement_file"></span>
                            </div>

                            <div class="col-6 mb-3 my-auto text-right" id="file_preview"></div>
                        </div>
                        <div class="row">

                            <!-- Commission -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Commission</h6>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label" for="commission_advertising_percent">Advertising</label>
                                <input class="form-control rounded-0" placeholder="Advertising"
                                    name="commission_advertising_percent" id="commission_advertising_percent"
                                    maxlength="10" value="{{ $feeAdvertising }}">
                                <span class="text-danger error-commission_advertising_percent"></span>
                            </div>



                            <div class="col-6 mb-3">
                                <label lass="form-label" for="commission_registration_type">Amount Type</label>
                                <select class="form-control rounded-0" name="commission_registration_type"
                                    id="commission_registration_type">
                                    {{-- <option value="">Amount Type</option> --}}
                                    <option value="percent" {{ $commissionAdvertisingType == 'percent' ? 'selected' : '' }}>
                                        Percent</option>
                                   {{--  <option value="fixed"{{ $commissionAdvertisingType == 'fixed' ? 'selected' : '' }}>Fixed
                                    </option> --}}
                                </select>
                                <span class="text-danger error-commission_registration_type"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label" for="commission_massage_centre_percent">Massage Centre
                                    (Registrations)</label>
                                <input class="form-control rounded-0" placeholder="Massage Centre (Registrations)"
                                    name="commission_massage_centre_percent" id="commission_massage_centre_percent"
                                    maxlength="10" value="{{ $feeMassage }}">
                                <span class="text-danger error-commission_massage_centre_percent"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label lass="form-label" for="commission_registration_type">Amount Type</label>
                                <select class="form-control rounded-0" name="commission_registration_type"
                                    id="commission_registration_type">
                                    {{-- <option value="">Amount Type</option> --}}
                                    <option value="percent" {{ $commissionRegistrationType == 'percent' ? 'selected' : '' }}>
                                        Percent</option>
                                    {{-- <option value="fixed"{{ $commissionRegistrationType == 'fixed' ? 'selected' : '' }}>
                                        Fixed
                                    </option> --}}
                                </select>
                                <span class="text-danger error-commission_registration_type"></span>
                            </div>

                        </div>
                        <div class="modal-footer p-0 pl-2 pb-4">
                            <button type="submit" class="btn-success-modal mr-2">Save</button>
                            <button type="button" class="btn-cancel-modal" data-dismiss="modal"
                                aria-label="Close">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->

    <!-- Edit Operator popupform -->
    <div class="modal fade upload-modal" id="editOperatorModel" tabindex="-1" role="dialog"
        aria-labelledby="editOperatorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOperatorTitle">
                        <img src="{{ asset('assets/dashboard/img/operators.png') }}" class="custompopicon">
                        Update Operator Details
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Edit form -->
                    <div class="modal-content" id="modalOperatorEditContent"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- View Operator popupform -->
    <div class="modal fade upload-modal" id="viewOperatorPopUpModel" tabindex="-1" role="dialog"
        aria-labelledby="viewOperatorNewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewOperatorTitle">
                        <img src="{{ asset('assets/dashboard/img/add-member.png') }}" class="custompopicon">View Account
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-content" id="modalViewOperatorContent"></div>
                </div>

            </div>
        </div>
    </div>

    <!-- Account Suspended -->
    <div class="modal fade upload-modal" id="SuspendedOperator" tabindex="-1" role="dialog"
        aria-labelledby="viewOperatorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="viewOperatorLabel">
                        <img src="{{ asset('assets/dashboard/img/operators.png') }}" class="custompopicon"
                            alt="View Merchant">
                        Account Suspended
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <!-- Body -->
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-lg-12 text-center">

                            <p class="mt-3 mb-4 popu_heading_style">Your account has been suspended until further
                                notice.
                            </p>
                            <!-- Footer Buttons -->
                            <div class="d-flex justify-content-center my-2">
                                <button type="button" class="btn-success-modal" data-dismiss="modal"
                                    aria-label="Close">
                                    Close
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@push('script')
    </script>



    <script>
        $(document).ready(function() {
            var table = $("#operator_data_table").DataTable({
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search by Operator ID",
                },

                processing: true,
                serverSide: true,
                lengthChange: true,
                searchable: false,
                bStateSave: false,

                ajax: {
                    url: "{{ route('admin.operator_list_data_table') }}",
                    data: function(d) {
                        d.type = 'player';
                    }
                },


                columns: [{
                        data: 'member_id',
                        name: 'member_id',
                        searchable: true,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'company_name',
                        name: 'company_name',
                        searchable: true,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'territory',
                        name: 'territory',
                        searchable: true,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'point_of_contact',
                        name: 'point_of_contact',
                        searchable: true,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        searchable: true,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'totalAgents',
                        name: 'totalAgents',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },

                    {
                        data: 'status_name',
                        name: 'status_name',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'action',
                        name: 'edit',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA',
                        class: 'text-center'
                    },


                ],
                order: [
                    [1, 'desc']
                ],
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                pageLength: 10,
            });

            /*** Edit the operator */
            $(document).on('click', '.edit-operator-btn', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: "/admin-dashboard/edit-operator/" + id,
                    type: 'GET',
                    success: function(response) {
                        if ($.trim(response) === "") {
                            swal_error_popup("Operator data not found");
                        } else {
                            $('#modalOperatorEditContent').html(response);
                            $('#editOperatorModel').modal('show');
                            initJsDatePickerEdit();
                            $(document).on('change', '.js_datepicker_edit', function() {
                                this.value = $(this).val();
                                //$("#commenced_date_edit").val($(this).val());
                            });
                        }
                    },
                    error: function() {
                        alert("Error loading form");
                    }
                });
            });

            $(document).on('submit', 'form[name="add_operator"]', function(e) {
                e.preventDefault();
                let form = $(this);
                let formData = new FormData(this);
                $('span.text-danger').text('');

                swal_waiting_popup({
                    'title': 'Saving Operator Details'
                });
                //  return false

                $.ajax({
                    url: "{{ route('admin.add.operator') }}",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        table.ajax.reload(null, false);
                        Swal.close();
                        $('span.text-danger').text('');
                        $('#addOperator').modal('hide');
                        $('#editOperatorModel').modal('hide');
                        $('#add_operator')[0].reset();
                        swal_success_popup(response.message);
                    },
                    error: function(xhr) {

                        Swal.close();
                        console.log(xhr);
                        if (xhr.status === 422) {
                            $('span.text-danger').text('');
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                $('.error-' + field).text(messages[0]);
                            });
                        } else {
                            swal_error_popup(xhr.responseJSON.message ||
                                'Something went wrong');
                        }
                    }
                });
            });
            /*** View the Operator */
            $(document).on('click', '.viewOperatorBtn', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: "/admin-dashboard/view-operator/" + id,
                    type: 'GET',
                    success: function(response) {
                        if ($.trim(response) === "") {
                            swal_error_popup("Operator data not found");
                        } else {
                            $('#modalViewOperatorContent').html(response);
                            $('#viewOperatorPopUpModel').modal('show');
                        }
                    },
                    error: function() {
                        alert("Error loading form");
                    }
                });
            });

            /*** Suspend operator */
            $(document).on('click', '.account-suspend-btn', async function(e) {
                if (await isConfirm({
                        'action': 'Suspend',
                        'text': 'Are you sure you want to suspend this account?'
                    })) {
                    swal_waiting_popup({
                        'title': 'Suspending Account'
                    });
                    ajaxRequest({
                        url: "{{ route('admin.suspend-operator') }}",
                        method: 'POST',
                        data: {
                            id: $(this).data('id'),
                            request_type: 'suspend'
                        },
                        success: function(response) {
                            console.log(response)
                            if (response.status) {
                                swal_success_popup(response.message);
                                table.ajax.reload(null, false);
                            } else {
                                swal_error_popup(response.message);
                            }
                        },
                        error: function(xhr) {
                            swal_error_popup('Error occured whiile making request');
                        }
                    });
                }
            });

            /* Approve operator */
            $(document).on('click', '.approve_account', async function(e) {
                if (await isConfirm({
                        'action': 'Approve',
                        'text': 'Are you sure you want to approve this account?'
                    })) {
                    swal_waiting_popup({
                        'title': 'Approving Account'
                    });
                    $.ajax({
                        url: "{{ route('admin.approve_operator_account') }}",
                        method: 'POST',
                        data: {
                            'user_id': $(this).attr('data-id'),
                            'status': '1'
                        },
                        success: function(response) {
                            table.ajax.reload(null, false);
                            Swal.close();
                            $('#staffViewModal').modal('hide');
                            $('#staffEditModal').modal('hide');
                            swal_success_popup(response.message);
                        },
                        error: function(xhr) {

                            Swal.close();
                            $('#staffViewModal').modal('hide');
                            $('#staffEditModal').modal('hide');
                            swal_error_popup(xhr.responseJSON.message);
                        }
                    });
                }
            });

            /*** Activate operator Account */
            $(document).on('click', '.active-account-btn', async function(e) {
                if (await isConfirm({
                        'action': 'Activate',
                        'text': 'Are you sure you want to activate this account?'
                    })) {
                    swal_waiting_popup({
                        'title': 'Activating Account'
                    });
                    $.ajax({
                        url: "{{ route('admin.active-operator-account') }}",
                        method: 'POST',
                        data: {
                            'user_id': $(this).attr('data-id'),
                            'status': '1'
                        },
                        success: function(response) {
                            table.ajax.reload(null, false);
                            Swal.close();
                            swal_success_popup(response.message);
                        },
                        error: function(xhr) {
                            Swal.close();
                            swal_error_popup(xhr.responseJSON.message);
                        }
                    });
                }
            })
        });
    </script>
@endpush
