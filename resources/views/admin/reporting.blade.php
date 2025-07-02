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
        <div class="container-fluid">
            <!--middle content-->
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 ">
                    <!-- Begin Page Content -->
                    <div class="container-fluid" style="padding: 0px 0px;">
                        {{-- Page Heading   --}}
                        <div class="row">
                            <div class="d-flex align-items-center justify-content-start mt-5 flex-wrap col-lg-12">
                                <h1 class="h1">Reporting</h1>
                                <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
                            </div>
                            <div class="col-md-12 my-2">
                                <div class="card collapse" id="notes" style="">
                                <div class="card-body">
                                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                                    <ol></ol>
                                </div>
                                </div>
                            </div>
                        </div>
                        {{-- end --}}
                        <div class="row ml-1 mb-3">
                            <div class="panel-heading">
                                <ul class="nav nav-tabs tab-sec" style="width: 68%;">
                                <li><a href="#tab1warning" data-toggle="tab" class="">New Advertisers</a></li>
                                <li><a href="#tab2warning" data-toggle="tab" class="">New Viewers</a></li>
                                <li><a href="#tab3warning" data-toggle="tab" class="">Users Online</a></li>
                                <li><a href="#tab4warning" data-toggle="tab" class="">Email Requests</a></li>
                                <li><a href="#tab5warning" data-toggle="tab" class="">Mobile Sim Requests</a></li>
                                <li class="active"><a href="#tab6warning" data-toggle="tab" class="active">Product Orders</a></li>
                                
                                <li><a href="#tab7warning" data-toggle="tab" class="">Visa Requests</a></li>
                                    <li><a href="#tab8warning" data-toggle="tab" class="">Advertiser Reviews</a></li>
                                    <li><a href="#tab9warning" data-toggle="tab" class="">Report Advertiser</a></li>
                                    <li><a href="#tab10warning" data-toggle="tab" class="">NUM Reports</a></li>
                                    <li><a href="#tab11warning" data-toggle="tab" class="">Punterbox Report</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-12 col-sm-12">
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
                            <div class="panel with-nav-tabs panel-warning">
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active show" id="tab1warning">
                                            <div class="table-responsive-xl">
                                                <table class="table">
                                                    <thead class="table-bg">
                                                        <tr>
                                                           <th scope="col">Email ID <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                                </svg></th>
                                                            <th scope="col">User ID</th>
                                                            <th scope="col">
                                                                Email 
                                                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                                </svg>
                                                            </th>
                                                            <th scope="col">
                                                                Name
                                                            </th>
                                                            <th scope="col">Comments <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                        <div class="tab-pane fade" id="tab2warning">
                                            New Viewers
                                        </div>
                                        <div class="tab-pane fade" id="tab3warning">
                                            <div class="table-responsive-xl">
                                                Users Online
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab4warning">
                                            <div class="table-responsive-xl">
                                                Email Requests
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab5warning">
                                            <div class="table-responsive-xl">
                                                Mobile Sim Requests
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab6warning">
                                            <div class="table-responsive-xl">
                                                Product Orders
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab7warning">
                                            <div class="table-responsive-xl">
                                                Visa Requests
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab8warning">
                                            <div class="table-responsive-xl">
                                                Advertiser Reviews
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab9warning">
                                            <div class="table-responsive-xl">
                                                Report Advertiser
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab10warning">
                                            <div class="table-responsive-xl">
                                                NUM Reports
                                            </div>
                                        </div>
                                         <div class="tab-pane fade" id="tab11warning">
                                            <div class="table-responsive-xl">
                                                Punterbox Report
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
    
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

@endsection