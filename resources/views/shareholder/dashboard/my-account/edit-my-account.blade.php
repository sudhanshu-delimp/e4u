@extends('layouts.shareholder')
@section('content')
@section('style')
@endsection
@php
    $setting = $staff->shareholder_setting ?? null;
    if (is_array($staff->contact_type)) {
        $contactType = $staff->contact_type;
    } elseif (!empty($staff->contact_type)) {
        $contactType = json_decode($staff->contact_type, true) ?? [];
    } else {
        $contactType = [99999];
    }
@endphp


<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">My Account</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>

                    <ol>
                        <li>Use this feature to keep up to date your personal details.</li>
                        <li>Make sure you take the time to complete everything, it will help you manage your
                            Account much better, especially with communication. If you are not sure about any of the
                            settings, get in touch with our Help Centre by raising a <a
                                href="{{ route('shareholder.submit') }}" class="custom_links_design">Support Ticket</a>.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <!-- ALERT MESSAGE -->
        <div class="col-md-12 mb-3">
            <div id="formAlert" class="alert d-none rounded" role="alert"></div>
        </div>

        <div class="col-md-12 mb-5">
            <div id="accordion" class="myacording-design">
                <div class="card">

                    <div class="card-body" style="border: none;margin-top: 0px;padding-top: 0px;">
                        <form id="userProfile" class="v-form-design"
                            action="{{ route('shareholder.account.update', [$staff->id]) }}" method="POST">
                            @csrf
                            <!-- Start Personal Details -->
                            <input type="hidden" name="user_id" value="{{ $staff->id }}">

                            <!-- Personal Details -->
                            <div class="row">
                                <div class=" mb-3 w-100">
                                    <h5 class="border-bottom pb-1 text-blue-primary">Personal Details</h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10 px-0">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="business_name">Shareholder</label>
                                                <input type="text" class="form-control rounded-0"
                                                    placeholder="Address" name="business_name" id="business_name"
                                                    value="{{ $staff->business_address }}">
                                                <span class="text-danger error-business_name"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="business_address" class="my-agent">Address</label>
                                                <input type="text" class="form-control rounded-0"
                                                    placeholder="Address" name="business_address" id="business_address"
                                                    value="{{ $staff->business_address }}">
                                                <span class="text-danger error-business_address"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="my-agent">Contact</label>
                                                <input type="text" class="form-control rounded-0"
                                                    placeholder="Address" name="contact_person" id="contact_person"
                                                    value="{{ $staff->contact_person }}">
                                                <span class="text-danger error-contact_person"></span>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone" class="my-agent">Mobile</label>
                                                <input type="text" class="form-control rounded-0" placeholder="Phone"
                                                    name="phone" id="phone" value="{{ $staff->phone }}">
                                                <span class="text-danger error-phone"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <span class="form-control form-back">{{ $staff->email }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- Building Security -->
                            <div class="row">
                                <div class=" mb-3 w-100">
                                    <h5 class="border-bottom pb-1 text-blue-primary">Method of Contact</h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10 px-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-check form-check-inline ml-0">
                                                    <input class="form-check-input" type="checkbox" id="text"
                                                        name="contact_type[]" value="2"
                                                        @if (!empty($contactType)) {{ in_array(2, $contactType) ? 'checked' : null }} @endif>
                                                    <label class="form-check-label" for="text">Text</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="email"
                                                        name="contact_type[]" value="3"
                                                        @if (!empty($contactType)) {{ in_array(3, $contactType) ? 'checked' : null }} @endif>
                                                    <label class="form-check-label" for="email">Email</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="call_me"
                                                        name="contact_type[]" value="4"
                                                        @if (!empty($contactType)) {{ in_array(4, $contactType) ? 'checked' : null }} @endif>
                                                    <label class="form-check-label" for="call_me">Call me</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Start 2FA -->
                            <div class="row">
                                <div class="col-md-10 px-0">
                                    <p>&nbsp;</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5 class="border-bottom pb-1 text-blue-primary">Idle Time Preference
                                                </h5>

                                                <p>
                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="idle_preference_time" id="edit_idle_preference_time_15"
                                                        value="15"
                                                        {{ $setting && $setting->idle_preference_time === '15' ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="edit_idle_preference_time_15">15 minutes</label>
                                                </div>

                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="idle_preference_time" id="edit_idle_preference_time_30"
                                                        value="30"
                                                        {{ $setting && $setting->idle_preference_time === '30' ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="edit_idle_preference_time_30">30 minutes</label>
                                                </div>

                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="idle_preference_time" id="edit_idle_preference_time_60"
                                                        value="60"
                                                        {{ $setting && $setting->idle_preference_time === '60' ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="edit_idle_preference_time_60">60 minutes</label>
                                                </div>

                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="idle_preference_time"
                                                        id="edit_idle_preference_time_never"
                                                        value="{{ config('staff.idle_vever_minute') }}"
                                                        {{ $setting && $setting->idle_preference_time === config('staff.idle_vever_minute') ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="edit_idle_preference_time_never">Never</label>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10 px-0">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <h5 class="border-bottom pb-1 text-blue-primary">2FA Authentication
                                                </h5>
                                                <p>
                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="twofa"
                                                        id="edit_twofa_1" value="1"
                                                        {{ $setting && $setting->twofa == 1 ? 'checked' : 'checked' }}>
                                                    <label class="form-check-label" for="edit_twofa_1">Email</label>
                                                </div>

                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="twofa"
                                                        id="edit_twofa_2" value="2"
                                                        {{ $setting && $setting->twofa == 2 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="edit_twofa_2">Text</label>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End 2FA -->

                            <input type="submit" value="save" class="btn btn-primary shadow-none float-right"
                                name="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <!-- Shareholder update -->
    <script type="text/javascript">
        $('#userProfile').parsley({

        });
        // new
        $('#userProfile').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var alertBox = $('#formAlert');
            if (form.parsley().isValid()) {

                var url = form.attr('action');
                var data = new FormData(form[0]);
                $('span.text-danger').text('');

                swal_waiting_popup({
                    'title': 'Saving Shareholder Details'
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
