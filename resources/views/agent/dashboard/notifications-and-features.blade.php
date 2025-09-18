@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="https://foliotek.github.io/Croppie/croppie.css">
<style>
   .swal-button {
   background-color: #242a2c;
   }
   label.cabinet input.file{
	position: relative;
	height: 100%;
	width: auto;
	opacity: 0;
	-moz-opacity: 0;
  filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);
  margin-top:-30px;
}

#upload-demo{
	width: 250px;
	height: 250px;
  padding-bottom:25px;
}
</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <div class="row">    
        <div class="custom-heading-wrapper col-md-12">
           <h1 class="h1">Notifications & Features</h1>
           <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
           <div class="card collapse" id="notes" style="">
              <div class="card-body">
                 <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                 <ol>
                      <li>Use this feature to enable and disable your notification and feature preferences.</li>
                      <li>Please note that for an Escort to receive any of your Requests or Notifications, the
                        Escort must have enabled the corresponding feature in their preference settings.</li>
                      <li>Note also the default setting for 2FA authentification.</li> 
                 </ol>
              </div>
           </div>
        </div>
        <div class="col-md-12" id="profile_and_tour_options">
  
           <form class="v-form-design" id="profile_notification_options" action="http://127.0.0.1:8000/escort-dashboard/notification-update" method="POST">
               <div class="row">
                   <div class="col-md-12">
                       <div class="form-group notification_checkbox_div">
                           <h3 class="h3">Features</h3>
                           <div class="custom-control custom-switch">
                             <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                             <label class="custom-control-label" for="customSwitch1">Receive Alert Notifications from Advertisers</label>
                           </div>
  
                           <div class="custom-control custom-switch">
                             <input type="checkbox" class="custom-control-input" id="customSwitch2" checked>
                             <label class="custom-control-label" for="customSwitch2">Participate in direct chatting with Advertisers</label>
                           </div>
                           <div class="pt-1"><i>These features are enabled by default unless you disable them.</i></div>
                       </div>
  
                       <div class="form-group">
                          <h3 class="h3">Alert notifications</h3>

                          <p class="my-3">From an Advertiser:</p>
  
                          <div class="custom-control custom-switch">
                             <input type="checkbox" class="custom-control-input" id="alert-email">
                             <label class="custom-control-label" for="alert-email">Email (A-Alert)</label>
                           </div>
  
                           <div class="custom-control custom-switch">
                             <input type="checkbox" class="custom-control-input" id="text" checked>
                             <label class="custom-control-label" for="text">Text</label>
                           </div>
                           <div class="pt-1"><i>How an Advertisers will communicate with you.</i></div>

                           <p class="my-3">By Escorts4U:</p>

                           <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="email">
                            <label class="custom-control-label" for="email">Email</label>
                          </div>
 
                          <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="alert-text" checked>
                            <label class="custom-control-label" for="alert-text">Text </label>
                          </div>

                          <div class="custom-control custom-switch">
                           <input type="checkbox" class="custom-control-input" id="call-me">
                           <label class="custom-control-label" for="call-me">Call me</label>
                         </div>
                          <div class="pt-1"><i>How Escorts4U will communicate with you.</i></div>


                       </div>
                       
                       <div class="form-group">
                            <h3 class="h3">Idle Time Preference</h3>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="idle_time" id="idle_15" value="15">
                                <label class="form-check-label" for="idle_15">15 minutes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="idle_time" id="idle_30" value="30" checked>
                                <label class="form-check-label" for="idle_30">30 minutes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="idle_time" id="idle_60" value="60">
                                <label class="form-check-label" for="idle_60">60 minutes</label>
                            </div>
                        
                        </div>
                       <div class="form-group">
                          <h3 class="h3">2FA Authentification</h3>
                           <div class="form-check">
                               <input class="form-check-input" type="checkbox" name="auth" id="auth" value="1">
                               <label class="form-check-label" for="auth">Email</label>
                           </div>
                           <div class="form-check">
                               <input class="form-check-input" name="auth" checked type="checkbox" id="auth" value="2" checked="">
                               <label class="form-check-label" for="auth">Text </label>
                           </div>
                           <div class="pt-1"><i>How your authentification code will be sent to you.</i></div>
                       </div>
                   </div>
               </div>
               <input type="submit" value="save" class="btn btn-primary shadow-none float-right" name="submit">
           </form>
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
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
<div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                <span style="color: white">Crop Photo</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                    
                </button>
                
            </div>
            <div class="modal-body">
                <div id="upload-demo" class="center-block">
                    {{-- <div class="cr-boundary" aria-dropeffect="none">
                        <img src="{{ asset('assets/app/img/service-provider/Frame-408.png')}}" alt="" class="img-rounded" >
                    </div>
                    <div class="cr-slider-wrap"><input class="cr-slider" type="range" step="0.0001" aria-label="zoom" min="0.0000" max="1.5000" aria-valuenow="0.0913"></div> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn main_bg_color site_btn_primary" data-dismiss="modal">Close</button>
                <button type="button" id="cropImageBtn" class="btn main_bg_color site_btn_primary">Crop</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script src="https://foliotek.github.io/Croppie/croppie.js"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript">
    $('#userProfile').parsley({
    
    });
    
    
    
    $('#userProfile').on('submit', function(e) {
        e.preventDefault();
    
        var form = $(this);
    
        if (form.parsley().isValid()) {
    
            var url = form.attr('action');
            var data = new FormData(form[0]);
            $.ajax({
                method: form.attr('method'),
                url: url,
                data: data,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (!data.error) {
                        $.toast({
                            heading: 'Success',
                            text: 'Details successfully saved',
                            icon: 'success',
                            loader: true,
                            position: 'top-right', // Change it to false to disable loader
                            loaderBg: '#9EC600' // To change the background
                        });
    
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right', // Change it to false to disable loader
                            loaderBg: '#9EC600' // To change the background
                        });
    
                    }
                },
    
            });
        }
    });
    $('#city').select2({
        allowClear: true,
        placeholder :'Select City',
        createTag: function(params) {
            var term = $.trim(params.term);
    
            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: false // add additional parameters
            }
        },
        tags: false,
        minimumInputLength: 2,
        tokenSeparators: [','],
        ajax: {
            url: "{{ route('city.list') }}",
            dataType: "json",
            type: "GET",
            data: function(params) {
                console.log(params);
                var queryParameters = {
                    query: params.term,
                    state_id: $('#state').val()
                }
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
    
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            }
        }
    });
    
    $('#state').select2({
        allowClear: true,
        placeholder :'Select State',
        createTag: function(params) {
            var term = $.trim(params.term);
    
            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: false // add additional parameters
            }
        },
        tags: false,
        minimumInputLength: 2,
        tokenSeparators: [','],
        ajax: {
            url: "{{ route('state.list') }}",
            dataType: "json",
            type: "GET",
            data: function(params) {
                console.log(params);
                var queryParameters = {
                    query: params.term,
                    country_id: $('#country').val()
                }
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
    
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            }
        }
    });
    
    
    $('#country').on('change', function(e) {
        if($(this).val()) {
            $('#state').prop('disabled', false);
            $('#state').select2('open');
        } else {
            $('#state').prop('disabled', true);
        }
    });
    
    $('#state').on('change', function(e) {
        if($(this).val()) {
            $('#city').prop('disabled', false);
            $('#city').select2('open');
        } else {
            $('#city').prop('disabled', true);
        }
    });
    
    
