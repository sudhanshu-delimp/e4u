@extends('layouts.operator')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <style type="text/css">
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0)
        }

        #Agent_Agreement .modal-dialog {
            max-width: 1000px !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 opr-console">
        <!--middle content start here-->
        <!-- Page Heading -->
        <div class="row">
            @php
                $agreementDate = '';

                if (is_array($operator->contact_type)) {
                    $contactType = $operator->contact_type;
                } elseif (!empty($operator->contact_type)) {
                    $contactType = json_decode($operator->contact_type, true) ?? [];
                } else {
                    $contactType = [99999];
                }
               

                $countries = config('operator.country');
                $countryName = isset($countries[$operator->country_id]['name'])
                    ? $countries[$operator->country_id]['name']
                    : '';

              ;

            @endphp
            <div class="operator-heading-wrapper col-lg-12">
                <h1 class="h1">View Our Account</h1>
                <span class="oprhelpNote font-weight-bold" data-toggle="collapse" data-target="#notes"
                    aria-expanded="true">Help?</span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="notes"><b>Notes:</b> </p>
                        <ol>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- end --}}
        <div class="row">

            <div class="col-md-12 commanAlert"></div>

            <!-- ALERT MESSAGE -->
            <div class="col-md-12 mb-3">
                <div id="formAlert" class="alert d-none rounded" role="alert"></div>
            </div>
            <div class="col-md-12 mb-5">
                <div id="accordion" class="myacording-design">
                    <div class="card">
                        <div class="card-header">
                            <a class="card-link collapsed" data-toggle="collapse" href="#abbrieviations"
                                aria-expanded="false">About Us</a>
                        </div>
                        <div id="abbrieviations" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body">
                                <form id="operatorProfile" class="v-form-design"
                                    action="{{ route('operator.account.update', [$operator->id]) }}" method="POST">
                                    <input type="hidden" name="user_id" value="{{ $operator->id }}">
                                    <input type="hidden" name="_token">
                                    <div class="row">
                                        <div class="col-md-10 px-0">

                                            <div class="row">
                                                <div class="col-12 my-2">
                                                    <h5>Personal Details</h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_id">Membership Number</label>
                                                        <span
                                                            class="form-control form-back">{{ $operator->member_id }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="date_appointed">Date Appointed</label>
                                                        <span
                                                            class="form-control form-back">{{ showDateWithFormat($operator->operator_detail->date_appointed, 'd-m-Y') }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Company Name</label>
                                                        <span class="form-control form-back">{{ $operator->name }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="business_name">Business Name</label>
                                                        <span
                                                            class="form-control form-back">{{ $operator->business_name }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="abn" class="my-agent">ABN</label>
                                                        <span class="form-control form-back">{{ $operator->abn }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="business_address">Business Address</label>

                                                        <span
                                                            class="form-control form-back">{{ $operator->business_address }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="business_number">Business Number</label>

                                                        <span
                                                            class="form-control form-back">{{ $operator->business_number }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="point_of_contact">Point of Contact</label>
                                                        <span
                                                            class="form-control form-back">{{ $operator->operator_detail->point_of_contact }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone">Mobile</label>
                                                        <span class="form-control form-back">{{ $operator->phone }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">{{ __('Email') }}</label>
                                                        <span class="form-control form-back">{{ $operator->email }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="countryName">Territory</label>
                                                        <span class="form-control form-back">{{ $countryName }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <h5 for="mobile">Method of contact - how we communicate with you</h5>
                                                    <div class="form-group custom--contact">

                                                        <div class="form-check-inline">
                                                            <label class="customradio mr-4">
                                                                <input type="checkbox" name="contact_type[]"
                                                                    value="1"
                                                                    @if (!empty($contactType)) {{ in_array(1, $contactType) ? 'checked' : null }}
                                              @else
                                                checked @endif
                                                                    disabled>
                                                                <span class="radiotextsty">Message (via Console)</span>
                                                            </label>

                                                            <label class="customradio mr-4">
                                                                <input type="checkbox" name="contact_type[]"
                                                                    value="2"
                                                                    @if (!empty($contactType)) {{ in_array(2, $contactType) ? 'checked' : null }} @endif
                                                                    disabled>
                                                                <span class="radiotextsty">Text</span>
                                                            </label>

                                                            <label class="customradio mr-4">
                                                                <input type="checkbox" name="contact_type[]"
                                                                    value="3"
                                                                    @if (!empty($contactType)) {{ in_array(3, $contactType) ? 'checked' : null }} @endif
                                                                    disabled>
                                                                <span class="radiotextsty">Email</span>
                                                            </label>

                                                            <label class="customradio mr-4">
                                                                <input type="checkbox" name="contact_type[]"
                                                                    value="4"
                                                                    @if (!empty($contactType)) {{ in_array(4, $contactType) ? 'checked' : null }} @endif
                                                                    disabled>
                                                                <span class="radiotextsty">Call me</span>
                                                            </label>
                                                            <span class="text-danger error-contact_type[]"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-12 my-2">
                                                            <h5>Fees</h5>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                               {{--  <label for="member_id">Fee</label> --}}
                                                                <span class="form-control form-back">
                                                                    {{ $operator->operator_detail->fee }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-12 my-2">
                                                            <h5>Commission
                                                            </h5>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="member_id">Advertising</label>
                                                                <span class="form-control form-back">
                                                                    {{ $operator->operator_detail->commission_advertising_percent }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="date_appointed">Massage Centre
                                                                    (Registrations)</label>
                                                                <span class="form-control form-back">
                                                                    {{ $operator->operator_detail->commission_massage_centre_percent }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

   
@endsection
@push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    
@endpush
