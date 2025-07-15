@extends('layouts.agent')
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!-- Page Heading -->
   <div class="row">
      <div class="custom-heading-wrapper col-md-12">
         <h1 class="h1">Dashboard</h1>
      </div>
   </div>
   <div class="row agent-dash">
      <div class="col-lg-8 pr-2">
         <div class="sec-one">
            <h2 class="h5 mt-2 mb-4 text-gray-800 font-weight-bold">My Statistics</h2>
            <div class="row">
               <div class="col-md-3">
                  <div class="card static-sec">
                     <div class="card-body">
                        <div class="text-xs font-weight-bold mb-1 text-muted">My Escorts</div>
                        <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="h2 mb-0 font-weight-bold text-gray-800">25</div>
                           </div>
                           <div class="col-auto">
                              <img src="{{ asset('assets/app/img/account-multiple.png')}}">
                           </div>
                        </div>
                     </div>
                     <!-- end card-body -->
                  </div>
               </div>
               <div class="col-md-3 pl-0">
                  <div class="card static-sec-2">
                     <div class="card-body">
                        <div class="text-xs font-weight-bold mb-1 text-muted">My Massage Centres</div>
                        <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="h2 mb-0 font-weight-bold text-gray-800">125</div>
                           </div>
                           <div class="col-auto">
                              <img src="{{ asset('assets/app/img/account-multiple-1.png')}}">
                           </div>
                        </div>
                     </div>
                     <!-- end card-body -->
                  </div>
               </div>
               <div class="col-md-3 pl-0">
                  <div class="card static-sec">
                     <div class="card-body">
                        <div class="text-xs font-weight-bold mb-1 text-muted">Escort Profiles Posted</div>
                        <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="h2 mb-0 font-weight-bold text-gray-800">32</div>
                           </div>
                           <div class="col-auto">
                              <img src="{{ asset('assets/app/img/account-multiple-2.png')}}">
                           </div>
                        </div>
                     </div>
                     <!-- end card-body -->
                  </div>
               </div>
               <div class="col-md-3 pl-0">
                  <div class="card static-sec-2">
                     <div class="card-body">
                        <div class="text-xs font-weight-bold mb-1 text-muted">Massage Profiles Posted</div>
                        <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="h2 mb-0 font-weight-bold text-gray-800">125</div>
                           </div>
                           <div class="col-auto">
                              <img src="{{ asset('assets/app/img/account-multiple-3.png')}}">
                           </div>
                        </div>
                     </div>
                     <!-- end card-body -->
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="sec-one pb-4">
            <h2 class="h5 mt-2 mb-4 text-gray-800 font-weight-bold">My Income</h2>
            <div class="row pb-1">
               <div class="col-md-6 pr-0">
                  <div class="card">
                     <div class="card-body pl-2 pr-2 pt-4 pb-4 mt-1">
                        <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="text-xs font-weight-bold mb-1 text-muted">Today’s Income</div>
                              <div class="h6 mb-0 font-weight-bold text-gray-800">$ 580.00</div>
                           </div>
                           <div class="col-6">
                              <img src="{{ asset('assets/app/img/account-multiple-4.png')}}" class="img-fluid">
                           </div>
                        </div>
                     </div>
                     <!-- end card-body -->
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card">
                     <div class="card-body pl-2 pr-2 pt-4 pb-4 mt-1">
                        <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="text-xs font-weight-bold mb-1 text-muted">Month to Date</div>
                              <div class="h6 mb-0 font-weight-bold text-gray-800">$ 3588.00</div>
                           </div>
                           <div class="col-6">
                              <img src="{{ asset('assets/app/img/account-multiple-4.png')}}" class="img-fluid">
                           </div>
                        </div>
                     </div>
                     <!-- end card-body -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row mt-3 mb-5">
      <!-- Area Chart -->
      <div class="col-xl-8 col-lg-7 pr-2">
         <div class="card shadow mb-3">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-0">
               <h2 class="h5 text-gray-800 font-weight-bold">Task List</h2>
            </div>
            <!-- Card Body -->
            <div class="card-body task-sec">
               <div class="d-flex align-items-center mb-2">
                  <input type="submit" value="New Task" class="btn btn-primary shadow-none create-tour-sec" name="submit" data-toggle="modal" data-target="#new-task">
                  <input type="submit" value="Edit Task" class="btn btn-primary shadow-none create-tour-sec" name="submit" data-toggle="modal" data-target="#edit-task">
                  <input type="submit" value="Complete Task" class="btn btn-primary shadow-none create-tour-sec" name="submit">
                  <div class="text-center small d-flex justify-content-end w-100 task-sec">
                     <span class="mr-2">Importance:</span>
                     <span class="mr-2">High</span><i class="fas fa-circle text-high mr-2"></i>
                     <span class="mr-2">Medium</span>
                     <i class="fas fa-circle text-medium mr-2"></i>
                     <span class="mr-2">Low</span>
                     <i class="fas fa-circle text-low"></i>
                  </div>
               </div>
               <div class="d-flex align-items-center mt-4 justify-content-between">
                  <label class="font-weight-bold mb-0">Task</label>
                  <div class="text-center mr-5">
                     <label class="font-weight-bold mb-0">Status</label>
                  </div>
               </div>
               <div class="card-body pl-1 Dash-table">
                  <div class="table-full-width">
                     <table class="table">
                        <tbody>
                           <tr>
                              <td class="border-0 pl-0 pr-0">
                                 <div class="form-check m-0 p-0">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <span class="form-check-sign"></span>
                                    </label>
                                 </div>
                              </td>
                              <td class="border-0 pl-0 task-color"><i class="fas fa-circle text-high taski mr-2"></i>Follow up Bill re appointment</td>
                              <td class="td-actions text-right border-0">
                                 <span class="badge badge-danger-lighten task-1">Done</span>
                              </td>
                           </tr>
                           <tr>
                              <td class="border-0 pl-0 pr-0">
                                 <div class="form-check m-0 p-0">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <span class="form-check-sign"></span>
                                    </label>
                                 </div>
                              </td>
                              <td class="border-0 pl-0 task-color"><i class="fas fa-circle text-high taski mr-2"></i>Check Commission Statement</td>
                              <td class="td-actions text-right border-0">
                                 <span class="badge badge-danger-lighten task-2">Inprogress</span>
                              </td>
                           </tr>
                           <tr>
                              <td class="border-0 pl-0 pr-0">
                                 <div class="form-check m-0 p-0">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <span class="form-check-sign"></span>
                                    </label>
                                 </div>
                              </td>
                              <td class="border-0 pl-0 task-color"><i class="fas fa-circle text-medium taski mr-2"></i>Prepare Information Package for Lin's Massage Centre</td>
                              <td class="td-actions text-right border-0">
                                 <span class="badge badge-danger-lighten task-2">Inprogress</span>
                              </td>
                           </tr>
                           <tr>
                              <td class="border-0 pl-0 pr-0">
                                 <div class="form-check m-0 p-0">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <span class="form-check-sign"></span>
                                    </label>
                                 </div>
                              </td>
                              <td class="border-0 pl-0 task-color"><i class="fas fa-circle text-medium taski mr-2"></i>Follow up Carla Brasil for Visa Application</td>
                              <td class="td-actions text-right border-0">
                                 <span class="badge badge-danger-lighten task-2">Inprogress</span>
                              </td>
                           </tr>
                           <tr>
                              <td class="border-0 pl-0 pr-0">
                                 <div class="form-check m-0 p-0">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <span class="form-check-sign"></span>
                                    </label>
                                 </div>
                              </td>
                              <td class="border-0 pl-0 task-color"><i class="fas fa-circle text-low taski mr-2"></i>Create Tour for Oxi Miller on 15/08/2022</td>
                              <td class="td-actions text-right border-0">
                                 <span class="badge badge-danger-lighten task-2">Inprogress</span>
                              </td>
                           </tr>
                           <tr>
                              <td class="border-0 pl-0 pr-0">
                                 <div class="form-check m-0 p-0">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <span class="form-check-sign"></span>
                                    </label>
                                 </div>
                              </td>
                              <td class="border-0 pl-0 task-color"><i class="fas fa-circle text-low taski mr-2"></i>Update Home State for Carla Brasil on 01/09/2022</td>
                              <td class="td-actions text-right border-0">
                                 <span class="badge badge-danger-lighten task-2">Inprogress</span>
                              </td>
                           </tr>
                           <tr>
                              <td class="border-0 pl-0 pr-0">
                                 <div class="form-check m-0 p-0">
                                    <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <span class="form-check-sign"></span>
                                    </label>
                                 </div>
                              </td>
                              <td class="border-0 pl-0 task-color"><i class="fas fa-circle text-low taski mr-2"></i>Research Joondalup for Massage Centres</td>
                              <td class="td-actions text-right border-0">
                                 <span class="badge badge-danger-lighten task-2">Inprogress</span>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <div class="card shadow mb-3">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-0">
               <h2 class="h5 text-gray-800 font-weight-bold">Appointments</h2>
            </div>
            <!-- Card Body -->
            <div class="card-body task-sec">
               <div class="card-body pl-1 Dash-table">
                  <div class="table-responsive-xl">
                     <table class="table apoint-sec">
                        <thead>
                           <tr>
                              <th class="pl-0" scope="col">Appointment List</th>
                              <th class="text-center" scope="col">Action</th>
                              <th class="float-right border-0 mr-4" scope="col">Status</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr class="row-color bg-white">
                              <td class="theme-color pl-0 bg-white"> <span class="mr-3">19-08-2022</span>    <span class="mr-3">11:00 am</span>    <span class="mr-3">Lin’s Massage</span></td>
                              <td class="theme-color bg-white">
                                 <div class="dropdown no-arrow text-center">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                       <a class="dropdown-item" href="#" data-toggle="modal" data-target="#new-ban">View</a>
                                       <div class="dropdown-divider"></div>
                                       <a class="dropdown-item" href="#" data-toggle="modal" data-target="#new-ban-2">Reschedule</a>
                                       <div class="dropdown-divider"></div>
                                       <a class="dropdown-item" href="#" data-toggle="modal" data-target="#new-ban-3">Cancel</a>
                                       
                                    </div>
                                 </div>
                              </td>
                              <td class="theme-color float-right pr-0 bg-white">
                                 <span class="badge badge-danger-lighten task-1">Completed</span>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Pie Chart -->
      <div class="col-xl-4 col-lg-5 pl-2">
         <div class="card shadow mb-3">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-0">
               <h2 class="h5 text-gray-800 font-weight-bold"> Top Advertisers</h2>
            </div>
            <!-- Card Body -->
            <div class="card-body top-adv">
               <div class="row pb-1">
                  <div class="col-md-6 pr-1">
                     <div class="card">
                        <div class="card-body p-0">
                           <div class="d-flex align-items-center pl-2 pr-2 pb-1 pt-1 justify-content-between shadow-sm">
                              <label class="font-weight-bold mb-0 text-xs pl-1">Escort</label>
                              <!-- <div class="text-center">
                                 <i aria-hidden="true" class="fa fa-info-circle text-muted text-xs" style="
                                    "></i>
                                 </div> -->
                           </div>
                           <div class="row no-gutters align-items-center pt-2 pb-2 pl-1 pr-1 mt-1">
                              <div class="col-4">
                                 <img src="{{ asset('assets/app/img/pie-new.png')}}" class="img-fluid">
                              </div>
                              <div class="col-8 pl-1 pr-1">
                                 <p class="mb-1 font-weight-bold text-muted">Carla Brasil</p>
                                 <div class="row p-2 ad-name">
                                    <div class="col-6 p-1 rounded">
                                       <div class="text-xs font-weight-bold mb-1 text-white">Spend</div>
                                       <div class="h6 mb-0 font-weight-bold text-white" style="font-size: 14px;">$ 580.0</div>
                                    </div>
                                    <div class="col-6 p-1 rounded">
                                       <div class="text-xs font-weight-bold mb-1 text-white" style="font-size: .5rem;">&nbsp;Commission</div>
                                       <div class="h6 mb-0 font-weight-bold text-white" style="font-size: 14px;">$ 232.0</div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- end card-body -->
                     </div>
                  </div>
                  <div class="col-md-6 pl-1">
                     <div class="card">
                        <div class="card-body p-0">
                           <div class="d-flex align-items-center pl-2 pr-2 pb-1 pt-1 justify-content-between shadow-sm">
                              <label class="font-weight-bold mb-0 text-xs pl-1">Massage Center</label>
                              <!-- <div class="text-center">
                                 <i aria-hidden="true" class="fa fa-info-circle text-muted text-xs" style="
                                    "></i>
                                 </div> -->
                           </div>
                           <div class="row no-gutters align-items-center pt-2 pb-2 pl-1 pr-1 mt-1">
                              <div class="col-4">
                                 <img src="{{ asset('assets/app/img/pie-new.png')}}" class="img-fluid">
                              </div>
                              <div class="col-8 pl-1 pr-1">
                                 <p class="mb-1 font-weight-bold text-muted">Lin's Massage
                                 </p>
                                 <div class="row p-2 ad-name">
                                    <div class="col-6 p-1 rounded">
                                       <div class="text-xs font-weight-bold mb-1 text-white">Spend</div>
                                       <div class="h6 mb-0 font-weight-bold text-white" style="font-size: 14px;">$ 580.0</div>
                                    </div>
                                    <div class="col-6 p-1 rounded">
                                       <div class="text-xs font-weight-bold mb-1 text-white" style="font-size: .5rem;">&nbsp;Commission</div>
                                       <div class="h6 mb-0 font-weight-bold text-white" style="font-size: 14px;">$ 232.0</div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- end card-body -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row agent-dash mb-3">
            <div class="col-lg-12">
               <div class="sec-one pb-4 rounded">
                  <h2 class="h5 mt-2 mb-4 text-gray-800 font-weight-bold">Registrations</h2>
                  <div class="row">
                     <div class="col-md-6 pr-1">
                        <div class="card">
                           <div class="card-body pt-0 pl-0 pr-0">
                              <div class="d-flex align-items-center pl-2 pr-2 pb-1 pt-1 justify-content-between shadow-sm">
                                 <label class="font-weight-bold mb-0 text-xs pl-1">Escort</label>
                                 <!-- <div class="text-center">
                                    <i aria-hidden="true" class="fa fa-info-circle text-muted text-xs" style="
                                       "></i>
                                    </div> -->
                              </div>
                              <div class="row no-gutters align-items-center pl-3 pr-3 pt-3">
                                 <div class="col mr-2">
                                    <div class="text-xs font-weight-bold mb-1 text-muted">
                                       <div class="text-xs font-weight-bold mb-1 text-muted mb-2">
                                          <div class="dropdown">
                                             <a class="btn-secondary dropdown-toggle text-muted bg-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Week to Date</a>
                                             <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="">
                                                <a class="dropdown-item" href="#">Week to Date</a>
                                                <a class="dropdown-item" href="#">Month to date</a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="h2 mb-0 font-weight-bold text-gray-800">125</div>
                                 </div>
                                 <div class="col-auto mt-3">
                                    <img src="{{ asset('assets/app/img/account-multiple.png')}}">
                                 </div>
                              </div>
                           </div>
                           <!-- end card-body -->
                        </div>
                     </div>
                     <div class="col-md-6 pl-1">
                        <div class="card">
                           <div class="card-body pt-0 pl-0 pr-0">
                              <div class="d-flex align-items-center pl-2 pr-2 pb-1 pt-1 justify-content-between shadow-sm">
                                 <label class="font-weight-bold mb-0 text-xs pl-1">Massage Center</label>
                              </div>
                              <div class="row no-gutters align-items-center pl-3 pr-3 pt-3">
                                 <div class="col mr-2">
                                    <div class="text-xs font-weight-bold mb-1 text-muted">
                                       <div class="text-xs font-weight-bold mb-1 text-muted mb-2">
                                          <div class="dropdown">
                                             <a class="btn-secondary dropdown-toggle text-muted bg-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Week to Date</a>
                                             <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="">
                                                <a class="dropdown-item" href="#">Week to Date</a>
                                                <a class="dropdown-item" href="#">Month to date</a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="h2 mb-0 font-weight-bold text-gray-800">25</div>
                                 </div>
                                 <div class="col-auto mt-3">
                                    <img src="{{ asset('assets/app/img/account-multiple-1.png')}}">
                                 </div>
                              </div>
                           </div>
                           <!-- end card-body -->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row agent-dash">
            <div class="col-lg-12">
               <div class="sec-one pb-4 rounded" style="background: #5D6D7E;">
                  <h2 class="h5 mt-2 mb-4 font-weight-bold text-white">Monitoring</h2>
                  <div class="card mb-4">
                     <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-0">
                        <h2 class="h5 text-gray-800 font-weight-bold">My Advertisers Online
                        </h2>
                     </div>
                     <div class="card-body pt-0">
                        <div class="table-responsive">
                           <table class="table table-nowrap mb-0">
                              <tbody>
                                 <tr>
                                    <td class="border-0">
                                       <div class="d-flex align-items-center">
                                          <div class="flex-grow-1 font-weight-bold">In my Territory:</div>
                                       </div>
                                    </td>
                                    <td class="text-right border-0">15</td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <div class="d-flex align-items-center">
                                          <div class="flex-grow-1 font-weight-bold">Outside my Territory:</div>
                                       </div>
                                    </td>
                                    <td class="text-right">15</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="card">
                     <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-0">
                        <h2 class="h5 text-gray-800 font-weight-bold">Logs &amp; Status</h2>
                     </div>
                     <div class="card-body pt-0">
                        <div class="table-responsive">
                           <table class="table table-nowrap mb-0">
                              <tbody>
                                 <tr>
                                    <td class="border-0 leftside-table">
                                       <div class="d-flex align-items-center">
                                          <div class="flex-grow-1 font-weight-bold">Login count</div>
                                       </div>
                                    </td>
                                    <td class="text-right border-0">526</td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <div class="d-flex align-items-center">
                                          <div class="flex-grow-1 font-weight-bold">Last login:</div>
                                       </div>
                                    </td>
                                    <td class="text-right">19-08-2022 | 12:32:02 PM</td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <div class="d-flex align-items-center">
                                          <div class="flex-grow-1 font-weight-bold">Territory:</div>
                                       </div>
                                    </td>
                                    <td class="text-right">Perth</td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <div class="d-flex align-items-center">
                                          <div class="flex-grow-1 font-weight-bold">Password Expiry: </div>
                                       </div>
                                    </td>
                                    <td class="text-right">Never</td>
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
</div>
<div class="modal fade upload-modal" id="new-ban" tabindex="-1" role="dialog" aria-labelledby="new-ban" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="new-ban">View Appointment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0 agent-tour">
            <div class="card-body">
               <div class="row">
                  <div class="col mt-0">
                     <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl pr-3 mt-1">
                           <img src="{{ asset('assets/img/agn-img.png')}}">
                        </div>
                        <div class="ms-3 name">
                           <h5 class="primery_color normal_heading mb-0" data-toggle="modal" data-target="#Agent_Name"><a class="collapse-item" href="#"><b>Carla Brasil</b></a></h5>
                           <h6 class="text-muted mb-0 small">Member ID: E03152 </h6>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body row">
                  <div class="row w-100">
                     <table class="table total-summary">
                        <tbody>
                           <tr>
                              <td class="border-0 w-25"><b>Date:</b></td>
                              <td class="border-0">31/12/2022</td>
                           </tr>
                           <tr>
                              <td class="border-0 w-25"><b>Time: </b></td>
                              <td class="border-0">11:00 AM</td>
                           </tr>
                           <tr>
                              <td class="border-0 w-25"><b>Address:</b></td>
                              <td class="border-0">Western Australia</td>
                           </tr>
                           <tr>
                              <td class="border-0 w-25"><b>Phone Number:</b></td>
                              <td class="border-0">0123456789</td>
                           </tr>
                           <tr>
                              <td class="border-0 w-25"><b>Comments</b></td>
                              <td class="border-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Diam egestas erat diam mauris, purus auctor nibh tincidunt.</td>
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
<div class="modal fade upload-modal" id="new-ban" tabindex="-1" role="dialog" aria-labelledby="new-ban" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="new-ban">View Appointment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0 agent-tour">
            <form method="post" action="#">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Date</label>
                        <input type="Date" class="form-control" placeholder="Date">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Time</label>
                        <input type="time" class="form-control" placeholder="Date">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder=" ">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" placeholder=" ">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" placeholder=" ">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Comments</label>
                        <textarea class="form-control" placeholder=" " rows="3"></textarea>
                     </div>
                  </div>
                  <div class="col-md-12 mb-3">
                     <div class="form-group">
                        <button type="submit" class="btn btn-primary shadow-none float-right">Save</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="new-ban-2" tabindex="-1" role="dialog" aria-labelledby="new-ban-2" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="new-ban-2">Reschedule Appointment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0 agent-tour">
            <div class="card-body pb-0">
               <div class="row">
                  <div class="col mt-0">
                     <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl pr-3 mt-1">
                           <img src="{{ asset('assets/img/agn-img.png')}}">
                        </div>
                        <div class="ms-3 name">
                           <h5 class="primery_color normal_heading mb-0" data-toggle="modal" data-target="#Agent_Name"><a class="collapse-item" href="#"><b>Carla Brasil</b></a></h5>
                           <h6 class="text-muted mb-0 small">Member ID: E03152 </h6>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body row">
                  <div class="row w-100">
                     <table class="table total-summary">
                        <tbody>
                           <tr>
                              <td class="border-0 w-25"><b>Date:</b></td>
                              <td class="border-0"><input type="Date" class="form-control w-75" placeholder="Date" value="19-08-2022"></td>
                           </tr>
                           <tr>
                              <td class="border-0 w-25"><b>Time: </b></td>
                              <td class="border-0"><input type="time" class="form-control w-75" placeholder="Time" value="05:12"></td>
                           </tr>
                           <tr>
                              <td class="border-0 w-25"><b>Address:</b></td>
                              <td class="border-0">Western Australia</td>
                           </tr>
                           <tr>
                              <td class="border-0 w-25"><b>Phone Number:</b></td>
                              <td class="border-0">0123456789</td>
                           </tr>
                           <tr>
                              <td class="border-0 w-25"><b>Comments</b></td>
                              <td class="border-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Diam egestas erat diam mauris, purus auctor nibh tincidunt.</td>
                           </tr>
                        <tr>
                              <td class="border-0 w-25"></td>
                              <td class="border-0 bg-white"><div class="form-group">
                        <button type="submit" class="btn btn-primary shadow-none float-right">Save</button>
                     </div></td>
                           </tr></tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="new-ban-3" tabindex="-1" role="dialog" aria-labelledby="new-ban-3" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="new-ban-3">Cancel Appointment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0 agent-tour">
            <form method="post" action="#">
               <h4>Are you sure you want to cancel this Appointment?</h4>
               <div class="row">
                  <div class="col-md-12 mb-3">
                     <div class="form-group">
                        <button type="submit" class="btn btn-primary shadow-none float-right ml-2 border-0">Yes</button>
                        <button type="button" class="btn btn-primary shadow-none float-right ml-2 border-0 bg-danger" data-dismiss="modal" aria-label="Close">No</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<div class="modal fade upload-modal" id="new-task" tabindex="-1" role="dialog" aria-labelledby="new-ban-4" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="new-task">Create New Task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0 agent-tour">
            <div class="row">
               <div class="col-md-4 pr-0">
                  <div class="form-group">
                     <select class="custom-select rounded-0" name="state">
                        <option value="">Importance</option>
                        <option>Importance</option>
                     </select>
                  </div>
               </div>
               <div class="col-md-8">
                  <div class="form-group">
                     <input type="text" class="form-control rounded-0" required="" placeholder="Task">
                  </div>
               </div>
               <div class="col-md-12 mb-3">
                  <div class="form-group">
                     <button type="submit" class="btn btn-primary shadow-none">Add New Task</button>
                  </div>
               </div>
               <div class="col-md-12 mb-3">
                  <div class="form-group">
                     <button type="submit" class="btn btn-primary shadow-none float-right">Save</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="edit-task" tabindex="-1" role="dialog" aria-labelledby="new-ban-4" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="edit-task">Edit Tasks</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0 agent-tour">
            <div class="row">
               <div class="col-md-4 pr-0">
                  <div class="form-group">
                     <select class="custom-select rounded-0" name="state">
                        <option value="">High</option>
                        <option>Importance</option>
                     </select>
                  </div>
               </div>
               <div class="col-md-8">
                  <div class="form-group">
                     <input type="text" class="form-control rounded-0" required="" placeholder="Task" value="Follow up Bill re appointment">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-4 pr-0">
                  <div class="form-group">
                     <select class="custom-select rounded-0" name="state">
                        <option value="">High</option>
                        <option>Importance</option>
                     </select>
                  </div>
               </div>
               <div class="col-md-8">
                  <div class="form-group">
                     <input type="text" class="form-control rounded-0" required="" placeholder="Task" value="Follow up Bill re appointment">
                  </div>
               </div>
               <div class="col-md-12 mb-3">
                  <div class="form-group">
                     <button type="submit" class="btn btn-primary shadow-none float-right">Save</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="delete-task" tabindex="-1" role="dialog" aria-labelledby="new-ban-4" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="delete-task">Delete task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0 agent-tour">
            <form method="post" action="#">
               <h4>Are you sure you want to Delete this task?</h4>
               <div class="row">
                  <div class="col-md-12 mb-3">
                     <div class="form-group">
                        <button type="submit" class="btn btn-primary shadow-none float-right ml-2 border-0">Yes</button>
                        <button type="button" class="btn btn-primary shadow-none float-right ml-2 border-0 bg-danger" data-dismiss="modal" aria-label="Close">No</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')
@endsection