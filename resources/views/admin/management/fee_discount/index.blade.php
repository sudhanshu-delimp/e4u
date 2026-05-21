@extends('layouts.admin')
@section('style') 
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
      <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
         <div class="row">

            <div class="custom-heading-wrapper col-md-12">
               <h1 class="h1">Discount to Fees</h1>
               <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
            </div>
            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes">
                     <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                           <li>
                              Discounts to Fees (<b>Discounts</b>) must be approved by the Managing Director (Level 1).
                           </li>

                           <li>
                              Discounts only apply to the Advertiser’s Membership Type.
                           </li>

                           <li>
                              Where a Discount has been applied, the Loyalty Program falls away.
                           </li>
                        </ol>
                     </div>
               </div>
            </div> 
         </div>

         <div class="row mb-3">
            <div class="col-lg-12">
               <div class="d-flex justify-content-between gap-10">
                  <div class="d-flex justify-content-between gap-10">
                     <div class="total_listing">
                        <div><span>Escorts Discount : </span></div>
                        <div><span class="totalInprogressTask" id="active_escort_count">0</span></div>
                     </div>
                     
                     <div class="total_listing">
                           <div><span>Centres Discount : </span></div>
                           <div><span class="totalInprogressTask" id="active_message_center_count">0</span></div>
                     </div>
                  </div>
                  <button class="btn-success-modal" type="button" data-target="#advertiser_discount" data-toggle="modal">
                     Advertiser Discount
                  </button>
               </div>
            </div>
         </div>

          <div class="row">
            <div class="col-sm-12">
               <div class="table-responsive">
                  <table class="table w-100 " id="discountFeetable">
                     <thead class="table-bg">
                        
                        <tr>
                           <th>Member ID</th>
                           <th>Name</th>
                           <th>Agent ID</th>
                           <th>Rate</th>
                           <th>Discount</th>
                           <th>Start Date</th>
                           <th>End Date</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                           
                     </thead>
                     <tbody></tbody>
                  </table>
               </div>
            </div>
         </div>

      </div>
</div>

@include('admin/management/fee_discount/modal/discount_history_modal')
@include('admin/management/fee_discount/modal/advertiser_discount_modal')
@include('admin/management/fee_discount/modal/renew_discount_modal')
@include('admin/management/fee_discount/modal/confirm_modal')

@endsection

@prepend('script')
<script>
    var table;
    table = $('#discountFeetable').DataTable({
        serverSide: true,
        processing: true,
        autoWidth: false,
        "language": {
                "zeroRecords": "There is no record of the search criteria you entered.",
                searchPlaceholder: "Search..."
            },
        initComplete: function() {
            // if ($('#returnToReportBtn').length === 0) {
            //     $('.dataTables_filter').append(
            //         '<button id="returnToReportBtn" class="create-tour-sec my-3">Return to Report</button>'
            //     );
            // }
            $('#returnToReportBtn').on('click', function() {
                table.search('').draw();
            });
        },
                    
        ajax: {
            url: "{{ route('advertiser.get_fee_discounts_listing') }}",
            data: function (d) {
            
            }
        },
         drawCallback: function(settings) {
            let json = settings.json;
            $('#active_escort_count').text(json.active_escort_count);
            $('#active_message_center_count').text(json.active_message_center_count);
         },
        columns: [
               { data: 'member_id', name: 'member_id', searchable: true, orderable:false ,defaultContent: 'NA'},
               { data: 'advertiser_name', name: 'name', searchable: false, orderable:false ,defaultContent: 'NA'},
               { data: 'agent_id', name: 'agent_id', searchable: false, orderable:false ,defaultContent: 'NA'},
               { data: 'rate', name: 'rate', searchable: false, orderable:false ,defaultContent: 'NA'},
               { data: 'discount', name: 'discount', searchable: false, orderable:false,defaultContent: 'NA' },
               { data: 'discount_start_date', name: 'start_date', searchable: false, orderable:false,defaultContent: 'NA' },
               { data: 'discount_end_date', name: 'end_date', searchable: false, orderable:true,defaultContent: 'NA' },
               { data: 'status', name: 'status', searchable: false, orderable:false,defaultContent: 'NA' },
               { data: 'action', name: 'edit', searchable: false, orderable:false, defaultContent: 'NA', class:'text-center' },
           ],
        order: [6,'desc'],
    });

      table.on('draw.dt', function () {
         console.log('FINAL render complete');
      });

   $(document).on('click', '.cancel_discount', async function (e) {
      e.preventDefault();
      if (await isConfirm({'action': 'Cancel','text':' Cancel This Discount.'})) { 
         let discount_id = $(this).data('discount_id');
         $.ajax({
                  url: "{{ route('advertiser.cancel_fee_discount') }}",
                  type: 'POST',
                  data: {discount_id},
                  beforeSend: function () {
                     Swal.fire({
                        title: 'Please wait...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                     });
                  },
                  success: function (res, textStatus, xhr) {
                     Swal.close();
                     let option = getStatusOption(xhr);
                     if (res.status) {
                        table.draw();
                     }

                     Swal.fire({
                        icon: option.icon,
                        title: option.title,
                        text: option.message
                     });

                  },
                  error: function (xhr) {
                     Swal.close();
                     let option = getStatusOption(xhr);
                     Swal.fire({
                        icon: option.icon,
                        title: option.title,
                        text: option.message
                     });
                  }
            });
      }
   });
</script>
@endprepend

