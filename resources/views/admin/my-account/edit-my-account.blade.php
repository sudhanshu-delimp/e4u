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
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">My Account </h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b>
                </span>
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
                        <button type="button" class="common-save-btn dctour float-right" id="change_pin_modal"
                            data-toggle="modal" data-target="#sendOtp_modal">Change PIN</button>
                    </div>
                    <form id="userProfile" class="common-form" action="{{ route('admin.account.update', [$staff->id]) }}"
                        method="POST">
                        @csrf
                        <!-- Start Personal Details -->
                        <input type="hidden" name="user_id" value="{{ $staff->id }}">

                        <div class="row inner-row">
                            <div class="col-lg-12">
                                <div class="card-top">
                                    <div class="card-icon">
                                        <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">

                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>

                                            <g id="SVGRepo_iconCarrier">

                                                <path
                                                    d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                                    stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                </path>

                                                <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                                                    stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
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
                                            name="address" id="address" value="{{ $staff->staff_detail->address }}">
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
                                        <svg version="1.1" id="designs" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="40px" height="40px"
                                            viewBox="0 0 32 32" xml:space="preserve" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <style type="text/css">
                                                    .sketchy_een {
                                                        fill: #ff3c5f;
                                                    }
                                                </style>
                                                <path class="sketchy_een"
                                                    d="M28.598,20.976c-0.014-0.232-0.022-0.466-0.043-0.698c-0.043-0.478-0.087-0.956-0.118-1.434 c-0.026-0.37-0.035-0.74-0.191-1.082c-0.047-0.104-0.122-0.196-0.205-0.279c-0.144-0.146-0.285-0.196-0.47-0.275 c-0.123-0.051-0.274-0.05-0.414-0.061c-0.181-0.03-0.36-0.065-0.544-0.086c-0.206-0.025-0.413-0.042-0.62-0.06 c-0.004-0.239-0.008-0.478-0.014-0.717c-0.002-0.077-0.003-0.155-0.005-0.232c0.128,0.085,0.27,0.145,0.43,0.135 c0.421-0.023,0.842-0.043,1.255-0.132c0.366-0.077,0.665-0.364,0.763-0.72c0.043-0.159,0.026-0.327,0.043-0.488 c0.051-0.503,0.026-1.021,0.028-1.528c0.006-0.718,0.132-1.707-0.592-2.132c-0.342-0.199-0.763-0.166-1.145-0.164 c-0.285,0-0.571-0.021-0.858-0.039c0-0.436-0.009-0.872-0.014-1.307c0.254,0.001,0.507-0.03,0.758-0.06 c0.183-0.024,0.364-0.045,0.547-0.059c0.283-0.021,0.58-0.038,0.832-0.183c0.163-0.094,0.323-0.238,0.403-0.411 c0.094-0.203,0.118-0.346,0.142-0.568c0.014-0.144,0.008-0.291,0.008-0.435c-0.004-0.275-0.012-0.551-0.01-0.826 c0.002-0.35,0.01-0.702,0.002-1.052c-0.01-0.386-0.035-0.779-0.197-1.133c-0.132-0.293-0.425-0.514-0.734-0.586 c-0.183-0.041-0.372-0.051-0.557-0.067c-0.172-0.015-0.345-0.019-0.517-0.019c-0.173,0-0.345,0.004-0.517,0.005 c-0.019,0-0.038,0-0.056,0c0.001-0.021,0.002-0.041,0.003-0.061c0.018-0.264-0.126-0.493-0.329-0.648 c-0.016-0.042-0.02-0.087-0.043-0.126c-0.106-0.181-0.317-0.372-0.533-0.409C24.89,3.008,24.696,3,24.501,3 c-0.171,0-0.342,0.006-0.514,0.008c-0.167,0.004-0.334,0.004-0.502,0.002c-0.167,0-0.332,0-0.5,0.002 c-0.679,0.01-1.357,0.02-2.038,0.036c-1.611,0.04-3.222,0.132-4.833,0.132c-0.842,0-1.684-0.04-2.525-0.045 c-0.702-0.004-1.402-0.041-2.105-0.051c-0.277-0.004-0.551-0.023-0.826-0.039c-0.33-0.018-0.663-0.002-0.993,0 c-0.366,0-0.734,0.014-1.099,0.012c-0.38,0-0.759-0.006-1.141-0.004c-0.33,0.004-0.663,0.01-0.993,0.02 C5.966,3.084,5.579,3.449,5.579,3.925c0,0.025,0.013,0.048,0.015,0.073C5.508,4.133,5.446,4.282,5.452,4.45 C5.466,4.893,5.493,5.334,5.52,5.775C5.24,5.784,4.96,5.79,4.68,5.806c-0.502,0.025-0.921,0.399-0.921,0.92 c0,0.48,0.419,0.952,0.921,0.92c0.302-0.018,0.603-0.04,0.904-0.062C5.59,8.107,5.594,8.629,5.613,9.151 C5.617,9.272,5.618,9.394,5.62,9.516C5.19,9.559,4.758,9.576,4.328,9.606C3.87,9.638,3.484,9.967,3.484,10.45 c0,0.431,0.384,0.881,0.844,0.844c0.45-0.037,0.899-0.083,1.348-0.132c0.006,0.108,0.01,0.217,0.016,0.326 c0.034,0.64,0.075,1.277,0.119,1.915c-0.52,0.05-1.047,0.062-1.57,0.086c-0.458,0.021-0.844,0.368-0.844,0.844 c0,0.44,0.384,0.872,0.844,0.846c0.559-0.033,1.112-0.113,1.668-0.15c0.029,0.436,0.066,0.871,0.078,1.307 c0.005,0.206,0.013,0.412,0.02,0.617c-0.51,0.002-1.022-0.039-1.53-0.073c-0.017-0.001-0.033-0.002-0.049-0.002 c-0.452,0-0.822,0.438-0.822,0.873c0,0.496,0.397,0.848,0.871,0.873c0.526,0.028,1.057,0.041,1.584,0.028 c0.021,0.788,0.02,1.579,0.004,2.369c-0.046-0.001-0.091-0.004-0.137-0.004c-0.405,0-0.813,0.036-1.213,0.078 c-0.228,0.023-0.419,0.075-0.586,0.244c-0.155,0.154-0.244,0.366-0.244,0.586c0,0.218,0.089,0.431,0.244,0.586 c0.14,0.14,0.382,0.268,0.586,0.242c0.42-0.051,0.849-0.099,1.275-0.105c-0.013,0.229-0.028,0.458-0.035,0.687 c-0.014,0.44-0.024,0.879-0.047,1.32c-0.007,0.117-0.009,0.235-0.015,0.353c-0.434,0.025-0.868,0.052-1.302,0.082 c-0.236,0.018-0.443,0.083-0.614,0.254c-0.161,0.161-0.254,0.383-0.254,0.614c0,0.442,0.395,0.905,0.867,0.867 c0.408-0.033,0.815-0.076,1.221-0.12c-0.031,0.463-0.069,0.926-0.105,1.389c-0.037,0.474,0.425,0.874,0.873,0.874 c0.055,0,0.105-0.022,0.159-0.032C6.84,28.977,6.95,29.003,7.066,29c0.502-0.014,1.001-0.033,1.503-0.059 c0.415-0.021,0.828-0.062,1.241-0.084c0.812-0.045,1.625-0.035,2.437-0.029c0.903,0.01,1.808-0.006,2.712-0.022 c0.822-0.014,1.646-0.027,2.468-0.025c1.316,0.006,2.632,0.02,3.948,0.061c0.588,0.02,1.18,0.031,1.768,0.077 c0.592,0.043,1.194,0.051,1.786,0.025c0.182-0.007,0.344-0.078,0.483-0.176c0.42-0.052,0.8-0.412,0.778-0.855 c-0.018-0.34-0.014-0.683-0.028-1.025c-0.012-0.324-0.02-0.649-0.028-0.974c-0.018-0.771,0-1.542,0.002-2.311 c0-0.441-0.008-0.882-0.013-1.322c0,0,0.001,0,0.001,0c0.067,0.006,0.134,0.012,0.203,0.02c-0.052-0.007-0.103-0.014-0.154-0.021 c0.249,0.032,0.481,0.052,0.736,0.04c0.285-0.016,0.566-0.036,0.852-0.079c0.385-0.059,0.655-0.36,0.783-0.708 C28.612,21.355,28.608,21.161,28.598,20.976z M26.594,12.638c0.073,0.002,0.148,0,0.222-0.002c0.033,0,0.067-0.001,0.101-0.001 c0.025,0.386,0.018,0.775,0.021,1.16c0.002,0.251,0.005,0.499-0.006,0.747c-0.176,0.01-0.352,0.011-0.529-0.005 c-0.16-0.014-0.323,0.062-0.46,0.158c-0.006-0.307-0.012-0.614-0.02-0.92c-0.012-0.383-0.007-0.766-0.01-1.149 C26.14,12.63,26.367,12.637,26.594,12.638z M26.924,5.915c0.023,0.418-0.006,0.836-0.024,1.254c-0.009,0.25-0.008,0.503-0.014,0.755 c-0.339,0.038-0.68,0.059-1.018,0.049c-0.01-0.441-0.025-0.884-0.011-1.325c0.008-0.242,0.028-0.483,0.04-0.725 C26.24,5.911,26.582,5.899,26.924,5.915z M22.713,27.212c-0.846-0.022-1.693-0.042-2.541-0.057 c-0.312-0.007-0.625-0.009-0.937-0.009c-0.521,0-1.043,0.007-1.565,0.013c-0.899,0.012-1.798,0.021-2.697,0.043 c-1.261,0.027-2.522,0.025-3.782,0.039c-0.633,0.008-1.267,0.042-1.902,0.065c-0.591,0.021-1.183,0.028-1.775,0.04 c0.075-1.108,0.065-2.222,0.103-3.331c0.055-1.574,0.081-3.151,0.061-4.725c-0.01-0.787-0.067-1.572-0.087-2.356 c-0.02-0.757-0.031-1.512-0.075-2.268c-0.049-0.828-0.13-1.65-0.159-2.479c-0.028-0.794-0.067-1.589-0.081-2.386 c-0.014-0.889-0.004-1.78-0.01-2.669C7.262,6.338,7.241,5.542,7.223,4.745C7.792,4.719,8.36,4.697,8.93,4.708 c0.372,0.006,0.745,0.01,1.117,0.01c0.295,0.002,0.584,0.023,0.877,0.041c0.622,0.038,1.249,0.034,1.872,0.049 c0.407,0.008,0.814,0.01,1.223,0.01c0.411,0,0.822,0.028,1.235,0.04c0.846,0.02,1.69-0.01,2.533-0.045 c0.812-0.031,1.627-0.031,2.439-0.037c1.35-0.008,2.701-0.055,4.051-0.014c-0.029,0.721-0.043,1.441-0.054,2.163 c-0.006,0.382-0.012,0.764-0.006,1.147c0.008,0.409,0.037,0.818,0.053,1.227c0.031,0.872,0.026,1.745,0.029,2.616 c0.004,0.859,0.02,1.719,0.043,2.579c0.02,0.796,0.018,1.593,0.01,2.39c-0.008,0.846,0.024,1.691,0.041,2.535 c0.033,1.601,0.029,3.202,0.041,4.803c0.006,0.641,0.004,1.285-0.008,1.926c-0.004,0.287,0.002,0.572,0,0.857 c-0.001,0.081,0.004,0.161,0.003,0.241c-0.207-0.002-0.413-0.009-0.62-0.011C23.445,27.229,23.081,27.22,22.713,27.212z M26.627,20.642c-0.091-0.021-0.179-0.047-0.271-0.067c-0.088-0.019-0.175-0.015-0.261-0.01c-0.012-0.587-0.021-1.175-0.049-1.761 c-0.003-0.049-0.003-0.097-0.005-0.146c0.23,0.013,0.461,0.017,0.69,0.041c0.037,0.005,0.074,0.011,0.111,0.016 c0.028,0.388,0.028,0.778,0.049,1.167c0.015,0.255,0.042,0.512,0.053,0.768C26.837,20.65,26.731,20.649,26.627,20.642z M18.899,20.011c-0.026-0.195-0.051-0.387-0.094-0.58c-0.045-0.195-0.116-0.374-0.197-0.559c-0.104-0.24-0.222-0.476-0.336-0.712 c-0.256-0.541-0.69-1.048-1.227-1.324c-0.051-0.026-0.107-0.043-0.16-0.067c0.165-0.16,0.315-0.333,0.44-0.539 c0.1-0.163,0.165-0.348,0.234-0.527c0.047-0.122,0.081-0.244,0.108-0.37c0.134-0.631,0.205-1.308-0.02-1.929 c-0.153-0.427-0.372-0.785-0.675-1.124c-0.309-0.344-0.677-0.702-1.149-0.781c-0.082-0.014-0.16-0.023-0.237-0.023 c-0.121-0.075-0.26-0.119-0.407-0.119c-0.012,0-0.024,0-0.037,0.001c-0.474,0.024-0.96,0.055-1.381,0.297 c-0.327,0.188-0.545,0.479-0.745,0.791c-0.161,0.251-0.303,0.513-0.435,0.783c-0.091,0.189-0.179,0.386-0.256,0.58 c-0.057,0.152-0.086,0.304-0.109,0.461c0.002-0.018,0.004-0.036,0.006-0.054c-0.005,0.036-0.009,0.072-0.014,0.108 c-0.005,0.035-0.009,0.071-0.014,0.106c0.003-0.023,0.006-0.046,0.009-0.069c-0.044,0.374-0.058,0.728,0.006,1.109 c0.058,0.333,0.264,0.616,0.467,0.879c0.125,0.169,0.243,0.347,0.408,0.478c0.089,0.07,0.184,0.127,0.277,0.188 c-0.478,0.225-0.906,0.554-1.256,0.946c-0.818,0.918-1.088,2.195-1.153,3.387c-0.002,0.034-0.002,0.067-0.004,0.101 c-0.018,0.452,0.391,0.83,0.828,0.83c0.46,0,0.818-0.378,0.828-0.83c0.008-0.269,0.008-0.539,0.034-0.807 c0.058-0.348,0.158-0.688,0.287-1.018c0.085-0.188,0.185-0.371,0.301-0.541c0.153-0.179,0.328-0.337,0.51-0.485 c0.128-0.089,0.266-0.163,0.408-0.228c0.288-0.106,0.599-0.161,0.904-0.207c0.224-0.024,0.457-0.031,0.683-0.014 c0.079,0.016,0.157,0.036,0.234,0.062c0.102,0.05,0.201,0.105,0.294,0.168c0.088,0.078,0.172,0.16,0.25,0.249 c0.088,0.135,0.162,0.278,0.235,0.422c0.091,0.182,0.182,0.363,0.266,0.549c0.078,0.215,0.126,0.439,0.162,0.664 c0.048,0.399,0.082,0.801,0.104,1.203c0.028,0.47,0.372,0.863,0.863,0.863c0.48,0,0.848-0.393,0.862-0.863 c0.008-0.242-0.022-0.486-0.037-0.728C18.956,20.495,18.931,20.251,18.899,20.011z M13.797,14.553 c0.022-0.122,0.055-0.24,0.096-0.356c0.128-0.275,0.282-0.543,0.461-0.789c0.071-0.087,0.146-0.171,0.229-0.247 c0.011-0.007,0.022-0.013,0.034-0.02c0.025-0.007,0.049-0.014,0.074-0.019c0.15-0.011,0.301-0.013,0.452-0.018 c0.006,0,0.011,0,0.017-0.001c0.061,0.034,0.128,0.06,0.199,0.076c0.014,0.002,0.027,0.005,0.041,0.008 c0.001,0,0.001,0.001,0.002,0.001c0.152,0.135,0.286,0.288,0.415,0.446c0.073,0.104,0.136,0.213,0.192,0.327 c0.034,0.097,0.061,0.197,0.081,0.298c0.011,0.161,0.007,0.319-0.008,0.479c-0.032,0.198-0.076,0.391-0.143,0.58 c-0.036,0.069-0.075,0.135-0.118,0.2c-0.068,0.075-0.142,0.143-0.219,0.208c-0.074,0.051-0.148,0.098-0.228,0.141 c-0.047,0.017-0.095,0.031-0.144,0.044c-0.096,0.004-0.191,0.002-0.288-0.005c-0.178-0.032-0.356-0.076-0.528-0.135 c-0.081-0.041-0.16-0.086-0.235-0.137c-0.021-0.019-0.04-0.039-0.059-0.06c-0.11-0.146-0.221-0.296-0.307-0.458 c-0.01-0.033-0.019-0.066-0.027-0.101C13.779,14.862,13.784,14.707,13.797,14.553z">
                                                </path>
                                            </g>
                                        </svg>
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
                                            placeholder="Email (optional)" value="{{ $staff->staff_detail->kin_email }}">
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
                                        <svg width="40px" height="40px" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <title></title>
                                                <g id="Complete">
                                                    <g id="info-circle">
                                                        <g>
                                                            <circle cx="12" cy="12" data-name="--Circle"
                                                                fill="none" id="_--Circle" r="10" stroke="#ff3c5f"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"></circle>
                                                            <line fill="none" stroke="#ff3c5f" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2" x1="12"
                                                                x2="12" y1="12" y2="16"></line>
                                                            <line fill="none" stroke="#ff3c5f" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2" x1="12"
                                                                x2="12" y1="8" y2="8"></line>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
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
                                        <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M6 7H7M6 10H7M11 10H12M11 13H12M6 13H7M11 7H12M11 21V18C11 16.8954 10.1046 16 9 16C7.89543 16 7 16.8954 7 18V21M11 21H12.5M11 21H7M7 21H3V4.6C3 4.03995 3 3.75992 3.10899 3.54601C3.20487 3.35785 3.35785 3.20487 3.54601 3.10899C3.75992 3 4.03995 3 4.6 3H13.4C13.9601 3 14.2401 3 14.454 3.10899C14.6422 3.20487 14.7951 3.35785 14.891 3.54601C15 3.75992 15 4.03995 15 4.6V12M20.8832 16.0318C20.8207 16.0353 20.7578 16.0371 20.6944 16.0371C19.7553 16.0371 18.8987 15.6449 18.25 15C17.6013 15.6449 16.7446 16.0371 15.8056 16.0371C15.7422 16.0371 15.6793 16.0353 15.6168 16.0318C15.5405 16.3588 15.5 16.7018 15.5 17.0554C15.5 18.9532 16.6685 20.5479 18.25 21C19.8315 20.5479 21 18.9532 21 17.0554C21 16.7019 20.9595 16.3589 20.8832 16.0318Z"
                                                    stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
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
                                <div class="card-top">
                                    <div class="card-icon">
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <circle cx="12" cy="12" r="8.5" stroke="currentColor"
                                                stroke-width="1.8"></circle>

                                            <path d="M12 7v5l3 2" stroke="currentColor" stroke-width="1.8"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </div>

                                    <div class="card-heading">
                                        <h2>Idle Time
                                            Preference</h2>
                                    </div>
                                </div>
                                <div class="form-group radio-options">

                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="idle_preference_time"
                                            id="edit_idle_preference_time_15" value="15"
                                            {{ $setting && $setting->idle_preference_time === '15' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="edit_idle_preference_time_15">15
                                            minutes</label>
                                    </div>

                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="idle_preference_time"
                                            id="edit_idle_preference_time_30" value="30"
                                            {{ $setting && $setting->idle_preference_time === '30' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="edit_idle_preference_time_30">30
                                            minutes</label>
                                    </div>

                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="idle_preference_time"
                                            id="edit_idle_preference_time_60" value="60"
                                            {{ $setting && $setting->idle_preference_time === '60' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="edit_idle_preference_time_60">60
                                            minutes</label>
                                    </div>

                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="idle_preference_time"
                                            id="edit_idle_preference_time_never"
                                            value="{{ config('staff.idle_vever_minute') }}"
                                            {{ $setting && $setting->idle_preference_time === config('staff.idle_vever_minute') ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="edit_idle_preference_time_never">Never</label>
                                    </div>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-top">
                                    <div class="card-icon">
                                        <svg viewBox="0 0 24 24" fill="none">
                                            <path d="M12 3l8 3v5c0 5.2-3.2 8.7-8 10-4.8-1.3-8-4.8-8-10V6l8-3z"
                                                stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"></path>

                                            <path d="m8.5 11.8 2.2 2.2 4.8-5" stroke="currentColor" stroke-width="1.8"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </div>

                                    <div class="card-heading">
                                        <h2>2FA Authentication</h2>
                                    </div>
                                </div>

                                <div class="form-group radio-options">
                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="twofa" id="edit_twofa_1"
                                            value="1"
                                            {{ $staff->staff_setting && $staff->staff_setting->twofa == 1 ? 'checked' : 'checked' }}>
                                        <label class="form-check-label" for="edit_twofa_1">Email</label>
                                    </div>

                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="twofa" id="edit_twofa_2"
                                            value="2"
                                            {{ $staff->staff_setting && $staff->staff_setting->twofa == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="edit_twofa_2">Text</label>
                                    </div>
                                    </p>
                                </div>
                            </div>

                        </div>
                        <!-- End 2FA -->
                <div class="common-footer">
                    <input type="submit" value="Save" class="common-save-btn float-right" name="submit">
                </div>
                </div>
                
                </form>
            </div>

        </div>
    </div>
    </div>
    <!-- End of Main Content -->
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
