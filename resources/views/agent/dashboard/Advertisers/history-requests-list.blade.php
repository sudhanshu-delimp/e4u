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
        $contact_by[] = '<span >By Email</span>';
    }
    if ($list->contact_by_mobile) {
        $contact_by[] = '<span >By Mobile</span>';
    }
    @endphp
    <div class="col-lg-4">
        
        <div class="card mb-4 shadow-sm border-0" > 
            <div class="card-body p-4" style="background:<?php echo $listBG;?>"> 
                <div class="d-flex align-items-end justify-content-between">

                    <div>
                        <h6 class="mb-1"><b>Member ID :</b> <span style="color: #333;">{{$list->user->member_id}}</span></h6>
                        <h6 class="mb-1"><b>Member Name :</b> <span style="color: #333;"> {{$list->first_name.' '.$list->last_name  }}</span></h6>
                        <!-- <h6 class="mb-1"><b>Ref ID :</b> <span style="color: #333;">{{$list->ref_number}}</span></h6> -->
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
    <div class="modal fade upload-modal" id="agent_modal_{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false" >
      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
         <div class="modal-content basic-modal">
            <div class="modal-header">
               <h5 class="modal-title" id="Agent_Name">              
                  <img src="{{ $head_icon  }}" style="width:35px; margin-right:10px;" alt="Request Accepted">
                  Request : {{$status}}
               </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
               </button>
            </div>
            <div class="modal-body">
               <div class="d-flex align-items-center gap-20">
                  <div class="avatar_img history_avtar">
                     <img src="{{ $list->user->avatar_img ? asset('avatars/' . $list->user->avatar_img) : asset('assets/dashboard/img/no-image-light.png') }}" alt="Face 1">
                  </div>
                  <div class="name">
                     <h5 class="primery_color normal_heading mb-0"><a class="collapse-item" href="#">
                        <b>{{ $list->first_name.' ' .$list->last_name  }}</b>
                     </a></h5>
                     <span class="history_info">
                        <span>Member ID : {{$list->user->member_id}}</span>
                        <span class="devider"></span>
                        <span>Ref : {{$list->ref_number}}</span>
                        <span class="devider"></span>
                        <span >Request Date : {{date('d-m-Y',strtotime($list->created_at))}}</span>
                        

                     </span>
                  </div>
               </div>
               <hr />
               <div class="table-responsive">
                  <table class="table">
                     <tr>
                        <th class="border py-2 font-weight-bold">Mobile</th>
                        <td class="border py-2">{{$list->mobile_number}}</td>
                     </tr>
                     <tr>
                        <th class="border py-2 font-weight-bold">Email</th>
                        <td class="border py-2">{{$list->user->email}}</td>
                     </tr>
                     <tr>
                        <th class="border py-2 font-weight-bold">Home State</th>
                        <td class="border py-2">{{($list->user->state->iso2 ? $list->user->state->iso2 : 'NA')}}</td>
                     </tr>
                     <tr>
                        <th class="border py-2 font-weight-bold">Contact Method</th>
                        <td class="border py-2">
                           @php
                              if ($list->contact_by_mobile && !$list->contact_by_email) {
                                 echo '<span >By Mobile</span>';
                              } elseif ($list->contact_by_email && !$list->contact_by_mobile) {
                                 echo '<span >By Email</span>';
                              } elseif ($list->contact_by_email && $list->contact_by_mobile) {
                                 echo '<span >By Mobile or By Email</span>';
                              }
                           @endphp
                        </td>
                     </tr>
                     <tr>
                        <th class="border py-2 font-weight-bold">Comments</th>
                        <td class="border py-2 text-justify">{{$list->comments}}</td>
                     </tr>
                     <tr>
                        <th class="border py-2 font-weight-bold">Address</th>
                        <td class="border py-2">Main Street Capital</td>
                     </tr>
                     <tr>
                        <td colspan="2" class="border">
                          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3313.9865807510487!2d151.2099951!3d-33.83845670000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12aef2a9f0cedd%3A0xdf638593999a897b!2sMain%20Street%20Capital!5e0!3m2!1sen!2sin!4v1789984607796!5m2!1sen!2sin" width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                        </td>
                     </tr>
                  </table>
                  <div>
                  </div>
               </div>
            </div>         
            <div class="modal-footer">
               <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">Close</button>                 
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