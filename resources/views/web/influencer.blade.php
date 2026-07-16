@extends('layouts.web')
@section('style')
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #0c223d;
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
        }

        #membershipForm label {
            font-weight: bold;
        }

        .form-control {
            border: 1px solid #d1d3e2;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-box {
            background: #fff;
            border-radius: 8px;
            padding: 30px 20px;
            max-width: 400px;
            width: 90%;
            text-align: center;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
            font-family: 'Poppins', sans-serif;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .icon {
            font-size: 48px;
            color: #4CAF50;
            border: 1px solid;
            width: 75px;
            margin: 0 auto 20px;
            border-radius: 50%;
        }

        .message {
            font-size: 16px;
            margin-bottom: 20px;
            color: #333;
        }

        .ok-btn {
            background-color: #0c223d;
            border: none;
            color: white;
            padding: 8px 20px;
            font-size: 14px;
            border-radius: 6px;
            cursor: pointer;
        }

        .ok-btn:hover {
            background-color: #0c223d;
        }

        @media (min-width: 1200px) {
            .modal-xl {
                max-width: 1140px;
            }
        }
    </style>
@endsection
@section('content')
    <section class="padding_top_eight_px padding_bottom_eight_px footer-links-si">
        <div class="container">
            <h1 class="home_heading_first">Become an Influencer</h1>
            <p>Have you got a great social media profile, like X or Instagram, or perhaps TikTok and you are
                a registered Advertiser on E4U? If you meet our criteria, we will discount your Fees when
                you list a Profile or create a Tour with us. The discounts are generous.
            </p>

            <p>Fill out the form below with your details and we will be in touch to explain how our ‘Become
                an Influencer’ program works.

            </p>

            <form id="membershipForm" onsubmit="handleFormSubmit(event)" class="common_form_design">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="membershipId" class="form-label">Membership ID <span
                                    class="text-danger">*</span></label>
                            <div class="input-group custom-fields">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M15 7C15 8.65685 13.6569 10 12 10C10.3431 10 9 8.65685 9 7C9 5.34315 10.3431 4 12 4C13.6569 4 15 5.34315 15 7Z"
                                                    stroke="#495057" stroke-width="2"></path>
                                                <path
                                                    d="M5 19.5C5 15.9101 7.91015 13 11.5 13H12.5C16.0899 13 19 15.9101 19 19.5V20C19 20.5523 18.5523 21 18 21H6C5.44772 21 5 20.5523 5 20V19.5Z"
                                                    stroke="#495057" stroke-width="2"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="membershipd" placeholder="Membership ID"
                                    name="member_id" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address <span
                                    class="text-danger">*</span></label>

                            <div class="input-group custom-fields">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M4 7.00005L10.2 11.65C11.2667 12.45 12.7333 12.45 13.8 11.65L20 7"
                                                    stroke="#495057" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <rect x="3" y="5" width="18" height="14" rx="2"
                                                    stroke="#495057" stroke-width="2" stroke-linecap="round"></rect>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                                <input type="email" class="form-control" id="email" placeholder="Email Address"
                                    name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label">Social Media Address(es) <span class="text-danger">*</span></label>
                        <div id="socialMediaContainer">
                            <div class="input-group custom-fields">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M23 5.5C23 7.98528 20.9853 10 18.5 10C17.0993 10 15.8481 9.36007 15.0228 8.35663L9.87308 10.9315C9.95603 11.2731 10 11.63 10 11.9971C10 12.3661 9.9556 12.7247 9.87184 13.0678L15.0228 15.6433C15.8482 14.6399 17.0993 14 18.5 14C20.9853 14 23 16.0147 23 18.5C23 20.9853 20.9853 23 18.5 23C16.0147 23 14 20.9853 14 18.5C14 18.1319 14.0442 17.7742 14.1276 17.4318L8.97554 14.8558C8.1502 15.8581 6.89973 16.4971 5.5 16.4971C3.01472 16.4971 1 14.4824 1 11.9971C1 9.51185 3.01472 7.49713 5.5 7.49713C6.90161 7.49713 8.15356 8.13793 8.97886 9.14254L14.1275 6.5682C14.0442 6.2258 14 5.86806 14 5.5C14 3.01472 16.0147 1 18.5 1C20.9853 1 23 3.01472 23 5.5ZM16.0029 5.5C16.0029 6.87913 17.1209 7.99713 18.5 7.99713C19.8791 7.99713 20.9971 6.87913 20.9971 5.5C20.9971 4.12087 19.8791 3.00287 18.5 3.00287C17.1209 3.00287 16.0029 4.12087 16.0029 5.5ZM16.0029 18.5C16.0029 19.8791 17.1209 20.9971 18.5 20.9971C19.8791 20.9971 20.9971 19.8791 20.9971 18.5C20.9971 17.1209 19.8791 16.0029 18.5 16.0029C17.1209 16.0029 16.0029 17.1209 16.0029 18.5ZM5.5 14.4943C4.12087 14.4943 3.00287 13.3763 3.00287 11.9971C3.00287 10.618 4.12087 9.5 5.5 9.5C6.87913 9.5 7.99713 10.618 7.99713 11.9971C7.99713 13.3763 6.87913 14.4943 5.5 14.4943Z"
                                                    fill="#495057"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                                <input type="url" class="form-control" name="social_media[]"
                                    placeholder="Social Media Address(es)" required>
                            </div>
                        </div>
                        <button type="button" class="common-btn btn-sm py-2" onclick="addSocialMedia()">Add
                            Address</button>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label for="comments" class="form-label">Comments</label>
                        <div class="input-group custom-fields">
                            <textarea class="form-control py-2" id="comments" name="comments" placeholder="Message" rows="3"></textarea>
                    </div>
                    </div>
                </div>







                  

                <div class="d-flex justify-content-between gap-20 flex-wrap">
                    <div class="form-check pb-0 pt-1">
                        <input class="form-check-input" type="checkbox" id="ccEmail" checked name="cc_email">
                        <label class="form-check-label" for="ccEmail">CC email to me</label>
                    </div>
                    <div class="pl-2 pt-2">
                        <span style="font-size: 13px"><b>Note:</b> Geolocation is in use on this Website.</span>
                    </div>
                </div>
                <div class="form-check pb-3">
                    <input class="form-check-input" type="checkbox" id="tnc" name="tnc">
                    <label class="form-check-label" for="tnc"> I have read and agree to the Influencer <a
                            href="javascript:void(0)" data-toggle="modal" data-target="#InfluencerTnc">Terms and
                            Conditions</a></label>

                </div>

                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-12 col-sm-12  col-md-4 col-lg-4 col-xl-4 mb-2 d-flex">
                        <button type="submit" class="common-btn send_request_btn">Submit Request</button>
                    </div>

                    <div class="col-12 col-sm-12  col-md-7 col-lg-7 col-xl-7 mb-2 d-flex">

                        <div class="border p-2 border_color rounded text-justify ">

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
                <p class="border-0">We may change or modify this Policy in the future. We will note the date that revisions
                    were last made at the bottom of this page. Any revision will take effect upon its posting. It is your
                    responsibility to check the <a href="{{ url('terms-conditions') }}" style="color:#FF3C5F">Terms and
                        Conditions</a> and this Policy from time to time to
                    review the most current version.</p>
                <p>Escorts4U archives all previous versions of this Policy.</p>
                <p><b>This policy was last updated 28-05-2025</b></p>
            </div>
        </div>
    </section>


    <div class="modal fade upload-modal" id="confirmationModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:white">
                        <img src="{{ asset('assets/dashboard/img/unblock.png') }}" class="custompopicon">
                        Influencer
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="custom_modal_text">
                        <span id="Lname">Thank you for your request.<br>An email has been forwarded.</span>
                    </h5>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group d-flex align-items-center justify-content-center">
                                <a href="javascript:void(0)" onclick="closeModal()"
                                    class="btn-success-modal text-decoration-none text-white" data-dismiss="modal">OK</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('./web.modal.influencer_tnc_modal')

    </div>
@endsection
@push('scripts')
    <script>
        var skipSliderage = document.getElementById("skipstepage");
        var skipValuesage = [
            document.getElementById("skip-value-lower-age"),
            document.getElementById("skip-value-upper-age")
        ];

        noUiSlider.create(skipSliderage, {
            start: [0, 30],
            connect: true,
            behaviour: "drag",
            step: 1,
            range: {
                min: 18,
                max: 60
            },
            format: {
                from: function(value) {
                    return parseInt(value);
                },
                to: function(value) {
                    return parseInt(value);
                }
            }
        });

        skipSliderage.noUiSlider.on("update", function(values, handle) {
            skipValuesage[handle].innerHTML = values[handle];
        });

        function addSocialMedia() {
            const container = document.getElementById('socialMediaContainer');

            // Wrapper div for input + remove button
            const inputGroup = document.createElement('div');
            inputGroup.className = 'input-group custom-fields my-2';

            // Create input field
            const input = document.createElement('input');
            input.type = 'url';
            input.name = 'social_media[]';
            input.required = true;
            input.className = 'form-control rounded';
            input.placeholder = 'Social Media Address';

            // Create remove (X) button
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'btn-cancel-modal py-1 ml-2';
            removeBtn.innerHTML = 'Remove Address';
            removeBtn.onclick = function() {
                container.removeChild(inputGroup);
            };

            // Add input and remove button to wrapper
            inputGroup.appendChild(input);
            inputGroup.appendChild(removeBtn);

            // Add wrapper to container
            container.appendChild(inputGroup);
        }


        function handleFormSubmit(event) {
            event.preventDefault(); // prevent page reload

            const form = document.getElementById('membershipForm');

            // ✅ Show Bootstrap modal
            // $('#confirmationModal').modal('show');
            //form.reset(); // Reset the form
            $(".send_request_btn").text('Loading...')

            submitFormDataByAjax(form)


        }

        function submitFormDataByAjax(formData) {
            const form = $(formData);
            const url = "{{ route('store.influencer') }}";
            const data = new FormData(form[0]);

            console.log('data', data, form);

            // var url = "{{ route('escort.update-my-reports') }}";
            // var data = new FormData(form[0]);

            $.ajax({
                method: 'POST',
                url: url,
                dataType: "json",
                data: data,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log('data jiten', data);

                    $(".send_request_btn").text('Send Request')
                    form[0].reset()
                    if (data.status == true) {

                        // Show modal
                        $('#confirmationModal').modal('show');
                        //document.getElementById('confirmationModal').style.display = 'block';
                        //form[0].reset();
                    } else {
                        swal.fire(
                            'Influencer Request',
                            data.message,
                            data.type === 'found' ? 'success' : 'error'
                        );
                    }

                },
                error: function(xhr) {
                    console.log(xhr.status, );

                    if (xhr.status === 422) {
                        let errors = JSON.parse(xhr.responseText).errors;
                        $('.error-text').remove(); // remove old errors
                        $.each(errors, function(key, value) {
                            let input = $('[name="' + key + '"]');
                            input.after('<span class="text-danger error-text error_text">' + value[0] +
                                '</span>');
                        });
                    } else {
                        swal.fire(
                            'Influencer Request',
                            'Oops.. something wrong Please try again',
                            'error'
                        );
                    }
                }

            });


        }

        function closeModal() {
            // ✅ Hide Bootstrap modal
            $('#confirmationModal').modal('hide');
        }
    </script>
@endpush
