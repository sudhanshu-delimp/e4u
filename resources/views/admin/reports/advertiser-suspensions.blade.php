@extends('layouts.admin')
@section('style')
<style>
   td,
   th {
       vertical-align: middle !important;
   }
   #transactionSummaryTable td {
    white-space: normal !important;
    word-break: break-word;
}
.avatar img {
   width: 60px; height: 60px;
   border-radius: 50%;
}
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content-->
   <div class="row mt-5">      
      <div class="custom-heading-wrapper col-md-12">
        <h1  class="h1"> Advertiser Suspensions</h1>
        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
     </div>
     <div class="col-md-12 ">
         <div class="card collapse mb-4" id="notes">
             <div class="card-body">
                 <h3 class="NotesHeader"><b>Notes:</b> </h3>
                 <ol>
                     <li>Advertiser Listings which have been suspended by the Advertiser for a set period of
                        time.</li>
                     <li>Upon the expiration of the suspension period, set by the Advertiser, the Listing will
                        become active again for the remaining duration of the Listing.</li>
                 </ol>
             </div>
         </div>
     </div>
    <div class="col-md-12">        
        <div class="table-responsive membership--inner">
            <table class="table" id="advertiserSuspenstionTable">
                 <thead class="table-bg">
                   <tr>
                    <th>ID</th>
                    <th>Member ID</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Days</th>
                    <th>Location</th>
                    <th>Action</th>
                   </tr>
                </thead>
                <tbody>
                  <tr>
                     <td>323456</td>
                     <td>E40125</td>
                     <td>25-05-2025</td>
                     <td>30-05-2025</td>
                     <td>6 </td>
                     <td>WA</td>
                     <td class="text-center">
                        <div class="dropdown no-arrow">
                           <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                           </a>
                           <div class="dot-dropdown dropdown-menu  dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                              
                              
                              <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#view-profile" > <i class="fa fa-eye"></i> View</a>
                              
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


<!-- View Merchant popupform -->
<div class="modal fade upload-modal" id="view-profile" tabindex="-1" role="dialog" aria-labelledby="view-profileLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         
         <!-- Header -->
         <div class="modal-header">
            <h5 class="modal-title" id="view-profileLabel">
               <img src="{{asset('assets/dashboard/img/view-merchant.png')}}" class="custompopicon" alt="View Merchant">
               View Profile
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">
                  <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
               </span>
            </button>
         </div>

         <!-- Body -->
         <div class="modal-body pb-0">
            <div class="row">
                <div class="col-12">
                    <!-- iframe inside modal -->
                    <iframe src="" id="escortPopupModalBodyIframe" frameborder="0" style="width:100%; height:80vh;" allowfullscreen=""></iframe>
                </div>
                <!-- Footer Buttons -->
                <div class="col-lg-12">
                  <div class="d-flex justify-content-end mb-3">
                    
                     {{-- <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">
                        Close
                     </button> --}}
                  </div>
                </div>
            </div>
        </div>

      </div>
   </div>
</div>


 @endsection
@section('script')
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>

   // admin.advertiser-suspensions-list-ajax
   $(document).ready(function() {
      ajaxDatatableReload();

      $(document).on('click', '.viewEscortSuspendedProfile', function(e) {
            e.preventDefault(); // prevent default link behavior

            const escortId = $(this).attr('data-escort-id');
            var profileUrl = '{{route("profile.description","_id")}}'.replace('_id',escortId);

            $("#escortPopupModalBodyIframe").attr('src', profileUrl)
        });

   });

   function ajaxDatatableReload()
   {
      var table = $('#advertiserSuspenstionTable').DataTable({
            language: {
            search: "Search: _INPUT_",
            searchPlaceholder: "Search by Member ID"
         },   
         info: true,
         lengthChange: true,
         searching: true,
         bStateSave: true,
         order: [[1, 'desc']],
         processing: true,
         serverSide: true,
         paging: true,
         ajax: {
               url: "{{ route('admin.advertiser-suspensions-list-ajax') }}", 
               type: "GET",
               dataSrc: function(json) {
                  // var totalRows = json.data.length; 
                  var totalRows = json.recordsTotal || json.recordsFiltered; 
                  $(".totalListing").text(totalRows);
                  console.log(json, json.per_page, json.current_page);
                  return json.data;
               }
         },
         columns: [
               { data: 'escort_id', name: 'escort_id' },
               { data: 'member_id', name: 'member_id' },
               { data: 'start_date', name: 'start_date' },
               { data: 'end_date', name: 'end_date' },
               { data: 'days', name: 'days' },
               { data: 'location', name: 'location' },
               { data: 'action', name: 'action', orderable: false, class:'text-center' }
         ]
      });
   }

 </script>

@endsection
