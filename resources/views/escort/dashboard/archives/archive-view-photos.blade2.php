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
                        <li class="breadcrumb-item"><a href="{{ url()->previous() }}" style="
                            "><i class="fas fa-long-arrow-alt-left"></i>&nbsp;&nbsp;Back</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profiles & Archives - Media</li>
                    </ol>
                </nav>
                <div class="row mb-4">
                    <div class="col-md-10">
                        <h1 class="h3 mb-0 text-gray-800">Photos </h1>
                    </div>
                    <div class="col-md-2" style="padding-left: 7rem;">
                        <button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#exampleModal">Add Photos</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="upload-photo-sec">
                <div class="container">
                    <div class="d-sm-flex align-items-center justify-content-between pt-4">
                        <h1 class="h3 text-gray-800 mb-0">Default Images</h1>
                    </div>
                    <div class="row pt-3">
                        <div class="col-4 pr-0 pl-0">
                            <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                <img class="img-fluid" id="img1" src="{{ asset('assets/app/img/img-11.png')}}" style="object-fit: cover;width: 167px;height: 332px;">
                                </label>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="row" style="">
                                <div class="col-4 pr-0">
                                    <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                        <img class="img-fluid" id="img2" src="{{ asset('assets/app/img/img-12.png')}}">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4 pr-0">
                                    <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                        <img class="img-fluid"  id="img3" src="{{ asset('assets/app/img/img-12.png')}}">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4 pr-0">
                                    <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                        <img class="img-fluid"  id="img4" src="{{ asset('assets/app/img/img-12.png')}}">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="">
                                <div class="col-4 pr-0">
                                    <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                        <img class="img-fluid"  id="img5" src="{{ asset('assets/app/img/img-12.png')}}">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4 pr-0">
                                    <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                        <img class="img-fluid"  id="img6" src="{{ asset('assets/app/img/img-12.png')}}">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4 pr-0">
                                    <div class="plate"><label class="newbtn" data-toggle="modal" data-target="#upload-sec">
                                        <img class="img-fluid"  id="img7" src="{{ asset('assets/app/img/img-12.png')}}">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="about_me_drop_down_info pt-2">
                            <label class="newbtn" data-toggle="modal" data-target="#upload-sec-banner">
                            <img class="img-fluid pl-2 pr-2" id="img0" src="{{ asset('assets/app/img/img-13.png')}}">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="photo-top-header" style="
                ">
                <div class="photo-header border-0">
                    <div class="modal-header border-0 p-0" style="display: block;position: relative;top: 30%;">
                        <div class="row">
                            <div class="col-md-8">
                                <ul class="nav nav-tabs border-0">
                                    <li class="nav-item">
                                        <a class="nav-link show" id=" " data-toggle="tab" href="#home">All</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="menu1-tab" data-toggle="tab" href="#menu1">Verified</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="menu2-tab" data-toggle="tab" href="#menu2">Unverified</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-2 pt-1">
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div style="display: flex;gap: 15px;">
                                    <p>5/30</p>
                                    <img src="{{ asset('assets/app/img/Vector-2.png')}}" style="height: 21px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="archive-photo-sec">
                <div class="row">
                    <div class="col-md-12">
                        <div id="blogCarousel" class="carousel slide" data-interval="false" data-ride="carousel" data-interval="false">
                            <ol class="carousel-indicators">
                                <li data-target="#blogCarousel" data-slide-to="0" class=""></li>
                                <li data-target="#blogCarousel" data-slide-to="1" class="active"></li>
                            </ol>
                            <!-- Carousel items -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="archive-photo-sec">
                                        <div class="row">
                                            <div class="col-md-5 left-photo-sec">
                                                <img src="{{ asset('assets/app/img/Rectangle-1.png') }}" data-mdb-img="Rectangle-1.png" alt=" " class="img-fluid" style="
                                                    width: 386.250px;">
                                            </div>
                                            <div class="col-md-7 right-photo-sec pl-0">
                                                <img src="{{ asset('assets/app/img/Rectangle-5.png') }}" data-mdb-img="Rectangle-5.png" alt=" " class="img-fluid" style="width: 580px;">
                                                <div class="row pt-2" style="
                                                    ">
                                                    <div class="col-md-4 bottom-photo-sec" style="
                                                        "><img src="{{ asset('assets/app/img/Rectangle-2.png') }}" data-mdb-img="Rectangle-2.png" alt=" " class="img-fluid" style=""></div>
                                                    <div class="col-md-4 p-0" style="
                                                        "><img src="{{ asset('assets/app/img/Rectangle-3.png') }}" data-mdb-img="Rectangle-3.png" alt=" " class="img-fluid" style="
                                                        margin-left: -22px;
                                                        "></div>
                                                    <div class="col-md-4 p-0"><img src="{{ asset('assets/app/img/Rectangle-4.png') }}" data-mdb-img="Rectangle-4.png" alt=" " class="img-fluid" style="margin-left: -40px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--.row-->
                                </div>
                                <!--.item-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="blogCarousel" class="carousel slide" data-ride="carousel">
                                                <!-- <ol class="carousel-indicators">
                                                    <li data-target="#blogCarousel" data-slide-to="0" class="active"></li>
                                                    <li data-target="#blogCarousel" data-slide-to="1" class=""></li>
                                                    </ol> -->
                                                <!-- Carousel items -->
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <div class="archive-photo-sec">
                                                            <div class="row">
                                                                <div class="col-md-5 left-photo-sec">
                                                                    <img src="{{ asset('assets/app/img/Rectangle-1.png') }}" data-mdb-img="Rectangle-1.png" alt=" " class="img-fluid" style="
                                                                        width: 386.250px;">
                                                                </div>
                                                                <div class="col-md-7 right-photo-sec pl-0">
                                                                    <img src="{{ asset('assets/app/img/Rectangle-5.png') }}" data-mdb-img="Rectangle-5.png" alt=" " class="img-fluid" style="width: 580px;">
                                                                    <div class="row pt-2" style="
                                                                        ">
                                                                        <div class="col-md-4 bottom-photo-sec" style="
                                                                            "><img src="{{ asset('assets/app/img/Rectangle-2.png') }}" data-mdb-img="Rectangle-2.png" alt=" " class="img-fluid" style=""></div>
                                                                        <div class="col-md-4 p-0" style="
                                                                            "><img src="{{ asset('assets/app/img/Rectangle-3.png') }}" data-mdb-img="Rectangle-3.png" alt=" " class="img-fluid" style="
                                                                            margin-left: -22px;
                                                                            "></div>
                                                                        <div class="col-md-4 p-0"><img src="{{ asset('assets/app/img/Rectangle-4.png') }}" data-mdb-img="Rectangle-4.png" alt=" " class="img-fluid" style="margin-left: -40px;"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--.row-->
                                                    </div>
                                                </div>
                                                <!--.carousel-inner-->
                                            </div>
                                            <!--.Carousel-->
                                        </div>
                                    </div>
                                    <!--.row-->
                                </div>
                                <!--.item-->
                            </div>
                            <!--.carousel-inner-->
                        </div>
                        <!--.Carousel-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width: 900px;position: absolute;">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload Photos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="container p-0">
                                <div class="row p-0">
                                    <div class="col-12 p-0">
                                        <div class="photo-sec-popup">
                                            <a href="#">
                                                <div class="five_column_content_top img-title-sec d-flex justify-content-between wish_span" style="z-index: 1;">
                                                    <span class="card_tit" style="">Photo.img</span>
                                                    <i class="fa fa-trash"></i>   
                                                </div>
                                                <label class="newbtn">
                                                    <img id="blah1" class="item" src="{{ asset('escorts/attatchment/images/70/girl4.jpg')}}">
                                                    <figcaption>Edit</figcaption>
                                                    <input name="img[1]" id="pic1" class="pis" onchange="readURL(this);" type="file">
                                                    <input type="hidden" name="position[]" value="1">
                                                </label>
                                                <div style="margin-top: -34px;">
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="five_column_content_top img-title-sec d-flex justify-content-between wish_span" style="z-index: 1;">
                                                    <span class="card_tit" style="">Photo.img</span>
                                                    <i class="fa fa-trash"></i>   
                                                </div>
                                                <label class="newbtn">
                                                    <img id="blah1" class="item" src="{{ asset('escorts/attatchment/images/70/girl4.jpg')}}">
                                                    <figcaption>Edit</figcaption>
                                                    <input name="img[1]" id="pic1" class="pis" onchange="readURL(this);" type="file">
                                                    <input type="hidden" name="position[]" value="1">
                                                </label>
                                                <div style="margin-top: -34px;">
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="five_column_content_top img-title-sec d-flex justify-content-between wish_span" style="z-index: 1;">
                                                    <span class="card_tit" style="">Photo.img</span>
                                                    <i class="fa fa-trash"></i>   
                                                </div>
                                                <label class="newbtn">
                                                    <img id="blah1" class="item" src="{{ asset('escorts/attatchment/images/70/girl4.jpg')}}">
                                                    <figcaption>Edit</figcaption>
                                                    <input name="img[1]" id="pic1" class="pis" onchange="readURL(this);" type="file">
                                                    <input type="hidden" name="position[]" value="1">
                                                </label>
                                                <div style="margin-top: -34px;">
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="five_column_content_top img-title-sec d-flex justify-content-between wish_span" style="z-index: 1;">
                                                    <span class="card_tit" style="">Photo.img</span>
                                                    <i class="fa fa-trash"></i>   
                                                </div>
                                                <label class="newbtn">
                                                    <img id="blah1" class="item" src="{{ asset('escorts/attatchment/images/70/girl4.jpg')}}">
                                                    <figcaption>Edit</figcaption>
                                                    <input name="img[1]" id="pic1" class="pis" onchange="readURL(this);" type="file">
                                                    <input type="hidden" name="position[]" value="1">
                                                </label>
                                                <div style="margin-top: -34px;">
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="five_column_content_top img-title-sec d-flex justify-content-between wish_span" style="z-index: 1;">
                                                    <span class="card_tit" style="">Photo.img</span>
                                                    <i class="fa fa-trash"></i>   
                                                </div>
                                                <label class="newbtn">
                                                    <img id="blah1" class="item" src="{{ asset('escorts/attatchment/images/70/girl4.jpg')}}">
                                                    <figcaption>Edit</figcaption>
                                                    <input name="img[1]" id="pic1" class="pis" onchange="readURL(this);" type="file">
                                                    <input type="hidden" name="position[]" value="1">
                                                </label>
                                                <div style="margin-top: -34px;">
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="five_column_content_top img-title-sec d-flex justify-content-between wish_span" style="z-index: 1;">
                                                    <span class="card_tit" style="">Photo.img</span>
                                                    <i class="fa fa-trash"></i>   
                                                </div>
                                                <label class="newbtn">
                                                    <img id="blah1" class="item" src="{{ asset('escorts/attatchment/images/70/girl4.jpg')}}">
                                                    <figcaption>Edit</figcaption>
                                                    <input name="img[1]" id="pic1" class="pis" onchange="readURL(this);" type="file">
                                                    <input type="hidden" name="position[]" value="1">
                                                </label>
                                                <div style="margin-top: -34px;">
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="five_column_content_top img-title-sec d-flex justify-content-between wish_span" style="z-index: 1;">
                                                    <span class="card_tit" style="">Photo.img</span>
                                                    <i class="fa fa-trash"></i>   
                                                </div>
                                                <label class="newbtn">
                                                    <img id="blah1" class="item" src="{{ asset('escorts/attatchment/images/70/girl4.jpg')}}">
                                                    <figcaption>Edit</figcaption>
                                                    <input name="img[1]" id="pic1" class="pis" onchange="readURL(this);" type="file">
                                                    <input type="hidden" name="position[]" value="1">
                                                </label>
                                                <div style="margin-top: -34px;">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 pt-1" style="border: 1px dotted;">
                                    <div class="col-6 pt-4 pb-4">
                                        <h4>Verify these Photos</h4>
                                        <p>Upload a picture of your ID with your most recent photo for verification.</p>
                                    </div>
                                    <div class="col-6">
                                        <div class="plate"><label class="newbtn">
                                            <img class="img-fluid" id="blah8" src="{{ asset('escorts/attatchment/images/70/girl4.jpg')}}" style="width: 420px;height: 143px;object-fit: cover;">
                                            <input id="pic8" class="pis" onchange="readURL(this);" type="file">
                                            <input name="img[8]" id="pic8" class="pis" onchange="readURL(this);" type="file">
                                            <input type="hidden" name="position[]" value="8">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Upload</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
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
    
</script>
<script>
    $('.carousel').carousel({
    interval: false,
    });
</script>
<script>
    // $('.newbtn').bind("click" , function () {
    //        $('#pic').click();
    //        console.log($(this).attr('id'));
    // });
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah'+input.id[3])
                    .attr('src', e.target.result);
                $('#img'+input.id[3])
                    .attr('src', e.target.result);
            };
    
            reader.readAsDataURL(input.files[0]); 
            
        }
            console.log("file = "+input.id[3]);
    }
</script>
<style>
    .pis{
    display: none;
    }
    .newbtn{
    cursor: pointer;
    }
</style>
@endpush