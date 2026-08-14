@extends('layouts.escort')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <style type="text/css">
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0)
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content end here-->

        <div class="row">
            <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1">Edit My Account</h1>
                <span class="helpNoteLink collapsed" data-toggle="collapse" data-target="#notes"
                    aria-expanded="false"><b>Help?</b></span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>Use this feature to complete all of your personal details - who you are,
                                information about 'PayID', Profiles and Tours, and how Users communicate with
                                you.
                            </li>
                            <li>
                                Make sure you take the time to complete everything, it will help you
                                manage your Account much better, especially with communication. If you
                                are not sure about any of the settings, get in touch with our
                                <a href="{{ url('contact-us') }}" class="custom_links_design">Help Centre</a>
                                or your <a href="{{ url('escort-dashboard/escort-agency-request') }}"
                                    class="custom_links_design">Agent</a> if you have appointed one.
                            </li>
                            <li>There is some general information also available to you inside each of the
                                My Account groups.
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12">
                <div id="commanAlert" class="alert d-none rounded" role="alert"></div>
            </div>
            <div class="col-md-12">
                <div class="common-card">
                    <form id="userProfile" class="common-form" action="{{ route('escort.account.update', [$escort->id]) }}"
                        method="POST">
                        @csrf
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
                                        <h2>About Me</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="inner-field-row">
                                    <div class="form-group">
                                        <label for="membership_num">Membership Number</label>
                                        <p class="input_not_edit">{{ $escort->member_id }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="membership_num form-back">Date Joined</label>
                                        <p class="input_not_edit" placeholder=" " aria-describedby="emailHelp">
                                            {{ Carbon\Carbon::parse($escort->created_at)->format('d-m-Y') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="my_name" for="my_name">
                                            My Name
                                          <div class="common-tooltip">
                                            <img class="delay_tooltip tooltip-icon"
                                                src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                            <span class="tooltip-text">
                                                You can also create <a target="_blank"
                                                    href="{{ route('escort.profile.information') }}">Stage
                                                    Names</a> to use in any Profile.
                                            </span>
                                            </div>
                                        </label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter name..." value="{{ $escort->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Gender">Gender </label>

                                        @if ($escort->gender == '')
                                            <select class="form-control" name="gender" required>
                                                <option value="">Select</option>
                                                @foreach (config('escorts.profile.genders') as $key => $gender)
                                                    <option value="{{ $key }}"
                                                        {{ $escort->gender == $key ? 'selected' : '' }}>
                                                        {{ $gender }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            @foreach (config('escorts.profile.genders') as $key => $gender)
                                                @if ($escort->gender == $key)
                                                    <p class="input_not_edit">{{ $gender }}</p>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile" class="common_help_icon">Mobile
                                           <div class="common-tooltip">
                                            <img class="delay_tooltip tooltip-icon"
                                                src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                            <span class="tooltip-text">This is the number which will be
                                                displayed in your Profiles.</span>
                                           </div>
                                        </label>
                                        <p class="input_not_edit">{{ $escort->phone }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="my-agent" for="home_state">Home State
                                           <div class="common-tooltip">
                                            <img class="delay_tooltip tooltip-icon"
                                                src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                            <span class="tooltip-text">This is the State you reside in. If
                                                you created your Account while you were in another State,
                                                log a <a target='_blank'
                                                    href='{{ url('escort-dashboard/submitticket') }}'>Support
                                                    Ticket</a> and we will correct your setting.</span>
                                           </div>
                                        </label>
                                        <p class="input_not_edit" placeholder="Western Australia"
                                            aria-describedby="emailHelp" id="stateNew" name="state_id"
                                            value="{{ $escort->state_id }}">
                                            {{ $escort->state_id ? config('escorts.profile.states')[$escort->state_id]['stateName'] : '' }}
                                        </p>
                                        <span id="state-errors"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="JaneDoe@domain.com.au" aria-describedby="emailHelp"
                                            value="{{ $escort->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="my-agent" for="my_agent">                                           
                                            My Agent
                                            <div class="common-tooltip">
                                                <img class="delay_tooltip tooltip-icon"
                                                    src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                                <span class="tooltip-text">You can appoint an Agent to
                                                    assist you by completing the Agency Request form. If you
                                                    want to appoint an Agent, <a
                                                        href='{{ url('escort-dashboard/escort-agency-request') }}'>click
                                                        here.</a></span></div>
                                        </label>
                                        
                                        <p class="input_not_edit">

                                            @if (auth()->user()->my_agent)
                                                {{ !empty(auth()->user()->my_agent->business_name) ? auth()->user()->my_agent->business_name : !empty(auth()->user()->my_agent->name) }}
                                            @else
                                                <a href="{{ url('/escort-dashboard/escort-agency-request') }}"
                                                    class="request-active"> Request one</a>
                                            @endif


                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="PayID Name" class="common_help_icon">PayID Name
                                           <div class="common-tooltip">
                                            <img class="delay_tooltip tooltip-icon"
                                                src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                            <span class="tooltip-text">Complete this information if you use
                                                PayID with your clients.</span>
                                           </div>

                                        </label>
                                        <input type="text" class="form-control" name="PayID_Name"
                                            placeholder="Insert your Bank Account name" aria-describedby="Help"
                                            value="{{ $escort->pay_id_name ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="PayID Number">PayID Number</label>
                                        <input type="text" class="form-control" name="PayID_NO"
                                            placeholder="Insert your PayID Number" aria-describedby="Help"
                                            value="{{ formatAccountNumber($escort->pay_id_no, 'bsb') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row inner-row">
                            <div class="col-lg-6">
                                <div class="card-top">
                                    <div class="card-icon">
                                        <svg version="1.1" id="designs" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px"
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
                                        <h2>Method of contact</h2>
                                    </div>
                                </div>
                                <div class="inner-field-row">

                                    <div class="form-group">
                                        <div class="radio-options">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="contact_type[]"
                                                    id="Method_Message" value="1"
                                                    @if (!empty($escort->contact_type)) {{ in_array(1, $escort->contact_type) ? 'checked' : null }} @endif>
                                                <label class="form-check-label" for="Method_Message">Message
                                                    (via Console)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" checked
                                                    name="contact_type[]" id="Method_Text" value="2"
                                                    @if (!empty($escort->contact_type)) {{ in_array(2, $escort->contact_type) ? 'checked' : null }} @endif>
                                                <label class="form-check-label" for="Method_Text">Text</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="contact_type[]"
                                                    id="Method_Email" value="3"
                                                    @if (!empty($escort->contact_type)) {{ in_array(3, $escort->contact_type) ? 'checked' : null }} @endif>
                                                <label class="form-check-label" for="Method_Email">Email</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="contact_type[]"
                                                    id="Method_call_me" value="4"
                                                    @if (!empty($escort->contact_type)) {{ in_array(4, $escort->contact_type) ? 'checked' : null }} @endif>
                                                <label class="form-check-label" for="Method_call_me">Call
                                                    me</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card-top">
                                    <div class="card-icon">
                                        <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M23 5.5C23 7.98528 20.9853 10 18.5 10C17.0993 10 15.8481 9.36007 15.0228 8.35663L9.87308 10.9315C9.95603 11.2731 10 11.63 10 11.9971C10 12.3661 9.9556 12.7247 9.87184 13.0678L15.0228 15.6433C15.8482 14.6399 17.0993 14 18.5 14C20.9853 14 23 16.0147 23 18.5C23 20.9853 20.9853 23 18.5 23C16.0147 23 14 20.9853 14 18.5C14 18.1319 14.0442 17.7742 14.1276 17.4318L8.97554 14.8558C8.1502 15.8581 6.89973 16.4971 5.5 16.4971C3.01472 16.4971 1 14.4824 1 11.9971C1 9.51185 3.01472 7.49713 5.5 7.49713C6.90161 7.49713 8.15356 8.13793 8.97886 9.14254L14.1275 6.5682C14.0442 6.2258 14 5.86806 14 5.5C14 3.01472 16.0147 1 18.5 1C20.9853 1 23 3.01472 23 5.5ZM16.0029 5.5C16.0029 6.87913 17.1209 7.99713 18.5 7.99713C19.8791 7.99713 20.9971 6.87913 20.9971 5.5C20.9971 4.12087 19.8791 3.00287 18.5 3.00287C17.1209 3.00287 16.0029 4.12087 16.0029 5.5ZM16.0029 18.5C16.0029 19.8791 17.1209 20.9971 18.5 20.9971C19.8791 20.9971 20.9971 19.8791 20.9971 18.5C20.9971 17.1209 19.8791 16.0029 18.5 16.0029C17.1209 16.0029 16.0029 17.1209 16.0029 18.5ZM5.5 14.4943C4.12087 14.4943 3.00287 13.3763 3.00287 11.9971C3.00287 10.618 4.12087 9.5 5.5 9.5C6.87913 9.5 7.99713 10.618 7.99713 11.9971C7.99713 13.3763 6.87913 14.4943 5.5 14.4943Z"
                                                    fill="#ff3c5f"></path>
                                            </g>
                                        </svg>
                                    </div>

                                    <div class="card-heading">
                                        <h2>Social Media Consent</h2>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label for="">Do you consent, pursuant to clause 13.2
                                            and 13.3 of the Terms and Conditions, to being promoted on
                                            any or all of E4U’s social media platforms?</label>
                                    </div>
                                    <div class="radio-options">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="social_media_consent"
                                                id="yes" value="1"
                                                {{ isset($escort->social_media_consent) && $escort->social_media_consent == '1' ? 'checked' : '' }}>

                                            <label class="form-check-label" for="yes">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="social_media_consent"
                                                id="no" value="0"
                                                {{ isset($escort->social_media_consent) && $escort->social_media_consent == '0' ? 'checked' : '' }}>

                                            <label class="form-check-label" for="no">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="common-footer">
                            <input type="submit" value="Save" class="common-save-btn" name="submit">
                        </div>
                    </form>
                    <!-- Additional Information -->
                    <div class="row">
                        <div class="col-lg-12 p-0">
                            <div class="additional-info">

                                <button type="button" class="additional-info-header" onclick="toggleAvatarInfo(this)">

                                    <div class="additional-info-left">

                                        <div class="additional-info-icon">
                                            <svg width="20px" height="20px" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg" fill="none">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path fill="#ff3c5f" fill-rule="evenodd"
                                                        d="M10 3a7 7 0 100 14 7 7 0 000-14zm-9 7a9 9 0 1118 0 9 9 0 01-18 0zm8-4a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zm.01 8a1 1 0 102 0V9a1 1 0 10-2 0v5z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </div>

                                        <div>
                                            <h3>Important information</h3>
                                            <p>Click to view more details and guidelines</p>
                                        </div>

                                    </div>
                                    <svg fill="#000000" width="14px" height="14px" viewBox="0 0 32 32"
                                        id="avatar-info-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M0.256 8.606c0-0.269 0.106-0.544 0.313-0.75 0.412-0.412 1.087-0.412 1.5 0l14.119 14.119 13.913-13.912c0.413-0.412 1.087-0.412 1.5 0s0.413 1.088 0 1.5l-14.663 14.669c-0.413 0.413-1.088 0.413-1.5 0l-14.869-14.869c-0.213-0.213-0.313-0.481-0.313-0.756z">
                                            </path>
                                        </g>
                                    </svg>


                                </button>


                                <div id="avatar-info-content" class="additional-info-content">
                                    <h5 class="d_sub_heading">General information</h5>
                                    <ol class="pl-3">
                                        <li>The information set out on this page is mandatory.</li>
                                        <li>
                                            When you create a Profile
                                            <ul class="list-new">
                                                <li class="d-flex">your name will appear in the Profile by
                                                    default. You can change your name in the Profile to a Stage
                                                    Name at anytime by selecting it from the drop down menu in
                                                    the Profile creator, or by editing a saved Profile from your
                                                    Archive Folder.</li>
                                                <li class="d-flex">it will always default to your Home State
                                                    unless you change the Location while creating the Profile by
                                                    selecting the Location you want the Profile to appear in
                                                    from the drop down menu in the Profile creator.</li>
                                            </ul>
                                        </li>
                                        <li>If you select ‘Message’ as your preferred method of contact with us,
                                            you will receive a text message from us advising that you have a
                                            Message waiting for you. Log on to retrieve the message.</li>
                                        <li>If you have any queries regarding your appointed Agent, contact the
                                            Escorts4U help centre by raising a Support Ticket. Please include
                                            the Agent ID number. </li>
                                    </ol>
                                    <h5 class="d_sub_heading">Home State</h5>
                                    <p>If you want to change your Home State, contact the Escorts4U help centre
                                        by raising a <a href="{{ url('submit_ticket') }}" style="font-size: 16px;"><span
                                                class="custom_links_design">Support
                                                Ticket.</span></a> You can not change your Home State, only
                                        Escorts4U support staff can change your Home State. You will have to
                                        provide proof that you have relocated to a new Home State.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-4">
                <div class="common-card">

                    <form class="common-form" id="profile_tour_options"
                        action="{{ route('escort.account.profile.tour.update', [$escort->id]) }}" method="POST">
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
                                        <h2>Profile and Tour options</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="inner-field-row">
                                    <div class="form-group option-list mt-0">
                                        <label for="email">Profile creator settings</label>
                                        <div class="form-check form-check-inline">
                                            <input name="profile_creator[]" class="form-check-input" type="checkbox"
                                                id="Stage_Name" value="1"
                                                @if (!empty($escort->profile_creator)) {{ in_array(1, $escort->profile_creator) ? 'checked' : null }} @endif>
                                            <label class="form-check-label" for="Stage_Name">Include Profile
                                                Information (Stage Name optional)</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="profile_creator[]" class="form-check-input" type="checkbox"
                                                id="Profile_Info" value="2"
                                                @if (!empty($escort->profile_creator)) {{ in_array(2, $escort->profile_creator) ? 'checked' : null }} @endif>
                                            <label class="form-check-label" for="Profile_Info">Include Profile
                                                Information and allow to over ride</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="profile_creator[]" class="form-check-input" type="checkbox"
                                                id="Social_Media" value="3"
                                                @if (!empty($escort->profile_creator)) {{ in_array(3, $escort->profile_creator) ? 'checked' : null }} @endif>
                                            <label class="form-check-label" for="Social_Media">Include social
                                                media information</label>
                                        </div>
                                    </div>
                                    <div class="form-group option-list mt-0">
                                        <label for="email">How can Viewers contact me</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="viewer_contact_type[]"
                                                id="Method_Call" value="1"
                                                @if (!empty($escort->viewer_contact_type)) {{ in_array(1, $escort->viewer_contact_type) ? 'checked' : null }} @endif>
                                            <label class="form-check-label" for="Method_Call">Call me</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="viewer_contact_type[]" type="checkbox"
                                                id="Method_Email_Me" value="3"
                                                @if (!empty($escort->viewer_contact_type)) {{ in_array(3, $escort->viewer_contact_type) ? 'checked' : null }} @endif>
                                            <label class="form-check-label" for="Method_Email_Me">Email me (only
                                                for private communications with a Viewer)</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="viewer_contact_type[]" type="checkbox"
                                                id="Method_Text_Me" value="2"
                                                @if (!empty($escort->viewer_contact_type)) {{ in_array(2, $escort->viewer_contact_type) ? 'checked' : null }} @endif>
                                            <label class="form-check-label" for="Method_Text_Me">Text me</label>
                                        </div>
                                    </div>
                                    <div class="form-group option-list mt-0">
                                        <label for="email">Tour options</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="tour_permissition_type[]"
                                                type="checkbox" id="Create_Tours" value="1"
                                                @if (!empty($escort->tour_permissition_type)) {{ in_array(1, $escort->tour_permissition_type) ? 'checked' : null }} @endif>
                                            <label class="form-check-label" for="Create_Tours">Allow Tours to be
                                                created</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="tour_permissition_type[]"
                                                type="checkbox" id="Edit_Tour" value="2"
                                                @if (!empty($escort->tour_permissition_type)) {{ in_array(2, $escort->tour_permissition_type) ? 'checked' : null }} @endif>
                                            <label class="form-check-label" for="Edit_Tour">Allow Tours to be
                                                edited</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="tour_permissition_type[]"
                                                type="checkbox" id="Tour_Date" value="3"
                                                @if (!empty($escort->tour_permissition_type)) {{ in_array(3, $escort->tour_permissition_type) ? 'checked' : null }} @endif>
                                            <label class="form-check-label" for="Tour_Date">Post a Tour leg one
                                                day before the arrival date</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="common-footer">
                            <input type="submit" value="Save" class="common-save-btn" name="submit">
                        </div>
                    </form>
                    <!-- Additional Information -->
                    <div class="row">
                        <div class="col-lg-12 p-0">
                            <div class="additional-info">
                                <button type="button" class="additional-info-header" onclick="toggleAvatarInfo(this)">

                                    <div class="additional-info-left">

                                        <div class="additional-info-icon">
                                            <svg width="20px" height="20px" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg" fill="none">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path fill="#ff3c5f" fill-rule="evenodd"
                                                        d="M10 3a7 7 0 100 14 7 7 0 000-14zm-9 7a9 9 0 1118 0 9 9 0 01-18 0zm8-4a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zm.01 8a1 1 0 102 0V9a1 1 0 10-2 0v5z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </div>

                                        <div>
                                            <h3>General information</h3>
                                            <p>Click to view more details and guidelines</p>
                                        </div>

                                    </div>
                                    <svg fill="#000000" width="14px" height="14px" viewBox="0 0 32 32"
                                        id="avatar-info-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M0.256 8.606c0-0.269 0.106-0.544 0.313-0.75 0.412-0.412 1.087-0.412 1.5 0l14.119 14.119 13.913-13.912c0.413-0.412 1.087-0.412 1.5 0s0.413 1.088 0 1.5l-14.663 14.669c-0.413 0.413-1.088 0.413-1.5 0l-14.869-14.869c-0.213-0.213-0.313-0.481-0.313-0.756z">
                                            </path>
                                        </g>
                                    </svg>


                                </button>
                                <div id="avatar-info-content" class="additional-info-content">
                                    <ol class="pl-3">
                                        <li>By selecting a contact option, the option will appear in your Profile.</li>
                                        <li>If you disable ‘Allow Tours to be edited’ you will not be able to edit a Tour
                                            should the need arise.</li>
                                        <li>If you enable ‘Post a Tour leg ...’ you will be charged for that day.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript">
   $('#userProfile').parsley({
   
   });
      function toggleAvatarInfo(button) {
         const currentBox = button.closest('.additional-info');

         if (!currentBox) return;

         // Pehle sab open sections close karo
         document.querySelectorAll('.additional-info.open').forEach(box => {
            if (box !== currentBox) {
                  box.classList.remove('open');
            }
         });

         // Current section ko toggle karo
         currentBox.classList.toggle('open');
      }
       $('#userProfile').on('submit', function(e) {
           e.preventDefault();
           var form = $(this);
           $("#modal-title").text('About Me');
   
           if (form.parsley().isValid()) {
               var url = form.attr('action');
               var data = new FormData(form[0]);
   
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
                   if (!data.error) {
                     showAlert('success', 'Success',"Your details have been updated successfully.");
                   } else {
                     showAlert('error', 'Error', "Oops... something went wrong. Please try again.");
                   }
               }
               });
           }
       });
   
       $('#profile_tour_options').on('submit', function(e) {
           e.preventDefault();
           var form = $(this);
           var url = form.attr('action');
           var data = new FormData(form[0]);
           $("#modal-title").text('Profile and Tour options');
   
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
               if (!data.error) {
                   showAlert('success', 'Success', "The profile and tour options have been updated successfully.");
               } else {
                   showAlert('error', 'Error', "Oops... something went wrong. Please try again.");
               }
               }
           });
       });
   
   $("#close").click(function()
     {
         $("#my_account_modal").hide();
         location.reload();
     });
   $('#city').select2({
     allowClear: true,
     placeholder :'Select City',
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
     placeholder :'Select State',
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
     if($(this).val()) {
       $('#state').prop('disabled', false);
       $('#state').select2('open');
     } else {
       $('#state').prop('disabled', true);
     }
   });
   
   $('#state').on('change', function(e) {
     if($(this).val()) {
       $('#city').prop('disabled', false);
       $('#city').select2('open');
     } else {
       $('#city').prop('disabled', true);
     }
   });
   
   
</script>
@endpush
