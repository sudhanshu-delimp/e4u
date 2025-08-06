@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<link rel="stylesheet" type="text/css" href="https://foliotek.github.io/Croppie/croppie.css">
<link href="{{ asset('assets/plugins/ajax/libs/jquery/jquery-ui.css') }} " rel="stylesheet" type="text/css" />
<style type="text/css">
    .parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
    }

    .item4 .fa-trash {
        position: absolute;
        right: 10px;
        top: 10px;
        color: #e73b3b;
        display: none;
    }
    .item4:hover .fa-trash {
        display: block;
    }
    .item4 {
        position: relative;
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 p-0">
                
                <div class="row mb-4">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="v-main-heading h3" style="display: inline-block;">Videos</div>
                                <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row collapse" id="notes">
                            <div class="col-md-12 mb-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                        <ol>
                                        <li>Upload your videos here (up to six) and then select your default videos to be included in your Profiles (up to three) (<b>Default Videos</b>).</li>
                                        <li>Your Default Videos will always appear in the Profile Creator when you activate the Profile Creator (for a new Profile). If you change any of the Default Videos in the Profile Creator, you will be asked if you want to update your changes to the Default Videos.</li>
                                        <li>When uploading your videos, make sure they comply with our <a href="/escort-dashboard/help" class="custom_links_design">Video</a> guidelines, especially in terms of the format type and the length of the video.</li>
                                        <li>Whilst you can upload up to six videos, please remember you can only display up to three in any Profile.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
    
                        <div style="float: inline-end;">
                                                <button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#exampleModal">Add Videos</button>
                                            </div>
                        </div>
                    {{-- <div class="col-md-2" style="padding-left: 7rem;">
                        <button type="button" class="btn btn-primary create-tour-sec dctour" data-toggle="modal" data-target="#exampleModal">Add Videos</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="upload-photo-sec">
                <div class="d-sm-flex align-items-center justify-content-between pt-4 pl-2">
                    <h1 class="h3 text-gray-800 mb-2 ml-2">Default Video</h1>
                </div>
                {{-- <form id="my_avatar" action="#" method="POST" enctype="multipart/form-data">
                    <img class="img-fluid p-2" src="{{ asset('assets/app/img/img-14.png')}}">
                </form> --}}
                <label class="newbtn dvDest" id="dvDest">
                <video class="videoUp" id="img1" controls="" src="{{ asset($path)}}">
                    <source id="akhVideo" src="{{ asset($path)}}" type="video/mp4" >
                </video>
                <input  type="hidden"  id="pos_1" name="position[1]" value="">
                </label>
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
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ round(100 * $media->count()/6) }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div style="display: flex;gap: 15px;">
                                    <p>{{ $media->count()}}/6</p>
                                    <img src="{{ asset('assets/app/img/Vector-2.png')}}" style="height: 21px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="archive-photo-sec">
                <div class="row blog">
                    <div class="col-md-12">
                        <div id="blogCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                            {{-- <ol class="carousel-indicators">
                                <li data-target="#blogCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#blogCarousel" data-slide-to="1" class=""></li>
                            </ol> --}}
                            <ul class="pagination ml-2 pl-1">


                                @for($i = 0; $i < ceil(count($media)/3); $i++ )
                                <li class="page-item " id="pageItem_{{$i}}" data-id="{{$i}}">
                                   <a data-target="#blogCarousel" data-slide-to="{{$i}}"  class="page-link" href="#">{{$i + 1}}</a>
                                </li>

                                @endfor


                             </ul>
                            <!-- Carousel items -->
                            <div class="carousel-inner">
                                @foreach($media->chunk(3)  as $keyId => $medias)
                                <div class="carousel-item" id="cItem_{{$loop->index}}" data-id="{{$loop->index}}">
                                    <div class="row pl-0 ml-0 pr-1 pb-3" id="dvSource">

                                        @foreach($medias as $key => $video)
                                            <div class="col-md-4" id="dm_{{$video->id}}">
                                            <a href="#">

                                                <video style="z-index: 1" controls="" data-id="{{$video->id}}" data-position="{{$video->position ? $video->position : ''}}" id="videoId_{{$video->id}}" src="{{ asset($video->path)}}" >
                                                    <source src="{{ asset($video->path)}}" type="video/mp4" >
                                                </video>
                                                <i class="fa fa-trash deleteimg" data-id="{{$video->id}}"></i>
                                            </a>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>
                                @endforeach

                                {{-- <div class="carousel-item">
                                    <div class="row pl-0 ml-0 pr-1 pb-3">
                                        <div class="col-md-4">
                                            <a href="#">
                                                <video poster="{{ asset('assets/app/img/unsplash_P-khwx2l5B0.png')}}" controls="" style="background: #0000006b;width: 307px;height: 481px;object-fit: cover;">
                                                    <source src="{{ asset('assets/app/img/mov_bbb.mp4')}}" type="video/mp4">
                                                </video>
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#">
                                                <video poster="{{ asset('assets/app/img/unsplash_pecs-5NKxhk.png')}}" controls="" style="background: #0000006b;width: 307px;height: 481px;object-fit: cover;">
                                                    <source src="{{ asset('assets/app/img/mov_bbb.mp4')}}" type="video/mp4">
                                                </video>
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#">
                                                <video poster="{{ asset('assets/app/img/unsplash_FekpRww0rmo.png')}}" controls="" style="background: #0000006b;width: 307px;height: 481px;object-fit: cover;">
                                                    <source src="{{ asset('assets/app/img/mov_bbb.mp4')}}" type="video/mp4">
                                                </video>
                                            </a>
                                        </div>
                                    </div>

                                </div> --}}
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
            <form id="mulitiVideos" method="POST" action="{{ route('escort.upload.videos.gallery')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content border-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><img src="/assets/dashboard/img/upload-videos.png" class="custompopicon" alt="cross"> Upload Videos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container p-0">
                                    <div class="row pl-2">
                                        <div class="col-12">
                                            <div class="row" style="">
                                                <div class="photo-sec-popup"  id="image_preview">
                                                    {{-- <div class="col-md-2 pl-0">
                                                        {{-- <video poster="{{ asset('assets/app/img/video-poster.png')}}" controls="" style="width: 135px;height: 190px;background: #0000006b;">
                                                            <source src="{{ asset('assets/app/img/mov_bbb.mp4')}}" type="video/mp4">
                                                            <source id="blah" class="item" src="mov_bbb.ogg" type="video/ogg">
                                                        </video> --}}
                                                        {{-- <input name="img[]" id="upload_videos" class="pis" onchange="preview_videos(this);" type="file" multiple>//picx--}}
                                                        {{-- <input name="img[10]" id="picx" class="pis" onchange="readURL(this);" type="file" accept="video/*">
                                                    </div> --}}
                                                    <div class="col-md-2 pl-0" id="img_for_showing"><label class="newbtn">

                                                        <img class="img-fluid" id="videonp" style="width:870px; height:192px;object-fit: cover;"src="{{ asset('assets/app/img/hand.jpg') }}">
                                                        <input name="videos[]" id="upload_videos" class="pis" onchange="preview_videos(this);" type="file" accept="video/*" multiple>

                                                        </label>
                                                        <video class="videoUp" id="blahx" controls="" style="display:none">


                                                        </video>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4 pt-1" style="border: 1px dotted;">
                                        <div class="col-6 pt-4 pb-4">
                                            <h4>Verify these Videos</h4>
                                            <ul style="text-align: justify;">
                                              <li>Two (2) selfies with your User Name and Membership ID printed (can be handwritten) on a sheet of paper held up to the side of you and not obscuring any part of you</li>
                                              <li>A drivers licence which matches your User Name and Home State</li>
                                              <li>A passport which matches your User Name and Home State</li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <div class="plate" style="position: relative;top: 30%;"><label class="newbtn">
                                                <img class="img-fluid" id="blah8" src="{{ asset('assets/app/img/upload-6.png')}}" style="width: 420px;height: 143px;object-fit: cover;">
                                                <input id="pic8" class="pis" onchange="readURL(this);" type="file" accept="image/*">
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
                        <button type="submit" class="btn-success-modal">Verify Media</button>
                        <button type="submit" class="btn-success-modal">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<div class="modal" id="videoModel" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                <span class="text-white">Delete Video</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                </span>
                </button>
            </div>
            <div class="modal-body">
                <h1 class="popu_heading_style mb-0 mt-4" style="text-align: center;">
                    <span id="img_comman_str"></span>
                    <span class="img_comman_msg"></span>
                </h1>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="submit" class="btn main_bg_color site_btn_primary d_img" data-dismiss="modal" id="close">Cancel</button>
                <button type="submit" class="btn main_bg_color site_btn_primary d_img" id="dImg">Ok</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="https://foliotek.github.io/Croppie/croppie.js"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/ajax/libs/jquery/jquery-ui.min.js') }}" type="text/javascript"></script>
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
                // if(input.id[3] == 8){
                //     $('.videoUp').hide();
                //     $('#videonp').show();
                // } else {
                //     $('.videoUp').show();
                // }

                //     $('#videonp').hide();
                    $('#blah'+input.id[3])
                        .attr('src', e.target.result);
                    $('#img'+input.id[3])
                    .attr('src', e.target.result);


            };

            reader.readAsDataURL(input.files[0]);

        }
            console.log("realpath = "+input.id[3]);
            console.log(e.target.result);
    }
    function preview_videos()
    {
        $(".rm").hide();
        $("#img_for_showing").hide();

        var total_file=document.getElementById("upload_videos").files.length;
        var video_files=document.getElementById("upload_videos").files;
        console.log(video_files);

        for(var i=0;i<total_file;i++)
        {
            var num = i+1;
            // <source src="+video_files[num]['name']+"></source>
            $('#image_preview').append("<a href='#'><div class='col-md-2 pl-0 wish_span rm_"+num+"' style='z-index: 1;'><video class='videoUp' controls=''></video></div></a>");
        }
        $(document).on('click','.deleteId', function(){
        var mid = $(this).attr('data-id');

        $(".rm_"+mid).remove();
        console.log("data "+ mid);

        });
        console.log("total_file = " +total_file);



    }
    $(document).ready(function(){
        $("body").on('submit','#mulitiVideos',function(e){
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var data = new FormData($('#mulitiVideos')[0]);
            // console.log( form.attr('action'))

            // console.log("url = "+form.attr('method'));

            for (let [key, value] of data) {
            console.log(key, value)
            }


            $.ajax({
                type: 'POST',
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    console.log(data.my_data.status);
                    if(data.my_data.status == 200){
                        console.log("done");
                        $('.comman_msg').html("Uploaded");
                        $("#comman_modal").modal('show');
                        window.location.href = data.my_data.url;
                        $('#comman_modal').on('hidden.bs.modal', function () {
                            window.location.href = data.my_data.url;
                        });


                    } else if(data.my_data.status == 405) {
                        console.log(data.my_data);
                        $('.comman_msg').html("<p>Can't upload more then 6 Videos</p>");  // Can't upload more then 30 Images
                        $("#comman_modal").modal('show');
                        $('#comman_modal').on('hidden.bs.modal', function () {
                            location.reload();
                        });
                    } else if(data.my_data.status == 1062) {
                        console.log(data.my_data);
                        $('.comman_msg').html("<p>Don't upload duplicate Videos</p>");  // Can't upload more then 30 Images
                        $("#comman_modal").modal('show');
                        $('#comman_modal').on('hidden.bs.modal', function () {
                            location.reload();
                        });
                    } else {
                        window.location.href = data.my_data.url;
                    }

                },
                error: function (data) {

                    var errors = $.parseJSON(data.responseText);
                    console.log(errors);
                    $('.comman_msg').html("<p>"+errors.message+"</p>");
                    $("#comman_modal").modal('show');
                    $('#comman_modal').on('hidden.bs.modal', function () {
                        location.reload();
                    });

                }
            });
        });

        ///////////////////delete video section
        $('body').on('click','.deleteimg', function () {
            var id = $(this).data('id');
            var vsrc = $("#videoId_"+id).attr('src');
            var dvsrc = $("#akhVideo").attr('src');
            console.log("vsrc =="+vsrc );
            console.log("dvsrc =="+dvsrc );
            var msg = "Delete";
            $('.img_comman_msg').text(msg);
            $("#videoModel").modal('show');
            //alert("hellog")
            $('#dImg').click(function () {


                var url = "{{ route('escort.delete.vedio.gallery',':id') }} ";
                url = url.replace(':id',id);

                $.ajax({
                    type: "POST",
                    url:url,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        console.log(data);
                        if(data.error == true) {
                            $("#dm_"+id).remove();
                            if (dvsrc == vsrc) {
                                $("#akhVideo").attr('src','') ;
                                $("#img1").attr('src','') ;

                            }
                            $("#videoModel").modal('hide');
                            location.reload();

                        } else {
                            var msg = "Sumthing wrong...";
                            $('.img_comman_msg').text(msg);

                        }
                    },
                    error: function (data) {
                        var errors = $.parseJSON(data.responseText);
                        $('.comman_msg').html("<p>"+errors.message+"</p>");
                        $("#comman_modal").modal('show');
                        $('#comman_modal').on('hidden.bs.modal', function () {
                            location.reload();
                        });


                    }
                });
            });

        });
    })
    $('#cItem_0').addClass(' active');
    $(function () {
       $("#dvSource video").draggable({
           revert: "invalid",
           helper: 'clone',
        appendTo: ".upload-photo-sec",
           refreshPositions: false,
           drag: function (event, ui) {


               //img_target.attr('data-id', ui.draggable.data('id'));

               // ui.helper.addClass("draggable");

            //    var srcc=$("#dvSource").find('img').attr('src');
            //    console.log("src="+srcc);
           },
           stop: function (event, ui) {
               // ui.helper.removeClass("draggable");
               // var image = this.src.split("/")[this.src.split("/").length - 1];
               // console.log("image = "+image);
               // if ($.ui.ddmanager.drop(ui.helper.data("draggable"), event)) {
               //     alert(image + " dropped.");
               // }
               // else {
               //     alert(image + " not dropped.");
               // }

           }
       });
       $(".dvDest").droppable({
           drop: function (event, ui) {
               // if ($("#dvDest img").length == 0) {
               //     var sc = $("#dvDest img").attr('src');
               //     console.log("src=" + sc);

               //     console.log("if ok");
               // }
               // ui.draggable.addClass("dropped");

               //$("#dvDest").append(ui.draggable[0]);
               //$("#myimg").append(ui.draggable);
               //console.log(ui.draggable.attr('src'));

               var video_target = $(this).find('video');


               //img_target.attr('data-id', ui.draggable.data('id'));
               var id = (video_target.attr('id'));
               var id_position = (video_target.attr('data-position'));

               console.log("video_src", video_target.attr('src'));
               $("#akhVideo").attr('src', video_target.attr('src'));
               $("#"+id).attr('src', video_target.attr('src'));
               var position = id.slice(3,4);
               console.log(position);
               var meidaId = ui.draggable.data('id');
               var src_v = ui.draggable.attr('src');




                $("#pos_"+id.slice(3,4)).val(ui.draggable.data('id'));
               // $("#usedf").append("<input type='hidden' name='imgId[]' value='"+ui.draggable.data('id')+"'>");
               // $('#item-id').draggable( "disable" )

               console.log("src ==  :"+ src_v);
               console.log("position :"+ position);
               console.log("meidaId :"+ meidaId);
                var url = "{{ route('escort.default.video') }} ";

                console.log(url);



                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            position: position,
                            meidaId: meidaId
                        },
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success : function (data) {
                            if(data.error == true) {
                                video_target.attr('data-id', ui.draggable.data('id'));
                                video_target.attr('src', ui.draggable.attr('src'));

                                    console.log(data);
                            } else {

                                    $('.comman_msg').html("<p>"+data.msg+"</p>");
                                    $("#comman_modal").modal('show');
                                    $('#comman_modal').on('hidden.bs.modal', function () {
                                    location.reload();
                                    });
                                    console.log("not data");

                                }
                        }
                    });

               //$(".useDefault").show();
           }

       });
   });
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

