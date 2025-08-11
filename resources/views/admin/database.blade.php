@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
    .swal-button {
    background-color: #242a2c;
    }
    #cke_1_contents {
    height: 200px !important;
    }
</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
            <!--middle content-->
            <div class="row">
                
                    {{-- Page Heading   --}}
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">Database</h1>
                        <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="card collapse" id="notes" style="">
                            <div class="card-body">
                                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                                <ol>                                    
                                </ol>
                            </div>
                        </div>
                    </div>
                {{-- end --}}
                <div class="col-sm-12 col-md-12 col-lg-12 mt-4">
                    <!-- Begin Page Content -->                        
                    <div class="mb-3">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs tab-sec pb-2">
                                <li class="active"><a href="#tab1warning" data-toggle="tab" class="active">Manage New Profile</a></li>
                                <li><a href="#tab2warning" data-toggle="tab" class="">Media Verification</a></li>
                                <li><a href="#tab3warning" data-toggle="tab" class="">Pin-Up Management</a></li>
                                <li><a href="#tab4warning" data-toggle="tab" class="">Agent List</a></li>
                                <li><a href="#tab5warning" data-toggle="tab" class="">User List</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel with-nav-tabs panel-warning">
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active show" id="tab1warning">
                                            <div class="table-responsive-xl">
                                                <table class="table" id="databaseTable">
                                                    <thead class="table-bg">
                                                        <tr>
                                                           <th scope="col">Alert Type <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                                </svg></th>
                                                            <th scope="col">Title</th>
                                                            <th scope="col">
                                                                Content 
                                                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                                </svg>
                                                            </th>
                                                            <th scope="col">
                                                                Notes 
                                                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                                </svg>
                                                            </th>
                                                            <th scope="col">Date Publised <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                                </svg></th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-content">
                                                        <tr class="row-color">
                                                            <td width="10%" class="theme-color">New Feature</td>
                                                            <td width="20%" class="theme-color">This is a new feature to be apply</td>
                                                            <td class="theme-color">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sapien nec sagittis  aliquam malesuada bibendum arcu.</td>
                                                            <td class="theme-color">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </td>
                                                            <td class="theme-color" width="15%">12/31/2022</td>
                                                            <td class="theme-color"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></td>
                                                        </tr>
                                                        <tr class="row-color">
                                                            <td width="10%" class="theme-color">New Feature</td>
                                                            <td width="20%" class="theme-color">This is a new feature to be apply</td>
                                                            <td class="theme-color">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sapien nec sagittis  aliquam malesuada bibendum arcu.</td>
                                                            <td class="theme-color">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </td>
                                                            <td class="theme-color" width="15%">12/31/2022</td>
                                                            <td class="theme-color"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></td>
                                                        </tr>
                                                        <tr class="row-color">
                                                            <td width="10%" class="theme-color">New Feature</td>
                                                            <td width="20%" class="theme-color">This is a new feature to be apply</td>
                                                            <td class="theme-color">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sapien nec sagittis  aliquam malesuada bibendum arcu.</td>
                                                            <td class="theme-color">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </td>
                                                            <td class="theme-color" width="15%">12/31/2022</td>
                                                            <td class="theme-color"><i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab2warning">
                                            Media Verification
                                        </div>
                                        <div class="tab-pane fade" id="tab3warning">
                                            <div class="table-responsive-xl">
                                                Pin-Up Management
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab4warning">
                                            <div class="table-responsive-xl">
                                                Agent List
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab5warning">
                                            <div class="table-responsive-xl">
                                                User List
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
  

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
      var table = $("#databaseTable").DataTable({
      language: {
         search: "Search: _INPUT_",
         searchPlaceholder: "Search by Title..."
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