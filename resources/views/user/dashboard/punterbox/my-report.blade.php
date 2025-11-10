@extends('layouts.userDashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
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
      <div class="custom-heading-wrapper col-md-12">
          <h1 class="h1">My Report</h1>
        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
    </div>
      <div class="col-md-12 mb-4">
          <div class="card collapse" id="notes" style="">
            <div class="card-body">
                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                <ol>
                  <li>You can view all of your Reports here. Simply search the report you are looking for by
                     searching the mobile number. Or scroll through the pages.</li>
                  <li>You can also select a Report/s you wish to edit or remove from your register by clicking
                     the appropriate button. Any Notebox you remove from your register will be permanently
                     removed.</li>
                  <li>New Reports when created or edited, are listed here. The status of the new Report
                     remains as Pending and is not available to other Viewers until approved and published.</li>
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
                          <div class="stat-label">Today</div>
                      </div>
                      <div class="stat-number">0</div>
                  </div>

                  <div class="stat-card">
                      <div class="stat-top">
                          <div class="stat-icon"><i class="fas fa-calendar-week"></i></div>
                          <div class="stat-label">This Month</div>
                      </div>
                      <div class="stat-number">0</div>
                  </div>

                  <div class="stat-card">
                      <div class="stat-top">
                          <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                          <div class="stat-label">This Year</div>
                      </div>
                      <div class="stat-number">0</div>
                  </div>

                  <div class="stat-card">
                      <div class="stat-top">
                          <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                          <div class="stat-label">All Time</div>
                      </div>
                      <div class="stat-number">0</div>
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
            <table id="myReportListTable" class="table">
              <thead class="bg-first">
                <tr>
                  <th>REF</th>
                  <th>Mobile</th>
                  <th>Incident Type</th>
                  <th>Incident Date</th>
                  <th>Location</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>#30</td>
                  <td>0450954036</td>
                  <td>Fake</td>
                  <td>14-05-2025</td>
                  <td>WA - Perth</td>
                  <td class="text-center">
                    <a href="javascript:void(0);" class="toggle-details">
                      <i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="View"></i>
                    </a>
                  </td>
                </tr>
          
                <!-- Hidden expandable row -->
                {{-- <tr class="details-row d-none">
                  <td colspan="6">
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
                </tr> --}}
                
          
              </tbody>
            </table>
          </div>
      </div>
   </div>
   <!--middle content end here-->
</div>
@endsection
@push('script')
  

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
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
      order: [[1, 'desc']],
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      pageLength: 10,
      
    columnDefs: [
        { targets: 5, orderable: false }
    ]
   });
   
</script>
<script>
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
 </script>
<script>
   $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
@endpush