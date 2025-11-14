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

            <form id="membershipForm" onsubmit="handleFormSubmit(event)">
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="membershipId" class="form-label">Membership ID <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="membershipd" placeholder="Membership ID"
                        name="member_id" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" placeholder="Email Address" name="email"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Social Media Address(es) <span class="text-danger">*</span></label>
                    <div id="socialMediaContainer">
                        <div class="input-group mb-2">
                            <input type="url" class="form-control" name="social_media[]"
                                placeholder="Social Media Address(es)" required>
                        </div>
                    </div>
                    <button type="button" class="common-btn btn-sm py-2" onclick="addSocialMedia()">Add Address</button>
                </div>


                <div class="mb-3">
                    <label for="comments" class="form-label">Comments</label>
                    <textarea class="form-control" id="comments" name="comments" placeholder="Message" rows="3"></textarea>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="ccEmail" checked name="cc_email">
                    <label class="form-check-label" for="ccEmail">CC email to me</label>
                </div>
                <button type="submit" class="common-btn send_request_btn">Send Request</button>
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


    <!-- Modal -->
    <!-- Success Modal -->
    {{-- <div id="confirmationModal" class="modal-overlay" style="display:none;">
        <div class="modal-box">
            <div class="icon">&#10004;</div>
            <p class="message">Thank you for your request.<br>An email has been forwarded.</p>
            <button onclick="closeModal()" class="ok-btn">OK</button>
        </div>
    </div> --}}

    
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content custome_modal_max_width">
         <div class="modal-header main_bg_color border-0">
            <h5 class="modal-title" id="exampleModalLabel" style="color:white">
               <img src="{{ asset('assets/dashboard/img/unblock.png')}}" class="custompopicon">
               Influencer
            </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">
                  <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
               </span>
            </button>
         </div>
         <div class="modal-body text-center">
            <h1 class="popu_heading_style mb-4 mt-4">
               <span id="Lname" class="my_legbox_title">Thank you for your request.<br>An email has been forwarded.</span>
            </h1>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="form-group d-flex align-items-center justify-content-center">
                        <a href="javascript:void(0)" onclick="closeModal()" class="btn-success-modal text-decoration-none text-white" data-dismiss="modal">OK</a>
                    </div>
                </div>
            </div>
         </div> 
      </div>
   </div>
</div>

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
            inputGroup.className = 'input-group mb-2';

            // Create input field
            const input = document.createElement('input');
            input.type = 'url';
            input.name = 'social_media[]';
            input.required = true;
            input.className = 'form-control';
            input.placeholder = 'Social Media Address';

            // Create remove (X) button
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'btn btn-outline-danger ml-2';
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

        function submitFormDataByAjax(formData) 
        {
            const form = $(formData);
            const url = "{{ route('store.influencer') }}";
            const data = new FormData(form[0]);

            console.log('data' , data, form);
            
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
