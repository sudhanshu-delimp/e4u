@php
if (is_array($operator->contact_type)) {
    $contactType = $operator->contact_type;
} elseif (!empty($operator->contact_type)) {
    $contactType = json_decode($operator->contact_type, true) ?? [];
} else {
    $contactType = [];
}


@endphp
<style>
    /* Chrome, Safari, Edge, Opera */
    .no-arrow::-webkit-inner-spin-button,
    .no-arrow::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    .no-arrow {
        -moz-appearance: textfield;
    }
</style>
<form name="add_operator" id="edit_operator" method="POST" action="{{ route('admin.store-operator') }}">
    <div class="row">
        <!-- Section: Personal Details -->
        <div class="col-12 my-2">
            <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
        </div>
        <div class="col-6 mb-3">
             <input type="hidden" name="user_id" value="{{ $operator->id }}">
            <input type="text" class="form-control rounded-0" placeholder="Operator ID" value="{{ $operator->member_id }}" readonly >
        </div>
        <div class="col-6 mb-3">
            <input type="text" name="date_appointed" id="date_appointed" class="form-control rounded-0 js_datepicker" placeholder="Date Appointed(DD-MM-YYYY)"  value="{{ showDateWithFormat($operator->operator_detail->date_appointed, 'd-m-Y') }}" >
            <span class="text-danger error-date_appointed"></span>
        </div>
        <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="Company Name" name="company_name"
                id="company_name" value="{{ $operator->name }}">
            <span class="text-danger error-company_name"></span>
        </div>
        <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="Business Name" name="business_name"
                id="business_name" value="{{ $operator->business_name }}">
            <span class="text-danger error-business_name"></span>
        </div>
        <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="ABN" name="abn" id="abn"
                maxlength="11" value="{{ $operator->abn }}">
            <span class="text-danger error-abn"></span>
        </div>
        <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="Business Address" name="business_address"
                id="business_address" value="{{ $operator->business_address }}">
            <span class="text-danger error-business_address"></span>
        </div>
        <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="Business Number" name="business_number"
                id="business_number" oninput="this.value = this.value.replace(/\D/g,'');" maxlength="14"  value="{{ $operator->business_number }}">
            <span class="text-danger error-business_number"></span>
        </div>
        <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="Point of Contact" name="point_of_contact"
                id="point_of_contact" value="{{ $operator->operator_detail->point_of_contact }}">
            <span class="text-danger error-point_of_contact"></span>
        </div>
        <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="Mobile" name="phone" id="phone"
                oninput="this.value = this.value.replace(/\D/g,'');" maxlength="14" value="{{ $operator->phone }}">
            <span class="text-danger error-phone"></span>
        </div>
        <div class="col-6 mb-3">
            <input type="email" class="form-control rounded-0" placeholder="Email" name="email" id="email" value="{{ $operator->email }}">
            <span class="text-danger error-email"></span>
        </div>
        <div class="col-6 mb-3">
            <select class="form-control rounded-0" name="state_id" id="state_id">
                <option  value="">Select Territory</option>
                @foreach (config('escorts.profile.states') as $skey => $state)
                    <option value="{{ $skey }}" {{ $operator->state_id == $skey ? 'selected' : '' }}>{{ $state['stateName'] }}</option>
                @endforeach
            </select>
            <span class="text-danger error-state_id"></span>
        </div>
        <div class="col-12 mb-3 d-flex align-items-center justify-content-start gap-10 flex-wrap">
            <h6 class="mb-0 text-blue-primary">Method of Contact:</h6>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="viewer_contact_type_1" name="contact_type[]"
                    value="1" {{ in_array('1', $contactType) ? 'checked' : ''  }}>
                <label class="form-check-label" for="viewer_contact_type_1">Messaging</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="viewer_contact_type_2" name="contact_type[]"
                    value="2" {{ in_array('2', $contactType) ? 'checked' : ''  }}>
                <label class="form-check-label" for="viewer_contact_type_2">Text</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="viewer_contact_type_3" name="contact_type[]"
                    value="3" {{ in_array('3', $contactType) ? 'checked' : '' }}>
                <label class="form-check-label" for="viewer_contact_type_3">Email</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="viewer_contact_type_4" name="contact_type[]"
                    value="4" {{ in_array('4', $contactType) ? 'checked' : ''  }}>
                <label class="form-check-label" for="viewer_contact_type_4">Call Us</label>
            </div>
            <span class="text-danger error-contact_type"></span>
        </div>
        <!-- Section: Agreement Details -->
        <div class="col-12 my-2">
            <h6 class="border-bottom pb-1 text-blue-primary">Agreement Details</h6>
        </div>
        <div class="col-6 mb-3">
        <input type="text" name="agreement_date" id="opt_agreement_date" class="form-control rounded-0 js_datepicker" value="{{ showDateWithFormat($operator->operator_detail->agreement_date, "d-m-Y") }}" placeholder="Agreement Date (DD-MM-YYYY)" />
            <span class="text-danger error-agreement_date"></span>
        </div>
        <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="Term" name="term" id="term" value="{{ $operator->operator_detail->term }}">
            <span class="text-danger error-term"></span>
        </div>
        <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="fee" name="fee" id="fee"
                maxlength="100" value="{{ $operator->operator_detail->fee }}">
            <span class="text-danger error-fee"></span>
        </div>
    </div>
    <div class="row">
        <!-- Commission -->
        <div class="col-12 my-2">
            <h6 class="border-bottom pb-1 text-blue-primary">Commission</h6>
        </div>
        <div class="col-6 mb-3">
            <input class="form-control rounded-0" placeholder="Advertising %" name="commission_advertising_percent"
                id="commission_advertising_percent" maxlength="3" value="{{ $operator->operator_detail->commission_advertising_percent }}">
            <span class="text-danger error-commission_advertising_percent"></span>
        </div>
        <div class="col-6 mb-3">
            <input class="form-control rounded-0" placeholder="Massage Centre (Registrations) %"
                name="commission_massage_centre_percent" id="commission_massage_centre_percent" maxlength="3" value="{{ $operator->operator_detail->commission_massage_centre_percent }}">
            <span class="text-danger error-commission_massage_centre_percent"></span>
        </div>
    </div>
     @php
        $update_button =
            $operator->status === 'Pending'
                ? '<button type="button" class="btn-success-modal mr-2 approve_account" data-id=' .
                    $operator->id .
                    '>Approve</button>'
                : '';
    @endphp
    <div class="modal-footer p-0">
        {!! $update_button !!}
        <button type="submit" class="btn-success-modal mr-3">Save</button>
    </div>
    
</form>
  <script>
       var initJsDatePicker = function() {
                var $inputs = $(".js_datepicker");
                if ($inputs.length > 0) {
                    $inputs.attr('placeholder', 'DD-MM-YYYY');
                    $inputs.attr('autocomplete', 'off');
                    $inputs.datepicker({
                        dateFormat: "dd-mm-yy",
                        changeMonth: true,
                        changeYear: true,
                        showAnim: "slideDown",
                        onSelect: function(dateText) {
                            $(this).trigger('change');
                        }
                    });
                }
            }

            $(document).ready(function() {
                initJsDatePicker();
            });
  </script>