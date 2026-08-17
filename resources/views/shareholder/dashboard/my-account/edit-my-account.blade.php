@extends('layouts.shareholder')
@section('content')
@section('style')
<style>
    i{
        font-size: 16px;
    }
</style>
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
    $contactKey = 0;
    $max_shareholder_key_contact_create = config('constants.max_shareholder_key_contact_create');
    $contactKeyNumber = 1;
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
                   <h3 class="NotesHeader"><b>Notes:</b></h3>

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
                            <!-- Start Shareholder Details -->
                            <input type="hidden" name="user_id" value="{{ $staff->id }}">

                            <!-- Shareholder Details -->
                            <div class="row">
                                <div class=" mb-3 w-100">
                                    <h5 class="border-bottom pb-1 text-blue-primary">Shareholder Details</h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10 px-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="business_name">Shareholder</label>
                                                <span class="form-control form-back">{{ $staff->business_name }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="business_address">Address</label>
                                                <input type="text" class="form-control rounded-0"
                                                    placeholder="Address" name="business_address" id="business_address"
                                                    value="{{ $staff->business_address }}">
                                                <span class="text-danger error-business_address"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Start of Primary contact -->
                                    <div class="col-md-12 ml-2">
                                        <div class="row">
                                            <div class=" mb-3 w-100">
                                                <h5 class="border-bottom pb-1 text-blue-primary">Primary Contact</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contact_person">Contact</label>
                                                     <input type="text" class="form-control rounded-0"
                                                    placeholder="Contact" name="contact_person" id="contact_person"
                                                    value="{{ $staff->contact_person }}">
                                                <span class="text-danger error-contact_person"></span>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">Mobile</label>
                                                   <input type="text" class="form-control rounded-0" placeholder="Phone"
                                                    name="phone" id="phone" value="{{ $staff->phone }}" oninput="this.value = this.value.replace(/\D/g,'');"
                onfocus="this.value = this.value.replace(/\D/g,'');" onblur="formatMobile(this)">
                                                <span class="text-danger error-phone"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="text" class="form-control rounded-0"
                                                        placeholder="Email" name="email" id="email"
                                                        value="{{ $staff->email }}">
                                                    <span class="text-danger error-email"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Primary contact -->

                                    <!-- Start of Key contact -->
                                    <div id="conatct-container-edit">
                                        <!-- Key Contact -->
                                        @if ($staff->contacts)
                                            @foreach ($staff->contacts as $contact)
                                                <div class="key-contact-info-edit my-3"
                                                    id="keyContectNode_{{ $contact->id }}">
                                                    <input type="hidden" name="contact_id[]"
                                                        value="{{ $contact->id }}">
                                                    <div class="col-md-12  ml-2">
                                                        <div class="row">
                                                            <div class=" mb-3 w-100">
                                                                <h5 class="border-bottom pb-1 text-blue-primary">Key
                                                                    Contact
                                                                    {{ $contactKeyNumber }}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="row addDeleteButton">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="contact_person">Contact</label>
                                                                    <input type="tel" maxlength="100"
                                                                        autocomplete="off"
                                                                        class="form-control rounded-0"
                                                                        name="key_contact_name[]"
                                                                        value="{{ $contact->name }}">
                                                                    <span
                                                                        class="text-danger error-key_contact_name.{{ $contactKey }}"></span>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="phone">Mobile</label>
                                                                    <input type="tel" maxlength="15"
                                                                        autocomplete="off"
                                                                        class="form-control rounded-0"
                                                                        name="key_contact_phone[]"
                                                                        oninput="this.value = this.value.replace(/\D/g,'');"
                                                                        value="{{ $contact->mobile }}"
                                                                        onfocus="this.value = this.value.replace(/\D/g,'');"
                                                                        onblur="formatMobile(this)">
                                                                    <span
                                                                        class="text-danger error-key_contact_phone.{{ $contactKey }}"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email">Email</label>
                                                                    <input type="text"
                                                                        class="form-control rounded-0"
                                                                        placeholder="Email" name="key_contact_email[]"
                                                                        value="{{ $contact->email }}">
                                                                    <span
                                                                        class="text-danger error-key_contact_email.{{ $contactKey }}"></span>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-center col-6 deleteButton">
                                                                <button type="button" class="btn-cancel-modal"
                                                                    style="padding:13px 21px;"
                                                                    onClick="deleteKeyContact({{ $contact->id }})">
                                                                    <i class="fa fa-times text-white"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $contactKey = $contactKey + 1;
                                                    $contactKeyNumber = $contactKeyNumber + 1;
                                                @endphp
                                            @endforeach
                                        @endif

                                    </div>
                                    @if ($contactKey < $max_shareholder_key_contact_create)
                                        <div class="col-6 mb-3"><button class="btn-success-modal" type="button"
                                                id="add-more-contact-edit">Add Key
                                                Contact</button></div>
                                    @endif
                                    <!-- End of Key contact -->

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
                                                    <input class="form-check-input" type="checkbox" id="Method_Text"
                                                        name="contact_type[]" value="2"
                                                        @if (!empty($contactType)) {{ in_array(2, $contactType) ? 'checked' : null }} @endif>
                                                    <label class="form-check-label" for="Method_Text">Text</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="Method_Email"
                                                        name="contact_type[]" value="3"
                                                        @if (!empty($contactType)) {{ in_array(3, $contactType) ? 'checked' : null }} @endif>
                                                    <label class="form-check-label" for="Method_Email">Email</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="Method_Call"
                                                        name="contact_type[]" value="4"
                                                        @if (!empty($contactType)) {{ in_array(4, $contactType) ? 'checked' : null }} @endif>
                                                    <label class="form-check-label" for="Method_Call">Call me</label>
                                                </div>
                                            </div>
                                              <span class="text-danger error-contact_type"></span>
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
                                                
                                                <div class="pt-1">
                                                    <i>Set the Idle time before you are logged out of your Console.</i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10 px-0">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                            <h5 class="border-bottom pb-1 text-blue-primary">2FA Authentification
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
                                                <div class="pt-1">
                                                    <i>How your authentication code will be sent to you.</i>
                                                </div>
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<!-- Shareholder update -->
<script type="text/javascript">
    //$('#userProfile').parsley({

   // });
    // new
    $('#userProfile').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var alertBox = $('#formAlert');
       // if (form.parsley().isValid()) {

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
                           
                            if (field.includes('.')) {
                                 console.log("Message:",field, messages);
                                // ARRAY FIELD (key_contact_person.0)
                                    let parts = field.split('.');
                                    let name = parts[0] + '[]';
                                    let index = parts[1];
                                    let input = $('[name="' + name + '"]').eq(index);
                                    $('.error-' + field.replace('.', '\\.')).text(messages[0]);
                                   

                            } else {
                                $('.error-' + field).text(messages[0]);
                            }
                        });
                    } else {
                        alertBox
                            .removeClass('d-none alert-success')
                            .addClass('alert-danger')
                            .html('Oops... something went wrong. Please try again.');
                    }
                },
            });
       // }
    });

    $(document).ready(function() {
        var addedMaxKeyContactMain = addedMaxKeyContact = parseInt("{{ $contactKey }}");

        if (addedMaxKeyContact == 1) {
            addedMaxKeyContact = addedMaxKeyContact - 1;
        }
        if (addedMaxKeyContact == 2) {
            addedMaxKeyContact = addedMaxKeyContact - 2;
        }

        const maxContacts = parseInt("{{ $max_shareholder_key_contact_create }}");
        maxContactsEdit = maxContacts - addedMaxKeyContact;

        function updateHeadings() {
            $(".key-contact-info-edit").each(function(index) {
                $(this).find("h5").text("Key Contact " + parseInt(index + 1));
            });
        }
        $("#add-more-contact-edit").click(function(e) {
            e.preventDefault();

            let contactCount = $(".key-contact-info-edit").length;
            if (contactCount == 0) {
                contactCount = 0;
            }

            if (contactCount >= maxContactsEdit) {
               // alert("You can only add up to 3 Key Contacts.");
                 swal_error_popup("You can only add up to 3 Key Contacts.");
                return;
            }
            if (contactCount == 0) {
                var newContact = $(".key-contact-info").first().clone();
                newContact.find('.deleteButton').remove();
                // replace class
                newContact.removeClass("key-contact-info").addClass("key-contact-info-edit");
            } else {
                var newContact = $(".key-contact-info-edit").first().clone();
                newContact.find('.deleteButton').remove();

            }
            var index1 = addedMaxKeyContactMain;
            newContact.find('span.text-danger').each(function() {

                let classes = $(this).attr('class');

                if (classes.includes('error-key_contact_name')) {
                    $(this).attr('class', 'text-danger error-key_contact_name.' + index1);
                }

                if (classes.includes('error-key_contact_phone')) {
                    $(this).attr('class', 'text-danger error-key_contact_phone.' + index1);
                }

                if (classes.includes('error-key_contact_email')) {
                    $(this).attr('class', 'text-danger error-key_contact_email.' + index1);
                }
                
            });



            // Clear input values
            newContact.find("input").val("");

            // Add remove button only for cloned ones
            if (newContact.find(".btn-remove").length === 0) {
                /*  newContact.append(`
                <div class="d-flex align-items-end col-6">
                    <button type="button" class="btn-cancel-modal btn-remove">
                        <i class="fa fa-times text-white"></i>
                    </button>
                </div>
            `); */
                newContact.find('.addDeleteButton').append(`
        <div class="col-md-6 d-flex align-items-end">
            <button type="button" class="btn-cancel-modal btn-remove" style="padding:13px 21px;"> 
                <i class="fa fa-times text-white"></i>
            </button>
        </div>
    `);
            }

            $("#conatct-container-edit").append(newContact);

            updateHeadings();
        });

        // Remove contact row
        $(document).on("click", ".btn-remove", function() {
            $(this).closest(".key-contact-info-edit").remove();
            updateHeadings(); // re-update after delete
        });

        // Initial call
        updateHeadings();
    });

    

     async function deleteKeyContact(id) {

    const confirmed = await isConfirm({
        action: 'Delete',
        text: 'Are you sure you want to delete this contact?'
    });

    if (confirmed) {
        $.ajax({
            url: "{{ route('shareholder.delete.shareholder.contact') }}",
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: id
            },
            success: function(response) {
                if (response.status) {
                    swal_success_popup(response.message);
                    $('#keyContectNode_' + id).remove();
                } else {
                    swal_error_popup(response.message || 'Something went wrong');
                }
                setTimeout(function() {
                    location.reload();
                }, 3000);
            },
            error: function(xhr) {
                swal_error_popup("Something went wrong!");
            }
        });
    }
}
</script>
@endpush
<div style="display: none" id="keyContactFormData">
<div class="key-contact-info my-3 row  ml-2">
    <div class="col-12">
        <h5>Key Contact</h5>
    </div>
    <div class=" ml-2 row addDeleteButton">
        <div class="col-6 mt-2">
            <input type="hidden" name="contact_id[]" value="">
            <label class="form-check-label" for="contact">Contact</label>
            <input type="tel" maxlength="100" autocomplete="off" class="form-control rounded-0"
                name="key_contact_name[]">
            <span class="text-danger error-key_contact_name.1"></span>
        </div>
        <div class="col-6 mt-2">
            <label class="form-check-label" for="phone">Mobile</label>
            <input type="tel" maxlength="15" autocomplete="off" class="form-control rounded-0"
                name="key_contact_phone[]" oninput="this.value = this.value.replace(/\D/g,'');"
                onfocus="this.value = this.value.replace(/\D/g,'');" onblur="formatMobile(this)">
            <span class="text-danger error-key_contact_phone.1"></span>
        </div>
        <div class="col-6 mt-2">
            <label class="form-check-label" for="email">Email</label>
            <input type="email" class="form-control rounded-0" name="key_contact_email[]">
            <span class="text-danger error-key_contact_email.1"></span>
        </div>
    </div>
</div>
</div>
