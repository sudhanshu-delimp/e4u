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
                        <!-- Page Heading -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="v-main-heading h3">Global Monitoring</div>
                        </div>
                        <div class="row ml-1 mb-3">
                            <div class="panel-heading">
                                <ul class="nav nav-tabs tab-sec pb-2">
                                    <li class="active"><a href="#tab1warning" data-toggle="tab" class="">Online Advertisers</a></li>
                                    <li><a href="#tab2warning" data-toggle="tab" class="">Online Staff</a></li>
                                    <li><a href="#tab3warning" data-toggle="tab" class="">Online Viewers</a></li>
                                    <li><a href="#tab3warning" data-toggle="tab" class="">Online Visitors</a></li>
                                    <li><a href="#tab4warning" data-toggle="tab" class="active">Login Attemps</a></li>
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
                                                            <th scope="col">
                                                                <div id="mydiv" class="dropdown transparentbar">
                                                                    <button class="btn btn-default dropdown-toggle" type="button" id="mybyn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    All ID
                                                                    <span class="caret"></span></button>
                                                                    <ul class="dropdown-menu p-3 border-0">
                                                                        <li><a href="#">Action</a></li>
                                                                        <li><a href="#">Another action</a></li>
                                                                    </ul>
                                                                </div>
                                                            </th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">
                                                                Type 
                                                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                                </svg>
                                                            </th>
                                                            <th scope="col">
                                                                IP Address 
                                                                <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                                                </svg>
                                                            </th>
                                                            <th scope="col">Platform</th>
                                                            <th scope="col">Page</th>
                                                            <th scope="col">Last Acticity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-content">
                                                        <tr class="row-color">
                                                            <td class="theme-color">S60001</td>
                                                            <td class="theme-color">Wayne Primrose</td>
                                                            <td class="theme-color">S</td>
                                                            <td class="theme-color">192.168.1.548</td>
                                                            <td class="theme-color">Western Australia</td>
                                                            <td class="theme-color">Western Australia</td>
                                                            <td class="theme-color">Western Australia</td>
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
                                            Online Staff
                                        </div>
                                        <div class="tab-pane fade" id="tab3warning">
                                            <div class="table-responsive-xl">
                                                Online Viewers
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab4warning">
                                            <div class="table-responsive-xl">
                                                Login Attemps
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
<div class="modal fade upload-modal" id="Competitor" tabindex="-1" role="dialog" aria-labelledby="CompetitorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Competitor">New Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <select class="form-control rounded-0 p-1">
                                <option>To</option>
                                <option disabled="">sample@email.com</option>
                                <option>sample@email.com</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <select class="form-control rounded-0 p-1">
                                <option>Cc</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <input type="text" class="form-control rounded-0" placeholder="Subject">
                        </div>
                        <div class="col-12 mb-3">
                            <textarea class="form-control rounded-0" id="editor1" name="editor1" placeholder="Message" rows="5" cols="10"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer p-0 pl-2 pb-4">
                <button type="button" class="btn btn-primary mr-3">Send</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade upload-modal" id="Edit_Competitor" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Edit_Competitor">Edit Competitor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body">
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
                            <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Notes" rows="3"></textarea>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade upload-modal" id="New-Mail" tabindex="-1" role="dialog" aria-labelledby="New-Mail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="New-Mail">Edit Competitor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body p-4 pb-0">
                <form>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="form-check-label pr-1" for="exampleCheck1">Date:</label>
                                <label class="form-check-label font-weight-light" for="exampleCheck1">01/02/22</label>
                                <label class="pl-3 form-check-label pr-1" for="exampleCheck1">Time:</label>
                                <label class="form-check-label font-weight-light" for="exampleCheck1">5:02 PM</label>
                            </div>
                            <div class="form-group">
                                <label class="form-check-label pr-1" for="exampleCheck1">From:</label>
                                <label class="form-check-label" for="exampleCheck1"><img src="{{ asset('assets/app/img/profile-img.png')}}" class="img-profile rounded-circle playmats-img "></label>
                                <label class="form-check-label font-weight-light" for="exampleCheck1">Wayne Primrose</label>
                                <label class="pl-3 form-check-label pr-1" for="exampleCheck1">CC:</label>
                                <label class="form-check-label font-weight-light" for="exampleCheck1">sample@email.com</label><label class="pl-2 form-check-label font-weight-light" for="exampleCheck1">sample4@email.com</label>
                            </div>
                            <div class="form-group pt-3">
                                <label class="form-check-label pr-1" for="exampleCheck1">Subject:</label>
                                <label class="form-check-label" for="exampleCheck1">New local updates</label>
                            </div>
                            <div class="form-group pt-4">
                                <textarea class="form-control rounded-0" name="summernote" id="summernote" placeholder=" " rows="8" cols="30"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer pr-3">
                <button type="button" class="btn btn-primary"><img src="{{ asset('assets/app/img/repeat.png')}}" class="img-profile pr-2">Reply</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#summernote').summernote({height: 300});
</script>
<script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor1', {
       fullPage: true,
       extraPlugins: 'docprops',
       // Disable content filtering because if you use full page mode, you probably
       // want to  freely enter any HTML content in source mode without any limitations.
       allowedContent: true,
       height: 320
    });
</script>
<script type="text/javascript">
    var colors = ["red", "blue", "green", "yellow", "brown", "black"];
    var elt = $('#my-tags');
    
    elt.tagsinput('input').typeahead({
        local: colors,
        prefetch: '/assets/data/countries.json'
    }).bind('typeahead:selected', $.proxy(function (obj, datum) {
        this.tagsinput('add', datum.value);
        this.tagsinput('input').typeahead('setQuery', '');
    }, elt));
</script>
@endsection