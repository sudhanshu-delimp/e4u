@extends('layouts.center')

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
  color: #ff3c5f;
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
    <div class="col-md-12 custom-heading-wrapper">
      <h1 class="h1">My Reports</h1>
      <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
    </div>
    <div class="col-md-12 mb-4">
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
              remains as <i style="color: #000">Pending</i> and is not available to other Members until approved and
              published.
            </li>
          </ol>
        </div>
      </div>
    </div> 
  </div> 

  <div class="col-md-12">
    <div class="stats-container">
        <div class="stat-card-wrapper">
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon"><i class="fas fa-calendar-day"></i></div>
                    <div class="stat-label">Today</div>
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
                    <div class="stat-label">This Year</div>
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

    <!-- DataTable -->
    <div class="col-md-12">
      <div class="table-responsive">
        <table id="myReportTable" class="table display nowrap num_table" width="100%">
          <thead class="bg-first">
            <tr>
              <th>REF</th>
              <th>Mobile</th>
              <th>Incident Type</th>
              <th>Incident Date </th>
              <th>Location</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
             @foreach ($nums as $num)
                  <tr class="data-row">
                      <td>#{{ $num->id }}</td>
                      <td>{{ $num->offender_mobile }}</td>
                      <td>{{ $num->incident_nature }}</td>
                      <td>{{ $num->incident_date }}</td>
                      <td>{{ $num->state ? $num->state->iso2 : '' }} - {{ $num->state ? $num->state->name : '' }}
                      </td>
                      <td class="text-center">
                          <a href="javascript:void(0);" class="toggle-details"
                              data-target="details-{{ $num->id }}">
                              <i class="fa fa-search" data-toggle="tooltip" title="View"></i>
                          </a>
                      </td>
                  </tr>
              @endforeach
          </tbody>
        </table>
      </div>
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
           
            "language": {
                "zeroRecords": "No Record Found!",
                searchPlaceholder: "Search by Mobile Number"
            },
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
                url: "{{ route('center.my-reports') }}",
                type: "GET",
                dataSrc: function (json) {
                    console.log("Received Data:", json); // ✅ Debug here
                    $(".today_report").text(json.today);
                    $(".month_report").text(json.this_month);
                    $(".year_report").text(json.this_year);
                    $(".all_time_report").text(json.all_time);
                    return json.data; // ✅ Return the data array for DataTables to render
                }
            },
            columns: [{
                    data: 'ref',
                    name: 'ref'
                },
                {
                    data: 'offender_mobile',
                    name: 'offender_mobile'
                },
                {
                    data: 'incident_nature',
                    name: 'incident_nature'
                },
                {
                    data: 'incident_date',
                    name: 'incident_date'
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

    // Toggle expandable rows
    $('body').on('click', '.toggle-details', function () {
      var targetId = $(this).data('target');
      $('#' + targetId).toggleClass('d-none');
      $(this).toggleClass('open');
    });
  });
</script>
@endpush
