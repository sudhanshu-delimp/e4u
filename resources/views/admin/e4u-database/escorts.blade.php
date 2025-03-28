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
                        <div class="col-sm-12 col-md-12 col-lg-12 left-sidebar-bg">
                            <!-- Begin Page Content -->
                            <div class="container-fluid" style="padding: 0px 0px;">

                                <!-- Page Heading -->
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h1 class="h3 mb-0 text-gray-800 font-weight-500">E4U Escorts</h1>

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
                                                    <th scope="col">Account Name</th>
                                                    <th scope="col">Profile Name</th>
                                                    <th scope="col">Mobile Number</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Membership</th>
                                                    <th scope="col">Home State</th>
                                                    <th scope="col">Age</th>
                                                    <th scope="col">Vaccine</th>
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
                                                    <td class="theme-color"><span>Pending</span></td>
                                                    <td class="theme-color">Platinum</td>
                                                    <td class="theme-color">93939339</td>
                                                    <td class="theme-color">Female</td>
                                                    <td>12-03-2012</td>
                                                    <td>SA
                                                    </td>
                                                    <td>Vaccinated, up to date</td>
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
