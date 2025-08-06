@extends('layouts.center')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
    }
</style>
@endsection
@section('content')
<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                <!--middle content-->
                <div class="row">
                    <!-- Page Heading -->
                    <div class="custom-heading-wrapper col-lg-12">
                        <h1 class="h1">Bookkeeping</h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    $(document).ready( function () {
    //var table = $('#myTable').DataTable({
        var table = $('#ListTable').DataTable({
        "language": {
            "zeroRecords": "No record(s) found."
        },
        processing: true,
        serverSide: true,
        lengthChange: true,
        order: [0,'asc'],
        searchable:false,
        //searching:true,
        bStateSave: false,

        ajax: {
            url: "{{ route('center.list.dataTable') }}",
            data: function (d) {
                d.type = 'player';
            }
        },
        columns: [
            { data: 'key', name: 'key', searchable: true, orderable:false ,defaultContent: 'NA'},
            { data: 'name', name: 'name', searchable: true, orderable:false ,defaultContent: 'NA'},
            { data: 'phone_number', name: 'phone_number', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'location', name: 'location', searchable: true, orderable:false,defaultContent: 'NA' },
            // { data: 'country_code', name: 'country_code', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'start_date_parsed', name: 'start_date_parsed', searchable: true, orderable:false,defaultContent: 'NA' },
            // { data: 'joined', name: 'joined', searchable: true, orderable:false,defaultContent: 'NA' },
            { data: 'action', name: 'edit', searchable: false, orderable:false, defaultContent: 'NA' },
        ]
    });

    } );

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click','.delete-center', function(e){
        e.preventDefault();
        var $this = $(this);
        var table = $('#myTable').DataTable();
        $('#logoutModal').modal('show');
        $('.htext').html("Delete");
        $('.bodytext').html("Are you sure Do you want to delete ?");
        $('.btnok').html("Ok");
        //$('.btnok').attr("type","button");
        var url = $("#modalform").attr('action',$(this).attr('href'));



        console.log("url="+url);
        console.log($(this).attr('href'));
        console.log($(this).data('id'));

    });
    // $(document).on('click','.delete-center', function(e){
    //     e.preventDefault();
    //     var $this = $(this);
    //     var table = $('#myTable').DataTable();
    //     const swalWithBootstrapButtons = Swal.mixin({
    //     customClass: {
    //     confirmButton: 'btn btn-success',
    //     cancelButton: 'btn btn-danger'
    //     },
    //     buttonsStyling: false
    //     })

    //     swalWithBootstrapButtons.fire({
    //         title: 'Are you sure?',
    //         text: "You won't be able to revert this!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonText: 'Yes, delete it!',
    //         cancelButtonText: 'No, cancel!',
    //         reverseButtons: true
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.post({
    //                 type: 'POST',
    //                 url: $this.attr('href')
    //             }).done(function (data) {
    //                 if(data.error == 0)
    //                 {
    //                     Swal.fire({
    //                       icon: 'error',
    //                       title: 'Oops...',
    //                       text: 'Something went wrong!',
    //                       footer: '<a href="">Why do I have this issue?</a>'
    //                     })
    //                 }else {
    //                     swalWithBootstrapButtons.fire(
    //                     'Deleted!',
    //                     'Your file has been deleted.',
    //                     'success'
    //                     );

    //                     table.row( $this.parents('tr') ).remove().draw();
    //                 }


    //             });
    //         } else if (
    //         /* Read more about handling dismissals below */
    //         result.dismiss === Swal.DismissReason.cancel
    //         ) {
    //             swalWithBootstrapButtons.fire(
    //             'Cancelled',
    //             'Your imaginary file is safe :)',
    //             'error'
    //             )
    //         }
    //     });
    //         //alert('success');


    // });
</script>
@endpush
