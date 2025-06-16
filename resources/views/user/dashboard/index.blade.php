@extends('layouts.userDashboard')
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pt-5">
    <!--middle content start here-->
    <div class="row">
        <div class="col-md-9">
           <div class="v-main-heading h3 pt-0 pb-2">Viewer Dashbaord</div>
        </div>
     </div>
    <div class="row agent-dash">
       <div class="col-md-8">
          <div class="sec-one">
             <h2 class="h5 mt-2 mb-4 text-gray-800 font-weight-bold">My Statistics</h2>
             <div class="row">
                <div class="col-md-3">
                   <div class="card static-sec">
                      <div class="card-body">
                         <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                               <div class="text-xs font-weight-bold mb-1 text-muted">Profile Views Today</div>
                               <div class="h2 mb-0 font-weight-bold text-gray-800">25</div>
                            </div>
                            <div class="col-auto mt-3">
                               <img src="http://127.0.0.1:8000/assets/app/img/account-multiple-0.png">
                            </div>
                         </div>
                      </div>
                      <!-- end card-body -->
                   </div>
                </div>
                <div class="col-md-3 pl-0">
                   <div class="card static-sec-2">
                      <div class="card-body">
                         <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                               <div class="text-xs font-weight-bold mb-1 text-muted">Media Views Today</div>
                               <div class="h2 mb-0 font-weight-bold text-gray-800">125</div>
                            </div>
                            <div class="col-auto mt-3">
                               <img src="http://127.0.0.1:8000/assets/app/img/account-multiple-00.png">
                            </div>
                         </div>
                      </div>
                      <!-- end card-body -->
                   </div>
                </div>
                <div class="col-md-3 pl-0">
                   <div class="card static-sec">
                      <div class="card-body">
                         <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                               <div class="text-xs font-weight-bold mb-1 text-muted">Recommendations This Week
                               </div>
                               <div class="h2 mb-0 font-weight-bold text-gray-800">32</div>
                            </div>
                            <div class="col-auto mt-3">
                               <img src="http://127.0.0.1:8000/assets/app/img/account-multiple-000.png">
                            </div>
                         </div>
                      </div>
                      <!-- end card-body -->
                   </div>
                </div>
                <div class="col-md-3 pl-0">
                   <div class="card static-sec-2">
                      <div class="card-body">
                         <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                               <div class="text-xs font-weight-bold mb-1 text-muted">Reviews Posted This Week
                               </div>
                               <div class="h2 mb-0 font-weight-bold text-gray-800">125</div>
                            </div>
                            <div class="col-auto mt-3">
                               <img src="http://127.0.0.1:8000/assets/app/img/account-multiple-0000.png">
                            </div>
                         </div>
                      </div>
                      <!-- end card-body -->
                   </div>
                </div>
             </div>
          </div>
       </div>
       <div class="col-sm-12 col-md-12 col-lg-4 ">
          <div class="table-responsive">
             <table class="table table-bordered text-center">
                <thead class="text-white" style="background: #0c223d;">
                   <tr>
                      <th colspan="3" class="font-weight-bold">
                         <h2 class="h5 mt-2 font-weight-bold" style="
                            color: #fff;
                            ">My Statistics</h2>
                      </th>
                   </tr>
                </thead>
                <tbody>
                   <tr>
                      <td><i class="fas fa-box"></i></td>
                      <td class="text-left">My Legbox</td>
                      <td>23</td>
                   </tr>
                   <tr>
                      <td><i class="fas fa-sticky-note"></i></td>
                      <td class="text-left">Notes</td>
                      <td>32</td>
                   </tr>
                   <tr>
                      <td><i class="fas fa-star"></i></td>
                      <td class="text-left">Reviews posted</td>
                      <td>12</td>
                   </tr>
                   <tr>
                      <td><i class="fas fa-flag"></i></td>
                      <td class="text-left">E4U reports</td>
                      <td>14</td>
                   </tr>
                   <tr>
                      <td><i class="fas fa-file-alt"></i></td>
                      <td class="text-left">Punterbox reports</td>
                      <td>12</td>
                   </tr>
                </tbody>
             </table>
          </div>
       </div>
    </div>
    <!--middle content end here-->
 </div>
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
@endpush