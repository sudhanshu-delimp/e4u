@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
   .select2-container .select2-choice, .select2-result-label {
   font-size: 1.5em;
   height: 52px !important;
   overflow: auto;
   }
   .select2-arrow, .select2-chosen {
   padding-top: 6px;
   }
   span.select2.select2-container.select2-container--default > span.selection > span {
   height: 52px !important;
   }
</style>
@endsection
@section('content')
<div id="wrapper">
   <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
         <!--profile content-->
         <div class="container-fluid">
            <div class="row">
                <div class="col-sm-10 col-md-10 col-lg-10">
                    <div class="container-fluid" style="padding:0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bread-sec pl-0">
                                <li class="breadcrumb-item"><a href="#" style=""><i class="fas fa-long-arrow-alt-left"></i>&nbsp;&nbsp;Back To</a></li>
                                <li class="breadcrumb-item active" aria-current="page">to Advertiser list</li>
                            </ol>
                        </nav>
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 font-weight-bold">Manage Profile (Jane Power)</h1>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <form class="search-form-bg navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="search-form-bg-i form-control border-0 small" placeholder="Search " aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append"><button class="btn-right-icon" type="button"><i class="fas fa-search fa-sm"></i></button></div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-8 col-md-12 col-sm-12">
                                <div class="bothsearch-form"><button type="button" class="btn btn-primary create-tour-sec dctour">Create New Profile</button></div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel with-nav-tabs panel-warning">
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active show" id="tab1warning">
                                          <div class="table-responsive-xl" id="table-sec">
                                             <table class="table" id="onlyEscortList">
                                                    <thead class="table-bg">
                                                        <tr>
                                                            <th scope="col">Profile Name</th>
                                                            <th scope="col">Mobile Number</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">Membership</th>
                                                            <th scope="col">Home State</th>
                                                            <th scope="col">Age</th>
                                                            <th scope="col">Vaccine</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-content">
                                                        <tr class="row-color">
                                                            <td><img src="{{ asset('assets/app/img/profile-image.png')}}">Kathryn Murphy</td>
                                                            <td class="theme-color">0434043981</td>
                                                            <td class="theme-color">Female</td>
                                                            <td class="theme-color">Gold</td>
                                                            <td class="theme-color">SA</td>
                                                            <td class="theme-color">25</td>
                                                            <td class="theme-color">Vaccinated, up to date</td>
                                                            <td class="theme-color">
                                                                <div class="dropdown no-arrow">
                                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a>
                                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                                        <a class="dropdown-item" id="manage-profile" href="#">Edit Profile</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Delete Profile</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

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

         {{--<!--end profile content-->
         <div class="container-fluid" id="replace-item">
            <!--middle content-->
            <div class="row">
               <div class="col-sm-10 col-md-10 col-lg-10">
                  <!-- Begin Page Content -->
                  <div class="container-fluid" style="padding: 0px 0px;">
                     <!-- Page Heading -->
                     <div class="d-flex align-items-center mb-3">
                        <div class="v-main-heading h3">Advertiser List 22</div>
                     </div>
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
                                       <div class="bothsearch-form">
                                          <button type="button" class="btn btn-primary create-tour-sec dctour" onclick="window.print();return false;">Print Report</button>
                                       </div>
                                    </div>
                     </div>
                  </div>
                  <!-- /.container-fluid --><br>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card mb-3">
                           <div class="card-body pb-0">
                              <p class="mb-1"><b>Notes</b> </p>
                              <ol class="pl-4">
                                 <li style="font-size: 15px;">You can access all of your Advertisers here.  The report 'Earnings' column is Commission paid to you by E4U according to the Advertiser's spend.</li>
                                 <li style="font-size: 15px;" class="mb-0">Click the 'Action' button and select from the range of options available to you including Messaging to an Advertiser.</li>
                              </ol>
                           </div>
                        </div>
                        <div class="panel with-nav-tabs panel-warning">
                           <div class="panel-body">
                              <div class="tab-content">
                                 <div class="tab-pane fade in active show" id="tab1warning">
                                    <div class="table-responsive-xl" id="table-sec">
                                       <table class="table" id="onlyEscortList2">
                                         <thead class="table-bg">
                                             <tr>
                                                <th scope="col">Member ID
                                                </th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Mobile</th><th scope="col">Email</th><th scope="col">Contact</th><th scope="col">Home State</th>
                                                <th scope="col">Joined</th>
                                                <th scope="col">Appointed</th><th scope="col">Earnings</th>
                                                <th scope="col">Action</th>
                                             </tr>
                                          </thead>                                          <tbody class="table-content">
                                             <-- <tr class="row-color">
                                                <td class="theme-color">E03153</td>
                                                <td class="theme-color">Carla</td>
                                                <td class="theme-color">09876543210</td>
                                                <td class="theme-color">demo@gmail.com</td>
                                                <td class="theme-color">Mobile</td>
                                                <td class="theme-color">WA</td><td class="theme-color">19/02/2022</td><td class="theme-color">25/02/2022</td><td class="theme-color">$200</td><td class="theme-color">
                                                   <div class="dropdown no-arrow">
                                                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                      </a>
                                                      <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                         <a class="dropdown-item" id="manage-profile" href="#">Manage Profile</a>
                                                         <div class="dropdown-divider"></div>
                                                         <a class="dropdown-item" id="manage-tour" href="#">Manage Tour</a>
                                                         <div class="dropdown-divider"></div>
                                                         <a class="dropdown-item" href="#">Manage Media</a>
                                                         <div class="dropdown-divider"></div>
                                                         <a class="dropdown-item" href="#" id="manage-concierge">Manage Concierge &amp; Services</a><div class="dropdown-divider"></div>
                                                         <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewticket">Print Report</a>
                                                      </div>
                                                   </div>
                                                </td>
                                             </tr> -->
                                          </tbody>
                                       </table>

                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--middle content end here-->
               <!--right side bar start from here-->
            </div>
            <!--right side bar end-->
         </div>--}}
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="Tour_Name" tabindex="-1" role="dialog" aria-labelledby="Tour_NameLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
   <div class="modal-content basic-modal">
      <div class="modal-header">
         <h5 class="modal-title" id="Tour_Name">Create New Tour</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
         </button>
      </div>
      <div class="modal-body pb-0 agent-tour">
         <div class="form-group">
            <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Tour Name">
         </div>
         <div id="accordion" class="myacording-design">
            <div class="card">
               <div class="card-header"> <a class="card-link collapsed" data-toggle="collapse" href="#new_tour" aria-expanded="false">Western Australia</a> </div>
               <div class="collapse show" data-parent="#accordion" id="new_tour">
                  <div class="card-body border-0 p-0 mt-4">
                     <div class="form-group">
                        <select class="custom-select">
                           <option selected="">Select Location</option>
                           <option>Adelaide</option>
                           <option>Brisbane</option>
                           <option>Canberra</option>
                           <option>Darwin</option>
                           <option>Hobart</option>
                           <option>Melbourne</option>
                           <option>Perth</option>
                           <option>Sydney</option>
                        </select>
                     </div>
                     <div class="row">
                        <div class="col">
                           <input placeholder="Start Date" class="form-control" type="text" onfocus="(this.type='date')" id="date">
                        </div>
                        <div class="col">
                           <input placeholder="End Date" class="form-control" type="text" onfocus="(this.type='date')" id="date">
                        </div>
                     </div>
                     <div class="row mt-3">
                        <div class="col-3 pr-0">
                           <label class="pt-1">Assign Profile</label>
                        </div>
                        <div class="col-9 pl-0">
                           <select class="custom-select">
                           <option selected="">Select Profile</option>
                           <option>Adelaide</option>
                           <option>Brisbane</option>
                        </select>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
                  <div id="accordion" class="myacording-design">
            <div class="card">
               <div class="card-header"> <a class="card-link collapsed" data-toggle="collapse" href="#new_tour-2" aria-expanded="false">Western Australia</a> </div>
               <div class="collapse" data-parent="#accordion" id="new_tour-2">
                  <div class="card-body border-0 p-0 mt-4">
                     <div class="form-group">
                        <select class="custom-select">
                           <option selected="">Select Location</option>
                           <option>Adelaide</option>
                           <option>Brisbane</option>
                           <option>Canberra</option>
                           <option>Darwin</option>
                           <option>Hobart</option>
                           <option>Melbourne</option>
                           <option>Perth</option>
                           <option>Sydney</option>
                        </select>
                     </div>
                     <div class="row">
                        <div class="col">
                           <input placeholder="Start Date" class="form-control" type="text" onfocus="(this.type='date')" id="date">
                        </div>
                        <div class="col">
                           <input placeholder="End Date" class="form-control" type="text" onfocus="(this.type='date')" id="date">
                        </div>
                     </div>
                     <div class="row mt-3">
                        <div class="col-3 pr-0">
                           <label class="pt-1">Assign Profile</label>
                        </div>
                        <div class="col-9 pl-0">
                           <select class="custom-select">
                           <option selected="">Select Profile</option>
                           <option>Adelaide</option>
                           <option>Brisbane</option>
                        </select>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <button type="button" class="btn btn-primary create-tour-sec w-100 addLocation mb-3" data-count="1">Add Location <i class="fa fa-fw fa-plus text-white"></i> </button>
      </div>
   </div>
