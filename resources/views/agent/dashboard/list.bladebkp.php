@extends('layouts.agent')
@section('content')
<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">

                <!--middle content-->
                <div class="row">
                    <div class="col-md-9">
                        <!-- Begin Page Content -->
                        <div class="container-fluid" style="padding: 0px 0px;">

                            <!-- Page Heading -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">My Escorts</h1>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <form class="search-form-bg navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="search-form-bg-i form-control border-0 small"
                                                placeholder="Search " aria-label="Search"
                                                aria-describedby="basic-addon2">
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
                                <div class="col-md-3">
                                    <nav class="date-border navbar navbar-expand navbar-light">

                                        <ul class="navbar-nav">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    All Date
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right animated--grow-in"
                                                    aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>

                                                </div>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="col-md-3">
                                    <nav class="date-border navbar navbar-expand navbar-light">

                                        <ul class="navbar-nav">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Status
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right animated--grow-in"
                                                    aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="#">Done</a>
                                                    <a class="dropdown-item" href="#">Remain</a>

                                                </div>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>


                        </div>
                        <!-- /.container-fluid --><br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive-xl">
                                    <table class="table" id="agent-dataTable">
                                        <thead class="table-bg">
                                            <tr>
                                                <th>ID</th>
                                                <th>Name <svg width="17" height="16" viewBox="0 0 17 16"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z"
                                                            fill="white" />
                                                    </svg>
                                                </th>
                                                <th>Mobile Number</th>
                                                <th>Type</th>
                                                <th>State</th>
                                                <th>Joining Date<svg width="17" height="16"
                                                        viewBox="0 0 17 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z"
                                                            fill="white" />
                                                    </svg>
                                                </th>
                                                <th>Joined E4U</th>
                                                <!--<th>Joined E4U</th>-->
                                                <th >Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-content">

                                        </tbody>
                                    </table>
                                    <div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!--middle content end here-->
                    <!--right side bar start from here-->
                    <div class="col-md-3 right-sidebar-bg">

                        <div class="sidebar-box">
                            <img class="circle-bg" src="{{ asset('assets/app/img/group.svg') }}" alt="">
                            <div class="left"></div>
                            <div class="right">
                                <h4>{{ count($escorts) }}</h4>
                                <p>Total Escorts<br>
                                    <span><span style="color: #52df9b;margin-left: 18px;"><svg width="16"
                                                height="10" viewBox="0 0 16 10" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.2301 1L8.89681 7.33333L5.56348 4L0.563477 9"
                                                    stroke="#4BDE97" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            4.07% </span>Last Month</span>
                                </p>

                            </div>
                        </div>
                        <div class="sidebar-box">
                            <img class="circle-map-building-bg" src="{{ asset('assets/dashboard/img/building-map.svg') }}" alt="">
                            <div class="left"></div>
                            <div class="right">
                                <h4>1478 226</h4>
                                <p>Total Escorts<br>
                                    <span><span style="    color: #52df9b;margin-left: 18px;"><svg width="16"
                                                height="10" viewBox="0 0 16 10" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.2301 1L8.89681 7.33333L5.56348 4L0.563477 9"
                                                    stroke="#4BDE97" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            4.07% </span>Last Month</span>
                                </p>

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
    var table = $('#agent-dataTable').DataTable({
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
            url: "{{ route('agent.list.dataTable') }}",
            data: function (d) {
                d.type = 'player';
            }
        },
        columns: [
            { data: 'key', name: 'key', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'name', name: 'name', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'phone', name: 'phone', searchable: true, orderable:true,defaultContent: 'NA' },
            { data: 'gender', name: 'gender', searchable: true, orderable:true,defaultContent: 'NA' },
            { data: 'country_code', name: 'country_code', searchable: true, orderable:true,defaultContent: 'NA' },
            { data: 'start_date_parsed', name: 'start_date_parsed', searchable: true, orderable:true,defaultContent: 'NA' },
            { data: 'joined', name: 'joined', searchable: true, orderable:true,defaultContent: 'NA' },
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
        var table = $('#agent-dataTable').DataTable();
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post({
                    type: 'POST',
                    url: $this.attr('href')
                }).done(function (data) {
                    if(data.error == 0)
                    {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!',
                          footer: '<a href="">Why do I have this issue?</a>'
                        })
                    }else {
                        swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        );

                        table.row( $this.parents('tr') ).remove().draw();
                    }


                });
            } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
                )
            }
        });
            //alert('success');


    });
</script>
@endpush
