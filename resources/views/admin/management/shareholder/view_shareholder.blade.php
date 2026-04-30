@php
    $setting = $shareholder->shareholder_setting ?? null;
    $idle_preference_times = config('staff.idle_preference_time');
    $idle_preference_time = '';
    $twofa = '';
    if (isset($setting) && isset($setting->idle_preference_time)) {
        $idle_preference_time = isset($idle_preference_times[(string) $setting->idle_preference_time])
            ? $idle_preference_times[$setting->idle_preference_time]
            : '';
    }
    $twofas = config('staff.twofa');
    if (isset($setting) && isset($setting->twofa)) {
        $twofa = isset($twofas[$setting->twofa]) ? $twofas[$setting->twofa] : '';
    }

    $contactTypesText = '';
    $contactTypesArray = [];
    if (is_array($shareholder->contact_type)) {
        $contactType = $shareholder->contact_type;
    } elseif (!empty($shareholder->contact_type)) {
        $contactType = json_decode($shareholder->contact_type, true) ?? [];
    } else {
        $contactType = [];
    }
    if (count($contactType) > 0) {
        if (in_array('1', $contactType)) {
            $contactTypesArray[] = 'Messaging';
        }
        if (in_array('2', $contactType)) {
            $contactTypesArray[] = 'Text';
        }
        if (in_array('3', $contactType)) {
            $contactTypesArray[] = 'Email';
        }
        if (in_array('4', $contactType)) {
            $contactTypesArray[] = 'Call Us';
        }
    }
    $contactTypesText = implode(', ', $contactTypesArray);
    $contactKey = 1;
@endphp
<div class="modal-body">
    <div class="row">
        <div class="col-sm-12 view_staff_details">
            <!-- Avatar -->
            <div class="d-flex align-items-center mb-3">
                <img src="{{ asset('assets/img/default_user.png') }}" alt="Avatar" class="rounded-circle mr-3"
                    width="50" height="50">
                <h6 class="mb-0">{{ $shareholder->contact_person }}</h6>
            </div>
            <!-- Details Table -->
            <div class="col-12 my-2">
                <table class="table table-bordered mb-3">
                    <tr>
                        <th width="40%">Shareholder</th>
                        <td width="60%">{{ $shareholder->business_name }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $shareholder->business_address }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 my-2">
                <h6 class="text-blue-primary">Primary Contact</h6>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="40%">Contact</th>
                            <td width="60%">{{ $shareholder->contact_person }}</td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>{{ $shareholder->phone }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $shareholder->email }}</td>
                        </tr>
                    </tbody>
                </table>
                <!-- Key Contact -->
                @if ($shareholder->contacts)
                    @foreach ($shareholder->contacts as $contact)
                        <h6 class="text-blue-primary">Key Contact {{ $contactKey }}</h6>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="40%">Contact</th>
                                    <td width="60%">{{ $contact->name }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile</th>
                                    <td>{{ $contact->mobile }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $contact->email }}</td>
                                </tr>
                            </tbody>
                        </table>
                        @php
                            $contactKey = $contactKey + 1;
                        @endphp
                    @endforeach
                @endif
                <!-- End Key Contact -->
            </div>
            <div class="col-12 my-2">

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="40%">Method of Contact</th>
                            <td width="60%">{{ $contactTypesText }}</td>
                        </tr>
                        <tr>
                            <th>Idle Time Preference</th>
                            <td>{{ $idle_preference_time }}</td>
                        </tr>
                        <tr>
                            <th>2FA Authentication</th>
                            <td>{{ $twofa }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end modal-footer">
                <form action="{{ route('admin.print_shareholder') }}" method="post" target="_blank">
                    {{ csrf_field() }}
                    <input name="user_id" type="hidden" id="user_print_id" class="user_print_id"
                        value="{{ $shareholder->id }}">
                    <button type="submit" class="print-btn m-0">🖨️ Print Report</button>
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal"
                        aria-label="Close">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
