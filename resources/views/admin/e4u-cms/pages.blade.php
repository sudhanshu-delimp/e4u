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
                        <div class="col-md-12">
                            <!-- Begin Page Content -->
                            <div class="container-fluid" style="padding: 0px 0px;">

                                <!-- Page Heading -->

                                <div class="d-flex align-items-center  mb-4">
                                    <h1 class="h3 mb-0 text-gray-800 font-weight-500">Pages</h1>
                                    <a href="#" class="super-btn-bg btn-primary btn-icon-split btn-lg">
                                        <span class="text">Add New Page</span>
                                    </a>

                                </div>

                                <div class="page-search-filter">
                                    <div class="left-all-published">
                                        <div class="allpublished">
                                            <div class="page-all-list">All <span>(06)</span> | </div>
                                            <div class="page-published">&nbsp; Published <span>(09)</span></div>
                                        </div>
                                        <div class="page-search">
                                            <form class="navbar-search">
                                                <div class="input-group page-btn-border-radius">
                                                    <div class="input-group-append">
                                                        <button class="btn" type="button">
                                                            <i class="fas fa-search fa-sm"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" class="form-control border-0 small" placeholder="Search Page" aria-label="Search" aria-describedby="basic-addon2">

                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="right-all-published">
                                        <div class="page-filter-form">
                                            <div>
                                                <form>
                                                    <div class="form-row align-items-center">
                                                        <div class="col-auto my-1">

                                                            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                                                <option selected="">Bulk Action</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-auto my-1">
                                                            <button type="submit" class="bulk-btn btn-primary">Apply
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div>
                                                <form>
                                                    <div class="form-row align-items-center">
                                                        <div class="col-auto">

                                                            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                                                <option selected="">Bulk Action</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-auto">
                                                            <button type="submit" class="bulk-btn btn-primary">Filter</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div>6 Items</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.container-fluid --><br>

                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table all-page-table">
                                    <thead>
                                        <tr class="bg">
                                            <th scope="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault"></label>
                                                </div> Page Title
                                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="#0C223D"></path>
                                                </svg>
                                            </th>
                                            <th scope="col">Slug</th>
                                            <th scope="col">Link Categories</th>
                                            <th scope="col">Editor</th>
                                            <th scope="col">Date
                                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="#0C223D"></path>
                                                </svg>
                                            </th>
                                            <th scope="col">Last Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="width25" scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault"></label>
                                                </div>Acceptable Use Policy<br>
                                                <div><a href="">Edit</a> <a href="">Duplicate</a> <a href="">View</a> <a href="">
                                                        View Edit Log</a> <a href="">Delete</a>
                                                </div>
                                            </th>
                                            <td>[ID: 1]
                                                Acceptable Use Policy | - /Acceptable Use Policy
                                            </td>
                                            <td>Footer links , Legal</td>
                                            <td>@Admin [name of admin]</td>
                                            <td>Published<br>
                                                2021/11/31 - 04:30 pm</td>
                                            <td>@Published<br>
                                                2021/11/31 - 04:30 pm</td>
                                        </tr>
                                        <tr class="bg">
                                            <th class="width25" scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault"></label>
                                                </div>Acceptable Use Policy<br>
                                                <div><a href="">Edit</a> <a href="">Duplicate</a> <a href="">View</a> <a href="">
                                                        View Edit Log</a> <a href="">Delete</a>
                                                </div>
                                            </th>
                                            <td>[ID: 1]
                                                Acceptable Use Policy | - /Acceptable Use Policy
                                            </td>
                                            <td>Footer links , Legal</td>
                                            <td>@Admin [name of admin]</td>
                                            <td>Published<br>
                                                2021/11/31 - 04:30 pm</td>
                                            <td>@Published<br>
                                                2021/11/31 - 04:30 pm</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


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