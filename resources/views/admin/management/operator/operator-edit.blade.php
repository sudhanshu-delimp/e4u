@php
    if (is_array($operator->contact_type)) {
        $contactType = $operator->contact_type;
    } elseif (!empty($operator->contact_type)) {
        $contactType = json_decode($operator->contact_type, true) ?? [];
    } else {
        $contactType = [];
    }

    $countries = config('operator.country');
    $countryName = isset($countries[$operator->country_id]['name']) ? $countries[$operator->country_id]['name'] : '';

    $agreement_file = isset($operator->operator_detail->agreement_file)
        ? $operator->operator_detail->agreement_file
        : '';
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
<form name="add_operator" id="edit_operator" method="POST" action="{{ route('admin.store-operator') }}"
    enctype="multipart/form-data">
    <div class="row">
        <!-- Section: Personal Details -->
        <div class="col-12 my-2">
            <h6 class="border-bottom pb-1 text-blue-primary">Operator Details</h6>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="operator_id">Operator ID</label>
            <input type="hidden" name="user_id" value="{{ $operator->id }}">
            <input type="text" class="form-control rounded-0" value="{{ $operator->member_id }}" readonly>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="date_ppointed">Date Appointed</label>
            <input type="text" name="date_appointed" id="date_appointed_edit"
                class="form-control rounded-0 js_datepicker_edit"
                value="{{ showDateWithFormat($operator->operator_detail->date_appointed, 'd-m-Y') }}">
            <span class="text-danger error-date_appointed"></span>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="company_name">Company Name</label>
            <input type="text" class="form-control rounded-0" name="company_name" id="company_name"
                value="{{ $operator->name }}">
            <span class="text-danger error-company_name"></span>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="business_name">Business Name</label>
            <input type="text" class="form-control rounded-0" name="business_name" id="business_name"
                value="{{ $operator->business_name }}">
            <span class="text-danger error-business_name"></span>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="abn">ABN</label>
            <input type="text" class="form-control rounded-0" name="abn" id="abn" maxlength="11"
                value="{{ $operator->abn }}">
            <span class="text-danger error-abn"></span>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="business_address">Business Address</label>
            <input type="text" class="form-control rounded-0" name="business_address" id="business_address"
                value="{{ $operator->business_address }}">
            <span class="text-danger error-business_address"></span>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="business_number">Business Number</label>
            <input type="text" class="form-control rounded-0" name="business_number" id="business_number"
                oninput="this.value = this.value.replace(/\D/g,'');" maxlength="14"
                value="{{ $operator->business_number }}">
            <span class="text-danger error-business_number"></span>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="point_of_contact">Point of Contact</label>
            <input type="text" class="form-control rounded-0" name="point_of_contact" id="point_of_contact"
                value="{{ $operator->operator_detail->point_of_contact }}">
            <span class="text-danger error-point_of_contact"></span>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="phone">Mobile</label>
            <input type="text" class="form-control rounded-0" name="phone" id="phone"
                oninput="this.value = this.value.replace(/\D/g,'');" maxlength="14" value="{{ $operator->phone }}"
                onfocus="this.value = this.value.replace(/\D/g,'');">
            <span class="text-danger error-phone"></span>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="email">Email</label>
            <input type="email" class="form-control rounded-0" name="email" id="email"
                value="{{ $operator->email }}">
            <span class="text-danger error-email"></span>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="country_id">Territory</label>
            <input type="hidden" name="country_id" value="{{ $operator->country_id }}">
            <input type="text" class="form-control rounded-0" value="{{ $countryName }}" disabled>

            {{--   <select class="form-control rounded-0" name="country_id" id="country_id">
                <option  value="">Select Territory</option>
                @foreach ($countryNotAssignToOperator as $skey => $country)
                    <option value="{{ $skey }}" {{ $operator->country_id == $skey ? 'selected' : '' }}>{{ $country['name'] }}</option>
                    
                @endforeach
            </select> --}}
            <span class="text-danger error-country_id"></span>
        </div>
        <div class="col-12 mb-3 d-flex align-items-center justify-content-start gap-10 flex-wrap">
            <h6 class="mb-0 text-blue-primary">Method of Contact:</h6>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="viewer_contact_type_1" name="contact_type[]"
                    value="1" {{ in_array('1', $contactType) ? 'checked' : '' }}>
                <label class="form-check-label" for="viewer_contact_type_1">Messaging</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="viewer_contact_type_2" name="contact_type[]"
                    value="2" {{ in_array('2', $contactType) ? 'checked' : '' }}>
                <label class="form-check-label" for="viewer_contact_type_2">Text</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="viewer_contact_type_3" name="contact_type[]"
                    value="3" {{ in_array('3', $contactType) ? 'checked' : '' }}>
                <label class="form-check-label" for="viewer_contact_type_3">Email</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="viewer_contact_type_4" name="contact_type[]"
                    value="4" {{ in_array('4', $contactType) ? 'checked' : '' }}>
                <label class="form-check-label" for="viewer_contact_type_4">Call Us</label>
            </div>
            <span class="text-danger error-contact_type"></span>
        </div>
        <!-- Section: Agreement Details -->
        <div class="col-12 my-2">
            <h6 class="border-bottom pb-1 text-blue-primary">Agreement Details</h6>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="agreement_date">Date</label>
            <input type="text" name="agreement_date" id="opt_agreement_date"
                class="form-control rounded-0 js_datepicker_edit"
                value="{{ showDateWithFormat($operator->operator_detail->agreement_date, 'd-m-Y') }}" />
            <span class="text-danger error-agreement_date"></span>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="term">Term</label>
            <input type="text" class="form-control rounded-0" name="term" id="term"
                value="{{ $operator->operator_detail->term }}">
            <span class="text-danger error-term"></span>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="fee">Fee</label>
            <input type="text" class="form-control rounded-0" name="fee" id="fee" maxlength="100"
                value="{{ $operator->operator_detail->fee }}">
            <span class="text-danger error-fee"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-12 my-2">
            <h6 class="border-bottom pb-1 text-blue-primary">Upload Agreement</h6>
        </div>
        <div class="col-6 mb-3">
            <input type="file" name="agreement_file" id="agreement_file">
            <span class="text-danger error-agreement_file"></span>
        </div>
        <div class="col-6 mb-3 my-auto text-right">
            @if (!empty($agreement_file))
                <a href="{{ asset('storage') }}/{{ $agreement_file }}" target="_blank"
                    title="Click here to dowload or view agreement file." download>View Agreement</a>
            @endif
        </div>
    </div>
    <div class="row">
        <!-- Commission -->
        <div class="col-12 my-2">
            <h6 class="border-bottom pb-1 text-blue-primary">Commission</h6>
        </div>
        <div class="col-6 mb-3">
            <label class="form-label" for="commission_advertising_percent">Advertising</label>
            <input type="number" min="0" step="0.01" class="form-control rounded-0" placeholder="Advertising" name="commission_advertising_percent"
                id="commission_advertising_percent" maxlength="10"
                value="{{ $operator->operator_detail->commission_advertising_percent }}">
            <span class="text-danger error-commission_advertising_percent"></span>
        </div>

        <div class="col-6 mb-3">
            <label lass="form-label" for="advertising_commission_type">Amount Type</label>
            <select class="form-control rounded-0" name="advertising_commission_type"
                id="advertising_commission_type">
               {{--  <option value="">Amount Type</option> --}}
                <option value="percent" {{$operator->operator_detail?->advertising_commission_type=='percent' ? 'selected' : '' }}>
                    Percent</option>
               {{--  <option value="fixed"{{$operator->operator_detail?->advertising_commission_type=='fixed' ? 'selected' : '' }}>Fixed
                </option> --}}
            </select>
            <span class="text-danger error-advertising_commission_type"></span>
        </div>
        <div class="col-6 mb-3">
            <label class="form-label" for="commission_massage_centre_percent">Massage Centre (Registrations)</label>
            <input type="number" min="0" step="0.01" class="form-control rounded-0" placeholder="Massage Centre (Registrations)"
                name="commission_massage_centre_percent" id="commission_massage_centre_percent" maxlength="10"
                value="{{ $operator->operator_detail->commission_massage_centre_percent }}">
            <span class="text-danger error-commission_massage_centre_percent"></span>
        </div>

         <div class="col-6 mb-3">
            <label lass="form-label" for="massge_centre_commission_type">Amount Type</label>
            <select class="form-control rounded-0" name="massge_centre_commission_type"
                id="massge_centre_commission_type">
               {{--  <option value="">Amount Type</option> --}}
                <option value="percent" {{$operator->operator_detail?->massge_centre_commission_type=='percent' ? 'selected' : '' }}>
                    Percent</option>
                {{-- <option value="fixed"{{$operator->operator_detail?->massge_centre_commission_type=='fixed' ? 'selected' : '' }}>Fixed
                </option> --}}
            </select>
            <span class="text-danger error-massge_centre_commission_type"></span>
        </div>
    </div>
    <div class="modal-footer p-0">
        <button type="submit" class="btn-success-modal m-0">Update</button>
        <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">Cancel</button>
    </div>
</form>
