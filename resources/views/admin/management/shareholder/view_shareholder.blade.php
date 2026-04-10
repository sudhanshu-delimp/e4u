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
@endphp
<div class="modal-body">
    <div class="row">
        <div class="col-sm-12">
            <!-- Avatar -->
            <div class="d-flex align-items-center mb-3">
                <img src="{{ asset('assets/img/default_user.png') }}" alt="Avatar" class="rounded-circle mr-3"
                    width="50" height="50">
                <h6 class="mb-0">{{ $shareholder->contact_person }}</h6>
            </div>
            <!-- Details Table -->
            <table class="table table-bordered mb-3">
                <tr>
                    <th>Shareholder</th>
                    <td>{{ $shareholder->business_name }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $shareholder->business_address }}</td>
                </tr>
                <tr>
                    <th>Contact</th>
                    <td>{{ $shareholder->contact_person }}</td>
                </tr>
                <tr>
                    <th>Mobile</th>
                    <td>{{ $shareholder->phone }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $shareholder->email }}</td>
                </tr>
                <tr>
                    <th>Method of Contact</th>
                    <td>{{ $contactTypesText }}</td>
                </tr>
                <tr>
                    <th>Idle Time Preference</th>
                    <td>{{ $idle_preference_time }}</td>
                </tr>
                <tr>
                    <th>2FA Authentication</th>
                    <td>{{ $twofa }}</td>
                </tr>
            </table>

           
 <div class="d-flex justify-content-end modal-footer">
            <form action="{{ route('admin.print_shareholder') }}" method="post" target="_blank">
                {{ csrf_field() }}
                <input name="user_id" type="hidden" id="user_print_id" class="user_print_id"
                    value="{{ $shareholder->id }}">
                <button type="submit" class="print-btn m-0">🖨️ Print Report</button>
                <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">Close</button>
            </form>
  </div>