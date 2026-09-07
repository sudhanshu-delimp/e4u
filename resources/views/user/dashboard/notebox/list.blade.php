@extends('layouts.userDashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
   .parsley-errors-list {
      list-style: none;
      color: rgb(248, 0, 0)
   }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content start here-->

   <!-- Page Heading -->
   <div class="row">
      <div class="col-md-12 custom-heading-wrapper justify-content-between">
         <div class="d-flex align-items-center">
            <h1 class="h1">My Noteboxes</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
         </div>
         @if (request('from') == 'dashboard')
         <div class="back-to-dashboard">
            <a href="{{ url()->previous() ?? route('user-dashboard') }}">
               <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
            </a>
         </div>
         @endif
      </div>
   </div>
   <div class="row">
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes" style="">
            <div class="card-body">
               <h3 class="NotesHeader"><b>Notes:</b></h3>
               <ol>
                  <li>You can view all of your Noteboxes here. Simply search the Notebox you are looking
                     for by searching the mobile number. Or scroll through the pages.</li>
                  <li>You can also select a Notebox you wish to edit or remove from your register by clicking
                     the appropriate button. Any Notebox you remove from your register will be permanently
                     removed.</li>
                  <li>New Noteboxes when created or edited, are listed here.</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <!-- Page Heading -->
   <div class="row">
      <div class="col-md-12">
         <div class="stats-container">
            <div class="stat-card-wrapper">
               <div class="stat-card">
                  <div class="stat-top">
                     <div class="stat-icon"><i class="fas fa-calendar-day"></i></div>
                     <div class="stat-label ">Today</div>
                  </div>
                  <div class="stat-number today_report">0</div>
               </div>

               <div class="stat-card">
                  <div class="stat-top">
                     <div class="stat-icon"><i class="fas fa-calendar-week"></i></div>
                     <div class="stat-label">This Month</div>
                  </div>
                  <div class="stat-number month_report">0</div>
               </div>

               <div class="stat-card">
                  <div class="stat-top">
                     <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                     <div class="stat-label ">This Year</div>
                  </div>
                  <div class="stat-number year_report">0</div>
               </div>

               <div class="stat-card">
                  <div class="stat-top">
                     <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                     <div class="stat-label">All Time</div>
                  </div>
                  <div class="stat-number all_time_report">0</div>
               </div>
            </div>
         </div>
      </div>
      {{-- <div class="col-lg-6 col-sm-12">
         <div class="add-punterbox-report">
            <form action="">
               <label class="search-label">Search by mobile number (no spaces)</label>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Search..." aria-label="Search by mobile" aria-describedby="button-search">
                  <div class="input-group-append">
                     <button class="btn btn-search" type="button" id="button-search">Search</button>
                  </div>
               </div>
            </form>
          </div>
      </div>
       --}}
      <div class="col-md-12">
         <div class="table-responsive">
            <table id="myNoteBoxReportListTable" class="table">
               <thead class="bg-first">
                  <tr>
                     <th>REF</th>
                     <th>Stage Name</th>
                     <th>Mobile</th>
                     <th>Price</th>
                     <th>Status Type</th>
                     <th>Rating</th>
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody>

               </tbody>
            </table>
         </div>
      </div>
   </div>
   <!--middle content end here-->
</div>
@endsection
@push('script')
<script src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
   $(document).ready(function() {
      // Initialize DataTable
      var table = $('#myNoteBoxReportListTable').DataTable({

         "language": {
            zeroRecords: "No Record Found!",
            searchPlaceholder: "Search by Stage Name or Mobile Number"
         },

         // Newest record first
         order: [
            [0, 'desc']
         ],

         paging: true,
         processing: false,
         serverSide: false,
         lengthMenu: paginateRange,
         pageLength: paginateLength,
         ordering: true,

         columnDefs: [{
            targets: 6,
            orderable: false
         }],

         ajax: {
            url: "{{ route('user.my-notebox-reports') }}",
            type: "GET",

            dataSrc: function(json) {
               console.log("Received Data:", json);

               $(".today_report").text(json.today);
               $(".month_report").text(json.this_month);
               $(".year_report").text(json.this_year);
               $(".all_time_report").text(json.all_time);

               return json.data;
            }
         },

         columns: [

            // REF
            {
               data: 'id',
               name: 'ref'
            },

            // Stage Name
            {
               data: 'stage_name',
               name: 'stage_name'
            },

            // Mobile
            {
               data: 'mobile',
               name: 'mobile',
               render: function(data, type, row) {

                  let clean = $('<div>').html(data || '').text();
                  let normalized = clean.replace(/\s+/g, '');

                  if (type === 'sort' || type === 'filter') {
                     return normalized;
                  }

                  return data || '';
               }
            },

            // Price
            {
               data: 'advertised_price_per_hour',
               name: 'advertised_price_per_hour',
               render: function(data) {
                  return data ? data : 'N/A';
               }
            },

            // Status Type
            {
               data: 'status_type',
               name: 'status_type',
               render: function(data) {
                  return data ? data : 'N/A';
               }
            },

            // Rating
            {
               data: 'rating',
               name: 'rating',
               render: function(data) {
                  return data ? data : 'N/A';
               }
            },

            // Action
            {
               data: 'actions',
               name: 'actions',
               orderable: false,
               searchable: false,
               className: 'text-center'
            }
         ]
      });

      // Toggle expandable rows
      $('body').on('click', '.toggle-details', function() {
         var targetId = $(this).data('target');
         $('#' + targetId).toggleClass('d-none');
         $(this).toggleClass('open');
      });


      $('#myNoteBoxReportListTable tbody').on('click', '.view_report', function(e) {
         e.preventDefault();

         const tr = $(this).closest('tr');
         const row = table.row(tr);

         if (row.child.isShown()) {

            row.child().find('.child-wrapper').slideUp(250, function() {
               row.child.hide();
               tr.removeClass('shown');
            });

            $(this).removeClass('open');

         } else {

            row.child(
               '<div class="child-wrapper" style="display:none;">' +
               format(row.data()) +
               '</div>'
            ).show();

            row.child().find('.child-wrapper').slideDown(250);

            tr.addClass('shown');
            $(this).addClass('open');
         }
      });


      $(document).on('click', '.close_report_btn', function(e) {
         e.preventDefault();

         const childTr = $(this).closest('tr');
         const parentTr = childTr.prev();
         const row = table.row(parentTr);

         childTr.find('.child-wrapper').slideUp(250, function() {
            row.child.hide();
            parentTr.removeClass('shown');
            parentTr.find('.view_report').removeClass('open');
         });
      });


      function format(data) {

         let profileImage = '';

         return `
        <div class="details-content p-3 bg-light border rounded">

            <div class="mb-3 d-flex justify-content-end">
                <button class="btn-sm btn-cancel-modal close_report_btn" type="button">
                    Close
                </button>
            </div>

            <table class="table mb-0">
                <tbody>

                    ${profileImage}

                    <tr>
                        <th>REF:</th>
                        <td class="border-0">${data.ref ?? 'N/A'}</td>

                        <th>Stage Name:</th>
                        <td class="border-0">${data.stage_name ?? 'N/A'}</td>
                    </tr>

                    <tr>
                        <th>Mobile:</th>
                        <td class="border-0">${data.mobile ?? 'N/A'}</td>

                        <th>Price:</th>
                        <td class="border-0">${data.advertised_price_per_hour ?? 'N/A'}</td>
                    </tr>

                    <tr>
                        <th>State:</th>
                        <td class="border-0">${data.state ?? 'N/A'}</td>

                        <th>Location:</th>
                        <td class="border-0">${data.location ?? 'N/A'}</td>
                    </tr>

                    <tr>
                        <th>Meeting Type:</th>
                        <td class="border-0">${data.meeting_type ?? 'N/A'}</td>

                        <th>Extras Charged:</th>
                        <td class="border-0">${data.extras_charged ?? 'N/A'}</td>
                    </tr>

                    <tr>
                        <th>Photos Authenticity:</th>
                        <td class="border-0">${data.photos_authenticity ?? 'N/A'}</td>

                        <th>Ethnicity:</th>
                        <td class="border-0">${data.ethnicity ?? 'N/A'}</td>
                    </tr>

                    <tr>
                        <th>Nationality:</th>
                        <td class="border-0">${data.nationality ?? 'N/A'}</td>

                        <th>Estimated Age:</th>
                        <td class="border-0">${data.estimated_age ?? 'N/A'}</td>
                    </tr>

                    <tr>
                        <th>Body Shape:</th>
                        <td class="border-0">${data.body_shape ?? 'N/A'}</td>

                        <th>Overall Looks:</th>
                        <td class="border-0">${data.overall_looks ?? 'N/A'}</td>
                    </tr>

                    <tr>
                        <th>Overall Personality:</th>
                        <td class="border-0">${data.overall_personality ?? 'N/A'}</td>

                        <th>Status Type:</th>
                        <td class="border-0">${data.status_type ?? 'N/A'}</td>
                    </tr>

                    <tr>
                        <th>Rating:</th>
                        <td class="border-0">${data.rating ?? 'N/A'}</td>

                        <th>Status:</th>
                        <td class="border-0">${data.status ?? 'N/A'}</td>
                    </tr>

                    <tr>
                        <th>Platform:</th>
                        <td class="border-0">${data.platform ?? 'N/A'}</td>

                        <th>Profile Link:</th>
                        <td class="border-0">${data.profile_link ?? 'N/A'}</td>
                    </tr>
                   
                    <tr>
                        <th>Summary:</th>
                        <td colspan="3" class="border-0">
                            ${data.summary_of_encounter ?? 'N/A'}
                        </td>
                    </tr>

                     ${data.profile_pic ? `
                     <tr>
                        <th>Profile Image:</th>
                        <td colspan="3" class="border-0">
                           <img src="${data.profile_pic}"
                                 alt="Profile Image"
                                 style="width: 120px; height: 120px; object-fit: cover; border-radius: 6px;">
                        </td>
                     </tr>
                     ` : ''}

                </tbody>
            </table>
        </div>
    `;
      }
   });

   $(document).on('click', '.delete_report', function(e) {
      e.preventDefault();

      let id = $(this).data('id');
      let url = "{{ route('user.my-report.delete', ':id') }}";
      url = url.replace(':id', id);

      Swal.fire({
         title: 'Are you sure?',
         text: 'This action will permanently remove the report.',
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#d33',
         cancelButtonColor: '#6c757d',
         confirmButtonText: 'Yes, delete',
         cancelButtonText: 'Cancel'
      }).then((result) => {

         if (result.isConfirmed) {

            $.ajax({
               url: url,
               type: 'DELETE',
               data: {
                  _token: $('meta[name="csrf-token"]').attr('content')
               },
               success: function(response) {

                  Swal.fire({
                     icon: 'success',
                     title: 'Success!',
                     text: response.message,
                     confirmButtonText: 'OK',
                     confirmButtonColor: '#3085d6'
                  });
                  $('#myNoteBoxReportListTable').DataTable().ajax.reload(null, false);
               }
            });

         }
      });
   });
</script>
@endpush