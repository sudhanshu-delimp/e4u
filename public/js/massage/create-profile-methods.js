CKEDITOR.editorConfig = function(config) {
            config.toolbarGroups = [{
                    name: 'clipboard',
                    groups: ['clipboard', 'undo']
                },
                {
                    name: 'editing',
                    groups: ['find', 'selection', 'spellchecker', 'editing']
                },
                {
                    name: 'links',
                    groups: ['links']
                },
                {
                    name: 'insert',
                    groups: ['insert']
                },
                {
                    name: 'forms',
                    groups: ['forms']
                },
                {
                    name: 'tools',
                    groups: ['tools']
                },
                {
                    name: 'document',
                    groups: ['mode', 'document', 'doctools']
                },
                {
                    name: 'others',
                    groups: ['others']
                },
                '/',
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup']
                },
                {
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']
                },
                {
                    name: 'styles',
                    groups: ['styles']
                },
                {
                    name: 'colors',
                    groups: ['colors']
                },
                {
                    name: 'about',
                    groups: ['about']
                }
            ];

            config.removeButtons =
                'Underline,Subscript,Superscript,PasteText,PasteFromWord,Scayt,Anchor,Unlink,Image,Table,HorizontalRule,SpecialChar,Maximize,About,RemoveFormat,Strike';
        };
        let editor = CKEDITOR.replace(textarea); 
        let deleteKey = 46;
        let backspaceKey = 8;
        let leftArrowKey = 37;
        let rightArrowKey = 38;
        let topArrowKey = 39;
        let bottomArrowKey = 40;
        let charLimit = 2500;
        window.onload = function() {
            CKEDITOR.instances.about_us_box.on('key', function(event) {
                let keyCode = event.data.keyCode;
                var str = CKEDITOR.instances.about_us_box.getData();
                if (str.length > charLimit) {
                    return [deleteKey, backspaceKey, leftArrowKey, rightArrowKey, topArrowKey, bottomArrowKey]
                        .includes(keyCode);
                }
            });
            CKEDITOR.instances.about_us_box.on('paste', function(event) {
                var keyCode = event.data.keyCode;
                var str = CKEDITOR.instances.about_us_box.getData();
                if (str.length > charLimit) {
                    return [deleteKey, backspaceKey, leftArrowKey, rightArrowKey, topArrowKey, bottomArrowKey]
                        .includes(keyCode);
                }
            });
        };


      


