@extends('layouts.admin')
@section('style')
<style>
   
</style>
@stop
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <div class="row">
      <div class="custom-heading-wrapper col-md-12">
         <h1 class="h1">Security & Access Levels</h1>
         <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes">
            <div class="card-body">
               <h3 class="NotesHeader"><b>Notes:</b></h3>
               <ol></ol>
            </div>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-lg-12">
         <div class="common-card">
            <div class="panel-heading pt-3">
               <ul class="nav nav-tabs tab-sec common_tabs">
                  <li class="active"><a href="#tab1warning" data-toggle="tab" class="active">Security Settings</a></li>
                  <li><a href="#tab2warning" data-toggle="tab" class="">Access Settings</a></li>
                  <li><a href="#tab4warning" data-toggle="tab" class="">Notes</a></li>
               </ul>
            </div>
            <div class="panel with-nav-tabs panel-warning">
               <div class="panel-body">
                  <div class="tab-content">
                     <div class="tab-pane fade in active show" id="tab1warning">
                        <div class="table-responsive-xl w-100 mt-4">
                           <table class="table" id="securityDatatable">
                              <thead class="table-bg">
                                 <th scope="col">Member ID</th>
                                 <th scope="col">Name</th>
                                 <th scope="col">Type</th>
                                 <th scope="col">Location</th>
                                 <th scope="col">Security Level</th>
                                 <th scope="col">Status</th>
                                 <th scope="col">Action</th>
                                 </tr>
                              </thead>
                           </table>
                        </div>
                     </div>
                     <div class="tab-pane fade mt-4" id="tab2warning">
                        <div class="table-responsive-xl w-100">
                           <table class="table" id="accessTable">
                              <thead class="table-bg">
                                 <th scope="col">Member ID</th>
                                 <th scope="col">Name</th>
                                 <th scope="col">Status</th>
                                 <th scope="col">Action</th>
                                 </tr>
                              </thead>
                              <tbody class="table-content">
                                 <tr>
                                    <td>Escorts</td>
                                    <td>12:57 pm 12-06-2022</td>
                                    <td class="welcome_text_color"><a href="#"><span class="theme-text-color"><b>View</b></span></a></td>
                                    <td class="text-center">
                                       <div class="dropdown no-arrow ml-3">
                                          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                          </a>
                                          <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                             <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Edit_Competitor"><i class="fa fa-fw fa-reply "></i> Reply </a>
                                             <div class="dropdown-divider"></div>
                                             <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#"> <i class="fa fa-fw fa-trash"></i> Delete </a>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>Massage Centre</td>
                                    <td>12:57 pm 12-06-2022</td>
                                    <td class="welcome_text_color"><a href="#"><span class="theme-text-color"><b>View</b></span></a></td>
                                    <td class="text-center">
                                       <div class="dropdown no-arrow ml-3">
                                          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                          </a>
                                          <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                             <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Edit_Competitor"><i class="fa fa-fw fa-reply "></i> Reply </a>
                                             <div class="dropdown-divider"></div>
                                             <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#"> <i class="fa fa-fw fa-trash"></i> Delete </a>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>Viewer</td>
                                    <td>12:57 pm 12-06-2022</td>
                                    <td class="welcome_text_color"><a href="#"><span class="theme-text-color"><b>View</b></span></a></td>
                                    <td class="text-center">
                                       <div class="dropdown no-arrow ml-3">
                                          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                          </a>
                                          <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                             <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Edit_Competitor"><i class="fa fa-fw fa-reply "></i> Reply </a>
                                             <div class="dropdown-divider"></div>
                                             <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#"> <i class="fa fa-fw fa-trash"></i> Delete </a>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>Agent</td>
                                    <td>12:57 pm 12-06-2022</td>
                                    <td class="welcome_text_color"><a href="#"><span class="theme-text-color"><b>View</b></span></a></td>
                                    <td class="text-center">
                                       <div class="dropdown no-arrow ml-3">
                                          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                          </a>
                                          <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                             <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Edit_Competitor"><i class="fa fa-fw fa-reply "></i> Reply </a>
                                             <div class="dropdown-divider"></div>
                                             <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#"> <i class="fa fa-fw fa-trash"></i> Delete </a>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>Operations - Staff</td>
                                    <td>12:57 pm 12-06-2022</td>
                                    <td class="welcome_text_color"><a href="#"><span class="theme-text-color"><b>View</b></span></a></td>
                                    <td class="text-center">
                                       <div class="dropdown no-arrow ml-3">
                                          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                          </a>
                                          <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                             <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Edit_Competitor"><i class="fa fa-fw fa-reply "></i> Reply </a>
                                             <div class="dropdown-divider"></div>
                                             <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#"> <i class="fa fa-fw fa-trash"></i> Delete </a>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>Operations - Management</td>
                                    <td>12:57 pm 12-06-2022</td>
                                    <td class="welcome_text_color"><a href="#"><span class="theme-text-color"><b>View</b></span></a></td>
                                    <td class="text-center">
                                       <div class="dropdown no-arrow ml-3">
                                          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                          </a>
                                          <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                             <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Edit_Competitor"><i class="fa fa-fw fa-reply "></i> Reply </a>
                                             <div class="dropdown-divider"></div>
                                             <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#"> <i class="fa fa-fw fa-trash"></i> Delete </a>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>

                        </div>
                     </div>
                     <div class="tab-pane fade mt-4" id="tab4warning">
                        <div class="common_notes">
                           <ol>
                              <li class="note_li"><b>1.</b> Security and access levels <span class="theme-text-color"><b>(Levels)</b></span> can only be determined by the Managing Director of Blackbox Tech <span class="theme-text-color"><b>(Managing Director).</b></span></li>
                              <li class="note_li"><b>2.</b> SMS 2FA authentification is applied when setting Levels.</li>
                              <li class="note_li"><b>3. Security levels are :</b>
                                 <ul class="note_ul">
                                    <li><b>Level 1</b> - Managing Director</li>
                                    <li><b>Level 2</b> - Staff of E4U</li>
                                    <li><b>Level 3</b> - Agents of E4U</li>
                                    <li><b>Level 4</b> - Advertisers</li>
                                 </ul>
                              </li>
                              
                              <li class="note_li"><b>4. User conventions :</b>
                                 <ul class="note_ul">
                                    <li><b class="mr-3">Escorts :</b> E61234</li>
                                    <li><b class="mr-3">Massage Centre :</b> M61234:001</li>
                                    <li><b class="mr-3">Agent :</b> V61234</li>
                                    <li><b class="mr-3">Viewer :</b>  A61234</li>
                                 </ul>
                                 <b>whereby :</b>
                                 <ul class="note_ul">
                                    <li><b>E</b> = Escorts</li>
                                    <li><b>M</b> = Massage Centre</li>
                                    <li><b>V</b> = Viewer</li>
                                    <li><b>A</b> = Agent</li>
                                    <li><b>S</b> = Staff</li>
                                    
                                 </ul>
                                 <hr/>
                                 <p><b class="cp-hint">Note : </b>The first number represents the Home State, that is, 6 is Western Australia, the second group of numbers is the Membership Number / staff number, and
                                    the last three numbers is the Masseur</p>
                              </li>
                              <li class="note_li"><b>5. Location conventions :</b>

                                 <ul class="note_ul">
                                    <li><b>1.</b> ACT</li>
                                    <li><b>2.</b> New South Wales</li>
                                    <li><b>3.</b> Victoria</li>
                                    <li><b>4.</b> Queensland</li>
                                    <li><b>5.</b> South Australia</li>
                                    <li><b>6.</b> Western Australia</li>
                                    <li><b>7.</b> Tasmania</li>
                                    <li><b>8.</b> Northern Territory</li>
                                 </ul>
                              </li>
                              
                              <li class="note_li"><b>6. Access Levels for Users :</b>
                                 <p>Access levels are set by the Managing Director. By default, the levels are :</p>
                                 <ul class="note_ul">
                                    <li><b class="pr-3">(a) Escorts : </b> Escort Console</li>
                                    <li><b class="pr-3">(b) Massage Centre : </b> Massage Console</li>
                                    <li><b class="pr-3">(c) Massage Centre : </b> Viewer Console</li>
                                    
                                       <li><b class="pr-3">(d) Agent : </b> Agent Console,<span class="px-3">Escort Console: </span> (My Account, Profiles &amp; Archives), <span class="px-3">Massage Centre Console:</span> (My Account, Profiles &amp; Archives, Masseurs Profiles)</li>
                                       <li><b class="pr-3">(e) Staff : </b> Operations Console - Security Level 2 Consoles</li>
                                 </ul> 
                              </li>
                              <li class="note_li"> <b>7. Status indicators :</b>
                                 <p>Status is an indicator of the User’s access status to the Consoles, namely :</p>
                                 <ul class="note_ul">
                                    <li><span class="enabled"></span> <b>E</b> = Enabled</li>
                                    <li><span class="dis-abled"></span> <b>D</b> = Disabled</li>
                                    <li><span class="suspended"></span> <b>S</b> = Suspended</li>
                                 </ul>
                              </li>
                              
                           </ol>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>   
      </div>
   </div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
   <i class="fas fa-angle-up"></i>
