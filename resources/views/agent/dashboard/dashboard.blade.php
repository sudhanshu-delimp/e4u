@extends('layouts.agent')
@section('content')
<div class="container-fluid pl-lg-4">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <div class="v-main-heading h3">Dashboard</div>
   </div>
   <div class="row agent-dash">
      <div class="col-lg-8">
         <div class="sec-one">
            <h2 class="h5 mt-2 mb-4 text-gray-800 font-weight-bold">My Statistics</h2>
            <div class="row">
               <div class="col-md-3">
                  <div class="card" style="border-top: 2px solid #FF3C5F;">
                     <div class="card-body">
                        <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="text-xs font-weight-bold mb-1 text-muted">My Escorts</div>
                              <div class="h2 mb-0 font-weight-bold text-gray-800">25</div>
                           </div>
                           <div class="col-auto mt-3">
                              <img src="{{ asset('assets/app/img/account-multiple.png')}}">
                           </div>
                        </div>
                     </div>
                     <!-- end card-body -->
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card" style="border-top: 2px solid #323C47;">
                     <div class="card-body">
                        <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="text-xs font-weight-bold mb-1 text-muted">My Massage Centres</div>
                              <div class="h2 mb-0 font-weight-bold text-gray-800">125</div>
                           </div>
                           <div class="col-auto mt-3">
                              <img src="{{ asset('assets/app/img/account-multiple-1.png')}}">
                           </div>
                        </div>
                     </div>
                     <!-- end card-body -->
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card" style="border-top: 2px solid #FF3C5F;">
                     <div class="card-body">
                        <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="text-xs font-weight-bold mb-1 text-muted">Escort Profile Posted</div>
                              <div class="h2 mb-0 font-weight-bold text-gray-800">32</div>
                           </div>
                           <div class="col-auto mt-3">
                              <img src="{{ asset('assets/app/img/account-multiple-2.png')}}">
                           </div>
                        </div>
                     </div>
                     <!-- end card-body -->
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card" style="border-top: 2px solid #323C47;">
                     <div class="card-body">
                        <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="text-xs font-weight-bold mb-1 text-muted">MC Profile Posted</div>
                              <div class="h2 mb-0 font-weight-bold text-gray-800">125</div>
                           </div>
                           <div class="col-auto mt-3">
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
               <div class="col-md-6">
                  <div class="card">
                     <div class="card-body">
                        <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="text-xs font-weight-bold mb-1 text-muted">Today’s Income</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800">$ 580.00</div>
                           </div>
                           <div class="col-auto mt-3">
                              <!-- <img fill="none" src="http://localhost/e4u/public/assets/app/img/account-multiple-4.png"> -->
                           </div>
                        </div>
                     </div>
                     <!-- end card-body -->
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card">
                     <div class="card-body">
                        <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="text-xs font-weight-bold mb-1 text-muted">Month to Date</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800">$ 3588.00</div>
                           </div>
                           <div class="col-auto mt-3">
                              <!-- <img src="http://localhost/e4u/public/assets/app/img/account-multiple-4.png"> -->
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
   <div class="row mt-5">
      <!-- Area Chart -->
      <div class="col-xl-8 col-lg-7">
         <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-0">
               <h2 class="h5 text-gray-800 font-weight-bold">Task </h2>
            </div>
            <!-- Card Body -->
            <div class="card-body">
               <div class="d-flex align-items-center mb-2" style="gap: 10px;">
                  <input type="submit" value="New Task" class="btn btn-primary shadow-none create-tour-sec" name="submit">
                  <input type="submit" value="Delete Task" class="btn btn-primary shadow-none create-tour-sec" name="submit"><input type="submit" value="Edit Task" class="btn btn-primary shadow-none create-tour-sec" name="submit">
                  <div class="text-center small" style="display: flex;justify-content: flex-end;width: 100%;gap: 10px;">
                     <span class="mr-2">Importance:</span>
                     <span class="">High</span><i class="fas fa-circle text-high"></i>
                     <span class="">Medium</span>
                     <i class="fas fa-circle text-medium"></i>
                     <span class="">Low</span>
                     <i class="fas fa-circle text-low"></i>
                  </div>
               </div>
               <div class="d-flex align-items-center mt-4" style="gap: 10px;">
                  <label class="font-weight-bold mb-0">Task</label>
                  <div class="text-center" style="display: flex;justify-content: flex-end;width: 92%;">
                     <label class="font-weight-bold mb-0">Status</label>
                  </div>
               </div>
