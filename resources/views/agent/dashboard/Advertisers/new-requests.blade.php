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
         <h1 class="h1">New Requests</h1>
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
      <div class="col-lg-12">
         <div class="custom-search-form">
            <form>
               <label for="search">Search : </label> <input type="search" name="" id="" placeholder="Search by Member ID">
            </form>
         </div>
      </div>
      <div class="col-md-12 pt-4">
         <div id="mainAccordion" class="row" style="row-gap: 20px;">
               <!-- CARD 1 -->
               <div class="col-lg-4 col-md-6 col-sm-12">
                  <div class="card shadow-sm border-0">
                     <div class="card-body pb-2 statement-accordian">
                     <div id="accordion1" class="myacording-design">
                        <div class="card border-0 p-0">
                           <div class="card-header">
                           <a class="card-link collapsed" data-toggle="collapse" href="#req1" aria-expanded="false">
                              <div class="d-flex align-items-center stat-detls">
                                 <div class="avatar avatar-xl pr-3 mt-1">
                                 <img src="{{asset('assets/img/agn-img.png') }}" alt="Face 1">
                                 </div>
                                 <div class="ms-3 name">
                                 <h5 class="primery_color normal_heading mb-0"><b>Carla Brasil</b></h5>
                                 <h6 class="text-muted mb-0 small">
                                    Member ID : E03152
                                    <span class="px-3">Request Date : 19/08/2022</span>
                                    <span>Ref : E98065</span>
                                 </h6>
                                 </div>
                              </div>
                           </a>
                           </div>
                           <div id="req1" class="collapse" data-parent="#mainAccordion">
                              <div class="row">
                                 <div class="col-md-6 list-sec pt-3">
                                    <h6><b>Mobile:</b> <span class="ml-2">0123456789</span></h6>
                                    <h6><b>Email:</b> <span class="ml-2">jhoannamae@e4u.com</span></h6>
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
                              <div class="row mt-2">
                                 
                                 <div class="col-auto">
                                    <input type="submit" value="Accept" class="btn-success-modal float-right" name="submit" data-target="#requestAccepted" data-toggle="modal">
                                 </div>
                                 <div class="col-auto pr-0">
                                    <input type="submit" value="Reject" class=" btn-cancel-modal shadow-none float-right" name="submit" data-target="#requestRejected" data-toggle="modal">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     </div>
                  </div>
               </div>
               
               <!-- CARD 2 -->
               <div class="col-lg-4 col-md-6 col-sm-12">
                  <div class="card shadow-sm border-0">
                     <div class="card-body pb-2 statement-accordian">
                     <div id="accordion2" class="myacording-design">
                        <div class="card border-0 p-0">
                           <div class="card-header">
                           <a class="card-link collapsed" data-toggle="collapse" href="#req2" aria-expanded="false">
                              <div class="d-flex align-items-center stat-detls">
                                 <div class="avatar avatar-xl pr-3 mt-1">
                                 <img src="{{asset('assets/img/agn-img.png') }}" alt="Face 2">
                                 </div>
                                 <div class="ms-3 name">
                                 <h5 class="primery_color normal_heading mb-0"><b>Maria Fernanda</b></h5>
                                 <h6 class="text-muted mb-0 small">
                                    Member ID : E03153
                                    <span class="px-3">Request Date : 20/08/2022</span>
                                    <span>Ref : E98066</span>
                                 </h6>
                                 </div>
                              </div>
                           </a>
                           </div>
                           <div id="req2" class="collapse" data-parent="#mainAccordion">
                           <div class="row">
                              <div class="col-md-6 list-sec pt-3">
                                 <h6><b>Mobile:</b> <span class="ml-2">0123456789</span></h6>
                                 <h6><b>Email:</b> <span class="ml-2">jhoannamae@e4u.com</span></h6>
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
                              <div class="row mt-2">
                                 
                                 <div class="col-auto">
                                    <input type="submit" value="Accept" class="btn-success-modal float-right" name="submit" data-target="#requestAccepted" data-toggle="modal">
                                 </div>
                                 <div class="col-auto pr-0">
                                    <input type="submit" value="Reject" class=" btn-cancel-modal shadow-none float-right" name="submit" data-target="#requestRejected" data-toggle="modal">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     </div>
                  </div>
               </div>
               
               <!-- CARD 3 -->
               <div class="col-lg-4 col-md-6 col-sm-12">
                  <div class="card shadow-sm border-0">
                     <div class="card-body pb-2 statement-accordian">
                     <div id="accordion3" class="myacording-design">
                        <div class="card border-0 p-0">
                           <div class="card-header">
                           <a class="card-link collapsed" data-toggle="collapse" href="#req3" aria-expanded="false">
                              <div class="d-flex align-items-center stat-detls">
                                 <div class="avatar avatar-xl pr-3 mt-1">
                                 <img src="{{asset('assets/img/agn-img.png') }}" alt="Face 3">
                                 </div>
                                 <div class="ms-3 name">
                                 <h5 class="primery_color normal_heading mb-0"><b>Julia Santos</b></h5>
                                 <h6 class="text-muted mb-0 small">
                                    Member ID : E03154
                                    <span class="px-3">Request Date : 21/08/2022</span>
                                    <span>Ref : E98067</span>
                                 </h6>
                                 </div>
                              </div>
                           </a>
                           </div>
                           <div id="req3" class="collapse" data-parent="#mainAccordion">
                           <div class="row">
                              <div class="col-md-6 list-sec pt-3">
                                 <h6><b>Mobile:</b> <span class="ml-2">0123456789</span></h6>
                                 <h6><b>Email:</b> <span class="ml-2">jhoannamae@e4u.com</span></h6>
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
                              <div class="row mt-2">
                                 
                                 <div class="col-auto">
                                    <input type="submit" value="Accept" class="btn-success-modal float-right" name="submit" data-target="#requestAccepted" data-toggle="modal">
                                 </div>
                                 <div class="col-auto pr-0">
                                    <input type="submit" value="Reject" class=" btn-cancel-modal shadow-none float-right" name="submit" data-target="#requestRejected" data-toggle="modal">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     </div>
                  </div>
               </div>
         </div>
         {{-- pagination --}}
         <nav aria-label="Page navigation example">
            <ul class="pagination float-right pt-4">
               <li class="page-item">
                  <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">Previous</span>
                  <span class="sr-only">Previous</span>
                  </a>
               </li>
               <li class="page-item active"><a class="page-link" href="#">1</a></li>
               <li class="page-item "><a class="page-link" href="#">2</a></li>
               <li class="page-item">
                  <a class="page-link" href="#" aria-label="Next">
                  <span aria-hidden="true">Next</span>
                  <span class="sr-only">Next</span>
                  </a>
               </li>
            </ul>
         </nav>
      </div>
   </div>
</div>
{{-- Request Accepted Popup --}}
<div class="modal fade upload-modal" id="requestAccepted" tabindex="-1" role="dialog" aria-labelledby="requestAccepted" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="requestAccepted">Request Accepted</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">
               <div class="row">
                  <div class="col-12 mb-3">
                       <p>The invitation by [Carla Brasil] is confirmed and they have been notified of your acceptance.</p>
                           <p>Please ensure you make contact with [Name] within 24 hours in accordance with the
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
{{-- end --}}

{{-- Request Rejected Popup --}}
<div class="modal fade upload-modal" id="requestRejected" tabindex="-1" role="dialog" aria-labelledby="requestRejected" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="requestRejected">Request Rejected</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">
               <div class="row">
                  <div class="col-12 mb-3">
                       <p>Your rejection of the invitation by [Name] to become their Support Agent is confirmed and
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
{{-- end --}}
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
@endpush