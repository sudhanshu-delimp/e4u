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
                            <table class="table mb-3" id="OperatorTable">
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
                                <tbody>
                                    <tr>
                                        <td>O60458</td>
                                        <td>Agency Management (Australia) Pty Ltd</td>
                                        <td>Aus</td>
                                        <td>Wayne Primrose</td>
                                        <td>admin@agencymanagement.com.au</td>
                                        <td>13</td>
                                        <td>20-05-2025 09:12 am</td>
                                        <td>Active</td>
                                        <td>
                                            <div class="dropdown no-arrow">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="true">
                                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                    aria-labelledby="dropdownMenuLink"
                                                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-144px, 20px, 0px);"
                                                    x-placement="bottom-end">
                                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                        href="#" data-target="#editOperator" data-toggle="modal">
                                                        <i class="fa fa-pen"></i> Edit </a>
                                                    <div class="dropdown-divider"></div>

                                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                        href="#" data-target="#SuspendedOperator" data-toggle="modal"> <i class="fa fa-ban"></i> Suspend</a>
                                                    <div class="dropdown-divider"></div>


                                                    <a class="dropdown-item view-account-btn d-flex justify-content-start gap-10 align-items-center"
                                                        href="#" data-toggle="modal" data-target="#viewOperator"> <i
                                                            class="fa fa-eye "></i> View Account</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot class="bg-first">
                                    <tr>
                                        <th colspan="3" class="text-left">Server time: <span>10:23:51 am</span></th>
                                        <th colspan="3" class="text-center">Refresh time:<span>seconds</span></th>
                                        <th colspan="3" class="text-right">Up time: <span>214 days & 09 hours 12
                                                minutes</span></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <!-- Add New Operator popupform -->
    <div class="modal fade upload-modal" id="addOperator" tabindex="-1" role="dialog" aria-labelledby="addOperatorLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="addOperator"> <img src="{{ asset('assets/dashboard/img/operators.png') }}"
                            class="custompopicon"> Add New Operator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
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
                                    id="abn">
                                <span class="text-danger error-abn"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Business Address"
                                    name="business_address" id="business_address">
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Business Number"
                                    name="business_number" id="business_number">
                                <span class="text-danger error-business_number"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Point of Contact"
                                    name="point_of_contact" id="point_of_contact">
                                <span class="text-danger error-point_of_contact"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Mobile" name="phone"
                                    id="phone">
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
                                    <option value="3903">Victoria</option>
                                    <option value="3904">South Australia</option>
                                    <option value="3905">Queensland</option>
                                    <option value="3906">Western Australia</option>
                                    <option value="3907">Australian Capital Territory</option>
                                    <option value="3908">Tasmania</option>
                                    <option value="3909">New South Wales</option>
                                    <option value="3910">Northern Territory</option>
                                    <option value="4021">Delhi</option>
                                    <option value="4022">Uttar Pradesh</option>
                                </select>
                                <span class="text-danger error-state_id"></span>
                            </div>
                            <div class="col-12 mb-3 d-flex align-items-center justify-content-start gap-10 flex-wrap">
                                <h6 class="mb-0 text-blue-primary">Method of Contact:</h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_1"
                                        name="Messaging" value="1">
                                    <label class="form-check-label" for="contactText">Messaging</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_1"
                                        name="viewer_contact_type" value="1">
                                    <label class="form-check-label" for="contactText">Text</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_2"
                                        name="viewer_contact_type" value="2">
                                    <label class="form-check-label" for="contactEmail">Email</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_3"
                                        name="viewer_contact_type" value="3">
                                    <label class="form-check-label" for="contactCall">Call Us</label>
                                </div>
                            </div>
                            <!-- Section: Agreement Details -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Agreement Details</h6>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" required
                                    placeholder="Agreement Date (DD/MM/YYYY)" onfocus="(this.type='date')"
                                    onblur="if(this.value==''){this.type='text'}">
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Term" required
                                    name="term">
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Fees" required
                                    name="fees">
                            </div>



                        </div>
                        <div class="row">






                            <!-- Commission -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Commission</h6>
                            </div>
                            <div class="col-6 mb-3">
                                <input class="form-control rounded-0" placeholder="Advertising"
                                    name="commission_advertising_percent" id="commission_advertising_percent">
                            </div>
                            <div class="col-6 mb-3">
                                <input class="form-control rounded-0" placeholder="Massage Centre (Registrations)"
                                    name="commission_registration_amount" id="commission_registration_amount">
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
    <div class="modal fade upload-modal" id="editOperator" tabindex="-1" role="dialog"
        aria-labelledby="editOperatorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOperator">
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
                    <form>
                        <div class="row">
                            <!-- Section: Personal Details -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
                            </div>

                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Operator ID" readonly>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Date Appointed">
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
                                    id="abn">
                                <span class="text-danger error-abn"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Business Address"
                                    name="business_address" id="business_address">
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Business Number"
                                    name="business_number" id="business_number">
                                <span class="text-danger error-business_number"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Point of Contact"
                                    name="point_of_contact" id="point_of_contact">
                                <span class="text-danger error-point_of_contact"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Mobile" name="phone"
                                    id="phone">
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
                                    <option value="3903">Victoria</option>
                                    <option value="3904">South Australia</option>
                                    <option value="3905">Queensland</option>
                                    <option value="3906">Western Australia</option>
                                    <option value="3907">Australian Capital Territory</option>
                                    <option value="3908">Tasmania</option>
                                    <option value="3909">New South Wales</option>
                                    <option value="3910">Northern Territory</option>
                                    <option value="4021">Delhi</option>
                                    <option value="4022">Uttar Pradesh</option>
                                </select>
                                <span class="text-danger error-state_id"></span>
                            </div>
                            <div class="col-12 mb-3 d-flex align-items-center justify-content-start gap-10 flex-wrap">
                                <h6 class="mb-0 text-blue-primary">Method of Contact:</h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_1"
                                        name="Messaging" value="1">
                                    <label class="form-check-label" for="contactText">Messaging</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_1"
                                        name="viewer_contact_type" value="1">
                                    <label class="form-check-label" for="contactText">Text</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_2"
                                        name="viewer_contact_type" value="2">
                                    <label class="form-check-label" for="contactEmail">Email</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_3"
                                        name="viewer_contact_type" value="3">
                                    <label class="form-check-label" for="contactCall">Call Us</label>
                                </div>
                            </div>
                            <!-- Section: Agreement Details -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Agreement Details</h6>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" required
                                    placeholder="Agreement Date (DD/MM/YYYY)" onfocus="(this.type='date')"
                                    onblur="if(this.value==''){this.type='text'}">
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Term" required
                                    name="term">
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Fees" required
                                    name="fees">
                            </div>



                        </div>
                        <div class="row">
                            <!-- Commission -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Commission</h6>
                            </div>
                            <div class="col-6 mb-3">
                                <input class="form-control rounded-0" placeholder="Advertising"
                                    name="commission_advertising_percent" id="commission_advertising_percent">
                            </div>
                            <div class="col-6 mb-3">
                                <input class="form-control rounded-0" placeholder="Massage Centre (Registrations)"
                                    name="commission_registration_amount" id="commission_registration_amount">
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
                                        <th>Business Name</th>
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

                           <p class="mt-3 mb-4 popu_heading_style">Your account has been suspended until further notice.</p>
                            <!-- Footer Buttons -->
                            <div class="d-flex justify-content-center my-2">
                                <button type="button" class="btn-success-modal" data-dismiss="modal" aria-label="Close">
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
    <script src="{{ asset('assets/dashboard/vendor/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>

    <script>
        var table = $("#OperatorTable").DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Operator ID"
            },
            info: true,
            paging: true,
            lengthChange: true,
            searching: true,
            bStateSave: true,
            order: [
                [1, 'desc']
            ],
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            pageLength: 10,

            columns: [{
                    data: 'id',
                    name: 'id',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'operator',
                    name: 'operator',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'territory',
                    name: 'territory',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'contact',
                    name: 'contact',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'email',
                    name: 'email',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'agent',
                    name: 'agent',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'last_login',
                    name: 'last_login',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'status',
                    name: 'status',
                    searchable: false,
                    orderable: true,
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
        });
    </script>
@endpush
