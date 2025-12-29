<div class="row" >
    @php
        $employmentStatuss = config('staff.employment_status');
        $employmentStatus = isset($employmentStatuss[$staff->staff_detail->employment_status])
            ? $employmentStatuss[$staff->staff_detail->employment_status] : '';
        $securityLevels = config('staff.security_level');
        $securityLevel = isset($securityLevels[$staff->staff_detail->security_level])
            ? $securityLevels[$staff->staff_detail->security_level]
            : '';
        $genders = config('escorts.profile.genders');
        $gender = isset($genders[$staff->gender]) ? $genders[$staff->gender] : '';
        $cities = config('escorts.profile.cities');
        $city = isset($cities[$staff->city_id]) ? $cities[$staff->city_id] : '';
        $setting = $staff->staff_setting??null;
        $idle_preference_times = config('staff.idle_preference_time');
        $idle_preference_time = "";
         $twofa = "";
        if(isset( $setting) && (isset($setting->idle_preference_time))) {
            $idle_preference_time = isset($idle_preference_times[(string)$setting->idle_preference_time]) ? $idle_preference_times[$setting->idle_preference_time] : "";
        }
        $twofas = config('staff.twofa');
        if(isset( $setting) && isset($setting->twofa)) {
        $twofa = isset($twofas[$setting->twofa]) ? $twofas[$setting->twofa] : "";
        }
    @endphp
    <div class="col-12 view_staff_details">
         <div class="row" style="max-height: 600px; overflow:auto;">
            <!-- Section: Personal Details -->
            <div class="col-12 my-2">
                <h6 class="text-blue-primary">Personal Details</h6>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="40%">Member ID</th>
                            <td width="60%">{{ $staff->member_id }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Full Name</th>
                            <td width="60%">{{ $staff->name }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td> {{ $staff->staff_detail->address }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $staff->phone }}</td>
                        </tr>
                        <tr>
                            <th>Private Email</th>
                            <td>{{ $staff->email }}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{ $gender }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Next of Kin Section -->
            <div class="col-12 my-2">
                <h6 class="text-blue-primary">Next of Kin (Emergency Contact)</h6>

                <table class="table table-bordered mb-3">
                    <tbody>
                        <tr>
                            <th width="40%">Name of Kin</th>
                            <td width="60%">{{ $staff->staff_detail->kin_name }}</td>
                        </tr>
                        <tr>
                            <th>Relationship</th>
                            <td> {{ $staff->staff_detail->kin_relationship }}</td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>{{ $staff->staff_detail->kin_mobile }}</td>
                        </tr>
                        <tr>
                            <th>Email (optional)</th>
                            <td>{{ $staff->staff_detail->kin_email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Section: Other Details -->
            <div class="col-12 my-2">
                <h6 class="text-blue-primary">Other Details</h6>

                <table class="table table-bordered mb-3">
                    <tbody>
                        <tr>
                            <th>Security Level</th>
                            <td>{{ $securityLevel }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Position</th>
                            <td width="60%">{{ $staff->staff_detail->position($staff->staff_detail->position) }}</td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td> {{ $city }}</td>
                        </tr>
                        <tr>
                            <th>Commenced Date</th>
                            <td>{{showDateWithFormat($staff->staff_detail->commenced_date, "d-m-Y")}}</td>
                        </tr>
                        
                        <tr>
                            <th>Employment Status</th>
                            <td>{{ $employmentStatus }}</td>
                        </tr>
                        <tr>
                            <th>Employment Agreement</th>
                            <td>{{ ucfirst($staff->staff_detail->employment_agreement) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Section: Building Security -->
            <div class="col-12 my-2">
                <h6 class="text-blue-primary">Building Security</h6>
                <table class="table table-bordered mb-3">
                    <tbody>
                        <tr>
                            <th width="40%">Building Security</th>
                            <td width="60%">{{ ucfirst($staff->staff_detail->building_access_code) }}</td>
                        </tr>
                        <tr>
                            <th>Key Provided?</th>
                            <td> {{ ucfirst($staff->staff_detail->keys_issued) }}</td>
                        </tr>
                        <tr>
                            <th>Car Park?</th>
                            <td>{{ ucfirst($staff->staff_detail->car_parking) }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="col-12 my-2">
               
                <table class="table table-bordered mb-3">
                    <tbody>
                        <tr>
                            <th width="40%">Idle Time Preference</th>
                            <td width="60%">{{$idle_preference_time}}</td>
                        </tr>
                        <tr>
                            <th width="40%">2FA Authentication</th>
                            <td width="60%">{{ $twofa }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
         </div>    
        <div class="row">
            <div class="col-12 my-2 text-right">
            <form action="{{ route('admin.print_staff') }}" method="post" target="_blank">
                {{ csrf_field() }}
                <input name="user_id" type="hidden" id="user_print_id" class="user_print_id"
                    value="{{ $staff->id }}">
                <button type="submit" class="print-btn m-0">🖨️ Print Report</button>
                <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">Close</button>
            </form>
        </div>
        </div>
    </div>
</div>
