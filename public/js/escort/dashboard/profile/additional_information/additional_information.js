const mmRoot = $('#manage-route');
const endpoint = {
    csrf_token: mmRoot.data('csrf-token'),
    success_image: mmRoot.data('success-info'),
    error_image: mmRoot.data('error-warning'),
    stagename_store: mmRoot.data('stagename-store'),
    stagename_delete: mmRoot.data('stagename-delete'),
    stage_names: mmRoot.data('stage-names'),
    additional_store: mmRoot.data('additional-store'),
    additional_delete : mmRoot.data('additional-delete'),
    address :mmRoot.data('address')  || [],
    title : mmRoot.data('title') || [],
    narrations : mmRoot.data('narrations') || [],
};




$(function () {

    const modules = {
        stageName : {
            listId : '#stageNameList',
            inputId : '#stage_name',
            sortRadio : 'sortedByStageNames',
            saveBtn : '.save_stage_name_button',
            deleteClass : '.delete_stage_name',
            storeUrl : endpoint.stagename_store,
            deleteUrl : endpoint.stagename_delete,
            extraData : {type : 'name'},
            data : Object.values(endpoint.stage_names || {}),
            isTextarea : false,
        },
        address: {
            listId : '#stageAddress',
            inputId : '#st_address',
            sortRadio : 'sortedByStageAddress',
            saveBtn : '.save_address_button',
            deleteClass : '.delete_address',
            storeUrl : endpoint.additional_store,
            deleteUrl : endpoint.additional_delete,
            extraData : {type : 'address'},
            data : Object.values(endpoint.address || {}),
            isTextarea : false
        },
        title : {
            listId : '#stageTitleList',
            inputId : '#who_title',
            sortRadio : 'sortedByStageTitle',
            saveBtn : '.save_title_button',
            deleteClass : '.delete_title',
            storeUrl : endpoint.additional_store,
            deleteUrl : endpoint.additional_delete,
            extraData : {type : 'title'},
            data : Object.values(endpoint.title || {}),
            isTextarea : false
        },
        narration : {
            listId : '#stageNarration',
            inputId : '#who_narration_textarea',
            sortRadio : 'sortedByNarration',
            saveBtn : '.save_narration_button',
            deleteClass : '.delete_narration',
            storeUrl : endpoint.additional_store,
            deleteUrl : endpoint.additional_delete,
            extraData : {type : 'narration'},
            data : Object.values(endpoint.narrations || {}),
            isTextarea : false, // this is textarea 
            isCkeditor : true,
        }
    }


    //Card Template
    function stageCard(name, deleteClass){
         const display = name.length > 40 ? name.substring(0, 40) + '...' : name;
         return `
            <li style="font-size:14px; background:#0C223D !important;">
                <a href="#">${display}</a>
                <div class="close ml-2 text-white stage-close" aria-label="Close">
                    <span aria-hidden="true" class="${deleteClass.replace('.', '')}" data-name="${name}">×</span>
                    <small class="mytool-tip">Remove</small>
                </div>
            </li>`;
    }


    //Short
    function getSortedNames(names, sortType) {
        let sorted = [...names];
        if(sortType == 'alalphabetically'){
            shorted.sort((a, b) => a.localeCompare(b));
        } else if(sortType == 'random'){
            for (let i = sorted.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [sorted[i], sorted[j]] = [sorted[j], sorted[i]];
            }
        }
        return sorted;
    }

    function renderList(mod) {
         console.log('step 2 working');   
        const sortType = $(`input[name="${mod.sortRadio}"]:checked`).val();
         console.log('step 3 working', mod.sortRadio, sortType);  
        const ul = $(mod.listId);
        ul.empty();
        getSortedNames(mod.data, sortType).forEach(function (name) {
            ul.append(stageCard(name, mod.deleteClass));
        });
    }

    //init
     Object.values(modules).forEach(mod => renderList(mod));



    //SORT RADIO CHANGE 
    Object.values(modules).forEach(function (mod){
         $(`input[name="${mod.sortRadio}"]`).on('change', function () {
            console.log('step 1 working');         
            renderList(mod);
        });
    });

    

    // GENERIC SAVE 💫

    function initSave(mod){
        $(document).on('click', mod.saveBtn, function(){
              console.log('mod', mod);
              let value = '';
            if (mod.isCkeditor) {
                const editorInstance = CKEDITOR.instances[mod.inputId.replace('#', '')];
                value = editorInstance ? editorInstance.getData().trim() : '';

                const plainText = value.replace(/<[^>]*>/g, '').trim();
                if (!plainText) {
                    showAlert('warning', 'Warning', 'Please enter a value.');
                    return;
                }

            } else {
                value = $(mod.inputId).val().trim();
                if (!value) {
                    showAlert('warning', 'Warning', 'Please enter a value.');
                    return;
                }
            }
            if(!value){
                showAlert('warning', 'Warning', 'Please enter a value.');
            }

            $.ajax({
                url : mod.storeUrl,
                method : 'POST',
                dataType : 'json',
                data : Object.assign({
                    _token : endpoint.csrf_token,
                    value : value,
                    type : mod.extraData.type
                },mod.extraData),
                success: function(res){
                    if(res.status == true){
                        if(mod.isCkeditor){
                            mod.data.push(getShortDesc(value));
                        }else{
                            mod.data.push(value);
                        }
                        renderList(mod);
                        $(mod.inputId).val('');
                        showAlert('success', 'Saved', 'Added successfully!');
                    } else {
                        showAlert('error', 'Error', res.message || 'Something went wrong.');
                    }

                },
                error : function(xhr){
                    showAlert('error', 'Error', getErrorMsg(xhr));
                }
            });
        });
    }



    // GENERIC DELETE
    function initDelete(mod){
        $(document).on('click', mod.deleteClass, function () {
            const name = $(this).data('name');
            const $liElem = $(this).closest('li');
            $.ajax({
                url : mod.deleteUrl,
                method : 'POST',
                dataType : 'json',
                data : Object.assign({
                    _token : endpoint.csrf_token,
                    data : name,
                    type : mod.extraData.type

                }),
                success: function (res){
                    console.log('delete response', res);
                    if(res.status == true){
                        mod.data = mod.data.filter(n => n != name);
                        $liElem.remove();
                        showAlert('success', 'Removed', 'Removed successfully!');
                    }else{
                        showAlert('error', 'Error', res.message || 'Something went wrong.');
                    }
                },
                error : function(xhr){
                    showAlert('error', 'Error', getErrorMsg(xhr));
                }
            });


        });
    }

    // for all save/delete
    Object.values(modules).forEach(function (mod) {
        initSave(mod);
        initDelete(mod);
    });

    //for error message
    function getErrorMsg(xhr) {
        try {
            var json = xhr.responseJSON || JSON.parse(xhr.responseText);
            return (json && json.message) ? json.message : 'Something went wrong.';
        } catch (e) {
            return 'Something went wrong.';
        }
    }

    //show alert

    function showAlert(type, title, message) {
        const iconMap = {
            success: endpoint.success_image,
            error  : endpoint.error_image,
            warning: endpoint.error_image
        };
        $('#modal-icon').attr('src', iconMap[type] || endpoint.success_image);
        $('#modal-title').text(title || '');
        $('#comman_str').text('');
        $('.comman_msg').text(message || '');
        $('#comman_modal').modal('show');
    }

    function getShortDesc(value){
        let plainText = value;
        plainText = value.replace(/<[^>]*>/g, '');
        //remove extra space
        plainText = plainText.replace(/\s+/, ' ').trim();
        // First 5 words
        const words = plainText.split(' ').filter(w => w.length > 0);
        return words.slice(0, 5).join(' ');
    }
    
    initCkEditor('who_narration_textarea');

    function initCkEditor(textarea, charLimit = 2500) {
        // Remove # if passed
        textarea = textarea.replace('#', '');

        // Destroy old instance if exists
        if (CKEDITOR.instances[textarea]) {
            CKEDITOR.instances[textarea].destroy(true);
        }

        // Create editor
        let editor = CKEDITOR.replace(textarea, {

            extraPlugins: 'emoji',

            toolbarGroups: [
                { name: 'clipboard', groups: ['clipboard', 'undo'] },
                { name: 'editing', groups: ['find', 'selection'] },
                { name: 'links', groups: ['links'] },
                { name: 'insert', groups: ['insert'] },
                { name: 'tools', groups: ['tools'] },
                { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
                { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align'] },
                { name: 'styles', groups: ['styles'] },
                { name: 'colors', groups: ['colors'] }
            ],

            removeButtons:
                'Underline,Subscript,Superscript,PasteText,PasteFromWord,' +
                'Anchor,Unlink,Image,Table,HorizontalRule,SpecialChar,' +
                'Maximize,About,RemoveFormat,Strike'
        });

        // Allowed keys
        const allowedKeys = [8, 46, 37, 38, 39, 40];

        // Character limit on typing
        editor.on('key', function (event) {

            let content = editor.getData().replace(/<[^>]*>/g, '');
            let keyCode = event.data.keyCode;

            if (content.length >= charLimit &&
                !allowedKeys.includes(keyCode)) {

                event.cancel();
            }
        });

        // Character limit on paste
        editor.on('paste', function (event) {

            let content = editor.getData().replace(/<[^>]*>/g, '');

            if (content.length >= charLimit) {
                event.cancel();
            }
        });

        return editor;
    }


});