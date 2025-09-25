@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
@endsection
@section('content')
<style type="text/css">
   .border {
   border: 1px solid #d1d3e2 !important;
   }
   .list-group-item+.list-group-item {
    border-top-width: 1px;
}
</style>
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content end here-->
   {{-- Page Heading   --}}
   <div class="row">
      <div class="custom-heading-wrapper col-lg-12">
         <h1 class="h1">Information Package</h1>
         <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes" style="">
            <div class="card-body">
               <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
               <ol>
                  <li>All lists are created according to a post code (<b>List</b>). Go to <a href="{{ route('marketing.agencreate-prospect') }}" class="custom_links_design">Prospect Lists </a> to create a List.</li>
                  <li>If you merged a List it will be listed here.</li>
                  <li>You can manage your merged Lists by:
                     <ol class="level-2">
                        <li>emailing to the prospective Member;</li>
                        <li>printing a hard copy for mailing to the prospective Member; and</li>
                        <li>printing a hard copy for binding and presenting to a prospective Member at an
                           appointment.</li>
                           
                     </ol>
                     <p>You should check the information set out in the Information Package before presenting
                        it to the prospective Member.</p>
                  </li>
                  <li>Click the 'View' button to view the Information Package in full.</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   {{-- end --}}

   {{-- Information Packages --}}
      <div class="row">
         <div class="col-lg-12">
            <div class="table-responsive-xl">
               <table class="table" id="infoPackTable">
                  <thead class="bg-first">
                     
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Date Generated</th>
                        <th class="text-center">Post Code</th>
                        <th class="text-center">Listings</th>
                        <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td class="text-center">105</td>
                        <td>15-12-2025</td>
                        <td class="text-center">6000 - 6004</td>
                        <td class="text-center">35</td>
                        <td class="text-center" class="text-center">
                           <div class="dropdown no-arrow">
                               <a class="dropdown-toggle" href="#" role="button"
                                   id="dropdownMenuLink" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="true">
                                   <i
                                       class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                               </a>
                               <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                   aria-labelledby="dropdownMenuLink"
                                   x-placement="bottom-end">
                                   <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                       href="#" data-target="#centresModal" data-toggle="modal"> <i class="fa fa-eye"></i>
                                       View</a>
                                   
                                         <div class="dropdown-divider"></div>

                                         <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center"
                                       href="#" data-target="#search" data-toggle="modal"> <i class="fa fa-search"></i>
                                       Search</a>
                                   
 
                               </div>
                           </div>
                       </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   {{-- end --}}
</div>


    {{-- search modal --}}
    <div class="modal fade upload-modal show" id="search" tabindex="-1" role="dialog"
        aria-labelledby="searchlabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/search.png') }}"
                        class="custompopicon">
                        <span class="text-white">Search</span>
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour text-center">
                    <h5 class="my-2">Search the Information Package document you are looking
                     for by the ID contained in the List.</h5>
                    <form>
                        <div class="row mt-3">
                            <div class="col-md-6 mx-auto">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="id_number" placeholder="Insert ID Number">
                                </div>
                            </div>
                        </div>

                        <!-- Save Button -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group text-center">
                                    <button type="button" class="btn-success-modal" id="search_button" data-target="#view_list" data-toggle="modal">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    {{-- end --}}


    
    {{-- View list Modal --}}
    <div class="modal fade upload-modal bd-example-modal-lg" id="view_list" tabindex="-1" role="dialog"
        aria-labelledby="view_listLabel" aria-hidden="true">
        <div class="modal-dialog print-list-modal modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="view_list"><img
                            src="{{ asset('assets/dashboard/img/profile-report.png') }}" class="custompopicon">View List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive profile_summary">
                        <table cellpadding="8" cellspacing="0" width="100%"
                            style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">

                            <thead class="bg-first">
                                <!-- Table Headings -->
                                <tr>
                                    <td style="text-align:center;">ID</td>
                                    <td>Business Name</td>
                                    <td>Address</td>
                                    <td>Post Code</td>
                                    <td>Mobile Number</td>
                                    <td>Business Number</td>
                                    <td>Email</td>
                                    <td>Website</td>
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="text-center">369</td>
                                <td>Body Heat Massage</td>
                                <td>62 Gordon Rd East<br>Osborne Park</td>
                                <td>6000</td>
                                <td>0456 665 012</td>
                                <td>9236 2587</td>
                                <td></td>
                                <td></td>
                                
                              </tr>
                              <tr>
                                <td class="text-center">256</td>
                                <td>Healthland</td>
                                <td>510 Murray St<br>Perth</td>
                                <td>6000</td>
                                <td>0426 610 881</td>
                                <td>9325 2011</td>
                                <td></td>
                                <td></td>
                                
                              </tr>
                              <tr>
                                <td class="text-center">147</td>
                                <td>Esquire Spa and Massage</td>
                                <td>11 Aberdeen St<br>Perth</td>
                                <td>6000</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                
                              </tr>
                            </tbody>
                            
                        </table>
                    </div>

                    <div class="modal-footer mt-3">
                        <button type="button" class="btn-cancel-modal" data-dismiss="modal" value="close"
                            id="close_change">Print</button>
                            <button type="button" class="btn-success-modal" data-dismiss="modal" value="close"
                            id="close_change">Email</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}
     <!-- view Massage merged list Modal -->
     <div class="modal fade upload-modal" id="centresModal" tabindex="-1" aria-labelledby="centresModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered ">
            <div class="modal-content">
               
               <div class="modal-header">
                  <h5 class="modal-title" id="view_list"><img
                        src="{{ asset('assets/dashboard/img/merge.png') }}" class="custompopicon">All Massage Centres (Merged List)</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                              class="img-fluid img_resize_in_smscreen"></span>
                  </button>
            </div>
               <div class="modal-body">

                     <!-- Static List -->
                     <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           <div>
                                 <h6 class="mb-1">Tranquil Touch</h6>
                                 <small class="text-muted">Connaught Place</small>
                           </div>
                           <a href="{{ route('agent.my.appointment.list') }}" class="btn-appointment">Make Appointment</a>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           <div>
                                 <h6 class="mb-1">Healing Hands</h6>
                                 <small class="text-muted">Greater Kailash</small>
                           </div>
                           <a href="{{ route('agent.my.appointment.list') }}" class="btn-appointment">Make Appointment</a>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           <div>
                                 <h6 class="mb-1">Zen Retreat</h6>
                                 <small class="text-muted">Hauz Khas</small>
                           </div>
                           <a href="{{ route('agent.my.appointment.list') }}" class="btn-appointment">Make Appointment</a>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           <div>
                                 <h6 class="mb-1">Soothing Springs</h6>
                                 <small class="text-muted">Saket</small>
                           </div>
                           <a href="{{ route('agent.my.appointment.list') }}" class="btn-appointment">Make Appointment</a>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           <div>
                                 <h6 class="mb-1">Quiet Waves</h6>
                                 <small class="text-muted">Karol Bagh</small>
                           </div>
                           <a href="{{ route('agent.my.appointment.list') }}" class="btn-appointment">Make Appointment</a>
                        </li>
                     </ul>

               </div>
               <div class="modal-footer">
                     <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
   </div>
    {{-- end --}}
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
</script>
<script>
    $(document).ready(function() {
        // Init DataTable
        var table = $("#infoPackTable").DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Post Code"
            },
            processing: false,
            serverSide: false,
            paging: true,
            lengthChange: true,
            searching: true,
            bStateSave: true,
            ordering: false,
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            pageLength: 10
        });
      });
        </script>
@endpush