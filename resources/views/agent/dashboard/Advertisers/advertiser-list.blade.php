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
         <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5" id="replace-item">

            {{-- Page Heading --}}
            <div class="row">
               <div class="d-flex align-items-center justify-content-between col-md-12">
                  <div class="custom-heading-wrapper">
                     <h1 class="h1">Advertiser List</h1>
                     <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
                  </div>
                  @if (request('from') !== 'sidebar')
                  <div class="back-to-dashboard">
                     <a href="{{ route('agent.dashboard') }}">
                        <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                     </a>
                  </div>
                  @endif
               </div>

               {{-- Notes Accordion --}}
               <div class="col-md-12 mb-4">
                  <div class="card collapse" id="notes">
                     <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>
                           <li>
                              You can access all of your Advertisers here. The report 'Earnings' column is Commission paid to you by E4U according to the Advertiser's spend.
                           </li>
                           <li>
                              Click the <b>'Action'</b> button and select from the range of options available to you including Messaging to an Advertiser.
                           </li>
                           <li>
                              The Action dropdown includes: Profile, Tour, Media, Masseur, Account, and Message options. Pop-ups will be used where necessary.
                           </li>
                           <li>
                              You can print the advertiser list summary by selecting from All Advertisers, Escorts, or Massage Centres in the Print menu.
                           </li>
                        </ol>
                     </div>
                  </div>
               </div>
            </div>
            {{-- End Heading --}}

            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="table-responsive">
                  <table class="table table-bordered text-center" id="myAdvertisersList">
                     <thead class="table-bg">
                        <tr>
                           <th>Member ID</th>
                           <th>Name</th>
                           <th>Mobile</th>
                           <th>Email</th>
                           <th>Joined</th>
                           <th>Appointed</th>
                           <th>Earnings</th>
                           <th>Home State</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                  </table>
               </div>
               </div>
            </div>

         </div>
      </div>
   </div>
</div>

<!-- Action Modals (Frontend Design Only) -->

