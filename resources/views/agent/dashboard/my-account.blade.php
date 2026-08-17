@extends('layouts.agent')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
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
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content start here-->
        <!-- Page Heading -->
        <div class="row">




            <div class="custom-heading-wrapper col-lg-12">
                <h1 class="h1">Edit My Account</h1>
                <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes"
                    aria-expanded="true">Help?</span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- end --}}
        <div class="row">

            <div class="col-md-12 commanAlert"></div>

            <div class="col-lg-12">
                <div class="common-card">
                    <form id="userProfile" class="common-form" action="{{ route('agent.account.update', [$user->id]) }}"
                        method="POST">
                        <input type="hidden" name="_token">
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
                                        <p class="input_not_edit">{{ $user->member_id }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="membership_num">Date Joined</label>
                                        <p class="input_not_edit" placeholder=" " aria-describedby="emailHelp">
                                            {{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="my_name">Business Name</label>
                                        <input type="text" class="form-control" name="business_name"
                                            placeholder=" Business Name" aria-describedby="emailHelp"
                                            value="{{ $user->business_name }} ">
                                    </div>
                                    <div class="form-group">
                                        <label for="my_name" class="my-agent">ABN</label>
                                        <input type="txt" class="form-control" id="mobileno"
                                            aria-describedby="emailHelp" name="abn" required placeholder="ABN"
                                            data-parsley-required-message="Your ABN is required" value="{{ $user->abn }}"
                                            maxlength="14"
                                            oninput="this.value = this.value.replace(/[^0-9 ]/g, '').replace(/\s+/g, ' ')"
                                            data-parsley-type-message="Enter only numbers">
                                        <span id="abn-errors"></span>
                                        <div class="termsandconditions_text_color">
                                            @error('abn')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Business Address</label>
                                        <input type="text" class="form-control" name="business_address"
                                            placeholder="Business Address " aria-describedby="emailHelp"
                                            value=" {{ $user->business_address }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Business Number</label>
                                        <input type="txt" class="form-control" id="mobileno"
                                            aria-describedby="emailHelp" name="business_number" maxlength="12" required
                                            placeholder="Business Number"
                                            data-parsley-required-message="Your Business Number is required"
                                            value="{{ $user->business_number }}"
                                            oninput="this.value = this.value.replace(/[^0-9 ]/g, '').replace(/\s+/g, ' ')"
                                            data-parsley-type-message="Enter only numbers">
                                        <span id="business_number-errors"></span>
                                        <div class="termsandconditions_text_color">
                                            @error('business_number')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Contact</label>
                                        <input type="text" class="form-control" name="contact_person"
                                            placeholder=" Contact " aria-describedby="emailHelp"
                                            value="{{ $user->contact_person }} ">
                                    </div>
                                    <div class="form-group">
                                        <label for="mobileno">Mobile</label>
                                        <input type="txt" class="form-control input_not_edit" id="mobileno"
                                            aria-describedby="emailHelp" name="phone" data-parsley-maxlength="12"
                                            required placeholder="Mobile Number"
                                            data-parsley-required-message="Your mobile number is required"
                                            value="{{ $user->phone }}" disabled data-parsley-pattern="^[0-9 ]+$"
                                            data-parsley-type-message="Enter only mobile numbers" dis>
                                        <span id="phone-errors"></span>
                                        <div class="termsandconditions_text_color">
                                            @error('phone')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{ __('Email') }}</label>
                                        <p class="input_not_edit" placeholder=" " aria-describedby="emailHelp">
                                            {{ $user->email }} </p>

                                        <span id="email2-errors"></span>
                                        <div class="termsandconditions_text_color">
                                            @error('email2')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Territory</label>
                                        <p class="input_not_edit" aria-describedby="emailHelp">{{ $user->state->name }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">E4U Email</label>
                                        <p class="input_not_edit" placeholder=" " aria-describedby="emailHelp">
                                            {{ $user->email2 }} </p>
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


            <div class="col-lg-12 my-4">
                <div class="common-card">
                    <form id="userProfile2" class="common-form" novalidate="">
                        <input type="hidden" name="_token">
                        <div class="row inner-row">
                            <div class="col-lg-12">
                                <div class="card-top">
                                    <div class="card-icon">
                                        <svg fill="#ff3c5f" height="64px" width="64px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 240.009 240.009" xml:space="preserve" stroke="#ff3c5f"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M218.946,31.934c-13.605-13.606-31.689-21.099-50.919-21.098c-17.889,0.001-34.782,6.494-48.006,18.353 C106.803,17.338,89.918,10.85,72.031,10.85c-0.002,0-0.005,0-0.008,0c-19.237,0.002-37.322,7.498-50.92,21.105 C7.495,45.557,0,63.642,0,82.877C0,102.114,7.494,120.201,21.101,133.807l1.717,1.718c-0.003,0.165-0.012,0.33-0.012,0.496 c0,6.314,2.462,12.246,6.922,16.691c4.007,4.009,9.198,6.397,14.781,6.848c-0.002,0.13-0.009,0.259-0.009,0.39 c0.003,6.31,2.464,12.239,6.927,16.693c4.46,4.458,10.389,6.913,16.694,6.913c0.001,0,0.001,0,0.001,0c0.134,0,0.266-0.008,0.4-0.01 c0.433,5.393,2.692,10.662,6.802,14.774c4.012,4.021,9.208,6.414,14.796,6.863c-0.002,0.121-0.009,0.241-0.009,0.362 c0,6.31,2.46,12.242,6.919,16.697c4.455,4.468,10.389,6.929,16.707,6.929c0.001,0,0,0,0.001,0c6.308,0,12.239-2.454,16.704-6.914 l15.548-15.566c2.368-2.365,4.165-5.148,5.337-8.181c3.043-1.177,5.82-2.967,8.179-5.327c4.274-4.271,6.711-9.894,6.914-15.907 c6.012-0.198,11.634-2.635,15.9-6.906c4.064-4.061,6.468-9.34,6.87-15.015c0.047,0,0.093,0.001,0.14,0.001 c6.045-0.001,12.097-2.295,16.714-6.887c1.848-1.85,3.347-3.954,4.475-6.23l8.427-8.425 C247.029,105.741,247.03,60.037,218.946,31.934z M40.327,142.099c-1.625-1.621-2.521-3.78-2.521-6.079 c0-2.306,0.899-4.477,2.527-6.107l15.54-15.532c1.633-1.633,3.802-2.532,6.108-2.532c2.3,0,4.46,0.896,6.092,2.53 c3.361,3.357,3.363,8.834,0.02,12.194l-0.871,0.87c-0.084,0.082-0.172,0.159-0.255,0.243l-14.448,14.45 c-1.622,1.618-3.775,2.509-6.067,2.509c0,0-0.001,0-0.001,0C44.144,144.645,41.972,143.744,40.327,142.099z M68.122,168.556 c-2.3,0-4.463-0.896-6.095-2.526c-1.629-1.626-2.526-3.787-2.527-6.087c-0.001-2.305,0.898-4.473,2.532-6.107l1.063-1.063 c0.015-0.015,0.031-0.029,0.046-0.044l14.562-14.555c1.616-1.552,3.725-2.41,5.967-2.41c2.308,0,4.482,0.901,6.112,2.525 c3.36,3.363,3.36,8.84,0.01,12.196l-15.574,15.54C72.589,167.658,70.424,168.556,68.122,168.556L68.122,168.556z M85.938,187.721 c-3.356-3.357-3.352-8.827,0.005-12.188l15.55-15.533c1.637-1.638,3.808-2.54,6.11-2.54c2.293,0,4.452,0.896,6.086,2.532 c1.629,1.625,2.526,3.788,2.527,6.09c0.001,2.305-0.896,4.473-2.518,6.097l-15.573,15.555c-1.626,1.635-3.786,2.534-6.082,2.534 C89.744,190.267,87.578,189.365,85.938,187.721z M119.836,211.651c-1.628,1.626-3.793,2.521-6.098,2.521 c-2.304,0-4.466-0.895-6.096-2.53c-1.632-1.63-2.53-3.795-2.53-6.096c0-2.302,0.899-4.467,2.533-6.101l15.542-15.543 c1.631-1.631,3.796-2.529,6.096-2.529c2.304,0,4.473,0.9,6.103,2.526c1.628,1.629,2.525,3.794,2.525,6.097 c0,2.299-0.895,4.459-2.526,6.088L119.836,211.651z M183.222,137.842l-0.884-0.883c-0.002-0.002-0.003-0.004-0.004-0.005 l-32.39-32.381c-2.93-2.93-7.677-2.929-10.607,0.001c-2.928,2.93-2.928,7.678,0.001,10.607l32.378,32.37 c0.003,0.003,0.006,0.007,0.009,0.01c1.629,1.63,2.525,3.796,2.523,6.1c-0.002,2.304-0.901,4.47-2.537,6.104 c-1.626,1.629-3.79,2.525-6.092,2.525c-2.304,0-4.47-0.898-6.101-2.529l-32.377-32.377c-2.929-2.928-7.678-2.928-10.606,0 c-2.929,2.93-2.929,7.678,0,10.607l32.377,32.377c1.627,1.627,2.523,3.794,2.521,6.1c-0.001,1.227-0.263,2.411-0.747,3.5 c-1.15-2.449-2.728-4.707-4.699-6.679c-4.01-4.004-9.201-6.386-14.782-6.833c0.002-0.127,0.009-0.254,0.009-0.381 c-0.002-6.313-2.464-12.245-6.924-16.695c-4.46-4.464-10.387-6.922-16.688-6.922c-0.135,0-0.269,0.008-0.404,0.01 c-0.437-5.395-2.7-10.671-6.817-14.793c-4.021-4.006-9.224-6.389-14.813-6.83c0.096-6.178-2.19-12.381-6.886-17.072 c-4.458-4.466-10.389-6.926-16.701-6.926c-6.312,0-12.248,2.459-16.713,6.924l-15.544,15.536c-0.281,0.281-0.553,0.568-0.818,0.86 C19.918,109.808,15,96.723,15,82.878c0-15.229,5.933-29.546,16.71-40.316C42.478,31.786,56.795,25.851,72.025,25.85 c0.003,0,0.003,0,0.006,0c13.834,0,26.909,4.912,37.27,13.895l-28.8,28.805c-9.208,9.216-9.211,24.205-0.002,33.416 c9.213,9.202,24.199,9.201,33.411-0.005l28.917-28.931l52.619,52.627c1.622,1.616,2.518,3.773,2.521,6.076 c0.001,1.117-0.212,2.201-0.61,3.208c-0.036,0.083-0.072,0.165-0.105,0.249c-0.425,0.983-1.029,1.887-1.803,2.661 C192.07,141.211,186.586,141.208,183.222,137.842z M210.405,121.03c-1.116-2.188-2.576-4.211-4.363-5.99l-57.909-57.917 c-0.001-0.001-0.003-0.003-0.004-0.005c-2.741-2.739-7.071-2.914-10.015-0.529c-0.007,0.006-0.014,0.01-0.02,0.016 c-0.128,0.104-0.248,0.221-0.37,0.334c-0.065,0.061-0.135,0.117-0.199,0.181c0,0-0.001,0.001-0.001,0.001l-0.001,0.001 l-34.218,34.233c-3.364,3.359-8.839,3.359-12.201,0.002c-3.36-3.361-3.356-8.836,0.009-12.205l34.14-34.145 c0.029-0.028,0.061-0.053,0.089-0.081c0.027-0.027,0.05-0.058,0.077-0.085l2.289-2.29c10.777-10.777,25.097-16.713,40.322-16.714 c15.223-0.001,29.539,5.932,40.309,16.702C229.863,64.079,230.551,98.676,210.405,121.03z"></path> </g></svg>
                                    </div>

                                    <div class="card-heading">
                                        <h2>Agreement</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="inner-field-row">
                                    <div class="form-group">
                                        <label for="membership_num">Agreement Date</label>
                                        <p class="input_not_edit">
                                            {{ $user->agent_detail ? date('d-m-Y', strtotime($user->agent_detail)) : '' }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="membership_num">Term</label>
                                        <p class="input_not_edit">
                                            {{ $user->agent_detail ? $user->agent_detail->term : '' }}</p>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="my_name">Option Period</label>
                                        <p class="input_not_edit">
                                            {{ $user->agent_detail ? $user->agent_detail->option_peroid : '' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="my_name" class="my-agent">Option Exercised</label>
                                        <p class="input_not_edit">
                                            {{ $user->agent_detail ? $user->agent_detail->option_exercised : '' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Territory</label>
                                        <p class="input_not_edit"
                                            aria-describedby="emailHelp">{{ $user->state->name }}</p>
                                    </div>
                                    
                                </div>
                            </div>
                            
                                <div class="col-lg-12 mt-4">
                                    <div class="form-group">
                                        <label>You can retrieve your Agent Agreement by
                                            @if ($user->agent_detail && $user->agent_detail->agreement_file != '')
                                                <a download="true"
                                                    href="{{ asset('storage/' . $user->agent_detail->agreement_file) }}"
                                                    class="custom_links_design">
                                                    <span style="color: #FF3C5F;">clicking here.</span>
                                                </a>
                                            @else
                                                <a download="true" href="#" class="custom_links_design">
                                                    <span style="color: #FF3C5F;">clicking here.</span>
                                                </a>
                                            @endif


                                    </div>
                                </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="common-card">
                    <form id="userProfile3" class="common-form" novalidate="">
                        <input type="hidden" name="_token">
                        <div class="row inner-row">
                            <div class="col-lg-12">
                                <div class="card-top">
                                    <div class="card-icon">
                                        <svg width="64px" height="64px" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M24.0433 4C19.0249 4 14.4518 5.65746 11.7469 7.01231C11.5031 7.13439 11.2746 7.25402 11.0622 7.36975C10.642 7.59878 10.2852 7.81256 10 8L13.0777 12.5307L14.5263 13.1074C20.1889 15.9645 27.7825 15.9645 33.4451 13.1074L35.09 12.254L38 8C37.5736 7.7157 36.9838 7.37078 36.2581 7.00403C36.2139 6.98167 36.1692 6.95924 36.1239 6.93673C33.4307 5.59663 28.9687 4 24.0433 4ZM16.8852 9.12906C15.7776 8.92471 14.6893 8.64286 13.662 8.31949C16.1968 7.19394 19.9743 6 24.0433 6C26.8626 6 29.5282 6.57325 31.733 7.2991C29.1492 7.66384 26.3919 8.27955 23.7654 9.03939C21.6987 9.63727 19.2829 9.57147 16.8852 9.12906Z" fill="#ff3c5f"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M34.6185 14.7556L34.3461 14.893C28.1168 18.036 19.8546 18.036 13.6254 14.893L13.3664 14.7624C4.00908 25.0304 -5.80757 44.2853 24.0433 43.9968C53.8737 43.7085 43.9033 24.6761 34.6185 14.7556ZM25.7113 22H22.2887V23.6C21.1765 23.5974 20.1071 23.9999 19.3068 24.7222C18.5067 25.4443 18.0388 26.4294 18.0023 27.4687C17.9658 28.508 18.3636 29.5197 19.1113 30.2894C19.8591 31.0591 20.8981 31.5263 22.0081 31.592L22.2887 31.6H25.7113L25.8653 31.6128C26.0626 31.6462 26.2411 31.7433 26.3696 31.8872C26.4981 32.031 26.5686 32.2126 26.5686 32.4C26.5686 32.5874 26.4981 32.769 26.3696 32.9128C26.2411 33.0567 26.0626 33.1538 25.8653 33.1872L25.7113 33.2H18.8661V36.4H22.2887V38H25.7113V36.4C26.8235 36.4026 27.8929 36.0001 28.6932 35.2778C29.4933 34.5557 29.9612 33.5706 29.9977 32.5313C30.0342 31.492 29.6364 30.4803 28.8887 29.7106C28.1409 28.9409 27.1019 28.4737 25.9919 28.408L25.7113 28.4H22.2887L22.1347 28.3872C21.9374 28.3538 21.7589 28.2567 21.6304 28.1128C21.5019 27.969 21.4314 27.7874 21.4314 27.6C21.4314 27.4126 21.5019 27.231 21.6304 27.0872C21.7589 26.9433 21.9374 26.8462 22.1347 26.8128L22.2887 26.8H29.1339V23.6H25.7113V22Z" fill="#ff3c5f"></path> </g></svg>
                                    </div>

                                    <div class="card-heading">
                                        <h2>Fees</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="inner-field-row">
                                    <div class="form-group">
                                        <label for="membership_num">Advertiser
                                        </label>
                                        @if ($user->agent_detail->commission_advertising_type == 'percent')
                                            <p class="input_not_edit">
                                                {{ $user->agent_detail ? $user->agent_detail->commission_advertising_percent . '%' : '' }}
                                            </p>
                                        @else
                                            <p class="input_not_edit">
                                                {{ $user->agent_detail ? "$" . $user->agent_detail->commission_advertising_percent : '' }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="membership_num">Massage Centres (Signed Up)</label>
                                        <p class="input_not_edit" placeholder=" " aria-describedby="emailHelp">
                                            @if ($user->agent_detail->commission_registration_type == 'percent')
                                                {{ $user->agent_detail ? $user->agent_detail->commission_registration_amount . '%' : '' }}
                                            @else
                                                {{ $user->agent_detail ? "$" . $user->agent_detail->commission_registration_amount : '' }}
                                            @endif

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </form>
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
    <!-- file upload plugin start here -->
    <!-- file upload plugin end here -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    <script type="text/javascript">
        $('#userProfile').parsley({

        });



        $('#userProfile').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            $("#modal-title").text("About Me");
            $("#modal-icon").attr("src", "/assets/dashboard/img/info.png");
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
                            showAlert('success', 'Your details have been updated successfully.',
                                'success');
                            // $('.commanAlert').html(`<div id="commanAlert" class="alert rounded alert-success">Your details have been updated successfully.</div>`);
                            //$('.comman_msg').html("Saved");
                            //$("#my_account_modal").modal('show');
                            //$("#my_account_modal").show();
                            //$("#comman_modal").modal('show');

                        } else {
                            //  $('.commanAlert').html(`<div id="commanAlert" class="alert rounded alert-error">Error occured while updating data.</div>`);
                            showAlert('error', 'An error occurred while updating your details.',
                                'error');

                            // $('.comman_msg').html("Oops.. sumthing wrong Please try again");
                            // $("#comman_modal").show();

                        }
                    },

                });
            }
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
@endpush