function setDefaults() {
            var url = window.defaultImagesUrl;
            $.ajax({
                type: 'POST',
                url: url,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.error == true) {

                        $("#blah1").attr('src', data.path[1]['path']);
                        $("#blah2").attr('src', data.path[2]['path']);
                        $("#blah3").attr('src', data.path[3]['path']);
                        $("#blah4").attr('src', data.path[4]['path']);
                        $("#blah5").attr('src', data.path[5]['path']);
                        $("#blah6").attr('src', data.path[6]['path']);
                        $("#blah7").attr('src', data.path[7]['path']);
                        $("#blah8").attr('src', data.path[8]['path']);
                        $("#blah9").attr('src', data.path[9]['path']);
                        $(".cl_blash8").attr('src', data.path[8]['path']);
                        $("#blahx").attr('src', data.path[10]['path']);
                        $("#akhVideo").attr('src', data.path[10]['path']);

                        $("#img1").attr('src', data.path[1]['path']);
                        $("#img2").attr('src', data.path[2]['path']);
                        $("#img3").attr('src', data.path[3]['path']);
                        $("#img4").attr('src', data.path[4]['path']);
                        $("#img5").attr('src', data.path[5]['path']);
                        $("#img6").attr('src', data.path[6]['path']);
                        $("#img7").attr('src', data.path[7]['path']);
                        $("#img9").attr('src', data.path[9]['path']);
                        $("#imgx").attr('src', data.path[10]['path']);

                        $("#mediaId1").val(data.path[1]['id']);
                        $("#mediaId2").val(data.path[2]['id']);
                        $("#mediaId3").val(data.path[3]['id']);
                        $("#mediaId4").val(data.path[4]['id']);
                        $("#mediaId5").val(data.path[5]['id']);
                        $("#mediaId6").val(data.path[6]['id']);
                        $("#mediaId7").val(data.path[7]['id']);
                        $("#mediaId8").val(data.path[8]['id']);
                        $("#mediaId9").val(data.path[9]['id']);
                        $("#mediaIdx").val(data.path[10]['id']);
                    } else {

                    }
                }

            });
        }


        function showManualRequiredError(about_us_box) {
            const textarea = document.getElementById(about_us_box);
            const message = textarea.getAttribute('data-parsley-required-message') || 'This field is required.';
            const errorContainerSelector = textarea.getAttribute('data-parsley-errors-container');
            const errorContainer = document.querySelector(errorContainerSelector);

            const value = textarea.value.trim();

            if (!value && errorContainer) {
                errorContainer.innerHTML = `<ul class="parsley-errors-list filled"><li class="parsley-required">${message}</li></ul>`;
            } else {
                errorContainer.innerHTML = ''; // clear any previous error
            }
        }


        function validateWhoAmIContent() {
            const about_us_box = 'about_us_box';
            const content = document.getElementById(about_us_box).value.trim();
            showManualRequiredError(about_us_box);
            return (!content) ? false : true;
        }
        
        
        function checkProfileDynamicMedia() {
            let dynamic_image = 0;
            let imageSlots = document.querySelectorAll('.profile-gallery');
            let thumbnailSlot = imageSlots.item(0);
            let bannerSlot = imageSlots[imageSlots.length - 1];
            if(['img-11.png','upload-thum-1.png'].includes(thumbnailSlot.getAttribute('src').substring(thumbnailSlot.getAttribute('src').lastIndexOf('/') + 1))){
                Swal.fire('Media',
                    'Please attach media to this Profile from the Media Repository or upload a new file (Thumbnail is mendatory)',
                    'warning');
                return dynamic_image;
            }
            if(['img-13.png','upload-3.png'].includes(bannerSlot.getAttribute('src').substring(bannerSlot.getAttribute('src').lastIndexOf('/') + 1))){
                Swal.fire('Media',
                    'Please attach media to this Profile from the Media Repository or upload a new file (Banner is mendatory)',
                    'warning');
                return dynamic_image;
            }
            else{
                imageSlots.forEach(img => {
                    let src = img.getAttribute('src');
                    let basename = src.substring(src.lastIndexOf('/') + 1);
                    if (!['img-12.png', 'img-11.png', 'img-13.png', 'upload-thum-1.png', 'frame_final.png','upload-3.png'].includes(basename)) {
                     dynamic_image++
                    }
                });
                if (dynamic_image < 5) {
                    dynamic_image = 0;
                    Swal.fire('Media',
                    'Please attach media to this Profile from the Media Repository or upload a new file (Atleast 5 are mendatory including Thumbnail and Banner)',
                    'warning');
                }
                return dynamic_image;
            }
    }




