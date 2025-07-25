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
            <!--middle content-->
            
         {{-- Page Heading   --}}
         <div class="row">
            
            <div class="d-flex align-items-center justify-content-between col-md-12">
               <div class="custom-heading-wrapper">

                   <h1 class="h1">Advertiser List</h1>

                 
                   <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
               </div>
               <div class="back-to-dashboard">
                   <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                       <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                   </a>
               </div>
           </div>
            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes" style="">
                  <div class="card-body">
                     <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                     <ol>
                        

                  <li style="font-size: 15px;">You can access all of your Advertisers here.  The report 'Earnings' column is Commission paid to you by E4U according to the Advertiser's spend.</li>
                  <li style="font-size: 15px;" class="mb-0">Click the 'Action' button and select from the range of options available to you including Messaging to an Advertiser.</li>

                     </ol>
                  </div>
               </div>
            </div>
         </div>

         {{-- end --}}
            

      
            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-12">
                
                  <div class="row">
                     <div class="col-md-12">
                        
                                   <div class="">
                                        <table class="table table-bordered text-center" id="myAdvertisersList">
                                             <thead id="table-sec" class="table-bg">
                                                <tr>
                                                   <th>Ref</th>
                                                   <th>Member ID</th>
                                                   <th>Name</th>
                                                   <th>Mobile</th>
                                                   <th>Email</th>
                                                   <th>Home State</th>
                                                 
                                                </tr>
                                             </thead>
                                             
                                          </table>
                                   </div>

                        </div>
                     </div>
                  </div>
               </div>
  <!--right side bar end-->

              
           
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
               searchPlaceholder: "Member ID or Reference ID",
               lengthMenu: "Show _MENU_ entries",
               zeroRecords: "No matching records found",
               info: "Showing _START_ to _END_ of _TOTAL_ entries",
               infoEmpty: "No entries available",
               infoFiltered: "(filtered from _MAX_ total entries)"
         },
        processing: true,
        serverSide: true,
        lengthChange: true,
        searching: true,
        bStateSave: false,

        ajax: {
            url: "{{ route('agent.accepted_advertiser_datatable') }}",
            type: 'GET',
            data: function (d) {
                d.type = 'player';
            }
        },

        columns: [
            { data: 'ref_number', name: 'ref_number', orderable: true, defaultContent: 'NA' },
            { data: 'member_id', name: 'member_id', orderable: true, defaultContent: 'NA' },
            { data: 'name', name: 'name', orderable: true, defaultContent: 'NA' },
            { data: 'phone', name: 'phone', orderable: true, defaultContent: 'NA' },
            { data: 'email', name: 'email', orderable: true, defaultContent: 'NA' },
            { data: 'state', name: 'state', orderable: true, defaultContent: 'NA' },
        ],

        order: [[1, 'desc']],

        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        pageLength: 10,
    });

   //  $('#myAdvertisersList').on('init.dt', function () {
   //  $('.dataTables_filter input[type="search"]').attr('placeholder', 'Search by Member ID or Reference ID...');
   //  });
   });


</script>
@endpush