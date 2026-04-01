@extends('layouts.admin')
@section('style')
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
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                <!--middle content-->
                <div class="row">
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">Manage Suppliers</h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                            style="font-size:16px"><b>Help?</b> </span>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="card collapse" id="notes">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <ol>
                                    <li>Create and manage Suppliers here.</li>
                                    <li>Manage status of Suppliers.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel with-nav-tabs panel-warning">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="tab3warning">
                                        <div class="row pb-3">
                                            @if ($addAccessEnabled)
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="bothsearch-form" style="gap: 10px;">
                                                        <button type="button" class="create-tour-sec dctour"
                                                            data-toggle="modal" data-target="#addNewSupplier">Add New
                                                            Merchant</button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table mb-3 w-100" id="ManageSupplierTable">
                                                <thead class="table-bg">
                                                    <tr>
                                                        <th scope="col">Merchant ID</th>
                                                        <th scope="col">Merchant</th>
                                                        <th scope="col">Location</th>
                                                        <th scope="col">Mobile</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-content">
                                                    <tr>
                                                        <td>M60458</td>
                                                        <td>Condom Man</td>
                                                        <td>Western Australia</td>
                                                        <td>0438 028 728</td>
                                                        <td>info@condomma.com.au</td>
                                                        <td><span class="custom_badge badge_pending">Pending</span></td>
                                                        <td>
                                                            <div class="dropdown no-arrow">
                                                                <a class="dropdown-toggle" href="#" role="button"
                                                                    id="dropdownMenuLink" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="true">
                                                                    <i
                                                                        class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                </a>
                                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                                    aria-labelledby="dropdownMenuLink"
                                                                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-144px, 20px, 0px);"
                                                                    x-placement="bottom-end">
                                                                    @if ($editAccessEnabled)
                                                                        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                                            href="#" data-target="#editSupplierModel"
                                                                            data-toggle="modal"> <i class="fa fa-pen"></i>
                                                                            Edit </a>
                                                                        <div class="dropdown-divider"></div>

                                                                        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                                                            href="#"> <i class="fa fa-ban"></i>
                                                                            Suspend</a>
                                                                        <div class="dropdown-divider"></div>
                                                                    @endif

                                                                    <a class="dropdown-item view-account-btn d-flex justify-content-start gap-10 align-items-center"
                                                                        href="#" data-toggle="modal"
                                                                        data-target="#viewSupplierdata"> <i
                                                                            class="fa fa-eye "></i> View Account</a>
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
                        </div>
                    </div>
                    <!-- <div class="col-sm-12 col-md-12 col-lg-12">
                                           <div class="timer_section">
                                              <p>Server time: <span class="serverTime">{{ getServertime() }}</span></p>
                                              <p>Refresh time:<span class="refreshSeconds"> 15</span></p>
                                              <p>Up time: <span class="uptimeClass">{{ getAppUptime() }}</span></p>
                                           </div>
                                        </div> -->
                </div>
            </div>
            <!--middle content end here-->
        </div>
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span> </span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Add Supplier From -->
    <div class="modal fade upload-modal" id="addNewSupplier" tabindex="-1" role="dialog"
        aria-labelledby="addNewMerchantLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewMerchant"> <img
                            src="{{ asset('assets/dashboard/img/add-agent.png') }}" class="custompopicon"> Add New
                        Merchant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('admin.management.supplier.add_supplier', ['supplier' => []])
                </div>
            </div>
        </div>
    </div>
    <!-- End of add supplier form -->


    <!-- Edit Merchant popup form -->
    <div class="modal fade upload-modal" id="editSupplierModel" tabindex="-1" role="dialog"
        aria-labelledby="edit_merchant_dataLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_merchant_data">
                        <img src="{{ asset('assets/dashboard/img/update-agent.png') }}" class="custompopicon">
                        Update Merchant Details
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('admin.management.supplier.edit_supplier', ['supplier' => []])
                </div>
            </div>
        </div>
    </div>

    {{-- view merchant modal popup --}}

    <!-- View Merchant popupform -->
    <div class="modal fade upload-modal" id="viewSupplierPopUpModel" tabindex="-1" role="dialog"
        aria-labelledby="view_merchant_dataLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="view_merchant_dataLabel">
                        <img src="{{ asset('assets/dashboard/img/view-merchant.png') }}" class="custompopicon"
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
                     <div class="modal-content" id="modalViewSupplierContent"></div>
                    {{-- @include('admin.management.supplier.view_supplier', ['supplier' => []]) --}}
                </div>

            </div>
        </div>
    </div>
    {{-- end --}}
    <div class="modal fade upload-modal" id="viewAgentdetails" tabindex="-1" role="dialog"
        aria-labelledby="Edit_CompetitorLabel" aria-hidden="true"></div>
    <div class="modal fade upload-modal" id="printAgentdetails" tabindex="-1" role="dialog"
        aria-labelledby="Edit_CompetitorLabel" aria-hidden="true"></div>
