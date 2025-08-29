$(() => {
        $('#cItem_0').addClass('active');
        $('#pageItem_0').addClass('active');
        $("body").on('click','.page-link', function(e){
            e.preventDefault();
            var id = $(this).attr('data-slide-to');
            $('.page-item').removeClass('active');
            $('#pageItem_'+id).addClass('active');
            if(id == 0) {
                $(".preview").addClass('leftLst over');
            } else {
                $(".preview").removeClass('leftLst over');
            }
            if(id == 2) {
                $(".nextOne").addClass('leftLst over');
            } else {
                $(".nextOne").removeClass('leftLst over');
            }
        });

        $("body").on('click','.preview', function(e){
            e.preventDefault();
            var carouselEl = $(".carousel-inner").carousel('prev');
            var carouselItems = carouselEl.find('.carousel-item');
            var id = carouselItems.siblings('.active').index();
            if(id == 0) {
                $(".preview").addClass('leftLst over');
            } else {
                $(".preview").removeClass('leftLst over');
            }
            $('#pageItem_'+id).addClass(' active');
        });

        $("body").on('click','.nextOne', function(e){
            e.preventDefault();
            var carouselEl = $(".carousel-inner").carousel('next');
            var carouselItems = carouselEl.find('.carousel-item');
            var id = carouselItems.siblings('.active').index();
            if(id == 2) {
            $(".nextOne").addClass('leftLst over');
            } else {
            $(".nextOne").removeClass('leftLst over');
            }
            var clm = $(".carousel-inner").carousel('pause');
            $('#pageItem_'+id).addClass(' active');
        });

        $('body').on('click','.deleteimg', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#deleteId').val(id);
        var msg = "Delete";
        $('.img_comman_msg').text(msg);
        $("#delete_img").modal('show');
        $('#dImg').click(function () {
                $.ajax({
                type: "POST",
                url:`/escort-dashboard/delete-photos/${id}`,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if(data.error == true) {
                        $("#delete_img").modal('hide');
                        $("#dm_"+id).remove();
                        getAccountMediaGallery();
                    } else {
                        var msg = "Sumthing wrong...";
                        $('.img_comman_msg').text(msg);

                    }
                },
                error: function (data) {
                    var errors = $.parseJSON(data.responseText);
                    swal.fire('', "<p>"+errors.message+"</p>", 'error');
                    $('#comman_modal').on('hidden.bs.modal', function () {
                        location.reload();
                    });
                }
            });
        });
   });
});

function preview_image()
    {
        $(".rm").hide();
        var total_file=document.getElementById("upload_file").files.length;
        for(var i=0;i<total_file;i++)
        {

            var num = i+1;
            var oFile =document.getElementById("upload_file").files[i];

            var imgkbytes = Math.round(parseInt(oFile.size)/1024);
            var imgMB = Math.round(parseInt(imgkbytes)/1024);
           if(imgMB <= 2 ) {
            $('#image_preview').append("<a href='#'><div class='five_column_content_top img-title-sec justify-content-between wish_span rm_"+num+"' style='z-index: 1;'><span class='card_tit' style=''>Photo.img</span><i class='fa fa-trash deleteId' data-id='"+num+"'></i></div><label class='newbtn rm_"+num+"'><img id='blah"+num+"' class='item' src='"+URL.createObjectURL(event.target.files[i])+"'>" +
                "<input type='hidden' name='selected_files[]' value='"+i+"'></label><div style='margin-top: -34px;'></div></a>");
            } else {
               swal.fire('', "Can't upload more than 2 MB size", 'error');
            }
        }
        $(document).on('click','.deleteId', function(){
        var mid = $(this).attr('data-id');
        $(".rm_"+mid).remove();
        });
    }

    function readImageURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {


                var image = new Image();
                image.src = e.target.result;

                    image.onload = function () {
                        var height = image.height;
                        var width = image.width;
                        if(input.id.includes('9') && (height < 469 || width < 1920)) {
                            Swal.fire("Banner Media", "Please upload an image with a minimum size of 1921×470 pixels", "warning");
                            return false;

                        }
                        if(input.id.includes('10') && (height < 627 || width < 855)){
                            Swal.fire("Pin Up Media", "Please upload an image with a minimum size of 855×627 pixels", "warning");
                            return false;
                        }
                        $(`#${input.id}`).prev().attr('src', e.target.result);
                    };
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
    
    $("body").on('submit','#mulitiImage',function(e){
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var data = new FormData($('#mulitiImage')[0]);
        $.ajax({
            type: 'POST',
            url:url,
            data:data,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                if(data.my_data.status == 200){
                    $("#exampleModal").modal('hide');
                    swal.fire('', 'Uploaded', 'success');
                    getAccountMediaGallery();
                } else if(data.my_data.status == 405) {
                    swal.fire('', "", 'error');
                    swal.fire('', "<p>Can't upload more than 30 Images, try after deleting images from gallery</p>", 'error');
                    
                    $("#exampleModal").modal('hide');
                }
                 else {
                    location.reload();
                }

            },
            error: function (data) {

                var errors = $.parseJSON(data.responseText);
                var errorMsg = errors.message;
              
                Swal.fire(
                    'Error occurred',
                    'File upload failed : ' + errorMsg,
                    'error'
                )

            }
        });
    });

    var getAccountMediaGallery = function(){
        $.ajax({
            url: "/escort-dashboard/get-account-media-gallery",
            type: "GET",
            success: function (response) {
                $("#js_profile_media_gallery").html(response.html);
                $('#cItem_0').addClass('active');
                $('#pageItem_0').addClass('active');
                initDragDrop();
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
            }
        });
    }