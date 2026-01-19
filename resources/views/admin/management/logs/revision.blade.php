@extends('layouts.admin')
@section('style')
@stop
@section('content')
<div id="content-wrapper" class="d-flex flex-column">
   <div id="content">
      <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
         <div class="row">
            <div class="custom-heading-wrapper col-md-12">
               <h1 class="h1">Revision</h1>
               <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b> </span>
            </div>
            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes">
                  <div class="card-body">
                     <h3 class="NotesHeader"><b>Notes:</b> </h3>
                     <ol>
                        <li>Any change to a page within the Website will show the Change Date.</li>
                        <li>This report is a consolidated report for all changes made to a page within the Website.</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>


          <div class="row">
            <div class="col-md-12">

                  <div class="row">
                     <div class="col-md-12 mt-2">
                        <div id="table-sec" class="table-responsive-xl">
                              <table class="table" id="AgentReportTable">
                                 <thead class="table-bg">
                                    <tr>
                                          <th>Ref</th>
                                          <th>Date Changed</th>
                                          <th>Time</th>
                                          <th>Staff ID</th>
                                          <th>Page Title</th>
                                          <th>Console</th>
                                          <th>URL</th>
                                          <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                          <td>1234</td>
                                          <td>25-09-2025</td>
                                          <td>10:25:24 am</td>
                                          <td>S60125</td>
                                          <td>My Playbox</td>
                                          <td>Public</td>
                                          <td>http://www.e4u.com.au/playbox</td>
                                          <td>
                                             <div class="dropdown no-arrow">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                      id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                      aria-expanded="false">
                                                      <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                      aria-labelledby="dropdownMenuLink">
                                                      <div class="custom-tooltip-container"><a
                                                            class="dropdown-item align-item-custom toggle-massage-notification"
                                                            href="#" title="Click to disable notification">
                                                         </a>
                                                          <a class="dropdown-item align-item-custom" href=""> <i
                                                                  class="fa fa-print" aria-hidden="true"></i>
                                                            Print</a>
                                                         <div class="dropdown-divider"></div>
                                                            
                                                         <a class="dropdown-item align-item-custom" href="#"
                                                            data-toggle="modal" data-target="#viewAgentreport"><i class="fa fa-route"></i>

                                                            Tracker</a>
                                                         <div class="dropdown-divider"></div>
                                                         <a class="dropdown-item align-item-custom" href="/" target="_blank"> <i
                                                                  class="fa fa-eye" aria-hidden="true"></i>
                                                            View Page</a>
                                                      </div>
                                                </div>

                                             </div>
                                          </td>
                                    </tr>
                                 </tbody>
                              </table>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </div>
   </div>
</div> 
@endsection
@push('script')
<!-- opr_accordian_table JS -->
<script src="{{ asset('assets/dashboard/vendor/jquery/jquery.min.js') }}"></script>


<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
    
    document.querySelectorAll('.accordion-toggle').forEach(toggle => {
        toggle.addEventListener('click', () => {
            const target = toggle.getAttribute('data-target').replace('#', '');
            const openGroup = document.querySelectorAll(`.detail-row[data-group="${target}"]`);
            const isOpen = openGroup[0]?.classList.contains('show');

            // Close all open groups
            document.querySelectorAll('.detail-row.show').forEach(r => {
                r.classList.remove('show');
            });

            // Open current group if not already open
            if (!isOpen) {
                openGroup.forEach(r => r.classList.add('show'));
            }

            // Rotate arrow
            document.querySelectorAll('.accordion-toggle i').forEach(i => i.classList.remove(
                'rotated'));
            if (!isOpen) toggle.querySelector('i').classList.add('rotated');
        });
    });
</script>

<script>
    var table = $("#AgentReportTable").DataTable({
        language: {
            search: "Search: _INPUT_",
            searchPlaceholder: "Search by Agent ID"
        },
        info: true,
        paging: true,
        lengthChange: true,
        searching: true,
        bStateSave: true,
        order: [
            [1, 'desc']
        ],
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        pageLength: 10,

           columns: [
               { data: 'Ref', name: 'Ref', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'date_changed', name: 'date_changed', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'time', name: 'time', searchable: true, orderable:false ,defaultContent: 'NA'},
               { data: 'staff_ID', name: 'staff_ID', searchable: true, orderable:true ,defaultContent: 'NA'},
               { data: 'page_title', name: 'page_title', searchable: true, orderable:true,defaultContent: 'NA' },
               { data: 'console', name: 'console', searchable: false, orderable:true,defaultContent: 'NA' },
               { data: 'url', name: 'url', searchable: true, orderable:true,defaultContent: 'NA' },
               { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA', class:'text-center' },
           ],
    });
</script>
@endpush