@endsection
@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>

    <script>
        var table = $("#ManageSupplierTable").DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Merchant ID",
            },

            processing: true,
            serverSide: true,
            lengthChange: true,
            searchable: false,
            bStateSave: false,

            ajax: {
                url: "{{ route('admin.supplier_list_data_table') }}",
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
                    data: 'business_name',
                    name: 'business_name',
                    searchable: true,
                    orderable: false,
                    defaultContent: 'NA'
                },
                {
                    data: 'location',
                    name: 'location',
                    searchable: true,
                    orderable: false,
                    defaultContent: 'NA'
                },
                {
                    data: 'phone',
                    name: 'phone',
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

        /*** Edit the supplier */
        $(document).on('click', '#getSupplier', function() {
            let id = $(this).data('id');
            $.ajax({
                url: BASE_URL + "/admin-dashboard/get_supplier/" + id,
                type: 'GET',
                success: function(response) {
                    if ($.trim(response) === "") {
                        swal_error_popup("Supplier data not found.");
                    } else {
                        let supplier = response.data; // assuming {data: {...}}

                        // ===== MAIN USER DATA =====
                        $('#user_id_edit').val(supplier.id);
                        $('#merchant_id_edit').val(supplier.member_id);
                        $('#business_name_edit').val(supplier.business_name);
                        $('#abn_edit').val(supplier.abn);
                        $('#business_address_edit').val(supplier.business_address);
                        $('#business_number_edit').val(supplier.business_number);
                        $('#phone_edit').val(supplier.phone);
                        $('#email_edit').val(supplier.email);

                        // ===== LOCATION (state_id) =====
                        $('#location_edit').val(supplier.state_id).trigger('change');

                        // ===== SUPPLIER DETAIL =====
                        let detail = supplier.supplier_detail || {};

                        $('#date_appointed_edit').val(detail.date_appointed);
                        $('#point_of_contact_edit').val(detail.point_of_contact);
                        $('#concierge_service_edit').val(detail.concierge_service).trigger('change');
                        $('#agreement_date_edit').val(detail.agreement_date);
                        $('#term_edit').val(detail.term);

                        // ===== BANK DETAIL =====
                        let bank = supplier.supplier_bank_detail || {};

                        $('#bank_name_edit').val(bank.bank_name);
                        $('#account_name_edit').val(bank.account_name);
                        $('#bsb_edit').val(bank.bsb);
                        $('#account_number_edit').val(bank.account_number);

                        $('#editSupplierModel').modal('show');
                    }
                },
                error: function() {
                    alert("Error loading form");
                }
            });
        });
        $(document).on('submit', 'form[name="add_supplier"]', function(e) {
            e.preventDefault();
            let form = $(this);
            let formData = new FormData(this);
            $('span.text-danger').text('');

            swal_waiting_popup({
                'title': 'Saving Supplier Details'
            });
            //  return false

            $.ajax({
                url: "{{ route('admin.add.supplier') }}",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    table.ajax.reload(null, false);
                    Swal.close();
                    $('span.text-danger').text('');
                    $('#addNewSupplier').modal('hide');
                    $('#editSupplierModel').modal('hide');
                    $('#add_supplier')[0].reset();
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

        /*** View the Supplier */
            $(document).on('click', '#viewSupplierBtn', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: BASE_URL + "/admin-dashboard/view-supplier/" + id,
                    type: 'GET',
                    success: function(response) {
                        if ($.trim(response) === "") {
                            swal_error_popup("Supplier data not found");
                        } else {
                            $('#modalViewSupplierContent').html(response);
                            $('#viewSupplierPopUpModel').modal('show');
                        }
                    },
                    error: function() {
                        alert("Error loading form");
                    }
                });
            });
    </script>
@endpush
