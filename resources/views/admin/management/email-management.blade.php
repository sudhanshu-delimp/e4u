@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
   .swal-button {
   background-color: #242a2c;
   }
   #cke_1_contents {
   height: 150px !important;
   }
</style>
@stop
@section('content')
<div id="wrapper">
   <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
         
         <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
            <div class="row">
               <div class="custom-heading-wrapper col-md-12">
                  <h1 class="h1">Email Management</h1>
                     <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
               </div>
               <div class="col-md-12 mb-5 collapse" id="notes">
                  <div class="card">
                        <div class="card-body">
                           <h3 class="NotesHeader"><b>Notes:</b> </h3>
                           <ol class="level-1">
                              <li>Add new Email accounts to the database.</li>
                              <li>Suspend or renew the term of an Advertiser's Email account.</li>
                              <li>When actioning an Email, attend to the following:
                                 <ol class="level-2">
                                 <li>For a New service:
                                    <ol class="level-3">
                                       <li>determine the Email account according to the protocol and enter into the
                                          record.</li>
                                       <li>complete the transaction by debiting the Advertiser's Card.</li>
                                    </ol>
                                 </li>
                                 <li class="highlight">When Suspending or Renewing a service update the online portal, if required,
                                    to activate the Email account (MX file).</li>
                                 </ol>
                              </li>
                           </ol>  
                        </div>
                  </div>
               </div>
            </div>
                <div class="row my-3">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <div class="total_listing">
                            <div><span>Active Email Accounts : </span></div>
                            <div><span>2</span></div>
                        </div>
                     </div>

                     <div class="col-sm-12 d-flex justify-content-end mt-3">
                        <button type="button" class="btn-common mr-0" data-toggle="modal" data-target="#createNewrecord">Add New Record</button>
                     </div>
                </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="table-responsive-xl">
                        <table class="table" id="EmailManageTable">
                           <thead class="table-bg">
                              <tr>
                                 <th>Server
                                 </th>
                                 <th>Email Account</th>
                                 <th>
                                   Notification Address
                                 </th>
                                 <th>Activation
                                   Date</th>
                                 <th>Member ID</th>
                                 <th>Term</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody class="table-content">
                              <tr>
                                 <td>ax.email</td>
                                 <td><a href="maleto:julie@e4u.com.au">julie@e4u.com.au</a></td>
                                 <td><a href="maleto:julie.1996@gmail.com">julie.1996@gmail.com</a></td>
                                 <td>11-06-2025 </td>
                                 <td>E60125</td>
                                 <td>12 months</td>
                                 <td>Active</td>
                                 <td>
                                    <div class="dropdown no-arrow" >
                                       <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                       </a>
                                       <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                           <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"href="javascript:void(0);" data-toggle="modal" data-target="#confirmModal">   <i class="fa fa-fw fa-check"></i> Activate</a>
                                           <div class="dropdown-divider"></div>
                                           <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0);" data-toggle="modal" data-target="#editNewrecord" > <i class="fa fa-fw fa-pen"></i> Edit</a>
                                           <div class="dropdown-divider"></div>
                                           
                                           
                                           <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0);" data-target="#renewEmailmodal" data-toggle="modal" >  <i class="fa fa-sync-alt"></i> Renew</a>
                                           <div class="dropdown-divider"></div>
                                           <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"href="javascript:void(0);" data-toggle="modal" data-target="#confirmModal" >  <i class="fa fa-fw fa-ban" ></i> Suspend</a>
                                           <div class="dropdown-divider"></div>
                                           <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"href="javascript:void(0);" data-toggle="modal" data-target="#confirmModal" >   <i class="fa fa-fw fa-times" ></i> Deactivate</a>
                                           
                                           
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
        
         <!--right side bar end-->
      </div>
   </div>
   <!-- End of Main Content -->
</div>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>


<!-- End of Content Wrapper -->
{{-- add new record --}}
<div class="modal fade upload-modal" id="createNewrecord" tabindex="-1" role="dialog" aria-labelledby="createNewrecord" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="createNewrecord">  <img src="{{ asset('assets/dashboard/img/mailing.png') }}" class="custompopicon"> Add New Record</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <form>
         <div class="modal-body pb-0">
           
                <div class="row">
                  
                  <!-- Server Field -->
                  <div class="col-12 mb-3">
                     <label for="server email account" class="label">Email Account</label>
                    <input type="email" class="form-control rounded-0 fw-bold" placeholder="Email Account " name="server" required>
                  </div>
              
                  <!-- Email Account Field -->
                  <div class="col-12 mb-3">
                     <label for="address" class="label">Notification Address</label>
                    <input type="text" class="form-control rounded-0" placeholder="Notification Address" name="address" required>
                  </div>
              
                </div>
              

         </div>
         <div class="modal-footer pr-3">
            <button type="button" class="btn-success-modal">Save</button>
         </div>
         
        </form>
      </div>
   </div>
