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

$countries = config('operator.country');
$countryName = isset($countries[$operator->country_id]['name']) ? $countries[$operator->country_id]['name'] : '';
$agreement_file = isset($operator->operator_detail->agreement_file) ? $operator->operator_detail->agreement_file : '';
@endphp
<style>
    .view_agent_details .table td, .view_agent_details .table th {
   padding: 10px .75rem !important;
}
</style>
<div class="row">
    <div class="col-sm-12 view_agent_details">
        {{-- <div class="card mb-3 p-3"> --}}
            <!-- Avatar + Name -->
            <div class="d-flex align-items-center mb-3">
                <img src="{{ asset('assets/img/default_user.png') }}" alt="Avatar" class="rounded-circle mr-3"
                    width="50" height="50">
                <h6 class="mb-0">{{ $operator->name }}</h6>
            </div>

            <!-- Operator Details -->
            <h6 class=" text-blue-primary">Operator Details</h6>
            <table class="table table-bordered mb-3">
                <tr>
                    <th width="40%"><b>Operator ID</b></th>
                    <td width="60%">{{ $operator->member_id }}</td>
                </tr>
                <tr>
                    <th> <b>Date Appointed </b></th>
                    <td>{{$appointedDate}}</td>
                </tr>
                <tr>
                    <th> <b>Company Name </b></th>
                    <td>{{ $operator->name }}</td>
                </tr>
                <tr>
                    <th> <b>Business Name </b></th>
                    <td>{{ $operator->business_name }}</td>
                </tr>
                <tr>
                    <th> <b>ABN </b></th>
                    <td>{{ $operator->abn }}</td>
                </tr>
                <tr>
                    <th> <b>Business Address </b></th>
                    <td>{{ $operator->business_address }}</td>
                </tr>
                <tr>
                    <th> <b>Business Number </b></th>
                    <td>{{ $operator->business_number }}</td>
                </tr>
                <tr>
                    <th> <b>Point of Contact </b></th>
                    <td>{{ $operator->operator_detail->point_of_contact }}</td>
                </tr>
                <tr>
                    <th> <b>Mobile </b></th>
                    <td>{{ $operator->phone }}</td>
                </tr>
                <tr>
                    <th> <b>Email </b></th>
                    <td>{{ $operator->email }}</td>
                </tr>
                <tr>
                    <th> <b>Territory </b></th>
                    <td>{{ $countryName }}</td>
                </tr>
                <tr>
                    <th> <b>Method of Contact </b></th>
                    <td>{{$contactTypesText}}</td>
                </tr>
            </table>
            <!-- Agreement Details -->
            <h6 class=" text-blue-primary">Agreement Details</h6>
            <table class="table table-bordered mb-3">
                <tr>
                    <th width="40%"><b>Agreement Date </b></th>
                    <td width="60%">{{$agreementDate}}</td>
                </tr>
                <tr>
                    <th><b>Term </b></th>
                    <td>{{ $operator->operator_detail->term }}</td>
                </tr>
                <tr>
                    <th><b>Fees </b></th>
                    <td>{{ $operator->operator_detail->fee }}</td>
                </tr>
                 @if(!empty($agreement_file))
                <tr>
                    <th><b>Agreement File </b></th>
                    <td><a href="{{ asset('storage') }}/{{$agreement_file}}" target="_blank" title="Click here to dowload or view agreement file." download>View Agreement</a></td>
                </tr>
                @endif
            </table>
            <!-- Commission -->
            <h6 class=" text-blue-primary">Commission</h6>
            <table class="table table-bordered mb-3">
                <tr>
                    <th width="60%"><b>Advertising</th>
                    <td width="40%">{{ $operator->operator_detail->commission_advertising_percent }}</td>
                </tr>
                <tr>
                    <th><b>Massage Centre (Registrations)</b></th>
                    <td>{{ $operator->operator_detail->commission_massage_centre_percent }}</td>
                </tr>
            </table>
        {{-- </div> --}}
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
