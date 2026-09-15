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
   td {
      vertical-align: middle !important;
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
      <div class="col-md-12 common-card mb-3">
            <div class="stats-card-grid">
               <div class="stats-card">
                  <div class="stats-details">
                     <div class="stats-icon">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path> </g></svg>
                     </div>
                     <div class="stats-top">
                        
                        <div class="stats-label ">Today</div>
                        <div class="stats-value today_report">0</div>
                     </div>                 
                  </div>
               </div>

               <div class="stats-card">
                  <div class="stats-details">
                     <div class="stats-icon">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path> </g></svg>
                     </div>
                     <div class="stats-top">
                        
                        <div class="stats-label">This Month</div>
                        <div class="stats-value month_report">0</div>
                     </div>
                  </div>
                  
               </div>

               <div class="stats-card">
                  <div class="stats-details">
                     <div class="stats-icon">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path> </g></svg>
                     </div>
                     <div class="stat-top">
                        
                        <div class="stats-label ">This Year</div>
                        <div class="stats-value year_report">0</div>
                     </div>
                  </div>
               </div>

               <div class="stats-card">
                  <div class="stats-details">
                     <div class="stats-icon">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path> </g></svg>
                     </div>
                     <div class="stats-top">
                        
                        <div class="stats-label">All Time</div>
                        <div class="stats-value all_time_report">0</div>
                     </div>
                  </div>  
               </div>
            </div>
         
      </div>
      <div class="col-md-12 common-card">
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
                <button class="btn-sm close_report_btn bg-transparent" type="button">
                    <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Close" class="custompopicon">
                </button>
            </div>

            <table class="table mb-0">
                <tbody>

                    ${profileImage}

                    <tr>
                        <th>REF:</th>
                        <td class="border-0">#${data.id ?? 'N/A'}</td>

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
                        <th>Platform:</th>
                        <td class="border-0">${data.platform ?? 'N/A'}</td>
                    </tr>

                    <tr>
                        <th>Profile Link:</th>
                        <td class="border-0">${data.profile_link ?? 'N/A'}</td>
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
                                 style="width: 70px; height: 70px; object-fit: cover; border-radius: 6px;">
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
      let url = "{{ route('user.notebox.delete', ':id') }}";
      url = url.replace(':id', id);

      Swal.fire({
         title: 'Are you sure?',
         text: 'This action will permanently remove this note box.',
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