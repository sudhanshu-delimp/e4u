@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    <style>
        .swal-button {
            background-color: #242a2c;
        }

        .input_not_edit {
            font-size: 13px !important;
            color: #6e707e !important;
            border-bottom: 1px solid #5D6D7E;
            margin-bottom: 0px !important;
            line-height: 19px;
            background: #f2f2f2;
        }
    </style>
@stop
@section('content')
    @php
        $securityLevels = config('staff.security_level');
        $securityLevel = isset($staff->staff_detail->security_level) ? $staff->staff_detail->security_level : '';
        $staffType = $staff->type;
        $genders = config('escorts.profile.genders');
        $genderName = isset($genders[$staff->gender]) ? $genders[$staff->gender] : '';

        $securityLevelName = isset($securityLevels[$staff->staff_detail->security_level])
            ? $securityLevels[$staff->staff_detail->security_level]
            : '';

        $employmentStatuss = config('staff.employment_status');
        $employmentStatus = isset($employmentStatuss[$staff->staff_detail->employment_status])
            ? $employmentStatuss[$staff->staff_detail->employment_status]
            : '';
        $cities = config('escorts.profile.cities');
        $cityName = isset($cities[$staff->city_id]) ? $cities[$staff->city_id] : '';

        $positions = config('staff.position');
        $positionLabel = isset($positions[$staff->staff_detail->position])
            ? $positions[$staff->staff_detail->position]
            : '';
        $genders = config('escorts.profile.genders');
        $gender = isset($genders[$staff->gender]) ? $genders[$staff->gender] : '';

        $setting = $staff->staff_setting ?? null;
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
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                <!--middle content start here-->
                <!--middle content end here-->
                <div class="row">
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">My Account </h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                            style="font-size:16px"><b>Help?</b> </span>
                    </div>
                    <div class="mb-4 col-md-12">
                        <div class="card collapse" id="notes">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <ol>
                                    <li>Keep your account details up to date.</li>
                                    <li>You can change your password <a href="{{ route('admin.change.password') }}"
                                            class="custom_links_design">here</a>.</li>
                                </ol>
                            </div>
                        </div>
                    </div>


                    <!-- ALERT MESSAGE -->
                    <div class="col-md-12 mb-3">
                        <div id="formAlert" class="alert d-none rounded" role="alert"></div>
                    </div>
                   

                    <div class="col-md-12 mb-5">
                        <div class="common-card">
                            <div class="col-md-12 mb-4">
                                <button type="button" class="common-save-btn dctour float-right" id="change_pin_modal" data-toggle="modal"
                                    data-target="#sendOtp_modal">Change PIN</button>
                            </div>
                            <form id="userProfile" class="common-form"
                                action="{{ route('admin.account.update', [$staff->id]) }}" method="POST">
                                @csrf
                                <!-- Start Personal Details -->
                                <input type="hidden" name="user_id" value="{{ $staff->id }}">

                                <div class="row inner-row">
                                    <div class="col-lg-12">
                                        <div class="card-top">
                                            <div class="card-icon">
                                                <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>

                                                    <g id="SVGRepo_iconCarrier">

                                                        <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        </path>

                                                        <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        </path>

                                                    </g>

                                                </svg>
                                            </div>

                                            <div class="card-heading">
                                                <h2>Personal Details</h2>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="inner-field-row">
                                            <div class="form-group">
                                                <label for="name" class="my-agent">Full name</label>
                                                <p class="input_not_edit">{{ $staff->name }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Gender </label>
                                                <p class="input_not_edit">{{ $gender }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <p class="input_not_edit">{{ $staff->email }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="my-agent">Address</label>
                                                <input type="text" class="form-control rounded-0" placeholder="Address"
                                                    name="address" id="address"
                                                    value="{{ $staff->staff_detail->address }}">
                                                <span class="text-danger error-address"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="my-agent">Mobile</label>
                                                <input type="text" class="form-control rounded-0" placeholder="Phone"
                                                    name="phone" id="phone" value="{{ $staff->phone }}">
                                                <span class="text-danger error-phone"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Personal Details -->

                                <!-- Start Next of Kin -->
                                <div class="row inner-row">
                                    <div class="col-lg-12">
                                        <div class="card-top">
                                            <div class="card-icon">
                                                <svg width="40px" height="40px"  fill="#ff3c5f" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 32 32" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M20.494,25.218c0-2.852-2.312-5.164-5.164-5.164h-1.333c-0.692,0-1.253-0.561-1.253-1.253 c0-0.257,0.104-0.503,0.287-0.683c0.775-0.756,1.427-1.77,1.899-2.862c0.096,0.071,0.199,0.122,0.315,0.122 c0.749,0,1.628-1.654,1.628-2.782s-0.104-2.042-0.854-2.042c-0.088,0-0.183,0.015-0.278,0.039 c-0.053-3.058-0.826-6.873-5.495-6.873c-4.872,0-5.441,3.808-5.495,6.863c-0.068-0.013-0.138-0.028-0.201-0.028 c-0.749,0-0.853,0.914-0.853,2.042s0.879,2.782,1.628,2.782c0.092,0,0.178-0.026,0.258-0.072c0.47,1.075,1.114,2.07,1.878,2.813 c0.184,0.18,0.287,0.426,0.287,0.683c0,0.692-0.561,1.253-1.253,1.253H5.164C2.312,20.054,0,22.366,0,25.218v1.432 c0,0.9,0.73,1.631,1.631,1.631h17.232c0.902,0,1.632-0.73,1.632-1.631L20.494,25.218L20.494,25.218z"></path> <path d="M16.34,5.886c0.417,0.923,0.715,2.059,0.84,3.465c0.309,0.19,0.539,0.498,0.729,0.869h12.883 C31.459,10.22,32,9.679,32,9.012V7.095c0-0.667-0.541-1.208-1.208-1.208L16.34,5.886L16.34,5.886z"></path> <path d="M15.857,16.784c-0.034,0.063-0.075,0.119-0.11,0.183v1.147h15.045c0.667,0,1.208-0.541,1.208-1.207V14.99 c0-0.667-0.541-1.208-1.208-1.208H18.204C17.863,15.073,17.02,16.423,15.857,16.784z"></path> <path d="M21.994,25.218v0.794h8.798c0.667,0,1.208-0.541,1.208-1.208v-1.917c0-0.667-0.541-1.208-1.208-1.208h-9.825 C21.613,22.704,21.994,23.915,21.994,25.218z"></path> </g> </g> </g></svg>
                                            </div>

                                            <div class="card-heading">
                                                <h2>Next of Kin (Emergency Contact)</h2>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="inner-field-row">
                                            <div class="form-group">
                                                <label for="email" class="my-agent">Kin of Name</label>
                                                <input type="text" name="kin_name" id="kin_name"
                                                    class="form-control rounded-0" placeholder="Kin of Name (optional)"
                                                    value="{{ $staff->staff_detail->kin_name }}">
                                                <span class="text-danger error-kin_name"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="my-agent">Relationship</label>
                                                <input type="text" name="kin_relationship" id="kin_relationship"
                                                    class="form-control rounded-0" placeholder="Relationship (optional)"
                                                    value="{{ $staff->staff_detail->kin_relationship }}">
                                                <span class="text-danger error-kin_relationship"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="my-agent">Mobile</label>
                                                <input type="text" name="kin_mobile" id="kin_mobile"
                                                    class="form-control rounded-0" placeholder="Mobile (optional)"
                                                    value="{{ $staff->staff_detail->kin_mobile }}">
                                                <span class="text-danger error-kin_mobile"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="my-agent">Email</label>
                                                <input type="email" name="kin_email" class="form-control rounded-0"
                                                    placeholder="Email (optional)"
                                                    value="{{ $staff->staff_detail->kin_email }}">
                                                <span class="text-danger error-kin_email"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Next of Kin -->

                                <!-- Start Other Details -->
                                <div class="row inner-row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="card-top">
                                            <div class="card-icon">
                                                <svg width="40px" height="40px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title></title> <g id="Complete"> <g id="info-circle"> <g> <circle cx="12" cy="12" data-name="--Circle" fill="none" id="_--Circle" r="10" stroke="#ff3c5f" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle> <line fill="none" stroke="#ff3c5f" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="12" x2="12" y1="12" y2="16"></line> <line fill="none" stroke="#ff3c5f" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="12" x2="12" y1="8" y2="8"></line> </g> </g> </g> </g></svg>
                                            </div>

                                            <div class="card-heading">
                                                <h2>Other Details</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="inner-field-row">
                                            <div class="form-group">
                                                <label for="email" class="my-agent">Security Level</label>
                                                <p class="input_not_edit">{{ $securityLevelName }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="my-agent">Position</label>
                                                <p class="input_not_edit">{{ $positionLabel }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="my-agent">Location</label>
                                                <p class="input_not_edit">{{ $cityName }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="my-agent">Commenced Date</label>

                                                <p class="input_not_edit">
                                                    {{ showDateWithFormat($staff->staff_detail->commenced_date, 'd-m-Y') }}
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="my-agent">Employment
                                                    Status</label>
                                                <p class="input_not_edit">{{ $employmentStatus }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="my-agent">Employment
                                                    Agreement?</label>
                                                <p class="input_not_edit">
                                                    {{ ucfirst($staff->staff_detail->employment_agreement) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Other Details -->
                                <!-- StartBuilding Security -->
                                <div class="row inner-row">

                                    <div class="col-lg-12">
                                        <div class="card-top">
                                            <div class="card-icon">
                                                <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 7H7M6 10H7M11 10H12M11 13H12M6 13H7M11 7H12M11 21V18C11 16.8954 10.1046 16 9 16C7.89543 16 7 16.8954 7 18V21M11 21H12.5M11 21H7M7 21H3V4.6C3 4.03995 3 3.75992 3.10899 3.54601C3.20487 3.35785 3.35785 3.20487 3.54601 3.10899C3.75992 3 4.03995 3 4.6 3H13.4C13.9601 3 14.2401 3 14.454 3.10899C14.6422 3.20487 14.7951 3.35785 14.891 3.54601C15 3.75992 15 4.03995 15 4.6V12M20.8832 16.0318C20.8207 16.0353 20.7578 16.0371 20.6944 16.0371C19.7553 16.0371 18.8987 15.6449 18.25 15C17.6013 15.6449 16.7446 16.0371 15.8056 16.0371C15.7422 16.0371 15.6793 16.0353 15.6168 16.0318C15.5405 16.3588 15.5 16.7018 15.5 17.0554C15.5 18.9532 16.6685 20.5479 18.25 21C19.8315 20.5479 21 18.9532 21 17.0554C21 16.7019 20.9595 16.3589 20.8832 16.0318Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                            </div>

                                            <div class="card-heading">
                                                <h2>Building Security</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="inner-field-row">
                                            <div class="form-group">
                                                <label for="email" class="my-agent">Access Code
                                                    Provided?</label>

                                                <p class="input_not_edit">
                                                    {{ ucfirst($staff->staff_detail->building_access_code) }}
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="my-agent">Key Provided?</label>

                                                <p class="input_not_edit">
                                                    {{ ucfirst($staff->staff_detail->keys_issued) }}
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="my-agent">Car Park?</label>
                                                <p class="input_not_edit">
                                                    {{ ucfirst($staff->staff_detail->car_parking) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Building Security -->

                                <!-- Start 2FA -->

                                <div class="row inner-row">
                                    <div class="col-md-6">
                                        <div class="col-lg-12">
                                            <div class="card-top">
                                                <div class="card-icon">
                                                    <svg viewBox="0 0 24 24" fill="none">
                                                        <circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.8"></circle>

                                                        <path d="M12 7v5l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </div>

                                                <div class="card-heading">
                                                    <h2>Idle Time
                                                        Preference</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group radio-options">

                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="idle_preference_time" id="edit_idle_preference_time_15"
                                                        value="15"
                                                        {{ $setting && $setting->idle_preference_time === '15' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="edit_idle_preference_time_15">15
                                                        minutes</label>
                                                </div>

                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="idle_preference_time" id="edit_idle_preference_time_30"
                                                        value="30"
                                                        {{ $setting && $setting->idle_preference_time === '30' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="edit_idle_preference_time_30">30
                                                        minutes</label>
                                                </div>

                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="idle_preference_time" id="edit_idle_preference_time_60"
                                                        value="60"
                                                        {{ $setting && $setting->idle_preference_time === '60' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="edit_idle_preference_time_60">60
                                                        minutes</label>
                                                </div>

                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="idle_preference_time" id="edit_idle_preference_time_never"
                                                        value="{{ config('staff.idle_vever_minute') }}"
                                                        {{ $setting && $setting->idle_preference_time === config('staff.idle_vever_minute') ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="edit_idle_preference_time_never">Never</label>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-lg-12">
                                            <div class="card-top">
                                                <div class="card-icon">
                                                    <svg viewBox="0 0 24 24" fill="none">
                                                <path d="M12 3l8 3v5c0 5.2-3.2 8.7-8 10-4.8-1.3-8-4.8-8-10V6l8-3z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"></path>

                                                <path d="m8.5 11.8 2.2 2.2 4.8-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                                </div>

                                                <div class="card-heading">
                                                    <h2>2FA Authentication</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">

                                            <div class="form-group radio-options">
                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="twofa"
                                                        id="edit_twofa_1" value="1"
                                                        {{ $staff->staff_setting && $staff->staff_setting->twofa == 1 ? 'checked' : 'checked' }}>
                                                    <label class="form-check-label" for="edit_twofa_1">Email</label>
                                                </div>

                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="twofa"
                                                        id="edit_twofa_2" value="2"
                                                        {{ $staff->staff_setting && $staff->staff_setting->twofa == 2 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="edit_twofa_2">Text</label>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End 2FA -->
                                <div class="common-footer">
                                    <input type="submit" value="save" class="common-save-btn float-right"
                                        name="submit">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->
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
    <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    @include('modal.two-step-verification', ['action' => false, 'inPinMode' => true])
    @include('modal.pin-change', ['mode' => 'pinSetup'])
@endsection
@push('script')
    <!-- file upload plugin start here -->
    <!-- file upload plugin end here -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
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
                    'title': 'Saving Staff Details'
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

        $("#close").click(function() {
            $("#my_account_modal").hide();
            location.reload();
        });
        $('#city').select2({
            allowClear: true,
            placeholder: 'Select City',
            createTag: function(params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                    newTag: false // add additional parameters
                }
            },
            tags: false,
            minimumInputLength: 2,
            tokenSeparators: [','],
            ajax: {
                url: "{{ route('city.list') }}",
                dataType: "json",
                type: "GET",
                data: function(params) {
                    console.log(params);
                    var queryParameters = {
                        query: params.term,
                        state_id: $('#state').val()
                    }
                    return queryParameters;
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {

                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $('#state').select2({
            allowClear: true,
            placeholder: 'Select State',
            createTag: function(params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                    newTag: false // add additional parameters
                }
            },
            tags: false,
            minimumInputLength: 2,
            tokenSeparators: [','],
            ajax: {
                url: "{{ route('state.list') }}",
                dataType: "json",
                type: "GET",
                data: function(params) {
                    console.log(params);
                    var queryParameters = {
                        query: params.term,
                        country_id: $('#country').val()
                    }
                    return queryParameters;
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {

                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });


        $('#country').on('change', function(e) {
            if ($(this).val()) {
                $('#state').prop('disabled', false);
                $('#state').select2('open');
            } else {
                $('#state').prop('disabled', true);
            }
        });

        $('#state').on('change', function(e) {
            if ($(this).val()) {
                $('#city').prop('disabled', false);
                $('#city').select2('open');
            } else {
                $('#city').prop('disabled', true);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#security_level_edit").on("change", function() {
                let level = $(this).val();
                // Auto-select position = same value as security_level
                $("#position_edit").val(level).trigger("change");
                $("#position_edit").prop("disabled", true);
            });
        });
    </script>
@endpush
