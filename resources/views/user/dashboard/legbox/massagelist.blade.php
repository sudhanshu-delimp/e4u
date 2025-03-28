@extends('layouts.userDashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
   .swal-button {
   background-color: #242a2c;
   }
</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">
      <div class="container-fluid">
         <!--middle content-->
         @if(session('success'))
            <div class="alert alert-success">
               {{ session('success') }}
            </div> 
         @endif
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-9 ">
               <!-- Begin Page Content -->
               <div class="container-fluid" style="padding: 0px 0px;">
                  <!-- Page Heading -->
                  <div class="d-sm-flex align-items-center justify-content-between mb-4">
                     <h2 class="h4 mb-0 text-gray-800 font-weight-500">Massage Center Legbox</h2>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="table-responsive list-sec" id="sailorTableArea">
                           <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                              {{-- <div class="dataTables_length" id="myTable_length">
                                 <label>
                                    Show 
                                    <select name="myTable_length" aria-controls="myTable" class="">
                                       <option value="10">10</option>
                                       <option value="25">25</option>
                                       <option value="50">50</option>
                                       <option value="100">100</option>
                                    </select>
                                    entries
                                 </label>
                              </div> --}}
                              <div id="myTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="myTable"></label></div>
                              <div id="myTable_processing" class="dataTables_processing" style="display: none;">Processing...</div>
                              <table id="massagelistTable" class="table table-striped dataTable no-footer" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                 <thead>
                                    <tr role="row">
                                       <th class="sorting_asc" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
                                          : activate to sort column descending" style="width: 21px;">
                                          <div class="ckbox">
                                             <input type="checkbox" id="checkbox1">
                                          </div>
                                       </th>
                                       <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 154px;" aria-label="Name">
                                          Name
                                          
                                       </th>
                                       <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 112px;" aria-label="Date Created">Location</th>
                                       {{-- <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 149px;" aria-label="Subscription Type">Type </th>
                                       <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 161px;" aria-label="Subscription Status">Mobile</th>
                                       <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 79px;" aria-label="Status">Email</th> --}}
                                       <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 56px;" aria-label="Action">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    {{-- <tr role="row" class="odd">
                                       <td class="sorting_1">1</td>
                                       <td>Kathryn Murphy</td>
                                       <td>SA</td>
                                       <td>Female</td>
                                       <td>09818 22 2222</td>
                                       <td>test@gmail.com</td>
                                       <td>
                                          <div class="dropdown no-arrow archive-dropdown">
                                             <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                                             <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                                <a class="dropdown-item" href="#" data-id="27" data-name="test one" data-category="27">Edit <i class="fa fa-fw fa-pen" style="float: right;"></i></a>
                                                <a class="dropdown-item delete-center" href="#" data-id="27">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i> </a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr> --}}
                                 </tbody>
                              </table>
                              {{-- <div class="dataTables_info" id="myTable_info" role="status" aria-live="polite">Showing 1 to 8 of 8 entries</div>
                              <div class="dataTables_paginate paging_simple_numbers" id="myTable_paginate"><a class="paginate_button previous disabled" aria-controls="myTable" data-dt-idx="0" tabindex="0" id="myTable_previous">Previous</a><span><a class="paginate_button current" aria-controls="myTable" data-dt-idx="1" tabindex="0">1</a></span><a class="paginate_button next disabled" aria-controls="myTable" data-dt-idx="2" tabindex="0" id="myTable_next">Next</a></div> --}}
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /.container-fluid --><br>
            </div>
            <!--middle content end here-->
            <!--right side bar start from here-->
            <div class="col-sm-12 col-md-12 col-lg-3 ">
               <div class="sidebar-box-administrator">
                  <h2 class="h4 mb-0 text-gray-800">Favorites online</h2>
                  <table class="sidebar-table">
                     <tr>
                        <td class="leftside-table">In my location</td>
                        <td class="rightside-table">01</td>
                     </tr>
                     
                     <tr>
                        <td class="leftside-table">Outside my location</td>
                        <td class="rightside-table">01</td>
                     </tr>
                  </table>
               </div>
               <div class="sidebar-box-administrator">
                  <h2 class="h4 mb-0 text-gray-800">My Statistics</h2>
                  <table class="sidebar-table">
                     <tr>
                        <td class="leftside-table">My Recommendation</td>
                        <td class="rightside-table">01</td>
                     </tr>
                     <tr>
                        <td class="leftside-table">Report</td>
                        <td class="rightside-table">01</td>
                     </tr>
                     <tr>
                        <td class="leftside-table">Reviews</td>
                        <td class="rightside-table">01</td>
                     </tr>
                     
                  </table>
               </div>
            </div>
         </div>
         <!--right side bar end-->
      </div>
   </div>
   <!-- End of Main Content -->
   <!-- Footer -->
   <footer class="sticky-footer bg-white">
      <div class="container my-auto">
         <div class="copyright text-center my-auto">
            <span> </span>
         </div>
      </div>
   </footer>
   <!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

   <div class="modal" id="change_all" style="display: none">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content rounded-0">
            <div class="modal-body text-center">
                  <h3 class="mb-4 mt-5"><span id="Lname">Are you sure want to remove?</span> </h3>
                  <input type="hidden" id="escortId" value="">
                  <button type="button" class="btn btn-success" id="save_change">OK</button>
                  
                  <button type="button" class="btn btn-danger" data-dismiss="modal" id="close">Cancel</button>
            </div>
         </div>
      </div>
   </div>
   
</div>
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
   $('#massagelistTable').DataTable({
     
      "language": {
         "zeroRecords": "No record(s) found."
      },
      bLengthChange: false,
      processing: true,
      serverSide: true,
      //blengthChange: false,
      order: [0,'asc'],
      searchable:false,
      //searching:false,
      searching : false, 
      bStateSave: false,

      ajax: {
         url: "{{ route('user.legbox.massagedataTable') }}",
         data: function (d) {
            d.type = 'player';
         }
      },
      columns: [
         { data: 'key', name: 'key', searchable: true, orderable:true ,defaultContent: 'NA'},
         { data: 'name', name: 'name', searchable: false, orderable:false ,defaultContent: 'NA'},
         { data: 'city_name', name: 'city_name', searchable: false, orderable:false ,defaultContent: 'NA'},
         //  { data: 'type', name: 'gender', searchable: false, orderable:false ,defaultContent: 'NA'},
         //  { data: 'phone', name: 'phone', searchable: false, orderable:false,defaultContent: 'NA' },
         //  { data: 'email', name: 'email', searchable: false, orderable:false,defaultContent: 'NA' },
         { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA' },
      ],
      aoColumnDefs:[
                     
         // {
         //    "aTargets":[0],
         //       "render": function (data) { return  "<a href='#'>"+data+"  </a>"; 
         //    }
         // },
         // {
         //    "aTargets": [0],
         //    "visible": false,
         //    "searchable": false
         // }

      ]
   });

$('body').on('click','.delete-center',function(e){
   e.preventDefault();
   var id = $(this).data('id');
   
   var url = "{{ route('user.console.delete.legbox',':id') }}";
   url = url.replace(':id',id);
   console.log("hiii"+ id);
   $('#change_all').modal('show');
   var eid = $('#escortId').val(id);
      $('#save_change').click(function(){
         $.ajax({
               url: url,
               method: "GET",
               data: {
                  _token: '{{ csrf_token() }}', 
                  id: id
               },
               success: function (response) {
                  window.location.reload();
               }
         });
      })
   // if(confirm("Are you sure want to remove?")) {
   //    
   // }
})
</script>
@endpush