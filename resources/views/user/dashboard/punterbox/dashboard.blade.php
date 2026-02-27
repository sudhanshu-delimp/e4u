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
   .details-row {
        background-color: #f9f9f9;
    }
    .details-row th {
        color: var(--blue--text);
        font-weight: bold;
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content start here-->
    <!-- Page Heading -->
    <div class="row">
      
        <div class="d-sm-flex align-items-center justify-content-between col-md-12">
            <div class="custom-heading-wrapper">
                <h1 class="h1">Dashboard</h1>
                <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b>
                </h6>
            </div>
            @if (request('from') == 'dashboard')
              <div class="back-to-dashboard">
                  <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                      <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                  </a>
              </div>
             @endif 
        </div>
      <div class="col-md-12 mb-4">
          <div class="card collapse" id="notes" style="">
            <div class="card-body">
                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                <ol>
                  <li>The Punterbox register <b>(Punterbox)</b> is a free service to all Viewers. You can use
                     the Punterbox service at any time. Your details, when you undertake a search, are
                     kept confidential.</li>
                  <li>You can only search for an Escort by their mobile number. Search your next
                     booking by their mobile number itself, e.g. 0400123456. Do not include any
                     prefixes, e.g. +61 or spaces.
                     </li>
                     <li>E4U makes no claims:</li>
                     <ol class="level-2">
                        <li>as to the accuracy or legitimacy of the allegations contained in a Report; and</li>
                        <li>nor do we investigate the authenticity of the Reports (provided in confidence
                           by Viewers).</li>
                     </ol>
                </ol>
            </div>
          </div>
      </div>
  </div>
  <!-- Page Heading -->
   
  <div class="row">
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
   </div> --}}
   <div class="col-md-12">
      
      <div class="table-responsive">
         <table id="myReportListTable" class="table">
           <thead class="bg-first">
             <tr>
               <th>REF</th>
               <!-- <th>Status</th> -->
               <th>Mobile</th>
               <th>Incident Type</th>
               <th>Incident Date</th>
               <th>Location</th>
               <th class="text-center">Action</th>
             </tr>
           </thead>
           <tbody>
            @foreach ($punterboxReports as $num)
                <tr class="data-row">
                    <td>#{{ $num->id }}</td>
                    <td>{{ $num->escort_mobile }}</td>
                    <td>{{ $num->incident_nature }}</td>
                    <td>{{ $num->incident_date }}</td>
                    <td>{{ $num->state ? $num->state->iso2 : '' }} - {{ $num->state ? $num->state->name : '' }}
                    </td>
                    <td class="text-center">
                        {{-- <a href="javascript:void(0);" class="toggle-details"
                            data-target="details-{{ $num->id }}">
                            <i class="fa fa-search" data-toggle="tooltip" title="View"></i>
                        </a> --}}
                        <a href="javascript:void(0);" class="toggle-details">
                            <i class="fa fa-search" data-toggle="tooltip" data-placement="top"
                                title="View"></i>
                        </a>
                    </td>
                </tr>            
            @endforeach

             <!-- Hidden expandable row -->
             {{-- <tr class="details-row d-none">
               <td colspan="7">
                 <div>
                   <table class="table mb-0">
                     <tbody>
                       <tr>
                         <th>Our Ref:</th>
                         <td class="border-0">#30</td>
                         <th>Report Date:</th>
                         <td class="border-0">14-05-2025</td>
                       </tr>
                       <tr>
                         <th>Incident date:</th>
                         <td class="border-0">14-05-2025</td>
                         <th>Location:</th>
                         <td class="border-0">WA - Perth</td>
                       </tr>
                       <tr>
                         <th>Escort's name:</th>
                         <td class="border-0">Unknown</td>
                         <th>Escort's email:</th>
                         <td class="border-0">N/A</td>
                       </tr>
                       <tr>
                         <th>Incident Type:</th>
                         <td class="border-0">Fake</td>
                         <th>Rating:</th>
                         <td class="border-0">Do not book</td>
                       </tr>
                       <tr>
                         <th>Platform:</th>
                         <td class="border-0">Locanto</td>
                         <th>Profile Link:</th>
                         <td class="border-0">N/A</td>
                       </tr>
                       <tr>
                         <th>Summary of Incident:</th>
                         <td colspan="3" class="border-0">Suspicious activity, fake pics, aggressive behavior.</td>
                       </tr>
                     </tbody>
                   </table>
                 </div>
               </td>
             </tr>
              --}}
       
           </tbody>
         </table>
       </div>
   </div>
