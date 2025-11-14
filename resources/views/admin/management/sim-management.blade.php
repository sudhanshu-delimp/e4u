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
                  <h1 class="h1">SIM Management</h1>
                     <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
               </div>
               <div class="col-md-12 mb-5 collapse" id="notes">
                  <div class="card">
                     <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol class="level-1">
                          <li>Add new SIMs to the database.</li>
                          <li>Suspend or renew the term of an Advertiser’s SIM.</li>
                          <li>When actioning a SIM, attend to the following:
                            <ol class="level-2">
                              <li>For a New service:
                                <ol class="level-3">
                                  <li>acquire the Mobile number from the service provider and update the
                                    record.</li>
                                  <li>complete the transaction by debiting the Advertiser’s Card.</li>
                                  <li>dispatch the SIM via Australia Post, and update the record with the
                                    tracking number (Operations Console - Admin).</li>
                                </ol>
                              </li>
                              <li class="highlight">When Suspending or Renewing a service update the online portal with the
                                 service provider (Telco).</li>
                              <li class="highlight">When replacing a SIM, follow (a) above.</li>
                            </ol>
                          </li>
                        </ol>
                     </div>
                  </div>
               </div>
            </div>
                <div class="row my-3">
                    <div class="col-sm-12 d-flex justify-content-end gap-20">
                     <div class="total_listing">
                        <div><span>Available SIMs : </span></div>
                        <div><span>5</span></div>
                    </div><div class="total_listing">
                        <div><span>Active SIMs : </span></div>
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
                                 <th>Carrier
                                 </th>
                                 <th>USIM</th>
                                 <th>
                                   Number
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
                                 <td class="theme-color">Optus</td>
                                 <td class="theme-color">57 23406 36429 2</td>
                                 <td class="theme-color">-</td>
                                 <td class="theme-color">-</td>
                                 <td class="theme-color">-</td>
                                 <td class="theme-color">-</td>
                                 <td class="theme-color">Available</td>
                                 <td class="theme-color">
                                    <div class="dropdown no-arrow text-center">
                                       <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                       </a>
                                       <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                          <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0);" data-toggle="modal" data-target="#confirmModal">  <i class="fa fa-fw fa-check"></i> Activate </a>
                                          <div class="dropdown-divider"></div>
                                          <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0);" data-toggle="modal" data-target="#editSIMModal" > <i class="fa fa-fw fa-pen"></i> Edit</a>
                                          <div class="dropdown-divider"></div>
                                          
                                          <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0);" data-target="#renewSIMModal" data-toggle="modal" >  <i class="fa fa-sync-alt"></i> Renew</a>
                                          <div class="dropdown-divider"></div>
                                          <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0);" data-toggle="modal" data-target="#confirmModal" >  <i class="fa fa-fw fa-ban" ></i> Suspend</a>
                                          <div class="dropdown-divider"></div>
                                          <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="javascript:void(0);" data-toggle="modal" data-target="#confirmModal" >   <i class="fa fa-fw fa-times" ></i> Deactivate</a>
                                          
                                          
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
<!-- End of Content Wrapper -->
<div class="modal fade upload-modal" id="createNotification" tabindex="-1" role="dialog" aria-labelledby="createNotification" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="createNotification">  <img src="{{ asset('assets/dashboard/img/add-sim.png') }}" class="custompopicon"> Add New Record</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <form>
         <div class="modal-body pb-0">
           
                <div class="row">
                  
                  <!-- Server Field -->
                  <div class="col-12 mb-3">
                     <label for="Carrier" class="label">Carrier</label>
                    <input type="text" class="form-control rounded-0 fw-bold" placeholder="Carrier" name="carrier" required>
                  </div>
              
                  <!-- Email Account Field -->
                  <div class="col-12 mb-3">
                     <label for="USIM" class="label">USIM</label>
                    <input type="email" class="form-control rounded-0" placeholder="USIM" name="usim" required>
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


<!-- Confirmation Modal -->
<div class="modal fade upload-modal" id="confirmSaveModal" tabindex="-1" role="dialog" aria-labelledby="confirmSaveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content basic-modal">
          <div class="modal-header">
             <h5 class="modal-title" id="confirmSaveModalLabel">
                <img src="{{ asset('assets/dashboard/img/add-sim.png') }}" class="custompopicon"> New Record Added
             </h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                   <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                </span>
             </button>
          </div>
          <div class="modal-body">
             <p class="mb-0">Are you sure you want to save this record?</p>
          </div>
          <div class="modal-footer pr-3">
             <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
             <button type="submit" class="btn-success-modal">Yes, Save</button>
          </div>
       </div>
    </div>
 </div>
 <!-- Confirmation Modal -->

<!-- Confirmation Modal -->
<div class="modal fade upload-modal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmSaveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content basic-modal">
          <div class="modal-header">
             <h5 class="modal-title" id="confirmSaveModalLabel">
                <img src="{{ asset('assets/dashboard/img/unblock.png') }}" class="custompopicon"> Common Confirmation Modal
             </h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                   <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                </span>
             </button>
          </div>
          <div class="modal-body">
             <p class="mb-0">Are you sure you want to save this record?</p>
          </div>
          <div class="modal-footer pr-3">
             <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
             <button type="submit" class="btn-success-modal">Yes, Save</button>
          </div>
       </div>
    </div>
 </div>
 
<!-- End of Page Wrapper -->

<!-- Edit SIM Record Modal -->
<div class="modal fade upload-modal" id="editSIMModal" tabindex="-1" role="dialog" aria-labelledby="editSIMModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content basic-modal">
          <div class="modal-header">
             <h5 class="modal-title" id="editSIMModalLabel">
                <img src="{{ asset('assets/dashboard/img/add-sim.png') }}" class="custompopicon">
                Edit SIM Record
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
                   <!-- USIM Field -->
                   <div class="col-12 mb-3">
                     <label for="USIM" class="label">USIM</label>
                      <input type="text" class="form-control rounded-0 fw-bold" placeholder="USIM" name="usim" required>
                   </div>
                   <!-- Mobile Number Field -->
                   <div class="col-12 mb-3">
                     <label for="Mobile Number" class="label">Mobile Number</label>
                      <input type="text" class="form-control rounded-0" placeholder="Mobile Number" name="mobile_number" required>
                   </div>
                </div>
             </div>
             <div class="modal-footer pr-3">
                <button type="submit" class="btn-success-modal">Save Changes</button>
             </div>
          </form>
       </div>
    </div>
 </div>
 

<!-- Renew SIM Service Modal -->
<div class="modal fade upload-modal" id="renewSIMModal" tabindex="-1" role="dialog" aria-labelledby="renewSIMModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content basic-modal">
          <div class="modal-header">
             <h5 class="modal-title" id="renewSIMModalLabel">
                <img src="{{ asset('assets/dashboard/img/add-sim.png') }}" class="custompopicon">
                Renew SIM Service
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
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
@endsection

@push('script')
  

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
      var table = $("#EmailManageTable").DataTable({
      language: {
         search: "Search: _INPUT_",
         searchPlaceholder: "Search by Member ID..."
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