function syncCKEditor() 
{
    for (let instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
}

function validateCKEditor() {
    const data = CKEDITOR.instances.about_us_box.getData()
        .replace(/<[^>]*>/g, '')
        .trim();

    if (!data) {
        $('#about_me_error').html(
            '<small class="text-danger">Please write something about you</small>'
        );
        return false;
    }

    $('#about_me_error').html('');
    return true;
}


function checkProfileDynamicMediaVideo() {
            let dynamic_video = 0;
            $("input[name^='video_position']").each(function () {
                if ($(this).val().trim() != "") {
                    dynamic_video++;
                }
            });


            console.log('dynamic_video',dynamic_video);

            return dynamic_video;
}



var updateProgressBar = function(tab_id){
            let progressBar = $('.define_process_bar_color');
            let percentCont = $('#percent');
            switch (tab_id) {
                case 'home-tab': {
                    progressBar.attr('style', 'width :25%');
                    percentCont.html('25%');
                } break;
                case 'profile-tab': {
                    progressBar.attr('style', 'width :50%');
                    percentCont.html('50%');
                } break;
                case 'contact-tab': {
                    progressBar.attr('style', 'width :75%');
                    percentCont.html('75%');
                } break;
                case 'playmates-tab': {
                    progressBar.attr('style', 'width :100%');
                    percentCont.html('100%');
                } break;
            }
}



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
                    let dragSlotType = dragSlot.closest(".item4").find('span').text().toLowerCase();
                    if (dropSlotType != dragSlotType) {
                        let message = (dragSlotType == 'gallery') ?
                            `The photo you selected is not a Banner image. Please select a Banner image from your repository.` :
                            `The photo you selected is not a Gallery image. Please select a Gallery image from your repository.`;
                        swal.fire('Media', message, 'error');
                        return false;
                    } else {
                        $(this).trigger('click');
                        let meidaId = dragSlot.data('id');
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
                        target.trigger('click');
                    }

                }
            });
        }


        function positionToUpdate(position) {
            updatePosition = position;
            return true;
        }



        let profile_selected_images = [];
        let default_image_icons = ['img-11.png', 'img-12.png', 'img-13.png'];
        $(document).on('click', '.modalPopup .item4, .modalPopup .item2', function(e) {
            let imageSrc = $(this).find('img').attr('src');
            let mediaId = $(this).find('img').data('id');
            let img_target = $("#img" + updatePosition);
            let targetImageSrc = img_target.attr('src');
            let targetImageName = targetImageSrc.split("/").pop();
            /**
             * Get existing profile image data to check duplicates
             */
            let srcArray = $(".upld-img").map(function() {
                return $(this).attr("src"); // Get the 'src' attribute of each <img>
            }).get();

            let newObject = {
                imageSrc: imageSrc,
                mediaId: mediaId,
                img_target: img_target,
                updatePosition: updatePosition
            };
            let duplicateImage = srcArray.findIndex(item => item === imageSrc);
            if (duplicateImage !== -1) {
                swal.fire('', "<p>It's a duplicate image. Please select another image.</p>", 'error');
            } else {
                let index = profile_selected_images.findIndex(item => item.updatePosition === updatePosition);
                if (index !== -1) {
                    profile_selected_images[index] = {
                        ...profile_selected_images[index],
                        ...newObject
                    };
                } else {
                    profile_selected_images.push(newObject);
                }
                $("#blah" + updatePosition).attr('src', imageSrc);
                $("#img" + updatePosition).attr('src', imageSrc);
                $("#mediaId" + updatePosition).val(mediaId);
                if (profile_selected_images.length > 0) {
                    let modalTitle = document.querySelector("#setAsDefaultForMainAccount .modal-title");
                    let textNode = [...modalTitle.childNodes].find(
                        node => node.nodeType === Node.TEXT_NODE && node.textContent.trim() !== ""
                    );
                    if (textNode) {
                        textNode.textContent = default_image_icons.includes(targetImageName) ?
                            'Save to Default Media or Repository' : 'Replace Media';
                    }
                    $("#setAsDefaultForMainAccount").modal('show');
                }
            }
            $("#photo_gallery").modal("hide");
            $("#photo_gallery_banner").modal("hide");
        });

        function setAsDefultImages() {
            if (profile_selected_images.length > 0) {
                profile_selected_images.map((item, index) => {
                    updateDefaultImage(item.updatePosition, item.mediaId, item.img_target, item.imageSrc);
                    if (profile_selected_images.length == (index + 1)) {
                        profile_selected_images = [];
                    }
                });
                $("#setAsDefaultForMainAccount").modal('hide');
            }
        }

        function updateDefaultImage(position, meidaId, img_target, media_src) {

          
            console.log({
                position: position,
                meidaId: meidaId
            });
            var url = window.postdefaultImageUrl;
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    position: position,
                    meidaId: meidaId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.error == true) {
                        img_target.attr('data-id', meidaId);
                        img_target.attr('src', media_src);
                    } else {
                        swal.fire('', "<p>" + data.msg + "</p>", 'error');
                        // $('.comman_msg').html();
                        // $("#comman_modal").modal('show');
                        $('#comman_modal').on('hidden.bs.modal', function() {
                            // location.reload();
                        });
                    }
                }
            });
        }


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                //console.log(reader);
                var imgbytes = input.files[0].size;
                var imgkbytes = Math.round(parseInt(imgbytes) / 1024);
                var imgMB = Math.round(parseInt(imgkbytes) / 1024);
                if (imgMB <= 2) {
                    reader.onload = function(e) {
                        $('#blah' + input.id[3])
                            .attr('src', e.target.result);

                    };
                } else {
                    //alert("file size in MB = "+imgMB);
                    $('.comman_msg').html("Can't upload more than 2 MB size");
                    $("#comman_modal").modal('show');
                }


                reader.readAsDataURL(input.files[0]);
                console.log("img = " + input.id[3]);


                console.log("sizeKB = " + imgkbytes);


            }
            $("body").on('click', '#manageImgId', function(e) {
                var src = $("#blah" + input.id[3]).attr('src');
                $('#img' + input.id[3])
                    .attr('src', src);
                $("#upload-sec").modal('hide');
                console.log("file = " + input.id[3]);
            })

        }

        $("body").on("keyup change", ".stageNameOnBlank", function() {
            let $this = $(this);

            if ($this.val().trim() === "") {
                console.log('heycdsd');
                $(".change_default_select").show();
                $(".stageNameOnBlank").hide();
                return true;
            }
        });


        // UPDATE BUTTONS
        // var parsleyRadio = $('[name="covidreport"]').eq(0).parsley();
        // $("body").on("click", "#updateVaccineStatus", function() {
        //     if (parsleyRadio.isValid()) {
        //         const selected = $('[name="covidreport"]:checked').val();
        //         update_escort($(this), {
        //             covidreport: selected
        //         });
        //     } else {
        //         parsleyRadio.validate();
        //     }

        // });

       

        function stageNameInput(ele) {
            if ($(ele).val() == 'new') {
                $(ele).remove();
                $("#stageNameInp").attr('type', 'text');
                $("#stageNameInp").attr('name', 'name');
            }
            return true;
        }


        function checkRates(){
            const selectors = [
            'input[name="massage_price[]"]',
            'input[name="incall_price[]"]',
            'input[name="outcall_price[]"]'
            ];

            let isValid = false;
            const allInputs = selectors.flatMap(selector => 
            Array.from(document.querySelectorAll(selector))
            );

            for (const input of allInputs) {
            const val = parseFloat(input.value);
            
            if (!isNaN(val) && val > 0) {
                isValid = true;
                break;
            }
            }
            return isValid;
        }

        function validateSecondTab()
        {
             var massage_service   = $('#service_id_one').val();
             var other_service   = $('#service_id_two').val();
             var existRates = checkRates();
             let is_true = true;

             console.log('existRates',existRates);

            if(massage_service=="")
            {
            swal_error_warning('Massage Services','Please select massage service.')
            is_true = false;
            }
            
            else if(other_service=="")
            {
            swal_error_warning('Other Service Types','Please select another service type.')
            is_true = false;
            }

            else if (!existRates) {
                 swal_error_warning('Rates','You must complete at least one rate value to proceed.')
                 is_true = false;
            }

            return is_true;

        }

        function validateThirdTab()
        {
           var hasError  = validateAvailability();
           let is_true = true;

             if (hasError) {
                 swal_error_warning('Our Open Time','Please select a time range or choose an availability option for each day.')
                 is_true = false;
            }

            return is_true;
        }


           ////////////// For Our Open Times ///////////////// 
            function validateAvailability() 
            {

                let isFormValid = true;

                $('.profile_time_availibility .parent-row').each(function () {

                    let row = $(this);

                    let status = row.find('input[type="radio"]:checked').val() || '';

                    let fromHH   = row.find('select[name*="[hh_from]"]').val();
                    let fromAMPM = row.find('select[name*="[ampm_from]"]').val();
                    let toHH     = row.find('select[name*="[hh_to]"]').val();
                    let toAMPM   = row.find('select[name*="[ampm_to]"]').val();

                    row.removeClass('border border-danger');

                    let hasFrom = fromHH && fromAMPM;
                    let hasTo   = toHH && toAMPM;

                   
                    if (!status && !hasFrom && !hasTo) {
                        isFormValid = false;
                        row.addClass('border border-danger');
                        return;
                    }

                    
                    if (status === 'til_late' && !hasFrom) {
                        isFormValid = false;
                        row.addClass('border border-danger');
                        return;
                    }

                    
                    if (!status && hasFrom && !hasTo) {
                        isFormValid = false;
                        row.addClass('border border-danger');
                        return;
                    }

                    if (status === '24_hours' || status === 'closed') {
                        return;
                    }
                });

                console.log('isFormValid', isFormValid);
                if (!isFormValid) {
                            return true;
                            }
                 return false;

            }

                function getRow(row) {
                    return {
                        from: row.find('select[name*="[hh_from]"], select[name*="[ampm_from]"]'),
                        to: row.find('select[name*="[hh_to]"], select[name*="[ampm_to]"]'),
                        radios: row.find('input[type="radio"]')
                    };
                }


                $('.profile_time_availibility').on('change', 'input[type="radio"]', function () {

                    let row = $(this).closest('.parent-row');
                    let val = $(this).val();
                    let { from, to } = getRow(row);

                    if (val === 'til_late') {
                        from.prop('disabled', false);
                        to.val('').prop('disabled', true);
                    } else {
                        from.val('').prop('disabled', true);
                        to.val('').prop('disabled', true);
                    }
                });


                $('.profile_time_availibility').on(
                    'change',
                    'select[name*="[hh_from]"], select[name*="[ampm_from]"]',
                    function () {

                        let row = $(this).closest('.parent-row');
                        let { from, to, radios } = getRow(row);

                        radios.prop('checked', false);   // uncheck radios
                        from.prop('disabled', false);
                        to.prop('disabled', false);
                    }
                );


                $('.profile_time_availibility .parent-row').each(function () {

                    let row = $(this);
                    let checked = row.find('input[type="radio"]:checked').val();
                    let { from, to } = getRow(row);

                    if (checked === 'til_late') {
                        from.prop('disabled', false);
                        to.prop('disabled', true);
                    } else {
                        from.prop('disabled', true);
                        to.prop('disabled', true);
                    }
                });


            ////////////// End For Our Open Times ///////////////// 

       
    $(function(e) {

            $('.resetdays').on('click', function () {
                let row = $(this).closest('.parent-row');
                row.find('select').val('').prop('disabled', false);
                row.find('input[type="radio"]').prop('checked', false);

            });


            //////////// For Our Service (Tags)  /////////////////////
            $('body').on('click', '.akh1', function() {
                    var id = $(this).attr('id');
                    var val = $(this).data('val');
                    var name = $(this).data('sname');
                    $('#hideenclassOne_'+val).remove();
            
                    $("#service_id_one").append("<option id='"+name+"' value='"+val+"'>"+name+"</option>"); 
                    console.log("click "+name);
                });
               
            $('body').on('click', '.akh2', function() {
                var id = $(this).attr('id');
                var val = $(this).data('val');
                var name = $(this).data('sname');
                $('#hideenclassTwo_'+val).remove();
        
                $("#service_id_two").append("<option id='"+name+"' value='"+val+"'>"+name+"</option>"); 
                console.log("click "+name);
                console.log("id= "+id);
                console.log("val= "+val);
            });    
            
            $(document).on('change','#service_id_one', function(){
                var selectedIdOne = $('#service_id_one').val();
                
                var getNameOne = $(this).children(":selected").attr("id");console.log(getNameOne);
                if(selectedIdOne){
                    $("#selected_service_one").append(" <li id='hideenclassOne_"+ selectedIdOne+"'><div class='my_service_anal' ><span class='dollar-sign'>"+getNameOne+"</span><input type='number' class='dollar-before input_border' name='price[]' placeholder='0' value=0 min='0' oninput='this.value = Math.abs(this.value)' step=10 max=200><input type='hidden' name='category_id[]' value='1'><input type='hidden' name='service_id[]' value="+ selectedIdOne +" placeholder=''><span><i class='fas fa-times-circle akh1' data-sname='"+getNameOne+"' data-val="+ selectedIdOne+"  id='id_"+ selectedIdOne+"' value="+selectedIdOne+"></i></span></div></li> ");
                    $("#service_id_one option[value="+ selectedIdOne +"]").attr('disabled','disabled');
                    $("#service_id_one option[value="+ selectedIdOne +"]").remove();
                    console.log('changewwwwww='+selectedIdOne);
                }
            });



        $('body').on('change','#service_id_two', function(){
                var selectedIdTwo = $('#service_id_two').val();
                var getNameTwo = $(this).children(":selected").attr("id");
                if(selectedIdTwo){
                    $("#selected_service_two").append(" <li id='hideenclassTwo_"+selectedIdTwo+"'><div class='my_service_anal hideenclassTwo"+selectedIdTwo+"'><span class='dollar-sign'>"+getNameTwo+"</span><input type='number' class='dollar-before input_border' name='price[]' placeholder='0' min='0' oninput='this.value = Math.abs(this.value)' step=10 max=200 value=0><input type='hidden' name='category_id[]' value='2'><input type='hidden' name='service_id[]' value="+ selectedIdTwo +"><span><i class='fas fa-times-circle akh2'  data-sname='"+getNameTwo+"' data-val="+ selectedIdTwo+"  id='id_"+ selectedIdTwo+"' value="+selectedIdTwo+"></i></span></div></li> ");
                    $("#service_id_two option[value="+ selectedIdTwo +"]").attr('disabled','disabled');
                    $("#service_id_two option[value="+ selectedIdTwo +"]").remove();
                    console.log('change='+selectedIdTwo);
                }
            });

        //////////// End For Our Service (Tags)  /////////////////////


 }); 