</div>
   <!--middle content end here-->
</div>
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<!-- <script>
  var table = $("#myReportListTable").DataTable({
      language: {
         search: "Search: _INPUT_",
         searchPlaceholder: "Search by Mobile Number"
      },
      info: true,
      paging: true,
      lengthChange: true,
      searching: true,
      bStateSave: true,
      order: [[1, 'desc']], // default sort on 2nd column (index starts from 0)
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      pageLength: 10,
    
    columnDefs: [
        { targets: 6, orderable: false }
    ]
   });
   
</script> -->
<!-- jQuery Toggle Script -->
<!-- <script>
   $(document).ready(function () {
     $('.toggle-details').on('click', function () {
       const $this = $(this);
       const $row = $this.closest('tr');
       const $nextRow = $row.next('.details-row');
       
       // Close all others
       $('.details-row').not($nextRow).addClass('d-none');
 
       // Toggle current
       $nextRow.toggleClass('d-none');
     });
   });
 </script> -->

<!-- <script>
   $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script> -->

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#myReportListTable').DataTable({
                "language": {
                    "zeroRecords": "No Record Found!",
                    searchPlaceholder: "Search by Mobile Number"
                },
                order: [[3, 'desc']],
                paging: true,
                processing: false,
                serverSide: false,
                pageLength: 10,
                lengthMenu: [
                    [10, 20, 50, 100],
                    [10, 20, 50, 100]
                ],
                ordering: true,
                columnDefs: [{
                        targets: 5,
                        orderable: false
                    } // Action column
                ],
                ajax: {
                    url: "{{ route('user.punterbox.dashboard') }}",
                    type: "GET",
                },
                columns: [{
                        data: 'ref',
                        name: 'ref'
                    },
                    {
                    data: 'escort_mobile',
                    name: 'escort_mobile',
                    
                },
                    {
                        data: 'incident_nature',
                        name: 'incident_nature'
                    },
                    {
                    data: 'incident_date',
                    render: function (data, type) {
                if (type === 'sort' || type === 'type') {
                    return data;
                }

                return formatDate(data);
            }
                },
                    {
                        data: 'location',
                        name: 'location'
                    },
                   
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Handle expand/collapse
            $('#myReportListTable tbody').on('click', '.toggle-details', function(e) {
                e.preventDefault();

                const tr = $(this).closest('tr');
                const row = table.row(tr);

                if (row.child.isShown()) {
                    // Close the details
                    row.child.hide();
                    tr.removeClass('shown');
                    $(this).removeClass('open');
                } else {
                    // Open the details
                    console.log(row.data());

                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                    $(this).addClass('open');
                }
            });

            function formatDate(dateString) {
                if (!dateString) return 'N/A';
                const date = new Date(dateString);
                const day = String(date.getDate()).padStart(2, '0');
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const year = date.getFullYear();
                return `${day}-${month}-${year}`;
            }

            function format(data) {
                console.log(data);
                return `
                    <div class="details-content p-3">
                        <table class="table mb-0 num_view_table">
                            <tbody>
                                <tr>
                                    <th>Ref:</th>
                                    <td class="border-0">${data.ref ?? 'N/A'}</td>
                                    <th>Incident Date:</th>
                                    <td class="border-0">${formatDate(data.incident_date) ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Escort's Name:</th>
                                    <td class="border-0">${data.escort_name ?? 'N/A'}</td>
                                    <th>Incident Type:</th>
                                    <td class="border-0">${data.incident_nature ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Report Date:</th>
                                    <td class="border-0">${formatDate(data.created_at) ?? 'N/A'}</td>
                                    <th>Location:</th>
                                    <td class="border-0">${data.location ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Escort's Email:</th>
                                    <td class="border-0">${data.escort_email ?? 'N/A'}</td>
                                    <th>Rating:</th>
                                    <td class="border-0">${data.rating ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                     <td class="border-0">
                                        ${data.status ? data.status.replace(/<[^>]*>/g, '') : 'N/A'}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Summary of Incident:</th>
                                    <td colspan="3" class="border-0">${data.what_happened ?? 'N/A'}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                `;
            }

        });
    </script>
@endpush