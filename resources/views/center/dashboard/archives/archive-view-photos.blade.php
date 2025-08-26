@extends('layouts.center')
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
    img.img-thumbnail.defult-image {
    width: 190px;
    height: 135px;
    object-fit: cover;
}
    .grid-container {
    display: grid !important;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
    gap: 10px;
}
    .draggable
    {
        filter: alpha(opacity=60);
        opacity: 0.6;
    }
    .dropped
    {
        position: static !important;
    }
    .pis{
    display: none;
    }
    .newbtn{
    cursor: pointer;
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <div class="row">    
        <div class="custom-heading-wrapper col-md-12">
           <h1 class="h1">Photos</h1>
           <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
           <div class="card collapse" id="notes" style="">
              <div class="card-body">
                 <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                 <ol>
                       <li>Use these help pages for explanations and guidance on managing all of your Masseur
                          Photos.</li>
                       <li>You can upload four photos for each Masseur. Designate one as the Masseur's
                          Thumbnail.</li>
                       <li>Activate up to eight Masseur Profiles at any one time to appear the Massage Centre
                          Profile.</li>
                 </ol>
              </div>
           </div>
        </div>
    </div>
        <div class="row">
            <div class="col-md-12 mb-3 d-flex justify-content-end">
                <button type="button" class="create-tour-sec dctour" data-toggle="modal" data-target="#exampleModal">Add Photos</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="upload-photo-sec">
                    <div class="container">
                        <div class="d-sm-flex align-items-center justify-content-between pt-4">
                        </div>
                        <form id="defaultImage" method="post" enctype="multipart/form-data" action="{{ route('center.default.images')}}">
                            @csrf
                            <div class="row pt-3">
                                
                                <div class="col-4 pr-0 pl-0">
                                    <h2 class="banner-sub-heading my-2 font-weight-bold">Thumbnail</h2>
                                    <div class="plate">
                                        <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec" id="dvDest">
                                            <img class="img-fluid" id="img1" src="{{ asset($path->findByposition(auth()->user()->id,1)['path']) }}" style="object-fit: cover;width: 167px;height: 172px;">
                                            <input type="hidden" id="pos_1" name="position[1]" value="">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="row" style="">
                                        <div class="col-lg-12">
                                            <h2 class="banner-sub-heading my-2 font-weight-bold">Default Image</h2>
                                        </div>
                                        <div class="col-4 pr-0">
                                            <div class="plate">
                                                <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec">
                                                    <img class="img-fluid" id="img2" src="{{ asset($path->findByposition(auth()->user()->id,2)['path'])}}">
                                                    <input type="hidden" id="pos_2" name="position[2]" value="">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-4 pr-0">
                                            <div class="plate">
                                                <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec">
                                                    <img class="img-fluid"  id="img3" src="{{ asset($path->findByposition(auth()->user()->id,3)['path'])}}">
                                                    <input type="hidden" id="pos_3" name="position[3]" value="">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-4 pr-0">
                                            <div class="plate">
                                                <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec">
                                                    <img class="img-fluid"  id="img4" src="{{ asset($path->findByposition(auth()->user()->id,4)['path'])}}">
                                                    <input type="hidden" id="pos_4" name="position[4]" value="">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="about_me_drop_down_info pt-2">
                                    <label class="newbtn dvDest" data-toggle="modal" data-target="#upload-sec-banner">
                                        <img class="img-fluid pl-2 pr-2" id="img9" src="{{ asset($path->findByposition(auth()->user()->id,9)['path'])}}" style="width: 460px;height: 138px;object-fit: cover;">
                                        <input  type="hidden"  id="pos_9" name="position[9]" value="">
                                    </label>
                                </div> --}}

                            </div>
                            <div class="col-md-2" style="padding-left: 7rem;">
                                <button type="submit" class="btn btn-primary create-tour-sec useDefault">Use Deafult</button>
                            </div>
                            <div id="usedf">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="photo-top-header" style="">
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
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$media->count() * 3.3}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div style="display: flex;gap: 15px;">
                                        <p>{{$media->count()}}/6</p>
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
                            <div id="pagination-container"></div>
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-wrap="false" data-bs-ride="carousel">
                            
                                <ul class="pagination ml-2 pl-1">
                                    <!-- Declare the item in the group -->
                                    <li class="page-item preview">
                                    <!-- Declare the link of the item -->
                                        <a class="page-link" href="#carouselExampleIndicators" id="preId">‹‹</a>
                                    </li>
                                    <li class="page-item  active" id="pageItem_0" data-id="0">
                                    <a data-target="#carouselExampleIndicators" data-slide-to="0" class="page-link" href="#">1</a>
                                    </li>
                                    {{-- <li class="page-item " id="pageItem_1" data-id="1">
                                        <a data-target="#carouselExampleIndicators" data-slide-to="1" class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item " id="pageItem_2" data-id="2">
                                        <a data-target="#carouselExampleIndicators" data-slide-to="2" class="page-link" href="#">3</a>
                                    </li> --}}
                                    <li class="page-item nextOne">
                                    <a class="page-link" href="#carouselExampleIndicators" id="nextId">››</a>
                                    </li>
                                </ul>
                                <div class="container pt-2" style="padding-left: 0.75rem;padding-right: 0.75rem;">
                                    <div class="carousel-inner" id="view_all">
                                        <div class="carousel-item active" id="cItem_0" data-id="0">
                                            <div class="grid-container" id="dvSource">
                                                <div class="item4" id="dm_142">
                                                    <img class="img-thumbnail defult-image ui-draggable" src="http://127.0.0.1:8000/escorts/images/104/perth-landscape.jpg" alt=" " data-id="142" data-position="3">
                                                    <i class="fa fa-trash deleteimg" data-id="142" title="Remove this media"></i>                                        
                                                    <span class="badge badge-red">Gallery</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--.Carousel-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
