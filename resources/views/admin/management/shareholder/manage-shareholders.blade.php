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
    @endphp
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                    <div class="row">
                        <div class="custom-heading-wrapper col-md-12">
                            <h1 class="h1">Manage Shareholders</h1>
                            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
                        </div>
                        <div class="col-md-12 mb-5 collapse" id="notes">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                    <ol class="level-1">
                                        <li>Create and manage Shareholders here.</li>
                                        <li>Shareholdings are managed from <a href="{{ route('admin.shareholder') }}"
                                                class="custom_links_design">Share Register</a>. </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row pb-3">

                        <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                            @if ($addAccessEnabled)
                                <div class="bothsearch-form" style="gap: 10px;">
                                    <button type="button" class="btn-common" data-toggle="modal"
                                        data-target="#addShareholder">Add New Shareholder</button>
                                </div>
                            @endif
                        </div>

                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table mb-3 w-100" id="manage_shareholder_table">
                                    <thead class="table-bg">
                                        <tr>
                                            <th>ID</th>
                                            <th>Shareholder</th>
                                            <th>Contact</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Logins</th>
                                            <th>Last Login</th>
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
    </div>
    @include('admin.management.shareholder.add_shareholder')
    @include('admin.management.shareholder.edit_shareholder')

    <!--View Account shareholder popupform -->
    <div class="modal fade upload-modal" id="viewShareholderPopUpModel" tabindex="-1" role="dialog"
        aria-labelledby="viewShareholderLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewShareholderTitle"><img
                            src="{{ asset('assets/dashboard/img/add-member.png') }}" class="custompopicon">View Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-content" id="modalViewSShareholderContent"></div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>

    <script>
        $(document).ready(function() {
            var table = $("#manage_shareholder_table").DataTable({
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search by ID",
                },
                processing: true,
                serverSide: true,
                lengthChange: true,
                searchable: false,
                bStateSave: false,

                ajax: {
                    url: "{{ route('admin.shareholder_list_data_table') }}",
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
                        data: 'contact_person',
                        name: 'contact_person',
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
                        data: 'login_count',
                        name: 'login_count',
                        searchable: false,
                        orderable: false,
                        defaultContent: 0
                    },
                    {
                        data: 'last_login',
                        name: 'last_login',
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

            /*** Edit the shareholder */
            $(document).on('click', '#getShareholder', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: BASE_URL + "/admin-dashboard/get_shareholder/" + id,
                    type: 'GET',
                    success: function(response) {
                        if ($.trim(response) === "") {
                            swal_error_popup("Shareholder data not found.");
                        } else {
                            let shareholder = response.data; // assuming {data: {...}}

                            // ===== MAIN USER DATA =====
                            $('#user_id_edit').val(shareholder.id);
                            $('#contact_person_edit').val(shareholder.contact_person);
                            $('#business_name_edit').val(shareholder.business_name);
                            $('#business_address_edit').val(shareholder.business_address);
                            $('#phone_edit').val(shareholder.phone);
                            $('#email_edit').val(shareholder.email);
                            $('#editShareholder').modal('show');
                            $('#editShareholder input[name="idle_preference_time"][value="' +
                                    shareholder.shareholder_setting.idle_preference_time + '"]')
                                .prop('checked', true);
                            $('#editShareholder input[name="twofa"][value="' + shareholder
                                .shareholder_setting.twofa + '"]').prop('checked', true);
                            var contactTypes = shareholder.contact_type;
                            //console.log('selectedValues', selectedValues);

                            // First uncheck all (important when editing multiple times)
                            $('#editShareholder input[name="contact_type[]"]').prop('checked',
                                false);

                            // Loop and check matching values
                            contactTypes.forEach(function(value) {
                                $('input[name="contact_type[]"][value="' + value + '"]')
                                    .prop('checked', true);
                            });
                        }
                    },
                    error: function() {
                        alert("Error loading form");
                    }
                });
            });
            $(document).on('submit', 'form[name="add_shareholder"]', function(e) {
                e.preventDefault();
                let form = $(this);
                let formData = new FormData(this);
                $('span.text-danger').text('');

                swal_waiting_popup({
                    'title': 'Saving Shareholder Details'
                });
                //  return false

                $.ajax({
                    url: "{{ route('admin.add.shareholder') }}",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        table.ajax.reload(null, false);
                        Swal.close();
                        $('span.text-danger').text('');
                        $('#addShareholder').modal('hide');
                        $('#editShareholder').modal('hide');
                        $('#add_shareholder')[0].reset();
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

            /*** View the shareholder */
            $(document).on('click', '#viewShareholderBtn', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: BASE_URL + "/admin-dashboard/view-shareholder/" + id,
                    type: 'GET',
                    success: function(response) {
                        if ($.trim(response) === "") {
                            swal_error_popup("Shareholder data not found");
                        } else {
                            $('#modalViewSShareholderContent').html(response);
                            $('#viewShareholderPopUpModel').modal('show');
                        }
                    },
                    error: function() {
                        alert("Error loading form");
                    }
                });
            });

            /*** Suspend shareholder */
            $(document).on('click', '.account-suspend-btn', async function(e) {
                if (await isConfirm({
                        'action': 'Suspend',
                        'text': 'Are you sure you want to suspend this account?'
                    })) {
                    swal_waiting_popup({
                        'title': 'Suspending Account'
                    });
                    ajaxRequest({
                        url: "{{ route('admin.suspend-shareholder') }}",
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

            /* Approve shareholder */
            $(document).on('click', '.approve_account', async function(e) {
                if (await isConfirm({
                        'action': 'Approve',
                        'text': 'Are you sure you want to approve this account?'
                    })) {
                    swal_waiting_popup({
                        'title': 'Approving Account'
                    });
                    $.ajax({
                        url: "{{ route('admin.approve_shareholder_account') }}",
                        method: 'POST',
                        data: {
                            'user_id': $(this).attr('data-id'),
                            'status': '1'
                        },
                        success: function(response) {
                            table.ajax.reload(null, false);
                            Swal.close();
                            $('#addShareholder').modal('hide');
                            $('#editShareholder').modal('hide');
                            $('#viewShareholderPopUpModel').modal('hide');
                            swal_success_popup(response.message);
                        },
                        error: function(xhr) {

                            Swal.close();
                            $('#addShareholder').modal('hide');
                            $('#editShareholder').modal('hide');
                            $('#viewShareholderPopUpModel').modal('hide');
                            swal_error_popup(xhr.responseJSON.message);
                        }
                    });
                }
            });

            /*** Activate shareholder Account */
            $(document).on('click', '.active-account-btn', async function(e) {
                if (await isConfirm({
                        'action': 'Activate',
                        'text': 'Are you sure you want to activate this account?'
                    })) {
                    swal_waiting_popup({
                        'title': 'Activating Account'
                    });
                    $.ajax({
                        url: "{{ route('admin.active-shareholder-account') }}",
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
            });

            /*** Activate shareholder Account */
            $(document).on('click', '.delete_account', async function(e) {
                if (await isConfirm({
                        'action': 'Delete',
                        'text': 'Are you sure you want to delete this account?'
                    })) {
                    swal_waiting_popup({
                        'title': 'Deleting Account'
                    });
                    $.ajax({
                        url: "{{ route('admin.delete.shareholder.account') }}",
                        method: 'POST',
                        data: {
                            'id': $(this).attr('data-id'),
                            request_type: 'delete'
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