</div>
</div>

<div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
   <div class="modal-content basic-modal">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModal">Edit Tour</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
         </button>
      </div>
      <div class="modal-body pb-0 agent-tour">
         <div class="form-group">
            <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Tour Name">
         </div>
         <div id="accordion" class="myacording-design">
            <div class="card">
               <div class="card-header"> <a class="card-link collapsed" data-toggle="collapse" href="#new_tour" aria-expanded="false">Western Australia</a> </div>
               <div class="collapse show" data-parent="#accordion" id="new_tour">
                  <div class="card-body border-0 p-0 mt-4">
                     <div class="form-group">
                        <select class="custom-select">
                           <option selected="">Select Location</option>
                           <option>Adelaide</option>
                           <option>Brisbane</option>
                           <option>Canberra</option>
                           <option>Darwin</option>
                           <option>Hobart</option>
                           <option>Melbourne</option>
                           <option>Perth</option>
                           <option>Sydney</option>
                        </select>
                     </div>
                     <div class="row">
                        <div class="col">
                           <input placeholder="Start Date" class="form-control" type="text" onfocus="(this.type='date')" id="date">
                        </div>
                        <div class="col">
                           <input placeholder="End Date" class="form-control" type="text" onfocus="(this.type='date')" id="date">
                        </div>
                     </div>
                     <div class="row mt-3">
                        <div class="col-3 pr-0">
                           <label class="pt-1">Assign Profile</label>
                        </div>
                        <div class="col-9 pl-0">
                           <select class="custom-select">
                           <option selected="">Select Profile</option>
                           <option>Adelaide</option>
                           <option>Brisbane</option>
                        </select>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <button type="button" class="btn btn-primary create-tour-sec w-100 addLocation mb-3" data-count="1">Add Location <i class="fa fa-fw fa-plus text-white"></i> </button>
      </div>
   </div>
