@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
   .swal-button { background-color: #242a2c; }
   .timer_section, .customPaginationContainer {
       display: flex;
       justify-content: space-between;
       flex-wrap: wrap;
       gap: 10px;
       align-items: center;
   }
   #OperatorTable_paginate{
            display: flex;
            align-items: center;
            justify-content: space-between
        }
</style>
@stop

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
   <div id="content">
      <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
         <div class="row">
            <div class="custom-heading-wrapper col-md-12">
               <h1 class="h1">Manage Operator</h1>
               <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
            </div>

            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes">
                  <div class="card-body">
                     <p class="mb-0" style="font-size: 20px;"><b>Notes:</b></p>
                     <ol>
                        <li>Manage the Operator from here.</li>
                        <li>Update the Operator’s details and status from here.</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-12">
               <div class="panel with-nav-tabs panel-warning">
                  <div class="panel-body">
                     <div class="tab-content">  
                        <div class="tab-pane fade active show" id="tab3warning">
                           <div class="row pb-3">
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                 <div class="bothsearch-form" style="gap: 10px;">
                                    <button type="button" class="btn-common mr-0" data-toggle="modal" data-target="#addOperator">Add Operator</button>
                                 </div>
                              </div>
                           </div>

                           <div class="table-responsive-xl">
                              <table class="table mb-3" id="OperatorTable">
                                 <thead class="table-bg">
                                    <tr>
                                       <th>ID</th>
                                       <th>Operator</th>
                                       <th>Territory</th>
                                       <th>Contact</th>
                                       <th>Email</th>
                                       <th>Agents</th>
                                       <th>Last Login</th>
                                       <th>Status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody class="table-content">
                                 </tbody>
                              </table>

                              {{-- TIMER + PAGINATION --}}
                              <div class="timer_section mt-3">
                                 <p>Server time: <span class="serverTime">{{ getServertime() }}</span></p>
                                 <p>Refresh time: <span class="refreshSeconds">15</span></p>
                                 <p>Up time: <span class="uptimeClass">{{getAppUptime()}}</span></p>
                              </div>

                              <div class="customPaginationContainer mt-3 d-flex justify-content-between"></div>
                              <nav aria-label="Page navigation example" class="customPagination"></nav>
                           </div>
                        </div> 
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
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
$(document).ready(function () {
    var table = $('#OperatorTable').DataTable({
        paging: true,
        searching: true,
        processing: false,
        serverSide: false,
        ordering: true,
        info: true,
        responsive: true,
        language: {
            search: "Search:",
            searchPlaceholder: "Search by ID"
        },
      columns: [
               { data: 'id', name: 'id' },
               { data: 'operator', name: 'operator' },
               { data: 'territory', name: 'territory' },
               { data: 'contact', name: 'contact' },
               { data: 'email', name: 'email' },
               { data: 'agents', name: 'agents' },
               { data: 'last_login', name: 'last_login' },
               { data: 'status', name: 'status' },
               { data: 'action', name: 'action', orderable: false, class:'text-center' }
         ],
        drawCallback: function(settings) {
            const $info = $('#OperatorTable_info');
            const $paginate = $('#OperatorTable_paginate');
            const $timerSection = $('.timer_section');
            const $customContainer = $('.customPaginationContainer');
            if ($info.length && $paginate.length && $customContainer.length) {
                $customContainer.empty().append($info).append($paginate);
            }
            $customContainer.insertAfter($timerSection);
        }
    });

    // Auto-refresh timer
    let countdown = 15;
    setInterval(() => {
        countdown--;
        $(".refreshSeconds").text(' '+countdown);
        if (countdown <= 0) {
            table.ajax.reload(null, false);
            countdown = 15;
        }
    }, 1000);
});

</script>
@endpush