<!-- Create Profile Modal -->
<div class="modal upload-modal fade" id="createProfileModal" tabindex="-1">
   <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title text-white"> <img src="{{ asset('assets/dashboard/img/add-profile.png') }}" class="custompopicon"> Create Profile</h5>
         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"
            class="img-fluid img_resize_in_smscreen"></span></button>
       </div>
       <div class="modal-body">
         <form>
           <div class="form-group">
             <label>Profile Name</label>
             <input type="text" class="form-control" placeholder="Enter profile name">
           </div>
           <div class="form-group">
             <label>Description</label>
             <textarea class="form-control" rows="3"></textarea>
           </div>
         </form>
         <button type="button" class="btn-success-modal m-0">Save</button>
       </div>
       
     </div>
   </div>
 </div>
 
 <!-- Edit Profile Modal -->
 <div class="modal upload-modal fade" id="editProfileModal" tabindex="-1">
   <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title text-white"> <img src="{{ asset('assets/dashboard/img/edit-profile.png') }}" class="custompopicon">Edit Profile</h5>
         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"
            class="img-fluid img_resize_in_smscreen"></span></button>
       </div>
       <div class="modal-body">
         <form>
           <div class="form-group">
             <label>Profile Name</label>
             <input type="text" class="form-control" value="Carla Brasil">
           </div>
           <div class="form-group">
             <label>Description</label>
             <textarea class="form-control">Current description...</textarea>
           </div>
         </form>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn-success-modal m-0">Update</button>
       </div>
     </div>
   </div>
 </div>
 
 <!-- Create Tour Modal -->
 <div class="modal upload-modal fade" id="createTourModal" tabindex="-1">
   <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title text-white"> <img src="{{ asset('assets/dashboard/img/travel.png') }}" class="custompopicon"> Create Tour</h5>
         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"
            class="img-fluid img_resize_in_smscreen"></span></button>
       </div>
       <div class="modal-body">
         <form>
           <div class="form-group">
             <label>Location</label>
             <input type="text" class="form-control">
           </div>
           <div class="form-row">
             <div class="form-group col-md-6">
               <label>Start Date</label>
               <input type="date" class="form-control">
             </div>
             <div class="form-group col-md-6">
               <label>End Date</label>
               <input type="date" class="form-control">
             </div>
           </div>
         </form>
       </div>
       <div class="modal-footer">
         <button class="btn-success-modal">Save Tour</button>
       </div>
     </div>
   </div>
 </div>
 
 <!-- Edit Tour Modal -->
 <div class="modal upload-modal fade" id="editTourModal" tabindex="-1">
   <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title text-white"> <img src="{{ asset('assets/dashboard/img/travel.png') }}" class="custompopicon"> Edit Tour</h5>
         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"
            class="img-fluid img_resize_in_smscreen"></span></button>
       </div>
       <div class="modal-body">
         <form>
           <div class="form-group">
             <label>Location</label>
             <input type="text" class="form-control" value="Sydney">
           </div>
           <div class="form-row">
             <div class="form-group col-md-6">
               <label>Start Date</label>
               <input type="date" class="form-control">
             </div>
             <div class="form-group col-md-6">
               <label>End Date</label>
               <input type="date" class="form-control">
             </div>
           </div>
         </form>
       </div>
       <div class="modal-footer">
         <button class="btn-success-modal">Update Tour</button>
       </div>
     </div>
   </div>
 </div>
 
 <!-- Manage Media Modal -->
 <div class="modal upload-modal fade" id="manageMediaModal" tabindex="-1">
   <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title text-white"> <img src="{{ asset('assets/dashboard/img/manage-media.png') }}" class="custompopicon"> Manage Media</h5>
         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"
            class="img-fluid img_resize_in_smscreen"></span></button>
       </div>
       <div class="modal-body">
         <form>
           <div class="form-group">
             <label>Upload New Image</label>
             <input type="file" class="form-control-file">
           </div>
         </form>
       </div>
       <div class="modal-footer">
         <button class="btn-success-modal">Update Media</button>
       </div>
     </div>
   </div>
 </div>
 
 <!-- Manage Masseurs Modal -->
 <div class="modal upload-modal fade" id="manageMasseursModal" tabindex="-1">
   <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title text-white"> <img src="{{ asset('assets/dashboard/img/manage-masseuse.png') }}" class="custompopicon"> Manage Masseurs</h5>
         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"
            class="img-fluid img_resize_in_smscreen"></span></button>
       </div>
       <div class="modal-body">
         <ul class="list-group">
           <li class="list-group-item d-flex justify-content-between">
             <span>Ravi</span> <button class="btn-sm btn-danger">Remove</button>
           </li>
           <li class="list-group-item d-flex justify-content-between">
             <span>Akash</span> <button class="btn-sm btn-danger">Remove</button>
           </li>
         </ul>
       </div>
       <div class="modal-footer">
         <button class="btn-success-modal">Save Changes</button>
       </div>
     </div>
   </div>
 </div>
 
 <!-- View Account Modal -->
 <div class="modal upload-modal fade" id="viewAccountModal" tabindex="-1">
   <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title text-white"> <img src="{{ asset('assets/dashboard/img/view-task.png') }}" class="custompopicon"> View Account</h5>
         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"
            class="img-fluid img_resize_in_smscreen"></span></button>
       </div>
       <div class="modal-body">
         <p><b>Name:</b> Carla Brasil</p>
         <p><b>Email:</b> carla@gmail.com</p>
         <p><b>Phone:</b> 0438 028 728</p>
         <p><b>Joined:</b> 01/01/2022</p>
       </div>
     </div>
   </div>
 </div>
 
 <!-- Edit Account Modal -->
 <div class="modal upload-modal fade" id="editAccountModal" tabindex="-1">
   <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title text-white"> <img src="{{ asset('assets/dashboard/img/edit-task.png') }}" class="custompopicon"> Edit Account</h5>
         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"
            class="img-fluid img_resize_in_smscreen"></span></button>
       </div>
       <div class="modal-body">
         <form>
           <div class="form-group">
             <label>Name</label>
             <input type="text" class="form-control" value="Carla Brasil">
           </div>
           <div class="form-group">
             <label>Email</label>
             <input type="email" class="form-control" value="carla@gmail.com">
           </div>
         </form>
       </div>
       <div class="modal-footer">
         <button class="btn-success-modal">Save Changes</button>
       </div>
     </div>
   </div>
 </div>
 
 <!-- Print Summary Modal -->
 <div class="modal upload-modal fade" id="printSummaryModal" tabindex="-1">
   <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title text-white"> <img src="{{ asset('assets/dashboard/img/printer.png') }}" class="custompopicon"> Print Advertiser Summary</h5>
         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"
            class="img-fluid img_resize_in_smscreen"></span></button>
       </div>
       <div class="modal-body">
         <form>
           <div class="form-group">
             <label>Select Print Type</label>
             <select class="form-control">
               <option>All Advertisers</option>
               <option>Escorts</option>
               <option>Massage Centres</option>
             </select>
           </div>
         </form>
       </div>
       <div class="modal-footer">
         <button class="btn-success-modal" onclick="window.print()">Print</button>
       </div>
     </div>
   </div>
 </div> 

