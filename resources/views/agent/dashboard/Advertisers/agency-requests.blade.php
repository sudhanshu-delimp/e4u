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
         <h1 class="h1">Agent Requests</h1>
         <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
      </div>
      <div class="col-md-12 my-2">
         <div class="card collapse" id="notes" style="">
            <div class="card-body">
               <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
               <ol>
               </ol>
            </div>
         </div>
      </div>
   </div>
   {{-- end --}}
   <div class="row">
      <div class="col-md-12">
         <div class="row ml-0 mt-5">
            <ul class="nav nav-tabs tab-sec">
               <li class="active"><a href="#one" data-toggle="tab" class="active">Requests</a></li>
               <li><a href="#two" data-toggle="tab" class="">Request History</a></li>
            </ul>
         </div>
      </div>
      <div class="col-md-12 pt-4">
         <div class="w-100">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card mb-4 border-0">
                     <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="one" role="tabpanel" aria-labelledby="one-tab">
                           <div class="row" style="row-gap: 20px;">
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                 <div class="card shadow-sm border-0">
                                    <div class="card-body pb-2 statement-accordian">
                                       <div id="accordion" class="myacording-design">
                                          <div class="card border-0 p-0">
                                             <div class="card-header">
                                                <a class="card-link collapsed" data-toggle="collapse" href="#Abbreviations" aria-expanded="false" style="
                                                   ">
                                                   <div class="d-flex align-items-center stat-detls" style="
                                                      ">
                                                      <div class="avatar avatar-xl pr-3 mt-1">
                                                         <img src="{{asset('assets/img/agn-img.png') }}" alt="Face 1">
                                                      </div>
                                                      <div class="ms-3 name">
                                                         <h5 class="primery_color normal_heading mb-0"><b>Carla Brasil</b></h5>
                                                         <h6 class="text-muted mb-0 small">Member ID: E03152 <span class="ml-5 pl-3">Date: 19/08/2022</span></h6>
                                                      </div>
                                                   </div>
                                                </a>
                                             </div>
                                             <div id="Abbreviations" class="collapse" data-parent="#accordion" aria-expanded="false" style="">
                                                <div class="row">
                                                   <div class="col-md-6 list-sec pt-3">
                                                      <h6><b>Email:</b> <span class="ml-2">jhoannamae@e4u.com</span></h6>
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
                                                <div class="row mt-2">
                                                   <div class="col-auto pr-0">
                                                      <input type="submit" value="Reject" class="btn btn-primary shadow-none float-right create-tour-sec" name="submit">
                                                   </div>
                                                   <div class="col-auto">
                                                      <input type="submit" value="Accept" class="btn btn-primary shadow-none float-right create-tour-sec" name="submit">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                 <div class="card shadow-sm border-0">
                                    <div class="card-body pb-2 statement-accordian">
                                       <div id="accordion" class="myacording-design">
                                          <div class="card border-0 p-0">
                                             <div class="card-header">
                                                <a class="card-link collapsed" data-toggle="collapse" href="#Accordian-2" aria-expanded="false" style="
                                                   ">
                                                   <div class="d-flex align-items-center stat-detls" style="
                                                      ">
                                                      <div class="avatar avatar-xl pr-3 mt-1">
                                                         <img src="{{asset('assets/img/agn-img.png') }}" alt="Face 1">
                                                      </div>
                                                      <div class="ms-3 name">
                                                         <h5 class="primery_color normal_heading mb-0"><b>Carla Brasil</b></h5>
                                                         <h6 class="text-muted mb-0 small">Member ID: E03152 <span class="ml-5 pl-3">Date: 19/08/2022</span></h6>
                                                      </div>
                                                   </div>
                                                </a>
                                             </div>
                                             <div id="Accordian-2" class="collapse" data-parent="#accordion" style="">
                                                <div class="row">
                                                   <div class="col-md-6 list-sec pt-3">
                                                      <h6><b>Email:</b> <span class="ml-2">jhoannamae@e4u.com</span></h6>
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
                                                <div class="row mt-2">
                                                   <div class="col-auto pr-0">
                                                      <input type="submit" value="Reject" class="btn btn-primary shadow-none float-right create-tour-sec" name="submit">
                                                   </div>
                                                   <div class="col-auto">
                                                      <input type="submit" value="Accept" class="btn btn-primary shadow-none float-right create-tour-sec" name="submit">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                 <div class="card shadow-sm border-0">
                                    <div class="card-body pb-2 statement-accordian">
                                       <div id="accordion" class="myacording-design">
                                          <div class="card border-0 p-0">
                                             <div class="card-header">
                                                <a class="card-link collapsed" data-toggle="collapse" href="#Accordian-3" aria-expanded="false" style="
                                                   ">
                                                   <div class="d-flex align-items-center stat-detls" style="
                                                      ">
                                                      <div class="avatar avatar-xl pr-3 mt-1">
                                                         <img src="{{asset('assets/img/agn-img.png') }}" alt="Face 1">
                                                      </div>
                                                      <div class="ms-3 name">
                                                         <h5 class="primery_color normal_heading mb-0"><b>Carla Brasil</b></h5>
                                                         <h6 class="text-muted mb-0 small">Member ID: E03152 <span class="ml-5 pl-3">Date: 19/08/2022</span></h6>
                                                      </div>
                                                   </div>
                                                </a>
                                             </div>
                                             <div id="Accordian-3" class="collapse" data-parent="#accordion" style="">
                                                <div class="row">
                                                   <div class="col-md-6 list-sec pt-3">
                                                      <h6><b>Email:</b> <span class="ml-2">jhoannamae@e4u.com</span></h6>
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
                                                <div class="row mt-2">
                                                   <div class="col-auto pr-0">
                                                      <input type="submit" value="Reject" class="btn btn-primary shadow-none float-right create-tour-sec" name="submit">
                                                   </div>
                                                   <div class="col-auto">
                                                      <input type="submit" value="Accept" class="btn btn-primary shadow-none float-right create-tour-sec" name="submit">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                 <div class="card shadow-sm border-0">
                                    <div class="card-body pb-2 statement-accordian">
                                       <div id="accordion" class="myacording-design">
                                          <div class="card border-0 p-0">
                                             <div class="card-header">
                                                <a class="card-link collapsed" data-toggle="collapse" href="#Accordian-4" aria-expanded="false" style="
                                                   ">
                                                   <div class="d-flex align-items-center stat-detls" style="
                                                      ">
                                                      <div class="avatar avatar-xl pr-3 mt-1">
                                                         <img src="{{asset('assets/img/agn-img.png') }}" alt="Face 1">
                                                      </div>
                                                      <div class="ms-3 name">
                                                         <h5 class="primery_color normal_heading mb-0"><b>Carla Brasil</b></h5>
                                                         <h6 class="text-muted mb-0 small">Member ID: E03152 <span class="ml-5 pl-3">Date: 19/08/2022</span></h6>
                                                      </div>
                                                   </div>
                                                </a>
                                             </div>
                                             <div id="Accordian-4" class="collapse" data-parent="#accordion" style="">
                                                <div class="row">
                                                   <div class="col-md-6 list-sec pt-3">
                                                      <h6><b>Email:</b> <span class="ml-2">jhoannamae@e4u.com</span></h6>
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
                                                <div class="row mt-2">
                                                   <div class="col-auto pr-0">
                                                      <input type="submit" value="Reject" class="btn btn-primary shadow-none float-right create-tour-sec" name="submit">
                                                   </div>
                                                   <div class="col-auto">
                                                      <input type="submit" value="Accept" class="btn btn-primary shadow-none float-right create-tour-sec" name="submit">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                 <div class="card shadow-sm border-0">
                                    <div class="card-body pb-2 statement-accordian">
                                       <div id="accordion" class="myacording-design">
                                          <div class="card border-0 p-0">
                                             <div class="card-header">
                                                <a class="card-link collapsed" data-toggle="collapse" href="#Accordian-5" aria-expanded="false" style="
                                                   ">
                                                   <div class="d-flex align-items-center stat-detls" style="
                                                      ">
                                                      <div class="avatar avatar-xl pr-3 mt-1">
                                                         <img src="{{asset('assets/img/agn-img.png') }}" alt="Face 1">
                                                      </div>
                                                      <div class="ms-3 name">
                                                         <h5 class="primery_color normal_heading mb-0"><b>Carla Brasil</b></h5>
                                                         <h6 class="text-muted mb-0 small">Member ID: E03152 <span class="ml-5 pl-3">Date: 19/08/2022</span></h6>
                                                      </div>
                                                   </div>
                                                </a>
                                             </div>
                                             <div id="Accordian-5" class="collapse" data-parent="#accordion" style="">
                                                <div class="row">
                                                   <div class="col-md-6 list-sec pt-3">
                                                      <h6><b>Email:</b> <span class="ml-2">jhoannamae@e4u.com</span></h6>
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
                                                <div class="row mt-2">
                                                   <div class="col-auto pr-0">
                                                      <input type="submit" value="Reject" class="btn btn-primary shadow-none float-right create-tour-sec" name="submit">
                                                   </div>
                                                   <div class="col-auto">
                                                      <input type="submit" value="Accept" class="btn btn-primary shadow-none float-right create-tour-sec" name="submit">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                 <div class="card shadow-sm border-0">
                                    <div class="card-body pb-2 statement-accordian">
                                       <div id="accordion" class="myacording-design">
                                          <div class="card border-0 p-0">
                                             <div class="card-header">
                                                <a class="card-link collapsed" data-toggle="collapse" href="#Accordian-6" aria-expanded="false" style="
                                                   ">
                                                   <div class="d-flex align-items-center stat-detls" style="
                                                      ">
                                                      <div class="avatar avatar-xl pr-3 mt-1">
                                                         <img src="{{asset('assets/img/agn-img.png') }}" alt="Face 1">
                                                      </div>
                                                      <div class="ms-3 name">
                                                         <h5 class="primery_color normal_heading mb-0"><b>Carla Brasil</b></h5>
                                                         <h6 class="text-muted mb-0 small">Member ID: E03152 <span class="ml-5 pl-3">Date: 19/08/2022</span></h6>
                                                      </div>
                                                   </div>
                                                </a>
                                             </div>
                                             <div id="Accordian-6" class="collapse" data-parent="#accordion" style="">
                                                <div class="row">
                                                   <div class="col-md-6 list-sec pt-3">
                                                      <h6><b>Email:</b> <span class="ml-2">jhoannamae@e4u.com</span></h6>
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
                                                <div class="row mt-2">
                                                   <div class="col-auto pr-0">
                                                      <input type="submit" value="Reject" class="btn btn-primary shadow-none float-right create-tour-sec" name="submit">
                                                   </div>
                                                   <div class="col-auto">
                                                      <input type="submit" value="Accept" class="btn btn-primary shadow-none float-right create-tour-sec" name="submit">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <nav aria-label="Page navigation example">
                              <ul class="pagination float-right pt-4">
                                 <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">«</span>
                                    <span class="sr-only">Previous</span>
                                    </a>
                                 </li>
                                 <li class="page-item"><a class="page-link" href="#">1</a></li>
                                 <li class="page-item"><a class="page-link" href="#">2</a></li>
                                 <li class="page-item"><a class="page-link" href="#">3</a></li>
                                 <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">»</span>
                                    <span class="sr-only">Next</span>
                                    </a>
                                 </li>
                              </ul>
                           </nav>
                        </div>
                        <div class="tab-pane fade" id="two" role="tabpanel" aria-labelledby="two-tab">
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
            <h5 class="modal-title" id="Agent_Name">Agent Request</h5>
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
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
@endpush