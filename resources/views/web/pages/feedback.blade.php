@extends('layouts.web')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <style>
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0)
        }

        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .form-control,
        .form-check-input {
            background-color: #fff;
            color: #000;
            border-radius: 5px;
            border: 1px solid #d1d3e2;
        }

        #myfeedback label {
            font-weight: bold;
        }

        #myfeedback .form-group label {
            font-size: 16px;
            line-height: unset;
            padding-bottom: 0px;
            text-transform: capitalize;
        }

        .form-control {
            border: 1px solid #d1d3e2;
        }

        @media (min-width: 1200px) {
            .modal-xl {
                max-width: 1140px;
            }
        }
    </style>
@endsection
@section('content')
    <section class="padding_top_eight_px padding_bottom_eight_px">
        <div class="container">
            <h1 class="home_heading_first margin_btm_twenty_px">Feedback</h1>
            <h3>Let us know your thoughts</h3>
            <p>We value your feedback and appreciate any contribution on how to improve and manage our Website.</p>
            <form id="myfeedback" method="POST" action="{{ route('web.feedback.save') }}" class="common_form_design">
                @csrf
                @php
                    $feedbackSubjects = config('common.feedback_subject');
                @endphp
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fb-subject">Subject <span style="color:red">*</span></label>
                        <div class="input-group custom-fields">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 12V20H20V4H4V7M7 8H17M7 12H17M7 16H13" stroke="#495057" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                </span>
                            </div>
                            <select class="form-control" id="fb-subject" name="subject_id" required
                                data-parsley-errors-container="#subject-errors">
                                <option value="" selected disabled>--- Select ---</option>
                                @foreach ($feedbackSubjects as $key => $feedbackname)
                                    <option value="{{ $key }}">{{ $feedbackname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="subject-errors"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="fb-options">Option</label>
                        <!-- This select will be shown/hidden based on subject -->
                        <div class="input-group custom-fields">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg width="20px" height="20px" viewBox="0 0 32 32" enable-background="new 0 0 32 32"
                                        id="Stock_cut" version="1.1" xml:space="preserve"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        fill="#495957">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <desc></desc>
                                            <g>
                                                <path
                                                    d="M31,19v-6h-4.425 c-0.252-0.888-0.611-1.729-1.065-2.51L29,7l-4-4l-3.49,3.49C21.028,6.21,20.525,5.967,20,5.761V1h-8v4.761 c-0.525,0.205-1.028,0.449-1.51,0.728L7,3L3,7l3.49,3.49C6.036,11.271,5.676,12.112,5.425,13H1v6h4.425 c0.252,0.888,0.611,1.729,1.065,2.51L3,25l4,4l3.49-3.49c0.482,0.28,0.986,0.523,1.51,0.728V31h8v-4.761 c0.525-0.205,1.028-0.449,1.51-0.728L25,29l4-4l-3.49-3.49c0.454-0.781,0.813-1.622,1.065-2.51H31z"
                                                    fill="none" stroke="#495957" stroke-linejoin="round"
                                                    stroke-miterlimit="10" stroke-width="2"></path>
                                                <circle cx="16" cy="16" fill="none" r="5" stroke="#495957"
                                                    stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2">
                                                </circle>
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                            <select class="form-control d-none" id="fb-options" name="option_id">
                                <option value="" selected disabled>--- Select ---</option>
                            </select>
                            <!-- Fallback text input -->
                            <input type="text" class="form-control  d-none" id="fb-option-text" name="option_text"
                                placeholder="Write your option">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail4">Email address <span style="color:red">*</span></label>

                    <div class="input-group custom-fields">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M4 7.00005L10.2 11.65C11.2667 12.45 12.7333 12.45 13.8 11.65L20 7"
                                            stroke="#495057" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <rect x="3" y="5" width="18" height="14" rx="2" stroke="#495057"
                                            stroke-width="2" stroke-linecap="round"></rect>
                                    </g>
                                </svg>
                            </span>
                        </div>
                        <input type="email" name="email" required class="form-control" id="inputEmail4"
                            placeholder="Email address" data-parsley-required-message="@lang('errors/validation/required.email')"
                            data-parsley-type-message="@lang('errors/validation/valid.email')" data-parsley-errors-container="#email-errors">
                    </div>
                    <div class="termsandconditions_text_color">
                        @error('email')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                    <div id="email-errors"></div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Comment</label>
                    <div class="input-group custom-fields pt-2">
                        <textarea class="form-control border_for_form" name="comment" id="exampleFormControlTextarea1" rows="4"
                            placeholder="Message"></textarea>
                    </div>
                </div>





                <div class="d-flex justify-content-between gap-20 flex-wrap mb-3">
                    <div class="form-check pb-0 pt-1">
                        <input class="form-check-input" type="checkbox" id="ccEmail" checked name="cc_email">
                        <label class="form-check-label" for="ccEmail">CC email to me</label>
                    </div>
                    <div class="pl-2 pt-2">
                        <span style="font-size: 13px"><b>Note:</b> Geolocation is in use on this Website.</span>
                    </div>
                </div>
                {{-- <div class="form-check pb-3">
                     <input class="form-check-input" type="checkbox" id="tnc" name="tnc">
                    <label class="form-check-label" for="tnc"> I have read and agree to the Influencer <a href="javascript:void(0)" data-toggle="modal" data-target="#InfluencerTnc" class="custom_links_design" style="font-size: 13px;color:#FF3C5F;">Terms and Conditions</a></label>
                   
                </div> --}}
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-12 col-sm-12  col-md-3 col-lg-3 col-xl-3 mb-2 d-flex">
                        <button type="submit" id="btnSubmit" class="common-btn mb-3">Submit Feedback</button>
                    </div>

                    <div class="col-12 col-sm-12  col-md-7 col-lg-7 col-xl-7 mb-2 d-flex">

                        <div class="border p-2 border_color rounded text-justify">

                            <small>
                                Any personal information submitted to this Website will be handled in accordance with
                                E4U's <a class="termsandconditions_text_color" href="privacy-policy" target="_blank"
                                    style="font-size: 13px;">Privacy Policy</a> and
                                <a href="privacy-collection-notice" class="termsandconditions_text_color" target="_blank"
                                    style="font-size: 13px;">Privacy Collection Notice</a>, both
                                available on the Website.
                            </small>
                        </div>
                    </div>
                </div>
            </form>

            <!-- changes to this policy -->
            <div class="container mt-4 px-0 chagneto-policy">
                <hr class="custom_hr">
                <h2 class="primery_color normal_heading">Changes to this Policy</h2>
                <p class="border-0 text-align-justify">We may change or modify this Policy in the future. We will note the
                    date that revisions were last made at the bottom of this page. Any revision will take effect upon its
                    posting. It is your responsibility to check the <a href="{{ url('terms-conditions') }}"
                        style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
                    review the most current version.</p>
                <p>Escorts4U archives all previous versions of this Policy.</p>
                <p><b>This policy was last updated 04-06-2025</b></p>
            </div>
        </div>
    </section>

    @include('./web.modal.influencer_tnc_modal')
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/src/extra/validator/comparison.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    <script>
        var skipSliderage = document.getElementById("skipstepage");
        var skipValuesage = [
            document.getElementById("skip-value-lower-age"),
            document.getElementById("skip-value-upper-age")
        ];

        /*noUiSlider.create(skipSliderage, {
        start: [0, 30],
        connect: true,
        behaviour: "drag",
        step: 1,
        range: {
           min: 18,
           max: 60
        },
        format: {
           from: function (value) {
              return parseInt(value);
           },
           to: function (value) {
              return parseInt(value);
           }
        }
        });
        
        skipSliderage.noUiSlider.on("update", function (values, handle) {
        skipValuesage[handle].innerHTML = values[handle];
        });*/
    </script>
    <script>
        const subjectSelect = document.getElementById('fb-subject');
        const optionSelect = document.getElementById('fb-options');
        const optionText = document.getElementById('fb-option-text');
        optionText.classList.remove('d-none');
        optionSelect.classList.add('d-none');


        $('#fb-subject').change(function() {
            var subject_id = $(this).val();
            let dropdown = $('#fb-options');
            dropdown.empty();
            var form = $(this);
            if (form.parsley().isValid()) {
                $.ajax({
                    method: "POST",
                    url: "{{ route('web.option') }}",
                    data: {
                        subject_id: subject_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.error) {
                            optionText.classList.remove('d-none');
                            optionSelect.classList.add('d-none');
                            dropdown.append(
                                '<option value="" selected disabled>--- Select ---</option>');
                        } else {
                            $.each(data.result, function(key, entry) {
                                dropdown.append($('<option></option>').attr('value', entry.id)
                                    .text(entry.name));
                            });
                            optionSelect.classList.remove('d-none');
                            optionText.classList.add('d-none');
                            optionText.value = "";
                        }
                    }
                });
            }
        })
        $('#myfeedback').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            var data = new FormData($('#myfeedback')[0]);
            if (!form.parsley().isValid()) {
                return false; // ❌ validation fail → AJAX nahi jayega
            }
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
                        /* $.toast({
                             heading: 'Success',
                             text: 'Record successfully update',
                             icon: 'success',
                             loader: true,
                             position: 'top-right',      // Change it to false to disable loader
                             loaderBg: '#9EC600'  // To change the background
                         });*/
                        $('#myfeedback')[0].reset();
                        window.location = "{{ route('feedback.thankyou') }}";
                    } else {
                        $('#btnSubmit').prop('disabled', false);
                        $.toast({
                            heading: 'Error',
                            text: 'Your Feedback request failed to send. Please try later..',
                            icon: 'error',
                            loader: true,
                            position: 'top-right', // Change it to false to disable loader
                            loaderBg: '#9EC600' // To change the background
                        });

                    }
                }
            });

        });
        $('#myfeedback').parsley({

        });
    </script>
    <script>
        // Define subjects with predefined options
        const subjectOptions = {
            //6
            "Request for Information": [
                "To become a Support Agent",
                "Concierge Services",
                "My Playbox"
            ],
            //7
            "Report a bug in the Website": [
                "Public page",
                "Escort listing page",
                "Massage Centre listing page",
                "Escort Console",
                "Massage Centre Console",
                "Agent Console",
                "Viewer Console"
            ]
        };

        // Default state: show text input, hide select

        /*subjectSelect.addEventListener('change', function () {
            const selected = this.value;

            if (subjectOptions[selected]) {
                // Populate and show the select box
                optionSelect.innerHTML = `<option disabled selected>--- Select Option ---</option>`;
                subjectOptions[selected].forEach(opt => {
                    const option = document.createElement('option');
                    option.value = opt;
                    option.textContent = opt;
                    optionSelect.appendChild(option);
                });

                // Show select, hide text input
                optionSelect.classList.remove('d-none');
                optionText.classList.add('d-none');
            } else {
                // Show input text field, hide select
                optionSelect.classList.add('d-none');
                optionText.classList.remove('d-none');
            }
        });*/
    </script>
@endpush