</div>
{{-- end --}}
<!-- Renew renewEmailmodal  Service Modal -->
<div class="modal fade upload-modal" id="renewEmailmodal" tabindex="-1" role="dialog" aria-labelledby="renewEmailmodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content basic-modal">
          <div class="modal-header">
             <h5 class="modal-title" id="renewEmailmodal">
                <img src="{{ asset('assets/dashboard/img/mailing.png') }}" class="custompopicon">
                Renew Email Service
             </h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                   <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                </span>
             </button>
          </div>
          <form>
             <div class="modal-body pb-0">
                <div class="row">
                   <!-- Term Field -->
                   <div class="col-12 mb-3">
                     <label for="term" class="label">Term</label>
                      <input type="number" class="form-control rounded-0 fw-bold" placeholder="Term (e.g. 12 months)" name="term" required>
                   </div>
                   <!-- Activation Date -->
                   <div class="col-12 mb-3">
                     <label for="date" class="label">Activation Date</label>
                      <input type="date" class="form-control rounded-0" placeholder="Activation Date" name="activation_date" required>
                   </div>
                </div>
             </div>
             <div class="modal-footer pr-3">
                <button type="submit" class="btn-success-modal">Renew</button>
             </div>
          </form>
       </div>
    </div>
 </div>
 

<!-- Scroll to Top Button-->

{{-- edit new record --}}
<div class="modal fade upload-modal" id="editNewrecord" tabindex="-1" role="dialog" aria-labelledby="editNewrecord" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="editNewrecord">  <img src="{{ asset('assets/dashboard/img/mailing.png') }}" class="custompopicon"> Edit Email Record</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <form>
         <div class="modal-body pb-0">
           
                <div class="row">
                  
                  <!-- Server Field -->
                  <div class="col-12 mb-3">
                     <label for="server" class="label">Server Email Account</label>
                    <input type="email" class="form-control rounded-0 fw-bold" placeholder="Server email account " name="server" required>
                  </div>
              
                  <!-- Email Account Field -->
                  <div class="col-12 mb-3">
                     <label for="address" class="label">Notification Address</label>
                    <input type="text" class="form-control rounded-0" placeholder="Notification Address" name="address" required>
                  </div>
              
                </div>
              

         </div>
         <div class="modal-footer pr-3">
            <button type="button" class="btn-success-modal">Update</button>
         </div>
         
        </form>
      </div>
   </div>
</div>
{{-- end --}}

<!-- Confirmation Modal -->
<div class="modal fade upload-modal" id="confirmSaveModal" tabindex="-1" role="dialog" aria-labelledby="confirmSaveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content basic-modal">
          <div class="modal-header">
             <h5 class="modal-title" id="confirmSaveModalLabel">
                <img src="{{ asset('assets/dashboard/img/unblock.png') }}" class="custompopicon"> New Record Added
             </h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                   <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                </span>
             </button>
          </div>
          <div class="modal-body text-center">
             <h5 class="popu_heading_style mt-4 mb-0 font">Are you sure you want to save this record?</h5>
          </div>
          <div class="modal-footer justify-content-center">
             <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
             <button type="submit" class="btn-success-modal">Yes, Save</button>
          </div>
       </div>
    </div>
 </div>
 <!-- Confirmation Modal -->


 <div class="modal fade upload-modal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content basic-modal">
          <div class="modal-header">
             <h5 class="modal-title" id="confirmModalLabel">
                <img src="{{ asset('assets/dashboard/img/unblock.png') }}" class="custompopicon"> Common Confirmation modal
             </h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                   <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                </span>
             </button>
          </div>
         <div class="modal-body text-center">
             <h5 class="popu_heading_style mt-4 mb-0 font">Are you sure you want to save this record?</h5>
          </div>
          <div class="modal-footer justify-content-center">
             <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
             <button type="submit" class="btn-success-modal">Yes, Save</button>
          </div>
       </div>
    </div>
 </div>
<!-- End of Page Wrapper -->

@endsection

@push('script')
  

<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
  $(document).ready(function() {
            let isHidden = false;

            $('#hideAlltr').on('click', function() {
                const $chevron = $(this).find('i');

                if (!isHidden) {
                    // Hide only visible rows, and mark them
                    $('#hideAlltr').nextAll('tr:visible').addClass('user-hidden').hide();
                    $chevron.removeClass('fa-chevron-down').addClass('fa-chevron-up');
                    isHidden = true;
                } else {
                    // Show only those rows that were hidden by this action
                    $('tr.user-hidden').removeClass('user-hidden').show();
                    $chevron.removeClass('fa-chevron-up').addClass('fa-chevron-down');
                    isHidden = false;
                }
            });
        });

        $(document).ready(function() {
            $('.collapse-row').hide(); // 🔒 Hide all groups initially

            $('[data-toggle="toggle-row"]').on('click', function() {
                const targetClass = $(this).data('target');
                const $icon = $(this).find('i.fa');
                const isVisible = $(targetClass).is(':visible');

                $('.collapse-row').not(targetClass).hide();
                $('[data-toggle="toggle-row"] i.fa').removeClass('fa-chevron-up').addClass('fa-chevron-down');

                if (!isVisible) {
                    $(targetClass).show();
                    $icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
                } else {
                    $(targetClass).hide();
                }
            });
        });
</script>

<script>
   var table = $("#EmailManageTable").DataTable({
    language: {
        search: "Search: _INPUT_",
        searchPlaceholder: "Search by Member ID"
    },
    info: true,
    paging: true,
    lengthChange: true,
    searching: true,
    bStateSave: true,
    order: [[1, 'desc']],
    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
    pageLength: 10,        
         columns: [
               { data: 'server', name: 'server' },
               { data: 'email_Account', name: 'email_Account' },
               { data: 'notification_address', name: 'notification_address' },
               { data: 'activation_date', name: 'activation_date' },
               { data: 'member_id', name: 'member_id' },
               { data: 'term', name: 'term' },
               { data: 'status', name: 'status' },
               { data: 'action', name: 'action', orderable: false, class:'text-center' }
         ]
});

 </script>
  
@endpush