@endsection

@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
$(document).ready(function() {
   var table = $("#myAdvertisersList").DataTable({
      language: {
         search: "Search: _INPUT_",
         searchPlaceholder: "Search by Member ID"
        
      },
      processing: true,
      serverSide: true,
      lengthChange: true,
      searching: true,
      bStateSave: false,

      ajax: {
         url: "{{ route('agent.accepted_advertiser_datatable') }}",
         type: 'GET', 
         data: function(d) {
            d.type = 'player';
         }
      },

      columns: [
         { data: 'member_id', name: 'member_id', orderable: true, defaultContent: '' },
         { data: 'name', name: 'name', orderable: true, defaultContent: '' },
         { data: 'mobile', name: 'mobile', orderable: true, defaultContent: '' },
         { data: 'email', name: 'email', orderable: true, defaultContent: '' },
         { data: 'joined_date', name: 'joined_date', orderable: true, defaultContent: '' },
         { data: 'appointed_date', name: 'appointed_date', orderable: true, defaultContent: '' },
         { data: 'earnings', name: 'earnings', orderable: true, defaultContent: '' },
         { data: 'home_state', name: 'home_state', orderable: true, defaultContent: '' },
         {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
            render: function(data, type, row) {
               return `
                <div class="dropdown no-arrow archive-dropdown text-center">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu">
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#createProfileModal"><i class="fa fa-plus"></i> Create Profile</a>
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#editProfileModal"><i class="fa fa-pen"></i> Edit Profile</a>
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="/agent/profile/list/${row.member_id}"><i class="fa fa-list"></i> List Profile</a>
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#createTourModal"><i class="fa fa-plus"></i> Create Tour</a>
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#editTourModal"><i class="fa fa-pen"></i> Edit Tour</a>
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#manageMediaModal"><i class="fa fa-play-circle"></i> Manage Media</a>
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#manageMasseursModal"><i class="fa fa-user"></i> Manage Masseurs</a>
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#editAccountModal"><i class="fa fa-pen"></i> Edit Account</a>
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#viewAccountModal"><i class="fa fa-eye"></i>View Account</a>
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#printSummaryModal"><i class="fa fa-print"></i> Print</a>
                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="/agent/message/send?member_id=${row.member_id}"><i class="fa fa-comment"></i> Message</a>
                </div>
             </div>`;
            }
         }
      ],

      order: [[0, 'desc']],
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      pageLength: 10,
   });
});

// Action handler
function openActionModal(action, memberId) {
   console.log("Action Triggered:", action, "| Member ID:", memberId);
   // Add modal or route logic here
}
</script>
@endpush
