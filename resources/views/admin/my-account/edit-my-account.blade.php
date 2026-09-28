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
             <div class="col-md-12 mb-4">
                <button type="button" class="common-save-btn dctour float-right" id="change_pin_modal"
                    data-toggle="modal" data-target="#sendOtp_modal">Change PIN</button>
            </div>
            <div class="col-md-12 mb-5">

               
                <div id="accordion" class="myacording-design mb-5">
                     <form id="userProfile" class="common-form" action="{{ route('admin.account.update', [$staff->id]) }}"
                        method="POST">
                        @csrf
                         <!-- Start Personal Details -->
                        <input type="hidden" name="user_id" value="{{ $staff->id }}">
                        <div class="card common-card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#additional_information">
                                    Personal Details
                                </a>
                            </div>
                            <div id="additional_information" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    
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
                                    <div class="common-footer">
                                        <input type="submit" value="Save" class="common-save-btn" name="submit">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card common-card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#profile_opt">
                                    Other Information
                                </a>
                            </div>
                            <div id="profile_opt" class="collapse" data-parent="#accordion">
                                <div class="card-body">
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
                                        <div class="col-lg-12">
                                            <div class="card-top">
                                                <div class="card-icon">
                                                    <svg fill="#ff3c5f" height="64px" width="64px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 383.273 383.273" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M194.223,208.347c-8.752-7.901-20.935-12.938-33.262-13.899c-6.951,11.052-21.072,18.353-36.691,18.353 c-15.618,0-29.737-7.238-36.688-18.287c-20.401,1.608-39.704,14.536-43.356,29.559L20.45,322.035h42.848c4.971,0,9,4.029,9,9 s-4.029,9-9,9H9.1c-0.031,0-0.061-0.163-0.092-0.163c-0.13,0-0.262-0.184-0.392-0.19c-0.197-0.008-0.394-0.014-0.587-0.035 c-0.119-0.013-0.239-0.037-0.359-0.055c-0.223-0.033-0.444-0.071-0.662-0.12c-0.045-0.01-0.089-0.013-0.133-0.024 c-0.087-0.021-0.168-0.052-0.254-0.075c-0.158-0.043-0.315-0.088-0.469-0.139c-0.138-0.046-0.273-0.097-0.407-0.149 c-0.136-0.053-0.271-0.107-0.404-0.166c-0.149-0.066-0.294-0.138-0.438-0.211c-0.11-0.056-0.219-0.113-0.326-0.174 c-0.156-0.088-0.308-0.181-0.457-0.278c-0.09-0.058-0.179-0.117-0.266-0.178c-0.153-0.107-0.302-0.219-0.447-0.334 c-0.08-0.064-0.159-0.128-0.237-0.195c-0.14-0.12-0.276-0.243-0.408-0.371c-0.078-0.075-0.155-0.152-0.231-0.23 c-0.12-0.125-0.236-0.252-0.349-0.384c-0.08-0.093-0.158-0.188-0.235-0.284c-0.097-0.123-0.191-0.249-0.282-0.377 c-0.08-0.113-0.158-0.228-0.233-0.345c-0.077-0.12-0.151-0.242-0.222-0.366c-0.075-0.13-0.147-0.262-0.216-0.396 c-0.062-0.121-0.12-0.243-0.177-0.367c-0.064-0.14-0.125-0.281-0.182-0.425c-0.051-0.129-0.098-0.259-0.143-0.391 c-0.048-0.14-0.093-0.281-0.135-0.424c-0.042-0.147-0.08-0.296-0.115-0.446c-0.03-0.13-0.059-0.259-0.084-0.391 c-0.032-0.17-0.057-0.342-0.079-0.515c-0.015-0.117-0.03-0.234-0.04-0.353c-0.016-0.187-0.024-0.374-0.028-0.563 C0.009,330.848,0,330.775,0,330.701c0-0.043,0.006-0.087,0.007-0.13c0.003-0.172,0.013-0.345,0.026-0.518 c0.01-0.144,0.021-0.291,0.037-0.433c0.016-0.131,0.038-0.269,0.06-0.4c0.03-0.182,0.062-0.376,0.103-0.554 c0.009-0.039,0.013-0.105,0.022-0.144l26.479-108.98c5.917-24.333,34.521-43.506,65.12-43.506h1.238 c3.844,0,7.264,2.526,8.512,6.162c2.12,6.173,10.585,12.506,22.666,12.506c12.082,0,20.548-6.305,22.667-12.478 c1.249-3.636,4.668-6.19,8.512-6.19h1.238c18.075,0,36.616,7.109,49.597,18.828c3.689,3.331,3.98,9.134,0.65,12.825 C203.603,211.376,197.912,211.677,194.223,208.347z M332.712,271.154l-10.039,7.271c0.314,2.71,0.472,5.441,0.472,8.17 c0,2.682-0.153,5.368-0.457,8.034l10.024,7.263c7.511,4.881,7.228,16.431-0.805,30.342c-2.963,5.133-10.914,17.07-20.726,17.071 c-1.803,0-3.566-0.414-5.139-1.201l-11.256-5.03c-4.382,3.273-9.1,6.005-14.106,8.168l-1.268,12.218 c-0.462,8.951-10.607,14.485-26.679,14.485c-16.105,0-26.244-5.542-26.681-14.511l-1.266-12.192 c-5.006-2.162-9.722-4.894-14.104-8.167l-11.288,5.044c-1.565,0.777-3.319,1.187-5.109,1.187c-9.812,0-17.763-11.938-20.726-17.072 c-8.053-13.946-8.323-25.498-0.773-30.36l9.992-7.239c-0.304-2.665-0.457-5.353-0.457-8.038c0-2.729,0.159-5.462,0.473-8.172 l-10.031-7.267c-2.879-1.882-6.794-6.271-4.951-15.819c0.855-4.431,2.896-9.589,5.747-14.526c2.963-5.133,10.915-17.07,20.727-17.07 c1.798,0,3.558,0.412,5.128,1.195l11.39,5.09c4.345-3.23,9.016-5.93,13.968-8.07l1.281-12.343 c0.436-8.971,10.574-14.514,26.681-14.514c16.073,0,26.218,5.534,26.679,14.488l1.283,12.369c4.954,2.142,9.625,4.84,13.969,8.07 l11.377-5.084c1.573-0.788,3.337-1.202,5.14-1.202c9.812,0,17.763,11.938,20.726,17.07 C339.941,254.724,340.225,266.274,332.712,271.154z M307.648,267.085l12.224-8.856c-0.442-1.862-1.5-4.864-3.552-8.417 c-2.05-3.551-4.12-5.969-5.512-7.282l-13.836,6.182c-3.215,1.438-6.974,0.866-9.619-1.462c-5.272-4.641-11.297-8.122-17.909-10.346 c-3.341-1.124-5.719-4.095-6.083-7.602l-1.563-15.069c-1.834-0.548-4.962-1.133-9.064-1.133c-4.101,0-7.229,0.585-9.063,1.133 l-1.563,15.069c-0.364,3.507-2.742,6.479-6.084,7.603c-6.608,2.221-12.633,5.701-17.908,10.345 c-2.644,2.328-6.402,2.898-9.618,1.461l-13.836-6.182c-1.391,1.314-3.462,3.731-5.513,7.283c-2.05,3.551-3.108,6.553-3.551,8.415 l12.225,8.856c2.856,2.068,4.24,5.614,3.542,9.07c-0.691,3.422-1.042,6.936-1.042,10.442c0,3.474,0.343,6.949,1.02,10.331 c0.69,3.451-0.694,6.988-3.545,9.054l-12.2,8.839c0.442,1.862,1.5,4.863,3.551,8.415c2.051,3.553,4.122,5.971,5.513,7.285 l13.728-6.134c3.222-1.441,6.99-0.864,9.635,1.476c5.296,4.686,11.356,8.194,18.012,10.431c3.342,1.123,5.722,4.095,6.085,7.602 l1.549,14.92c1.834,0.548,4.963,1.132,9.064,1.132s7.23-0.585,9.064-1.133l1.548-14.918c0.364-3.508,2.743-6.479,6.086-7.603 c6.658-2.237,12.718-5.747,18.014-10.432c2.646-2.341,6.415-2.916,9.636-1.477l13.726,6.134c1.391-1.314,3.461-3.731,5.512-7.283 c2.051-3.553,3.109-6.556,3.552-8.418l-12.2-8.838c-2.849-2.063-4.234-5.599-3.546-9.049c0.677-3.39,1.02-6.867,1.02-10.334 c0-3.509-0.35-7.021-1.041-10.442C303.408,272.698,304.792,269.153,307.648,267.085z M284.443,286.604 c0,17.483-14.225,31.708-31.708,31.708c-17.484,0-31.709-14.225-31.709-31.708s14.225-31.708,31.709-31.708 C270.219,254.896,284.443,269.12,284.443,286.604z M266.443,286.604c0-7.559-6.149-13.708-13.708-13.708 s-13.709,6.149-13.709,13.708s6.15,13.708,13.709,13.708S266.443,294.162,266.443,286.604z M280.81,159.115l8.197-4.781 c4.293-2.504,5.744-8.015,3.24-12.309c-2.504-4.294-8.016-5.743-12.309-3.24l-31.734,18.508c-0.054,0.031-0.102,0.069-0.155,0.102 c-0.172,0.105-0.342,0.214-0.506,0.331c-0.097,0.068-0.189,0.14-0.283,0.211c-0.133,0.103-0.265,0.207-0.392,0.317 c-0.107,0.092-0.21,0.188-0.313,0.284c-0.105,0.1-0.209,0.201-0.309,0.306c-0.105,0.11-0.206,0.222-0.305,0.336 c-0.091,0.105-0.18,0.212-0.266,0.322c-0.092,0.116-0.18,0.235-0.266,0.355c-0.086,0.121-0.168,0.243-0.248,0.367 c-0.073,0.114-0.142,0.229-0.209,0.345c-0.082,0.142-0.16,0.285-0.234,0.431c-0.054,0.106-0.105,0.212-0.154,0.32 c-0.074,0.161-0.143,0.323-0.207,0.489c-0.04,0.102-0.077,0.205-0.113,0.308c-0.059,0.17-0.113,0.341-0.162,0.515 c-0.031,0.112-0.059,0.224-0.086,0.336c-0.039,0.163-0.075,0.327-0.105,0.494c-0.025,0.137-0.044,0.274-0.063,0.412 c-0.019,0.144-0.037,0.288-0.05,0.434c-0.015,0.171-0.021,0.343-0.026,0.515c-0.002,0.082-0.012,0.161-0.012,0.243 c0,0.039,0.005,0.077,0.006,0.115c0.002,0.189,0.014,0.378,0.029,0.567c0.008,0.111,0.014,0.222,0.026,0.331 c0.02,0.178,0.05,0.354,0.081,0.531c0.021,0.12,0.039,0.241,0.064,0.359c0.033,0.154,0.076,0.306,0.118,0.458 c0.038,0.139,0.073,0.278,0.118,0.415c0.042,0.128,0.092,0.254,0.14,0.381c0.058,0.155,0.116,0.311,0.183,0.462 c0.049,0.112,0.106,0.223,0.161,0.334c0.078,0.158,0.156,0.316,0.243,0.469c0.021,0.037,0.037,0.076,0.059,0.113 c0.03,0.052,0.068,0.095,0.099,0.146c0.147,0.24,0.304,0.472,0.471,0.696c0.064,0.086,0.125,0.173,0.191,0.256 c0.211,0.262,0.433,0.514,0.671,0.75c0.084,0.084,0.175,0.158,0.262,0.238c0.171,0.157,0.346,0.309,0.528,0.452 c0.11,0.086,0.22,0.169,0.334,0.25c0.195,0.139,0.397,0.269,0.603,0.393c0.089,0.053,0.174,0.111,0.264,0.16 c0.298,0.165,0.607,0.313,0.925,0.444c0.072,0.029,0.145,0.052,0.218,0.08c0.256,0.098,0.517,0.185,0.783,0.259 c0.105,0.03,0.211,0.056,0.317,0.082c0.24,0.058,0.483,0.104,0.73,0.142c0.113,0.018,0.226,0.039,0.34,0.052 c0.284,0.033,0.573,0.05,0.864,0.056c0.061,0.001,0.121,0.012,0.181,0.012c0.012,0,0.024-0.002,0.036-0.002 c62.032,0.024,112.49,50.499,112.49,112.537c0,4.971,4.029,9,9,9s9-4.029,9-9C383.273,224.259,339.34,171.993,280.81,159.115z M35.558,75.249c-0.417-4.952,3.261-9.306,8.214-9.723c1.538-0.126,3.017,0.142,4.339,0.717c7.847-34.82,39.004-60.916,76.16-60.916 c37.154,0,68.309,26.091,76.16,60.908c1.323-0.577,2.803-0.842,4.341-0.708c4.953,0.416,8.63,4.77,8.213,9.723l-1.172,13.92 c-0.396,4.696-4.33,8.245-8.958,8.245c-0.253,0-0.508-0.01-0.765-0.032c-0.33-0.028-0.653-0.076-0.971-0.137 c-2.661,14.892-9.584,28.717-20.172,39.885c-14.899,15.715-35.027,24.37-56.676,24.37c-21.657,0-42.528-9.111-57.263-24.998 c-6.392-6.892-11.436-14.775-14.993-23.434c-1.553-3.781-2.814-7.715-3.751-11.692c-0.322-1.366-0.603-2.744-0.85-4.128 c-0.315,0.061-0.635,0.108-0.962,0.135c-0.256,0.021-0.512,0.032-0.765,0.032c-4.629,0-8.563-3.55-8.958-8.246L35.558,75.249z M79.142,87.035h8.756c7.762,0,14.319-5.184,14.319-11.5s-6.557-11.5-14.319-11.5h-8.756c-7.761,0-14.318,5.184-14.318,11.5 S71.381,87.035,79.142,87.035z M180.989,103.173c-3.6,1.273-7.505,1.862-11.589,1.862h-8.757c-14.401,0-26.628-8-30.792-20h-11.16 c-4.164,12-16.391,20-30.792,20h-8.756c-4.081,0-7.984-0.587-11.582-1.859c0.346,0.989,0.709,2.09,1.105,3.056 c2.735,6.657,6.618,12.725,11.54,18.031c11.34,12.227,27.401,19.238,44.065,19.238c16.659,0,32.147-6.66,43.613-18.755 C173.792,118.515,178.218,111.089,180.989,103.173z M169.4,64.035h-8.757c-7.762,0-14.319,5.184-14.319,11.5s6.557,11.5,14.319,11.5 h8.757c7.761,0,14.318-5.184,14.318-11.5S177.161,64.035,169.4,64.035z M77.293,46.052c0.612-0.032,1.228-0.017,1.849-0.017h8.756 c14.402,0,26.63,9,30.793,21h11.158c4.163-12,16.391-21,30.793-21h8.757c0.621,0,1.237-0.015,1.849,0.017 c-5.176-6.488-11.66-11.918-19.056-15.817c-7.912,0.162-15.237,3.407-20.684,9.195c-1.771,1.883-4.161,2.833-6.556,2.833 c-2.212,0-4.428-0.811-6.166-2.445c-3.62-3.406-3.794-9.102-0.388-12.722c1.245-1.323,2.567-2.558,3.946-3.719 C104.127,23.954,87.937,32.708,77.293,46.052z M126.771,114.035h-5.001c-4.971,0-9,4.029-9,9s4.029,9,9,9h5.001c4.971,0,9-4.029,9-9 S131.742,114.035,126.771,114.035z"></path> </g></svg>
                                                </div>

                                                <div class="card-heading">
                                                    <h2>Technical Settings</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mt-3">Idle Time Preference</label>
                                            <div class="form-group radio-options mt-1">
                                                
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
                                             <label class="mt-3">2FA Authentication</label>
                                            
                                            <div class="form-group radio-options mt-1">
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
                                        <input type="submit" value="Save" class="common-save-btn" name="submit">
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                     </form>
                </div>






                <div class="common-card d-none">
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
                            <input type="submit" value="Save" class="common-save-btn" name="submit">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
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
