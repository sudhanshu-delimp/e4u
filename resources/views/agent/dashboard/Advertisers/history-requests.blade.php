@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5">
   <!--middle content end here-->
   {{-- Page Heading   --}}
   <div class="row">
      <div class="d-flex align-items-center justify-content-start mt-5 flex-wrap col-lg-12">
         <h1 class="h1">History Requests</h1>
         <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
      </div>
      <div class="col-md-12 my-2">
         <div class="card collapse" id="notes" style="">
            <div class="card-body">
               <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
               <ol>
                  <li>When an Advertiser requests the services of an Agent <b>(Request)</b>, the Request will
                     appear here.</li>
                  <li>You can view the full details of the Request by clicking the accordion arrow. The
                     Request will provide you will all the details you need to decide whether or not you will
                     accept the invitation. The Advertiser’s preferred method of contact is also set out in the
                     Request.</li>
                  <li>If you accept to invitation, the Advertiser will be notified. You need to make contact with
                     the Advertiser within 24 hours.</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   {{-- end --}}
   <div class="row">
      <div class="col-md-12 pt-4">
         <div class="w-100">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card mb-4 border-0">
                     <div class="tab-content" id="myTabContent">
                        
                        <div class="tab-pane fade  active show" id="two" role="tabpanel" aria-labelledby="two-tab">
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="card mb-4 shadow-sm border-0">
                                    <div class="card-body" style="border-left: 10px solid #4BDE97;">
                                       <div class="row">
                                          <div class="col mt-0">
                                             <div class="d-flex align-items-center">
                                                <div class="ms-3 name">
                                                   <h6 class="mb-0">Carla Brasil <span style="font-size: 14px;color: #FF3C5F;">Member ID: E03152
                                                      </span> Accepted
                                                   </h6>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-auto">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true" data-toggle="modal" data-target="#Agent_Name"><i class="fa fa-eye" aria-hidden="true" style="color: #90A0B7;"></i></span>
                                             </button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="card mb-4 shadow-sm border-0">
                                    <div class="card-body" style="border-left: 10px solid #DC2243;">
                                       <div class="row">
                                          <div class="col mt-0">
                                             <div class="d-flex align-items-center">
                                                <div class="ms-3 name">
                                                   <h6 class="mb-0">Carla Brasil <span style="font-size: 14px;color: #FF3C5F;">Member ID: E03152
                                                      </span> Rejected
                                                   </h6>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-auto">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true" data-toggle="modal" data-target="#Agent_Name"><i class="fa fa-eye" aria-hidden="true" style="color: #90A0B7;"></i></span>
                                             </button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="card mb-4 shadow-sm border-0">
                                    <div class="card-body" style="border-left: 10px solid #4BDE97;">
                                       <div class="row">
                                          <div class="col mt-0">
                                             <div class="d-flex align-items-center">
                                                <div class="ms-3 name">
                                                   <h6 class="mb-0">Carla Brasil <span style="font-size: 14px;color: #FF3C5F;">Member ID: E03152
                                                      </span> Accepted
                                                   </h6>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-auto">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true" data-toggle="modal" data-target="#Agent_Name"><i class="fa fa-eye" aria-hidden="true" style="color: #90A0B7;"></i></span>
                                             </button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="card mb-4 shadow-sm border-0">
                                    <div class="card-body" style="border-left: 10px solid #4BDE97;">
                                       <div class="row">
                                          <div class="col mt-0">
                                             <div class="d-flex align-items-center">
                                                <div class="ms-3 name">
                                                   <h6 class="mb-0">Carla Brasil <span style="font-size: 14px;color: #FF3C5F;">Member ID: E03152
                                                      </span> Accepted
                                                   </h6>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-auto">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true" data-toggle="modal" data-target="#Agent_Name"><i class="fa fa-eye" aria-hidden="true" style="color: #90A0B7;"></i></span>
                                             </button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="card mb-4 shadow-sm border-0">
                                    <div class="card-body" style="border-left: 10px solid #DC2243;">
                                       <div class="row">
                                          <div class="col mt-0">
                                             <div class="d-flex align-items-center">
                                                <div class="ms-3 name">
                                                   <h6 class="mb-0">Carla Brasil <span style="font-size: 14px;color: #FF3C5F;">Member ID: E03152
                                                      </span> Rejected
                                                   </h6>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-auto">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true" data-toggle="modal" data-target="#Agent_Name"><i class="fa fa-eye" aria-hidden="true" style="color: #90A0B7;"></i></span>
                                             </button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="Agent_Name" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="Agent_Name">Agent Request History</h5>
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
                           <div class="avatar avatar-xl pr-3 mt-1">
                              <img src="{{ asset('assets/img/agn-img.png')}}">
                           </div>
                           <div class="ms-3 name">
                              <h5 class="primery_color normal_heading mb-0" data-toggle="modal" data-target="#Agent_Name"><a class="collapse-item" href="#"><b>Carla Brasil</b></a></h5>
                              <h6 class="text-muted mb-0 small">
                                 Member ID : E03152
                                 <span class="px-3">Request Date : 19/08/2022</span>
                                 <span>Ref : E98065</span>
                              </h6>
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
                           <h6 class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Diam egestas erat diam mauris, purus auctor nibh tincidunt. Imperdiet lectus in ut phasellus id vulputate vestibulum purus. Nibh sapien arcu, urna lobortis commodo. Nunc consequat dui imperdiet vitae.</h6>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
@endpush