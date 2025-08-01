@extends('layouts.escort')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<style>
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
.toggle-details i {
  color: #333;
  transition: color 0.3s ease, transform 0.2s ease;
}
.toggle-details.open i {
  transform: rotate(90deg);
  color: #007bff;
}
.tooltip-inner {
  background-color: #000 !important;
  color: #fff;
  font-weight: 500 !important;
  font-size: 14px;
  padding: 6px 12px;
  border-radius: 4px;
}
.tooltip.bs-tooltip-top .arrow::before {
  border-top-color: #000 !important;
}
</style>
@endsection

@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
  <div class="row">
    <div class="d-flex align-items-center justify-content-start mt-5 flex-wrap col-lg-12">
      <h1 class="h1">My Report</h1>
      <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
    </div>
    <div class="col-md-12 my-4">
      <div class="card collapse" id="notes">
        <div class="card-body">
          <p class="mb-0" style="font-size: 20px;"><b>Notes:</b></p>
          <ol>
            <li>
              You can view all of your Reports here. Simply search the report you are looking for by
              searching the mobile number. Or scroll through the pages.
            </li>
            <li>
              You can also select a Report/s you wish to edit or remove from your register by clicking
              the appropriate button. Any Report you remove from your register will be permanently
              removed.
            </li>
            <li>
              New Reports when created or edited, are listed here. The status of the new Report
              remains as <strong>Pending</strong> and is not available to other Members until approved and
              published.
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-12">
    <div class="my-punter-report mt-0">
       <div class="my-punter-report-box ">
          <span>0</span>
          <h4>Today</h4>
       </div>
       <div class="my-punter-report-box ">
          <span>0</span>
          <h4>This month
          </h4>
       </div>
       <div class="my-punter-report-box ">
          <span>0</span>
          <h4>This year
          </h4>
       </div>
       <div class="my-punter-report-box ">
          <span>0</span>
          <h4>All time
          </h4>
       </div>
    </div>

 </div>

    <!-- DataTable -->
    <div class="col-md-12">
      <div class="table-responsive">
        <table id="myReportTable" class="table display nowrap" width="100%">
          <thead class="bg-first">
            <tr>
              <th>REF</th>
              <th>Status</th>
              <th>Mobile</th>
              <th>Incident Type</th>
              <th>Incident Date </th>
              <th>Location</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @for ($i = 1; $i <= 10; $i++)
              <tr class="data-row">
                <td>#{{ $i }}</td>
                <td>Done</td>
                <td>0450954036</td>
                <td>Fake</td>
                <td>14-05-2025</td>
                <td>WA - Perth</td>
                <td><div class="dropdown no-arrow"> 
                  <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a> 
                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#"> <i class="fa fa-pen"></i> Edit</a>
                  </div></div></td>
              </tr>
            @endfor
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
<script src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<script>
  $(document).ready(function () {
    // Initialize DataTable
    var table = $('#myReportTable').DataTable({
      language: {
        search: "Search: _INPUT_",
        searchPlaceholder: "Search by Mobile...",
        lengthMenu: "Show _MENU_ entries",
        zeroRecords: "No matching records found",
        info: "Showing _START_ to _END_ of _TOTAL_ entries",
        infoEmpty: "No entries available",
        infoFiltered: "(filtered from _MAX_ total entries)"
      },
      paging: true,
      processing: false,
      serverSide: false,
      pageLength: 5,
      lengthMenu: [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
      ordering: true,
      columnDefs: [
        { targets: 6, orderable: false } // Action column
      ]
    });

    // Toggle expandable rows
    $('body').on('click', '.toggle-details', function () {
      var targetId = $(this).data('target');
      $('#' + targetId).toggleClass('d-none');
      $(this).toggleClass('open');
    });
  });
</script>
@endpush
