<form name="add_staff" id="edit_staff" method="POST" action="{{ route('staff.store-staff') }}"
    enctype="multipart/form-data">
    <div class="row">
        <!-- Section: Personal Details -->
        <div class="col-12 my-2">
            <h6 class="border-bottom pb-1 text-blue-primary">Personal Details</h6>
        </div>

        <div class="col-6 mb-3">
            <input type="hidden" name="user_id" value="{{ $staff->id }}">
            <input type="text" class="form-control rounded-0" placeholder="Full Name" name="name" id="name"
                value="{{ $staff->name }}">
            <span class="text-danger error-name"></span>
        </div>
        <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="Address" name="address" id="address"
                value="{{ $staff->staff_detail->address }}">
            <span class="text-danger error-address"></span>
        </div>
        <div class="col-6 mb-3">
            <input type="text" class="form-control rounded-0" placeholder="Phone" name="phone" id="phone"
                value="{{ $staff->phone }}">
            <span class="text-danger error-phone"></span>
        </div>
        <div class="col-6 mb-3">
            <input type="email" class="form-control rounded-0" placeholder="Private Email" name="email"
                id="email" value="{{ $staff->email }}">
            <span class="text-danger error-email"></span>
        </div>
        <div class="col-6 mb-3">
            <select class="form-control" name="gender" id="gender">
                <option value="">Select Gender</option>
                @foreach (config('escorts.profile.genders') as $key => $gender)
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
            <input type="text" name="kin_name" id="kin_name" class="form-control rounded-0"
                placeholder="Kin of Name" value="{{ $staff->staff_detail->kin_name }}">
            <span class="text-danger error-kin_name"></span>
        </div>
        <div class="col-6 mb-3">
            <input type="text" name="kin_relationship" id="kin_relationship" class="form-control rounded-0"
                placeholder="Relationship" value="{{ $staff->staff_detail->kin_relationship }}">
            <span class="text-danger error-kin_relationship"></span>
        </div>
        <div class="col-6 mb-3">
            <input type="text" name="kin_mobile" id="kin_mobile" class="form-control rounded-0" placeholder="Mobile"
                value="{{ $staff->staff_detail->kin_mobile }}">
            <span class="text-danger error-kin_mobile"></span>
        </div>
        <div class="col-6 mb-3">
            <input type="email" name="kin_email" class="form-control rounded-0" placeholder="Email (optional)"
                value="{{ $staff->staff_detail->kin_email }}">
            <span class="text-danger error-kin_email"></span>
        </div>

        <!-- Section: Other Details -->
        <div class="col-12 my-2">
            <h6 class="border-bottom pb-1 text-blue-primary">Other Details</h6>
        </div>

        {{-- <div class="col-6 mb-3">
            <input type="text" name="position" id="position" class="form-control rounded-0" placeholder="Position"  value="{{$staff->staff_detail->position}}">
            <span class="text-danger error-position"></span>
        </div> --}}

        <div class="col-6 mb-3">
            <select class="form-control rounded-0" name="security_level" id="security_level_edit">
                <option value="">Security Level</option>
                @foreach (config('staff.security_level') as $seckey => $secLevel)
                    <option value="{{ $seckey }}"
                        {{ $staff->staff_detail->security_level == $seckey ? 'selected' : '' }}>{{ $secLevel }}
                    </option>
                @endforeach
            </select>
            <span class="text-danger error-security_level"></span>
        </div>

        <div class="col-6 mb-3">
            <select class="form-control rounded-0" name="position" id="position_edit" disabled>
                <option value="">Position</option>
                @foreach (config('staff.position') as $pkey => $position)
                    <option value="{{ $pkey }}"
                        {{ $staff->staff_detail->position == $pkey ? 'selected' : '' }}>
                        {{ $position }}</option>
                @endforeach
            </select>
            <span class="text-danger error-position"></span>
        </div>
        <div class="col-6 mb-3">
            <select class="form-control rounded-0" name="location" id="location">
                <option value="">Select Location</option>
                @foreach (config('escorts.profile.cities') as $skey => $city)
                    <option value="{{ $skey }}" {{ $staff->city_id == $skey ? 'selected' : '' }}>
                        {{ $city }}</option>
                @endforeach
            </select>
             <span class="text-danger error-location"></span>
        </div>
        <div class="col-6 mb-3">
            <input type="text" name="commenced_date" id="commenced_date" class="form-control rounded-0"
                placeholder="Commenced Date (DD/MM/YYYY)" onfocus="(this.type='date')"
                onblur="if(this.value==''){this.type='text'}" value="{{ $staff->staff_detail->commenced_date }}">
            <span class="text-danger error-commenced_date"></span>

        </div>
        <div class="col-6 mb-3">
            <select class="form-control rounded-0" name="employment_status" id="employment_status">
                <option value="">Select Employment Status</option>
                @foreach (config('staff.employment_status') as $empkey => $empStatus)
                    <option value="{{ $empkey }}"
                        {{ $staff->staff_detail->employment_status == $empkey ? 'selected' : '' }}>{{ $empStatus }}
                    </option>
                @endforeach
            </select>
            <span class="text-danger error-employment_status"></span>
        </div>
        <div class="col-6 mb-3">
            <select class="form-control rounded-0" name="employment_agreement" id="employment_agreement">
                <option value="">Employment Agreement?</option>
                <option value="yes" {{ $staff->staff_detail->employment_agreement == 'yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="no" {{ $staff->staff_detail->employment_agreement == 'no' ? 'selected' : '' }}>No
                </option>
            </select>
            <span class="text-danger error-employment_agreement"></span>
        </div>

        <!-- Section: Building Security -->
        <div class="col-12 my-2">
            <h6 class="border-bottom pb-1 text-blue-primary">Building Security</h6>
        </div>

        <div class="col-4 mb-3">
            <select class="form-control rounded-0" name="building_access_code" id="building_access_code">
                <option value="">Access Code Provided?</option>
                <option value="yes" {{ $staff->staff_detail->building_access_code == 'yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="no" {{ $staff->staff_detail->building_access_code == 'no' ? 'selected' : '' }}>No
                </option>
            </select>
            <span class="text-danger error-building_access_code"></span>
        </div>
        <div class="col-4 mb-3">
            <select class="form-control rounded-0" name="keys_issued" id="keys_issued">
                <option value="">Key Provided?</option>
                <option value="yes" {{ $staff->staff_detail->keys_issued == 'yes' ? 'selected' : '' }}>Yes</option>
                <option value="no" {{ $staff->staff_detail->keys_issued == 'no' ? 'selected' : '' }}>No</option>
            </select>
            <span class="text-danger error-keys_issued"></span>
        </div>
        <div class="col-4 mb-3">
            <select class="form-control rounded-0" name="car_parking" id="car_parking">
                <option value="">Car Park?</option>
                <option value="yes" {{ $staff->staff_detail->car_parking == 'yes' ? 'selected' : '' }}>Yes</option>
                <option value="no" {{ $staff->staff_detail->car_parking == 'no' ? 'selected' : '' }}>No</option>
            </select>
            <span class="text-danger error-car_parking"></span>
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
    <div class="modal-footer p-0 pl-2 pb-4">
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
