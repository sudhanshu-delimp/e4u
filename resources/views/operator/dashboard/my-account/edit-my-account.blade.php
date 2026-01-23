@extends('layouts.operator')
@section('style')
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
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 opr-console">
        <!--middle content start here-->
        <!-- Page Heading -->
        <div class="row">
            @php
                $agreementDate = '';
               /*  $states = config('escorts.profile.states');
                $stateName = isset($states[$operator->state_id]['stateName'])
                    ? $states[$operator->state_id]['stateName']
                    : ''; */
                if (is_array($operator->contact_type)) {
                    $contactType = $operator->contact_type;
                } elseif (!empty($operator->contact_type)) {
                    $contactType = json_decode($operator->contact_type, true) ?? [];
                } else {
                    $contactType = [99999];
                }
                if (!empty($operator->operator_detail->agreement_date)) {
                    $agreementDate = showDateWithFormat($operator->operator_detail->agreement_date, 'd-m-Y');
                }

                  // print_r($contactType);die;

            $countries = config('operator.country');
            $countryName = isset($countries[$operator->country_id]['name']) ? $countries[$operator->country_id]['name'] : '';
    
            @endphp



            <div class="operator-heading-wrapper col-lg-12">
                <h1 class="h1">Edit My Account</h1>
                <span class="oprhelpNote font-weight-bold" data-toggle="collapse" data-target="#notes"
                    aria-expanded="true">Help?</span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="notes"><b>Notes:</b> </p>
                        <ol>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- end --}}
        <div class="row">

            <div class="col-md-12 commanAlert"></div>

            <!-- ALERT MESSAGE -->
            <div class="col-md-12 mb-3">
                <div id="formAlert" class="alert d-none rounded" role="alert"></div>
            </div>
            <div class="col-md-12 mb-5">
                <div id="accordion" class="myacording-design">
                    <div class="card">
                        <div class="card-header">
                            <a class="card-link" data-toggle="collapse" href="#Abbreviations" aria-expanded="true">
                                About Us
                            </a>
                        </div>
                        <div id="Abbreviations" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body">
                                {{-- 
                     <form id="userProfile" class="v-form-design"> --}}
                                <form id="userProfile" class="v-form-design"
                                    action="{{ route('operator.account.update', [$operator->id]) }}" method="POST">
                                    <input type="hidden" name="user_id" value="{{ $operator->id }}">
                                    <input type="hidden" name="_token">
                                    <div class="row">
                                        <div class="col-md-10 px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="membership_num">Membership Number</label>
                                                        <span
                                                            class="form-control form-back">{{ $operator->member_id }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="membership_num">Date Appointed</label>
                                                        <label
                                                            class="form-control form-back">{{ showDateWithFormat($operator->operator_detail->date_appointed, 'd-m-Y') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="company_name">Company Name</label>
                                                        <input type="text" class="form-control" name="company_name"
                                                            placeholder=" Company Name" aria-describedby="emailHelp"
                                                            value="{{ $operator->name }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="my_name">Business Name</label>
                                                        <input type="text" class="form-control" name="business_name"
                                                            placeholder=" Business Name" aria-describedby="emailHelp"
                                                            value="{{ $operator->business_name }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="my_name" class="my-agent">ABN</label>
                                                        <input type="txt" class="form-control" id="mobileno"
                                                            aria-describedby="emailHelp" name="abn" id="abn"
                                                            data-parsley-maxlength="12" required placeholder="ABN"
                                                            data-parsley-required-message="Your ABN is required"
                                                            value="{{ $operator->abn }}" data-parsley-type="integer"
                                                            data-parsley-type-message="Enter only numbers">
                                                        <span class="text-danger error-abn"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="business_address">Business Address</label>
                                                        <input type="text" class="form-control" name="business_address"
                                                            id="business_address" placeholder="Business Address "
                                                            aria-describedby="emailHelp"
                                                            value="{{ $operator->business_address }}" required>
                                                        <span class="text-danger error-business_address"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="business_number">Business Number</label>
                                                        <input type="txt" class="form-control" name="business_number"
                                                            id="business_number" data-parsley-maxlength="10" required
                                                            oninput="this.value = this.value.replace(/\D/g,'');" 
                                                            placeholder="Business Number"
                                                            data-parsley-required-message="Your Business Number is required"
                                                            value="{{ removeAnythingExceptNumber($operator->business_number) }}"
                                                            data-parsley-type="digits"
                                                            data-parsley-type-message="Enter only numbers">
                                                        <span class="text-danger error-business_number"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="mobile">Point of Contact</label>
                                                        <input type="text" class="form-control"
                                                            name="point_of_contact" id="point_of_contact"
                                                            aria-describedby="emailHelp"
                                                            value="{{ $operator->operator_detail->point_of_contact }}"
                                                            required>
                                                        <span class="text-danger error-point_of_contact"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="mobileno">Mobile</label>
                                                        {{--  <input type="txt" class="form-control" id="mobileno" aria-describedby="emailHelp" name="phone" data-parsley-maxlength="10" required  placeholder="Mobile Number" data-parsley-required-message="Your mobile number is required" value="{{ $operator->phone }}" data-parsley-type="digits" data-parsley-type-message="Enter only mobile numbers" > --}}
                                                        <span class="form-control form-back">{{ $operator->phone }}</span>
                                                        <span class="text-danger error-phone"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{{ __('Email') }}</label>
                                                        <label class="form-control form-back" placeholder=" "
                                                            aria-describedby="emailHelp">{{ $operator->email }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="mobile">Territory</label>
                                                        <label class="form-control form-back"
                                                            aria-describedby="emailHelp">{{ $countryName }} </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <h5 for="mobile">Method of contact - how we communicate with you</h5>
                                                    <div class="form-group custom--contact">

                                                        <div class="form-check-inline">
                                                            <label class="customradio mr-4">
                                                                <input type="checkbox" name="contact_type[]"
                                                                    value="1"
                                                                    @if (!empty($contactType)) {{ in_array(1, $contactType) ? 'checked' : null }}
                                              @else
                                                checked @endif>
                                                                <span class="radiotextsty">Message (via Console)</span>
                                                            </label>

                                                            <label class="customradio mr-4">
                                                                <input type="checkbox" name="contact_type[]"
                                                                    value="2"
                                                                    @if (!empty($contactType)) {{ in_array(2, $contactType) ? 'checked' : null }} @endif>
                                                                <span class="radiotextsty">Text</span>
                                                            </label>

                                                            <label class="customradio mr-4">
                                                                <input type="checkbox" name="contact_type[]"
                                                                    value="3"
                                                                    @if (!empty($contactType)) {{ in_array(3, $contactType) ? 'checked' : null }} @endif>
                                                                <span class="radiotextsty">Email</span>
                                                            </label>

                                                            <label class="customradio mr-4">
                                                                <input type="checkbox" name="contact_type[]"
                                                                    value="4"
                                                                    @if (!empty($contactType)) {{ in_array(4, $contactType) ? 'checked' : null }} @endif>
                                                                <span class="radiotextsty">Call me</span>
                                                            </label>
                                                            <span class="text-danger error-contact_type[]"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" name="submit" class="opr-common-btn">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <a class="card-link collapsed" data-toggle="collapse" href="#lingo"
                                aria-expanded="false">Agreement</a>
                        </div>
                        <div id="lingo" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body">
                                <form id="userProfile2" class="v-form-design" novalidate="">
                                    <input type="hidden" name="_token">
                                    <div class="row">
                                        <div class="col-md-10 px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="membership_num">Agreement Date</label>
                                                        <span class="form-control form-back"> {{ $agreementDate }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="membership_num">Term</label>
                                                        <span
                                                            class="form-control form-back">{{ $operator->operator_detail->term }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="mobile">Fee</label>
                                                        <label class="form-control form-back"
                                                            aria-describedby="emailHelp">{{ $operator->operator_detail->fee }}</label>
                                                    </div>
                                                </div>
                                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <h5 for="mobile">Your Agreement</h5>
                                       <label>You can retrieve your Agent Management Agreement by clicking
                                          <a download="true" href="{{ asset('assets/dashboard/agreement/Agent-Management-Agreement-(02-2025).pdf') }}" download="" 
                                             class="custom_links_design">
                                             <span style="color: var(--color-orange: #f5841f;)">here</span>.
                                          </a>       
                                    </div>
                                 </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <a class="card-link collapsed" data-toggle="collapse" href="#abbrieviations"
                                aria-expanded="false">Fees (clause 7 - Agent Management Agreement)</a>
                        </div>
                        <div id="abbrieviations" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body">
                                <form id="userProfile3" class="v-form-design" novalidate="">
                                    <input type="hidden" name="_token">
                                    <div class="row">
                                        <div class="col-md-10 px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="membership_num">Advertising
                                                        </label>
                                                        <span
                                                            class="form-control form-back">{{ $operator->operator_detail->commission_advertising_percent }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="membership_num">Massage Centre (Membership)</label>
                                                        <label class="form-control form-back" placeholder=" "
                                                            aria-describedby="emailHelp">{{ $operator->operator_detail->commission_massage_centre_percent }}</label>
                                                    </div>
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
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript">
        $('#userProfile').parsley({});
        $('#userProfile').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            var alertBox = $('#formAlert');
            if (form.parsley().isValid()) {
                var url = form.attr('action');
                var data = new FormData(form[0]);
                $('span.text-danger').text('');

                swal_waiting_popup({
                    'title': 'Saving Operator Details.'
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
    </script>
@endpush
