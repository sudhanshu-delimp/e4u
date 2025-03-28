
@extends('layouts.escort')
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

<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
  <ol class="breadcrumb bread-sec pl-0">
    <li class="breadcrumb-item"><a href="{{ url('escort-dashboard/archive-tours-list') }}" style="
"><i class="fas fa-long-arrow-alt-left"></i>&nbsp;&nbsp;Back To</a></li>
    <li class="breadcrumb-item active" aria-current="page">Manage Escorts - Tours</li>
  </ol>
</nav>
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Tours 2022 - {{$tours->name}} </h1> </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 pl-3">
                <form class="search-form-bg navbar-search">
                    <div class="input-group">
                        <input type="text" class="search-form-bg-i form-control border-0 small" placeholder="Search " aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn-right-icon" type="button"> <i class="fas fa-search fa-sm"></i> </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-2"> </div>
            <div class="col-md-3"> </div>
            {{-- <div class="col-md-3" style="padding-left: 7rem;">
                <button type="button" class="btn btn-primary create-tour-sec" data-toggle="modal" data-target="#exampleModal"> Create New Tour</button>
            </div> --}}
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title h3 mb-0 text-gray-800" id="exampleModalLongTitle">Create New Tour</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>
                        <form id="myTour" method="post" action="{{route('escort.store.tour')}}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-2">
                                    <label for="staticEmail2" class="sr-only">Tour Name</label>
                                    <input type="text" readonly="" class="form-control-plaintext" id="staticEmail2"  style="width: 90px;"> </div>
                                <div class="form-group mx-sm-3 mb-2">
                                    <input type="text" name="name" class="form-control" id=" " placeholder=" "> </div>
                            
                                <div id="accordion" class="myacording-design mb-0 pt-3">
                                    @include('escort.dashboard.archives.partials.tourModal')
                                </div>
                                <div class="col-md-12 p-0">
                                    <button type="button" class="btn btn-primary create-tour-sec w-100 addLocation">Add Location <i class="fa fa-fw fa-plus" style="color: #fff;"></i> </button>
                                </div>
                            </div>
                            <div class="modal-footer border-0 pt-5" style="justify-content: flex-start;">
                                <button type="submit" class="btn btn-secondary create-tour-sec">Save</button>
                                <button type="button" class="btn btn-primary create-tour-sec">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                    <table id="sailorTable" class="table table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>
                                    <div class="ckbox">
                                        <input type="checkbox" id="checkbox1"> </div>
                                </th>
                                <th>Location
                                    <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left: 20px;">
                                        <path d="M13.6139 15.125L10.4473 11.9583H12.8223V4.04167H10.4473L13.6139 0.875L16.7806 4.04167H14.4056V11.9583H16.7806L13.6139 15.125ZM0.947266 13.5417V11.9583H8.86393V13.5417H0.947266ZM0.947266 8.79167V7.20833H6.48893V8.79167H0.947266ZM0.947266 4.04167V2.45833H4.11393V4.04167H0.947266Z" fill="white"></path>
                                    </svg>
                                </th>
                                <th>Profile Name</th>
                                <th>Membership Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Days</th>
                                <th>Cost</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tours->tour_location as $key => $tour)
                            <tr class="tr-sec">
                                <td>
                                    <div class="ckbox">
                                        <input type="checkbox" id="checkbox1"> </div>
                                </td>
                                <td>{{$tours->locations[$key]['name']}}</td>
                                <td><img src="{{ asset('avatars/imageuser.png') }}" class="img-profile rounded-circle">&nbsp;&nbsp; {{$tours->profiles[$key]['profile_name']}}</td>
                                <td>{{$tours->profiles[$key]['membershiptype']}}</td>
                                <td>{{ $start_date = Carbon\Carbon::parse($tour->start_date)->format('d/m/Y') }}</td>
                                <td>{{ $end_date = Carbon\Carbon::parse($tour->end_date)->format('d/m/Y') }}</td>
                               <td>{{( Carbon\Carbon::parse($tour->end_date)->diffInDays(Carbon\Carbon::parse($tour->start_date)))}}</td>
                                <td>$100.00</td>
                               
                                {{-- <td>
                                    <div class="dropdown no-arrow archive-dropdown">
                                        <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style=""> <a class="dropdown-item" href="#">Edit <i class="fa fa-fw fa-pen" style="float: right;"></i></a> <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i> </a> <a class="dropdown-item" href="#">Duplicate <i class="fa fa-fw fa-clone" style="float: right;"></i> </a> </div>
                                    </div>
                                </td> --}}
                            </tr>
                            @endforeach
                            {{-- <tr class="tr-sec">
                                <td>
                                    <div class="ckbox">
                                        <input type="checkbox" id="checkbox1"> </div>
                                </td>
                                <td>Perth</td>
                                <td><img src="{{ asset('avatars/imageuser.png') }}" class="img-profile rounded-circle">&nbsp;&nbsp;Kathy -perth</td>
                                <td>Platinum</td>
                                <td>01/02/2022</td>
                                <td>02/02/2022</td>
                                <td>5</td>
                                <td>$100.00</td>
                                <td>
                                    <div class="dropdown no-arrow show archive-dropdown">
                                        <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item" href="#">Edit <i class="fa fa-fw fa-pen" style="float: right;"></i></a> <a class="dropdown-item" href="#">Delete <i class="fa fa-fw fa-trash" style="float: right;"></i> </a> <a class="dropdown-item" href="#">Duplicate <i class="fa fa-fw fa-clone" style="float: right;"></i> </a> </div>
                                    </div>
                                </td>
                            </tr> --}}
                            <tr class="tr-sec">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b class="pr-3">Total Days:</b>{{( Carbon\Carbon::parse($tours->end_date)->diffInDays(Carbon\Carbon::parse($tours->start_date)))}}</td>
                                <td><b class="pr-3">Total Cost:</b>$160.00</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>  
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    //$(document).ready( function () {
    var table = $('#myTable').DataTable({
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
            url: "{{ route('escort.list.dataTable') }}",
            data: function (d) {
                d.type = 'player';
            }
        },
        columns: [
            { data: 'key', name: 'key', searchable: false, orderable:true ,defaultContent: 'NA'},
            { data: 'profile_name', name: 'profile_name', searchable: false, orderable:true ,defaultContent: 'NA'},
            { data: 'name', name: 'name', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'city_name', name: 'city_name', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'phone', name: 'phone', searchable: true, orderable:true,defaultContent: 'NA' },
            { data: 'start_date_parsed', name: 'start_date_parsed', searchable: true, orderable:true,defaultContent: 'NA' },
            { data: 'enabled', name: 'enabled', searchable: false, orderable:true,defaultContent: 'NA' },
            { data: 'action', name: 'edit', searchable: false, orderable:false, defaultContent: 'NA' },
        ]
    });

    //} );

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click','.delete-center', function(e){
        e.preventDefault();
        var $this = $(this);
        var table = $('#myTable').DataTable();
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
    });

    $('#play-mates-modal').on('shown.bs.modal', function (e) {

        var name, city, source = e.relatedTarget;
        console.log($(source).data('url'));
        $('#hidden_escort_id').val($(source).data('id'));

        if(name = $(source).data('name')) {
            $('#playmate-modal-name').html('Playmates for ' + $(source).data('name'));
        }

        if(city = $(source).data('city')) {
            $('#playmate-modal-location').html('<svg width="14" height="21" viewBox="0 0 14 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 10C6.33696 10 5.70107 9.73661 5.23223 9.26777C4.76339 8.79893 4.5 8.16304 4.5 7.5C4.5 6.83696 4.76339 6.20107 5.23223 5.73223C5.70107 5.26339 6.33696 5 7 5C7.66304 5 8.29893 5.26339 8.76777 5.73223C9.23661 6.20107 9.5 6.83696 9.5 7.5C9.5 7.8283 9.43534 8.15339 9.3097 8.45671C9.18406 8.76002 8.99991 9.03562 8.76777 9.26777C8.53562 9.49991 8.26002 9.68406 7.95671 9.8097C7.65339 9.93534 7.3283 10 7 10V10ZM7 0.5C5.14348 0.5 3.36301 1.2375 2.05025 2.55025C0.737498 3.86301 0 5.64348 0 7.5C0 12.75 7 20.5 7 20.5C7 20.5 14 12.75 14 7.5C14 5.64348 13.2625 3.86301 11.9497 2.55025C10.637 1.2375 8.85652 0.5 7 0.5V0.5Z" fill="#FF3C5F"></path></svg>' + $(source).data('city'));
        }

        $.ajax({
            url: $(source).data('url'),
            success: function (data) {
                $('#playmate-template').html(data);
            }
        });
    });

    $('#play-mates-modal').on('hidden.bs.modal', function () {
        $('#playmate-template').html('<div class="spinner-border text-secondary" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div>');
        $('#playmate-modal-name').html('');
        $('#playmate-modal-location').html('');
    });

    $('#search-playmate-input').select2({
        dropdownParent: $("#play-mates-modal"),
        width: '100%',
        dropdownCssClass: "bigdrop",
        placeholder: {
            id: 0, // the value of the option
            text: "{{ asset('assets/app/img/service-provider/Frame-408.png') }}",
            name: 'Search playmate',
            member_id: 'Type name or member id',
        },
        allowClear: true,
        language: {
            inputTooShort: function() {
                return 'Enter Member Id or Name';
            }
        },
        createTag: function(params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: true // add additional parameters
            }
        },
        tags: false,
        minimumInputLength: 2,
        tokenSeparators: [','],
        ajax: {
            url: "{{ route('escort.playmates.find') }}",
            dataType: "json",
            type: "POST",
            data: function(params) {

                var queryParameters = {
                    query: params.term,
                    escort_id: $('#hidden_escort_id').val()
                }
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {

                        return {
                            text: item.default_image,
                            name: item.name,
                            member_id: item.member_id,
                            id: item.id
                        }
                    })
                };
            }
        },
        templateResult: formatEscortList,
        templateSelection: formatEscortList
    });

    $('#search-playmate-input').on('change', function(e) {
        console.log('ll',$(this).val());
        if($(this).val()) {
            $('#playmate_submit_button').show();
        } else {
            $('#playmate_submit_button').hide();
        }
    });

    function formatEscortList (data) {
        console.log('ckjoiujk;',data);
        return $('<span><img class="profile-user-img img-responsive img-circle img-profile rounded-circle small-round-fixed" src="'+data.text+'"> '+data.name+' || '+data.member_id+'</span>');
    }

    $('#add-playmate-form').on('submit', function(e) {
        e.preventDefault();
        $('#playmate_submit_button').attr('disabled', true);
        $('#playmate_submit_button').html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
        var $this = $(this);
        var escort_id = $('#hidden_escort_id').val();
        var member_id = $('#search-playmate-input').val();
        var url = $this.attr('action');
        $.post({
            type: $this.attr('method'),
            url: url,
            data: {
                escort_id: escort_id,
                playmate_id: member_id
            },
            success: function (data) {
                $('#search-playmate-input').val('');
                $('#playmate_submit_button').hide();
                $('#playmate-template').html(data);
            },
            error: function (data) {
                console.log(data);
            },
        }).done(function (data) {
            $('#playmate_submit_button').attr('disabled', false);
            $('#playmate_submit_button').html('Add Playmate');

            //$("#search-playmate-input").select2("val", "");

            $("#search-playmate-input").empty().trigger('change')
        });
    });

    $(document).on('click', '.remove-playmate', function(e) {
        e.preventDefault();

        var $this = $(this);
        var escort_id = $this.data('escort_id');
        var playmate_id = $this.data('playmate_id');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Remove',
            cancelButtonText: 'Cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post({
                    type: 'POST',
                    url: "{{ route('escort.playmates.remove') }}",
                    data: {
                        escort_id: escort_id,
                        playmate_id: playmate_id
                    },
                }).done(function (data) {
                    if(data.error == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message
                        });
                    } else {
                        swalWithBootstrapButtons.fire({
                            icon: 'success',
                            title: '',
                            text: data.message
                        });

                        $('#playmate-template').html(data.template);
                    }
                });
            }
        });
    });
    $(function () {
    var count = 1;
    var startid = $("#start_date_").attr('id','start_date_'+count);
    var endid = $("#end_date_").attr('id','end_date_'+count);
   
        $(".addLocation").click(function(){
            count += 1;
            
            console.log("hello="+ count);
            $('#accordion').append("@include('escort.dashboard.archives.partials.tourModalAppend')");
           $('#start_date_'+count).on('change', function()
            {
                console.log(count);
                $("#end_date_"+count).show();
                var val = $(this).val();
                var result = new Date(val);
                console.log("end date "+result);
                var ss = result.setDate(result.getDate() + 1);
                var first_date = moment(ss).format('YYYY-MM-DD');  
                
                    $("#end_date_"+count).attr({
                    "min" : first_date, 
                    "value" : first_date,         // values (or variables) here
                    });
                    console.log(first_date);
                    console.log(val);
                
            });
        })
        
        $("body").on('click','#start_date_'+count,function(){
            // $("#start_date_"+count).on('click', function() 
            // {
                var today = new Date();
                
                var start_date = moment(today).format('YYYY-MM-DD');  
                
                    $("#start_date_"+count).attr({
                    "min" : start_date,          // values (or variables) here
                    });
            // });
        });

        $("body").on('change','#start_date_'+count,function(){
        // $('#start_date_'+count).on('change', function()
        // {
            console.log(count);
            $("#end_date_"+count).show();
            var val = $(this).val();
            var result = new Date(val);
            console.log("end date "+result);
            var ss = result.setDate(result.getDate() + 1);
            var first_date = moment(ss).format('YYYY-MM-DD');  
            
                $("#end_date_"+count).attr({
                "min" : first_date, 
                "value" : first_date,         // values (or variables) here
                });
                console.log(first_date);
                console.log(val);
            
        });
    });
    $("#myTour").on('submit',function(e){
        e.preventDefault();
        console.log("hiii");
        var form = $(this);
        var url = form.attr('action');
        var data = new FormData($('#myTour')[0]);
        console.log(data);
        $.ajax({
            method: form.attr('method'),
            url:url,
            data:data,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                console.log(data);
                if(!data.error){
                    $.toast({
                        heading: 'Success',
                        text: 'Record successfully update',
                        icon: 'success',
                        loader: true,
                        position: 'top-right',      // Change it to false to disable loader
                        loaderBg: '#9EC600'  // To change the background
                    });
                    location.reload();
                } else {
                    $.toast({
                        heading: 'Error',
                        text: 'Records Not update',
                        icon: 'error',
                        loader: true,
                        position: 'top-right',      // Change it to false to disable loader
                        loaderBg: '#9EC600'  // To change the background
                    });
                   
                }
            }
        });

    })

</script>

@endpush
