@extends('layouts.center')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    <style>
        .swal-button {
            background-color: #242a2c;
        }

        .toggle-password {
            position: absolute;
            top: 40px;
            right: 22px;
            cursor: pointer;
            z-index: 2;
            color: #6c757d;
        }

        .brb_icon {
            color: white;
            background-color: #e5365a;
            border-radius: 10px;
            padding: 0px 8px;
        }

        .blink {
            animation: blink-animation 1s infinite;
        }

        @keyframes blink-animation {
            50% {
                opacity: 0;
            }
        }
    </style>
@stop
@section('content')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                <!--middle content start here-->
                <div class="row">
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">Our Account</h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                            aria-expanded="true"><b>Help?</b></span>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="card collapse" id="notes" style="">
                            <div class="card-body">
                               <h3 class="NotesHeader"><b>Notes:</b></h3>
                                <ol>
                                    <li>Your Advertiser Profile Information will pre-populate any Massage Profile you
                                        create,
                                        including for any other Centres (<b>Associated Centre</b>) you have established. As
                                        you
                                        create your Profiles, you can edit them to reflect more accurately the information
                                        about
                                        the Associated Centre you are creating the Profile for, including the Masseurs who
                                        will
                                        be working at the Associated Centre.</li>
                                    <li>Always note that you can not have a Masseur attached to more than one Profile
                                        representing different Associated Centres at the same time.</li>
                                    <li>Select your preferred method of contact by a Viewer for all of your Massage
                                        Profiles.</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="common-card">
                            <form id="userProfile" class="common-form"
                                action="{{ route('center.account.update', [$escort->id]) }}" method="POST">
                                @csrf
                                <div class="row inner-row">
                                    <div class="col-lg-12">
                                        <div class="card-top">
                                            <div class="card-icon">
                                                <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">

                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                    </g>

                                                    <g id="SVGRepo_iconCarrier">

                                                        <path
                                                            d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                                            stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                        </path>

                                                        <path
                                                            d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                                                            stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                        </path>

                                                    </g>

                                                </svg>
                                            </div>

                                            <div class="card-heading">
                                                <h2>About Us</h2>
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

                                                <p class="input_not_edit" aria-describedby="emailHelp">
                                                    {{ Carbon\Carbon::parse($escort->created_at)->format('d-m-Y') }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="Display Name" class="common_help_icon">Display Name
                                                    <div class="common-tooltip">
                                                        <img class="delay_tooltip tooltip-icon"
                                                            src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                                        <span class="tooltip-text">Insert here the trading /
                                                            business name of the Business.</span>
                                                    </div>
                                                </label>
                                                <input type="text" class="form-control" placeholder=" " name="name"
                                                    aria-describedby="emailHelp" value="{{ $escort->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="Entity Name" class="common_help_icon">Entity Name
                                                    <div class="common-tooltip">
                                                        <img class="delay_tooltip tooltip-icon"
                                                            src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                                        <span class="tooltip-text">What is the name of the
                                                            corporate entity that owns the Business Name, like
                                                            ABC Pty Ltd</span>
                                                    </div>
                                                </label>
                                                <input type="text" class="form-control" placeholder=" "
                                                    name="entity_name" aria-describedby="emailHelp"
                                                    value="{{ $escort->entity_name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="my-agent">Our Address </label>
                                                <input type="text" name="business_address" class="form-control"
                                                    placeholder=" " name="" aria-describedby="emailHelp"
                                                    value=" {{ $escort->business_address }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control form-back" placeholder=" "
                                                    name="email" aria-describedby="emailHelp"
                                                    value="{{ $escort->email }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="Business No.">Business No.</label>
                                                <input type="text" class="form-control form-back" placeholder=" "
                                                    name="business number" maxlength="14"
                                                    onkeyup="this.value = this.value.replace(/[^0-9 ]/g, '').replace(/\s+/g, ' ')"
                                                    aria-describedby="emailHelp" value="{{ $escort->business_number }}">


                                            </div>
                                            <div class="form-group">
                                                <label for="email">Mobile No.</label>
                                                <input type="text" class="form-control form-back" placeholder=" "
                                                    name="phone" maxlength="14"
                                                    onkeyup="this.value = this.value.replace(/[^0-9 ]/g, '').replace(/\s+/g, ' ')"
                                                    aria-describedby="emailHelp" value="{{ $escort->phone }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="Gender" class="my-agent common_help_icon    ">Home
                                                    State
                                                    <div class="common-tooltip">
                                                        <img class="delay_tooltip tooltip-icon"
                                                            src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                                        <span class="tooltip-text">This is the State you reside
                                                            in. If you created your Account while you were in
                                                            another State, log a <a
                                                                href="{{ url('submit_ticket') }}">Support
                                                                Ticket</a> and we will correct your
                                                            setting.</span>
                                                    </div>
                                                </label>
                                                <p class="input_not_edit" placeholder=" " aria-describedby="emailHelp"
                                                    id="stateNew" name="state_id" value="{{ $escort->state_id }}">
                                                    {{ $escort->state_id ? config('escorts.profile.states')[$escort->state_id]['stateName'] : '' }}
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="my-agent">City (Subrub).</label>
                                                <input type="text" class="form-control" placeholder=" "
                                                    name="subrub_city" aria-describedby="emailHelp"
                                                    value=" {{ $escort->subrub_city ? $escort->subrub_city : '' }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Our Agent</label>
                                                <label type="text" class="input_not_edit" placeholder=" "
                                                    name="phone" aria-describedby="emailHelp"
                                                    value="{{ $escort->my_agent ? $escort->my_agent->member_id : 'NA' }}">


                                                    @if (auth()->user()->my_agent)
                                                        {{ !empty(auth()->user()->my_agent->business_name) ? auth()->user()->my_agent->business_name : !empty(auth()->user()->my_agent->name) }}
                                                    @else
                                                        <a class="request_one"
                                                            href="{{ url('/center-dashboard/agent-request') }}">
                                                            Request one</a>
                                                    @endif

                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label for="PayID Name" class="common_help_icon">PayID Name
                                                    <div class="common-tooltip">
                                                        <img class="delay_tooltip tooltip-icon"
                                                            src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                                        <span class="tooltip-text">Complete this information if
                                                            you use PayID with your clients.</span>
                                                    </div>
                                                </label>
                                                <input type="text" class="form-control" name="payID_name"
                                                    value="{{ $escort->pay_id_name ?? '' }}"
                                                    placeholder="Insert your Bank Account name">
                                            </div>
                                            <div class="form-group">
                                                <label for="PayID Number">PayID Number</label>
                                                <input type="text" class="form-control" name="paID_no"
                                                    placeholder="Insert your PayID Number"
                                                    value="{{ formatAccountNumber($escort->pay_id_no, 'bsb') }}">
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <div class="row inner-row">
                                    <div class="col-md-6">
                                        <div class="card-top">
                                            <div class="card-icon">
                                                <svg version="1.1" id="designs" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="64px"
                                                    height="64px" viewBox="0 0 32 32" xml:space="preserve"
                                                    fill="#000000">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round">
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
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="contact_type[]"
                                                        id="Method_Message" value="1"
                                                        @if (!empty($escort->contact_type)) {{ in_array(1, $escort->contact_type) ? 'checked' : null }} @endif>
                                                    <label class="form-check-label" for="Method_Message">Message (via
                                                        Console)</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" checked type="checkbox"
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
                                                    <label class="form-check-label" for="Method_call_me">Call me</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Social Media Consent --}}

                                    <div class="col-md-6">
                                        <div class="card-top">
                                            <div class="card-icon">
                                                <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round">
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

                                        <div class="inner-field-row">
                                            <div class="form-group">
                                                <label for="">Do you consent, pursuant to clause 13.2 and 13.3 of
                                                    the Terms and Conditions, to being promoted on any or all of E4U’s
                                                    social media platforms?</label>
                                                <div class="radio-options">

                                                    <div class="form-check form-check-inline ml-0">
                                                        <input class="form-check-input" type="radio"
                                                            name="social_media_consent" id="yes" value="1"
                                                            {{ isset($escort->social_media_consent) && $escort->social_media_consent == '1' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="yes">Yes</label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="social_media_consent" id="no" value="0"
                                                            {{ isset($escort->social_media_consent) && $escort->social_media_consent == '0' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end --}}
                                </div>
                                <div class="common-footer">
                                    <input type="submit" value="Save" class="common-save-btn" name="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12 my-4">
                        <div class="common-card">
                            <form class="common-form" id="profile_tour_options"
                                action="{{ route('center.account.profile.contact.update', [$escort->id]) }}"
                                method="POST">
                                <div class="row inner-row">
                                    <div class="col-lg-12">
                                        <div class="card-top">

                                            <div class="card-icon">
                                                <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">

                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                    </g>

                                                    <g id="SVGRepo_iconCarrier">

                                                        <path
                                                            d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                                            stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                        </path>

                                                        <path
                                                            d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                                                            stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                        </path>

                                                    </g>

                                                </svg>
                                            </div>

                                            <div class="card-heading">
                                                <h2>Profile contact options</h2>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="inner-field-row">
                                            <div class="form-group">
                                                <div class="option-list">
                                                    <label for="email">Profile creator settings</label>
                                                    <div class="form-check form-check-inline">
                                                        <input name="profile_creator[]" class="form-check-input"
                                                            type="checkbox" id="profile_Info" value="1"
                                                            @if (!empty($escort->profile_creator)) {{ in_array(1, $escort->profile_creator) ? 'checked' : null }} @endif>
                                                        <label class="form-check-label" for="profile_Info">Include
                                                            Profile Information</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input name="profile_creator[]" class="form-check-input"
                                                            type="checkbox" id="Peofile_Over" value="2"
                                                            @if (!empty($escort->profile_creator)) {{ in_array(2, $escort->profile_creator) ? 'checked' : null }} @endif>
                                                        <label class="form-check-label" for="Peofile_Over">Include
                                                            Profile Information and allow to over ride</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input name="profile_creator[]" class="form-check-input"
                                                            type="checkbox" id="Social_Media" value="3"
                                                            @if (!empty($escort->profile_creator)) {{ in_array(3, $escort->profile_creator) ? 'checked' : null }} @endif>
                                                        <label class="form-check-label" for="Social_Media">Include
                                                            social media information</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="option-list">
                                                    <label for="email">How can Viewers contact us</label>
                                                    <div class="form-check form-check-inline">
                                                        <input name="viewer_contact_type[]" class="form-check-input"
                                                            type="checkbox" id="Call_Us" value="1"
                                                            @if (!empty($escort->viewer_contact_type)) {{ in_array(1, $escort->viewer_contact_type) ? 'checked' : null }} @endif>
                                                        <label class="form-check-label" for="Call_Us">Call
                                                            us</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" name="viewer_contact_type[]"
                                                            type="checkbox" id="Email_Us" value="3"
                                                            @if (!empty($escort->viewer_contact_type)) {{ in_array(3, $escort->viewer_contact_type) ? 'checked' : null }} @endif>
                                                        <label class="form-check-label" for="Email_Us">Email us
                                                            (only for private communications with a Viewer)</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input name="viewer_contact_type[]" class="form-check-input"
                                                            type="checkbox" id="Text_Us" value="2"
                                                            @if (!empty($escort->viewer_contact_type)) {{ in_array(2, $escort->viewer_contact_type) ? 'checked' : null }} @endif>
                                                        <label class="form-check-label" for="Text_Us">Text
                                                            us</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="common-footer">
                                    <input type="submit" value="Save" class="common-save-btn" name="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Additional Information -->
                    <div class="col-lg-12">
                        <div class="additional-info">
                            <button type="button" class="additional-info-header" onclick="toggleAvatarInfo(this)">

                                <div class="additional-info-left">

                                    <div class="additional-info-icon">
                                        <svg width="20px" height="20px" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg" fill="none">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill="#ff3c5f" fill-rule="evenodd"
                                                    d="M10 3a7 7 0 100 14 7 7 0 000-14zm-9 7a9 9 0 1118 0 9 9 0 01-18 0zm8-4a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zm.01 8a1 1 0 102 0V9a1 1 0 10-2 0v5z">
                                                </path>
                                            </g>
                                        </svg>
                                    </div>

                                    <div>
                                        <h3>Other Center</h3>
                                        <p>Click to view more details</p>
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

                                @if (!is_parent_massage_user_switch())
                                <div class="{{ canManageClass()}}">

                                
                                    <h4 class="inn_help_icon" style="font-size: 16px">Other Centres <span data-toggle="collapse"
                                            data-target="#in_notes" aria-expanded="true"><b>Help?</b></span></h4>

                                    <div class="card collapse p-0" id="in_notes" style="">
                                        <div class="card-body border-0 mt-0">
                                           <h3 class="NotesHeader"><b>Notes:</b></h3>
                                            <ol>
                                                <li>Add your associated Centres in your corporate group (<b>Associated
                                                        Centre</b>) here. The Centre listed under Our Account is the
                                                    primary
                                                    Member
                                                    and account holder.</li>
                                                <li>Your Associated Centres are managed from this Account, however, you
                                                    can grant login access to the Account for an Associated Centre by
                                                    enabling that feature.</li>
                                                <li>Associated Centres that have been granted access to the Account,
                                                    will only see information pertaining to that Centre. That is,
                                                    Profiles and
                                                    Masseurs attached to the Profile. The Associated Centre can not
                                                    create, edit or List a Centre Profile.</li>
                                            </ol>
                                        </div>



                                    </div>
                                    <div class="d-flex justify-content-end my-3">
                                        <button type="button" class="btn-common" data-toggle="modal"
                                            data-backdrop="static" data-keyboard="false" id="open_add_center">Add
                                            Centre</button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table mb-3 w-100" id="other_centre_table">
                                            <thead class="table-bg">
                                                <tr>
                                                    <th style="width: 75px;">Member ID</th>
                                                    <th>Display Name</th>
                                                    <th>Entity Name</th>
                                                    <th>Address</th>
                                                    <th>Business No.</th>
                                                    <th>Mobile No.</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-content">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif
                            </div>
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



    {{-- Modal: Add Centre --}}
    <div class="modal fade upload-modal" id="add_center" tabindex="-1" aria-labelledby="add_centerLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scorllable">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <img src="{{ asset('assets/dashboard/img/add-center.png') }}"
                            class="custompopicon" alt=" Add Centre"> Add Centre</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>

                <div class="modal-body">

                    <form name="add_center_frm" id="add_center_frm" method="POST" enctype="multipart/form-data"
                        autocomplete="">
                        <div class="row">
                            <!-- Membership ID -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Membership ID</label>
                                    <input type="text" name="member_id" id="member_id" class="form-control"
                                        placeholder="Auto-generated when saved" readonly>
                                </div>
                            </div>

                            <!-- Access Granted -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Access Granted</label>
                                    <div class="mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="accessGranted"
                                                id="accessYes" value="yes">
                                            <label class="form-check-label" for="accessYes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="accessGranted"
                                                id="accessNo" value="no" checked>
                                            <label class="form-check-label" for="accessNo">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Subtle line -->
                        <hr class="my-3" style="border-top: 1px solid #e0e0e0;">

                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Date Joined -->
                                <div class="form-group">
                                    <label>Date Joined</label>
                                    <input type="text" name="join_date" id="join_date" placeholder="mm/dd/ayyyy"
                                        class="form-control" placeholder="DD-MM-YYYY" autocomplete="off"
                                        value="<?php echo date('d-m-Y'); ?>" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- Display Name -->
                                <div class="form-group">
                                    <label for="Display Name" class="common_help_icon common-tooltip">Display Name
                                        <img class="delay_tooltip tooltip-icon"
                                            src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                        <span class="tooltip-text">Insert here the trading /
                                            business name of the Business.</span>

                                    </label>

                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter display name...">
                                    <span class="text-danger error-name"></span>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Entity Name -->
                                <div class="form-group">
                                    <label for="Entity Name" class="common_help_icon common-tooltip">Entity Name
                                        <img class="delay_tooltip tooltip-icon"
                                            src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}">
                                        <span class="tooltip-text">What is the name of the
                                            corporate entity that owns the Business Name, like
                                            ABC Pty Ltd</span>

                                    </label>
                                    <input type="text" class="form-control" name="entity_name" id="entity_name"
                                        placeholder="Enter entity name...">
                                    <span class="text-danger error-entity_name"></span>

                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" id="email"
                                        placeholder="Enter email address...">
                                    <span class="text-danger error-email"></span>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" rows="1" name="business_address" id="business_address"
                                        placeholder="Enter address..."></textarea>
                                    <span class="text-danger error-business_address"></span>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Business No. -->
                                <div class="form-group">
                                    <label>Business No.</label>
                                    <input type="text" class="form-control" name="business_number"
                                        id="business_number" placeholder="Enter business number...">
                                    <span class="text-danger error-business_number"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- Mobile No. -->
                                <div class="form-group">
                                    <label>Mobile No.</label>
                                    <input type="tel" class="form-control" name="phone" id="phone"
                                        placeholder="Enter mobile number...">
                                    <span class="text-danger error-phone"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Business No. -->
                                <div class="form-group">
                                    <label>Point of Contact</label>
                                    <input type="text" class="form-control" name="contact_person" id="contact_person"
                                        placeholder="Enter point of contact...">
                                    <span class="text-danger error-contact_person"></span>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Method of contact:</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" checked type="checkbox" name="contact_type[]"
                                            id="methodMessage" value="1">
                                        <label class="form-check-label" for="methodMessage">Message (via Console)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="contact_type[]"
                                            id="methodText" value="2">
                                        <label class="form-check-label" for="methodText">Text</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="contact_type[]"
                                            id="methodEmail" value="3">
                                        <label class="form-check-label" for="methodEmail">Email</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="contact_type[]"
                                            id="Method_callme" value="4">
                                        <label class="form-check-label" for="Method_callme">Call me</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Business No. -->
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" id="password" autocomplete="off"
                                        class="form-control" placeholder="Enter Password">
                                    <span class="toggle-password" toggle="#password"><i class="fa fa-eye"></i></span>
                                    <div class="password-strength mt-2 d-none" id="password-strength-wrapper">
                                        <div class="progress" style="height:6px;">
                                            <div id="password-strength-bar" class="progress-bar" role="progressbar"
                                                style="width:0%">
                                            </div>
                                        </div>

                                        <small id="password-strength-text" class="mt-1 d-block text-muted">
                                            Password strength
                                        </small>
                                    </div>
                                    <span class="text-danger error-password"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- Mobile No. -->
                                <div class="form-group">
                                    <label>Confirm Password </label>
                                    <input type="password" autocomplete="off" name="confirm_password"
                                        id="confirm_password" class="form-control" placeholder="Re-type password">
                                    <span class="toggle-password" toggle="#confirm_password"><i
                                            class="fa fa-eye"></i></span>
                                    <span class="text-danger error-confirm_password"></span>
                                </div>
                            </div>
                        </div>





                        <div class="row">
                            <div class="col-lg-12 d-flex justify-content-end">
                                <!-- Submit -->
                                <button type="submit" id="submit_button" class="btn-success-modal">Save</button>
                            </div>
                        </div>

                        <input type="hidden" name="center_id" id="center_id">
                    </form>

                </div>

            </div>

        </div>
    </div>
    {{-- end  --}}


    {{-- Modal: View Centre --}}
    <!-- View Center Modal -->
    <div class="modal fade upload-modal" id="view_center" tabindex="-1" aria-labelledby="view_centerLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/add-center.png') }}" class="custompopicon"
                            alt="View Centre">
                        Associated Centre Summary
                    </h5>

                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>

                <div class="modal-body" style="max-height: 50vh; overflow-y: auto;">
                    <table class="table table-bordered">
                        <tbody>

                            <tr>
                                <th width="30%">Membership ID</th>
                                <td id="v_member_id"></td>
                            </tr>

                            <tr>
                                <th>Access Granted</th>
                                <td id="v_access_granted"></td>
                            </tr>

                            <tr>
                                <th>Date Joined</th>
                                <td id="v_join_date"></td>
                            </tr>

                            <tr>
                                <th>Display Name</th>
                                <td id="v_name"></td>
                            </tr>

                            <tr>
                                <th>Entity Name</th>
                                <td id="v_entity_name"></td>
                            </tr>

                            <tr>
                                <th>Address</th>
                                <td id="v_business_address"></td>
                            </tr>

                            <tr>
                                <th>Point of Contact</th>
                                <td id="v_contact_person"></td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td id="v_email"></td>
                            </tr>

                            <tr>
                                <th>Business No.</th>
                                <td id="v_business_number"></td>
                            </tr>

                            <tr>
                                <th>Mobile No.</th>
                                <td id="v_phone"></td>
                            </tr>

                            <tr>
                                <th>Method of Contact</th>
                                <td id="v_method_of_contact"></td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal">
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>
    {{-- end --}}

@endsection
@push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>


    <script>
        var table = $("#other_centre_table").DataTable({
            info: true,
            paging: true,
            lengthChange: true,
            searching: true,
            order: [
                [0, 'desc']
            ],
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            pageLength: 10,

            ajax: {
                url: "{{ route('center.all-other-centre-list') }}",
                type: "POST",
                contentType: "application/json",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            },

            columns: [{
                    data: 'member_id',
                    name: 'member_id',
                    searchable: true,
                    orderable: true,
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
                    data: 'entity_name',
                    name: 'entity_name',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'business_address',
                    name: 'business_address',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'business_number',
                    name: 'business_number',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'mobile',
                    name: 'mobile',
                    searchable: false,
                    orderable: true,
                    defaultContent: 'NA'
                },
                // { data: 'email', name: 'email', searchable: false, orderable:true ,defaultContent: 'NA'},
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false,
                    defaultContent: 'NA',
                    class: 'text-center'
                },
            ],
            createdRow: function(row, data, dataIndex) {

                // if (data.status == 'Active') {
                //     $(row).css('background-color', '#e5f2e8');
                // }

                // if (data.status == 'Suspended') {
                //     $(row).css('background-color', '#fae0e0');
                // }

                // if (data.status == 'Pending') {
                //     $(row).css('background-color', '#e6d5a0');
                // }
            }



        });
    </script>

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
            $("#modal-title").text("About Us");
            $("#modal-icon").attr("src", "/assets/dashboard/img/info.png");
            if (form.parsley().isValid()) {

                resetUnsavedChanges();
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
                        const modalElement = document.getElementById('comman_modal');
                        const modal = new bootstrap.Modal(modalElement);
                        if (!data.error) {
                            var msg = "Saved";
                            $('.comman_msg').html(msg);
                            //$("#comman_modal").modal('show');

                            modal.show();
                            //$("#my_account_modal").show();

                            //
                        } else {
                            $('.Lname').html("Oops.. sumthing wrong Please try again");
                            var msg = "Oops.. sumthing wrong Please try again";
                            $('.comman_msg').html(msg);
                            //$("#comman_modal").modal('show');
                            modal.show();

                        }
                    },
                    error: function(xhr) {
                        submit_button
                        const modalElement = document.getElementById('comman_modal');
                        const modal = new bootstrap.Modal(modalElement);

                        if (xhr.status === 422) {

                            let errors = xhr.responseJSON.errors;
                            let msg = '';

                            $.each(errors, function(key, value) {
                                msg += value[0] + "<br>";
                            });

                            $('.comman_msg').html(msg);
                            modal.show();
                        }
                    }

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
                    newTag: false
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

        /////////////////////
        $('#profile_tour_options').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);

            $("#modal-title").text("Profile Contact Options");
            $("#modal-icon").attr("src", "/assets/dashboard/img/info.png");
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
                    const modalElement = document.getElementById('comman_modal');
                    const modal = new bootstrap.Modal(modalElement);
                    if (!data.error) {
                        $('.comman_msg').html("Saved");
                        //$("#my_account_modal").modal('show');
                        //$("#my_account_modal").show();
                        //$("#comman_msg").modal('show');
                        modal.show();

                    } else {
                        $('.comman_msg').html("Oops.. sumthing wrong Please try again");
                        //$("#comman_msg").show();
                        modal.show();

                    }
                },

            });

        });


        $(document).on('submit', 'form[name="add_center_frm"]', function(e) {

            e.preventDefault();
            let form = $(this);
            let formData = new FormData(this);
            $('span.text-danger').text('');
            if (!document.getElementById("center_id").value) {
                swal_waiting_popup({
                    'title': 'Adding a New Centre'
                });
            } else {
                swal_waiting_popup({
                    'title': 'Updating Centre'
                });
            }
            $.ajax({
                url: "{{ route('center.add-sub-account') }}",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    table.ajax.reload(null, false);
                    Swal.close();
                    $('span.text-danger').text('');
                    $('#add_center').modal('hide');
                    $('#add_center_frm')[0].reset();
                    swal_success_popup(response.message);
                },
                error: function(xhr) {
                    Swal.close();
                    console.log(xhr);
                    if (xhr.status === 422) {
                        $('span.text-danger').text('');
                        response = xhr.responseJSON || JSON.parse(xhr.responseText);
                        console.log('errors', response);
                        if (xhr.status === 422 && response && response.errors) {
                            $.each(response.errors, function(field, messages) {
                                $('.error-' + field).text(messages[0]);
                            });
                        } else {
                            swal_error_popup(response?.message || 'Something went wrong');
                        }
                    } else {
                        swal_error_popup(xhr.responseJSON.message || 'Something went wrong');
                    }
                }
            });
        });

        document.querySelectorAll('.toggle-password').forEach(function(el) {
            el.addEventListener('click', function() {
                var input = document.querySelector(this.getAttribute('toggle'));
                var icon = this.querySelector('i');
                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    input.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                }
            });
        });


        $('#password').on('keyup', function() {

            let password = $(this).val();


            if (password.length === 0) {
                $('#password-strength-wrapper').addClass('d-none');
                return;
            }

            $('#password-strength-wrapper').removeClass('d-none');

            let strength = 0;


            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;
            if (password.length >= 16) strength++;

            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^a-zA-Z0-9]/.test(password)) strength++;


            if ((password.match(/[^a-zA-Z0-9]/g) || []).length >= 2) {
                strength++;
            }


            if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).+$/.test(password)) {
                strength++;
            }

            let width = 0;
            let text = '';
            let color = '';

            if (strength <= 2) {
                width = 20;
                text = 'Very Weak';
                color = 'bg-danger';

            } else if (strength <= 4) {
                width = 40;
                text = 'Weak';
                color = 'bg-warning';

            } else if (strength <= 6) {
                width = 60;
                text = 'Medium';
                color = 'bg-info';

            } else if (strength <= 8) {
                width = 80;
                text = 'Strong';
                color = 'bg-primary';

            } else {
                width = 100;
                text = 'Very Strong';
                color = 'bg-success';
            }

            $('#password-strength-bar')
                .removeClass('bg-danger bg-warning bg-info bg-primary bg-success')
                .addClass(color)
                .css('width', width + '%');

            $('#password-strength-text').text(text);
        });

        ////// Edit Center ////////////////////
        $(document).on('click', '.edit-center-btn', function() {
            $('span.text-danger').text('');
            $('#password-strength-wrapper').addClass('d-none');
            let row = $(this).data('row');
            $('#add_center .modal-title').html(
                `<img src="/assets/dashboard/img/add-center.png" class="custompopicon" alt="">Edit Centre`);
            console.log(row);

            $('.modal-title').html('Add Centre');

            $('#password').val('');
            $('#confirm_password').val('');

            $('#center_id').val(row.id);
            $('#member_id').val(row.member_id);
            $('#name').val(row.name);
            $('#entity_name').val(row.entity_name);
            $('#contact_person').val(row.contact_person);
            $('#email').val(row.email);
            $('#business_address').val(row.business_address);
            $('#business_number').val(row.business_number.replace(/\s+/g, ''));
            $('#phone').val(row.phone.replace(/\s+/g, ''));
            $('#join_date').val(formatDateDMY(row.created_at));
            $('input[name="accessGranted"][value="' + (row.is_access_granted == '1' ? 'yes' : 'no') + '"]').prop(
                'checked', true);


            $('input[name="contact_type[]"]').prop('checked', false);
            if (row.contact_type && row.contact_type.length > 0) {
                $.each(row.contact_type, function(index, value) {
                    $('input[name="contact_type[]"][value="' + value + '"]').prop('checked', true);
                });
            }

            $('#submit_button').html('update')
            $('#add_center .modal-title').html(
                `<img src="/assets/dashboard/img/add-center.png" class="custompopicon" alt="">Edit Centre`);
            $('#add_center').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#add_center').modal('show');
        });

        $(document).on('click', '.view-center-btn', function() {
            let row = $(this).data('row');
            $('#v_member_id').text(row.member_id ?? '');
            $('#v_access_granted').text(row.access_granted ?? '');
            $('#v_join_date').text(row.join_date ?? '');
            $('#v_name').text(row.name ?? '');
            $('#v_entity_name').text(row.entity_name ?? '');
            $('#v_business_address').text(row.business_address ?? '');
            $('#v_contact_person').text(row.contact_person ?? '');
            $('#v_email').text(row.email ?? '');
            $('#v_business_number').text(row.business_number ?? '');
            $('#v_phone').text(row.phone ?? '');
            $('#v_method_of_contact').text(row.method_of_contact ?? '');
            $('#view_center').modal('show');
        });


        $(document).on('click', '#open_add_center', function() {
            $('#password-strength-wrapper').addClass('d-none');
            $('#center_id').val('');
            $('span.text-danger').text('');
            $('#add_center_frm')[0].reset();
            $('#submit_button').html('Add')
            $('#add_center .modal-title').html(
                `<img src="/assets/dashboard/img/add-center.png" class="custompopicon" alt="">Add Centre`);
            $('#add_center').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#add_center').modal('show');
        });



        $(document).on('click', '.active-account-btn', async function(e) {
            if (await isConfirm({
                    'action': 'make',
                    'text': 'Activate This Account.'
                })) {


                ajaxRequest({
                    url: "{{ route('center.action-account') }}",
                    method: 'POST',
                    data: {
                        id: $(this).data('row-id'),
                        request_type: 'activate-account'
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

        $(document).on('click', '.account-grant-access', async function(e) {
            if (await isConfirm({
                    'action': 'make',
                    'text': 'Grant Access to This Account.'
                })) {
                swal_waiting_popup({
                    'title': 'Granting Permission'
                });
                ajaxRequest({
                    url: "{{ route('center.action-account') }}",
                    method: 'POST',
                    data: {
                        id: $(this).data('row-id'),
                        request_type: 'access-grant'
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

        $(document).on('click', '.account-suspend-btn', async function(e) {
            if (await isConfirm({
                    'action': 'Suspend',
                    'text': ' Suspend This Account.'
                })) {
                ajaxRequest({
                    url: "{{ route('center.action-account') }}",
                    method: 'POST',
                    data: {
                        id: $(this).data('row-id'),
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

        $(document).on('click', '.login_center', async function(e) {
            if (await isConfirm({
                    'action': ' Login ',
                    'text': 'you want to access this account?'
                })) {

                swal_waiting_popup({
                    'title': 'Redirecting...'
                });
                let account_id = $(this).data('row-id');
                setTimeout(function() {
                    window.location.href = "{{ route('center.switch-to-child', ':id') }}".replace(
                        ':id', account_id);
                }, 2000);

            }
        });

        function formatDateDMY(dateString) {
            let date = new Date(dateString);
            let day = String(date.getDate()).padStart(2, '0');
            let month = String(date.getMonth() + 1).padStart(2, '0');
            let year = date.getFullYear();
            return day + '-' + month + '-' + year;
        }
    </script>
@endpush
