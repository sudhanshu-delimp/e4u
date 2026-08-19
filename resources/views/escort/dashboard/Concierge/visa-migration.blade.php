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
            <div class="col-md-9 mb-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="pb-2 pt-2"><b>Partnership</b> </h2>
                                <p>Escorts4U has partnered with PEAMS Australia Pty Ltd <span>(<b>Partner</b>)</span> a
                                    leading provider of
                                    Visa, Migration and Education placement services <span>(<b>Services</b>)</span> to
                                    provide practical advice to
                                    assist you with compliance under the <i>Migration Act 1958 (Cth)</i>, whilst at the same
                                    time
                                    ensuring your visa type and status suits your needs whilst you are in Australia.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <form id="assistanceRequestForm">
                    @csrf

                    <div class="row">
                        <div class="col-md-9">

                            <h2 class="pb-2"><b>Available services</b></h2>
                            <p>The following Services are available through our Partner:</p>

                            <ul>
                                <li>Visa and Migration advice including applications, renewals and ongoing assistance</li>
                                <li>Education course selection advice including ongoing assistance</li>
                            </ul>

                            <h2 class="pb-2"><b>Request for assistance</b></h2>

                            {{-- Contact Preference --}}
                            <div class="form-group">
                                <div>
                                    <label><b>Your contact preference</b></label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input name="contact_pref[]" class="form-check-input" type="checkbox" id="pref_Email"
                                        value="email">
                                    <label class="form-check-label" for="pref_Email">Email</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input name="contact_pref[]" class="form-check-input" type="checkbox" id="pref_Mobile"
                                        value="mobile">
                                    <label class="form-check-label" for="pref_Mobile">Mobile</label>
                                </div>
                                <br>
                                <span class="text-danger error-text contact_pref_error"></span>
                            </div>

                            <b>Your details:</b>
                            <div class="mt-2">

                                {{-- First Name --}}
                                <div class="form-group">
                                    <label for="first_name" class="required"><b>First Name</b></label>
                                    <input id="first_name" placeholder="First Name" name="first_name" type="text"
                                        class="form-control">

                                    <span class="text-danger error-text first_name_error"></span>
                                </div>

                                {{-- Last Name --}}
                                <div class="form-group">
                                    <label for="last_name"><b>Last Name</b></label>
                                    <input id="last_name" placeholder="Last Name" name="last_name" type="text"
                                        class="form-control">

                                    <span class="text-danger error-text last_name_error"></span>
                                </div>

                                {{-- Email --}}
                                <div class="form-group">
                                    <label for="email"><b>Email Address</b></label>
                                    <input id="email" placeholder="Email" name="email" type="email"
                                        class="form-control">

                                    <span class="text-danger error-text email_error"></span>
                                </div>

                                {{-- Mobile --}}
                                <div class="form-group">
                                    <label for="mobile"><b>Mobile Number</b></label>
                                    <input id="mobile" placeholder="Mobile" name="mobile" type="text"
                                        class="form-control">

                                    <span class="text-danger error-text mobile_error"></span>
                                </div>

                            </div>

                            {{-- Passport Country --}}
                            <div class="form-group">
                                <label for="passport_country">
                                    <b>Passport country of issue</b>
                                </label>

                                <input id="passport_country" placeholder="Country of issue eg Thailand"
                                    name="passport_country" type="text" class="form-control">


                                <span>
                                    <i>
                                        You can disclose this information during your discussion with us if you prefer
                                    </i>
                                </span><br>
                                <span class="text-danger error-text passport_country_error"></span>

                            </div>

                            {{-- Advice Area --}}
                            <div class="form-group custom-radio mb-0">
                                <label>
                                    <b>Indicate which area of advice you are enquiring about</b>
                                </label>
                                <br>

                                <input type="radio" id="advice_visa" name="advice_area" value="visa" checked>

                                <label class="m-0" for="advice_visa">Visa</label>

                                <br>

                                <input type="radio" id="advice_education" name="advice_area" value="visa_education">

                                <label for="advice_education">
                                    Visa & Education Course
                                </label>

                                <br>

                                <span class="text-danger error-text advice_area_error"></span>
                            </div>

                            {{-- Visa Enquiry --}}
                            <div class="form-group">
                                <label for="visa_enquiry_type">
                                    <b>Visa enquiry type</b>
                                </label>

                                <select class="form-control" id="visa_enquiry_type" name="visa_enquiry_type">

                                    <option value="">--- Select ----------</option>
                                    <option value="020">020 Bridging Visa</option>
                                    <option value="601">601 Electronic Travel Authority</option>
                                    <option value="651">651 eVisitor Visa</option>
                                    <option value="500">500 Student Visa</option>
                                    <option value="485">485 Temporary Graduate Visa</option>
                                    <option value="417">417 Working Holiday Visa</option>
                                    <option value="462">462 Work and Holiday Visa</option>

                                </select>

                                <span class="text-danger error-text visa_enquiry_type_error"></span>
                            </div>

                            {{-- Comments --}}
                            <div class="form-group">
                                <label for="comments">
                                    <b>Comments</b>
                                    (<i>Please provide any additional information that may assist</i>)
                                </label>

                                <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>

                                <span class="text-danger error-text comments_error"></span>
                            </div>

                        </div>
                    </div>
                    {{-- <input type="checkbox" name="term_condition" value="1">
<label>I agree to the Terms and Conditions</label>
                                <span class="text-danger error-text comments_error"></span>
<br> --}}
                    <button type="submit" class="new-btn-sec btn btn-primary shadow-none" id="submitAssistanceRequest">
                        Send request
                    </button>
                </form>
                <div id="accordion" class="myacording-design mb-5 mt-5">
                    <div class="card ">
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
                    <div class="card ">
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
                    <div class="card ">
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
                    <h5 class="modal-title">
                        Visa Services - Request Confirmation
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <img src="https://staging.e4u.host.powerwebhosting.com.au/assets/app/img/newcross.png"
                            class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
                <div class="modal-body">
                    <p>Your Request for Visa services assistant has been received. You will also receive an
                        A-Alert confirming your request with a reference. If you have not been contacted by a
                        member of the team within 24 hours (of a business day), please raise a Support Ticket
                        quoting the reference.</p>
                    <br>
                    <span><b>Date sent: </b> {{ \Carbon\Carbon::now('Australia/Perth')->format('d-m-Y') }}</span>

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
        // $('#userProfile').parsley({

        // });



        // $('#userProfile').on('submit', function(e) {
        //     e.preventDefault();

        //     var form = $(this);

        //     if (form.parsley().isValid()) {

        //         var url = form.attr('action');
        //         var data = new FormData(form[0]);
        //         $.ajax({
        //             method: form.attr('method'),
        //             url: url,
        //             data: data,
        //             contentType: false,
        //             processData: false,
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             success: function(data) {
        //                 if (!data.error) {
        //                     $.toast({
        //                         heading: 'Success',
        //                         text: 'Details successfully saved',
        //                         icon: 'success',
        //                         loader: true,
        //                         position: 'top-right', // Change it to false to disable loader
        //                         loaderBg: '#9EC600' // To change the background
        //                     });

        //                 } else {
        //                     $.toast({
        //                         heading: 'Error',
        //                         text: 'Records Not update',
        //                         icon: 'error',
        //                         loader: true,
        //                         position: 'top-right', // Change it to false to disable loader
        //                         loaderBg: '#9EC600' // To change the background
        //                     });

        //                 }
        //             },

        //         });
        //     }
        // });
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

        $("#assistanceRequestForm").on("submit", function(e) {
            e.preventDefault();
            let form = this;
            let submitButton = $("#submitAssistanceRequest");

            // Clear previous errors
            $(".error-text").text("");
            submitButton.prop("disabled", true).text("Sending...");

            $.ajax({
                url: "{{ route('visa.migration.store') }}",
                type: "POST",
                data: $(form).serialize(),
                success: function(response) {
                    if (response.status) {
                        $(form)[0].reset();
                        $("#visa_migration_request").modal('show');
                    }
                },
                error: function(xhr) {
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
                            text: "Something went wrong. Please try again."
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
