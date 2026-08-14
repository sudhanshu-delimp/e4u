@extends('layouts.userDashboard')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <style type="text/css">
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0)
        }

        .help_center a {
            color: #FF3C5F;
            font-size: 16px;
        }

        .help_center a:hover {
            text-decoration: underline;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">

        <!--middle content end here-->
        <!-- Page Heading -->
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">My Account</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                    aria-expanded="true"><b>Help?</b></span>
            </div>

            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body help_center">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>
                            <li>Use this feature to complete all of your personal details - who you are, contact information
                                how Users communicate with you.</li>
                            <li>Make sure you take the time to complete everything, it will help you manage your Account
                                much better, especially with communication.
                                If you are not sure about any of the settings, get in touch with our <a
                                    href="./submitticket">Help Centre.</a></li>
                            <li>There is some general information also available to you inside each of the My Account
                                groups.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Heading -->
        <div class="row">

            <div class="col-lg-12">
                <div class="common-card">
                    <form id="userProfile" class="common-form" action="{{ route('user.account.update', [$user->id]) }}"
                        method="POST">
                        @csrf
                        <div class="row inner-row ">
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
                                        <p class="input_not_edit">{{ $user->memberId }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="membership_num">Date Joined</label>
                                        <label class="input_not_edit" placeholder=" "
                                            aria-describedby="emailHelp">{{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="my_name" class="my-agent">My Name 
                                            {{-- <img src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}"> --}}
                                        </label>
                                        <input type="text" class="form-control" name="name" placeholder="Jane Doe"
                                            aria-describedby="emailHelp" value="{{ $user->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Gender" class="my-agent">Gender
                                            {{-- <img src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}"> --}}
                                        </label>
                                        <select class="form-control" name="gender" required>
                                            <option value="">Select</option>
                                            @foreach (config('escorts.profile.genders') as $key => $gender)
                                                <option value="{{ $key }}"
                                                    {{ $user->gender == $key ? 'selected' : '' }}>
                                                    {{ $gender }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <p class="input_not_edit">{{ $user->phone }}</p>

                                    </div>
                                    <div class="form-group">
                                        <label for="home_state">Home State</label>
                                        <label class="input_not_edit" placeholder="Western Australia"
                                            aria-describedby="emailHelp" id="stateNew" name="state_id"
                                            value="{{ $user->state_id }}">{{ config('escorts.profile.states')[$user->state_id]['stateName'] }}</label>


                                        <span id="state-errors"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email 
                                            {{-- <img src="{{ asset('assets/app/img/home/quationmarkblue.svg') }}"></label> --}}

                                        <p type="text" class="input_not_edit" placeholder="JaneDoe@domain.com.au"
                                            name="email" aria-describedby="emailHelp">{{ $user->email }}</p>
                                    </div>
                                </div>



                            </div>
                            <div class="col-lg-12">
                                
                            <div class="form-group">
                                <div class="radio-options">

                                    <label for="email">Method of contact:</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" checked type="checkbox" name="contact_type[]"
                                            id="Method_Message" value="1"
                                            @if (!empty($user->contact_type)) {{ in_array(1, $user->contact_type) ? 'checked' : null }} @endif>
                                        <label class="form-check-label" for="Method_Message">Message
                                            (via Console)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="contact_type[]"
                                            id="Method_Text" value="2"
                                            @if (!empty($user->contact_type)) {{ in_array(2, $user->contact_type) ? 'checked' : null }} @endif>
                                        <label class="form-check-label" for="Method_Text">Text</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="contact_type[]"
                                            id="Method_Email" value="3"
                                            @if (!empty($user->contact_type)) {{ in_array(3, $user->contact_type) ? 'checked' : null }} @endif>
                                        <label class="form-check-label" for="Method_Email">Email</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="contact_type[]"
                                            id="Method_call_me" value="4"
                                            @if (!empty($user->contact_type)) {{ in_array(4, $user->contact_type) ? 'checked' : null }} @endif>
                                        <label class="form-check-label" for="Method_call_me">Call
                                            me</label>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="common-footer">
                            <input type="submit" value="Save" class="common-save-btn" name="submit">
                        </div>
                </div>
                
                </form>
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
                        if (data.error == true) {
                            // $('.comman_msg').html("Saved");
                            showAlert('About Me', "Saved successfully", 'success');
                            //$("#my_account_modal").modal('show');
                            //$("#my_account_modal").show();
                            // $("#comman_modal").modal('show');

                        } else {
                            $('.comman_msg').html("Oops.. sumthing wrong Please try again");
                            showAlert('About Me', "Oops.. sumthing wrong Please try again", 'error');
                            // $("#comman_modal").show();

                        }
                    },

                });
            }
        });


        // function showAlert(title, message, type) {
        //     Swal.fire({
        //         title: title,
        //         text: message,
        //         icon: type
        //     });

        // }
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
