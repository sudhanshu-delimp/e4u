@if($lists->isNotEmpty())
<div class="row mt-4">
    @forelse ($lists as $index => $list)
    @php
    $status = 'Forfeited';
    $listBG = '#fff9eb;';
    $color = 'text-warning';
    $button = 'bg-warning';
    $head_icon = asset('assets/dashboard/img/forfeited.png') ;
    if(isset($list->advertiser_agent_request_user->status) && $list->advertiser_agent_request_user->status=='1')
    {
         $listBG = '#dcf7ea;';
         $status = 'Accepted';
         $color = 'text-success';
         $head_icon = asset('assets/dashboard/img/accept.png');
         $button = 'bg-success';
    }
    
   
    if(isset($list->advertiser_agent_request_user->status) && $list->advertiser_agent_request_user->status=='2')
    {
        $listBG = '#f8d2d2;';
        $status = 'Rejected';
        $color = 'text-danger';
        $head_icon = asset('assets/dashboard/img/reject.png');
        $button = 'bg-danger';
    }

   

    
    $contact_by = [];

    if ($list->contact_by_email) {
        $contact_by[] = '<span class="ml-2">By Email</span>';
    }
    if ($list->contact_by_mobile) {
        $contact_by[] = '<span class="ml-2">By Mobile</span>';
    }
    @endphp
    <div class="col-lg-4">
        
        <div class="card mb-4 shadow-sm border-0" > 
            <div class="card-body p-4" style="background:<?php echo $listBG;?>"> 
                <div class="d-flex align-items-end justify-content-between">

                    <div>
                        <h6 class="mb-1"><b>Member ID :</b> <span style="color: #333;">{{$list->user->member_id}}</span></h6>
                        <h6 class="mb-1"><b>Ref ID :</b> <span style="color: #333;">{{$list->ref_number}}</span></h6>
                        <h6 class="mb-1"><b>Name :</b> <span style="color: #333;"> {{$list->first_name.' '.$list->last_name  }}</span></h6>
                        <br>
                        <h6 class="{{$color}} font-weight-bold">Date  {{$status}} : <span>{{date('d-m-Y',strtotime($list->created_at))}}</span></h6>
                    </div>

                    <div>
                        <button type="button" class="btn btn-history p-0 {{$button}}" data-toggle="modal" data-target="#agent_modal_{{$list->id}}" style="font-size: 20px;">
                            <i class="fas fa-arrow-right text-white rotate-27 "></i>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>



   <!-- ================ Modal Popup ================================ -->
    <div class="modal fade upload-modal" id="agent_modal_{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="Agent_Name">
              
               <img src="{{ $head_icon  }}" style="width:40px;" alt="Request Accepted">
                Request : {{$status}}
            </h5>

         

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">
            <div class="card mb-4 border-0">
               <div class="card-body">
                  <div class="row">
                     <div class="col mt-0">
                        <div class="d-flex align-items-center">
                           <div class="avatar avatar-xl pr-3 mt-1 avatar_img">
                              <img src="{{ $list->user->avatar_img ? asset('avatars/' . $list->user->avatar_img) : asset('assets/img/default_user.png') }}" alt="Face 1">
                           </div>
                           <div class="ms-3 name">
                              <h5 class="primery_color normal_heading mb-0" data-toggle="modal" data-target="#Agent_Name"><a class="collapse-item" href="#"><b>{{$list->user->name ? $list->user->name : 'NA'}}</b></a></h5>
                              <h6 class="text-muted mb-0 small">
                                 Member ID : {{$list->user->member_id}}
                                 <span class="px-3">Ref : {{$list->ref_number}}</span>
                                 <span>Request Date : {{date('d-m-Y',strtotime($list->created_at))}}</span>

                              </h6>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card-body pt-4">
                     <div class="row">
                        <div class="col-md-12 list-sec pt-3">
                           <h6><b>Mobile :</b> <span class="ml-2">{{$list->user->phone}}</span></h6>
                           <h6><b>Email :</b> <span>{{$list->user->email}}</span></h6>
                           <h6><b>Home State :</b> <span class="ml-2">{{($list->user->state->country_code ? $list->user->state->country_code : 'NA')}}</span></h6>
                           <h6><b>Contact Method :</b> 
                              @if (!empty($contact_by))
                              {!! implode(' | ', $contact_by) !!}
                              @else
                              NA
                              @endif
                        </h6>
                        <h6>
                           <b>Comments:</b> 
                           <span class="text-justify">{{$list->comments}} </span>
                        </h6>
                        </div>
                        
                     </div>
                     <div class="row">
                        <div class="col-lg-12 text-right">
                           <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
    </div>

    
<!-- ================ Modal Popup ================================ -->
    @endforeach
</div>


<div class="d-flex justify-content-end pt-4">
    {{ $lists->appends(request()->query())->links('pagination::bootstrap-4') }}
</div>
@else

<div class="row mt-4">
<div class="col-12">
    <div class="alert alert-warning text-center">No history found.</div>
</div>
</div>
@endif