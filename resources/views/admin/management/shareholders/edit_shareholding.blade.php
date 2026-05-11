@php
    $deedfile = isset($shareholding->trust_deed_file) ? $shareholding->trust_deed_file : '';
@endphp

<div class="modal-body">
    <form name="add_shareholding" id="add_shareholding" method="POST" action="{{ route('admin.add.shareholding') }}"
        enctype="multipart/form-data">
        <div class="modal-body">
            <div class="row">

                <!-- Section: Shareholder Details -->
                <div class="col-12 mb-3">
                    <h6 class="border-bottom pb-1 text-blue-primary">Shareholder Details</h6>
                </div>



                <!-- Shareholder Name -->
                <div class="col-md-6 mb-3">
                    <input type="hidden" name="shareholding_id" id="shareholding_id" value="{{ $shareholding->id }}">
                    <label for="name">Shareholder</label>
                    <input type="hidden" name="shareholder_id" id="shareholder_id"
                        value="{{ $shareholding->shareholder->id }}">
                    <input type="text" class="form-control rounded-0 bg-light" name="name" id="name"
                        value="{{ $shareholding->shareholder->business_name }}" readonly>
                    <span class="text-danger error-name"></span>
                </div>

                <!-- Member ID -->
                <div class="col-md-6 mb-3">
                    <label for="member_id">Member ID</label>
                    <input type="text" class="form-control rounded-0 bg-light" name="member_id" id="member_id"
                        value="{{ $shareholding->shareholder->member_id }}" readonly>
                    <span class="text-danger error-member_id"></span>
                </div>

                <!-- Date of Entry -->
                <div class="col-md-6 mb-3">
                    <label for="date_of_entry">Date of Entry</label>
                    <input type="text" name="date_of_entry" id="edit_date_of_entry"
                        class="form-control rounded-0 js_datepicker_edit"
                        value="{{ showDateWithFormat($shareholding->date_of_entry, 'd-m-Y') }}">
                    <span class="text-danger error-date_of_entry"></span>
                </div>

                <!-- Membership Type -->
                <div class="col-md-6 mb-3">
                    <label for="membership_type">Membership Type</label>


                    <select class="form-control rounded-0" name="member_type" id="membership_type">
                        <option value="">Select Membership Type</option>
                        @foreach (config('common.membership_type') as $key => $typeName)
                            <option value="{{ $key }}"
                                {{ $shareholding->member_type == $key ? 'selected' : '' }}>{{ $typeName }}
                            </option>
                        @endforeach
                    </select>
                    <span class="text-danger error-member_type"></span>
                </div>

                <!-- Threshold -->
                <div class="col-md-6 mb-3">
                    <label>Threshold</label>
                    <div>
                        <div class="form-check form-check-inline ml-0">
                            <input class="form-check-input" type="radio" name="threshold" id="threshold_yes"
                                value="yes" {{ $shareholding->threshold == 'yes' ? 'checked' : '' }}>
                            <label class="form-check-label" for="threshold_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="threshold" id="threshold_no"
                                value="no" {{ $shareholding->threshold == 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="threshold_no">No</label>
                        </div>
                    </div>
                    <span class="text-danger error-threshold"></span>
                </div>

                <!-- Number of Shares -->
                <div class="col-md-6 mb-3">
                    <label for="number_of_shares">Number of Shares</label>
                    <input type="text" autocomplete="off" class="form-control rounded-0" name="number_of_shares"
                        id="number_of_shares" oninput="this.value = this.value.replace(/[^0-9]/g,'');"
                        value="{{ $shareholding->number_of_shares }}">
                    <span class="text-danger error-number_of_shares"></span>
                </div>

                <!-- Shareholding -->
                <div class="col-md-6 mb-3">
                    <label for="shareholding">Shareholding</label>
                    <div class="input-group">
                        <input type="text" class="form-control rounded-0" name="shareholding" id="shareholding"
                            placeholder="e.g. 25" oninput="this.value = this.value.replace(/[^0-9]/g,'');"
                            value="{{ $shareholding->shareholding }}">
                        <span class="input-group-text rounded-0">%</span>
                    </div>
                    <span class="text-danger error-shareholding"></span>
                </div>

                <!-- Beneficial Status -->
                <div class="col-12 mt-3 mb-3">
                    <h6 class="border-bottom pb-1 text-blue-primary">Beneficial Status</h6>
                </div>

                <!-- Held on Trust -->
                <div class="col-md-6 mb-3 held_on_trust">
                    <label>Held on Trust</label>
                    <div>
                        <div class="form-check form-check-inline ml-0">
                            <input class="form-check-input" type="radio" name="held_on_trust" id="held_on_trust_yes"
                                value="yes" {{ $shareholding->held_on_trust == 'yes' ? 'checked' : '' }}
                                onchange="initTrustFields()">
                            <label class="form-check-label" for="held_on_trust_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="held_on_trust"
                                id="held_on_trust_no" value="no"
                                {{ $shareholding->held_on_trust == 'no' ? 'checked' : '' }}
                                onchange="initTrustFields()">
                            <label class="form-check-label" for="held_on_trust_no">No</label>
                        </div>
                        <span class="text-danger error-held_on_trust"></span>
                    </div>
                </div>

                <!-- Trustee -->
                <div class="row col-md-12 mb-3 edit_trust_fields d-none">
                    <div class="col-3">
                        <label for="trustee">Upload Trust Deed: </label>
                    </div>
                    <div class="col-4">
                        <input type="file" name="trust_deed_file" id="trust_deed_file">
                    </div>
                    <div class="col-5 mb-3 my-auto text-right">
                        @if (!empty($deedfile))
                            <a href="{{ asset('storage') }}/{{ $deedfile }}" target="_blank"
                                title="Click here to dowload or view Trust Deed file." download>Download Trust Deed</a>
                        @endif
                    </div>
                     <span class="text-danger error-trust_deed_file"></span>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
                <button type="submit" class="btn-success-modal">Save</button>
            </div>
    </form>
</div>

<script>
    function initTrustFields() {
        let value = $('.held_on_trust input[name="held_on_trust"]:checked').val();
        if (value === 'yes') {
            $('.edit_trust_fields').removeClass('d-none');
        } else {
            $('.edit_trust_fields').addClass('d-none');
        }
    }

    // Page Load
    $(document).ready(function() {
        initTrustFields();
    });
</script>
