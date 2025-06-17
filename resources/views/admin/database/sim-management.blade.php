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
         <div class="container-fluid pl-3 pl-lg-5">
            <div class="row">
               <div class="col-md-12">
                  <div class="v-main-heading h3" style="display: inline-block; padding-top: 0;"><h1>Manage SIMs</h1></div>
                     <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
                  </div>
               </div>
               <div class="row collapse" id="notes">
                  <div class="col-md-12 mb-5">
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
               
               <div class="col-md-12 pl-0">
                <div class="row my-3">
                    <div class="col-lg-4 col-md-12 col-sm-12"></div>
                    <div class="col-lg-8 col-md-12 col-sm-12 d-flex justify-content-end" style="gap: 50px;">
                      
                        <div class="total_listing">
                            <div><span>Available SIMs : </span></div>
                            <div><span>5</span></div>
                        </div><div class="total_listing">
                            <div><span>Active SIMs : </span></div>
                            <div><span>2</span></div>
                        </div>
                    </div>
                </div>
                  <div class="row pb-3">
                     <div class="col-lg-4 col-md-6 col-sm-6">
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
                     <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="bothsearch-form" style="gap: 10px;">
                            <button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#createNotification" style="color:var(--peach)">Add New Record</button>
                            
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-12 pl-0">
                  <div class="panel with-nav-tabs panel-warning">
                     <div class="panel-body">
                        <div class="tab-content">
                           <div class="tab-pane fade in active show" id="tab1warning">
                              <div class="table-responsive-xl">
                                 <table class="table">
                                    <thead class="table-bg">
                                       <tr>
                                          <th scope="col">Carrier
                                          </th>
                                          <th scope="col">USIM</th>
                                          <th scope="col">
                                            Number
                                          </th>
                                          <th scope="col">Activation
                                            Date</th>
                                          <th scope="col">Member ID</th>
                                          <th scope="col">Term</th>
                                          <th scope="col">Status</th>
                                          <th scope="col">Action</th>
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
                                             <div class="dropdown no-arrow">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex align-items-center justify-content-between" href="#">Activate   <i class="fa fa-fw fa-check"></i></a>
                                                   <div class="dropdown-divider"></div>
                                                   <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0);" data-toggle="modal" data-target="#editSIMModal" >Edit <i class="fa fa-fw fa-pen"></i></a>
                                                   <div class="dropdown-divider"></div>
                                                   
                                                   <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0);" data-target="#renewSIMModal" data-toggle="modal" >Renew  <i class="fa fa-sync-alt"></i></a>
                                                   <div class="dropdown-divider"></div>
                                                   <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" >Suspend  <i class="fa fa-fw fa-ban" ></i></a>
                                                   <div class="dropdown-divider"></div>
                                                   <a class="dropdown-item d-flex align-items-center justify-content-between" href="#" >Deactivate   <i class="fa fa-fw fa-times" ></i></a>
                                                   
                                                   
                                                </div>
                                             </div>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
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
                              </div>
                           </div>
                        </div>
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
            <h5 class="modal-title" id="createNotification">  <img src="{{ asset('assets/dashboard/img/add-sim.png') }}" style="width:25px"> Add New Record</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <form>
         <div class="modal-body pb-0">
           
                <div class="row">
                  
                  <!-- Server Field -->
                  <div class="col-12 mb-3">
                    <input type="text" class="form-control rounded-0 fw-bold" placeholder="Carrier" name="carrier" required>
                  </div>
              
                  <!-- Email Account Field -->
                  <div class="col-12 mb-3">
                    <input type="email" class="form-control rounded-0" placeholder="USIM" name="usim" required>
                  </div>
              
                </div>
              

         </div>
         <div class="modal-footer pr-3">
            <button type="button" class="btn btn-primary">Save</button>
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
                <img src="{{ asset('assets/dashboard/img/data-listing.png') }}" style="width:25px"> New Record Added
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
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
             <button type="submit" class="btn btn-primary">Yes, Save</button>
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
                <img src="{{ asset('assets/dashboard/img/add-sim.png') }}" style="width:25px">
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
                      <input type="text" class="form-control rounded-0 fw-bold" placeholder="USIM" name="usim" required>
                   </div>
                   <!-- Mobile Number Field -->
                   <div class="col-12 mb-3">
                      <input type="text" class="form-control rounded-0" placeholder="Mobile Number" name="mobile_number" required>
                   </div>
                </div>
             </div>
             <div class="modal-footer pr-3">
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
                <img src="{{ asset('assets/dashboard/img/add-sim.png') }}" style="width:25px">
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
                      <input type="number" class="form-control rounded-0 fw-bold" placeholder="Term (e.g. 12 months)" name="term" required>
                   </div>
                   <!-- Activation Date -->
                   <div class="col-12 mb-3">
                      <input type="date" class="form-control rounded-0" placeholder="Activation Date" name="activation_date" required>
                   </div>
                </div>
             </div>
             <div class="modal-footer pr-3">
                <button type="submit" class="btn btn-primary">Renew</button>
             </div>
          </form>
       </div>
    </div>
 </div>
 

<!-- Scroll to Top Button-->
 <a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
<script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script>
<script>
   CKEDITOR.replace('editor1', {
      fullPage: true,
      extraPlugins: 'docprops',
      // Disable content filtering because if you use full page mode, you probably
      // want to  freely enter any HTML content in source mode without any limitations.
      allowedContent: true,
      height: 320
   });
</script>
@endsection