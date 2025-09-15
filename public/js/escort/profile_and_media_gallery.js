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
            let id = $(this).data('id');
            $('#dImg').attr('remove_media_id',id);
            $('.img_comman_msg').text("Delete");
            $("#delete_img").modal('show');
        });

        $('body').on('click','#dImg', function(e){
            e.preventDefault();
            $.ajax({
            type: "POST",
            url:`/escort-dashboard/delete-photos/${$(this).attr('remove_media_id')}`,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend: function (){
                $(".img_comman_msg").text('Deleting...');
            },
            success: function (data) {
                getAccountMediaGallery().then(function () {
                    $("#delete_img").modal('hide');
                    $(".img_comman_msg").text('Delete');
                });
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                swal.fire('', "<p>"+errors.message+"</p>", 'error');
            }
        });
    });

});

var bannerDefaultImage;
var pinupDefaultImage;
var allFiles = [];

function preview_image(event)
    {
        const input = document.getElementById("upload_file");
        const files = Array.from(input.files);
        const previousSelectedImagesCount = $("#image_preview .js_galleryMedia").length;
        files.forEach((file, i) => {
            const fileSizeMB = file.size / (1024 * 1024);
            const index = previousSelectedImagesCount + i;
    
            if (fileSizeMB <= 2) {
                allFiles.push(file); 
                const imgURL = URL.createObjectURL(file);
                $('#image_preview').append(`
                    <a href='#'>
                        <div class='five_column_content_top img-title-sec justify-content-between wish_span rm_${index}' style='z-index: 1;'>
                            <span class='card_tit'>${file.name}</span>
                            <i class='fa fa-trash deleteId' data-id='${index}'></i>
                        </div>
                        <label class='newbtn rm_${index}'>
                            <img class='item js_galleryMedia' src='${imgURL}'>
                            <input type='hidden' name='selected_files[]' value='${index}'>
                        </label>
                        <div style='margin-top: -34px;'></div>
                    </a>
                `);
            } else {
                Swal.fire('Media', "Can't upload more than 2 MB", 'error');
            }
        });
        input.value = '';
    }

    $(document).on('click','.deleteId', function(e){
        e.preventDefault();
        let index = $(this).attr('data-id');
        allFiles[index] = null;
        $(`.rm_${index}`).remove();
    });

    $(document).on('click','.js_gallery_category .nav-link', function(e){
        e.preventDefault();
        getAccountMediaGallery();
        $('#cItem_0').addClass('active');
        $('#pageItem_0').addClass('active');
    });

    function readImageURL(input) {
        if (input.files && input.files[0]) {
            var $img = $(input).siblings('img');
            if($img.hasClass('js_bannerDefaultImage')){
                bannerDefaultImage = $img.attr('src');
            }
            if($img.hasClass('js_pinupDefaultImage')){
                pinupDefaultImage = $img.attr('src');
            }
            var reader = new FileReader();
            reader.onload = function (e) {
                var image = new Image();
                image.src = e.target.result;

                    image.onload = function () {
                        var height = image.height;
                        var width = image.width;
                        if(input.id=='upload_banner' && (height < 469 || width < 1920)) {
                            Swal.fire("Banner Media", "The image you have selected is too small.<br>Please upload an image with a minimum size of 1920×469 pixels", "warning");
                            return false;

                        }
                        if(input.id=='upload_pinup' && (height < 627 || width < 855)){
                            Swal.fire("Pin Up Media", "The image you have selected is too small.<br>Please upload an image with a minimum size of 855×627 pixels", "warning");
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
        let selectedImagesCount = parseInt(countSelectedImages());
        let existingImagesCount = parseInt($("input[name='media_count']").val());
        if((existingImagesCount+selectedImagesCount) > 30){
            swal.fire('Media', "<p>Can't upload more than 30 Images, try after deleting images from gallery</p>", 'error');
            return false;
        }
        var form = $(this);
        var url = form.attr('action');

        const formData = new FormData();
        allFiles.forEach((file) => {
            formData.append('img[]', file);
        });

        const bannerInput = document.getElementById('upload_banner');
        if (bannerInput && bannerInput.files.length > 0) {
            formData.append('banner', bannerInput.files[0]);
        }
    
        
        const pinupInput = document.getElementById('upload_pinup');
        if (pinupInput && pinupInput.files.length > 0) {
            formData.append('pinup', pinupInput.files[0]);
        }

        $.ajax({
            type: 'POST',
            url:url,
            data:formData,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend: function () {
                Swal.fire({
                    title: 'Uploading...',
                    text: 'Please wait while we upload your files.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function (data) {
                if(data.status == 200){
                    resetAddPhotoFrom(form);
                } else if(data.status == 405) {
                    swal.fire('Media', "<p>Can't upload more than 30 Images, try after deleting images from gallery</p>", 'error');
                    $("#exampleModal").modal('hide');
                }
                 else {
                    swal.fire('Media', 'Please choose atleast one image', 'error');
                }

            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let messages = Object.values(JSON.parse(xhr.responseText).errors).flat().join('<br>');
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: messages
                    });
                } else {
                    let message = xhr.status === 500 ?JSON.parse(xhr.responseText).message:xhr.responseText;
                    Swal.fire({
                        icon: 'error',
                        title: xhr.statusText,
                        text: message || 'Something went wrong.'
                    });
                    if(xhr.status===200){
                        resetAddPhotoFrom(form);
                    }
                }

            }
        });
    });

    var resetAddPhotoFrom = function(form){
            $('#image_preview a:not(:first)').remove();
            $(".js_bannerDefaultImage").attr('src',bannerDefaultImage);
            $(".js_pinupDefaultImage").attr('src',pinupDefaultImage);
            $("#exampleModal").modal('hide');
            form[0].reset();
            allFiles = [];
            Swal.fire({
                icon: 'success',
                title: 'Uploaded!',
                text: 'Your files were uploaded successfully.'
            });
            getAccountMediaGallery();
    }

    var countSelectedImages = function(){
        let excludeList = ['upload-thum-1.png', 'upload-3.png', 'add-pinup-banner-full.png'];
        let imageNames = [];
        $('.js_galleryMedia').each(function () {
            let src = $(this).attr('src');
            if (!src) return;
            let fileNameWithExt = src.split('/').pop();
            if (!excludeList.includes(fileNameWithExt)) {
                imageNames.push(fileNameWithExt);
            }
        });
        return imageNames.length;
    }

    var getAccountMediaGallery = function() {
        let activeGalleryTab = $(".js_gallery_category .nav-link.active").attr('data-type');
        return $.ajax({
            url: `/escort-dashboard/get-account-media-gallery/${activeGalleryTab}`,
            type: "GET",
            dataType: "json"
        }).done(function (response) {
            if (response.success) {
                let activePage = $("#carouselExampleIndicators .page-item.active").attr('id');
                let activeContainer = $("#carouselExampleIndicators .carousel-item.active").attr('id');
    
                $("#js_profile_media_gallery").html(response.gallery_container_html);
                $("#gallery_modal_container").html(response.gallery_modal_container_html);
                $("#banner_modal_container").html(response.banner_modal_container_html);
                if($("#pinup_modal_container").length > 0){
                    $("#pinup_modal_container").html(response.pinup_modal_container_html);
                }
                else{
                    $(".js_gallery_category li:nth-child(3)").remove();
                }
                if (activePage && activeContainer && $(`#${activeContainer} img`).length > 0) {
                    $(`#${activePage}`).addClass('active');
                    $(`#${activeContainer}`).addClass('active');
                } else {
                    $(`#pageItem_0`).addClass('active');
                    $(`#cItem_0`).addClass('active');
                }
                initDragDrop();
            }
        }).fail(function (xhr, status, error) {
            console.error("Error:", error);
        });
    }
    
    var initVideoDragDrop = function(){
        console.log('initVideoDragDrop');
        $(".videoDraggable").draggable({
            revert: "invalid",
            helper: 'clone',
            appendTo: ".upload-photo-sec",
            refreshPositions: false,
            drag: function (event, ui) {
            },
            stop: function (event, ui) {

            }
          });

          $(".videoDroppable").droppable({
            accept: ".videoDraggable",
            drop: function(event, ui) {
                let dropElement = $(this).find('video');
                let dragElement = ui.draggable.find('video');
                let mediaId = dragElement.attr('data-id');
                let mediaUrl = dragElement.attr('src');
                let position = $(".videoDroppable").index(this)+1;
                dropElement.attr('src',mediaUrl).attr('poster','').find('source').attr('src',mediaUrl);
                $.ajax({
                    type: 'POST',
                    url: `/escort-dashboard/default-videos`,
                    data: {
                        position: position,
                        mediaId: mediaId
                    },
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success : function (data) {

                    }
                });
            }
          });
    }
    var getAccountVideoGallery = function() {
        return $.ajax({
            url: `/escort-dashboard/get-account-video-gallery`,
            type: "GET",
            dataType: "json"
        }).done(function (response) {
            if (response.success) {
                $("#js_profile_video_gallery").html(response.video_container_html);
                $("#js_profile_video_gallery_count").html(`${response.total_count}/6`);
                $("#js_profile_video_gallery_progressbar").css("width", `${Math.round(100 * response.total_count / 6)}%`);
                $(`#pageItemVideo_0`).addClass('active');
                $(`#cItemVideo_0`).addClass('active');
                initVideoDragDrop();
            }
        }).fail(function (xhr, status, error) {
            console.error("Error:", error);
        });
    }
    getAccountVideoGallery();