</script>
<script>
    // function readURL(input) {
    // if (input.files && input.files[0]) {
    
    // var reader = new FileReader();
    
    // reader.onload = function(e) {
    //   $('.image-upload-wrap').hide();
    
    //   $('.file-upload-image').attr('src', e.target.result);
    //   $('.file-upload-content').show();
    
    //   $('.image-title').html(input.files[0].name);
    // };
    
    // reader.readAsDataURL(input.files[0]);
    
    // } else {
    // removeUpload();
    // }
    // }
    
    function removeUpload() {
    $('.file-upload-input').replaceWith($('.file-upload-input').clone());
    $('.file-upload-content').hide();
    $('.image-upload-wrap').show();
    }
    $('.image-upload-wrap').bind('dragover', function () {
        $('.image-upload-wrap').addClass('image-dropping');
    });
    $('.image-upload-wrap').bind('dragleave', function () {
        $('.image-upload-wrap').removeClass('image-dropping');
    });
    $(".gambar").attr("src");
    var $uploadCrop,
    tempFilename,
    rawImg,
    imageId;
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.upload-demo').addClass('ready');
                $('#cropImagePop').modal('show');
                rawImg = e.target.result;
                
            }
            reader.readAsDataURL(input.files[0]);
        }
        else {
            removeUpload();
        }
    }
    

    $uploadCrop = $('#upload-demo').croppie({
        viewport: {
            width: 150,
            height: 200,
        },
        enforceBoundary: false,
        enableExif: true
    });

    


    $('#cropImagePop').on('shown.bs.modal', function(){
        // alert('Shown pop');
        $uploadCrop.croppie('bind', {
            url: rawImg
        }).then(function(){
            console.log( '1jQuery bind complete');
        });
    });



    // $('.item-img').on('change', function () {
    //     imageId = $(this).data('id');
    //     tempFilename = $(this).val();
    //     $('#cancelCropBtn').data('id', imageId); readFile(this); 
    //     console.log('id = '+imageId);
    // });

    // $('.gambar').on('change', function(){
        
    //     reader.onload = function (event) {
    //     $uploadCrop.croppie('bind', {
    //     url: event.target.result
    //     }).then(function(){
    //     console.log('jQuery complete');
    //     });
    //     }
    //     reader.readAsDataURL(this.files[0]);
    //     console.log('jQuery'+reader.readAsDataURL(this.files[0]) );
    
    // });

    $('#cropImageBtn').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'base64',
            format: 'jpeg',
            size: {width: 150, height: 200}
        }).then(function (resp) { 
            $('.file-upload-content').show();
            $('#item-img-output').attr('src', resp);
            //$('.file-upload-image').attr('src', e.target.result);
           
            $('#cropImagePop').modal('hide');
        });
    });
    // $('.crop_image').click(function(event){
    //     $uploadCrop.croppie('result', {
    //     type: 'canvas',
    //     size: 'viewport'
    //     }).then(function(response){
    //     $.ajax({
    //     url:'{{ route('escort.save.avatar',auth()->user()->id)}}",
    //     type:'POST',
    //     data:{"image":response},
    //     success:function(data){
    //     $('#imageModel').modal('hide');
    //     alert('Crop image has been uploaded');
    //     }
    //     })
    //     });
    // });
    $("#my_avatar").on('submit',function(e){
        e.preventDefault();
        
        var form = $(this);
        var src = $("#item-img-output").attr('src');
        var url = form.attr('action');
        //console.log("hii"+ src);
        var data = new FormData($('#my_avatar')[0]);
        data.append('src',src);
        $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    console.log(data);
                    if(data.type == 0){
                        var msg = "Saved";
                        var url = "{{asset('avatars/name')}}";
                        url = url.replace('name',data.avatarName);
                        $('.comman_msg').text(msg);
                        //$("#my_account_modal").show();
                        $("#comman_modal").modal('show');
                        $(".avatarName").attr('src',url);
                        $(".file-upload-content").hide();
                        
                        
                        
                    } else {
                        var msg = "Sumthing wrong...";
                        $('.comman_msg').text(msg);
                        //$("#my_account_modal").show();
                        $("#comman_modal").modal('show');
                        location.reload();
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
    $(".delete_avatar").click(function()
    {
        $.post({
                    type: 'POST',
                    url: "{{ route('center.avatar.remove') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                }).done(function (data) {
                    if(data.type == 0) {
                        $('.Lname').html("Saved");
                        $("#my_account_modal").modal('show');
                        console.log("Oops..");
                    } else {
                        $('.Lname').html("Removed");
                       // $("#my_account_modal").modal('show');
                        $("#my_account_modal").show();
                        console.log("ok");
                    }
                });
       
    });
    $("#close").click(function()
    {
        $("#my_account_modal").hide();
        location.reload();
    });
</script>
@endpush