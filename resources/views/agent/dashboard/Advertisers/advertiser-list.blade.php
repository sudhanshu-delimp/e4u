@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
   .select2-container .select2-choice, .select2-result-label {
   font-size: 1.5em;
   height: 52px !important; 
   overflow: auto;
   }
   .select2-arrow, .select2-chosen {
   padding-top: 6px;
   }
   span.select2.select2-container.select2-container--default > span.selection > span {
   height: 52px !important; 
   }
</style>
@endsection
@section('content')
<div id="wrapper">
   <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
         <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5" id="replace-item">
            <!--middle content-->
            
         {{-- Page Heading   --}}
         <div class="row">
            
            <div class="d-flex align-items-center justify-content-between col-md-12">
               <div class="custom-heading-wrapper">
                   <h1 class="h1">Advertiser List</h1>
                   <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
               </div>
               <div class="back-to-dashboard">
                   <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                       <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                   </a>
               </div>
           </div>
            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes" style="">
                  <div class="card-body">
                     <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                     <ol>
                        
                  <li style="font-size: 15px;">You can access all of your Advertisers here.  The report 'Earnings' column is Commission paid to you by E4U according to the Advertiser's spend.</li>
                  <li style="font-size: 15px;" class="mb-0">Click the 'Action' button and select from the range of options available to you including Messaging to an Advertiser.</li>
               
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         {{-- end --}}
            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-12">
                  <!-- Begin Page Content -->
                  <!-- /.container-fluid --><br>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="d-flex justify-content-end"><button type="button" class="btn btn-primary create-tour-sec dctour" onclick="window.print();return false;">Print Report</button></div>
                        <div class="panel with-nav-tabs panel-warning">
                           <div class="panel-body">
                              <div class="tab-content">
                                 <div class="tab-pane fade in active show" id="tab1warning">
                                    <div class="table-responsive-xl" id="table-sec">
                                       <table class="table" id="myAdvertisersList">
                                         <thead class="table-bg">
                                             <tr>
                                                <th scope="col">Member ID
                                                </th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Mobile</th><th scope="col">Email</th><th scope="col">Contact</th><th scope="col">Home State</th>
                                                <th scope="col">Joined</th>
                                                <th scope="col">Appointed</th><th scope="col">Earnings</th>
                                                <th scope="col">Action</th>
                                             </tr>
                                          </thead>                                          <tbody class="table-content">
                                             {{-- <tr class="row-color">
                                                <td class="theme-color">E03153</td>
                                                <td class="theme-color">Carla</td>
                                                <td class="theme-color">09876543210</td>
                                                <td class="theme-color">demo@gmail.com</td>
                                                <td class="theme-color">Mobile</td>
                                                <td class="theme-color">WA</td><td class="theme-color">19/02/2022</td><td class="theme-color">25/02/2022</td><td class="theme-color">$200</td><td class="theme-color">
                                                   <div class="dropdown no-arrow">
                                                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                      </a>
                                                      <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                         <a class="dropdown-item" id="manage-profile" href="#">Manage Profile</a>
                                                         <div class="dropdown-divider"></div>
                                                         <a class="dropdown-item" id="manage-tour" href="#">Manage Tour</a>
                                                         <div class="dropdown-divider"></div>
                                                         <a class="dropdown-item" href="#">Manage Media</a>
                                                         <div class="dropdown-divider"></div>
                                                         <a class="dropdown-item" href="#" id="manage-concierge">Manage Concierge &amp; Services</a><div class="dropdown-divider"></div>
                                                         <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewticket">Print Report</a>
                                                      </div>
                                                   </div>
                                                </td>
                                             </tr> --}}
                                          </tbody>
                                       </table>
                                       {{-- <nav aria-label="Page navigation example">
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
                                       </nav> --}}
                                    </div>
                                 </div>
                              </div>
                           </div>
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
   </div>
</div>



@endsection
@push('script')
<script>

</script>
@endpush