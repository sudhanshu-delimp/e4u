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

        .form-check-inline .form-check-input {
            margin-right: 15px !important
        }

        .form-check {
            margin: 0 60px 0 10px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content start here-->
        <div class="row">
            <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1">Visa & Education</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
            </div>
            <div class="col-md-12">
                <div class="card collapse  mb-4" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>This form will be pre-populated with your details according to what you have
                                entered in <a href="{{ url('escort.profile.information') }} " class="custom_links_design">My
                                    Account</a>.
                                You can alter any of the information.</li>
                            <li>Complete the form to request contact. When completing the form please ensure
                                all of the details are correct and you have selected the correct option for
                                communications.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-5">
                <form id="assistanceRequestFormEscort" class="common-form">
                    @csrf
                    <div class="common-card">
                        <div class="row inner-row">
                            <div class="col-lg-12">
                                <div class="card-top">
                                    <div class="card-icon">
                                        <svg fill="#ff3c5f" width="40px" height="40px" viewBox="0 0 16 16" id="request-send-16px" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="Path_44" data-name="Path 44" d="M-18,11a2,2,0,0,0,2-2,2,2,0,0,0-2-2,2,2,0,0,0-2,2A2,2,0,0,0-18,11Zm0-3a1,1,0,0,1,1,1,1,1,0,0,1-1,1,1,1,0,0,1-1-1A1,1,0,0,1-18,8Zm2.5,4h-5A2.5,2.5,0,0,0-23,14.5,1.5,1.5,0,0,0-21.5,16h7A1.5,1.5,0,0,0-13,14.5,2.5,2.5,0,0,0-15.5,12Zm1,3h-7a.5.5,0,0,1-.5-.5A1.5,1.5,0,0,1-20.5,13h5A1.5,1.5,0,0,1-14,14.5.5.5,0,0,1-14.5,15ZM-7,2.5v5A2.5,2.5,0,0,1-9.5,10h-2.793l-1.853,1.854A.5.5,0,0,1-14.5,12a.493.493,0,0,1-.191-.038A.5.5,0,0,1-15,11.5v-2a.5.5,0,0,1,.5-.5.5.5,0,0,1,.5.5v.793l1.146-1.147A.5.5,0,0,1-12.5,9h3A1.5,1.5,0,0,0-8,7.5v-5A1.5,1.5,0,0,0-9.5,1h-7A1.5,1.5,0,0,0-18,2.5v3a.5.5,0,0,1-.5.5.5.5,0,0,1-.5-.5v-3A2.5,2.5,0,0,1-16.5,0h7A2.5,2.5,0,0,1-7,2.5Zm-7.854,3.646L-12.707,4H-14.5a.5.5,0,0,1-.5-.5.5.5,0,0,1,.5-.5h3a.5.5,0,0,1,.191.038.506.506,0,0,1,.271.271A.5.5,0,0,1-11,3.5v3a.5.5,0,0,1-.5.5.5.5,0,0,1-.5-.5V4.707l-2.146,2.147A.5.5,0,0,1-14.5,7a.5.5,0,0,1-.354-.146A.5.5,0,0,1-14.854,6.146Z" transform="translate(23)"></path> </g></svg>
                                    </div>
                                    <div class="card-heading">
                                        <h2>Request for Assistance</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="inner-field-row">
                                    {{-- Contact Preference --}}
                                    @php
                                        $nameParts = preg_split('/\s+/', trim(Auth::user()->name));
                                        $firstName = $nameParts[0] ?? '';
                                        $lastName =
                                            count($nameParts) > 1 ? implode(' ', array_slice($nameParts, 1)) : '';
                                    @endphp
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input id="first_name" placeholder="First Name" name="first_name"
                                            value="{{ $firstName }}" type="text" class="form-control">

                                        <span class="text-danger error-text first_name_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input id="last_name" placeholder="Last Name" name="last_name"
                                            value="{{ $lastName }}" type="text" class="form-control">

                                        <span class="text-danger error-text last_name_error"></span>
                                    </div>

                                    {{-- Email --}}
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input id="email" placeholder="Email" name="email" type="email"
                                            class="form-control" value="{{ Auth::user()->email }}">

                                        <span class="text-danger error-text email_error"></span>
                                    </div>

                                    {{-- Mobile --}}
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number</label>
                                        <input id="mobile" placeholder="Mobile" name="mobile" type="text"
                                            value="{{ Auth::user()->phone }}" class="form-control">

                                        <span class="text-danger error-text mobile_error"></span>
                                    </div>
                                    
                                    

                                    {{-- Visa Enquiry --}}
                                    <div class="form-group">
                                        <label for="visa_enquiry_type">
                                            Visa enquiry type
                                        </label>

                                        <select class="form-control" id="visa_enquiry_type" name="visa_enquiry_type">

                                            <option value="">--- Select ----------</option>
                                            <option value="020">020 Bridging Visa</option>
                                            <option value="601">601 Electronic Travel Authority</option>
                                            <option value="651">651 eVisitor Visa</option>
                                            <option value="820">820 Partner Visa</option>
                                            <option value="500">500 Student Visa</option>
                                            <option value="485">485 Temporary Graduate Visa</option>
                                            <option value="417">417 Working Holiday Visa</option>
                                            <option value="462">462 Work and Holiday Visa</option>

                                        </select>

                                        <span class="text-danger error-text visa_enquiry_type_error"></span>
                                    </div>
                                    
                                </div>
                                 <div class="inner-field-row">
                                    
                                    {{-- Passport Country --}}
                                    <div class="form-group">
                                        <label for="passport_country">
                                            Passport country of issue
                                        </label>

                                        <input id="passport_country" placeholder="Country of issue eg Thailand"
                                            name="passport_country" type="text" class="form-control">

                                        <p class="cp-hint">
                                            <i> You can disclose this information during your discussion with us if you
                                                prefer</i>
                                        </p>
                                        <span class="text-danger error-text passport_country_error"></span>

                                    </div>
                                    <div class="form-group ">
                                        <label>Your contact preference</label>
                                        <div class="option-list mt-2">
                                            <div class="form-check form-check-inline">
                                                <input name="contact_pref[]" class="form-check-input" type="checkbox"
                                                    id="pref_Email" value="email">
                                                <label class="form-check-label" for="pref_Email">Email</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input name="contact_pref[]" class="form-check-input" type="checkbox"
                                                    id="pref_Mobile" value="mobile">
                                                <label class="form-check-label" for="pref_Mobile">Mobile</label>
                                            </div>
                                        </div>    
                                        <span class="text-danger error-text contact_pref_error"></span>
                                    </div>




                                    {{-- Advice Area --}}
                                    <div class="form-group ">

                                        <label>Indicate which area of advice you are enquiring about </label>

                                        <div class="option-list mt-2">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="advice_visa" name="advice_area" value="visa"
                                                    checked>
                                                <label  class="form-check-label" for="advice_visa"> Visa</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" class="form-check-input" id="advice_education" name="advice_area"
                                                    value="visa_education">
                                                <label class="form-check-label" for="advice_education"> Visa & Education Course</label>
                                            </div>
                                        </div>
                                       

                                        <span class="text-danger error-text advice_area_error"></span>
                                    </div>
                                 </div>
                                <div class="inner-field-row">
                                     {{-- Comments --}}
                                    <div class="form-group">
                                        <label for="comments">Comments</label>

                                        <textarea class="form-control" id="comments" name="comments" rows="10" style="height: 100px; padding-top:10px;"></textarea>
                                         <p class="cp-hint">
                                            <i>Please provide any additional information that may assist</i>
                                        </p>
                                        <span class="text-danger error-text comments_error"></span>
                                    </div>  
                                    
                                </div>
                            </div>
                            <div class="common-footer">
                                <button type="submit" class="common-save-btn" id="submitAssistanceRequest">
                                    Send request
                                </button>
                            </div>
                        </div>
                    </div>
                </form>


                <div id="accordion" class="myacording-design mb-5 mt-5">
                    <div class="card common-card">
                        <div class="card-header">
                            <a class="card-link" data-toggle="collapse" href="#Partnership" aria-expanded="true">
                                Partnership
                            </a>
                        </div>
                        <div id="Partnership" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body pb-0">
                                <p ><b>Partnership</b></p>
                                <p>Escorts4U has partnered with PEAMS Australia Pty Ltd <span>(<b>Partner</b>)</span> a
                                    leading provider of
                                    Visa, Migration and Education placement services <span>(<b>Services</b>)</span> to
                                    provide practical advice to
                                    assist you with compliance under the <i>Migration Act 1958 (Cth)</i>, whilst at the same
                                    time
                                    ensuring your visa type and status suits your needs whilst you are in Australia.</p>
                                <p>They speak English, Cantonese and Mandarin.</p>

                                <p ><b>Available services</b></p>
                                <p>The following Services are available through our Partner:</p>

                                <ol>
                                    <li>Visa and Migration advice including applications, renewals and ongoing assistance
                                    </li>
                                    <li>Education course selection advice including ongoing assistance</li>
                                </ol>

                            </div>
                        </div>
                    </div>
                    <div class="card common-card">
                        <div class="card-header">
                            <a class="card-link" data-toggle="collapse" href="#Other-important-information"
                                aria-expanded="true">
                                Other important information
                            </a>
                        </div>
                        <div id="Other-important-information" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body pb-0">
                                <p><b>Q? What languages do the team members of our Partner speak?</b></p>
                                <p>They speak English, Cantonese and Mandarin.</p>
                                <p><b>Q? What can you tell me about Education courses?</b></p>
                                <p>Are you interested in education? Our Partner can also assist you with education services.
                                    Let us help you with selecting the course that best suits you and your circumstances.
                                </p>
                                <p><b>Q? Can you help me with any initial questions?</b></p>
                                <p>Yes. There are many circumstances were a team member of our Partner can answer basic
                                    questions for no charge. Complete the enquiry form, adding some comments,and we will let
                                    you know.</p>
                                <p><b>Q? Does Escorts4U or the Partner communicate with the Australian Government?</b></p>
                                <p>No. Escorts4U does not undertake any communication with, or report to, the the Australian
                                    Government. Our Partner may undertake enquiries on your behalf should you engage them.
                                    You should direct any questions regarding the Australian Government directly to our
                                    Partner.</p>
                                <p><b>Q? How do I make payment?</p>
                                <p>If you engage our Partner, they will make full disclosure of fees and charges, including
                                    fees payable to the Australian Government, and invoice you directly. Payment is made
                                    directly to our Partner to their nominated bank account, details of which are set out in
                                    the Partner's invoice.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card common-card">
                        <div class="card-header">
                            <a class="card-link" data-toggle="collapse" href="#Confidentiality" aria-expanded="true">
                                Confidentiality
                            </a>
                        </div>
                        <div id="Confidentiality" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body pb-0">
                                <p><b>Q? Who will see my request?</b></p>
                                <p>When you lodge a request for assistance, an email is sent directly to our Partner and a
                                    copy to the Escorts4U team. When our Partner contacts you they will formally introduce
                                    themselves. Escorts4U will not make contact with you. You will also be provided with a
                                    reference, in your confirmation email, for the Partner to verify themselves.</p>
                                <p><b>Q? Who will I be discussing my enquiry with?</b></p>
                                <p>You will be contacted directly by a member of our Partner's team. All conversations will
                                    remain confidential between you and the Partner. Escorts4U does not have any
                                    communications with our Partner regarding your ongoing request or any outcome.</p>
                                <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card common-card">
                        <div class="card-header">
                            <a class="card-link" data-toggle="collapse" href="#Contact-details" aria-expanded="true">
                                Contact details
                            </a>
                        </div>
                        <div id="Contact-details" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body pb-0">
                                <p>You can contact our Partner through either of the following methods:</p>
                                <p>PEAMS Australia Pty Ltd<br>
                                    GPO Box T1756<br>
                                    Perth WA 6845<br>
                                </p><br>
                                <p>T: +61 401 443 354<br>
                                    E: Please complete the Enquiry form
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--middle content end here-->
        
    </div>
    <div class="modal fade upload-modal " id="visa_migration_request" data-backdrop="static" data-keyboard="false"
        role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                            <svg fill="#ff3c5f" width="35px" height="35px" class="pr-2" viewBox="0 0 16 16" id="request-send-16px" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="Path_44" data-name="Path 44" d="M-18,11a2,2,0,0,0,2-2,2,2,0,0,0-2-2,2,2,0,0,0-2,2A2,2,0,0,0-18,11Zm0-3a1,1,0,0,1,1,1,1,1,0,0,1-1,1,1,1,0,0,1-1-1A1,1,0,0,1-18,8Zm2.5,4h-5A2.5,2.5,0,0,0-23,14.5,1.5,1.5,0,0,0-21.5,16h7A1.5,1.5,0,0,0-13,14.5,2.5,2.5,0,0,0-15.5,12Zm1,3h-7a.5.5,0,0,1-.5-.5A1.5,1.5,0,0,1-20.5,13h5A1.5,1.5,0,0,1-14,14.5.5.5,0,0,1-14.5,15ZM-7,2.5v5A2.5,2.5,0,0,1-9.5,10h-2.793l-1.853,1.854A.5.5,0,0,1-14.5,12a.493.493,0,0,1-.191-.038A.5.5,0,0,1-15,11.5v-2a.5.5,0,0,1,.5-.5.5.5,0,0,1,.5.5v.793l1.146-1.147A.5.5,0,0,1-12.5,9h3A1.5,1.5,0,0,0-8,7.5v-5A1.5,1.5,0,0,0-9.5,1h-7A1.5,1.5,0,0,0-18,2.5v3a.5.5,0,0,1-.5.5.5.5,0,0,1-.5-.5v-3A2.5,2.5,0,0,1-16.5,0h7A2.5,2.5,0,0,1-7,2.5Zm-7.854,3.646L-12.707,4H-14.5a.5.5,0,0,1-.5-.5.5.5,0,0,1,.5-.5h3a.5.5,0,0,1,.191.038.506.506,0,0,1,.271.271A.5.5,0,0,1-11,3.5v3a.5.5,0,0,1-.5.5.5.5,0,0,1-.5-.5V4.707l-2.146,2.147A.5.5,0,0,1-14.5,7a.5.5,0,0,1-.354-.146A.5.5,0,0,1-14.854,6.146Z" transform="translate(23)"></path> </g></svg>
                                    
                             Visa Services - Request Confirmation
                        </h5>
                    
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
                <div class="modal-body text-justify" >
                        <h5 class="my-0 custom_modal_text text-justify">
                           Your Request for  Visa Services assistance has been received. You will also receive an
                        A-Alert confirming your request with a reference. If you have not been contacted by a
                        member of the team within 24 hours (of a business day), please raise a Support Ticket
                        quoting the reference.  
                       
                       
                        </h5>
                         
                    </div>
                    
                <div class="modal-footer justify-content-between">
                        <p class="mb-0 custom_modal_text"><b>Date sent: </b> {{ \Carbon\Carbon::now('Australia/Perth')->format('d-m-Y') }}
                        </p>
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <!-- file upload plugin start here -->
    <!-- file upload plugin end here -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    <script type="text/javascript">
        $("#assistanceRequestFormEscort").on("submit", function(e) {
            e.preventDefault();
            let form = this;
            let submitButton = $("#submitAssistanceRequest");

            // Clear previous errors
            $(".error-text").text("");
            submitButton.prop("disabled", true).text("Sending...");
            $.ajax({
                url: "{{ route('visa.migration.store.escort') }}",
                type: "POST",
                data: $(form).serialize(),
                success: function(response) {
                    if (response.status) {
                        $(form)[0].reset();
                        $("#visa_migration_request").modal('show');
                    }
                },
                error: function(xhr) {
                    const messageResponse = JSON.parse(xhr.responseText);
                    if (xhr.status === 422) {
                        let response = JSON.parse(xhr.responseText);
                        let errors = response.errors;
                        $.each(errors, function(field, messages) {
                            let errorField = field.replace(/\./g, "_");
                            $("." + errorField + "_error").text(messages[0]);
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: messageResponse.message
                        });
                    }
                },
                complete: function() {
                    submitButton.prop("disabled", false).text("Send request");
                }
            });
        });
    </script>
@endpush
