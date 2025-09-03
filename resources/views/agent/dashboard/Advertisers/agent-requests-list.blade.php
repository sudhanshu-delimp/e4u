<div id="mainAccordion" class="row" style="row-gap: 20px;">


    @if($lists->isNotEmpty())
    @forelse ($lists as $index => $list)

    @php
    $contact_by = [];

    if ($list->contact_by_email) {
        $contact_by[] = '<span class="ml-2">By Email</span>';
    }
    if ($list->contact_by_mobile) {
        $contact_by[] = '<span class="ml-2">By Mobile</span>';
    }
    @endphp

    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card shadow-sm border-0">
            <div class="card-body pb-2 statement-accordian">
                <div id="accordion1" class="myacording-design">
                    <div class="card border-0 p-0">
                        <div class="card-header">
                            <a class="card-link collapsed" data-toggle="collapse" href="#req{{$list->id}}" aria-expanded="false">
                                <div class="d-flex align-items-center stat-detls">
                                    <div class="avatar avatar-xl pr-3 mt-1">
                                    <img src="{{ $list->user->avatar_img ? asset('avatars/' . $list->user->avatar_img) : asset('assets/img/default_user.png') }}" alt="Face 1">
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="primery_color normal_heading mb-0">
                                            <b>Agent Request</b>
                                        </h5>
                                        <h6 class="text-muted mb-0 small">
                                            Member ID : {{$list->user->member_id}}
                                           
                                            <span class="pl-3">Ref : {{$list->ref_number}}</span> <br>
                                            <span>Request Date : {{date('d-m-Y',strtotime($list->created_at))}}</span>
                                          

                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div id="req{{$list->id}}" class="collapse" data-parent="#mainAccordion">
                            
                           
                            <div class="row mt-3">
                                <div class="col-md-12 list-sec pt-1">

                               

                                   <h6><b>Advertiser :</b> <span class="ml-2"> {{ $list->user->name }} </span></h6>
                                    <h6><b>Mobile :</b> <span class="ml-2"> {{$list->mobile_number}}</span></h6>

                                    <h6><b>Email :</b> <span class="ml-2"> {{$list->email}}</span></h6>

                                    <h6><b>Home State :</b>
                                        <span class="ml-2">{{isset($list->user->state->name) ? $list->user->state->name : 'NA'}}</span>
                                    </h6>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 list-sec pt-1">
                                    
                                    <h6><b>Contact Method :</b>

                                        @if (!empty($contact_by))
                                        {!! implode(' | ', $contact_by) !!}
                                        @else
                                        NA
                                        @endif

                                    </h6>

                                    <h6><b>Comments :</b>
                                    <span class="text-justify">

                                        {{$list->comments}}
                                    </span>
                                    </h6>
                                </div>                               
                            </div>
                            <div class="row mt-2">

                                <div class="col-auto">
                                    <input type="button" value="Accept" class="btn-success-modal float-right accept" name="accept[]" id="{{$list->id}}">
                                </div>
                                <div class="col-auto pr-0">
                                    <input type="button" value="Reject" class=" btn-cancel-modal shadow-none float-right reject" name="reject[]" id="{{$list->id}}">
                                </div>
                            </div>
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
                        <img src="{{ asset('assets/dashboard/img/accept.png') }}" style="width:40px; margin-right:10px;" alt="Request Accepted">
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
                <div class="modal-footer text-center justify-content-center">
                    <button type="button" class="btn-success-modal" data-dismiss="modal" aria-label="Close">Close</button>
                </div>
            </div>
        </div>
    </div>
    </template>


    
    <template id="reject-popup-template-{{$list->id}}">
    <div class="modal fade upload-modal" id="requestRejected-{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="requestRejected" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
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
                    <button type="button" class="btn-success-modal" data-dismiss="modal" aria-label="Close">Close</button>
                </div>
            </div>
        </div>
    </div>
    </template>
    <!-- ############ End Accept and Reject Popup ###################### -->
     @endforeach
     @else
    <div class="col-12">
        <div class="alert alert-warning text-center">No records found.</div>
    </div>
    @endif
</div>

<div class="d-flex justify-content-end pt-4">
    {{ $lists->appends(request()->query())->links('pagination::bootstrap-4') }}
</div>

<style>
.avatar img {
   width: 60px; height: 60px;
   border-radius: 50%;
}
</style>