</a>
<!-- Modal -->
@endsection
{{-- @section('script') --}}
@push('script')
<script>
   $("#securityDatatable").DataTable({
      "language": {
         search: "_INPUT_",
         searchPlaceholder: "Search by Member ID",
      },
      info: true,
      bLengthChange: true,
      processing: true,
      serverSide: true,
      lengthChange: true,
      order: [0, 'asc'],
      searchable: false,
      searching: true,
      bStateSave: true,

      ajax: {
         url: "{{ route('admin.management.allUserDatatable') }}",
         data: function(d) {
            d.type = 'player';
         }
      },
      columns: [{
            data: 'member_id',
            id: 'memberId',
            searchable: true,
            orderable: false,
            defaultContent: 'NA'
         },
         {
            data: 'name',
            name: 'name',
            searchable: true,
            orderable: false,
            defaultContent: 'NA'
         },
         {
            data: 'usertype',
            name: 'usertype',
            searchable: true,
            orderable: false,
            defaultContent: 'NA'
         },
         {
            data: 'location',
            name: 'location',
            searchable: true,
            orderable: false,
            defaultContent: 'NA'
         },
         {
            data: 'sLevel',
            name: 'sLevel',
            searchable: true,
            orderable: false,
            defaultContent: 'NA'
         },
         {
            data: 'status2',
            name: 'status2',
            searchable: true,
            orderable: false,
            defaultContent: 'NA'
         },
         {
            data: 'action',
            name: 'action',
            searchable: false,
            orderable: false,
            defaultContent: 'NA',
            class: 'text-center'
         }
      ],
      aoColumnDefs: [

         {
            "aTargets": [0],
            "render": function(data) {
               return "<a href='#'>" + data + "  </a>";
            }
         }
      ]
   });

   $("#accessTable").DataTable({
      "language": {
         search: "_INPUT_",
         searchPlaceholder: "Search by Member ID",

      },

      info: true,
      bLengthChange: true,
      processing: true,
      serverSide: true,
      lengthChange: true,
      order: [0, 'asc'],
      searchable: true,
      searching: true,
      bStateSave: true,
      columns: [{
            data: 'memberId',
            id: 'memberId',
            searchable: true,
            orderable: false,
            defaultContent: 'NA'
         },
         {
            data: 'name',
            name: 'name',
            searchable: true,
            orderable: false,
            defaultContent: 'NA'
         },
         {
            data: 'status',
            name: 'status',
            searchable: true,
            orderable: false,
            defaultContent: 'NA'
         },
         {
            data: 'action',
            name: 'action',
            searchable: false,
            orderable: false,
            defaultContent: 'NA',
            class: 'text-center'
         }
      ],

   });

   $('body').on('shown.bs.modal', '#save-service', function(e) {
      var button = e.relatedTarget;
      $('#service-cat').val($(button).data('category'));
      $('#service-name').val($(button).data('name'));
      $('#service-id').val($(button).data('id'));
   });

   $('body').on('hide.bs.modal', '#save-service', function(e) {
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
         url: url + '/' + $('#service-id').val(),
         data: data,
         contentType: false,
         processData: false,
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(data) {
            if (data.status) {

               form[0].reset();
               $('#save-service').modal('hide');

               swal({
                     title: "",
                     text: data.message,
                     icon: "success",

                     closeModal: true,
                     buttons: {
                        cancel: false,
                        ok: true
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
                     ok: true
                  },
               });
            }
         },
         error: function(data) {
            var response = $.parseJSON(data.responseText);
            swal({
               title: "Oops!",
               text: response.errors.toString(),
               icon: "error",
               closeModal: true,
               buttons: {
                  cancel: false,
                  ok: true
               },
            });
         }
      });
   });

   $('body').on('click', '.delete-service', function(e) {
      var button = $(this);
      var id = button.data('id');
      console.log(button);
      swal('Do you really want to remove delete this service', {
         dangerMode: true,
         buttons: ["Cancel", "Delete"],
      }).then((result) => {
         if (result) {

            var data = new FormData();
            data.append('job_id', button.data('job_id'));
            data.append('skill_id', button.data('id'));

            $.ajax({
               type: 'DELETE',
               url: "{{route('admin.service.delete')}}" + '/' + id,
               data: data,
               cache: false,
               contentType: false,
               processData: false,
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function(data) {

                  if (!data.error) {

                     swal({
                           title: "",
                           text: data.message,
                           icon: "success",

                           closeModal: true,
                           buttons: {
                              cancel: false,
                              ok: true
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
                           ok: true
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