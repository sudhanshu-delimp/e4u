@php
$appointedDate = "";
$agreementDate = "";
$contactTypesText = "";
$contactTypesArray = [];
if(!empty($operator->operator_detail->date_appointed)){
     $appointedDate = showDateWithFormat($operator->operator_detail->date_appointed, "d-m-Y");
}

if(!empty($operator->operator_detail->agreement_date)){
     $agreementDate = showDateWithFormat($operator->operator_detail->agreement_date, "d-m-Y");
}

if (is_array($operator->contact_type)) {
    $contactType = $operator->contact_type;
} elseif (!empty($operator->contact_type)) {
    $contactType = json_decode($operator->contact_type, true) ?? [];
} else {
    $contactType = [];
}
if(count($contactType) > 0){
  if(in_array('1', $contactType)) {
    $contactTypesArray[] = 'Messaging';
  }
  if(in_array('2', $contactType)) {
    $contactTypesArray[] = 'Text';
  }
  if(in_array('3', $contactType)) {
    $contactTypesArray[] = 'Email';
  }
  if(in_array('4', $contactType)) {
    $contactTypesArray[] = 'Call Us';
  }
}
$contactTypesText = implode(", ", $contactTypesArray);

$states = config('escorts.profile.states');
$stateName = isset($states[$operator->state_id]['stateName']) ? $states[$operator->state_id]['stateName'] : '';


@endphp
<div class="row">
    <div class="col-12 custom-merchant-modal">
        <div class="card mb-3 p-3">
            <!-- Avatar + Name -->
            <div class="d-flex align-items-center mb-3">
                <img src="{{ asset('assets/img/default_user.png') }}" alt="Avatar" class="rounded-circle mr-3"
                    width="50" height="50">
                <h6 class="mb-0">{{ $operator->name }}</h6>
            </div>

            <!-- Merchant Details -->
            <h6 class=" text-blue-primary">Merchant Details</h6>
            <table class="table table-bordered mb-3">
                <tr>
                    <th width="40%">Operator ID</th>
                    <td width="60%">{{ $operator->member_id }}</td>
                </tr>
                <tr>
                    <th>Date Appointed</th>
                    <td>{{$appointedDate}}</td>
                </tr>
                <tr>
                    <th>Company Name</th>
                    <td>{{ $operator->name }}</td>
                </tr>
                <tr>
                    <th>Business Name</th>
                    <td>{{ $operator->business_name }}</td>
                </tr>
                <tr>
                    <th>ABN</th>
                    <td>{{ $operator->abn }}</td>
                </tr>
                <tr>
                    <th>Business Address</th>
                    <td>{{ $operator->business_address }}</td>
                </tr>
                <tr>
                    <th>Business Number</th>
                    <td>{{ $operator->business_number }}</td>
                </tr>
                <tr>
                    <th>Point of Contact</th>
                    <td>{{ $operator->operator_detail->point_of_contact }}</td>
                </tr>
                <tr>
                    <th>Mobile</th>
                    <td>{{ $operator->phone }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $operator->email }}</td>
                </tr>
                <tr>
                    <th>Territory</th>
                    <td>{{ $stateName }}</td>
                </tr>
                <tr>
                    <th>Method of Contact</th>
                    <td>{{$contactTypesText}}</td>
                </tr>
            </table>
            <!-- Agreement Details -->
            <h6 class=" text-blue-primary">Agreement Details</h6>
            <table class="table table-bordered mb-3">
                <tr>
                    <th width="40%">Agreement Date</th>
                    <td width="60%">{{$agreementDate}}</td>
                </tr>
                <tr>
                    <th>Term</th>
                    <td>{{ $operator->operator_detail->term }}</td>
                </tr>
                <tr>
                    <th>Fees</th>
                    <td>{{ $operator->operator_detail->fee }}</td>
                </tr>
            </table>
            <!-- Commission -->
            <h6 class=" text-blue-primary">Commission</h6>
            <table class="table table-bordered mb-3">
                <tr>
                    <th width="60%">Advertising</th>
                    <td width="40%">{{ $operator->operator_detail->commission_advertising_percent }}%</td>
                </tr>
                <tr>
                    <th>Massage Centre (Registrations)</th>
                    <td>{{ $operator->operator_detail->commission_massage_centre_percent }}%</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-lg-12">
        <!-- Footer Buttons -->
        <div class="col-12 my-2 text-right">
            <form action="{{ route('admin.print_operator') }}" method="post" target="_blank">
                {{ csrf_field() }}
                <input name="user_id" type="hidden" id="user_print_id" class="user_print_id"
                    value="{{ $operator->id }}">
                <button type="submit" class="print-btn m-0">🖨️ Print Report</button>
                <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">Close</button>
            </form>
        </div>
    </div>
</div>
