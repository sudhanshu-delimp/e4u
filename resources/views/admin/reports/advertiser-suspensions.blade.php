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
      width: 60px;
      height: 60px;
      border-radius: 50%;
   }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content-->
   <div class="row mt-5">
      <div class="custom-heading-wrapper col-md-12">
         <h1 class="h1">Listings Suspended (Advertiser)</h1>
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
         <div class="row my-3">
            <div class="col-md-12 col-sm-12 d-flex justify-content-between" style="gap: 50px;">
               <div class="">
                  <select id="advertiserFilter" name="advertiser_type" class="form-select form-select-sm p-2" style="width: 200px;">
                     <option value="{{ route('admin.advertiser-suspensions-list-ajax','escort') }}">Escort</option>
                     <option value="{{ route('admin.advertiser-suspensions-list-ajax','massage') }}">Massage Center</option>
                  </select>
               </div>
               <div class="total_listing">
                  <div><span>Total : </span></div>
                  <div><span class="totalListing">0</span></div>
               </div>
            </div>
         </div>
         <div class="table-responsive">
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

               </tbody>

               <tr>
                  <th colspan="7" class="border-0"></th>
               </tr>
               <tfoot class="bg-first t-foot">
                  <tr>
                     <th colspan="2" class="text-left border-0">Server time: <span class="serverTime">{{date('d-m-Y h:i a')}}</span></th>
                     <th colspan="2" class="text-center border-0">Refresh time:<span class="refreshSeconds"> 15</span></th>
                     <th colspan="3" class="text-right border-0" style="text-align: right!important;">Up time: <span class="uptimeClass">{{ getAppUptime() }}</span></th>
                  </tr>
               </tfoot>

            </table>
         </div>
      </div>
   </div>
</div>



<!-- View Merchant popupform -->
<div class="modal fade upload-modal" id="view-profile" tabindex="-1" role="dialog" aria-labelledby="view-profileLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
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
@push('script')
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
   $(document).ready(function() {


      // $('#customSearch').on('keyup', function() {
      //    $('#advertiserSuspenstionTable').DataTable().search(this.value).draw();
      // });

      // $(document).on('click', '.viewEscortSuspendedProfile', function(e) {
      //    e.preventDefault(); // prevent default link behavior

      //    const escortId = $(this).attr('data-escort-id');
      //    var profileUrl = '{{route("profile.description","_id")}}'.replace('_id', escortId);

      //    $("#escortPopupModalBodyIframe").attr('src', profileUrl)
      // });

   });

   var table = $('#advertiserSuspenstionTable').DataTable({
      language: {
         search: "Search: _INPUT_",
         searchPlaceholder: "Search by Member ID"
      },
      info: true,
      lengthChange: true,
      searching: true,
      bStateSave: true,
      order: [
         [1, 'desc']
      ],
      processing: true,
      serverSide: true,
      paging: true,
      ajax: {
         url: $("select[name='advertiser_type']").val(),
         type: "GET",
         dataSrc: function(json) {
            // var totalRows = json.data.length; 
            var totalRows = json.recordsTotal || json.recordsFiltered;
            $(".totalListing").text(totalRows);
            console.log(json, json.per_page, json.current_page);
            $(".serverTime").text(json.server_time);
            $(".uptimeClass").html(json.server_up_time);
            return json.data;
         }
      },
      columns: [{
            data: 'advertiser_id',
            name: 'advertiser_id',
            orderable: false,
         },
         {
            data: 'member_id',
            name: 'member_id'
         },
         {
            data: 'start_date',
            name: 'start_date'
         },
         {
            data: 'end_date',
            name: 'end_date'
         },
         {
            data: 'days',
            name: 'days'
         },
         {
            data: 'location',
            name: 'location'
         },
         {
            data: 'action',
            name: 'action',
            orderable: false,
            class: 'text-center'
         }
      ]
   });

   $("select[name='advertiser_type']").on("change", function() {
      var url = $(this).val();
      table.ajax.url(url).load();
   });

   let countdown = 15;
   setInterval(() => {
      countdown--;
      $(".refreshSeconds").text(' ' + countdown);

      if (countdown <= 0) {
         table.draw();
         countdown = 15;

      }

   }, 1000);
</script>

@endpush