</div>
</div>

@include('agent.dashboard.partials.playmates-modal')
@endsection
@push('script')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
   $(document).ready(function(){
      var id = '8';
      var url = "{{ route('agent.onlyEscort.dataTable',':id') }}";
      url = url.replace(':id',id);
      var table = $('#onlyEscortList').DataTable({
         //$('#').DataTable({
         "language": {
            search: "_INPUT_",
            searchPlaceholder: "Search",
            "sSearch": '<a class="btn searchBtn" id="searchBtn"><i class="fa fa-search"></i></a>',

            oPaginate: {
               sNext: '<span aria-hidden="true">»</span>',
               sPrevious: '<span aria-hidden="true">«</span>',
               sFirst: '<span aria-hidden="true">»</span>',
               sLast: '<span aria-hidden="true">»</span>'
            }

         },
         info: false,
         bLengthChange: false,
         processing: true,
         serverSide: true,
         lengthChange: true,
         order: [1,'asc'],
         searchable:false,
         //searching:true,
         bStateSave: false,

         ajax: {
               url: url,
               data: function (d) {
                  d.type = 'player';
               }
         },
         columns: [

            { data: 'pro_name', name: 'pro_name', searchable: true, orderable:false ,defaultContent: 'NA'},
            { data: 'phone', name: 'phone', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'gender', name: 'gender', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'membership', name: 'membership', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'homeState', name: 'homeState', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'age', name: 'age', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'vaccine', name: 'vaccine', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'actionAgentEscortProfile', name: 'actionAgentEscortProfile', searchable: false, orderable:false,defaultContent: 'NA' },
         ]
      });
   });
</script>
@endpush
