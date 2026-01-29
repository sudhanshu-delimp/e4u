@extends('layouts.admin')
@section('style')
    <style>
    </style>
@stop
@section('content')
@php
   $securityLevel = isset(auth()->user()->staff_detail->security_level) ? auth()->user()->staff_detail->security_level: 0;
   $addAccess = staffPageAccessPermission($securityLevel, 'add');
   $addAccessEnabled  = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';
@endphp

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                <!--middle content-->
                <div class="row">
                    <!-- Page Heading -->
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">Manage Staff </h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                            style="font-size:16px"><b>Help?</b> </span>
                    </div>
                    <div class=" col-md-12 mb-4">
                        <div class="card collapse" id="notes">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <ol>
                                    <li>Create and manage Staff here.</li>
                                    <li>Set the security level for Staff as well as granting access.</li>
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
                                             @if($addAccessEnabled)
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="bothsearch-form" style="gap: 10px;">
                                                    <button type="button" class="btn-common" data-toggle="modal"
                                                        data-target="#addStaffnew">Add New Staff Member</button>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table mb-3 w-100" id="staff_data_table">
                                                <thead class="table-bg">
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Staff Member</th>
                                                        <th scope="col">Security</th>
                                                        <th scope="col">Position</th>
                                                        <th scope="col" style="width: 86px;">Mobile</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Logins</th>
                                                        <th scope="col" style="width: 180px;">Last Login</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-content">

                                                </tbody>
                                                <tfoot class="bg-first">
                                                    <tr>
                                                        <th colspan="3" class="text-left">Server time:
                                                            <span class="serverTime">{{ getServertime() }}</span>
                                                        </th>
                                                        <th colspan="3" class="text-center">Refresh time:
                                                            <span class="refreshSeconds"> 15</span>
                                                        </th>
                                                        <th colspan="4" class="text-right">Up time:
                                                            <span class="uptimeClass">{{ getAppUptime() }}</span>
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
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- add new staff member popupform -->
    <div class="modal fade upload-modal" id="addStaffnew" tabindex="-1" role="dialog" aria-labelledby="addStaffnewLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStaffnewTitle"><img
                            src="{{ asset('assets/dashboard/img/add-member.png') }}" class="custompopicon"> Add New Staff
                        Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="add_staff" id="add_staff" method="POST" action="{{ route('admin.add-staff') }}"
                        enctype="multipart/form-data">
                        <div class="row" style="max-height: 500px; overflow:auto;">
                            <!-- Section: Personal Details -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
                            </div>

                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Full Name" name="name"
                                    id="name">
                                <span class="text-danger error-name"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Address"
                                    name="address" id="address">
                                <span class="text-danger error-address"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="tel" maxlength="10" autocomplete="off" class="form-control rounded-0"
                                    placeholder="Phone" name="phone" id="phone"
                                    oninput="this.value = this.value.replace(/\D/g,'');">
                                <span class="text-danger error-phone"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="email" class="form-control rounded-0" placeholder="Private Email"
                                    name="email" id="email">
                                <span class="text-danger error-email"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <select class="form-control" name="gender" id="gender">
                                    <option value="">Select Gender</option>
                                    @foreach (config('staff.genders') as $key => $gender)
                                        <option value="{{ $key }}">{{ $gender }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-gender"></span>
                            </div>

                            <!-- Next of Kin Section -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Next of Kin (Emergency Contact)</h6>
                            </div>

                            <div class="col-6 mb-3">
                                <input type="text" name="kin_name" id="kin_name" class="form-control rounded-0"
                                    placeholder="Name of Kin (optional)">
                                <span class="text-danger error-kin_name"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" name="kin_relationship" id="kin_relationship"
                                    class="form-control rounded-0" placeholder="Relationship (optional)">
                                <span class="text-danger error-kin_relationship"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="tel" maxlength="10" name="kin_mobile" id="kin_mobile"
                                    class="form-control rounded-0 no-arrow" placeholder="Mobile (optional)" autocomplete="off"
                                    oninput="this.value = this.value.replace(/\D/g,'');">
                                <span class="text-danger error-kin_mobile"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="email" name="kin_email" class="form-control rounded-0"
                                    placeholder="Email (optional)">
                                <span class="text-danger error-kin_email"></span>
                            </div>

                            <!-- Section: Other Details -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Other Details</h6>
                            </div>

                            {{-- <div class="col-6 mb-3">
                                <input type="text" name="position" id="position" class="form-control rounded-0"
                                    placeholder="Position">
                                <span class="text-danger error-position"></span>
                            </div> --}}
                            <div class="col-6 mb-3">
                                <select class="form-control rounded-0" name="security_level" id="security_level">
                                    <option value="">Security Level</option>
                                    @foreach (config('staff.security_level') as $seckey => $secLevel)
                                        <option value="{{ $seckey }}" {{ $seckey == 3 ? 'selected' : '' }}>
                                            {{ $secLevel }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-security_level"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <select class="form-control rounded-0" name="position" id="position" disabled>
                                    <option value="">Position</option>
                                    @foreach (config('staff.position') as $pkey => $position)
                                        <option value="{{ $pkey }}" {{ $pkey == 3 ? 'selected' : '' }}>
                                            {{ $position }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-position"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <select class="form-control rounded-0" name="location" id="location">
                                    <option value="">Select Location</option>
                                    @foreach (config('escorts.profile.cities') as $skey => $city)
                                        <option value="{{ $skey }}">{{ $city }}</option>
                                    @endforeach

                                </select>
                                <span class="text-danger error-location"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" name="commenced_date" id="commenced_date"
                                    class="form-control rounded-0" placeholder="Commenced Date"
                                    onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}">
                                <span class="text-danger error-commenced_date"></span>

                            </div>

                            <div class="col-6 mb-3">
                                <select class="form-control rounded-0" name="employment_status" id="employment_status">
                                    <option value="">Select Employment Status</option>
                                    @foreach (config('staff.employment_status') as $key => $empStatus)
                                        <option value="{{ $key }}">{{ $empStatus }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-employment_status"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <select class="form-control rounded-0" name="employment_agreement"
                                    id="employment_agreement">
                                    <option value="">Employment Agreement?</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <span class="text-danger error-employment_agreement"></span>
                            </div>

                            <!-- Section: Building Security -->
                            <div class="col-12 my-2">
                                <h6 class="border-bottom pb-1 text-blue-primary">Building Security</h6>
                            </div>

                            <div class="col-4 mb-3">
                                <select class="form-control rounded-0" name="building_access_code"
                                    id="building_access_code">
                                    <option value="">Access Code Provided?</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <span class="text-danger error-building_access_code"></span>
                            </div>
                            <div class="col-4 mb-3">
                                <select class="form-control rounded-0" name="keys_issued" id="keys_issued">
                                    <option value="">Key Provided?</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <span class="text-danger error-keys_issued"></span>
                            </div>
                            <div class="col-4 mb-3">
                                <select class="form-control rounded-0" name="car_parking" id="car_parking">
                                    <option value="">Car Park?</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <span class="text-danger error-car_parking"></span>
                            </div>
                            <div class="col-12">

                                <div class="form-group">
                                    <h6 class="border-bottom pb-1 text-blue-primary">Idle Time Preference</h6>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="idle_preference_time"
                                            id="idle_preference_time_15" value="15">
                                        <label class="form-check-label" for="idle_preference_time_15">15 minutes</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="idle_preference_time"
                                            id="idle_preference_time_30" value="30">

                                        <label class="form-check-label" for="idle_preference_time_30">30 minutes</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="idle_preference_time"
                                            id="idle_preference_time_60" value="60" checked>
                                        <label class="form-check-label" for="idle_preference_time_60">60 minutes</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="idle_preference_time"
                                            id="idle_preference_time_never"
                                            value="{{ config('staff.idle_vever_minute') }}">
                                        <label class="form-check-label" for="idle_preference_time_never">Never</label>
                                    </div>

                                    {{--  <div class="pt-1" >
                            <i style="color: #6e707e; font-size:12px;">Set the Idle time before you are logged out of your Console.</i>
                        </div> --}}
                                </div>
                                <div class="form-group">
                                    <h6 class="border-bottom pb-1 text-blue-primary">2FA Authentication</h6>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="twofa" id="twofa_1"
                                            value="1">
                                        <label class="form-check-label" for="twofa_1">Email</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="twofa" id="twofa_2"
                                            value="2"  checked>

                                        <label class="form-check-label" for="twofa_2">Text</label>
                                    </div>

                                    {{--  <div class="pt-1" >
                            <i style="color: #6e707e; font-size:12px;">How your authentication code will be sent to you.</i>
                        </div> --}}
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer p-0">
                            <button type="submit" class="btn-success-modal mr-3">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->


    <div class="modal fade upload-modal" id="staffEditModal" tabindex="-1" role="dialog"
        aria-labelledby="editStaffnewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStaffnewTitle"><img
                            src="{{ asset('assets/dashboard/img/add-member.png') }}" class="custompopicon">Edit Staff
                        Member </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-content" id="modalStaffEditContent"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade upload-modal" id="staffViewModal" tabindex="-1" role="dialog"
        aria-labelledby="editStaffnewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewStaffnewTitle"><img
                            src="{{ asset('assets/dashboard/img/add-member.png') }}" class="custompopicon">View Staff
                        Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-content" id="modalViewStaffContent"></div>
                </div>
            </div>
        </div>
    </div>





@endsection
@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>


    <script>
        $(document).ready(function() {
            var table = $("#staff_data_table").DataTable({
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search by Staff ID",
                    lengthMenu: "Show _MENU_ entries",
                    zeroRecords: "No matching records found",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries available",
                    infoFiltered: "(filtered from _MAX_ total entries)"
                },

                processing: true,
                serverSide: true,
                lengthChange: true,
                searchable: false,
                bStateSave: false,

                ajax: {
                    url: "{{ route('admin.staff_list_data_table') }}",
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
                        data: 'name',
                        name: 'name',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'security_level',
                        name: 'Security Level',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'position',
                        name: 'Position',
                        searchable: true,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    /*{
                        data: 'territory',
                        name: 'territory',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },*/
                    {
                        data: 'phone',
                        name: 'phone',
                        searchable: true,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        searchable: false,
                        orderable: true,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'login_count',
                        name: 'login_count',
                        searchable: true,
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
                        data: 'status',
                        name: 'status',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false,
                        defaultContent: 'NA'
                    },
                ],

                order: [
                    [1, 'DESC']
                ],
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                pageLength: 10,
            });

            let countdown = 15;
            setInterval(() => {
                countdown--;
                $(".refreshSeconds").text(' ' + countdown);

                if (countdown <= 0) {
                    $('#listings').DataTable().ajax.reload(null, false);
                    countdown = 15;
                }

            }, 1000);

            $('#customSearch').on('keyup', function() {
                $('#listings').DataTable().search(this.value).draw();
            });

            $(document).on('submit', 'form[name="add_staff"]', function(e) {
                e.preventDefault();
                let form = $(this);
                let formData = new FormData(this);
                $('span.text-danger').text('');

                swal_waiting_popup({
                    'title': 'Saving Staff Details'
                });
                //  return false

                $.ajax({
                    url: "{{ route('admin.add-staff') }}",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        table.ajax.reload(null, false);
                        Swal.close();
                        $('span.text-danger').text('');
                        $('#addStaffnew').modal('hide');
                        $('#staffEditModal').modal('hide');
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

            /*** Suspend Staff */
            $(document).on('click', '.account-suspend-btn', async function(e) {
                if (await isConfirm({
                        'action': 'Suspend',
                        'text': 'Are you sure you want to suspend this account?'
                    })) {
                    swal_waiting_popup({
                        'title': 'Suspending Account'
                    });
                    ajaxRequest({
                        url: "{{ route('admin.suspend-staff') }}",
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
            })

            /* Approve staff */
            $(document).on('click', '.approve_account', async function(e) {
                if (await isConfirm({
                        'action': 'Approve',
                        'text': 'Are you sure you want to approve this account?'
                    })) {
                    swal_waiting_popup({
                        'title': 'Approving Account'
                    });
                    $.ajax({
                        url: "{{ route('admin.approve_staff_account') }}",
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

            /*** Activate staff Account */
            $(document).on('click', '.active-account-btn', async function(e) {
                if (await isConfirm({
                        'action': 'Activate',
                        'text': 'Are you sure you want to activate this account?'
                    })) {
                    swal_waiting_popup({
                        'title': 'Activating Account'
                    });
                    $.ajax({
                        url: "{{ route('admin.active-staff-account') }}",
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
        /*** Edit the staff */
        $(document).on('click', '.edit-staff-btn', function() {
            let id = $(this).data('id');
            $.ajax({
                url: "/admin-dashboard/edit-staff/" + id,
                type: 'GET',
                success: function(response) {
                    if ($.trim(response) === "") {
                        swal_error_popup("Staff data not found");
                    } else {
                        $('#modalStaffEditContent').html(response);
                        $('#staffEditModal').modal('show');
                    }
                },
                error: function() {
                    alert("Error loading form");
                }
            });
        });

        /*** Edit the staff */
        $(document).on('click', '.view-staff-btn', function() {
            let id = $(this).data('id');
            $.ajax({
                url: "/admin-dashboard/view-staff/" + id,
                type: 'GET',
                success: function(response) {
                    if ($.trim(response) === "") {
                        swal_error_popup("Staff data not found");
                    } else {
                        $('#modalViewStaffContent').html(response);
                        $('#staffViewModal').modal('show');
                    }
                },

                error: function() {
                    alert("Error loading form");
                }
            });
        });

        $(document).ready(function() {
            $("#security_level").on("change", function() {
                let level = $(this).val();
                // Auto-select position = same value as security_level
                $("#position").val(level).trigger("change");
                $("#position").prop("disabled", true);
            });
        });
    </script>
@endpush
