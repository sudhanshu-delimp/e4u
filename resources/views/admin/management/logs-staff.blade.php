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
             {{-- Page Heading   --}}
            <div class="row">
                <div class="d-flex align-items-center justify-content-start mt-5 flex-wrap col-lg-12">
                    <h1 class="h1">Manage User</h1>
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
            <div class="row mt-2">
                <div class="col-sm-12 col-md-12 col-lg-12 ">
                    <!-- Begin Page Content -->
                    <div class="container-fluid" style="padding: 0px 0px;">
                        
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
                            <div class="table-responsive-xl">
                                <table class="table">
                                    <thead class="table-bg">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Last Login</th>
                                            <th scope="col">
                                                Registered
                                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                </svg>
                                            </th>
                                            <th scope="col">Type</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-content">
                                        <tr class="row-color">
                                            <td class="theme-color">E20000043</td>
                                            <td class="theme-color">Ewan Dev</td>
                                            <td class="theme-color">Australia</td>
                                            <td class="theme-color">ewan@clerkingservices.com.au</td>
                                            <td class="theme-color">01-03-2021</td>
                                            <td class="theme-color">26-05-20 01:04 PM </td>
                                            <td class="theme-color owner-sec" data-toggle="modal" data-target="#Competitor">
                                                <select class="form-control rounded-0 w-75">
                                <option class="text-secondary">Admin</option>
                                <option class="text-secondary">Staff</option>
                                <option class="text-secondary">Agent</option>
                                <option class="text-secondary">Viewer</option>
                                <option class="text-secondary">Advertiser</option>
                            </select>
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
    
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
<div class="modal fade upload-modal" id="Competitor" tabindex="-1" role="dialog" aria-labelledby="CompetitorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Competitor">Change Security Level</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0">
              <p class="pl-5 pr-5 pt-4 mb-0"> You’re about to change <b>Ewan Dev</b> Security Level from <b>Admin</b> to <b>Staff</b></p>
            </div>
            <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="background: #5D6D7E;border: #5D6D7E;">Cancel</button>
                <button type="button" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>
@endsection