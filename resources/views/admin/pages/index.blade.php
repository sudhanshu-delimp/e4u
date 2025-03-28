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
                            <a href="{{route('admin.page.edit')}}" class="super-btn-bg btn-primary btn-icon-split btn-lg">
                            <span class="text">Add New Page</span>
                            </a>
                        </div>
                        <div class="page-search-filter">
                            <div class="left-all-published">
                                <div class="allpublished">
                                    <div class="page-all-list">All <span>({{ $page_count }})</span> | </div>
                                    <div class="page-published">&nbsp; Published <span>({{ $published_page_count }})</span></div>
                                </div>
                                <div class="page-search">
                                    <form class="navbar-search">
                                        <div class="input-group page-btn-border-radius">
                                            <div class="input-group-append">
                                                <button class="btn" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control border-0 small"
                                                placeholder="Search Page" aria-label="Search"
                                                aria-describedby="basic-addon2">
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
                                                    <select class="custom-select mr-sm-2"
                                                        id="inlineFormCustomSelect">
                                                        <option selected>Bulk Action</option>
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
                                                    <select class="custom-select mr-sm-2"
                                                        id="inlineFormCustomSelect">
                                                        <option selected>Bulk Action</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="submit"
                                                        class="bulk-btn btn-primary">Filter</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div>{{ $page_count }} Items</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid --><br>
                </div>
            </div>
            <div class="row">
                @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('status') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table all-page-table" id="pageDataTable">
                            <thead>
                                <tr class="bg">
                                    <th scope="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault"></label>
                                        </div>
                                        Page Title
                                        <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z"
                                                fill="#0C223D"></path>
                                        </svg>
                                    </th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Link Categories</th>
                                    <th scope="col">Editor</th>
                                    <th scope="col">
                                        Date
                                        <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z"
                                                fill="#0C223D"></path>
                                        </svg>
                                    </th>
                                    <th scope="col">Last Edit</th>
                                </tr>
                            </thead>
                            <tbody>
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
@endsection
@push('script')
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    $("#pageDataTable").DataTable({
        "language": {
            "zeroRecords": "No record(s) found."
        },
        processing: true,
        serverSide: true,
        lengthChange: true,
        order: [0,'asc'],
        searchable:false,
        //searching:false,
        bStateSave: false,
    
        ajax: {
            url: "{{ route('admin.pages.dataTable') }}",
            data: function (d) {
                d.type = 'player';
            }
        },
        columns: [
            { data: 'page_title', name: 'page_title', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'slug', name: 'slug', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'Link_categories', name: 'Link_categories', searchable: false, orderable:true ,defaultContent: 'NA'},
            { data: 'editor', name: 'editor', searchable: true, orderable:true,defaultContent: 'NA' },
            { data: 'date', name: 'date', searchable: true, orderable:true, defaultContent: 'NA' },
            { data: 'Last_date', name: 'Last_date', searchable: true, orderable:true, defaultContent: 'NA' },
        ]
    });
    
    
    
    $('#save-service-form').on('submit', function(e) {
        e.preventDefault();
    
        var form = $(this);
    
        var url = form.attr('action');
        var data = new FormData(form[0]);
    
        $.ajax({
            method: form.attr('method'),
            url:url + '/' + $('#service-id').val(),
            data:data,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                if(data.status){
    
                    form[0].reset();
                    $('#save-service').modal('hide');
    
                    swal({
                        title: "",
                        text: data.message,
                        icon: "success",
    
                        closeModal: true,
                        buttons: {
                            cancel: false,
                            ok:true
                        },
                    })
                    .then((value) => {
                        $("#service-table").DataTable().ajax.reload();
                    });
    
                } else {
                    swal({
                        title: "Oops!",
                        text: "Error! Unable to save service",
                        icon: "error",
                        closeModal: true,
                        buttons: {
                            cancel: false,
                            ok:true
                        },
                    });
                }
            },
            error :function( data ) {
                var response = $.parseJSON(data.responseText);
                swal({
    	title: "Oops!",
    	text: response.errors.toString(),
    	icon: "error",
    	closeModal: true,
    	buttons: {
    		cancel: false,
    		ok:true
    	},
    });
            }
        });
    });
    
    $('body').on('click', '.delete-service', function(e) {
    	var button = $(this);
    	var id = button.data('id');
    	console.log(button);
    	swal('Do you really want to remove delete this service',{
            dangerMode: true,
            buttons: ["Cancel", "Delete"],
        }).then((result) => {
            if (result) {
    
                var data = new FormData();
                data.append('job_id', button.data('job_id'));
                data.append('skill_id', button.data('id'));
    
                $.ajax({
                    type:'DELETE',
                    url: "{{route('admin.service.delete')}}" + '/' + id,
                    data:data,
                    cache:false,
                    contentType: false,
                    processData: false,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success:function(data) {
    
                        if(!data.error){
    
                            swal({
                                title: "",
                                text: data.message,
                                icon: "success",
    
                                closeModal: true,
                                buttons: {
                                    cancel: false,
                                    ok:true
                                },
                            })
                            .then((value) => {
                            	$("#service-table").DataTable().ajax.reload();
                            });
    
                        } else {
                            swal({
                                title: "Oops!",
                                text: data.message,
                                icon: "error",
                                closeModal: true,
                                buttons: {
                                    cancel: false,
                                    ok:true
                                },
                            });
                        }
                    },
                    error: function(data) {
                        $("#service-table").DataTable().ajax.reload();
                    }
                });
    
            } else {
                console.log('laksjkjskj');
            }
        });
    });
    
</script>
@endpush