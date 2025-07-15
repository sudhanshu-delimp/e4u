@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content end here-->{{-- Page Heading   --}}
   <div class="row">
      <div class="custom-heading-wrapper col-lg-12">
         <h1 class="h1">Create Prospect</h1>
         <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes" style="">
            <div class="card-body">
               <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
               <ol>
                  <li>You must create the Prospective Member here before you can create an
                     Information Package for a Prospective Member.
                  </li>
                  <li>All Prospective Members remain in the list even after the Prospective Member
                     becomes a Member.
                  </li>
                  <li>Click the 'View' button under Action to view a summary of the Prospective Member.</li>
                  <p>
                     <span>MC = Massage Centre
                     </span>
                     <span class="px-3">E = Escort</span>
                     <span>AR = Agent Request
                          
                     </span>
                     <span class="px-3">C = Cold call</span>
                     <span>R = Referral</span>
                     <span class="px-3">PM = Prospective Member</span>
                     <span> M = Member</span>
                  </p>
               </ol>
            </div>
         </div>
      </div>
   </div>
   {{-- end --}}
   <div class="row">
      <div class="col-md-12">
         <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
               <form class="search-form-bg navbar-search">
                  <div class="input-group">
                     <input type="text" class="search-form-bg-i form-control border-0 small" placeholder="Search " aria-label="Search" aria-describedby="basic-addon2">
                     <div class="input-group-append">
                        <button class="btn-right-icon" type="button">
                        <i class="fas fa-search fa-sm"></i>
                        </button>
                     </div>
                  </div>
               </form>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12">
               <div class="bothsearch-form" style="gap: 10px;">
                  <button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#create-prospect">Create New  Prospect</button>
               </div>
            </div>
         </div>
         <div class="row mt-4">
            <div class="col-md-12">
               <div class="panel with-nav-tabs panel-warning">
                  <div class="panel-body">
                     <div class="tab-content">
                        <div class="tab-pane fade in active show" id="tab1warning">
                           <div class="table-responsive-xl">
                              <table class="table">
                                 <thead class="table-bg">
                                    <tr>
                                       <th scope="col">
                                          Ref
                                       </th>
                                       <th scope="col">Date</th>
                                       <th scope="col">
                                          Name
                                       </th>
                                       <th scope="col">
                                          Membership Type<sup>(1)</sup>
                                       </th>
                                       <th scope="col">Source<sup>(2)</sup></th>
                                       <th scope="col">Status<sup>(3)</sup></th>
                                       <th scope="col">Location</th>
                                       <th scope="col">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody class="table-content">
                                    <tr class="row-color">
                                       <td class="theme-color">1234</td>
                                       <td class="theme-color">30-06-22</td>
                                       <td class="theme-color">Carla Brasil</td>
                                       <td class="theme-color">MC</td>
                                       <td class="theme-color">C</td>
                                       <td class="theme-color">PM</td>
                                       <td class="theme-color">WA</td>
                                       <td>
                                          <div class="dropdown no-arrow ml-3">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Reply <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                     <tr class="row-color">
                                       <td class="theme-color">1234</td>
                                       <td class="theme-color">30-06-22</td>
                                       <td class="theme-color">Carla Brasil</td>
                                       <td class="theme-color">MC</td>
                                       <td class="theme-color">C</td>
                                       <td class="theme-color">PM</td>
                                       <td class="theme-color">WA</td>
                                       <td>
                                          <div class="dropdown no-arrow ml-3">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Reply <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                     <tr class="row-color">
                                       <td class="theme-color">1234</td>
                                       <td class="theme-color">30-06-22</td>
                                       <td class="theme-color">Carla Brasil</td>
                                       <td class="theme-color">MC</td>
                                       <td class="theme-color">C</td>
                                       <td class="theme-color">PM</td>
                                       <td class="theme-color">WA</td>
                                       <td>
                                          <div class="dropdown no-arrow ml-3">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Reply <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                     <tr class="row-color">
                                       <td class="theme-color">1234</td>
                                       <td class="theme-color">30-06-22</td>
                                       <td class="theme-color">Carla Brasil</td>
                                       <td class="theme-color">MC</td>
                                       <td class="theme-color">C</td>
                                       <td class="theme-color">PM</td>
                                       <td class="theme-color">WA</td>
                                       <td>
                                          <div class="dropdown no-arrow ml-3">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Reply <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                     <tr class="row-color">
                                       <td class="theme-color">1234</td>
                                       <td class="theme-color">30-06-22</td>
                                       <td class="theme-color">Carla Brasil</td>
                                       <td class="theme-color">MC</td>
                                       <td class="theme-color">C</td>
                                       <td class="theme-color">PM</td>
                                       <td class="theme-color">WA</td>
                                       <td>
                                          <div class="dropdown no-arrow ml-3">
                                             <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                             </a>
                                             <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Edit_Competitor">Reply <i class="fa fa-fw fa-pen " style="float: right;"></i></a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i></a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
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
                        </div>
                        <div class="tab-pane fade" id="tab2warning">
                           Revenue
                        </div>
                        <div class="tab-pane fade" id="tab3warning">
                           <div class="table-responsive-xl">
                              Sales
                           </div>
                        </div>
                        <div class="tab-pane fade" id="tab4warning">
                           <div class="table-responsive-xl">
                              Advertiser Credit
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      {{-- <div class="col-md-12 mt-4">
         <div class="row">
            <div class="col-md-6 mb-2">
               <div class="card">
                  <div class="card-body">

                     <h3 class="NotesHeader"><b>Notes:</b> </h3>
                     <ol>
                        <li>MC = Massage Centre   E = Escort
                        </li>
                        <li>AR = Agent Request      C = Cold call  R = Referral
                        </li>
                        <li>PM = Prospective Member M = Member     M = Member</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
      </div> --}}
   </div>
