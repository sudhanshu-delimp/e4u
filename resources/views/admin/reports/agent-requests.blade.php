@extends('layouts.admin')
@section('style')
<style>
   td,
   th {
       vertical-align: middle !important;
       text-align: center;
   }
</style>
@endsection
@section('content')
<div class="container-fluid">
   <!--middle content-->
   <div class="row mt-5">      
      <div class="col-md-12 d-flex align-items-center justify-content-start flex-wrap">
        <h1  class="h1"> Agent Requests Reports</h1>
        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
     </div>
     <div class="col-md-12 ">
         <div class="card collapse  mb-4" id="notes">
             <div class="card-body">
                 <h3 class="NotesHeader"><b>Notes:</b> </h3>
                 <ol>
                     <li>Agent Requests logged by Advertisers are summarised here.</li>
                     <li>The Operations Team can action a Request.</li>
                 </ol>
             </div>
         </div>
     </div>
    <div class="col-md-12"> 
        <div class="row my-3">
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
            <div class="col-lg-8 col-md-12 col-sm-12 d-flex justify-content-end" style="gap: 50px;">
              
                <div class="total_listing">
                    <div><span>Total Appointments : </span></div>
                    <div><span>{{$lists->total()}}</span></div>
                </div>
            </div>
        </div>
        <div class="table-responsive membership--inner">
            <table class="table table-bordered text-center" id="agentRequestreportTable">
                <thead>
                   <tr>
                    <th>Ref</th>
                    <th>Request Date</th>
                    <th>Member ID</th>
                    <th>Mobile</th>
                    <th>Home State</th>
                    <th>Agents ID</th>
                    <th>Mobiles</th>
                    <th>Status</th>
                    <th>Accepted Date</th>
                    <th>Action</th>
                   </tr>
                </thead>
                <tbody>
                @if($lists->isNotEmpty())
                @foreach($lists as $index => $list)
                    
                    <tr>
                        <td>{{$list->ref_number}}</td>
                        <td>{{date('d-m-Y',strtotime($list->created_at))}}</td>
                        <td>{{$list->user->phone}}</td>
                        <td>{{$list->user->member_id}}</td>
                        <td>{{isset($list->user->state->country_code) ? $list->user->state->country_code : 'NA'}}</td>
                        <td> 
                             @if(isset($list->agent_request_users ) && count($list->agent_request_users)>0)
                             @foreach ($list->agent_request_users as $index => $agent_user)
                             {{isset($agent_user->user->member_id) ? $agent_user->user->member_id: 'NA' }} <br>
                             @endforeach
                             @endif

                        <td>

                             @if(isset($list->agent_request_users ) && count($list->agent_request_users)>0)
                             @foreach ($list->agent_request_users as $index => $agent_user)
                             {{isset($agent_user->user->phone) ? $agent_user->user->phone: 'NA' }} <br>
                             @endforeach
                             @endif

                        </td>
                        <td>
                           
                            @if(isset($list->agent_request_users ) && count($list->agent_request_users)>0)
                             @foreach ($list->agent_request_users as $index => $agent_user)
                                @if($agent_user->status==0)
                                <span class="open-badge">Open</span> <br> 
                                @elseif($agent_user->status==1)
                                <span class="accepted-badge">Accepted</span> <br> 
                                @elseif($agent_user->status==2)
                                <span class="declined-badge">Rejected</span> <br> 
                                @elseif($agent_user->status==3)
                                <span class="forfeited-badge">Forfeited</span> <br>
                                @endif
                             @endforeach
                             @endif
                            
                        </td>
                        <td>
                            @if(isset($list->agent_request_users ) && count($list->agent_request_users)>0)
                             @foreach ($list->agent_request_users as $index => $agent_user)
                              @if($agent_user->status==1)
                               {{date('d-m-Y',strtotime($agent_user->created_at))}}
                                @break
                              @endif
                             @endforeach
                             @endif            

                        </td>
                        <td class="theme-color text-center bg-white">
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                    <a class="dropdown-item align-item-custom" href="#" data-target="#confirmationPopup" data-toggle="modal"> <i class="fa fa-bell"></i> Follow Up</a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item align-item-custom" href="#" data-target="#viewAgentdetails" data-toggle="modal"> <i class="fa fa-eye" aria-hidden="true" ></i> View</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                       @endforeach
                        @else
                        <tr>
                        <td colspan="10">No List Found</td>
                        </tr>
                        @endif

                </tbody>
            </table>
        </div>
     </div>
   </div>
   
   
   <!--right side bar end-->
