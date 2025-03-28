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

<div class="container-fluid">

    <!--middle content-->
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 ">
            <!-- Begin Page Content -->
            <div class="container-fluid" style="padding: 0px 0px;">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800 font-weight-500">Security Settings</h1>

                </div>


            </div>
            <!-- /.container-fluid --><br>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive-xl">
                        {{-- <table class="table" id="service-table"> --}}
                        <table class="table" id="securityDatatable">
                            <thead class="table-bg">
                                <tr>
                                    <th scope="col">

                                        <div class="form-check">
                                            {{-- <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"> --}}
                                            <label class="form-check-label"
                                                for="flexCheckDefault">Member ID</label>
                                        </div>
                                    </th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type </th>
                                    <th scope="col">Location </th>
                                    <th scope="col">Security Level  </th>
                                    <th scope="col">Status </th>
                                    <th scope="col">Action </th>
                                </tr>
                            </thead>
                            <tbody class="table-content">

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

<!-- Modal -->

@endsection
{{-- @section('script') --}}
@push('script')
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>

    $("#securityDatatable").DataTable({
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
            url: "{{ route('admin.management.allUserDatatable') }}",
            data: function (d) {
                d.type = 'player';
            }
        },
        columns: [
            { data: 'memberId', id: 'memberId', searchable: true, orderable:true,defaultContent: 'NA' },
            { data: 'name', name: 'name', searchable: true, orderable:true,defaultContent: 'NA' },
            { data: 'usertype', name: 'usertype', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'location', name: 'location', searchable: true, orderable:true, defaultContent: 'NA' },
            { data: 'sLevel', name: 'sLevel', searchable: true, orderable:true, defaultContent: 'NA' },
            { data: 'status', name: 'status', searchable: true, orderable:true, defaultContent: 'NA' },
            { data: 'action', name: 'action', searchable: false, orderable:false, defaultContent: 'NA' },
        ],
        aoColumnDefs:[
                       
                        {
                            "aTargets":[0],
                             "render": function (data) { return  "<a href='#' class='btn-primary'>"+data+"  </a>"; 
                            }
                        }
        ]
    });

    $('body').on('shown.bs.modal', '#save-service', function (e) {
        var button = e.relatedTarget;
        $('#service-cat').val($(button).data('category'));
        $('#service-name').val($(button).data('name'));
        $('#service-id').val($(button).data('id'));
    });

    $('body').on('hide.bs.modal', '#save-service', function (e) {
        $('#service-cat').val("");
        $('#service-name').val("");
        $('#service-id').val("");
        console.log('djsffffkd');
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
