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
        <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
            <!--middle content-->
            {{-- Page Heading   --}}
            <div class="row">
                <div class="custom-heading-wrapper col-md-12">
                    <h1 class="h1">Competitor Database</h1>
                    <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol></ol>
                    </div>
                    </div>
                </div>
            </div>
            {{-- end --}}
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 ">
                    <!-- Begin Page Content -->
                    <div class="container-fluid mt-2" style="padding: 0px 0px;">
                       
                        <div class="row">
                            
                            <div class="col-sm-12">
                                <div class="bothsearch-form">
                                    <button type="button" class="btn-common" data-toggle="modal" data-target="#Competitor">Add Competitor</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid --><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive-xl">
                                <table class="table" id="competitorDatabase">
                                    <thead class="table-bg">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Website</th>
                                            <th scope="col">Home Country</th>
                                            <th scope="col">Rating</th>
                                            <th scope="col">Date Added</th>
                                            <th scope="col ">
                                                Completed
                                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                </svg>
                                            </th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mayfair Confidential</td>
                                            <td>mayfairconfidential.com.au</td>
                                            <td>Australia</td>
                                            <td>2</td>
                                            <td>01-03-2021</td>
                                            <td><img src="{{ asset('assets/app/img/actionone.png')}}" class="img-fluid img_resize_in_smscreen"></td>
                                            <td>
                                                <div class="dropdown no-arrow ml-3">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                    </a>
                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Edit_Competitor"> <i class="fa fa-fw fa-pen"></i> Edit</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#"> <i class="fa fa-fw fa-trash"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Mayfair Confidential</td>
                                            <td>mayfairconfidential.com.au</td>
                                            <td>Australia</td>
                                            <td>2</td>
                                            <td>01-03-2021</td>
                                            <td>
                                                <img src="{{ asset('assets/app/img/actiontwo.png')}}" class="img-fluid img_resize_in_smscreen">
                                            </td>
                                            <td>
                                                <div class="dropdown no-arrow ml-3">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                    </a>
                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#" data-toggle="modal" data-target="#Edit_Competitor"> <i class="fa fa-fw fa-pen"></i> Edit</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="#"> <i class="fa fa-fw fa-trash"></i> Delete</a>
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
<div class="modal fade upload-modal" id="Competitor" tabindex="-1" role="dialog" aria-labelledby="CompetitorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="Competitor">Create Competitor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <form>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <input type="text" class="form-control rounded-0" placeholder="Competitor Name">
                        </div>
                        <div class="col-6 mb-3">
                            <input type="text" class="form-control rounded-0" placeholder="Competitor Website">
                        </div>
                        <div class="col-6 mb-3">
                            <input type="text" class="form-control rounded-0" placeholder="Rating">
                        </div>
                        <div class="col-6 mb-3">
                            <select class="form-control rounded-0">
                                <option>Choose Home Country</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <select class="form-control rounded-0">
                                <option>Select Home State</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" placeholder="Notes" rows="3"></textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="form-check-label pr-4" for="exampleCheck1">Entered Data</label>
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Completed</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer pt-0">
                <button type="button" class="btn-success-modal">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade upload-modal" id="Edit_Competitor" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="Edit_Competitor">Edit Competitor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <form>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <input type="text" class="form-control rounded-0" placeholder="Competitor Name">
                        </div>
                        <div class="col-6 mb-3">
                            <input type="text" class="form-control rounded-0" placeholder="Competitor Website">
                        </div>
                        <div class="col-6 mb-3">
                            <input type="text" class="form-control rounded-0" placeholder="Rating">
                        </div>
                        <div class="col-6 mb-3">
                            <select class="form-control rounded-0">
                                <option>Choose Home Country</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <select class="form-control rounded-0">
                                <option>Select Home State</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" placeholder="Notes" rows="3"></textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="form-check-label pr-4" for="exampleCheck1">Entered Data</label>
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Completed</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer pt-0">
                <button type="button" class="btn-success-modal">Update</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
  

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
      var table = $("#competitorDatabase").DataTable({
      language: {
         search: "Search: _INPUT_",
         searchPlaceholder: "Search by Name..."
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