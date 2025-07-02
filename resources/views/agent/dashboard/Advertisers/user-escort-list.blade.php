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
         <div class="container-fluid" id="replace-item">
            <!--middle content-->
            
         {{-- Page Heading   --}}
         <div class="row">
            <div class="d-flex align-items-center justify-content-start mt-5 flex-wrap col-lg-12">
               <h1 class="h1">Advertiser List</h1>
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
            <div class="row mt-2">
               <div class="col-sm-10 col-md-10 col-lg-10">
                  <!-- Begin Page Content -->
                  <div class="container-fluid" style="padding: 0px 0px;">
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
                                       <table class="table" id="myAdvertisersList">
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
                                             {{-- <tr class="row-color">
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
                                             </tr> --}}
                                          </tbody>
                                       </table>
                                       {{-- <nav aria-label="Page navigation example">
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
                                       </nav> --}}
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
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="Tour_Name" tabindex="-1" role="dialog" aria-labelledby="Tour_NameLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
   <div class="modal-content basic-modal">
      <div class="modal-header">
         <h5 class="modal-title" id="Tour_Name2">Create New Tour</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
         </button>
      </div>
      <div class="modal-body pb-0 agent-tour">
         <form id="myTour_2" method="post" action="{{route('agent.store.tour')}}">
            @csrf
            <div class="form-group">
               <input type="hidden" name="user_id" id="user_id">
               {{-- <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Tour Name"> --}}
               <input type="text" name="name" required data-parsley-required-message=" Please enter Tour Name" class="form-control" id=" " placeholder="Tour Name" data-parsley-errors-container="#Tname"> 
           
            </div>
            <span id="Tname"></span>
            <div id="accordion" class="myacording-design">
               <div id='divcountId'>
              
                  <div class="card">
                     <div class="card-header"> <a class="card-link collapsed" data-toggle="collapse" href="#new_tour" aria-expanded="false">Location <label id="num_1">1</div></a> 
                  </div>
                  <div class="collapse show" data-parent="#accordion" id="new_tour">
                     <div class="card-body border-0 p-0 mt-4">
                        <div class="form-group">
                           <select class='custom-select addMore_Location' id='addLocation_1' name='stateId[]' required data-parsley-required-message=" Please select Location" data-parsley-errors-container="#loc_1" data-parsley-trigger='change focusout' data-parsley-class-handler ='#email-group' >
                              <option value='' selected=''>Select Location</option>
                              @foreach(config('escorts.profile.states') as $key => $state)
                              <option value="{{$key}}"  @if(!in_array($key, $escorts->pluck('state_id')->toArray()))  disabled style="background-color:#76767687"@endif>{{$state['stateName']}}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="row mt-4 mb-3">
                           <div class="col-3 pr-0">
                              <label class="pt-1">Assign Profile</label>
                           </div>
                           <div class="col-9 pl-0">
                              {{-- <select class="custom-select">
                              <option selected="">Select Profile</option>
                              <option>Adelaide</option>
                              <option>Brisbane</option>
                              </select> --}}
                              <select class='custom-select addAssign_1' id='assignProfile_' name='escortId[]' required data-parsley-required-message=" Please select Profile" data-parsley-errors-container="#assign_profile_1">
                                 <option value='' selected=''>-Assign Profile-</option>
                              </select>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>Start Date</label>
                              <input type="date" placeholder="Start Date"  name="start_date[]" class="form-control akhReset w-100" id="startDate_1" required data-parsley-required-message=" Please select Start Date" min="{{ date('Y-m-d')}}" >


                           </div>
                           <div class="col-md-6">
                              <label>End Date</label>
                              <input type="date" placeholder="End Date" name="end_date[]" class="form-control akhReset w-100" id="endDate_1" required  data-parsley-required-message=" Please select End Date">

                           </div>
                        </div>
                     
                        <div class="row mt-3">
                           <div class="col-3 pr-0">
                              <label class="pt-1">Select Plan</label>
                           </div>
                           <div class="col-9 pl-0">
                              <select class='custom-select addplan_1' id='tourPlan_' name='tour_plan[]' required data-parsley-required-message=" Please select Plan">
                                 <option value='' selected=''>-Select Plan-</option>
                                 <option value="1" >Platinum</option>
                                 <option value="2">Gold</option>
                                 <option value="3" >Silver</option>
                                 <option value="4">Free</option>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
      
            <button type="button" class="btn btn-primary create-tour-sec w-100 createForm_addLocation mb-3" data-count="1">Add Location <i class="fa fa-fw fa-plus text-white"></i> </button>
            <div class="modal-footer border-0 pt-5" style="justify-content: flex-start;">
               <button type="submit" class="btn btn-secondary create-tour-sec" id="poli_payment">Save</button>
               <button type="button" class="btn btn-primary create-tour-sec resetTour">Reset</button>
            </div>
         </form>
      </div>
   </div>
</div>
</div>
</div>

<div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
   <div class="modal-content basic-modal">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModal2">Edit Tour</h5>
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
{{-- edit tour model --}}
<div class="modal fade upload-modal" id="tourModalShow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title mb-0 dynamicTour" id="exampleModalLongTitle">Create New Tour</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
         </div>
         <div id="addTourForm">
            {{-- <form id="myTour" method="post" action="{{route('agent.store.tour')}}">
               @csrf
               <div class="modal-body">
                  <div class="row pl-3">
                     <div class="form-group mb-2 pt-2">
                        <label for="staticEmail2">Tour Name <span style='color:red'>*</span></label>
                     </div>
                     <div class="form-group mx-sm-3 mb-2">
                        <input type="text" name="name" required data-parsley-required-message=" Please enter Tour Name" class="form-control" id=" " placeholder=" " value="" data-parsley-errors-container="#Tname"> 
                     </div>
                  </div>
                  <span id="Tname"></span>
                  <!--  <div class="form-group mb-2">
                     <label for="staticEmail2">Tour Name</label>
                     </div>
                     <div class="form-group mx-sm-3 mb-2">
                     <input type="text" name="name" required data-parsley-required-message=" Please enter Tour Name" class="form-control" id=" " placeholder=" " value=""> </div> -->
                  <div id="accordion" class="myacording-design mb-0 pt-3 cv">
                     @include('agent.dashboard.Advertisers.tour.partials.tourModal')
                     
                  </div>
                  <div class="col-md-12 p-0">
                     <button type="button" class="btn btn-primary create-tour-sec w-100 addLocation" data-count="1">Add Location <i class="fa fa-fw fa-plus" style="color: #fff;"></i> </button>
                  </div>
               </div>
               <div class="modal-footer border-0 pt-5" style="justify-content: flex-start;">
                  <button type="submit" class="btn btn-secondary create-tour-sec" id="poli_payment2">Save</button>
                  <button type="button" class="btn btn-primary create-tour-sec resetTour">Reset</button>
               </div>
            </form> --}}
         </div>
      </div>
   </div>
</div>
<div class="modal delete" id="pesrmissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header main_bg_color border-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"> <span aria-hidden="true">
            </span>
            </button>
         </div>
         <div id="addTourForm1">
            <div class="col-md-12 p-0">
               <span id="msg">  </span>
            </div>
            <input type="hidden" id="deleteId" value="">
            <div class="modal-footer border-0 pt-5" style="justify-content: flex-start;">
               <button type="submit" class="btn btn-secondary create-tour-sec permission">Ok</button>
               <button type="button" class="btn btn-primary create-tour-sec nopermission" data-dismiss="modal" aria-label="Close">close</button>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal delete" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header main_bg_color border-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"> <span aria-hidden="true">
            </span>
            </button>
         </div>
           <div>
               <div class="col-md-12 pt-3">
                   <span id="msg1">  </span>
               </div>
               
               <div class="modal-footer border-0 pt-3" style="justify-content: flex-start;">
                   
                   <button type="button" class="btn btn-primary create-tour-sec" data-dismiss="modal" aria-label="Close">close</button>
               </div>
           </div>
      </div>
   </div>
</div>
{{-- end edit tour model --}}
@include('agent.dashboard.partials.playmates-modal')
@endsection
@push('script')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script> 
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
   $(document).ready(function(){
      $('#myTour').parsley({});
      var table = $('#myAdvertisersList').DataTable({
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
               url: "{{ route('agent.userEscort.dataTable') }}",
               data: function (d) {
                  d.type = 'player';
               }
         },
         columns: [
               
            { data: 'memberId', name: 'memberId', searchable: true, orderable:false ,defaultContent: 'NA'},
            { data: 'name', name: 'name', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'mobile', name: 'mobile', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'email', name: 'email', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'contact', name: 'contact', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'homeState', name: 'homeState', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'dateEngage', name: 'dateEngage', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'Appointed', name: 'Appointed', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'earnings', name: 'earnings', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'action', name: 'edit', searchable: false, orderable:false, defaultContent: 'NA' },
         ]
      });

      


      $("body").on('click','#manage-profile',function(){
         var id = $(this).data('id');
        
         var name = $(this).data('name');
        
         var url = "{{ route('agent.only.escorts.list') }}";
         $.ajax({
            method:"POST",
            url: url,
            data:{id:id},
            success: function(data){
               
               $("#replace-item").replaceWith (data.template);
               //var idw = '8';
               var url = "{{ route('agent.onlyEscort.dataTable',':id') }}";
               url = url.replace(':id',id);
               $('#mp_name').html("("+name+")");
               
               var createUrl = "{{ route('agent.profile',':id') }}";
               createUrl = createUrl.replace(':id',id);
               $("#createProfile").html("<a href="+createUrl+" class='btn btn-primary create-tour-sec' >Create New Profile</a>");

               var tablesEscort = $('#onlyEscortList').DataTable({
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
            },
         });
      });


      $("body").on('click','#manage-tour',function(){
         var id = $(this).data('id');
         var name = $(this).data('name');
         var url = "{{ route('agent.EscortTour.list') }}";
         $.ajax({
            method:"POST",
            url: url,
            data:{id:id},
            success: function(data){
               console.log(data);
               console.log('manage-tour',id);
               
               $("#replace-item").replaceWith (data.template);
               //var idw = '8';
               
              
               $('#mt_name').html("("+name+")");
              
               
               var url = "{{ route('agent.tour.dataTable',':id') }}";
               url = url.replace(':id',id);
               $(".dctour").attr('data-id',id);
               var tableTour = $('#onlyTourList').DataTable({
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
                     { data: 'escort_name', name: 'escort_name', searchable: true, orderable:true ,defaultContent: 'NA'},
                     { data: 'pro_name', name: 'pro_name', searchable: true, orderable:true ,defaultContent: 'NA'},
                     { data: 'name', name: 'name', searchable: true, orderable:true ,defaultContent: 'NA'},
                     { data: 'days', name: 'days', searchable: true, orderable:true,defaultContent: 'NA' },
                     { data: 'total_cost', name: 'total_cost', searchable: true, orderable:true,defaultContent: 'NA' },
                     // { data: 'transaction_Status_Code', name: 'transaction_Status_Code', searchable: true, orderable:true,defaultContent: 'NA' },
                     // { data: 'locations', name: 'locations', searchable: false, orderable:true,defaultContent: 'NA' },
                     { data: 'agentManage', name: 'agentManage', searchable: false, orderable:false, defaultContent: 'NA' },
                  ]
               });
               // tableTour.draw();

            },
         });
      });

      $(document).ready(function(){
         

         // $('body').on('click', '.akhEditDate', function(e) {
         //    var len = $('.akhEditDate').length/2;
         //    for(var i = 1; i <= len; i++) {
         //       console.log('count len-',i);
         //    }
         //    console.log('cl-',len);
         // });
         $('body').on('click', '.editTour', function(e) {
            var id = $(this).data('id');
            
           
            $('#tourModalShow').modal('show');
            
            
            
            //var url = "{{ route('escort.tour.edit',':id')}}";
            var url = "{{ route('agent.tour.edit',':id')}}";
            //url.replace(':id', id);
            url = url.replace(':id',id);
         
            console.log(url);
            $.ajax({
               url : url,
               type : "POST",
               contentType: false,
               processData: false,
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               success: function (data) {
                  console.log("hello ")
                  $('#addTourForm').html(data.template);
                  
                  
                  $.each(data.tourLocation, function(index, elem) {
                     
                  //    optionString += '<option value='+elem.id+'>'+elem.name+'</option>';
                      console.log("index-",index);
                      console.log("vaue-",elem);
                  });
                  
                 
                  var last_Date = $('#startEditDate_'+$('.editDivCount').length).val();
                  

                  var todayDate = new Date();
                  var T_date = todayDate.setDate(todayDate.getDate());
                  var Today_date = moment(T_date).format('YYYY-MM-DD');  
                  console.log("alc-",last_Date, "-newdat-",Today_date);

                  if(last_Date <=  Today_date) {
                     $('.editForm_addLocation').attr('disabled',true);
                     console.log("alc-",last_Date);
                  } 
                  
               }
         
            });
         
         
            $("#exampleModalLongTitle").text('Edit Tour');      
           //  $('#myTour').parsley({
       
           // });   
         });
      });
      $('body').on('change','.akhReset', function()
      {
         var len = $('.akhReset').length/2;
         var val = $(this).attr('id');
         var selectedDate = $("#"+val).val();
         
         var getCountValue = val.split('_');
         for(var i = 1; i <= len; i++) {
            if(getCountValue[0] == "startDate") {
               var result = new Date(selectedDate);
               var ss = result.setDate(result.getDate() + i);
               var first_date = moment(ss).format('YYYY-MM-DD');  
               //$("#endDate_"+getCountValue[1]).val('');
               $("#endDate_"+getCountValue[i]).attr({
               "min" : first_date, 
               "value" : first_date,         // values (or variables) here
               });
            }
         }   
         console.log("fst d-",first_date);
         console.log("val-",val);
         console.log("selectedDate=",selectedDate);
         
      });

      $('body').on('change','.akhEditDate', function()
      {

         var len = $('.akhEditDate').length/2;
         var selectedDate = $(this).val();
         var val = $(this).attr('id'); //startDate_1
         var getCountValue = val.split('_');
            for(var i = 1; i <= len; i++) {
               console.log('count len-',i);
               if(getCountValue[0] == "startEditDate") {
                  var result = new Date(selectedDate);
                  var ss = result.setDate(result.getDate() + i);
                  var first_date = moment(ss).format('YYYY-MM-DD');  
                  console.log("endval-",$("#endEditDate_"+getCountValue[i]).val());
                  ///$("#endDate_"+getCountValue[1]).val('');
                  $("#endEditDate_"+getCountValue[i]).attr({
                  "min" : first_date, 
                  "value" : first_date, 
                  "disabled": false,        // values (or variables) here
                  });
               }

            }

         
         
         // if(getCountValue[0] == "startEditDate") {
         //    var result = new Date(selectedDate);
         //    var ss = result.setDate(result.getDate() + 1);
         //    var first_date = moment(ss).format('YYYY-MM-DD');  
         //    console.log("endval-",$("#endEditDate_"+getCountValue[1]).val());
         //    ///$("#endDate_"+getCountValue[1]).val('');
         //    $("#endEditDate_"+getCountValue[1]).attr({
         //    "min" : first_date, 
         //    "value" : first_date,         // values (or variables) here
         //    });
         // }
         console.log("fst d-",first_date);
        
         console.log("countlast-", $("#endEditDate_"+getCountValue[1]));
         console.log("selectedDate=",selectedDate);
         
      });
      $('body').on('click','.akhEditDate', function()
      {

         var selectedDate = $(this).val();
         var val = $(this).attr('id'); //startDate_1
         var getCountValue = val.split('_');
         var back_num = parseInt(getCountValue[1], 10)-1;
         var backDateValue = $("#endEditDate_"+back_num).val();
               console.log('crunt no:',getCountValue[1]);
               console.log('back no:',back_num);
               console.log('backdate:',backDateValue);

               if(getCountValue[0] == "startEditDate") {
                  var result = new Date(backDateValue);
                  var ss = result.setDate(result.getDate() + 1);
                  var first_date = moment(ss).format('YYYY-MM-DD');  
                  console.log("endval-",first_date);
                  ///$("#endDate_"+getCountValue[1]).val('');
                  $(this).attr({
                  "min" : backDateValue, 
                  "value" : backDateValue, 
                  });
                  $("#endEditDate_"+getCountValue[1]).attr({
                  "min" : first_date, 
                  "value" : first_date, 
                  });
               }

               
               console.log("#val:",val);
      });
      
      
   });
   ///tour
   $(function () {
      var count = 1;
       var startid = $("#startDate_").attr('id','startDate_'+count);
       var endid = $("#endDate_").attr('id','endDate_'+count);

      
      $('body').on('change', ".addMore_Location", function(e) {
           
         var stateId = $(this).val();
         var locationId = $(this).attr('id');
         var getIdValue = locationId.split('_');
         
         console.log("chbyme",getIdValue[1]);
         var elem = $(this);
         //var addClass = $(".addAssign_").removeClass('addAssign_'+stateId);
         console.log("hello state=", stateId);
         var url = "{{ route('agent.stateId',':id') }}";
         url = url.replace(':id',stateId);
         console.log("count",count);
         $.ajax({
            url : url,
            method : "POST",
            success: function(data) {
                  //console.log(data);
                  console.log("pluck-",data.arrayNotNullStateId[0]);
                  //console.log("INStansof-",data.arrayNotNullStateId.indexOf(stateId));
                  // console.log("inarray:",$.inArray(stateId,data.arrayNotNullStateId[0]));
                  // if($.inArray(stateId, data.arrayNotNullStateId[0]) !==-1) {
                  //    console.log("is in array");
                  // } else {
                  //    console.log("is NOT in array");
                  // }
                  //jQuery.inArray("item", the_array)
                  //not_allowed.indexOf(instance_name)

                  var optionString = '';
                  
                  $.each(data.escorts, function(index, elem) {
                     optionString += '<option value='+elem.id+'>'+elem.name+'</option>';
                     console.log("elem--",elem.name);
                  });
                  
                  $('.addAssign_'+getIdValue[1]).attr('id','assignProfile_'+data.id).html(optionString); 
                  $("#assignProfile_"+data.id).attr('disabled',  false);

                  var increseValue = parseInt(getIdValue[1] ,10)+1;
                  console.log($("#addLocation_"+increseValue+" option"));
                  $("#addLocation_"+increseValue+" option").attr({'disabled': false,'style':'background-color:transparent'});
                  $("#addLocation_"+increseValue+" option").each(function(){
                     var thisOptionValue=$(this).val();
                     //$("#addLocation_"+increseValue+" option").attr({'disabled': false,});
                     
                     if(stateId == thisOptionValue) {
                        $("#addLocation_"+increseValue+" option[value='"+ thisOptionValue + "']").attr({'disabled': true,'style':'background-color:#76767687'}); 
                        console.log('qul');
                     }
                     //if($.inArray(thisOptionValue, data.arrayNotNullStateId) != -1) {
                     if($.inArray(thisOptionValue, data.arrayNotNullStateId[0]) ==-1) {
                        $("#addLocation_"+increseValue+" option[value='"+ thisOptionValue + "']").attr({'disabled': true,'style':'background-color:#76767687'});
                        console.log(thisOptionValue,'notnullid');
                     }
                  });
                  
            },
            error: function (data) {
                  console.log("error a",data);
            },
               
         });
      });

      $('body').on('click', ".removeModel", function(e) {
         var num = $(this).attr('id');
         var increaseCount = parseInt(num,10) + 1;
         var dicCount = parseInt(num,10) - 1;
         
         $("#deleteDiv_"+$(this).attr('id')).remove();
         var div_count = $('#divcountId .divCount').length+1;
         $('.divCount').each(function(index ,value) {
            console.log(`div${index}: ${this.id}`);
            var val = index + 2;
            this.id = "deleteDiv_"+val;
            $(this).find('.location_mini_count').attr("id", "num_"+val);
            $("#num_"+val).html(val);
            $(this).find('.removeModel').attr('id',val);
            $(this).find('.card').attr('id','card_'+val);
            $(this).find('.addMore_Location').attr('id','addLocation_'+val);
            $(this).find('.chLocation').attr('class','custom-select chLocation addAssign_'+val);

             
            console.log( $(this).find('.location_mini_count'));

            //$('.divCount').prev(".location_mini_count").attr("id", "num_"+val);
            
           
         })
         // $('.location_mini_count').each(function(index ,value) {
         //    console.log(`div${index}: ${this.id}`);
         //    var val = index + 2;
         //    this.id = "num_"+val;
         //    $("#num_"+val).html(val);
         //    console.log('vv', value);
         // })
         // $('.removeModel').each(function(index ,value) {
         //    console.log(`div${index}: ${this.id}`);
         //    var val = index + 2;
         //    this.id = val;
         //    $(this.id).html(val);
         //    console.log('vv', value);
         // })
         console.log("div coun", div_count);
            //count += 1;
            
         
        
         // else {
            
         //    $(".chLocation ").removeClass(".addAssign_"+increaseCount);
         //    $(".chLocation ").addClass('.addAssign_'+$(this).attr('id'));
         //    console.log("else  = ", $(this).attr('id'));
         //    console.log("else inc  = ", increaseCount);
         //    console.log($(".chLocation ").removeClass(".addAssign_"+increaseCount));
            
         // }
         
      });
      $('body').on('click', ".removeEditModel", function(e) {
         var num = $(this).attr('id');
         var increaseCount = parseInt(num,10) + 1;
         var dicCount = parseInt(num,10) - 1;
         var div_count = $('#EditdivcountId .editDivCount').length;
         console.log("div_count:",div_count);
         if(div_count > 2) {
            $("#deleteDiv_"+$(this).attr('id')).remove();
         }
         

        

         
         $('.editDivCount').each(function(index ,value) {
            console.log("indes->",`div${index}: ${this.id}`);
            var val = index + 1;
            this.id = "deleteDiv_"+val;
            $(this).find('.location_mini_count').attr("id", "num_"+val);
            $("#num_"+val).html(val);
            $(this).find('.removeEditModel').attr('id',val);
            $(this).find('.card').attr('id','card_'+val);
            $(this).find('.addMore_Location').attr('id','addLocation_'+val);
            $(this).find('.sdate').attr('id','startEditDate_'+val);
            $(this).find('.edate').attr('id','endEditDate_'+val);
            $(this).find('.chLocation').attr('class','custom-select chLocation addAssign_'+val);

             
            console.log( $(this).find('.location_mini_count'));

         })
        
         console.log("div coun", div_count);
          
         
      });
      $('body').on('click', '.addLocation', function(e) {
         $('#myTour').parsley().validate();
         if ($('#myTour').parsley().isValid()) {

            
               count += 1;
               var row_count = $(this).data('count')+ count - 1;
               console.log("tid="+  $("#tid").val());
               console.log("helloCount="+ count);
               var up = count -1;
               lastIDstate = $('#addLocation_'+up).val();

               console.log("get up location id="+ $('#addLocation_'+up).val());
               console.log("kk", $("#addLocation_"+count).attr('option'));
               
            if(row_count <= 8) {
            
               var tid = $("#tid").val();
               var url = "{{ route('agent.tour.apend',':id')}}";
               url = url.replace(':id',tid);
               $.ajax({
                  url : url,
                  method : "POST",
                  data : {row_count:row_count},
                  success: function(data) {
                     console.log(data.template);
                     $('div#accordion').append(`<div>${data.template}</div>`);
                     
                  },
                  error: function (data) {
                     console.log("error a",data);
                  },
               
               });
                //{{--//$('#accordion').append("@include('agent.dashboard.Advertisers.tour.partials.tourModalAppend')");--}}
               var up_date = $("#startDate_"+up).val();
               var up_result = new Date(up_date);
               var up_inc_date = up_result.setDate(up_result.getDate() + 1);
               var increse_date = moment(up_inc_date).format('YYYY-MM-DD');  
                  $("#startDate_"+count).attr({
                        "min" : increse_date, 
                        //"value" : first_date,         // values (or variables) here
                  });


               $("#addLocation_"+row_count+" option").each(function(){
               var thisOptionValue=$(this).val();
               if(lastIDstate == thisOptionValue) {
                  $("#addLocation_"+row_count+" option[value='"+ thisOptionValue + "']").attr({'disabled': true,'style':'background-color:#76767687'}); 
               }
               });
            }

         }
          
      })
      $('body').on('click', '.createForm_addLocation', function(e) {
        
         $('#myTour_2').parsley().validate();
         if ($('#myTour_2').parsley().isValid()) {
           
            
            var div_count = $('#divcountId .divCount').length+1;
            
            console.log("div coun", div_count);
               //count += 1;
              
               var row_count = $(this).data('count')+ div_count;
               //var row_count = $(this).data('count')+ count -1;
              
               console.log("helloCount="+ row_count);
               //var up = count -1;
               var up = row_count -1;
               lastIDstate = $('#addLocation_'+up).val();
               console.log("lastIDstate="+  lastIDstate);
               console.log("get up location id="+ $('#addLocation_'+up).val());
               console.log("kk", $("#addLocation_"+row_count).attr('option'));
               
            if(row_count <= 8) {
               
               var tid = $("#tid").val();
               console.log("tid==",tid);
               // {{--var url = "{{ route('agent.tour.apend',':id')}}";--}}
               var url = "{{ route('agent.createTour.apend')}}";
               $.ajax({
                  url : url,
                  method : "POST",
                  data : {row_count:row_count},
                  success: function(data) {
                     //console.log(data.template);
                     $('div#divcountId').append(`<div class='divCount' id='deleteDiv_${row_count}'>${data.template}</div>`);
                     
                  },
                  error: function (data) {
                     console.log("error a",data);
                  },
               
               }).done(function() {
                  
               
               // {{-- $('#accordion').append("@include('agent.dashboard.Advertisers.tour.partials.tourCreateModalAppend')");--}}
                  var up_date = $("#startDate_"+up).val();
                  var up_result = new Date(up_date);
                  var up_inc_date = up_result.setDate(up_result.getDate() + 1);
                  var increse_date = moment(up_inc_date).format('YYYY-MM-DD');  
                     $("#startDate_"+row_count).attr({
                           "min" : increse_date, 
                           //"value" : first_date,         // values (or variables) here
                     });
                  
                  $("#addLocation_"+row_count+" option").each(function(){
                     var thisOptionValue=$(this).val();
                     
                     if(lastIDstate == thisOptionValue) {
                        $('#addLocation_'+row_count+' option[value="'+ thisOptionValue + '"]').attr({'disabled': true,'style':'background-color:#76767687'}); 
                        //console.log("jj=",row_count);
                     }
                  
                  });
               });
            }

         }
          
      })

      $('body').on('click', '.editForm_addLocation', function(e) {
        
         $('#myTour').parsley().validate();
         if ($('#myTour').parsley().isValid()) {
           
            
            var div_count = $('#EditdivcountId .editDivCount').length+1;//no use
            
            console.log("edit div coun", div_count);
               //count += 1;
              
               var row_count = div_count;
               // var row_count = $(this).data('count') + 1;
               // var row_count = $(this).data('count')+ div_count;
               //var row_count = $(this).data('count')+ count -1;
              
               console.log("helloCount="+ row_count);
               //var up = count -1;
               var up = row_count -1;
               lastIDstate = $('#addLocation_'+up).val();
               console.log("lastIDstate="+  lastIDstate);
               console.log("get up location id="+ $('#addLocation_'+up).val());
               console.log("kk", $("#addLocation_"+row_count).attr('option'));
               
            if(row_count <= 8) {
               
               var tid = $("#tid").val();
               console.log("tid==",tid);
               // {{--var url = "{{ route('agent.tour.apend',':id')}}";--}}
               var url = "{{ route('agent.editTour.apend')}}";
               $.ajax({
                  url : url,
                  method : "POST",
                  data : {row_count:row_count},
                  success: function(data) {
                     //console.log(data.template);
                     $('div#EditdivcountId').append(`<div class='editDivCount' id='deleteDiv_${row_count}'>${data.template}</div>`);
                     
                  },
                  error: function (data) {
                     console.log("error a",data);
                  },
               
               }).done(function() {
                  
               
               // {{-- $('#accordion').append("@include('agent.dashboard.Advertisers.tour.partials.tourCreateModalAppend')");--}}
                  var up_date = $("#startEditDate_"+up).val();
                  var up_result = new Date(up_date);
                  var up_inc_date = up_result.setDate(up_result.getDate() + 1);
                  var increse_date = moment(up_inc_date).format('YYYY-MM-DD');  
                     $("#startEditDate_"+row_count).attr({
                           "min" : increse_date, 
                           //"value" : first_date,         // values (or variables) here
                     });
                  
                  $("#addLocation_"+row_count+" option").each(function(){
                     var thisOptionValue=$(this).val();
                     
                     if(lastIDstate == thisOptionValue) {
                        $('#addLocation_'+row_count+' option[value="'+ thisOptionValue + '"]').attr({'disabled': true,'style':'background-color:#76767687'}); 
                        //console.log("jj=",row_count);
                     }
                  
                  });
               });
            }

         }
          
      })

      $("body").on('submit', '#myTour_2', function(e){
       e.preventDefault();
       console.log("ddddd=",$('.divCount').length+1);
         if($('.divCount').length+1 >= 2) {
            var form = $(this);
            // form.parsley().validate();
         
            // if(form.parsley().isValid()) {
           var url = form.attr('action');
           var data = new FormData($('#myTour_2')[0]);

           console.log('data-',data);
           $('#pesrmissionModal').modal('show');
           $('#msg').html("Are you sure you want to save?");
           $('.nopermission').click(function(){
               location.reload();
           });
           $('.permission').click(function(){
               $('#pesrmissionModal').modal('hide');
   
           
   
          
               $.ajax({
                   method: form.attr('method'),
                   url:url,
                   data:data,
                   contentType: false,
                   processData: false,
                   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                   success: function (data) {
                       console.log(data);
                       if(!data.error){

                        $('#poli_payment').prop('disabled', true);
                                $('#poli_payment').html('<div class="spinner-border"></div>');
                                var tourId = data.tour.id;
                                var userId = data.userId;
                                var url = "{{ route('agent.tour.paymentUrl',':id')}}";
                                url = url.replace(':id',tourId);
                                console.log("url = "+url);
                                
                                $('<form/>', { action: url, method: 'POST' }).append($('<input>', {type: 'hidden', name: '_token', value: '{{csrf_token()}}'}),$('<input>', {type: 'hidden', name: 'user_id', value: userId }),).appendTo('body').submit(); 
                           // $.toast({
                           //     heading: 'Success',
                           //     text: 'Record successfully update',
                           //     icon: 'success',
                           //     loader: true,
                           //     position: 'top-right',      // Change it to false to disable loader
                           //     loaderBg: '#9EC600'  // To change the background
                           // });
                           //location.reload();
                       } else {
                           $.toast({
                               heading: 'Error',
                               text: 'Records Not update',
                               icon: 'error',
                               loader: true,
                               position: 'top-right',      // Change it to false to disable loader
                               loaderBg: '#9EC600'  // To change the background
                           });
                       
                       }
                       
                   }
               });
           });
         } else {
            $('#notificationModal').modal('show');
            $('#msg1').html("Please Add more then one location");
            
         }
   
      })
      $("body").on('submit', '#myTour', function(e){
       e.preventDefault();
       console.log("dmmdmmd=",$('.editDivCount').length);
         if($('.editDivCount').length >= 2) {
            var form = $(this);
            var url = form.attr('action');
            var data = new FormData($('#myTour')[0]);

            console.log('data-',data);
            $('#pesrmissionModal').modal('show');
            $('#msg').html("Are you sure you want to save?");
            $('.nopermission').click(function(){
                  location.reload();
            });
            $('.permission').click(function(){
               $('#pesrmissionModal').modal('hide');
                  $.ajax({
                   method: form.attr('method'),
                   url:url,
                   data:data,
                   contentType: false,
                   processData: false,
                   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                   success: function (data) {
                       console.log(data);
                     //   if(!data.error){

                     //    $('#poli_payment').prop('disabled', true);
                     //            $('#poli_payment').html('<div class="spinner-border"></div>');
                     //            var tourId = data.tour.id;
                     //            var userId = data.userId;
                     //            var url = "{{ route('agent.tour.paymentUrl',':id')}}";
                     //            url = url.replace(':id',tourId);
                     //            console.log("url = "+url);
                                
                     //            $('<form/>', { action: url, method: 'POST' }).append($('<input>', {type: 'hidden', name: '_token', value: '{{csrf_token()}}'}),$('<input>', {type: 'hidden', name: 'user_id', value: userId }),).appendTo('body').submit(); 
                           
                     //   } else {
                     //       $.toast({
                     //           heading: 'Error',
                     //           text: 'Records Not update',
                     //           icon: 'error',
                     //           loader: true,
                     //           position: 'top-right',      // Change it to false to disable loader
                     //           loaderBg: '#9EC600'  // To change the background
                     //       });
                       
                     //   }
                       
                   }
                  });
            });
         } else {
            $('#notificationModal').modal('show');
            $('#msg1').html("Please Add more then one location");
            
         }
   
      })
      // {{--$("body").on('submit', '#myTour_22111', function(e){
      //  e.preventDefault();
      //  console.log("dmmdmmd=",$('.editDivCount').length);
      //    if($('.editDivCount').length >= 2) {
      //       var form = $(this);
      //       var url = form.attr('action');
      //       var data = new FormData($('#myTour')[0]);

      //       console.log('data-',data);
      //       $('#pesrmissionModal').modal('show');
      //       $('#msg').html("Are you sure you want to save?");
      //       $('.nopermission').click(function(){
      //             location.reload();
      //       });
      //       $('.permission').click(function(){
      //          $('#pesrmissionModal').modal('hide');
      //             $.ajax({
      //              method: form.attr('method'),
      //              url:url,
      //              data:data,
      //              contentType: false,
      //              processData: false,
      //              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      //              success: function (data) {
      //                  console.log(data);
      //                  if(!data.error){

      //                   $('#poli_payment').prop('disabled', true);
      //                           $('#poli_payment').html('<div class="spinner-border"></div>');
      //                           var tourId = data.tour.id;
      //                           var userId = data.userId;
      //                           var url = "{{ route('agent.tour.paymentUrl',':id')}}";
      //                           url = url.replace(':id',tourId);
      //                           console.log("url = "+url);
                                
      //                           $('<form/>', { action: url, method: 'POST' }).append($('<input>', {type: 'hidden', name: '_token', value: '{{csrf_token()}}'}),$('<input>', {type: 'hidden', name: 'user_id', value: userId }),).appendTo('body').submit(); 
                           
      //                  } else {
      //                      $.toast({
      //                          heading: 'Error',
      //                          text: 'Records Not update',
      //                          icon: 'error',
      //                          loader: true,
      //                          position: 'top-right',      // Change it to false to disable loader
      //                          loaderBg: '#9EC600'  // To change the background
      //                      });
                       
      //                  }
                       
      //              }
      //          });
      //       });
      //    } else {
      //       $('#notificationModal').modal('show');
      //       $('#msg1').html("Please Add more then one location");
            
      //    }
   
      // })--}}
      $('#Tour_Name').on('shown.bs.modal', function (e) {
         var name, city, source = e.relatedTarget;
         console.log("id--",$(e.relatedTarget).data('id'));
         $("#user_id").val($(e.relatedTarget).data('id'));
       
      });
   });

</script>
@endpush