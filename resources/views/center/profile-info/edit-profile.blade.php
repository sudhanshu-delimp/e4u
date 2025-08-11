@extends('layouts.center')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
   .swal-button {
   background-color: #242a2c;
   }
</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div class="container-fluid">
   <!--middle content-->
   <div class="row">
      <div class="col-md-12">
         <!-- Begin Page Content -->
         <div class="container-fluid" style="padding: 0px 0px;">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
               <h1 class="h3 mb-0 text-gray-800">My Profiles</h1>
            </div>
            <div class="row">
               <div class="col-md-4">
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
            </div>
         </div>
         <!-- /.container-fluid --><br>
         <div class="row">
            <div class="col-md-12">
               <div class="box-body table table-hover">
                  <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                     <div class="dataTables_length" id="myTable_length">
                        <label>
                           Show
                           <select name="myTable_length" aria-controls="myTable" class="">
                              <option value="10">10</option>
                              <option value="25">25</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                           </select>
                           entries
                        </label>
                     </div>
                     <div id="myTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="myTable"></label></div>
                     <div id="myTable_processing" class="dataTables_processing" style="display: none;">Processing...</div>
                     <table class="table table-hover dataTable no-footer" id="myTable" role="grid" aria-describedby="myTable_info" style="">
                        <thead class="table-bg">
                           <tr role="row">
                              <th class="sorting_asc" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 32px;">ID</th>
                              <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" style="width: 133px;" aria-label="Profile Name
                                 : activate to sort column ascending">
                                 Profile Name
                                 <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                 </svg>
                              </th>
                              <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" style="width: 177px;" aria-label="Display Name
                                 : activate to sort column ascending">
                                 Display Name
                                 <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                 </svg>
                              </th>
                              <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" style="width: 75px;" aria-label="Location: activate to sort column ascending">Location</th>
                              <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" style="width: 129px;" aria-label="Mobile Number: activate to sort column ascending">Mobile Number</th>
                              <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" style="width: 128px;" aria-label="Joining Date
                                 : activate to sort column ascending">
                                 Joining Date
                                 <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                 </svg>
                              </th>
                              <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1" style="width: 58px;" aria-label="Status: activate to sort column ascending">Status</th>
                              <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 55px;" aria-label="Action">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr role="row" class="odd">
                              <td class="sorting_1">1</td>
                              <td>Naxa vvv</td>
                              <td>Sarah summerm</td>
                              <td>Noida</td>
                              <td>989565451</td>
                              <td>16 Feb 2022</td>
                              <td>Active</td>
                              <td>
                                 <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                       <a class="dropdown-item" href="../escort-profile/1" data-id="1">view</a>
                                       <div class="dropdown-divider"></div>
                                       <a class="dropdown-item" href="profile/1" data-id="1" data-name="Sarah summerm" data-category="1">Edit</a>
                                       <div class="dropdown-divider"></div>
                                       <a class="dropdown-item" href="#" data-id="1" data-name="Sarah summerm" data-city="Noida" data-url="playmates/1" data-toggle="modal" data-target="#play-mates-modal">Playmates</a>
                                       <div class="dropdown-divider"></div>
                                       <a class="dropdown-item delete-center" href="delete-profile/1" data-id="1">Delete </a>
                                       <div class="dropdown-divider"></div>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                     <div class="dataTables_info" id="myTable_info" role="status" aria-live="polite">Showing 1 to 10 of 39 entries</div>
                     <div class="dataTables_paginate paging_simple_numbers" id="myTable_paginate"><a class="paginate_button previous disabled" aria-controls="myTable" data-dt-idx="0" tabindex="0" id="myTable_previous">Previous</a><span><a class="paginate_button current" aria-controls="myTable" data-dt-idx="1" tabindex="0">1</a><a class="paginate_button " aria-controls="myTable" data-dt-idx="2" tabindex="0">2</a><a class="paginate_button " aria-controls="myTable" data-dt-idx="3" tabindex="0">3</a><a class="paginate_button " aria-controls="myTable" data-dt-idx="4" tabindex="0">4</a></span><a class="paginate_button next" aria-controls="myTable" data-dt-idx="5" tabindex="0" id="myTable_next">Next</a></div>
                  </div>
                  <div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--middle content end here-->
      <!--right side bar start from here-->
   </div>
</div>
<!-- End of Main Content -->
<!-- Footer -->
<footer class="sticky-footer bg-white">
   <div class="container my-auto">
      <div class="copyright text-center my-auto">
         <span> </span>
      </div>
   </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript">
   $('#userProfile').parsley({

   });



   $('#userProfile').on('submit', function(e) {
     e.preventDefault();

     var form = $(this);

     if (form.parsley().isValid()) {

       var url = form.attr('action');
       var data = new FormData(form[0]);
       $.ajax({
         method: form.attr('method'),
         url: url,
         data: data,
         contentType: false,
         processData: false,
         headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(data) {
           console.log(data);
           if (data.error == true) {
             $.toast({
               heading: 'Success',
               text: 'Details successfully saved',
               icon: 'success',
               loader: true,
                             position: 'top-right', // Change it to false to disable loader
                             loaderBg: '#9EC600' // To change the background
                           });
                           location.reload();

           } else {
             $.toast({
               heading: 'Error',
               text: 'Records Not update',
               icon: 'error',
               loader: true,
                             position: 'top-right', // Change it to false to disable loader
                             loaderBg: '#9EC600' // To change the background
                           });

           }
         },

       });
     }
   });





</script>
@endpush
