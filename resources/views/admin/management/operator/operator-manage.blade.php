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
                                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b></p>
                                <ol>
                                    <li>Manage the Operator from here.</li>
                                    <li>Update the Operator’s details and status from here.</li>
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
                                        <button type="button" class="btn-common mr-0" data-toggle="modal"
                                            data-target="#addOperator">Add Operator</button>
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
                                        <th>Last Login</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-content">

                                </tbody>
                               <tfoot class="bg-first">
    <tr>
        <th colspan="3" class="text-left">
            Server time: <span class="serverTime">{{ getServertime() }}</span>
        </th>

        <th colspan="3" class="text-center">
            Refresh time: <span class="refreshSeconds">15</span>
        </th>

        <th colspan="3" class="text-right">
            Up time: <span class="uptimeClass">{{ getAppUptime() }}</span>
        </th>
    </tr>
</tfoot>
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
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="addOperatorTitle"> <img src="{{ asset('assets/dashboard/img/operators.png') }}"
                            class="custompopicon"> Add New Operator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="add_operator" id="add_operator" method="POST" action="{{ route('admin.add.operator') }}">
                        <div class="row">
                            <!-- Section: Personal Details -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
                            </div>

                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Operator ID" readonly>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Date Appointed" readonly>
                            </div>

                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Company Name"
                                    name="company_name" id="company_name">
                                <span class="text-danger error-company_name"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Business Name"
                                    name="business_name" id="business_name">
                                <span class="text-danger error-business_name"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="ABN" name="abn"
                                    id="abn" maxlength="11">
                                <span class="text-danger error-abn"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Business Address"
                                    name="business_address" id="business_address">
                                <span class="text-danger error-business_address"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Business Number"
                                    name="business_number" id="business_number"
                                    oninput="this.value = this.value.replace(/\D/g,'');" maxlength="14">
                                <span class="text-danger error-business_number"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Point of Contact"
                                    name="point_of_contact" id="point_of_contact">
                                <span class="text-danger error-point_of_contact"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Mobile" name="phone"
                                    id="phone" oninput="this.value = this.value.replace(/\D/g,'');" maxlength="14">
                                <span class="text-danger error-phone"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="email" class="form-control rounded-0" placeholder="Email" name="email"
                                    id="email">
                                <span class="text-danger error-email"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <select class="form-control rounded-0" name="state_id" id="state_id">
                                    <option>Select Territory</option>
                                    @foreach (config('escorts.profile.states') as $skey => $state)
                                        <option value="{{ $skey }}">{{ $state['stateName'] }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-state_id"></span>
                            </div>
                            <div class="col-12 mb-3 d-flex align-items-center justify-content-start gap-10 flex-wrap">
                                <h6 class="mb-0 text-blue-primary">Method of Contact:</h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_1"
                                        name="contact_type[]" value="1">
                                    <label class="form-check-label" for="contactText">Messaging</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_2"
                                        name="contact_type[]" value="2">
                                    <label class="form-check-label" for="contactText">Text</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_3"
                                        name="contact_type[]" value="3">
                                    <label class="form-check-label" for="contactEmail">Email</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_5"
                                        name="contact_type[]" value="4">
                                    <label class="form-check-label" for="contactCall">Call Us</label>
                                </div>
                                <span class="text-danger error-contact_type"></span>
                            </div>
                            <!-- Section: Agreement Details -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Agreement Details</h6>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0"
                                    placeholder="Agreement Date (DD/MM/YYYY)" onfocus="(this.type='date')"
                                    onblur="if(this.value==''){this.type='text'}" name="agreement_date"
                                    id="agreement_date">
                                <span class="text-danger error-agreement_date"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Term" name="term"
                                    id="term">
                                <span class="text-danger error-term"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="fee" name="fee"
                                    id="fee" maxlength="10">
                                <span class="text-danger error-fee"></span>
                            </div>
                        </div>
                        <div class="row">

                            <!-- Commission -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Commission</h6>
                            </div>
                            <div class="col-6 mb-3">
                                <input class="form-control rounded-0" placeholder="Advertising %"
                                    name="commission_advertising_percent" id="commission_advertising_percent"
                                    maxlength="3">
                                <span class="text-danger error-commission_advertising_percent"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input class="form-control rounded-0" placeholder="Massage Centre (Registrations) %"
                                    name="commission_massage_centre_percent" id="commission_massage_centre_percent"
                                    maxlength="3">
                                <span class="text-danger error-commission_massage_centre_percent"></span>
                            </div>

                        </div>
                        <div class="modal-footer p-0 pl-2 pb-4">
                            <button type="submit" class="btn-success-modal mr-2">Save</button>
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
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
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

    <!-- View Operator popupform -->
    <div class="modal fade upload-modal" id="viewOperator" tabindex="-1" role="dialog"
        aria-labelledby="viewOperatorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="viewOperatorLabel">
                        <img src="{{ asset('assets/dashboard/img/operators.png') }}" class="custompopicon"
                            alt="View Merchant">
                        View Account
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
                        <div class="col-12 custom-merchant-modal">

                            <div class="card mb-3 p-3">
                                <!-- Avatar + Name -->
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ asset('assets/img/default_user.png') }}" alt="Avatar"
                                        class="rounded-circle mr-3" width="50" height="50">
                                    <h6 class="mb-0">Agency Management (Australia) Pty Ltd</h6>
                                </div>

                                <!-- Merchant Details -->
                                <h6 class=" text-blue-primary">Merchant Details</h6>
                                <table class="table table-bordered mb-3">
                                    <tr>
                                        <th>Operator ID</th>
                                        <td>O60458</td>
                                    </tr>
                                    <tr>
                                        <th>Date Appointed</th>
                                        <td>2024-03-01</td>
                                    </tr>
                                    <tr>
                                        <th>Company Name</th>
                                        <td>Agency Management (Australia) Pty Ltd
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Business Name</th>staffEditModal
                                        <td>Agency Management (Australia) Pty Ltd
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>ABN</th>
                                        <td>12345678901</td>
                                    </tr>
                                    <tr>
                                        <th>Business Address</th>
                                        <td>123 King St, Melbourne</td>
                                    </tr>
                                    <tr>
                                        <th>Business Number</th>
                                        <td>028888999</td>
                                    </tr>
                                    <tr>
                                        <th>Point of Contact</th>
                                        <td>Wayne Primrose</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile</th>
                                        <td>0438 028 728</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>wayne.personal@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <th>Territory</th>
                                        <td>North</td>
                                    </tr>
                                    <tr>
                                        <th>Method of Contact</th>
                                        <td>Email</td>
                                    </tr>
                                </table>

                                <!-- Agreement Details -->
                                <h6 class=" text-blue-primary">Agreement Details</h6>
                                <table class="table table-bordered mb-3">
                                    <tr>
                                        <th>Agreement Date</th>
                                        <td>2023-12-01</td>
                                    </tr>
                                    <tr>
                                        <th>Term</th>
                                        <td>12 Months</td>
                                    </tr>
                                    <tr>
                                        <th>Fees</th>
                                        <td>$ 100</td>
                                    </tr>
                                </table>

                                <!-- Commission -->
                                <h6 class=" text-blue-primary">Commission</h6>
                                <table class="table table-bordered mb-3">
                                    <tr>
                                        <th>Advertising</th>
                                        <td>5%</td>
                                    </tr>
                                    <tr>
                                        <th>Massage Centre (Registrations)</th>
                                        <td>10%</td>
                                    </tr>
                                </table>


                            </div>


                        </div>
                        <div class="col-lg-12">
                            <!-- Footer Buttons -->
                            <div class="d-flex justify-content-end my-2">
                                <button class="btn-success-modal d-block mr-2" onclick="window.print();">
                                    <i class="fa fa-print text-white"></i> Print
                                </button>
                                <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">
                                    Close
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Account Suspended -->
    <div class="modal fade upload-modal" id="SuspendedOperator" tabindex="-1" role="dialog"
        aria-labelledby="viewOperatorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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

                            <p class="mt-3 mb-4 popu_heading_style">Your account has been suspended until further notice.
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
                        searchable: true,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'last_login',
                        name: 'last_login',
                        searchable: true,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'status',
                        name: 'status',
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
                    $('#add_staff')[0].reset();
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
         });
    </script>
@endpush
