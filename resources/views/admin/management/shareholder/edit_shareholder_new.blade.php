@php
    $setting = $shareholder->shareholder_setting ?? null;
    if (is_array($shareholder->contact_type)) {
        $contactType = $shareholder->contact_type;
    } elseif (!empty($shareholder->contact_type)) {
        $contactType = json_decode($shareholder->contact_type, true) ?? [];
    } else {
        $contactType = [];
    }
    $contactKey = 0;
    $max_shareholder_key_contact_create = config('constants.max_shareholder_key_contact_create');
    $contactKeyNumber = 1;

@endphp

<form name="add_shareholder" id="add_shareholder" method="POST" action="{{ route('admin.store-shareholder') }}"
    enctype="multipart/form-data">
    <div class="row">
        <!-- Section: Personal Details -->
        <div class="col-12 my-2">
            <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
        </div>

        <div class="col-6 mb-3">
            <input type="hidden" name="user_id" value="{{ $shareholder->id }}">
            <label class="form-check-label" for="name">Shareholder</label>
            <input type="text" class="form-control rounded-0" name="business_name" id="business_name_edit"
                value="{{ $shareholder->business_name }}">
            <span class="text-danger error-business_name"></span>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="business_address">Address</label>
            <input type="text" class="form-control rounded-0" name="business_address" id="business_address_edit"
                value="{{ $shareholder->business_address }}">
            <span class="text-danger error-business_address"></span>
        </div>
        {{--      <div class="col-6 mb-3">
            <label class="form-check-label" for="contact">Contact</label>
            <input type="tel" maxlength="100" autocomplete="off" class="form-control rounded-0"
                name="contact_person" id="contact_person_edit" value="{{ $shareholder->contact_person }}">
            <span class="text-danger error-contact_person"></span>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="phone">Mobile</label>
            <input type="tel" maxlength="10" autocomplete="off" class="form-control rounded-0" name="phone"
                id="phone_edit" oninput="this.value = this.value.replace(/\D/g,'');" value="{{ $shareholder->phone }}">
            <span class="text-danger error-phone"></span>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="email_edit">Email</label>
            <input type="email" class="form-control rounded-0" name="email" id="email_edit"
                value="{{ $shareholder->email }}">
            <span class="text-danger error-email"></span>
        </div> --}}

        <div class="col-12" id="conatct-container-edit">
            <div class="contact-info2 my-3 row">
                <div class="col-12">
                    <h5> Primary Contact</h5>
                </div>
                <div class="col-6 mt-2">
                    <label class="form-check-label" for="contact">Contact</label>
                    <input type="tel" maxlength="100" autocomplete="off" class="form-control rounded-0"
                        name="contact_person" id="contact_person" value="{{ $shareholder->contact_person }}">
                    <span class="text-danger error-contact_person"></span>
                </div>
                <div class="col-6 mt-2">
                    <label class="form-check-label" for="phone">Mobile</label>
                    <input type="tel" maxlength="14" autocomplete="off" class="form-control rounded-0 formatMobile"
                        name="phone" id="phone" oninput="this.value = this.value.replace(/\D/g,'');"
                        value="{{ $shareholder->phone }}" onfocus="this.value = this.value.replace(/\D/g,'');">
                    <span class="text-danger error-phone"></span>
                </div>
                <div class="col-6 mt-2">
                    <label class="form-check-label" for="email">Email</label>
                    <input type="email" class="form-control rounded-0" name="email" id="email"
                        value="{{ $shareholder->email }}">
                    <span class="text-danger error-email"></span>
                </div>
            </div>
            <!-- Key Contact -->
            @if ($shareholder->contacts)
                @foreach ($shareholder->contacts as $contact)
                    <div class="key-contact-info-edit my-3 row" id="keyContectNode_{{ $contact->id }}">
                        <div class="col-12">
                            <h5>Key Contact {{ $contactKeyNumber }}</h5>
                        </div>
                        <div class="col-6 mt-2">
                            <input type="hidden" name="contact_id[]" value="{{ $contact->id }}">
                            <label class="form-check-label" for="contact">Contact</label>
                            <input type="tel" maxlength="100" autocomplete="off" class="form-control rounded-0"
                                name="key_contact_name[]" value="{{ $contact->name }}">
                            <span class="text-danger error-key_contact_name.{{ $contactKey }}"></span>
                        </div>
                        <div class="col-6 mt-2">
                            <label class="form-check-label" for="phone">Mobile</label>
                            <input type="tel" maxlength="15" autocomplete="off"
                                class="form-control rounded-0 formatMobile" name="key_contact_phone[]"
                                oninput="this.value = this.value.replace(/\D/g,'');" value="{{ $contact->mobile }}"
                                onfocus="this.value = this.value.replace(/\D/g,'');">
                            <span class="text-danger error-key_contact_phone.{{ $contactKey }}"></span>
                        </div>
                        <div class="col-6 mt-2">
                            <label class="form-check-label" for="email">Email</label>
                            <input type="email" class="form-control rounded-0" name="key_contact_email[]"
                                value="{{ $contact->email }}">
                            <span class="text-danger error-key_contact_email.{{ $contactKey }}"></span>
                        </div>
                        <div class="d-flex align-items-end col-6 deleteButton">
                            <button type="button" class="btn-cancel-modal"
                                onClick="deleteKeyContact({{ $contact->id }})">
                                <i class="fa fa-times text-white"></i>
                            </button>
                        </div>
                    </div>
                    @php
                        $contactKey = $contactKey + 1;
                        $contactKeyNumber = $contactKeyNumber + 1;
                    @endphp
                @endforeach
            @endif
            <!-- End Key Contact -->
        </div>
        @if ($contactKey < $max_shareholder_key_contact_create)
            <div class="col-6 mb-3"><button class="btn-success-modal" type="button" id="add-more-contact-edit">Add
                    Key
                    Contact</button></div>
        @endif

        <div class="col-12 mb-3">
            <h6 class="border-bottom pb-1 text-blue-primary">Method of Contact:</h6>
            <div class="d-flex align-items-center justify-content-start gap-10 flex-wrap">

                {{-- <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_1"
                                        name="contact_type[]" value="1">
                                    <label class="form-check-label" for="viewer_contact_type_1">Messaging</label>
                                </div> --}}
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_2_edit"
                        name="contact_type[]" value="2" {{ in_array('2', $contactType) ? 'checked' : '' }}>
                    <label class="form-check-label" for="viewer_contact_type_2">Text</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_3_edit"
                        name="contact_type[]" value="3" {{ in_array('3', $contactType) ? 'checked' : '' }}>
                    <label class="form-check-label" for="viewer_contact_type_3">Email</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="viewer_contact_type_4_edit"
                        name="contact_type[]" value="4" {{ in_array('4', $contactType) ? 'checked' : '' }}>
                    <label class="form-check-label" for="viewer_contact_type_4">Call Us</label>
                </div>

            </div>
            <span class="text-danger error-contact_type"></span>
        </div>
        <div class="col-12">

            <div class="form-group">
                <h6 class="border-bottom pb-1 text-blue-primary">Idle Time Preference</h6>

                <div class="form-check form-check-inline ml-0">
                    <input class="form-check-input" type="radio" name="idle_preference_time"
                        id="idle_preference_time_15_edit" value="15"
                        {{ $setting && $setting->idle_preference_time === '15' ? 'checked' : '' }}>
                    <label class="form-check-label" for="idle_preference_time_15_edit">15
                        minutes</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="idle_preference_time"
                        id="idle_preference_time_30_edit" value="30"
                        {{ $setting && $setting->idle_preference_time === '30' ? 'checked' : '' }}>

                    <label class="form-check-label" for="idle_preference_time_30_edit">30
                        minutes</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="idle_preference_time"
                        id="idle_preference_time_60" value="60">
                    <label class="form-check-label" for="idle_preference_time_60"
                        {{ $setting && $setting->idle_preference_time === '60' ? 'checked' : '' }}>60
                        minutes</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="idle_preference_time"
                        id="idle_preference_time_never_edit" value="{{ config('staff.idle_vever_minute') }}"
                        {{ $setting && $setting->idle_preference_time === config('staff.idle_vever_minute') ? 'checked' : '' }}>
                    <label class="form-check-label" for="idle_preference_time_never_edit">Never</label>
                </div>
            </div>
            <div class="form-group">
                <h6 class="border-bottom pb-1 text-blue-primary">2FA Authentification</h6>

                <div class="form-check form-check-inline ml-0">
                    <input class="form-check-input" type="radio" name="twofa" id="twofa_1_edit" value="1"
                        {{ $setting && $setting->twofa == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="twofa_1_edit">Email</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="twofa" id="twofa_2_edit" value="2"
                        {{ $setting && $setting->twofa == 2 ? 'checked' : '' }}>

                    <label class="form-check-label" for="twofa_2_edit">Text</label>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer p-0">
        <button type="submit" class="btn-success-modal m-0">Update</button>
        <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">Cancel</button>
    </div>
</form>

<script>
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

            console.log("maxContactsEdit");


            if (contactCount >= maxContactsEdit) {
                alert("You can only add up to 3 Kay Contacts.");
                return;
            }
            if (contactCount == 0) {
                var newContact = $(".key-contact-info").first().clone();
                // replace class
                newContact.removeClass("key-contact-info").addClass("key-contact-info-edit");
                newContact.find('.deleteButton').remove();
            } else {
                var newContact = $(".key-contact-info-edit").first().clone();
                 newContact.find('.deleteButton').remove();
                var index = addedMaxKeyContactMain;

                newContact.find('span.text-danger').each(function() {

                    let classes = $(this).attr('class');

                    if (classes.includes('error-key_contact_name')) {
                        $(this).attr('class', 'text-danger error-key_contact_name.' + index);
                    }

                    if (classes.includes('error-key_contact_phone')) {
                        $(this).attr('class', 'text-danger error-key_contact_phone.' + index);
                    }

                    if (classes.includes('error-key_contact_email')) {
                        $(this).attr('class', 'text-danger error-key_contact_email.' + index);
                    }

                });
            }


            // Clear input values
            newContact.find("input").val("");

            // Add remove button only for cloned ones
            if (newContact.find(".btn-remove").length === 0) {
                newContact.append(`
                <div class="d-flex align-items-end col-6">
                    <button type="button" class="btn-cancel-modal btn-remove">
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

    function deleteKeyContact(id) {
        if (!confirm("Are you sure you want to delete this contact?")) {
            return;
        }

        $.ajax({
            url: "{{ route('admin.delete.shareholder.contact') }}",
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                 id: id
            },
            success: function(response) {
                if(response.status) {
                swal_success_popup(response.message);
                // remove the contact div from UI
                $('#keyContectNode_' + id).remove();
                } else {
                    swal_error_popup(response.message || 'Something went wrong');
                }
            },
            error: function(xhr) {
                  swal_error_popup("Something went wrong!");
            }
        });
    }
</script>
