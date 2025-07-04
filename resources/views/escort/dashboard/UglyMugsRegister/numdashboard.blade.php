@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
   .parsley-errors-list {
   list-style: none;
   color: rgb(248, 0, 0)
   }
    .parsley-type {
        color: #e5365a;
        text-transform: capitalize;
        font-size: small;
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5">
   <!--middle content start here-->
   <div class="row">
      <div class="col-md-12">
         <div class="v-main-heading h3" style="display: inline-block;">NUM Dashboard</div>
          <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
      </div>
      <div class="col-md-12 mt-4 mb-5">
         <div class="row collapse" id="notes">
            <div class="col-md-12 mb-4">
               <div class="card">
                  <div class="card-body">
                     <p><b>Notes:</b> </p>
                     <ul>
                        <li>The National Ugly Mugs register (NUM) is a free service to all Escorts. You can use the NUM service at any time. Your details, when you undertake a search, are kept confidential.</li>
                        <li>You can only search for an offender by their mobile number. Search your next booking by their mobile number itself, e.g. <code>0400123456</code>. Do not include any prefixes like +61 or spaces.</li>
                        <li>E4U makes no claims:
                          <ul>
                            <li>as to the accuracy or legitimacy of the allegations contained in a Report;</li>
                            <li>nor do we investigate the authenticity of the Reports (provided in confidence by Escorts).</li>
                          </ul>
                        </li>
                      </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="card mt-4">
            <div class="card-header table-bg text-white">
               Search Report by Mobile Number
            </div>
            <div class="card-body">
               <div class="container-fluid" style="padding: 0px 0px;">
                  <div class="row">
                     <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group mb-0">
                           <label for="searchMobile">Search by Mobile Number (no spaces)</label>
                           <form class="search-form-bg navbar-search" style="width: 305px;">
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
                     </div>
                  </div>
               </div>
               <!-- Reports Table -->
               <div class="table-responsive">
                  <table class="table table-bordered table-hover mt-3" id="resultsTable">
                     <thead class="table-bg">
                        <tr>
                           <th>REF</th>
                           <th>Status</th>
                           <th>Mobile</th>
                           <th>Incident Type</th>
                           <th>Incident Date</th>
                           <th>Location</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody class="table-content">
                        <!-- Example static row -->
                        <tr>
                           <td>#12345</td>
                           <td>Pending</td>
                           <td>9876543210</td>
                           <td>Time Waster</td>
                           <td>2025-07-01</td>
                           <td>Sydney</td>
                           <td>
                              <div class="dropdown no-arrow">
                                 <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                 </a>
                                 <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                    <a class="dropdown-item align-item-custom" href="#"> <i class="fa fa-edit"></i> Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item align-item-custom" href="#"> <i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                 </div>
                              </div>
                           </td>
                        </tr>
                        <!-- JS will inject filtered rows here -->
                     </tbody>
                  </table>
               </div>
            </div>
          </div>
          
      </div>
   </div>
   <!--middle content end here-->
</div>

@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>

<script>
   function filterResults() {
     const input = document.getElementById("searchMobile").value.trim();
     const rows = document.querySelectorAll("#resultsTable tbody tr");
   
     rows.forEach(row => {
       const mobile = row.cells[2].innerText;
       if (mobile.includes(input)) {
         row.style.display = "";
       } else {
         row.style.display = "none";
       }
     });
   }
   </script>
@endpush
