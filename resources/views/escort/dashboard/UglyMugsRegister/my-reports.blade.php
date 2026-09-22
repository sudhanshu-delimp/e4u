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
          <h3 class="NotesHeader"><b>Notes:</b></h3>
          <ol>
            <li>
              You can view all of your Reports here. Simply search the report you are looking for by
              searching the mobile number. Or scroll through the pages.
            </li>
            <li>
              You can also select a Report's you wish to edit or remove from your register by clicking
              the appropriate button. Any Report you remove from your register will be permanently
              removed.
            </li>
            <li>
              New Reports when created or edited, are listed here. The status of the new Report
              remains as <i style="color:#000">Pending</i> and is not available to other Members until approved and
              published.
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12 common-card mb-3">
      <div class="stats-card-grid">
          <div class="stats-card">
              <div class="stats-details">
                  <div class="stats-icon">
                      <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path> </g></svg>
                  </div>
                  <div class="stat-text">                                    
                      <div class="stats-label ">Today</div>                                
                      <div class="stats-value">0</div>
                  </div>
              </div>
          </div>

          <div class="stats-card">
              <div class="stats-details">
                      <div class="stats-icon">
                      <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path> </g></svg>
                  </div>
                  <div class="stat-text">                                
                      <div class="stats-label">This Month</div>                            
                      <div class="stats-value">0</div>
                  </div>
              </div>
          </div>

          <div class="stats-card">
              <div class="stats-details">
                      <div class="stats-icon">
                      <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path> </g></svg>
                  </div>
                  <div class="stat-text">                                
                      <div class="stats-label ">This Year</div>                            
                      <div class="stats-value">0</div>
                  </div>
              </div>
          </div>

          <div class="stats-card">
              <div class="stats-details">
                      <div class="stats-icon">
                      <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"></path> </g></svg>
                  </div>
                  <div class="stat-text">                                
                      <div class="stats-label">All Time</div>                           
                      <div class="stats-value">0</div>
                  </div>
              </div>
          </div>
      </div>            
  </div>   

    <!-- DataTable -->
    <div class="col-md-12 common-card">
      <div class="table-responsive">
        <table id="myReportTable" class="table display nowrap" width="100%">
          <thead class="bg-first">
            <tr>
              <th>REF</th>
              <th>Mobile</th>
              <th>Incident Type</th>
              <th>Incident Date </th>
              <th>Location</th>
              <th>Status</th>
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
                       <td>{{ $num->status }}</td>
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
             order: [[3, 'desc']],
            paging: true,
            processing: false,
            serverSide: false,
            pageLength: `{{$datatable_entries}}`,
        lengthMenu: `{{config('app.paginate_range')}}`.split(','),  
            ordering: true,
            columnDefs: [{
                    targets: 5,
                    orderable: false
                } // Action column
            ],
            ajax: {
                url: "{{ route('escort.my-reports') }}",
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
                name: 'offender_mobile',
                    render: function(data, type, row) {

                        let clean = $('<div>').html(data).text();
                        let normalized = clean.replace(/\s+/g, '');
                        if (type === 'sort' || type === 'filter') {
                            return normalized;
                        }
                        return data;
                    }
                },
                {
                    data: 'incident_nature',
                    name: 'incident_nature'
                },
                {
                    data: 'incident_date',
                    render: function(data, type) {

                        if (type === 'display') {
                            let parts = data.split('-');
                            return parts[2] + '-' + parts[1] + '-' + parts[0];
                        }

                        return data; 
                    }
                },
                {
                    data: 'location',
                    name: 'location'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    class: 'text-center'
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
