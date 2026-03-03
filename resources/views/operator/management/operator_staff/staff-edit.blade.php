@php
    $securityLevels = config('operator_staff.security_level');
    $staff_detail = $staff->operator_staff_detail;
    $securityLevel = isset($securityLevels[$staff_detail->security_level])
        ? $securityLevels[$staff_detail->security_level]
        : '';
    $setting = $staff->operator_staff_setting ?? null;
$operatorName = isset($staff->operator->name) ? $staff->operator->name." (".$staff->operator->member_id.")" : '';
    $staffAddEditUnderSelectedOperatorycounty = config("operator_staff.staff_add_edit_under_selected_operatory_county");
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
<form name="add_staff" id="edit_staff" method="POST" action="{{ route('operator.operator.store-staff') }}"
    enctype="multipart/form-data">
    <div class="row" style="max-height: 500px; overflow:auto;">
        <div class="col-12 my-2">
            <h6 class="border-bottom pb-1 text-blue-primary">Operator</h6>
        </div>
        <div class="col-12 mb-3">
            <span class="form-control form-back">{{$operatorName}}</span>
            <input type="hidden" name="from_admin" value="0">
            <input type="hidden" name="operator_id" value="{{ auth()->user()->operator_id }}">
        </div>

        <!-- Section: Personal Details -->
        <div class="col-12 my-2">
            <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
        </div>

        <div class="col-6 mb-3">
            <input type="hidden" name="user_id" value="{{ $staff->id }}">
            <label class="form-check-label" for="name">Full Name</label>
            <input type="text" class="form-control rounded-0" name="name" id="name"
                value="{{ $staff->name }}">
            <span class="text-danger error-name"></span>
        </div>
        <div class="col-6 mb-3">
              <label class="form-check-label" for="address">Address</label>
            <input type="text" class="form-control rounded-0"  name="address" id="address"
                value="{{ $staff->operator_staff_detail->address }}">
            <span class="text-danger error-address"></span>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="phone">Phone</label>
            <input type="tel" maxlength="10" class="form-control rounded-0" name="phone"
                id="phone" value="{{ $staff->phone }}" oninput="this.value = this.value.replace(/\D/g,'');"
                autocomplete="off">
            <span class="text-danger error-phone"></span>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="email">Private Email</label>
            <input type="email" class="form-control rounded-0" name="email"
                id="email" value="{{ $staff->email }}">
            <span class="text-danger error-email"></span>
        </div>
        <div class="col-6 mb-3">
              <label class="form-check-label" for="gender">Gender</label>
            <select class="form-control" name="gender" id="gender">
                <option value="">Select Gender</option>
                @foreach (config('operator_staff.genders') as $key => $gender)
                    <option value="{{ $key }}" {{ $staff->gender == $key ? 'selected' : '' }}>
                        {{ $gender }}</option>
                @endforeach
            </select>
            <span class="text-danger error-gender"></span>
        </div>

        <!-- Next of Kin Section -->
        <div class="col-12 my-2">
            <h6 class="border-bottom pb-1 text-blue-primary">Next of Kin (Emergency Contact)</h6>
        </div>

        <div class="col-6 mb-3">
             <label class="form-check-label" for="kin_name">Name of Kin</label>
            <input type="text" name="kin_name" id="kin_name" class="form-control rounded-0" value="{{ $staff_detail->kin_name }}">
            <span class="text-danger error-kin_name"></span>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="kin_relationship">Relationship</label>
            <input type="text" name="kin_relationship" id="kin_relationship" class="form-control rounded-0" value="{{ $staff_detail->kin_relationship }}">
            <span class="text-danger error-kin_relationship"></span>
        </div>
        <div class="col-6 mb-3">
            <label class="form-check-label" for="kin_mobile">Mobile</label>
            <input type="tel" maxlength="10" name="kin_mobile" id="kin_mobile" class="form-control rounded-0" value="{{ $staff_detail->kin_mobile }}" autocomplete="off"
                oninput="this.value = this.value.replace(/\D/g,'');">
            <span class="text-danger error-kin_mobile"></span>
        </div>
        <div class="col-6 mb-3">
             <label class="form-check-label" for="kin_email">Email</label>
            <input type="email" name="kin_email" class="form-control rounded-0" value="{{ $staff_detail->kin_email }}">
            <span class="text-danger error-kin_email"></span>
        </div>

        <!-- Section: Other Details -->
        <div class="col-12 my-2">
            <h6 class="border-bottom pb-1 text-blue-primary">Other Details</h6>
        </div>

        <div class="col-6 mb-3">
             <label class="form-check-label" for="security_level">Security Level</label>
            <select class="form-control rounded-0" name="security_level" id="security_level_edit">
                <option value="">Select Security Level</option>
                @foreach (config('operator_staff.security_level') as $seckey => $secLevel)
                    <option value="{{ $seckey }}"
                        {{ $staff_detail->security_level == $seckey ? 'selected' : '' }}>{{ $secLevel }}
                    </option>
                @endforeach
            </select>
            <span class="text-danger error-security_level"></span>
        </div>

        <div class="col-6 mb-3">
            <label class="form-check-label" for="position">Position</label>
            <select class="form-control rounded-0" name="position" id="position_edit" disabled>
                <option value="">Select Position</option>
                @foreach (config('operator_staff.position') as $pkey => $position)
                    <option value="{{ $pkey }}" {{ $staff_detail->position == $pkey ? 'selected' : '' }}>
                        {{ $position }}</option>
                @endforeach
            </select>
            <span class="text-danger error-position"></span>
        </div>
        <div class="col-6 mb-3">
             <label class="form-check-label" for="country_id">Territory</label>
            <select class="form-control rounded-0" name="country_id" id="country_id">
                <option value="">Select Territory</option>
                @if( $staffAddEditUnderSelectedOperatorycounty)
                    @if ($staff->operator->country_id == $staff->country_id)
                    <option value="{{$staff->operator->country_id}}" selected>{{$staff->operator->country->name}}</option>
                    @else
                    <option value="{{$staff->operator->country_id}}">{{$staff->operator->country->name}}</option>
                    @endif
                @else
                @foreach (config('operator.country') as $skey => $country)
                    @if ($skey == $staff->country_id)
                        <option value="{{ $skey }}" selected>{{ $country['name'] }}</option>
                    @else
                        <option value="{{ $skey }}">{{ $country['name'] }}</option>
                    @endif
                @endforeach
               @endif 
            </select>
            <span class="text-danger error-country_id"></span>
        </div>
        <div class="col-6 mb-3">
             <label class="form-check-label" for="commenced_date_edit">Commenced Date</label>
            <input type="text" name="commenced_date" id="commenced_date_edit" class="form-control rounded-0 js_datepicker_edit" value="{{showDateWithFormat( $staff_detail->commenced_date, 'd-m-Y') }}">
            <span class="text-danger error-commenced_date"></span>

        </div>
        <div class="col-6 mb-3">
             <label class="form-check-label" for="employment_status">Employment Status</label>
            <select class="form-control rounded-0" name="employment_status" id="employment_status">
                <option value="">Select Employment Status</option>
                @foreach (config('operator_staff.employment_status') as $empkey => $empStatus)
                    <option value="{{ $empkey }}"
                        {{ $staff_detail->employment_status == $empkey ? 'selected' : '' }}>{{ $empStatus }}
                    </option>
                @endforeach
            </select>
            <span class="text-danger error-employment_status"></span>
        </div>
        <div class="col-6 mb-3">
             <label class="form-check-label" for="employment_agreement">Employment Agreement?</label>
            <select class="form-control rounded-0" name="employment_agreement" id="employment_agreement">
                <option value="">Select Employment Agreement?</option>
                <option value="yes" {{ $staff_detail->employment_agreement == 'yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="no" {{ $staff_detail->employment_agreement == 'no' ? 'selected' : '' }}>No
                </option>
            </select>
            <span class="text-danger error-employment_agreement"></span>
        </div>

        <!-- Section: Building Security -->
        <div class="col-12 my-2">
            <h6 class="border-bottom pb-1 text-blue-primary">Building Security</h6>
        </div>

        <div class="col-4 mb-3">
             <label class="form-check-label" for="building_access_code">Access Code Provided?</label>
            <select class="form-control rounded-0" name="building_access_code" id="building_access_code">
                <option value="">Select Access Code Provided?</option>
                <option value="yes" {{ $staff_detail->building_access_code == 'yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="no" {{ $staff_detail->building_access_code == 'no' ? 'selected' : '' }}>No
                </option>
            </select>
            <span class="text-danger error-building_access_code"></span>
        </div>
        <div class="col-4 mb-3">
            <label class="form-check-label" for="keys_issued">Key Provided?</label>
            <select class="form-control rounded-0" name="keys_issued" id="keys_issued">
                <option value="">Select Key Provided?</option>
                <option value="yes" {{ $staff_detail->keys_issued == 'yes' ? 'selected' : '' }}>Yes</option>
                <option value="no" {{ $staff_detail->keys_issued == 'no' ? 'selected' : '' }}>No</option>
            </select>
            <span class="text-danger error-keys_issued"></span>
        </div>
        <div class="col-4 mb-3">
             <label class="form-check-label" for="car_parking">Car Park?</label>
            <select class="form-control rounded-0" name="car_parking" id="car_parking">
                <option value="">Select Car Park?</option>
                <option value="yes" {{ $staff_detail->car_parking == 'yes' ? 'selected' : '' }}>Yes</option>
                <option value="no" {{ $staff_detail->car_parking == 'no' ? 'selected' : '' }}>No</option>
            </select>
            <span class="text-danger error-car_parking"></span>
        </div>
        <div class="col-12">
            <div class="form-group">
                <h6 class="border-bottom pb-1 text-blue-primary">Idle Time Preference</h6>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="idle_preference_time"
                        id="edit_idle_preference_time_15" value="15"
                        {{ $setting && $setting->idle_preference_time === '15' ? 'checked' : '' }}>
                    <label class="form-check-label" for="edit_idle_preference_time_15">15 minutes</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="idle_preference_time"
                        id="edit_idle_preference_time_30" value="30"
                        {{ $setting && $setting->idle_preference_time === '30' ? 'checked' : '' }}>
                    <label class="form-check-label" for="edit_idle_preference_time_30">30 minutes</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="idle_preference_time"
                        id="edit_idle_preference_time_60" value="60"
                        {{ $setting && $setting->idle_preference_time === '60' ? 'checked' : '' }}>
                    <label class="form-check-label" for="edit_idle_preference_time_60">60 minutes</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="idle_preference_time"
                        id="edit_idle_preference_time_never" value="{{ config('operator_staff.idle_vever_minute') }}"
                        {{ $setting && $setting->idle_preference_time === config('operator_staff.idle_vever_minute') ? 'checked' : '' }}>
                    <label class="form-check-label" for="edit_idle_preference_time_never">Never</label>
                </div>

                {{--  <div class="pt-1">
                <i style="font-size:12px;">Set the Idle time before you are logged out of your Console.</i>
            </div> --}}
            </div>

            <div class="form-group">
                <h6 class="border-bottom pb-1 text-blue-primary">2FA Authentication</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="twofa" id="edit_twofa_1" value="1"
                        {{ $setting && $setting->twofa == 1 ? 'checked' : 'checked' }}>
                    <label class="form-check-label" for="edit_twofa_1">Email</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="twofa" id="edit_twofa_2" value="2"
                        {{ $setting && $setting->twofa == 2 ? 'checked' : '' }}>
                    <label class="form-check-label" for="edit_twofa_2">Text</label>
                </div>

                {{-- <div class="pt-1" style="font-size:12px;">
                <i>How your authentication code will be sent to you.</i>
            </div> --}}
            </div>
        </div>
    </div>
    @php
        $update_button =
            $staff->status === 'Pending'
                ? '<button type="button" class="btn-success-modal mr-2 approve_account" data-id=' .
                    $staff->id .
                    '>Approve</button>'
                : '';
    @endphp
    <div class="modal-footer p-0">
        {!! $update_button !!}
        <button type="submit" class="btn-success-modal mr-3">Save</button>
    </div>
</form>
    
<script>
    $(document).ready(function() {
        $("#security_level_edit").on("change", function() {
            let level = $(this).val();
            // Auto-select position = same value as security_level
            $("#position_edit").val(level).trigger("change");
            $("#position_edit").prop("disabled", true);
        });
        
    });

</script>

