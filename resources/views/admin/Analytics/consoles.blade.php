@extends('layouts.admin')
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
         {{-- Page Heading   --}}
         <div class="row">
            <div class="d-flex align-items-center justify-content-start mt-5 flex-wrap col-lg-12">
                <h1 class="h1">Console Report</h1>
                <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
            </div>
            <div class="col-md-12 my-2">
                <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                    <ol></ol>
                </div>
                </div>
            </div>
        </div>
        {{-- end --}}
         <div class="row mt-5">
            <div class="col-sm-12 col-md-12 col-lg-12 ">
               <!-- Begin Page Content -->
               <div class="container-fluid" style="padding: 0px 0px;">
                
                  {{-- 
                  <div class="row">
                     <div class="col-lg-4 col-md-12 col-sm-12">
                        <form class="search-form-bg navbar-search">
                           <div class="input-group">
                              <input type="text" class="search-form-bg-i form-control border-0 small" placeholder="Search " aria-label="Search" aria-describedby="basic-addon2">
                              <div class="input-group-append">
                                 <button class="btn-right-icon" type="button">
                                 <i class="fas fa-search fa-sm"></i>
                                 </button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  --}}
               </div>
               <!-- /.container-fluid --><br>
               <div class="row">
                  <div class="col-md-8">
                     <div id="table-sec" class="table-responsive-xl pt-1">
                        <table class="table" id="consoleDatatable">
                           <thead class="table-bg">
                              <tr>
                                 <th scope="col">Member ID</th>
                                 <th scope="col">Name</th>
                                 <th scope="col">Type</th>
                                 <th scope="col">Location</th>
                                 <th scope="col">Action</th>
                              </tr>
                           </thead>
                           {{-- 
                           <tbody class="table-content">
                              <tr class="row-color">
                                 <td class="theme-color">S60001</td>
                                 <td class="theme-color">Wayne Primrose</td>
                                 <td class="theme-color">S</td>
                                 <td class="theme-color">Western Australia</td>
                                 <td class="theme-color"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></td>
                              </tr>
                              <tr class="row-color">
                                 <td class="theme-color">S60001</td>
                                 <td class="theme-color">Wayne Primrose</td>
                                 <td class="theme-color">S</td>
                                 <td class="theme-color">Western Australia</td>
                                 <td class="theme-color"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></td>
                              </tr>
                              <tr class="row-color">
                                 <td class="theme-color">S60001</td>
                                 <td class="theme-color">Wayne Primrose</td>
                                 <td class="theme-color">S</td>
                                 <td class="theme-color">Western Australia</td>
                                 <td class="theme-color"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></td>
                              </tr>
                           </tbody>
                           --}}
                        </table>
                        {{-- 
                        <nav aria-label="Page navigation example">
                           <ul class="pagination float-right pt-4">
                              <li class="page-item">
                                 <a class="page-link" href="#" aria-label="Previous">
                                 <span aria-hidden="true">«</span>
                                 <span class="sr-only">Previous</span>
                                 </a>
                              </li>
                              <li class="page-item"><a class="page-link" href="#">1</a></li>
                              <li class="page-item"><a class="page-link" href="#">2</a></li>
                              <li class="page-item"><a class="page-link" href="#">3</a></li>
                              <li class="page-item">
                                 <a class="page-link" href="#" aria-label="Next">
                                 <span aria-hidden="true">»</span>
                                 <span class="sr-only">Next</span>
                                 </a>
                              </li>
                           </ul>
                        </nav>
                        --}}
                     </div>
                  </div>
               </div>
            </div>
            <!--middle content end here-->
            <!--right side bar start from here-->
         </div>
         <!--right side bar end-->
      </div>
   </div>
   <!-- End of Main Content -->
   <!-- Footer -->
   <!-- End of Footer -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