<div class="d-flex align-items-center mb-2" style="">
   <ul class="list-group list-group-flush todo-list pt-4">
      <li class="list-group-item border-0 p-0">
         <div class="form-check mb-0 pl-3"><input type="checkbox" class="form-check-input todo-done" id="6"><i class="fas fa-circle text-high taski"></i>
            <label class="form-check-label" for="6">Follow up Bill re appointment</label>
         </div>
      </li>
      <li class="list-group-item border-0 p-0">
         <div class="form-check mb-0 pl-3"><input type="checkbox" class="form-check-input todo-done" id="5"><i class="fas fa-circle text-high taski"></i>
            <label class="form-check-label" for="5">Check Commission Statement</label>
         </div>
      </li>
      <li class="list-group-item border-0 p-0">
         <div class="form-check mb-0 pl-3"><input type="checkbox" class="form-check-input todo-done" id="1"><i class="fas fa-circle text-medium taski"></i>
            <label class="form-check-label" for="1">Prepare Information Package for Lin's Massage Centre</label>
         </div>
      </li>
      <li class="list-group-item border-0 p-0">
         <div class="form-check mb-0 pl-3"><input type="checkbox" class="form-check-input todo-done" id="1"><i class="fas fa-circle text-medium taski"></i>
            <label class="form-check-label" for="1">Follow up Carla Brasil for Visa Application</label>
         </div>
      </li>
      <li class="list-group-item border-0 p-0">
         <div class="form-check mb-0 pl-3"><input type="checkbox" class="form-check-input todo-done" id="1"><i class="fas fa-circle text-low taski"></i>
            <label class="form-check-label" for="1">Create Tour for Oxi Miller on 15/08/2022</label>
         </div>
      </li>
      <li class="list-group-item border-0 p-0">
         <div class="form-check mb-0 pl-3"><input type="checkbox" class="form-check-input todo-done" id="1"><i class="fas fa-circle text-low taski"></i>
            <label class="form-check-label" for="1">Update Home State for Carla Brasil on 01/09/2022</label>
         </div>
      </li>
      <li class="list-group-item border-0 p-0">
         <div class="form-check mb-0 pl-3"><input type="checkbox" class="form-check-input todo-done" id="1"><i class="fas fa-circle text-low taski"></i>
            <label class="form-check-label" for="1">Research Joondalup for Massage Centres</label>
         </div>
      </li>
   </ul>
   <div class="text-center" style="display: flex;justify-content: flex-end;width: 49%;">
      <ul class="list-group list-group-flush todo-list">
         <li class="list-group-item border-0 p-0">
            <span class="badge badge-danger-lighten task-1">Done</span>
         </li>
         <li class="list-group-item border-0 p-0">
            <span class="badge badge-danger-lighten task-2">Inprogress</span>
         </li>
         <li class="list-group-item border-0 p-0">
            <span class="badge badge-danger-lighten task-2">Inprogress</span>
         </li>
         <li class="list-group-item border-0 p-0">
            <span class="badge badge-danger-lighten task-2">Inprogress</span>
         </li>
         <li class="list-group-item border-0 p-0">
            <span class="badge badge-danger-lighten task-2">Inprogress</span>
         </li>
         <li class="list-group-item border-0 p-0">
            <span class="badge badge-danger-lighten task-2">Inprogress</span>
         </li>
         <li class="list-group-item border-0 p-0">
            <span class="badge badge-danger-lighten task-2">Inprogress</span>
         </li>
      </ul>
   </div>
</div>
            </div>
         </div>
      </div>
      <!-- Pie Chart -->
      <div class="col-xl-4 col-lg-5">
         <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-0">
               <h2 class="h5 text-gray-800 font-weight-bold"> Top Advertisers</h2>
            </div>
            <!-- Card Body -->
            <div class="card-body">
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')
<script></script>
@endsection