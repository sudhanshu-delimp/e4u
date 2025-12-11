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
      <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
         <div class="row">
            <div class="custom-heading-wrapper col-md-12">
               <h1 class="h1">Console Report</h1>
               <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                  <div class="card-body">
                     <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                     <ol></ol>
                  </div>
                </div>
            </div>
         </div>
        {{-- end --}}
         <div class="row">
            <div class="col-md-12">
               <div  class="table-responsive-xl">
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
                     <tbody>

                     </tbody>
                  </table>
                 
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- End of Main Content -->
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
    language: {
       search: "Search: _INPUT_",
       searchPlaceholder: "Search by Member ID or Profile Name"
    },
      info: true,
      bLengthChange: true,
      processing: true,
      serverSide: true,
      //lengthChange: true,
      order: [0,'asc'],
      searchable:true,
      //searching:false,
      bStateSave: true,
   
      ajax: {
         url: "{{ route('admin.Analytics.consolesDataTable') }}",
         data: function (d) {
            d.type = 'player';
         }
      },
      columns: [
         { data: 'member_id', id: 'member_id', searchable: true, orderable:true,defaultContent: 'NA' },
         { data: 'name', name: 'name', searchable: true, orderable:true,defaultContent: 'NA' },
         { data: 'usertype', name: 'usertype', searchable: true, orderable:true ,defaultContent: 'NA'},
         { data: 'location', name: 'location', searchable: true, orderable:true, defaultContent: 'NA' },
         //{ data: 'sLevel', name: 'sLevel', searchable: true, orderable:false, defaultContent: 'NA' },
         //{ data: 'status', name: 'status', searchable: true, orderable:false, defaultContent: 'NA' },
         { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA', className: 'text-center', },
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