<div class="modal delete" id="pesrmissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header main_bg_color border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"> <span aria-hidden="true">

                </span>
                 </button>
            </div>
            <div id="addTourForm1">


                    <div class="col-md-12 p-0">
                        <span id="msg">  </span>
                    </div>
                    <input type="hidden" id="deleteId" value="">
                    <div class="modal-footer border-0 pt-5" style="justify-content: flex-start;">
                        <button type="submit" class="btn-success-modal permission">Ok</button>
                        <button type="button" class="btn-cancel-modal nopermission" data-dismiss="modal" aria-label="Close">close</button>
                    </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="width: 900px;position: absolute;">
            <form id="mulitiImage" method="POST" action="{{ route('center.upload.gallery')}}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><img src="{{ asset('assets/dashboard/img/upload-photos.png')}}" class="custompopicon"> Upload Photos</h5>
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
                                        <div class="photo-sec-popup massage-photo-popup"  id="image_preview">
                                            <a href="#">
                                                <div class="five_column_content_top img-title-sec justify-content-between wish_span rm" style="z-index: 1;">
                                                   
                                                </div>
                                                <label class="newbtn rm">
                                                    <img id="blah" class="item" src="{{ asset('assets/app/img/upload-1.png')}}">
                                                    <input name="img[]" id="upload_file" class="pis" onchange="preview_image(this);" type="file" multiple>

                                                </label>
                                                <div style="margin-top: -34px;">
                                                </div>
                                            </a>
                                            {{-- @foreach($media as $key => $img)
                                            <a href="#">
                                                <div class="five_column_content_top img-title-sec d-flex justify-content-between wish_span" style="z-index: 1;">
                                                    <span class="card_tit" style="">Photo.img</span>
                                                    <i class="fa fa-trash deleteId" data-id="{{$img->id}}"></i>
                                                </div>
                                                <label class="newbtn">
                                                    <img id="blah1" class="item" src="{{ asset($img->path) }}">
                                                    <figcaption>Edit</figcaption>
                                                    <input type="hidden" name="position[]" value="{{$img->position}}">
                                                </label>
                                                <div style="margin-top: -34px;">
                                                </div>
                                            </a>
                                             @endforeach --}}
                                           {{--  <a href="#">
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
                                            </a> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 pt-1" style="border: 1px dotted;">
                                    <div class="col-6 pt-4 pb-4">
                                        <h4>Verify these Photos</h4>
                                        <p>Upload a picture of your ID with your most recent photo for verification.</p>
                                    </div>
                                    {{-- <div class="col-6">
                                        <div class="plate">
                                            <label class="newbtn rm">
                                                <img class="img-fluid" id="blah8" src="{{ asset('escorts/attatchment/images/70/girl4.jpg')}}" style="width: 420px;height: 143px;object-fit: cover;">
                                                <input name="img[8]" id="pic8" class="pis" onchange="readURL(this);" type="file">
                                                <input type="hidden" name="position[]" value="8">
                                            </label>
                                        </div>
                                    </div> --}}
                                    <div class="col-6">
                                        <div class="plate"><label class="newbtn">
                                        <img class="img-fluid" id="blah8" src="{{ asset($path->findByposition(auth()->user()->id,8)['path']) }}" style="height: 138px;object-fit: cover;width: 370px;">
                                            <input name="img[8]" id="pic8" data-id="8" class="pis" onchange="readURL(this);" type="file">
                                            {{-- <input type="hidden" name="position[]" id="mediaId8"> --}}
                                            <input type="hidden" name="selected_files[]" value="8">
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
<div class="modal" id="comman_modal" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                <h5 class="modal-title text-white">
                    <img src="{{ asset('assets/dashboard/img/upload-photos.png')}}" class="custompopicon"> Upload Photos
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                </span>
                </button>
            </div>
            <div class="modal-body">
                <h1 class="popu_heading_style mb-0 mt-4" style="text-align: center;">
                <span id="comman_str"></span>
                <span class="comman_msg"></span>
                </h1>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="submit" class="btn main_bg_color site_btn_primary" data-dismiss="modal" id="close">Ok</button>
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
    function preview_image()
    {
        $(".rm").hide();
        var total_file=document.getElementById("upload_file").files.length;
        for(var i=0;i<total_file;i++)
        {
            var num = i+1;
            $('#image_preview').append("<a href='#'><div class='five_column_content_top img-title-sec justify-content-between wish_span rm_"+num+"' style='z-index: 1;'><span class='card_tit' style=''>Photo.img</span><i class='fa fa-trash deleteId' data-id='"+num+"'></i></div><label class='newbtn rm_"+num+"'><img id='blah"+num+"' class='item' src='"+URL.createObjectURL(event.target.files[i])+"'><figcaption id='edit_"+num+"' class='cropEdit' value='"+num+"'>Edit</figcaption><input type='hidden' name='selected_files[]' value='"+i+"'></label><div style='margin-top: -34px;'></div></a>");
        }
        $(document).on('click','.deleteId', function(){
        var mid = $(this).attr('data-id');

        $(".rm_"+mid).remove();
        console.log("data "+ mid);

        });
        console.log("total_file = " +total_file);



    }

    $("body").on('click','.cropEdit',function(){
        var id = $(this).attr('id');
        var val = $(this).attr('value');
        var src = $("#blah"+val).attr('src');
        console.log("id = " +id);
        console.log("val = " +src);
    });
    $("body").on('submit','#mulitiImage',function(e){
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var data = new FormData($('#mulitiImage')[0]);
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
                console.log(data.my_data);
                if(data.my_data.status == 200){
                    console.log("done");
                    $('.comman_msg').html("Uploaded");
                    $("#comman_modal").modal('show');
                    //window.location.href = data.my_data.url;
                    $('#comman_modal').on('hidden.bs.modal', function () {
                        window.location.href = data.my_data.url;
                    });


                } else if(data.my_data.status == 405) {
                    console.log(data.my_data);
                    $('.comman_msg').html("<p>Can't upload more then 30 Images</p>");  // Can't upload more then 30 Images
                    $("#comman_modal").modal('show');
                    $('#comman_modal').on('hidden.bs.modal', function () {
                        location.reload();
                    });
                }
                 else {

                    console.log(data.my_data.msg);
                    $('.comman_msg').html("<p>"+data.my_data.msg+"</p>");
                    $("#comman_modal").modal('show');
                    $('#comman_modal').on('hidden.bs.modal', function () {
                        window.location.href = data.my_data.url;
                    });
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
</script>



    <script type="text/javascript">
        $(".useDefault").hide();
        $(function () {
            $("#dvSource img").draggable({
                revert: "invalid",
                helper: 'clone',
                refreshPositions: false,
                drag: function (event, ui) {
                    // ui.helper.addClass("draggable");
                    // var srcc=$("#dvSource").find('img').attr('src');
                    // console.log("src="+srcc);
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

                    var img_target = $(this).find('img');

                    img_target.attr('src', ui.draggable.attr('src'));
                    img_target.attr('data-id', ui.draggable.data('id'));
                    var id = (img_target.attr('id'));
                    var position = id.slice(3,4);
                    var meidaId = ui.draggable.data('id');
                    $("#pos_"+id.slice(3,4)).val(ui.draggable.data('id'))
                    // $("#usedf").append("<input type='hidden' name='imgId[]' value='"+ui.draggable.data('id')+"'>");
                    console.log("position :"+position);
                    console.log("meidaId :"+meidaId);
                    var url = "{{ route('center.default.images') }} ";
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
                                console.log(data);
                            } else {

                                console.log("not data");

                            }
                        }
                    });

                    //$(".useDefault").show();
                }

            });
        });
        $("#defaultImage").on('submit',function(e){
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        //console.log("hii"+ src);
        var data = new FormData($('#defaultImage')[0]);
            $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                // contentType: false,
                // processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    console.log(data);
                    if(data.error == true) {
                        var msg = "Saved";
                        // var url = "{{asset('avatars/name')}}";
                        // url = url.replace('name',data.avatarName);
                        $('.comman_msg').text(msg);
                        $("#comman_modal").modal('show');

                    } else {
                        var msg = "Sumthing wrong...";
                        $('.comman_msg').text(msg);
                        //$("#my_account_modal").show();
                        //$("#comman_modal").modal('show');
                        //location.reload();
                    }
                },
                error: function (data) {
                    $.toast({
                        heading: 'Error!',
                        text: data.responseJSON.message,
                        icon: 'error',
                        loader: true,
                        position: 'top-right',      // Change it to false to disable loader
                        loaderBg: '#9EC600'  // To change the background
                    });

                }
            });
    });

    $(document).ready(function(){
        $('body').on('click','.deleteimg', function () {
            var id = $(this).data('id');
            $('#deleteId').val(id);
            console.log("id =="+id);
            var url = "{{ route('center.delete.gallery',':id') }} ";
            url = url.replace(':id',id);

            $.ajax({
                type: "POST",
                url:url,
                //data:data,
                // contentType: false,
                // processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    console.log(data);
                    if(data.error == true) {
                        var msg = "Delete";
                        $('.comman_msg').text(msg);
                        $("#comman_modal").modal('show');
                        $('#comman_modal').on('hidden.bs.modal', function () {
                            location.reload();
                        });
                    } else {
                        var msg = "Sumthing wrong...";
                        $('.comman_msg').text(msg);

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
            // $('#pesrmissionModal').modal('show');


            // console.log($('#myTour')[0].reset());
            //location.reload();
        });
    })



    </script>
@endpush
