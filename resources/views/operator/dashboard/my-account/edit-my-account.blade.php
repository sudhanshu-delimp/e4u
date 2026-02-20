@extends('layouts.operator')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <style type="text/css">
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0)
        }

        #Agent_Agreement .modal-dialog {
            max-width: 1000px !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 opr-console">
        <!--middle content start here-->
        <!-- Page Heading -->
        <div class="row">
            @php
                $agreementDate = '';

                if (is_array($operator->contact_type)) {
                    $contactType = $operator->contact_type;
                } elseif (!empty($operator->contact_type)) {
                    $contactType = json_decode($operator->contact_type, true) ?? [];
                } else {
                    $contactType = [99999];
                }
                if (!empty($operator->operator_detail->agreement_date)) {
                    $agreementDate = showDateWithFormat($operator->operator_detail->agreement_date, 'd-m-Y');
                }

                $countries = config('operator.country');
                $countryName = isset($countries[$operator->country_id]['name'])
                    ? $countries[$operator->country_id]['name']
                    : '';

                $staff_detail = $staff->operator_staff_detail;
                $setting = $staff->operator_staff_setting ?? null;
                $securityLevels = config('operator_staff.security_level');
                $securityLevel = isset($staff_detail->security_level) ? $staff_detail->security_level : '';
                $staffType = $staff->type;
                $genders = config('escorts.profile.genders');
                $genderName = isset($genders[$staff->gender]) ? $genders[$staff->gender] : '';

                $securityLevelName = isset($securityLevels[$staff_detail->security_level])
                    ? $securityLevels[$staff_detail->security_level]
                    : '';

                $employmentStatuss = config('operator_staff.employment_status');
                $employmentStatus = isset($employmentStatuss[$staff_detail->employment_status])
                    ? $employmentStatuss[$staff_detail->employment_status]
                    : '';

                $staffCountryName = isset($countries[$staff->country_id]['name'])
                    ? $countries[$staff->country_id]['name']
                    : '';

                $positions = config('operator_staff.position');
                $positionLabel = isset($positions[$staff_detail->position]) ? $positions[$staff_detail->position] : '';
                $genders = config('escorts.profile.genders');
                $gender = isset($genders[$staff->gender]) ? $genders[$staff->gender] : '';

                $idle_preference_times = config('staff.idle_preference_time');
                $idle_preference_time = '';
                $twofa = '';
                if (isset($setting) && isset($setting->idle_preference_time)) {
                    $idle_preference_time = isset($idle_preference_times[(string) $setting->idle_preference_time])
                        ? $idle_preference_times[$setting->idle_preference_time]
                        : '';
                }
                $twofas = config('staff.twofa');
                if (isset($setting) && isset($setting->twofa)) {
                    $twofa = isset($twofas[$setting->twofa]) ? $twofas[$setting->twofa] : '';
                }
            @endphp
            <div class="operator-heading-wrapper col-lg-12">
                <h1 class="h1">Edit My Account</h1>
                <span class="oprhelpNote font-weight-bold" data-toggle="collapse" data-target="#notes"
                    aria-expanded="true">Help?</span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="notes"><b>Notes:</b> </p>
                        <ol>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- end --}}
        <div class="row">

            <div class="col-md-12 commanAlert"></div>

            <!-- ALERT MESSAGE -->
            <div class="col-md-12 mb-3">
                <div id="formAlert" class="alert d-none rounded" role="alert"></div>
            </div>
            <div class="col-md-12 mb-5">
                <div id="accordion" class="myacording-design">
                   
                    <div class="card">
                        <div class="card-header">
                            <a class="card-link" data-toggle="collapse" href="#Abbreviations" aria-expanded="true">
                                About Me
                            </a>
                        </div>
                        <div id="Abbreviations" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body">
                                <!-- content area -->
                                <form id="userProfile" class="v-form-design"
                                    action="{{ route('operator.staff.account.update', [$staff->id]) }}" method="POST">
                                    @csrf
                                    <!-- Start Personal Details -->
                                    <input type="hidden" name="user_id" value="{{ $staff->id }}">
                                    <div class="row">
                                        <div class=" mb-3 w-100">
                                            <h5 class="border-bottom pb-1 text-blue-primary">Personal Details</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10 px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class="my-agent">Full name</label>
                                                        <span class="form-control form-back">{{ $staff->name }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="address" class="my-agent">Address</label>
                                                        <input type="text" class="form-control rounded-0"
                                                            placeholder="Address" name="address" id="address"
                                                            value="{{ $staff_detail->address }}" >
                                                        <span class="text-danger error-address"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone" class="my-agent">Mobile</label>
                                                        <input type="text" class="form-control rounded-0"
                                                            placeholder="Phone" name="phone" id="phone"
                                                            value="{{ $staff->phone }}">
                                                        <span class="text-danger error-phone"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <span class="form-control form-back">{{ $staff->email }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="gender">Gender </label>
                                                        <span class="form-control form-back">{{ $gender }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Personal Details -->

                                    <!-- Start Next of Kin -->
                                    <div class="row">
                                        <div class=" mb-3 w-100">
                                            <h5 class="border-bottom pb-1 text-blue-primary">Next of Kin (Emergency
                                                Contact)</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10 px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Kin of Name</label>
                                                        <input type="text" name="kin_name" id="kin_name"
                                                            class="form-control rounded-0"
                                                            placeholder="Kin of Name (optional)"
                                                            value="{{ $staff_detail->kin_name }}">
                                                        <span class="text-danger error-kin_name"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Relationship</label>
                                                        <input type="text" name="kin_relationship"
                                                            id="kin_relationship" class="form-control rounded-0"
                                                            placeholder="Relationship (optional)"
                                                            value="{{ $staff_detail->kin_relationship }}">
                                                        <span class="text-danger error-kin_relationship"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Mobile</label>
                                                        <input type="text" name="kin_mobile" id="kin_mobile"
                                                            class="form-control rounded-0" placeholder="Mobile (optional)"
                                                            value="{{ $staff_detail->kin_mobile }}">
                                                        <span class="text-danger error-kin_mobile"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Email</label>
                                                        <input type="email" name="kin_email"
                                                            class="form-control rounded-0" placeholder="Email (optional)"
                                                            value="{{ $staff_detail->kin_email }}">
                                                        <span class="text-danger error-kin_email"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Next of Kin -->

                                    <!-- Start Other Details -->
                                    <div class="row">
                                        <div class=" mb-3 w-100">
                                            <h5 class="border-bottom pb-1 text-blue-primary">Other Details</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10 px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Security Level</label>
                                                        <span
                                                            class="form-control form-back">{{ $securityLevelName }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Position</label>
                                                        <span class="form-control form-back">{{ $positionLabel }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Territory</label>
                                                        <span
                                                            class="form-control form-back">{{ $staffCountryName }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Commenced Date</label>

                                                        <span class="form-control form-back">
                                                            {{ showDateWithFormat($staff_detail->commenced_date, 'd-m-Y') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Employment
                                                            Status</label>
                                                        <span
                                                            class="form-control form-back">{{ $employmentStatus }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Employment
                                                            Agreement?</label>
                                                        <span class="form-control form-back">
                                                            {{ ucfirst($staff_detail->employment_agreement) }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Other Details -->
                                    <!-- StartBuilding Security -->
                                    <div class="row">
                                        <div class=" mb-3 w-100">
                                            <h5 class="border-bottom pb-1 text-blue-primary">Building Security</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10 px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Access Code
                                                            Provided?</label>

                                                        <span class="form-control form-back">
                                                            {{ ucfirst($staff_detail->building_access_code) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Key Provided?</label>

                                                        <span class="form-control form-back">
                                                            {{ ucfirst($staff_detail->keys_issued) }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="my-agent">Car Park?</label>
                                                        <span class="form-control form-back">
                                                            {{ ucfirst($staff_detail->car_parking) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Building Security -->

                                    <!-- Start 2FA -->

                                    <div class="row">
                                        <div class="col-md-10 px-0">
                                            <p>&nbsp;</p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <h5 class="border-bottom pb-1 text-blue-primary">Idle Time Preference</h5>
                                                            
                                                        <p>
                                                        <div class="form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="idle_preference_time"
                                                                id="edit_idle_preference_time_15" value="15"
                                                                {{ $setting && $setting->idle_preference_time === '15' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="edit_idle_preference_time_15">15 minutes</label>
                                                        </div>

                                                        <div class="form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="idle_preference_time"
                                                                id="edit_idle_preference_time_30" value="30"
                                                                {{ $setting && $setting->idle_preference_time === '30' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="edit_idle_preference_time_30">30 minutes</label>
                                                        </div>

                                                        <div class="form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="idle_preference_time"
                                                                id="edit_idle_preference_time_60" value="60"
                                                                {{ $setting && $setting->idle_preference_time === '60' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="edit_idle_preference_time_60">60 minutes</label>
                                                        </div>

                                                        <div class="form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="idle_preference_time"
                                                                id="edit_idle_preference_time_never"
                                                                value="{{ config('staff.idle_vever_minute') }}"
                                                                {{ $setting && $setting->idle_preference_time === config('staff.idle_vever_minute') ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="edit_idle_preference_time_never">Never</label>
                                                        </div>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-10 px-0">
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                       <h5 class="border-bottom pb-1 text-blue-primary">2FA Authentication</h5>
                                                        <p>
                                                        <div class="form-check-inline">
                                                            <input class="form-check-input" type="radio" name="twofa"
                                                                id="edit_twofa_1" value="1"
                                                                {{ $setting && $setting->twofa == 1 ? 'checked' : 'checked' }}>
                                                            <label class="form-check-label"
                                                                for="edit_twofa_1">Email</label>
                                                        </div>

                                                        <div class="form-check-inline">
                                                            <input class="form-check-input" type="radio" name="twofa"
                                                                id="edit_twofa_2" value="2"
                                                                {{ $setting && $setting->twofa == 2 ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="edit_twofa_2">Text</label>
                                                        </div>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End 2FA -->
                                    <div class="text-right"> 
                                        <button type="submit" class="opr-common-btn float-righ" name="submit">Save</button>
                                    </div>
                                </form>

                                <!-- End content area -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade upload-modal" id="Agent_Agreement" tabindex="-1" role="dialog"
        aria-labelledby="Edit_CompetitorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="Agent_Agreement">Agent Agreement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <iframe src="{{ asset('assets/app/img/Agent%20Agreement%20-%20Victoria%20(10-2021).pdf') }}"
                        width="100%" height="800" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <!-- Operator staff update -->
    <script type="text/javascript">
        $('#userProfile').parsley({

        });
        // new
        $('#userProfile').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);

            if (form.parsley().isValid()) {

                var url = form.attr('action');
                var data = new FormData(form[0]);
                $('span.text-danger').text('');

                swal_waiting_popup({
                    'title': 'Saving Operator Staff Details'
                });

                $.ajax({
                    method: form.attr('method'),
                    url: url,
                    data: data,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        var alertBox = $('#formAlert');
                        var notes = $('#notes');
                        $('span.text-danger').text('');
                        if (!data.error) {
                            Swal.close();
                            alertBox
                                .removeClass('d-none alert-danger')
                                .addClass('alert-success')
                                .html('Your details have been updated successfully.');
                            $('html, body').animate({
                                scrollTop: notes.offset()
                                    .top // Get the top offset of the target div
                            }, 500);
                        } else {
                            alertBox
                                .removeClass('d-none alert-success')
                                .addClass('alert-danger')
                                .html('Error occured while updating data.');
                        }

                        // Optional: Auto-hide after 4 seconds
                        setTimeout(function() {
                            alertBox.addClass('d-none');
                        }, 10000);
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
                            alertBox
                                .removeClass('d-none alert-success')
                                .addClass('alert-danger')
                                .html('Oops... something went wrong. Please try again.');
                        }
                    },
                });
            }
        });
    </script>

    <!-- End operator staff update -->
    <!-- Operator update -->
    <script type="text/javascript">
        $('#operatorProfile').parsley({});
        $('#operatorProfile').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            var alertBox = $('#formAlert');
            if (form.parsley().isValid()) {
                var url = form.attr('action');
                var data = new FormData(form[0]);
                $('span.text-danger').text('');

                swal_waiting_popup({
                    'title': 'Saving Operator Details.'
                });

                $.ajax({
                    method: form.attr('method'),
                    url: url,
                    data: data,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {

                        var notes = $('#notes');
                        $('span.text-danger').text('');
                        if (!data.error) {
                            Swal.close();
                            alertBox
                                .removeClass('d-none alert-danger')
                                .addClass('alert-success')
                                .html('Your details have been updated successfully.');
                            $('html, body').animate({
                                scrollTop: notes.offset()
                                    .top // Get the top offset of the target div
                            }, 500);
                        } else {
                            alertBox
                                .removeClass('d-none alert-success')
                                .addClass('alert-danger')
                                .html('Error occured while updating data.');
                        }

                        // Optional: Auto-hide after 4 seconds
                        setTimeout(function() {
                            alertBox.addClass('d-none');
                        }, 10000);
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
                            alertBox
                                .removeClass('d-none alert-success')
                                .addClass('alert-danger')
                                .html('Oops... something went wrong. Please try again.');
                        }
                    },
                });
            }
        });
    </script>
@endpush