@endsection
@push('script')
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
   $("#consoleDatatable").DataTable({
       "language": {
         search: "_INPUT_",
        searchPlaceholder: "Search",
        "sSearch": '<a class="btn searchBtn" id="searchBtn"><i class="fa fa-search"></i></a>',
   
        oPaginate: {
       sNext: '<span aria-hidden="true">»</span>',
       sPrevious: '<span aria-hidden="true">«</span>',
       sFirst: '<span aria-hidden="true">»</span>',
       sLast: '<span aria-hidden="true">»</span>'
    }

       },
       
      info: false,
      bLengthChange: false,
      processing: true,
      serverSide: true,
      //lengthChange: true,
      order: [0,'asc'],
      searchable:false,
      //searching:false,
      bStateSave: false,
   
      ajax: {
         url: "{{ route('admin.Analytics.consolesDataTable') }}",
         data: function (d) {
            d.type = 'player';
         }
      },
      columns: [
         { data: 'member_id', id: 'member_id', searchable: true, orderable:true,defaultContent: 'NA' },
         { data: 'name', name: 'name', searchable: true, orderable:false,defaultContent: 'NA' },
         { data: 'usertype', name: 'usertype', searchable: true, orderable:false ,defaultContent: 'NA'},
         { data: 'location', name: 'location', searchable: true, orderable:false, defaultContent: 'NA' },
         //{ data: 'sLevel', name: 'sLevel', searchable: true, orderable:false, defaultContent: 'NA' },
         //{ data: 'status', name: 'status', searchable: true, orderable:false, defaultContent: 'NA' },
         { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA' },
      ],
      aoColumnDefs:[
                     
         {
            "aTargets":[0],
               "render": function (data) { return  "<a href='#'>"+data+"  </a>"; 
            }
         },
         // {
         //    "aTargets": [0],
         //    "visible": false,
         //    "searchable": false
         // }
   
      ]
   });
   
   $('body').on('shown.bs.modal', '#save-service', function (e) {
       var button = e.relatedTarget;
       $('#service-cat').val($(button).data('category'));
       $('#service-name').val($(button).data('name'));
       $('#service-id').val($(button).data('id'));
   });
   
   $('body').on('hide.bs.modal', '#save-service', function (e) {
       $('#service-cat').val("");
       $('#service-name').val("");
       $('#service-id').val("");
       console.log('djsffffkd');
   });
   
   $('#save-service-form').on('submit', function(e) {
       e.preventDefault();
   
       var form = $(this);
   
       var url = form.attr('action');
       var data = new FormData(form[0]);
   
       $.ajax({
           method: form.attr('method'),
           url:url + '/' + $('#service-id').val(),
           data:data,
           contentType: false,
           processData: false,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           success: function (data) {
               if(data.status){
   
                   form[0].reset();
                   $('#save-service').modal('hide');
   
                   swal({
                       title: "",
                       text: data.message,
                       icon: "success",
   
                       closeModal: true,
                       buttons: {
                           cancel: false,
                           ok:true
                       },
                   })
                   .then((value) => {
                       $("#service-table").DataTable().ajax.reload();
                   });
   
               } else {
                   swal({
                       title: "Oops!",
                       text: "Error! Unable to save service",
                       icon: "error",
                       closeModal: true,
                       buttons: {
                           cancel: false,
                           ok:true
                       },
                   });
               }
           },
           error :function( data ) {
               var response = $.parseJSON(data.responseText);
               swal({
                       title: "Oops!",
                       text: response.errors.toString(),
                       icon: "error",
                       closeModal: true,
                       buttons: {
                           cancel: false,
                           ok:true
                       },
                   });
           }
       });
   });
   
   $('body').on('click', '.delete-service', function(e) {
    var button = $(this);
    var id = button.data('id');
    console.log(button);
    swal('Do you really want to remove delete this service',{
           dangerMode: true,
           buttons: ["Cancel", "Delete"],
       }).then((result) => {
           if (result) {
   
               var data = new FormData();
               data.append('job_id', button.data('job_id'));
               data.append('skill_id', button.data('id'));
   
               $.ajax({
                   type:'DELETE',
                   url: "{{route('admin.service.delete')}}" + '/' + id,
                   data:data,
                   cache:false,
                   contentType: false,
                   processData: false,
                   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                   success:function(data) {
   
                       if(!data.error){
   
                           swal({
                               title: "",
                               text: data.message,
                               icon: "success",
   
                               closeModal: true,
                               buttons: {
                                   cancel: false,
                                   ok:true
                               },
                           })
                           .then((value) => {
                            $("#service-table").DataTable().ajax.reload();
                           });
   
                       } else {
                           swal({
                               title: "Oops!",
                               text: data.message,
                               icon: "error",
                               closeModal: true,
                               buttons: {
                                   cancel: false,
                                   ok:true
                               },
                           });
                       }
                   },
                   error: function(data) {
                       $("#service-table").DataTable().ajax.reload();
                   }
               });
   
           } else {
               console.log('laksjkjskj');
           }
       });
   });
   
</script>
@endpush