</div>

<div class="modal fade upload-modal" id="create-prospect" tabindex="-1" role="dialog" aria-labelledby="CompetitorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="create-prospect">Add Prospective Member</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">

            <ul class="nav tab-sec" id="myTab" role="tablist" style="gap: 0;">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">General</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Prospect</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Spend</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"> 
   <div class="table-responsive">
                           <table class="table table-nowrap mb-0 w-50">
                              <tbody class="table-content">
                                 <tr>
                                    <td class="pl-0 border-0"><b>Ref:</b> 1236</td>
                                    <td class="text-right border-0"><b>Date:</b> 12/31/2022</td>
                                 </tr>
                                 
                              </tbody>
                           </table>
                        </div>

<div class="row agent-tour pt-2 pb-4">
   <div class="col-md-6">
      <div class="form-group">
         <select class="custom-select" name="membership" id="membership">
            <option value="">Membership Type</option>
            <option value="1">Platinum</option>
            <option value="2">Gold</option>
            <option value="3">Silver</option>
         </select>
      </div>
   </div>
   <div class="col-md-6">
      <div class="form-group">
         <select class="custom-select" name="location" id="location">
            <option selected="">Source</option>
            <option>Source 1</option>
            <option>Source 2</option>
         </select>
      </div>
   </div>
   <div class="col-md-6">
      <div class="form-group">
         <select class="custom-select" name="location" id="location">
            <option selected="">Status</option>
            <option>Approved</option>
            <option>Panding</option>
         </select>
      </div>
   </div>
   <div class="col-md-6">
      <div class="form-group">
         <select class="custom-select rounded-0" name="location" id="location">
            <option selected="">Location</option>
            <option>Location 1</option>
            <option>Location 2</option>
         </select>
      </div>
   </div>
   <div class="col-md-12">
      <div class="form-group">
         <input type="button" value="Next" class="btn btn-primary shadow-none float-right" name="submit">
      </div>
   </div>
</div>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
   <div class="row agent-tour pt-2 pb-4">
   <div class="col-md-12">
      <div class="form-group">
         <input type="text" class="form-control" placeholder="Name">
      </div>
   </div>
   
   
   
   
<div class="col-md-12">
      <div class="form-group">
         <input type="text" class="form-control" placeholder="Address">
      </div>
   </div><div class="col-md-12">
      <div class="form-group">
         <input type="text" class="form-control" placeholder="Business Numner">
      </div>
   </div><div class="col-md-6">
      <div class="form-group">
         <input type="text" class="form-control" placeholder="Mobile">
      </div>
   </div><div class="col-md-6">
      <div class="form-group">
         <input type="text" class="form-control" placeholder="Email">
      </div>
   </div><div class="col-md-12">
      <div class="form-group">
         <input type="text" class="form-control" placeholder="Point of Contact">
      </div>
   </div><div class="col-md-6">
      <div class="form-group">
         <input type="text" class="form-control" placeholder="Mobile">
      </div>
   </div><div class="col-md-6">
      <div class="form-group">
         <input type="text" class="form-control" placeholder="Email">
      </div>
   </div><div class="col-md-12">
      <div class="form-group">
          <textarea class="form-control" placeholder="Comment" rows="5"></textarea>
      </div>
   </div>
   <div class="col-md-12">
      <div class="form-group">
         <input type="button" value="Next" class="btn btn-primary shadow-none float-right" name="submit">
      </div>
   </div></div>
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
     <div class="row agent-tour pt-2 pb-4">
   
   
   
   
   
<div class="col-md-6">
      <div class="form-group">
         <input type="text" class="form-control" placeholder="Competitor 1">
      </div>
   </div><div class="col-md-6">
      <div class="form-group">
         <input type="text" class="form-control" placeholder="Monthly Spend">
      </div>
   </div><div class="col-md-6">
      <div class="form-group">
         <input type="text" class="form-control" placeholder="Competitor 2">
      </div>
   </div>
   <div class="col-md-6">
      <div class="form-group">
         <input type="text" class="form-control" placeholder="Monthly Spend">
      </div>
   </div><div class="col-md-6">
      <div class="form-group">
         <input type="text" class="form-control" placeholder="Competitor 3">
      </div>
   </div><div class="col-md-6">
      <div class="form-group">
         <input type="text" class="form-control" placeholder="Monthly Spend">
      </div>
   </div><div class="col-md-12">
      <div class="form-group">
         <input type="button" value="Save" class="btn btn-primary shadow-none float-right" name="submit">
      </div>
   </div></div>
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