</div>
{{-- view popup --}}
<div class="modal fade upload-modal" id="viewAgentdetails" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content basic-modal">
          <div class="modal-header">
             <h5 class="modal-title" id="viewAgentdetails">Agent Request</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">
                <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
             </button>
          </div>
          <div class="modal-body pb-0">
             <div class="card mb-4 border-0">
                <div class="card-body">
                   <div class="row">
                      <div class="col mt-0">
                         <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl pr-3 mt-1">
                               <img src="{{ asset('assets/img/agn-img.png')}}">
                            </div>
                            <div class="ms-3 name">
                               <h5 class="primery_color normal_heading mb-0" data-toggle="modal" data-target="#Agent_Name"><a class="collapse-item" href="#"><b>Carla Brasil</b></a></h5>
                               <h6 class="text-muted mb-0 small">Member ID: E03152 <span class="ml-5 pl-3">Date: 19/08/2022</span></h6>
                            </div>
                         </div>
                      </div>
                   </div>
                   <div class="card-body row pt-4">
                      <div class="row">
                         <div class="col-md-6 list-sec pt-3">
                            <h6><b>Email:</b> <span>jhoannamae@e4u.com</span></h6>
                            <h6><b>Mobile:</b> <span class="ml-2">0123456789</span></h6>
                         </div>
                         <div class="col-md-6 list-sec pt-3">
                            <h6><b>Home State:</b> <span class="ml-2">SA</span></h6>
                            <h6><b>Contact Method:</b> <span class="ml-2">By Mobile</span></h6>
                         </div>
                      </div>
                      <div class="row">
                         <div class="col-md-12 list-sec pt-1">
                            <h6><b>Comments:</b> </h6>
                            <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Diam egestas erat diam mauris, purus auctor nibh tincidunt. Imperdiet lectus in ut phasellus id vulputate vestibulum purus. Nibh sapien arcu, urna lobortis commodo. Nunc consequat dui imperdiet vitae.</h6>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
{{-- end --}}
{{-- follow up popup confirmation--}}
<div class="modal fade upload-modal" id="confirmationPopup" tabindex="-1" role="dialog" aria-labelledby="confirmationPopup" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="confirmationPopup">Follow-up Notification</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
             </button>
          </div>
          <div class="modal-body pb-0">
                <div class="row">
                   <div class="col-12 my-2 text-center">
                        <p>Notification Send successfully</p>
                           
                   </div>
                </div>
          </div>
          <div class="modal-footer text-center justify-content-center">             
             <button type="button" class="btn-success-modal" data-dismiss="modal" aria-label="Close">Close</button>
          </div>
       </div>
    </div>
 </div>
{{-- end --}}


 @endsection
@section('script')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
   $(document).ready(function() {
       $('#agentRequestreportTable').DataTable({
           responsive: true,
           language: {
               search: "Search: _INPUT_",
               searchPlaceholder: "Search by Member ID or Agent ID...",
               lengthMenu: "Show _MENU_ entries",
               zeroRecords: "No matching records found",
               info: "Showing _START_ to _END_ of _TOTAL_ entries",
               infoEmpty: "No entries available",
               infoFiltered: "(filtered from _MAX_ total entries)"
           },
           paging: true
       });
   });
 </script>

@endsection
