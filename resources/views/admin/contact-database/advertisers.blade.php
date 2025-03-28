@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
   .swal-button {
   background-color: #242a2c;
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

                                <!-- Page Heading -->
                                <div class="d-flex align-items-center  mb-4">

                                    <div class="v-main-heading h3">Contacts – Advertisers</div>
                                    <a href="#" class="super-btn-bg btn-primary btn-icon-split btn-lg mt-5">
                                        <span class="text">Add New Contact</span>
                                    </a>

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
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-1">

                                    </div>
                                    <div class="col-lg-5 col-md-12 col-sm-12">
                                        <div class="bothsearch-form">
                                            <form>
                                                <div class="form-row align-items-center">
                                                    <div class="col-auto my-1 mr-2">

                                                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                                            <option selected="">All Dates</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                            <form>
                                                <div class="form-row align-items-center">
                                                    <div class="col-auto my-1">

                                                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                                            <option selected="">Status</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!-- /.container-fluid --><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive-xl">
                                        <table class="table">
                                            <thead class="table-bg">
                                                <tr>
                                                    <th scope="col">

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                            <label class="form-check-label" for="flexCheckDefault"></label>
                                                        </div>

                                                    </th>
                                                    <th scope="col">Name <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                        </svg>
                                                    </th>
                                                    <th scope="col">Mobile Number</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Competitor</th>
                                                    <th scope="col">State</th>
                                                    <th scope="col">Joining Date<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                        </svg>
                                                    </th>
                                                    <th scope="col">Joined E4U</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-content">
                                                <tr class="row-color">
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                            <label class="form-check-label" for="flexCheckDefault"></label>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <img src="img/imageuser.png">Kathryn Murphy
                                                    </td>
                                                    <td class="theme-color">23221222</td>
                                                    <td class="theme-color">Female</td>
                                                    <td class="theme-color">Australian Cracker</td>
                                                    <td class="theme-color">SA</td>
                                                    <td>12-03-2012</td>
                                                    <td><svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.625 0C5.125 0 0.625 4.5 0.625 10C0.625 15.5 5.125 20 10.625 20C16.125 20 20.625 15.5 20.625 10C20.625 4.5 16.125 0 10.625 0ZM10.625 18C6.215 18 2.625 14.41 2.625 10C2.625 5.59 6.215 2 10.625 2C15.035 2 18.625 5.59 18.625 10C18.625 14.41 15.035 18 10.625 18ZM15.215 5.58L8.625 12.17L6.035 9.59L4.625 11L8.625 15L16.625 7L15.215 5.58Z" fill="#4BDE97"></path>
                                                        </svg>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown no-arrow">
                                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                            </a>
                                                            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">

                                                                <a class="dropdown-item" href="#">Edit <img src="img/edit.svg" style="    float: right;"></a>
                                                                <div class="dropdown-divider"></div>
                                                                 <a class="dropdown-item" href="#">Delete <img src="img/delete.svg" style="    float: right;"></a>
                                                             

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="row-color">
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                            <label class="form-check-label" for="flexCheckDefault"></label>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <img src="img/imageuser.png">Kathryn Murphy
                                                    </td>
                                                    <td class="theme-color">23221222</td>
                                                    <td class="theme-color">Female</td>
                                                    <td class="theme-color">Australian Cracker</td>
                                                    <td class="theme-color">SA</td>
                                                    <td>12-03-2012</td>
                                                    <td><svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.625 18C6.215 18 2.625 14.41 2.625 10C2.625 5.59 6.215 2 10.625 2C15.035 2 18.625 5.59 18.625 10C18.625 14.41 15.035 18 10.625 18ZM10.625 0C5.095 0 0.625 4.47 0.625 10C0.625 15.53 5.095 20 10.625 20C16.155 20 20.625 15.53 20.625 10C20.625 4.47 16.155 0 10.625 0ZM13.215 6L10.625 8.59L8.035 6L6.625 7.41L9.215 10L6.625 12.59L8.035 14L10.625 11.41L13.215 14L14.625 12.59L12.035 10L14.625 7.41L13.215 6Z" fill="#E40000"></path>
                                                        </svg>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown no-arrow">
                                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                            </a>
                                                            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                                <a class="dropdown-item" href="#">Edit <img src="img/edit.svg" style="    float: right;"></a>
                                                                <div class="dropdown-divider"></div>
                                                                 <a class="dropdown-item" href="#">Delete <img src="img/delete.svg" style="    float: right;"></a>
                                                             


                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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