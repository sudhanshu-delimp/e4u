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
            url: `/center-dashboard/get-account-media-gallery/${activeGalleryTab}`,
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

    function getProfileDefaultVideo(){
        return $.ajax({
            url: `/center-dashboard/get-default-videos/${profileId}`,
            type: "GET",
            dataType: "json"
        }).done(function (response) {
            console.log(response);
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