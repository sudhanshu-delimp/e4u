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
    <div class="row ">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1" style="display: inline-block;">Videos</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="collapse" id="notes">
                <div class="card">
                    <div class="card-body">
                        <h2 class="NotesHeader"><b>Notes:</b> </h2>
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
        <div class="col-md-12 mb-3">    
            <div class="d-flex justify-content-end">
                <button type="button" class="create-tour-sec dctour" data-toggle="modal" data-target="#exampleModal">Add Videos</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="photo-top-header" style="
                ">
                <div class="photo-header border-0">
                    <div class="modal-header border-0 p-0" style="display: block;position: relative;top: 30%;">
                        <div class="row">
                            <div class="col-md-8">
                                {{-- <ul class="nav nav-tabs border-0">
                                    <li class="nav-item">
                                        <a class="nav-link show" id=" " data-toggle="tab" href="#home">All</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="menu1-tab" data-toggle="tab" href="#menu1">Verified</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="menu2-tab" data-toggle="tab" href="#menu2">Unverified</a>
                                    </li>
                                </ul> --}}
                                <h4 class="pl-3 text-white">All Videos</h4>
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
                                <div class="carousel-item custom-padding" id="cItem_{{$loop->index}}" data-id="{{$loop->index}}">
                                    <div class="row" id="dvSource">

                                        @foreach($medias as $key => $video)
                                            <div class="col-md-4" id="dm_{{$video->id}}">
                                                <a href="#" class="remove-video-icon">

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
        
        <div class="col-md-12 my-4">
            <div class="upload-photo-sec">
                <div class="d-sm-flex align-items-center justify-content-between p-3 custom-img-filter-header">
                    <h4 class="text-white">Default Video</h4>
                </div>
                {{-- <form id="my_avatar" action="#" method="POST" enctype="multipart/form-data">
                    <img class="img-fluid p-2" src="{{ asset('assets/app/img/img-14.png')}}">
                </form> --}}
                <div class="d-flex justify-content-start gap-10 mt-3">
                    <label class="newbtn dvDest" id="dvDest">
                        <video class="videoUp" id="img1" controls="" src="{{ asset($path)}}" controls poster="{{ asset('assets/dashboard/img/video-placeholder.png') }}">
                            <source id="akhVideo" src="{{ asset($path)}}" type="video/mp4" >
                        </video>
                        <input  type="hidden"  id="pos_1" name="position[1]" value="">
                    </label>
    
                    <label class="newbtn dvDest" id="dvDest">
                        <video class="videoUp" id="img2" controls="" src="{{ asset($path)}}" poster="{{ asset('assets/dashboard/img/video-placeholder.png') }}">
                            <source id="akhVideo" src="{{ asset($path)}}" type="video/mp4" >
                        </video>
                        <input  type="hidden"  id="pos_2" name="position[2]" value="">
                    </label>
    
                    <label class="newbtn dvDest" id="dvDest">
                        <video class="videoUp" id="img3" controls="" src="{{ asset($path)}}" poster="{{ asset('assets/dashboard/img/video-placeholder.png') }}">
                            <source id="akhVideo" src="{{ asset($path)}}" type="video/mp4" >
                        </video>
                        <input  type="hidden"  id="pos_3" name="position[3]" value="">
                    </label>
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
                                                <div class="photo-sec-popup video-sec-popup"  id="image_preview">
                                                   
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
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="submit" class="btn-success-modal">Verify Media</button> --}}
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
                <h5 class="modal-title text-white"> <img src="{{ asset('assets/dashboard/img/delete-video.png')}}" class="custompopicon"> Delete Video</h5>
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
                <button type="submit" class="btn-cancel-modal d_img" data-dismiss="modal" id="close">Cancel</button>
                <button type="submit" class="btn-success-modal d_img" id="dImg">Ok</button>
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
    $('.carousel').carousel({
        interval: false,
    });
</script>
<script>

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
            $('#image_preview').append("<a href='#'><div class='col-md-2 pl-0 wish_span rm_"+num+"' style='z-index: 1;'><video class='CustomVideoUp' controls=''></video></div></a>");
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
           },
           stop: function (event, ui) {

           }
       });
       $(".dvDest").droppable({
           drop: function (event, ui) {

               var video_target = $(this).find('video');
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

