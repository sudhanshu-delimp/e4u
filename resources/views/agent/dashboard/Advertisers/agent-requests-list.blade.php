<div id="mainAccordion" class="row" style="row-gap: 20px;">


    @if($lists->isNotEmpty())
    @forelse ($lists as $index => $list)

    @php
    $contact_by = [];

    if ($list->contact_by_email) {
        $contact_by[] = '<span>By Email</span>';
    }
    if ($list->contact_by_mobile) {
        $contact_by[] = '<span>By Mobile</span>';
    }


    $capital_city = null;
    $state_name = "";
    if (isset($list->state_id)) {
    $home_state = $list->state_id;
    $cities = config("escorts.profile.states.{$home_state}.cities");
    $state_name = config("escorts.profile.states.{$home_state}.stateName");
    if (is_array($cities) && !empty($cities)) {
        $firstCityId = array_key_first($cities);
        $cityName = $cities[$firstCityId]['cityName'] ?? null;
        if ($cityName) {
            $capital_city = $state_name ? "{$cityName}, {$state_name}" : $cityName;
        }
    }
    }
    

    @endphp

    <div class="col-lg-6">
        <div class="card common-card">
            <div class="card-body p-0 statement-accordian">
                <div id="accordion1" class="myacording-design">
                    <div class="card border-0 p-0">
                        <div class="card-header">
                            <a class="card-link collapsed" data-toggle="collapse" href="#req{{$list->id}}" aria-expanded="false">
                                <div class="d-flex align-items-center stat-detls gap-20 ">
                                    <div class="avatar history_avtar">
                                        <img src="{{ $list->user->avatar_img ? asset('avatars/' . $list->user->avatar_img) : asset('assets/dashboard/img/no-image-light.png') }}" alt="avtar">
                                    </div>
                                    <div class="ms-3">
                                        <h5 class=" normal_heading mb-0" style="color: var(--peach)">
                                            <b>Agent Request</b>
                                        </h5>
                                        <span class="history_info">
                                            <span>Member ID : {{$list->user->member_id}}</span>
                                           <span class="devider"></span>
                                            <span>Ref : {{$list->ref_number}}</span> 
                                            <span class="devider"></span>
                                            <span>Request Date : {{date('d-m-Y',strtotime($list->created_at))}}</span>                                        

                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>                        
                         <hr />
                        <div id="req{{$list->id}}" class="collapse table-responsive" data-parent="#mainAccordion">
                            
                             <table class="table">
                                <tr>
                                    <th class="border py-2 font-weight-bold">Advertiser</th>
                                    <td class="border py-2">{{ $list->first_name.' ' .$list->last_name  }}</td>
                                </tr>
                                <tr>
                                    <th class="border py-2 font-weight-bold">Mobile</th>
                                    <td class="border py-2">{{$list->mobile_number}}</td>
                                </tr>
                                <tr>
                                    <th class="border py-2 font-weight-bold">Email</th>
                                    <td class="border py-2">{{$list->email}}</td>
                                </tr>
                                <tr>
                                    <th class="border py-2 font-weight-bold">Home State</th>
                                    <td class="border py-2">{{isset($list->user->state->name) ? $list->user->state->name : 'NA'}}</td>
                                </tr>
                                <tr>
                                    <th class="border py-2 font-weight-bold">Contact Method</th>
                                    <td class="border py-2">
                                        @php
                                            if ($list->contact_by_mobile && !$list->contact_by_email) {
                                                echo '<span>By Mobile</span>';
                                            } elseif ($list->contact_by_email && !$list->contact_by_mobile) {
                                                echo '<span>By Email</span>';
                                            } elseif ($list->contact_by_email && $list->contact_by_mobile) {
                                                echo '<span>By Mobile or By Email</span>';
                                            }
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <th class="border py-2 font-weight-bold">Comments</th>
                                    <td class="border py-2">{{$list->comments}}</td>
                                </tr>
                                <tr>
                                    <th class="border py-2 font-weight-bold">Address</th>
                                    <td class="border py-2">{{  $capital_city }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border">

                                    <div id="modal_map_{{ $list->id }}" 
                                            class="modal-map-container" 
                                            data-address="{{ $capital_city }}" 
                                            style="width: 100%; height: 200px; background: #f8f9fa;">


                                    <div class="map-loader d-flex align-items-center justify-content-center h-100 flex-column">
                                        <div class="spinner-border text-primary spinner-border-sm mb-2" role="status"></div>
                                        <span class="text-muted small">Loading Map...</span>
                                    </div>


                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer custom_card_footer">
                             <input type="button" value="Accept" class="btn-success-modal float-right accept" name="accept[]" id="{{$list->id}}">
                             <input type="button" value="Reject" class=" btn-cancel-modal shadow-none float-right reject" name="reject[]" id="{{$list->id}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- ############ Accept and Reject Popup ###################### -->
     <template id="accept-popup-template-{{$list->id}}">
        <div class="modal fade upload-modal" id="requestAccepted-{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="requestAccepted" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="requestAccepted">
                            <img src="{{ asset('assets/dashboard/img/accept.png') }}" class="custompopicon" alt="Request Accepted">
                            Request Accepted</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                            </span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <p>The invitation by {{$list->first_name.' '.$list->last_name  }} is confirmed and they have been notified of your acceptance.</p>
                                <p>Please ensure you make contact with {{$list->first_name.' '.$list->last_name  }} within 24 hours in accordance with the
                                    preferred method of contact.</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center justify-content-end">
                        <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </template>


    
    <template id="reject-popup-template-{{$list->id}}">
        <div class="modal fade upload-modal" id="requestRejected-{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="requestRejected" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="requestRejected"><img src="{{ asset('assets/dashboard/img/reject.png') }}" style="width:40px; margin-right:10px;" alt="Request Rejected"> Request Rejected</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <p>Your rejection of the invitation by {{$list->first_name.' '.$list->last_name  }} to become their Support Agent is confirmed and
                                    they have been notified.</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center justify-content-center">
                        <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <!-- ############ End Accept and Reject Popup ###################### -->
     @endforeach
     @else
    <div class="col-12">
        <div class="alert alert-warning text-center">There are presently no Agent Requests from Advertisers in your Territory.</div>
    </div>
    @endif
</div>

<div class="d-flex justify-content-end pt-4">
    {{ $lists->appends(request()->query())->links('pagination::bootstrap-4') }}
</div>
