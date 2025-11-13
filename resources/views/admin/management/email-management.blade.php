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
                        <button type="button" class="btn-common mr-0" data-toggle="modal" data-target="#createNotification">Add New Record</button>
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
                                 <th class="text-center">Action</th>
                              </tr>
                           </thead>
                           <tbody class="table-content">
                              <tr class="row-color">
                                 <td>ax.email</td>
                                 <td><a href="maleto:julie@e4u.com.au">julie@e4u.com.au</a></td>
                                 <td><a href="maleto:julie.1996@gmail.com">julie.1996@gmail.com</a></td>
                                 <td>11-06-2025 </td>
                                 <td>E60125</td>
                                 <td>12 months</td>
                                 <td>Active</td>
                                 <td>
                                    <div class="dropdown no-arrow text-center" >
                                       <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                       </a>
                                       <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                           <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#">   <i class="fa fa-fw fa-check"></i> Activate</a>
                                           <div class="dropdown-divider"></div>
                                           <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0);" data-toggle="modal" data-target="#editEmailModal" > <i class="fa fa-fw fa-pen"></i> Edit</a>
                                           <div class="dropdown-divider"></div>
                                           
                                           <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0);" data-target="#renewEmailModal" data-toggle="modal" >  <i class="fa fa-sync-alt"></i> Renew</a>
                                           <div class="dropdown-divider"></div>
                                           <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" >  <i class="fa fa-fw fa-ban" ></i> Suspend</a>
                                           <div class="dropdown-divider"></div>
                                           <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" >   <i class="fa fa-fw fa-times" ></i> Deactivate</a>
                                           
                                           
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
   var table = $("#profileStatisticTable").DataTable({
    language: {
        search: "Search: _INPUT_",
        searchPlaceholder: "Search by Name..."
    },
    info: true,
    paging: true,
    lengthChange: true,
    searching: true,
    bStateSave: true,
    order: [[1, 'desc']],
    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
    pageLength: 10
});

 </script>
  
@endpush