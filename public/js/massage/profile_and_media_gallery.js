$(() => {
        $('#cItem_0').addClass('active');
        $('#pageItem_0').addClass('active');
        $("body").on('click','.page-link', function(e){
            e.preventDefault();
            var id = $(this).attr('data-slide-to');
            var childElement = $(this).parent().attr('id');
            var parentElement = $(this).parents('.carousel').attr('id');
            $(`#${parentElement} .page-item`).removeClass('active');
            $(`#${childElement}`).addClass('active');
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
            var parentElement = $(this).parents('.carousel').attr('id');
            var carouselEl = $(`#${parentElement} .carousel-inner`).carousel('prev');
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
            var parentElement = $(this).parents('.carousel').attr('id');
            var carouselEl = $(`#${parentElement} .carousel-inner`).carousel('next');
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
            let prevTag = $(this).prev().children().first()[0]?.tagName;
            $('.img_comman_msg').text("Delete");
            if(prevTag=='VIDEO'){
                $('#dVideo').attr('remove_media_id',id);
                $("#delete_video").modal('show');
            }
            else{
                $('#dImg').attr('remove_media_id',id);
                $("#delete_img").modal('show');
            }
        });

        $('body').on('click','#dImg', function(e){
            e.preventDefault();
            $.ajax({
            type: "POST",
            url:`/center-dashboard/delete-photos/${$(this).attr('remove_media_id')}`,
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

    $('body').on('click','#dVideo', function(e){
        e.preventDefault();
        $.ajax({
        type: "POST",
        url:`/center-dashboard/delete-videos/${$(this).attr('remove_media_id')}`,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        beforeSend: function (){
            $(".img_comman_msg").text('Deleting...');
        },
        success: function (data) {
            getAccountVideoGallery().then(function () {
                $("#delete_video").modal('hide');
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

const CHUNK_SIZE = 1024 * 1024;
let currentPageUrl = window.location.href;
var bannerDefaultImage;
var pinupDefaultImage;
var allFiles = [];
var MaxSize = 50;
let isDropTriggered = false;

let selectedVideoId = null;
let selectedVideoPosition = null;
function preview_image(event)
    {
        const input = document.getElementById("upload_file");
        const files = Array.from(input.files);
        const previousSelectedImagesCount = $("#image_preview .js_galleryMedia").length;
        files.forEach((file, i) => {
            const fileSizeMB = file.size / (1024 * 1024);
            const index = previousSelectedImagesCount + i;
    
            if (fileSizeMB <= MaxSize) {
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
                Swal.fire('Media', "Can't upload more than 5 MB", 'error');
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

    $(document).off('click', '#escort_profile_media_filter_type .nav-link');
    $(document).on('click', '#escort_profile_media_filter_type .nav-link', function(e) {
        e.preventDefault();
        $('#escort_profile_media_filter_type .nav-link').removeClass('active');
        $(this).addClass('active');
        getAccountMediaGallery();
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
                            input.value = '';
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



    $('#upload_photos').on('click', function (e) {
    e.preventDefault();

    console.log('mulitiImage new ===============');

    let selectedImagesCount = parseInt(countSelectedImages());
    let existingImagesCount = parseInt($("input[name='media_count']").val());

    if ((existingImagesCount + selectedImagesCount) > 30) {
        Swal.fire(
            'Media',
            "<p>Can't upload more than 30 Images, try after deleting images from gallery</p>",
            'error'
        );
        return false;
    }

    const form = $('#mulitiImage');
    const url = form.attr('action');

    console.log('url',url);

    const formData = new FormData();

    // 🔹 multiple images
    allFiles.forEach((file) => {
        formData.append('img[]', file);
    });

    // 🔹 banner
    const bannerInput = document.getElementById('upload_banner');
    if (bannerInput && bannerInput.files.length > 0) {
        formData.append('banner', bannerInput.files[0]);
    }

    // 🔹 pinup
    const pinupInput = document.getElementById('upload_pinup');
    if (pinupInput && pinupInput.files.length > 0) {
        formData.append('pinup', pinupInput.files[0]);
    }

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        beforeSend: function () {
            Swal.fire({
                title: 'Uploading...',
                text: 'Please wait while we upload your files.',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
        },

        success: function (data) {
            if (data.status == 200) {
                resetAddPhotoFrom(form);
            } else if (data.status == 405) {
                Swal.fire(
                    'Media',
                    "<p>Can't upload more than 30 Images, try after deleting images from gallery</p>",
                    'error'
                );
                $('#exampleModal').modal('hide');
            } else {
                Swal.fire('Media', 'Please choose at least one image', 'error');
            }
        },

        error: function (xhr) {
            if (xhr.status === 422) {
                let messages = Object.values(xhr.responseJSON.errors)
                    .flat()
                    .join('<br>');

                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: messages
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: xhr.statusText,
                    text: xhr.responseJSON?.message || 'Something went wrong.'
                });
            }
        }
    });
});


    
    $("body").on('submit','#mulitiImage',function(e){

        console.log('mulitiImage===============');
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
            $('#image_preview').html('');
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
        let activeStatusTab = $("#escort_profile_media_filter_type .nav-link.active").attr('data-filter-type');        
    
        return $.ajax({
            url: `/center-dashboard/get-account-media-gallery/${activeGalleryTab}/${activeStatusTab}`,
            type: "GET",
            dataType: "json"
        }).done(function (response) {
            if (response.success) {
                let activePage = $("#carouselExampleIndicators .page-item.active").attr('id');
                let activeContainer = $("#carouselExampleIndicators .carousel-item.active").attr('id');
    
                $("#js_profile_media_gallery").html(response.gallery_container_html);
                $("#gallery_modal_container").html(response.gallery_modal_container_html);
                $("#banner_modal_container").html(response.banner_modal_container_html);
                $(".js_gallery_category li:nth-child(3)").remove();
                // if($("#pinup_modal_container").length > 0){
                //     $("#pinup_modal_container").html(response.pinup_modal_container_html);
                // }
                // else{
                //     $(".js_gallery_category li:nth-child(3)").remove();
                // }
                if (activePage && activeContainer && $(`#${activeContainer} img`).length > 0) {
                    $(`#${activePage}`).addClass('active');
                    $(`#${activeContainer}`).addClass('active');
                } else {
                    $(`#pageItem_0`).addClass('active');
                    $(`#cItem_0`).addClass('active');
                }
                initDragDrop();
                getMediaCount();
            }
        }).fail(function (xhr, status, error) {
            console.error("Error:", error);
        });
    }
    /**
     * Video Gallery Module
     */
    var initVideoDragDrop = function(){
        $(".videoDraggable").draggable({
            revert: "invalid",
            helper: 'clone',
            appendTo: "body",
            refreshPositions: false,
            cancel:'video',
            start: function (event, ui) {
                ui.helper.css({
                    width: "150px",   // shrink preview
                    height: "auto",
                    "z-index": 9999
                });
                ui.helper.find("video").css({
                    width: "100%",
                    height: "auto",
                });
            },
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
                let mediaUrl = dragElement.attr('src');

                selectedVideoId = dragElement.attr('data-id');
                selectedVideoPosition = $(".videoDroppable").index(this)+1;

                if($(`.videoDroppable video[data-id=${selectedVideoId}]`).length > 0){
                    swal.fire('Media', "<p>The video you selected is already set as the default. Please select other video from your repository.</p>", 'error');
                    return false;
                }
                dropElement.attr('src',mediaUrl).attr('data-id',selectedVideoId).attr('poster','').find('source').attr('src',mediaUrl);
                dropElement.next().val(selectedVideoId);
                currentPageUrl.includes('profile')?$("#setAsDefaultVideoForMainAccount").modal('show'):setVideoToDefault();
            }
          });
    }

    var saveDefaultVideo = function(){
        setVideoToDefault();
        $("#setAsDefaultVideoForMainAccount").modal('hide');
    }

    var setVideoToDefault = function(){
        $.ajax({
            type: 'POST',
            url: `/center-dashboard/default-videos`,
            data: {position:selectedVideoPosition,mediaId:selectedVideoId},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success : function (data) {

            }
        });
    }

    var getAccountVideoGallery = function() {
        return $.ajax({
            url: `/center-dashboard/get-account-video-gallery`,
            type: "GET",
            dataType: "json"
        }).done(function (response) {
            if (response.success) {
                $("#js_profile_video_gallery").html(response.video_container_html);
                $("#js_profile_video_gallery_count").html(`${response.total_count}/6`);
                $("#js_profile_video_gallery_progressbar").css("width", `${Math.round(100 * response.total_count / 6)}%`);
                response.total_count>= 6 ? $("#add_video_button").hide():$("#add_video_button").show();
                $(`#pageItemVideo_0`).addClass('active');
                $(`#cItemVideo_0`).addClass('active');
                initVideoDragDrop();
            }
        }).fail(function (xhr, status, error) {
            console.error("Error:", error);
        });
    }

    var getAccountDefaultVideo = function() {

        console.log(`(${window.App.baseUrl}`);

        
        return $.ajax({
            url: `/center-dashboard/get-default-videos`,
            type: "GET",
            dataType: "json"
        }).done(function (response) {
            if (response.success) {

                 

                if(response.media.length > 0){
                    response.media.map((item,index)=>{
                        let target = $(".videoDroppable").eq(item.position - 1).find("video");
                        if (target.length) {
                          target.attr("src", `${window.App.baseUrl}${item.path}`);
                          target.attr("poster", ``);
                          target.attr("data-id", item.id);
                          target.find("source").attr("src", `${window.App.baseUrl}${item.path}`);
                          target.next().val(item.id);
                          target.load();
                        }
                    })
                }
            }
        }).fail(function (xhr, status, error) {
            console.error("Error:", error);
        });
    }

    function getProfileDefaultVideo()
    {
        return $.ajax({
            url: `/center-dashboard/get-default-videos/${profileId}`,
            type: "GET",
            dataType: "json"
        }).done(function (response) {
            console.log('response=======>',response);
            if (response.success) {
                if(response.media.length > 0){
                    response.media.map((item,index)=>{
                        let target = $(".videoDroppable").eq(item.position - 1).find("video");
                        if (target.length) {
                          target.attr("src", `${window.App.baseUrl}${item.media.path}`);
                          target.attr("poster", ``);
                          target.attr("data-id", item.id);
                          target.find("source").attr("src", `${window.App.baseUrl}${item.media.path}`);
                          target.next().val(item.id);
                          target.load();
                        }
                    })
                }
            }
        }).fail(function (xhr, status, error) {
            console.error("Error:", error);
        });
    }

function previewVideo() {
    const input = document.getElementById('video_upload');
    const preview = document.getElementById('videoPreview');
    const file = input.files[0];
    if($(".videoDraggable").length>=6){
        swal.fire('Media', "<p>Can't upload more than 6 Videos, try after deleting videos from gallery</p>", 'error');
        return false;
    }
    
    if (file && file.type.startsWith('video/')) {
        const url = URL.createObjectURL(file);
        preview.src = url;
        preview.style.display = 'block';
        preview.insertAdjacentHTML("afterend", '<i class="fa fa-trash remove" style="cursor:pointer; margin-left:8px; color:red;"></i>');
        input.previousElementSibling.style.display = 'none';
    } else {
        preview.src = '';
        preview.style.display = 'none';
        Swal.fire('Media', 'Please select a valid video file.', 'error');
    }
}

$(document).on('click','#upload_video_modal i.remove', function(){
    const input = document.getElementById('video_upload');
    const preview = document.getElementById('videoPreview');
    preview.src = '';
    preview.style.display = 'none';
    this.remove();
    input.value='';
    input.previousElementSibling.style.display = 'block';
    
})

async function uploadVideo() {
    const fileInput = document.getElementById('video_upload');
    const preview = document.getElementById('videoPreview');
    const file = fileInput.files[0];

    if (!file) {
        Swal.fire('Media', 'Please choose atleast one file', 'error');
        return;
    }

    const totalChunks = Math.ceil(file.size / CHUNK_SIZE);
    const fileName = file.name;
    let uploadedChunks = 0;

    Swal.fire({
        title: 'Uploading...',
        html: `<div style="display: flex; flex-direction: column; align-items: center;">
            <div class="swal-spinner" style="margin: 10px;">
                <div class="custom-spinner"></div>
            </div>
            <div id="uploadPercent" style="font-weight: bold;">0%</div>
        </div>`,
        allowOutsideClick: false,
        didOpen: () => {
            
        }
    });

    for (let i = 0; i < totalChunks; i++) {
        const start = i * CHUNK_SIZE;
        const end = Math.min(file.size, start + CHUNK_SIZE);
        const chunk = file.slice(start, end);

        const formData = new FormData();
        formData.append("file", chunk);
        formData.append("chunkIndex", i);
        formData.append("fileName", fileName);

        await fetch("/center-dashboard/upload-chunk", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        });
        uploadedChunks++;
        const percent = Math.floor((uploadedChunks / totalChunks) * 100);
        document.getElementById('uploadPercent').innerText = `${percent}%`;
    }

    // After uploading all chunks, request merge
    const mergeData = new FormData();
    mergeData.append("fileName", fileName);
    mergeData.append("totalChunks", totalChunks);

    await fetch("/center-dashboard/merge-chunks", {
        method: "POST",     
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: mergeData
    });

    Swal.fire("Success", "Upload complete!", "success").then(() => {
        fileInput.previousElementSibling.style.display = 'block';
        fileInput.value = '';
        preview.src = '';
        preview.style.display = 'none';
        preview.nextElementSibling.remove();
        getAccountVideoGallery();
    });
}

async function initVideos() {
    await getAccountVideoGallery();
    (typeof profileId === "undefined" || profileId===0)?await getAccountDefaultVideo():await getProfileDefaultVideo();
    let videos = document.querySelectorAll("video");
    videos.forEach(video => {
        video.addEventListener("play", () => {
            videos.forEach(v => {
                if (v !== video) {
                    v.pause();
                }
            });
        });
    });
}
initVideos();



function initDragDrop() {
            $("#dvSource img").draggable({
                revert: "invalid",
                helper: 'clone',
                appendTo: ".upload-banner",
                refreshPositions: false,
                start: function (event, ui) {
                ui.helper.css({
                    width: "82px",   // shrink preview
                    height: "auto",
                    "z-index": 9999
                });
                ui.helper.find("img").css({
                    width: "100%",
                    height: "auto"
                });
                },
                drag: function(event, ui) {

                },
                stop: function(event, ui) {}
            });

            $(".dvDest").droppable({
                drop: function(event, ui) {
                    let dropSlot = $(this);
                    let dragSlot = ui.draggable;
                    let dropSlotType = dropSlot.find('img').data('type');
                    // let dragSlotType = dragSlot.closest(".item4").find('span').text().toLowerCase();
                    let dragSlotType = dragSlot
                        .closest(".item4")
                        .find("span.badge")
                        .text()
                        .trim()
                        .toLowerCase();
                    if (dropSlotType != dragSlotType) {
                        let message = (dragSlotType == 'gallery') ?
                            `The photo you selected is not a Banner image. Please select a Banner image from your repository.` :
                            `The photo you selected is not a Gallery image. Please select a Gallery image from your repository.`;
                        swal.fire('Media', message, 'error');
                        return false;
                    } else {
                        // $(this).trigger('click');
                        let meidaId = dragSlot.data('id');
                        let iconBox = dropSlot.find('.verify_icon, .lg_verify_icon');
                        let position = iconBox.attr('id')?.split('_')[2];

                        let draggedSrc = dragSlot.attr('src');
                        let srcArray = $(".upld-img").map(function() {
                            return $(this).attr("src");
                        }).get();

                        let duplicateFound = srcArray.filter(src => src === draggedSrc).length > 0;

                        if (duplicateFound) {
                            swal.fire('', "<p>It's a duplicate image. Please select another image.</p>", 'error');
                            return false;
                        }

                        let target;
                        switch (dragSlotType) {
                            case 'gallery': {
                                target = $(".modalPopup .item4 img[data-id='" + meidaId + "']").closest(
                                    ".item4");
                            }
                            break;
                            case 'banner': {
                                target = $(".modalPopup .item2 img[data-id='" + meidaId + "']").closest(
                                    ".item2");
                            }
                            break;
                        }
                        $(this).trigger('click')
                        isDropTriggered = true;
                        target.trigger('click');
                        isDropTriggered = false;
                        getMediaByIdAndStatusShow(meidaId, position);
                    }

                }
            });
        }


    let selectedImageId = null;
    let selectedPosition = null;

    $(document).on('click', '.dvDest', function () {
        let iconBox = $(this).find('.verify_icon, .lg_verify_icon');
        if (iconBox.length === 0) {
            console.log("Position not found");
            return;
        }
        let id = iconBox.attr('id');
        if (!id) return;
        selectedPosition = id.split('_')[2]; 
    });

    $(document).on('click', '.select_image', function () {
        selectedImageId = $(this).data('id');
        if (!selectedPosition) {
            console.log("Position not set yet");
            return;
        }
    });

    $(document).on('click', '#close_change', function () {
        if (!selectedImageId || !selectedPosition) {
            console.log("Missing data");
            return;
        }
        getMediaByIdAndStatusShow(selectedImageId, selectedPosition);
        selectedImageId = null;
        selectedPosition = null;
    });



    function getMediaByIdAndStatusShow(media_id, position) {
        position = String(position).trim();
        let iconBox = $('#verify_icon_' + position);

        if (iconBox.length === 0) {
            console.log("Icon box not found for position:", position);
            return;
        }

        $.ajax({
            url: '/center-dashboard/get-image-info',
            type: 'POST',
            data: {
                media_id: media_id,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                let status = res.data.varified;
                let template = res.data.template;

                if (status === null || typeof status === "undefined") {
                    iconBox.html('').hide();
                    return;
                }

                let iconPath = '';
                let iconText = '';

                if (position == 1 || position == 9 || position == 10) {
                    if (status == "0") {
                        iconPath = '/assets/app/img/pending_icon/e4u_pending_REV.png';
                        iconText = '<span class="common_shield_tooltip">Media Pending</span>';
                    } else if (status == "1") {
                        iconPath = '/assets/app/img/verify/e4u_verified_REV.png';
                        iconText = '<span class="common_shield_tooltip">Media Verified</span>';
                    } else {
                        iconPath = '/assets/app/img/verify/unverified_light.png';
                        iconText = '<span class="common_shield_tooltip">Media Unverified</span>';
                    }
                } else {
                    if (status == "0") {
                        iconPath = '/assets/app/img/pending_icon/e4u_pending-icon_REV.png';
                        iconText = '<span class="mc_media_tooltip">Media Pending</span>';
                    } else if (status == "1") {
                        iconPath = '/assets/app/img/verify/verified_icon.png';
                        iconText = '<span class="mc_media_tooltip">Media Verified</span>';
                    } else {
                        iconPath = '/assets/app/img/verify/unverified_icon.png';
                        iconText = '<span class="mc_media_tooltip">Media Unverified</span>';
                    }
                }

                iconBox.html(`<img src="${iconPath}">${iconText}`);

                if (template == "1" && position == "9") {
                    iconBox.hide();
                } else {
                    iconBox.show();
                }
            },
            error: function() {
                iconBox.html('').hide();
            }
        });
    }


function getMediaCount(){
    return $.ajax({
        url: `/center-dashboard/get-media-count`,
        type: "GET",
        dataType: "json"
    }).done(function (response) {
        let btn = $('#mediaVerification');
        let tooltip = btn.find('.timer_tooltip');
        if (response.success && response.total_media_count < 1) {
            btn.prop('disabled', true);
            btn.addClass('disabled-img-btn')
            tooltip.text('No any media.');
        } 
        else if (response.success && response.media_count_for_verification < 1){
            btn.prop('disabled', true);
            tooltip.text('No media available for verification.');
            btn.addClass('disabled-img-btn');
        } 
        else {
            btn.prop('disabled', false);
            tooltip.text('You must provide your Media Verification within 48 hours.');
            btn.removeClass('disabled-img-btn')
        }

    }).fail(function (xhr, status, error) {
        console.error("Error:", error);
    });
}